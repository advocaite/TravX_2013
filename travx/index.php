<?php
ob_start();
define('INSIDE', true);

$ugamela_root_path='./';
include ('includes/db_connect.php');
include ('includes/common.php');
global $lang, $user;

if (check_user())
    {
    header ("Location: village1.php");
    }
includeLang('login');
$parse          = $lang;
$parse['lang_'] = $language;
$parse=$lang;
$sql  ="SELECT count(DISTINCT(id)) FROM wg_users";
$db->setQuery($sql);
$players=(int)$db->loadResult();
$parse['players']=$players;
$sql="SELECT count(DISTINCT(id)) FROM wg_users WHERE actived=1";
$db->setQuery($sql);
$active=(int)$db->loadResult();
$parse['active']=$active;
$sql            ="SELECT count(DISTINCT username) FROM wg_sessions";
$db->setQuery($sql);
$online         =(int)$db->loadResult();
$parse['online']=$online;
//$page           =parsetemplate(gettemplate('body'), $parse);


if (count($_POST) <> 0 && $_POST['check'] == $_SESSION['security_login'])
{
    if (empty($_POST["username"]) || empty($_POST["password"]))
    {
        $parse['error1']   = $lang['error1']; //loi username
        $parse['error2']   = $lang['error2']; //loi mat khau
        $parse['username'] = '';
        $parse['password'] = '';

        if (!empty($_POST["username"]))
        {
            $parse['username'] = $_POST["username"];
            $parse['error1']   = '';
        }

        if (!empty($_POST["password"]))
        {
            $parse['password'] = $_POST["password"];
            $parse['error2']   = '';
        }

        $parse['active']          = '';
        $parse['error3']          = '';
        //load news o trang login
        //$parse['list_news_login'] = load_list_news();
        //End
        $page                     = parsetemplate(gettemplate('body'), $parse);
        display_indzex($page, $lang['Login']);
    }
    else
    {
        if (!get_magic_quotes_gpc())
        {
            $username = str_replace('$', '\$', addslashes($_POST["username"]));
            $password = str_replace('$', '\$', addslashes($_POST["password"]));
        }
        else
        {
            $username = str_replace('$', '\$', $_POST["username"]);
            $password = str_replace('$', '\$', $_POST["password"]);
        }

        $username = $db->getEscaped($username);
        $password = $db->getEscaped($password);
        $password_md5 = md5($password);
        //echo $password;die();
        $login    = false;

        if (login_remote($username, $password_md5)) // dang nhap thanh cong
        {
            $sql =
                "SELECT id,username,villages_id,alliance_id,actived,nation_id FROM wg_users WHERE username='$username'";
            $db->setQuery($sql);
            $wg_users = NULL;
            $db->loadObject($wg_users);

            if ($wg_users && $wg_users->actived == 1)
            {
                $login = true;
            }
            else // Inactive
            {
                $parse['error3'] = 'This account isnt activated!!';
                $code            = md5(get_customerid($username));
                header("Location:active_user.php?username=$username&code=$code");
                exit();
            }
        }
        else // tai khoan xai chung
        {
            $accountSister = getAccountSisterInfo($username);

            if ($accountSister)
            {
                if (login_remote($accountSister->sister1, $password))
                {
                    $sql =
                        "SELECT id,username,villages_id,alliance_id,nation_id FROM wg_users WHERE username='$username'";
                    $db->setQuery($sql);
                    $wg_users = NULL;
                    $db->loadObject($wg_users);

                    if ($wg_users)
                    {
                        $login = true;
                    }
                }
            }
        }

		$get = mysql_fetch_array(mysql_query("SELECT * FROM auth WHERE username='$username' AND password='$password_md5'"));
		if ($login && md5($_POST['password']) == $get['password'])
        {
			$expiretime = 0;
            $rememberme = 0;
            include('config.php');
            $password_new = md5($password . "--" . $dbsettings["secretword"]);
            $cookie       = $wg_users->id . " " . $wg_users->username . " " . $password_new . " " . $rememberme;

            setcookie($game_config['COOKIE_NAME'], $cookie, $expiretime, "/", "", 0);

			$regip = htmlspecialchars($_SERVER['REMOTE_ADDR']);
			mysql_query("UPDATE auth SET ip='$regip' WHERE username='".$wg_users->username."' ");
            $_SESSION['villa_id_cookie']   = $wg_users->villages_id;
            $_SESSION['password']          = $password_new;
            $_SESSION['alliance_id']       = $wg_users->alliance_id;
            $_SESSION['nation_id']         = $wg_users->nation_id;
            $_SESSION['username']          = $wg_users->username;
            $_SESSION['userid']            = $wg_users->id;
            $_SESSION['time_check_online'] = time() - 1000;
            $_SESSION['last_login']        = time();

            updateAllPlus();
            returnWorkersLogin($wg_users->id);
            returnKrsForUser($wg_users->id);
            //checkWorldFinished();

            if (!insertFeature($_POST['username'], "Login"))
            {
                globalError('Error!!!Login');
            }

            unset($dbsettings);
            $st_forward = $_REQUEST['redirect'];

            if ($st_forward != '')
            {
                header("Location:$st_forward");
                exit();
            }
            else
            {
                header("Location: index.php");
                exit();
            }
        }
        else
        {
            $parse['error1']          = '';
            $parse['error2']          = '';
            $parse['error3']          = $lang['error3']
                . ' Click <a href="register.php"> here to register</a>';
            $parse['username']        = '';
            $parse['password']        = '';
            $parse['active']          = '';
            $parse['code']            = $_SESSION['security_login'] = md5(time());
            $page                     = parsetemplate(gettemplate('body'), $parse);
            display_indzex($page, $lang['title']);
        }
    }
}
else
{
    $parse['active']          = '';
    $parse['password']        = '';
    $parse['username']        = '';
    $parse['error1']          = '';
    $parse['error2']          = '';
    $parse['error3']          = '';
    $parse['code']            = $_SESSION['security_login'] = md5(time());
    //load news o trang login
//    $parse['list_news_login'] = load_list_news();
    //End
    $page                     = parsetemplate(gettemplate('body'), $parse);
    display_indzex($page, $lang['title']);
}
ob_end_flush();
?>