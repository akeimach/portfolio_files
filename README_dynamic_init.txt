# portfolio
files for personal website
Using 
# dynamic_proj_website
Dynamic website to display current and past projects in MySQL database
Screening project for database research job at University of Michigan
Table holds data for projects done by professor Barzan Mozafari

To get connected to aws database enter info:
membersite_config.php
SetWebsiteName()
SetAdminEmail()
InitDB(hostname, username, password, database name, table name)

*_editor.php
$opts['hn'] = 'mySQL host name';
$opts['un'] = 'user name';
$opts['pw'] = 'password';
$opts['db'] = 'database name';
$opts['tb'] = 'specific table';

index.php
$user = '';
$password = '';
$db = '';
$host = '';
$port = 3306;