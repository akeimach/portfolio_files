<?php 
session_start();
?>

<?php
//connection to projects database
$user = 'aksiteadmin';
$password = 'projectpass';
$db = 'ebdb';
$host = 'aa1diu7vrd5d8v.ciacvodjbmo9.us-west-2.rds.amazonaws.com';
$port = 3306;

$link = mysql_connect("$host:$port", $user, $password);

if(! $link ) { die('Could not connect: '.mysql_error()); }

$db_selected = mysql_select_db($db, $link);
?>

<!DOCTYPE html>
<html>
<head>

<link href="css/bootstrap.css" rel="stylesheet">

</head>

<form action="login.php" target="_blank" action="post">
<input name="newThread" type="submit" value="Admin" />
</form>

<body data-spy="scroll" data-target=".sidenav">
    <div id="msbnav" class="navbar navbar-inverse navbar-static-top">
        <div class="navbar-inner">
            <div class="container">
                <a class="brand" href="http://web.eecs.umich.edu/~mozafari/">Barzan Mozafari</a>
                <span class="brand" style="padding-left: 0px; padding-right: 0px;">&nbsp;&middot;&nbsp;</span>
                <a class="brand" href="http://umich.edu/">University Of Michigan</a>
                <span class="brand" style="padding-left: 0px; padding-right: 0px;">&nbsp;&middot;&nbsp;</span>
                <a class="brand" href="http://www.eecs.umich.edu/db/">Database Systems</a>
            </div>
        </div>
    </div>
    <div class="container">    
        <div class="row">
            <div class="span9">
                <h1>Current Projects</h1>
                <ul>

<?php
$query = "SELECT * FROM project WHERE project.curr_tag = 1 ORDER BY project.timein DESC";
$result = mysql_query($query);

while ($row = mysql_fetch_assoc($result)) {
    echo '<li><a href="#'.$row['proj'].'"><b>'.$row['display_title'];
    if ($row['subtitle']) { echo ':</b> '.$row['subtitle'].'</a></li><br>'; }
    else { echo '</b></a></li><br>'; }
}
?>

 </ul>
 <h1>Past Projects</h1>
  <ul>

<?php
$query = "SELECT * FROM project WHERE project.curr_tag = 0 ORDER BY project.timein DESC";
$result = mysql_query($query);

while ($row = mysql_fetch_assoc($result)) {
    echo '<li><a href="#'.$row['proj'].'"><b>'.$row['display_title'];
    if ($row['subtitle']) { echo ':</b> '.$row['subtitle'].'</a></li><br>'; }
    else { echo '</b></a></li><br>'; }
}
?>
 </ul>


<?php 
$query = "SELECT proj, full_title, summary, proj_link FROM project ORDER BY timein DESC";
$result = mysql_query($query);

while ($row = mysql_fetch_assoc($result)) {    

    if ($row['proj_link'] == '') {     
        echo '<h2><p style="line-height: 200%;"><a name="'.$row['proj'].'"><b><font size="6" face="Arial">'.$row['full_title'].'</font></a></p></h2></b>'; 
    }
    else {
        echo '<h2><p style="line-height: 200%;"><a name="'.$row['proj'].'"><b><font size="6" face="Arial"><a href="'.$row['proj_link'].'">'.$row['full_title'].'</a></font></a></p></h2></b>';
    }
   
    $collab_query = "SELECT * FROM (SELECT nid FROM collaborators WHERE proj = '".$row['proj']."' ORDER BY collab_order ASC) collab, people WHERE collab.nid = people.nid"; 
    $collab_result = mysql_query($collab_query);
    $num_rows = mysql_num_rows($collab_result);
    if ($num_rows > 0) {
        echo '<b>People:</b>';
        while ($collab_row = mysql_fetch_assoc($collab_result)) {        
            echo ' '.$collab_row['first_name'].' '.$collab_row['last_name'];
            $num_rows -= 1;
            if ($num_rows > 0) { echo ','; }
       }
    }
    
    echo '<p><br>'.$row['summary'].'</p>';

    $news_query = "SELECT * FROM news WHERE proj = '".$row['proj']."' ORDER BY timein DESC";
    $news_result = mysql_query($news_query);

    while ($news_row = mysql_fetch_assoc($news_result)) {
        
        echo '<p><font color="red"><b>News: '.$news_row['headline'].'</b></font><br>'.$news_row['description'].'</p>';
    }

    $pub_query = "SELECT title, cite, pub_link FROM publications WHERE proj = '".$row['proj']."' ORDER BY timein DESC";
    $pub_result = mysql_query($pub_query);

    while ($pub_row = mysql_fetch_assoc($pub_result)) {
    
        $author_query = "SELECT * FROM (SELECT nid FROM coauthors WHERE title = '".$pub_row['title']."' ORDER BY author_order ASC) collab, people WHERE collab.nid = people.nid";
        $author_result = mysql_query($author_query);
        $num_rows = mysql_num_rows($author_result);
   
        while ($author_row = mysql_fetch_assoc($author_result)) {
             echo ' '.$author_row['first_name'].' '.$author_row['last_name'];
            $num_rows -= 1;
             if ($num_rows > 0) { echo ','; }
             else { echo '. '; }
       }
   
        echo '<b><font size="2" face="Arial"><a href="'.$pub_row['pub_link'].'">'.$pub_row['title'].'. </b></font></a>'.$pub_row['cite'].'</p>';

    }


} 







?>




            </ul>
        </div> <!-- /row -->
    </div> <!-- /container -->  

    <!-- ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <script src="js/bootstrap.min.js"></script>
    
    <script type="text/javascript">
      var _gaq = _gaq || [];
      _gaq.push(['_setAccount', 'UA-35737485-1']);
      _gaq.push(['_trackPageview']);
    
      (function() {
        var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
      })();
    </script>     
</body>
</html>


