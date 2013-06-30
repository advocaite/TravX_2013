<?php
require_once('class.paypal.php');
class ShowPaypalPage extends paypal_class
{
        const MAIL        = '';

        public $pattern        = array(					
			500         => '2.0',
            1250        => '5.00',
            3000        => '10.00',						
			8500        => '20.00',
			10000       => '50.00',
        );
        public $cost        = '0';
        public $amount        = '0';
		
		public $dbhost     = "localhost"; //Your database domain
		public $dbuser     = "kwa10000_travi"; //Database username
		public $dbpassword = "-Travi-"; //Database password
		public $db         = "kwa10000_travi"; //Database name
		
        function __construct($id) {
                parent::__construct($id);

                switch ($_GET['action'])
                {
                        case 'success':
                                $this->Success();
                        break;
                        case 'cancel':
                                $this->Cancel();
                        break;
                        case 'ipn':
                                $this->IPN();
                        break;
                        default:
                                $this->CallOrder($id);
                        break;
                }
        }

        function Success()
        {
                echo 'Gold is added to your account!<br><br><a href="http://localhost/buy_gold.php">Continue</a>';
        }

        function Cancel()
        {	
                echo'Order is canceled!</h3><br><a href="http://localhost/buy_gold.php">Continue</a><br>';
        }

        /*
                It's important to remember that paypal calling this script.  There
                is no output here.  This is where you validate the IPN data and if it's
                valid, update your database to signify that the user has payed.  If
                you try and use an echo or printf function here it's not going to do you
                a bit of good.  This is on the "backend".  That is why, by default, the
                class logs all IPN data to a text file.
        */

        function IPN()
        {		
                if (!$this->validate_ipn())
                        exit;
				$conn = mysql_connect($this->dbhost, $this->dbuser, $this->dbpassword);
				mysql_select_db($this->db);
                $ID        = $this->request_var('custom', '');
				$selectinfo = mysql_query("SELECT * FROM `paypal` WHERE `id` = '".$ID."';");
				$INFO = mysql_fetch_array($selectinfo);
				$selectdonate = mysql_query("SELECT `username` FROM `wg_users` WHERE `id` = '".$INFO['player']."'");
				$donate = mysql_fetch_array($selectdonate);
				mysql_query("UPDATE wg_plus SET gold=gold + '".$INFO['amount']."' WHERE user_id ='".$INFO['player']."'");
				mysql_query("UPDATE `paypal` SET `sucess` = '". 1 ."', `dateTime` = '".date("Y-m-d H:i:s")."', `username` = '".$donate['username']."'  WHERE `id` = '".$ID."';");
				$escbody = mysql_real_escape_string ("You just buyed some gold or you received gold gift from someone.\n\n'".
						"We really appreciate this transaction.\n\n".
						"When you buy gold you support our servers so we can grow up and make your game more fun.\n\n".
						"This message is automatic. Please don't reply to it.\n\n".
						"Regards,\nthe NoobsOnline Team");
				$userId = $INFO['player'];
				$id = $donate['username'];
				$topic = 'Gold received!';
				$sql ="INSERT INTO `wg_messages` (`id_user`,`from_id`,`to_id`,`times`,`status`,`subject`,`content`) VALUES
			(1,0,".$userId.",'".date("Y-m-d H:i:s")."',0,'".mysql_real_escape_string($topic)."','".$escbody."'),(".$userId.",1,0,'".date("Y-m-d H:i:s")."',0,'".$topic."','".$escbody."')";
	mysql_query($sql) or die(mysql_error());;
				mysql_close($conn);
	  }

        function CallOrder($ident)
        {
		
                $this->amount                = $this->request_var('amount', 0);
				
                if(!array_key_exists($this->amount, $this->pattern)) {
                        message('NOT VAILD VALUE', 'http://localhost/buy_gold.php', 3);
                        exit;
                }
				//$ident = $_COOKIE['VNS2'];
                $this->cost        = $this->pattern[$this->amount];
				$conn = mysql_connect($this->dbhost, $this->dbuser, $this->dbpassword);
				mysql_select_db($this->db);
				mysql_query("INSERT INTO `paypal` (`id`, `player`, `amount`, `timestamp`) VALUES (NULL, '".$ident."', '".$this->amount."', '".time()."' );");
				$selectid = mysql_query("SELECT `id` FROM `paypal` WHERE `player` = '".$ident."' AND `amount` = '".$this->amount."' AND `timestamp` = '".time()."' ");
								$ID = mysql_fetch_array($selectid);								$nameq = mysql_query("SELECT `username` FROM `wg_users` WHERE `id` = '".$ident."' ");								$name = mysql_fetch_array($nameq);
				$this->add_field('business', self::MAIL);
                $this->add_field('return', 'http://'.$_SERVER['HTTP_HOST'].'/sucess.php');
                $this->add_field('cancel_return', 'http://'.$_SERVER['HTTP_HOST'].'/cancel.php');
                $this->add_field('notify_url', 'http://'.$_SERVER['HTTP_HOST'].'/paypal.php');
                $this->add_field('item_name', $this->amount.' Gold - User '.$name['username'].' from localhost');
                $this->add_field('item_number', $this->amount.' Gold');
                $this->add_field('amount', $this->cost);
			   //$this->add_field('action', $action); ?
                $this->add_field('currency_code', 'EUR');
                $this->add_field('custom', $ID['id']);
                $this->submit_paypal_post();
                //$this->dump_fields();
				mysql_close($conn);
        }
		function request_var($var_name, $default, $multibyte = false, $specialtype = '')
{
	if(!isset($_REQUEST[$var_name]))
		return $default;
	
	$var	= $_REQUEST[$var_name];
	$type	= gettype($default);
	settype($var, $type);
	if ($type == 'string')
	{
		$var = trim(htmlspecialchars(str_replace(array("\r\n", "\r", "\0"), array("\n", "\n", ''), $var), ENT_COMPAT, 'UTF-8'));

		if (!empty($var))
		{
			// Make sure multibyte characters are wellformed
			if ($multibyte)
			{
				if (!preg_match('/^./u', $var))
				{
					$var = '';
				}
			}
			else
			{
				// no multibyte, allow only ASCII (0-127)
				$var = preg_replace('/[\x80-\xFF]/', '?', $var);
			}
		}
	}
	return $var;
}

}
?>