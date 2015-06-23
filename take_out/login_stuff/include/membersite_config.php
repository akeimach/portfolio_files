<?PHP
require_once("./include/fg_membersite.php");

$fgmembersite = new FGMembersite();

//Provide your site name here
$fgmembersite->SetWebsiteName('aksite-env.elasticbeanstalk.com/');

//Provide the email address where you want to get notifications
$fgmembersite->SetAdminEmail('alyssakeimach@gmail.com');

//Provide your database login details here:
//hostname, user name, password, database name and table name
//note that the script will create the table (for example, fgusers in this case)
//by itself on submitting register.php for the first time
$fgmembersite->InitDB(/*hostname*/'aa1diu7vrd5d8v.ciacvodjbmo9.us-west-2.rds.amazonaws.com',                      /*username*/'aksiteadmin',
                      /*password*/'projectpass',
                      /*database name*/'ebdb',
                      /*table name*/'login_data');

//For better security. Get a random string from this link: http://tinyurl.com/randstr
// and put it here
$fgmembersite->SetRandomKey('qSRcVS6DrTzrPvr');

?>
