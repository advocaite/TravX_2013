Funtravi TravX 2013
==========

Funtravi 2013 Travian Clone

It needs to bugfixed, but i dont give any support. You download, and use, if you can. 

Its 80% bugfree.

WARNING! Its NOT a real travian script, its just a game what is look alike(AKA Clone script) but it WORKS 95% like the original T3.6, so if u host this i am not responsible the possible lawsuits what u will have for hosting this, if u want to use this bulletproof, then change the graphics and interface, the code itself is unique, so it cannot be shut down... that is opensource and free.



Bugfixed Tuen Huang base Code REPACK

NOTE: Despite its "bugfixed" it has some bugs... 

Bug 1: In WAMP(Windows) based systems the resources sometimes wont work, use LAMP envrionment it U can!(Cpanel or someting like that...)

Bug 2: It has some SQL injections. You have to fix that!

Bug 3: It has a free gold aquire bug, it needs to be fixed too!

Bug 4: With a buguse you can upgrade main building for level 35 for free. It need to be fixed too.

Bug 5: Spies has a mayor problem, but they are working

All other things working good. :D :P

----------------------------------

Okay, so this is the Tuen Huang's and Advocaite's Travian clone script Repack.
it is bug fixed, and fairly easily can be installed.

Few important things you should know about this script...

1: it is 90-95% bugfree, just few things are missing or working wrong... 
like few plus pack(like instand building) or some smaller things, otherwise 
this script is so far the best i was ever found on the internet. 
Oh and it does not have any Cropfinder! simply missing from the plus packs.

2:This script HAS a moderated good security system wich is based around cookies.

3:This script is NOT containing Advocaite's Soap Script, it has a workaround for it. 
You will HAVE to edit the domain names in the database. (Not ultimately necesarry but 
it makes good belive me.)

4: Ido not know now and i do no and WILL NOT help in start in WOW i dunno if it is 
finished and/or even working ever. Do not ask i wont answer, if i found the answer, i 
will post on the forum.

WARNING: I did modifications for this code(fixed Function troops errors, and 
Database IP, Cleaned few template script ect.) but i did NOT modified everything, 
so in few places you will find and fix bugs for yourself!


Okay so a detailed setup for a script:

I did managed to work on a hosted Cpanel on unix, but it should work on any 
WAMP/XAMMP/MOWES or portable stuff. i said SHOULD WORK this does not mean it DOES.
so do not moan me about that YOU have to setup the serverside for yourself.

Preuisites:
Server with latest PHP+MYSQL+APACHE(With PEAR and possibly soap)+SMTP or 
MAIL SERVER(Tomcat or other)

--------------------
Install:
--------------------

0. Download server from here(Maded a "FEW" Mirrors :D)

1. Database

  1.A Make a Database name it whatever you want. Does not matter what the name is.
  2.B Import from this package fresh_install.sql into your Database.(I recommend 
    STRONGLY Navicat for this purpose!!!!!)

2. Script Files.

  1.A Extract and Upload your Script thru FTP into your domain name's root public_html/www/htdocs, 
    whatever it is called on Ur server.

3. Configuration Files.
  3.A Main Settings Config: Edit the Config.php in the game's root theese lines:
                "server"        => "localhost", //MySQL server name. (Default: localhost)
  	"user"          => "", // MySQL username.
		"pass"          => "", // MySQL password.
		"name"          => "", // MySQL database name.
		"prefix"        => "wg_", // Prefix for table names. -> IT HAS TO BE WG!!!!!!!!!!!
		"secretword"    => "");


      NOTE: Secret word used when hashing information for cookies. It can be anyting but be Warned though, it HAS to be the same in the ADMIN config.php

   PREFIX HAS TO BE wg_ !!!!!!!!!!!!!!!!!! It IS important!!!!!

