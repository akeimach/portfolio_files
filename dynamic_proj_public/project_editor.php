<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
		"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Project Editor</title>
<style type="text/css">
	hr.pme-hr		     { border: 0px solid; padding: 0px; margin: 0px; border-top-width: 1px; height: 1px; }
	table.pme-main 	     { border: #004d9c 1px solid; border-collapse: collapse; border-spacing: 0px; width: 100%; }
	table.pme-navigation { border: #004d9c 0px solid; border-collapse: collapse; border-spacing: 0px; width: 100%; }
	td.pme-navigation-0, td.pme-navigation-1 { white-space: nowrap; }
	th.pme-header	     { border: #004d9c 1px solid; padding: 4px; background: #add8e6; }
	td.pme-key-0, td.pme-value-0, td.pme-help-0, td.pme-navigation-0, td.pme-cell-0,
	td.pme-key-1, td.pme-value-1, td.pme-help-0, td.pme-navigation-1, td.pme-cell-1,
	td.pme-sortinfo, td.pme-filter { border: #004d9c 1px solid; padding: 3px; }
	td.pme-buttons { text-align: left;   }
	td.pme-message { text-align: center; }
	td.pme-stats   { text-align: right;  }
</style>
</head>
<body>
<h3>Project Editor</h3>
<?php

// MySQL host name, user name, password, database, and table
$opts['hn'] = '';
$opts['un'] = '';
$opts['pw'] = '';
$opts['db'] = '';
$opts['tb'] = '';

// Name of field which is the unique key
$opts['key'] = 'full_title';

// Type of key field (int/real/string/date etc.)
$opts['key_type'] = 'string';

// Sorting field(s)
$opts['sort_field'] = array('full_title');

// Number of records to display on the screen
// Value of -1 lists all records in a table
$opts['inc'] = 15;

// Options you wish to give the users
// A - add,  C - change, P - copy, V - view, D - delete,
// F - filter, I - initial sort suppressed
$opts['options'] = 'ACPVDF';

// Number of lines to display on multiple selection filters
$opts['multiple'] = '4';

// Navigation style: B - buttons (default), T - text links, G - graphic links
// Buttons position: U - up, D - down (default)
$opts['navigation'] = 'DB';

// Display special page elements
$opts['display'] = array(
	'form'  => true,
	'query' => true,
	'sort'  => true,
	'time'  => true,
	'tabs'  => true
);

// Set default prefixes for variables
$opts['js']['prefix']               = 'PME_js_';
$opts['dhtml']['prefix']            = 'PME_dhtml_';
$opts['cgi']['prefix']['operation'] = 'PME_op_';
$opts['cgi']['prefix']['sys']       = 'PME_sys_';
$opts['cgi']['prefix']['data']      = 'PME_data_';

/* Get the user's default language and use it if possible or you can
   specify particular one you want to use. Refer to official documentation
   for list of available languages. */
$opts['language'] = $_SERVER['HTTP_ACCEPT_LANGUAGE'] . '-UTF8';


$opts['fdd']['proj'] = array(
  'name'     => 'Proj',
  'select'   => 'T',
  'maxlen'   => 100,
  'sort'     => true
);
$opts['fdd']['timein'] = array(
  'name'     => 'Timein',
  'select'   => 'T',
  'options'  => 'AVCPDR', // updated automatically (MySQL feature)
  'maxlen'   => 19,
  'default'  => 'CURRENT_TIMESTAMP',
  'sort'     => true
);
$opts['fdd']['full_title'] = array(
  'name'     => 'Full title',
  'select'   => 'T',
  'maxlen'   => 100,
  'sort'     => true
);
$opts['fdd']['subtitle'] = array(
  'name'     => 'Subtitle',
  'select'   => 'T',
  'maxlen'   => 65535,
  'textarea' => array(
    'rows' => 5,
    'cols' => 50),
  'sort'     => true
);
$opts['fdd']['summary'] = array(
  'name'     => 'Summary',
  'select'   => 'T',
  'maxlen'   => 65535,
  'textarea' => array(
    'rows' => 5,
    'cols' => 50),
  'sort'     => true
);
$opts['fdd']['proj_link'] = array(
  'name'     => 'Proj link',
  'select'   => 'T',
  'maxlen'   => 2083,
  'sort'     => true
);
$opts['fdd']['curr_tag'] = array(
  'name'     => 'Curr tag',
  'select'   => 'T',
  'maxlen'   => 1,
  'sort'     => true
);

// Now important call to phpMyEdit
require_once 'phpMyEdit.class.php';
new phpMyEdit($opts);

?>


</body>
</html>
