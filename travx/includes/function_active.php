<?php
/**
 * @author Le Van Tu
 * @des cap phat cac thong so cho mot user moi dang ky
 */
function capPhat($username, $nation_id, $position, $customerid)
{
    $village_map_id = GetVillageForNewUser($position);

    if ($village_map_id)
    {
        include_once("func_build.php");
        insertWg_profiles($username);
        $user_id = insertWg_users($username, $village_map_id, $position, $nation_id, $customerid);
        insertPlus($user_id);
        insertWg_top10($user_id);
        //KhoiTaoUser($user_id, $village_map_id, $timeActive, $actived);
        $kind_id = KhoiTaoVillage($village_map_id, $user_id, $username, $nation_id,'', 1);
        InsertDataBuilding_New($village_map_id, $user_id, $kind_id, 1);
        KhoiTaoTroopResearch($village_map_id, $nation_id);
        UpdateRegVillageList($village_map_id);
		
		// Beginners protection
		AddProtection($user_id);
		
		// Send newbie message
		SendMessage($user_id);

        // event tang vang cho user dang ky thành công
        EventGiveGold(time(), $user_id);
    }
    else
    {
        globalError2("Het village trong bang registtrationlist: posotion=$position    user_id=$user_id");
        header("Location:active_user.php?error='vung_cap_nhat_" . $position . "_da_het'");
        exit();
    }
}
function SendMessage($uid){
	$topic = "Welcome to Travx Private server!";
	$content = "Welcome to our server! We hope you enjoy it here. In fact, we want that so much we gave you 50 Gold to get you started.

Not all of players are friendly (some cant even speak English! ^^), so we mercifully gave you a 24 hour protection period before they can attack you. Attacking another player also cancels it, so use it wisely! Youre welcome to register on our Forums that is located in the left menu.

We hope your experience will be as enjoyable as possible. If you havent already (lets be honest, who does that anyway?), you really should go through our rules, its not as bad as they make it sound, and you might even catch a reward or two.

Were looking forward to seeing you online!

Regards,
the TravX team!";
	$sql = "INSERT INTO wg_messages 
			(id_user, from_id, to_id, times, status, subject, content) VALUES 
			(".$uid.",2,".$uid.",'".date("Y-m-d H:i:s")."',0,'".$topic."','".$content."')";
	mysql_query($sql) or die(mysql_error());
}

// Beginners protection
function AddProtection($user_id) {
	global $db;
	
	$time = time()+3600*24;
	$sql = "UPDATE wg_users SET iswar = '".$time."' WHERE id = ".$user_id;
	$db->setQuery($sql);
	if(!$db->query()){
		globalError2('Function: AddProtection: '.$sql);
	}
	
	return true;
}

function EventGiveGold($time, $userId)
{
	global $db;
    $total_asu  = 50;
    $time_start = strtotime('2011-06-22 14:00:00');

    //$time_end   = strtotime('2011-06-23 14:00:00');
    if ($time >= $time_start)
    {
        $sql = "UPDATE wg_plus SET gold = gold + " . $total_asu . " WHERE user_id=" . $userId;
        $db->setQuery($sql);
        $db->query();
    }
}

function insertWg_users($username, $village_id, $position, $nation, $customerid)
{
    global $db;
    $sql =
        "INSERT INTO `wg_users` (`customerid`,`username`,`position`,`villages_id`,`sum_villages`,`population`,`nation_id`,`active_time`,`actived`) VALUES ('"
        . $customerid . "','" . $username . "'," . $position . "," . $village_id . ",1,2," . $nation . ",'" . date(
                                                                                                                  "Y-m-d H:i:s")
        . "',1)";
    $db->setQuery($sql);

    if (!$db->query())
    {
        globalError2('function insertWg_users:' . $sql);
    }

    return $db->insertid();
}

function insertWg_top10($user_id)
{
    global $db;
    $sql = "INSERT INTO `wg_top10` (`user_id`,`week_nd`) VALUES (" . $user_id . "," . date("W") . ")";
    $db->setQuery($sql);

    if (!$db->query())
    {
        globalError2("function insertWg_top10:" . $sql);
    }
}

function insertWg_profiles($username)
{
    global $db;
    $profiles = get_profile($username);
    $birthday = str_replace('-', '/', $profiles['birthday']);
    $sql      = "INSERT INTO `wg_profiles` (`username`) VALUES ('".$username."')";
    $db->setQuery($sql);

    if (!$db->query())
    {
        globalError2("function insertWg_profiles:" . $sql);
    }
}
/**
 * @author Le Van Tu
 * @des chen mot record vao bang wg_plus
 */
function insertPlus($user_id)
{
    global $db;
    $sql = "INSERT INTO `wg_plus` (`user_id`) VALUES ('$user_id');";
    $db->setQuery($sql);

    if (!$db->query())
    {
        globalError2("function insertPlus:" . $sql);
    }
}