Save and close the file.

   3.B Optional - SMTP Server Setup(This is not ultimately necesarry, but recommended for mails.
       Open config_mailserver.php and edit your SMTP account and host.
		"smtp"        	=> "localhost",  //Hostname
		"user"          => "",  //Username for SMTP account
		"pass"          => "",  //Password for SMTP Account
		"admin_name"    => "Administrator", // Sender name
		"admin_email"   => "noreply@admin.com");  // Sender Email Adress

  

   3.C Admin Panel Setup.
       To be Honest its a Complicated one a bit, cut the steps are related with other steps in this tutorial.
       First off: The ADMIN directory. You can rename it whatever you want, and i do suggest you do that way.
       now, go in to the admin panel folder and open config.php there too.
       Edit theese lines too: 
		"server"        => "localhost", //MySQL server name. (Default: localhost)
		"user"          => "", // MySQL username.
		"pass"          => "", // GundamMySQL password.
		"name"          => "", // MySQL database name.
		"prefix"        => "", // Prefix for table names.
		"secretword"    => ""); // SAME AS CONFIG.php ABOVE!!!!!!!


      Secret word used when hashing information for cookies. It can be anyting        
      but be Warned though, it HAS to be the same in the MAIN config.php!!! Otherwise you will not able to log in!!! Save and close the file.

      open auth and soap directorys, look for files named(same name in this two folder) call.php and config_auth_remote.php, look for string called: localhost and change to your domain name all other things stays put; dont meddle with. Save all for files(2 in auth, 2 in soap folder)
     Save and close your files.


  3.D Setup game details: Edit common.php
      Check for lines:
      // Default timezone
      date_default_timezone_set("Europe/Vilnius"); // Edit to your Timezone.
      // Game start/end config Dates to game start and game end.
      $time_end   = strtotime('2013-11-10 23:59:00');
      $time_start = strtotime('2013-01-31 07:00:00');

       // Speed configuration, THIS is what makes the game values change, in the Database just a reference dont bother wit hthat.
       //100 Game, 100 Train, 100 Speed, 100 Research, 10 storage
       $speed = array(300,300,300,300,300);
       save and close the fila and now edit if U WANT constant_plus.php, constant_profile.php, constants.php files to suit your needs but i must point out: DONT TOUCH WHAT U DONT UNDERSTAND!!!


4. Language Settings. JUST FOR UNIX SYSTEMS, IN WAMP SYSTEMS JUMP THIS PART CUZ ON NTFS THIS DOES NOT MAKES SENSE JUST ON LAMP SYSTEMS!!!

      So there is a bug. After you uploaded everything, go and upload one language file one more time, BUT WITH THE       FIRST LETTER HIGH CAPITAL!!!! So go to Language/en/ and upload trade.mo one more time but with like this:
      Trade.mo <- notice there will be an other file with low capital too. like this: trade.mo
      you have to be 2 same file in one folder, like this:
      Trade.mo
      trade.mo

      It will fix a bug in the npc trader php language error. Move on to chapter 5.


5. Make your first admin. Well its not so Simple so.
   Administrator panel Default:
   Name Admin
   Pass 123456789abc

   If U make a player Called "Admin" the panel will work and let you in the data you provided above. The admin    panel by default it can be accessed: http://yourdomain/admin/index.php And login with the given pass and    username.

 5.A - If u want add an other user and/or change default user, go to your database's WG_ADMIN table, There you can rename your admin or add an other record. But be warned the password is encoded, so you will need copy the password hash from your account(auth table in db) into this column, and then you will able to log in with an other user.


6. Now, log in to your Admin cpanel(Make an admin if U cannot login) the admin banel basicly wrote out that Security Error but dont worry, it will redirect you to the panel where you can generate a new map, do that now, then log out, and this is important: ERASE ALL COOKIES FROM YOUR BROWSER!!!

7. Now you can login/Register and play.(Sometime if u delete the cookies, and try to login you have to do this twice. This is normal(somewhat XD))


8. "Bug":

If u cannot login(if the login is puts back to the index.php), ALWAYS delete ur browser's cache and cookiest (YOU HAVE TO DO THIS ALWAYS IF U ARE USING ADMIN PANEL!!!!!)

9. Note for the translators: 

   The language files if u want to translate mostly can found in language/en all files. but...
   NOT ALL! Other files can be found Templates/TravX/ ALL tpl files. The rest language thing is
   in this files.(and in the database in korean language)


Have Fun!