function GetVillageForNewUser($position)
{
    global $db;
    $sql = "SELECT COUNT(DISTINCT(id)) FROM wg_registration_village_list WHERE zone_id=$position AND registed=1";
    $db->setQuery($sql);

    if ($db->loadResult() < 200) // 200 nguoi dau tien random
    {
        $sql =
            "SELECT village_id FROM wg_registration_village_list WHERE zone_id=$position AND registed=0 ORDER BY id ASC LIMIT 0,200";
        $db->setQuery($sql);
        $villageList = $db->loadObjectList();

        if ($villageList)
        {
            $index = rand(0, count($villageList) - 1);
            return $villageList[$index]->village_id;
        }
        else
        {
            globalError2("function GetVillageForNewUser: Het village trong bang registtrationlist: posotion=$position");
        }
    }
    else
    {
        $sql =
            "SELECT village_id FROM wg_registration_village_list WHERE zone_id=$position AND registed=0 ORDER BY id ASC";
        $db->setQuery($sql);
        return $db->loadResult();
    }
}

/**
 * Khoi tao lang moi truoc khi gan cho user.
 */
global $kind_id;

function KhoiTaoVillage($village_map_id, $user_id, $user_name = '', $nation, $name = '', $newuser = 0)
{
    global $db, $kind_id;
    $sql = "SELECT x, y, kind_id, user_id 
                FROM wg_villages_map 
                WHERE id=$village_map_id";
    $db->setQuery($sql);
    $db->loadObject($villageMap);

    if ($villageMap)
    {
        if($newuser == 1){ $kind_id = "3"; } else { $kind_id = $villageMap->kind_id; }
        $sql     = "INSERT INTO wg_villages SET ";

        if ($name == '')
        {
            $sql .= "name='" . $user_name . "', ";
        }
        else
        {
            $sql .= "name='" . $name . "', ";
        }

        $sql .= "id=$village_map_id, ";
        $sql .= "x=$villageMap->x, ";
        $sql .= "y=$villageMap->y, ";
        $sql .= "kind_id=$kind_id, ";
        $sql .= "user_id=$user_id, ";
        $sql .= "nation_id=$nation, ";
        $sql .= "time_update_rs1=now(), ";
        $sql .= "time_update_rs2=now(), ";
        $sql .= "time_update_rs3=now(), ";
        $sql .= "time_update_rs4=now(), ";
        $sql .= "cpupdate_time=now(), ";
        $sql .= "workers=2, ";
        $sql .= "merchant_underaway=0, ";
        $sql .= "rs1=750, ";
        $sql .= "rs2=750, ";
        $sql .= "rs3=750, ";
        $sql .= "rs4=750, ";
        $sql .= "faith=100, ";
        $sql .= "faith_time=now(), ";
        $sql .= "dateCreate_vila=now() ";
        $db->setQuery($sql);

        if ($db->query())
        {
            /*-------------------------- code cua anh trung -----------------------------------------------*/
            $sql =
                "UPDATE `wg_villages_map` SET kind_id='$kind_id', `workers` = '2',user_id=$user_id WHERE `wg_villages_map`.`id` =$village_map_id";
            $db->setQuery($sql);
            $db->query();
            return $kind_id;
        }
        else
        {
            globalError2("Error1 !!!KhoiTaoVillage" . $sql);
        }
    }
    else
    {
        globalError2("Error !!!KhoiTaoVillage" . $sql);
    }
}


//Mot so troop khong can research (Tho).
function KhoiTaoTroopResearch($village_id, $nation_id)
{
    global $db;

    //$tho_id=GetTroopIDByName($nation_id, "Th?");
    include_once("function_troop.php");
    $soldierName = get_soldier($nation_id);
    $soldierName = $soldierName . '10';
    $tho_id      = GetTroopIDByName($nation_id, $soldierName);

    $sql         = "SELECT id FROM wg_troops WHERE nation_id=$nation_id ORDER BY id ASC";
    $db->setQuery($sql);
    $troop = null;
    $db->loadObject($troop);

    if ($troop)
    {
        $sql = "INSERT INTO wg_troop_researched (troop_id, village_id, status) VALUES ($troop->id, $village_id, 1)";
        $db->setQuery($sql);

        if (!$db->query())
        {
            globalError2("KhoiTaoTroopResearch");
        }

        //Chen tho.
        $sql = "INSERT INTO wg_troop_researched (troop_id, village_id, status) VALUES ($tho_id, $village_id, 1)";
        $db->setQuery($sql);

        if (!$db->query())
        {
            globalError2("KhoiTaoTroopResearch1");
        }

        return true;
    }

    globalError2("KhoiTaoTroopResearch3");
}

function KhoiTaoUser($user_id, $village_id, $timeActive, $actived)
{
    global $db;
    $sql =
        "UPDATE 
                wg_users  
            SET 
                villages_id=$village_id, 
                population=2, 
                sum_villages=1, 
                active_time='$timeActive', 
                actived=$actived 
            WHERE 
                id=$user_id";
    $db->setQuery($sql);

    if (!$db->query())
    {
        globalError2("KhoiTaoUser user_id=$user_id");
    }
}

/**
 * @author Le Van Tu
 * @des update active_time, actived trong bang wg_users
 * @param id wg_users
 */
function activeUser($id)
{
    global $db;
    insertWg_top10($id);
    $sql =
        "UPDATE 
                wg_users  
            SET  
                active_time=now(), 
                actived=1 
            WHERE 
                id=$id";
    $db->setQuery($sql);

    if (!$db->query())
    {
        globalError2("KhoiTaoUser id=$id");
    }
}

function UpdateRegVillageList($village_id)
{
    global $db;
    $sql = "UPDATE wg_registration_village_list SET registed=1 WHERE village_id=$village_id";
    $db->setQuery($sql);

    if (!$db->query())
    {
        globalError2("UpdateRegVillageList");
    }

    return true;
}
?>