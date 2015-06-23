<?php 
session_start();
//connection to projects database
$user = '';
$password = '';
$db = '';
$host = '';
$port = 3306;
$link = mysql_connect("$host:$port", $user, $password);
if(! $link ) { die('Could not connect: '.mysql_error()); }
$db_selected = mysql_select_db($db, $link);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>alyssakeimach.net | Articles</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/grayscale.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
</head>
<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">

    <!-- Navigation -->
    <nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand page-scroll" href="#page-top">
                    <i class="fa fa-play-circle"></i>  <span class="light">TOP</span>
                </a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
                <ul class="nav navbar-nav">
                    <!-- Hidden li included to remove active class from about link when scrolled up past about section -->
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#astronomy">Astronomy</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#other">Other Works</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#contact">Contact</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Intro Header -->
    <header class="intro">
        <div class="intro-body">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <h1 class="brand-heading">Article Database</h1>
                        <p class="intro-text"><br><a href="http://alyssakeimach.net/">Alyssa Keimach</a></p>
                        <a href="#astronomy" class="btn btn-circle page-scroll">
                            <i class="fa fa-angle-double-down animated"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- astro Section -->
    <section id="astronomy" class="container content-section">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <h2>Astronomy</h2>

<?php
$query = "SELECT * FROM project WHERE project.curr_tag = 1 ORDER BY project.timein DESC";
$result = mysql_query($query);

while ($row = mysql_fetch_assoc($result)) {

    echo '<p><a href="'.$row['proj_link'].'">'.$row['full_title'];
    if ($row['subtitle']) { echo ': '.$row['subtitle'].'</a></p>'; }
    else { echo '</a></p>'; }

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
    
    echo '<div class="data"><p><font size="3">'.$row['summary'].'</font></p></div>';

    $news_query = "SELECT * FROM news WHERE proj = '".$row['proj']."' ORDER BY timein DESC";
    $news_result = mysql_query($news_query);

    while ($news_row = mysql_fetch_assoc($news_result)) {
        
        echo '<div class="data"><p><font size="2"><font color="#A1D8C4">'.$news_row['headline'].' </font>'.$news_row['description'].'</font></p></div>';
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
        echo '<p><b><a href="'.$pub_row['pub_link'].'">'.$pub_row['title'].'. </b></a>'.$pub_row['cite'].'</p>';
    }
} 
?>

            </div>
        </div>
    </section>

    <!-- other articles Section -->
    <section id="other" class="container content-section">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <h2>Other Works</h2>
<?php
$query = "SELECT * FROM project WHERE project.curr_tag = 0 ORDER BY project.timein DESC";
$result = mysql_query($query);

while ($row = mysql_fetch_assoc($result)) {

    echo '<p><a href="'.$row['proj_link'].'">'.$row['full_title'];
    if ($row['subtitle']) { echo ': '.$row['subtitle'].'</a></p>'; }
    else { echo '</a></p>'; }

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
    
    echo '<div class="data"><p><font size="3">'.$row['summary'].'</font></p></div>';

    $news_query = "SELECT * FROM news WHERE proj = '".$row['proj']."' ORDER BY timein DESC";
    $news_result = mysql_query($news_query);

    while ($news_row = mysql_fetch_assoc($news_result)) {
        
        echo '<div class="data"><p><font size="2"><font color="#A1D8C4">'.$news_row['headline'].' </font>'.$news_row['description'].'</font></p></div>';
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
        echo '<p><b><a href="'.$pub_row['pub_link'].'">'.$pub_row['title'].'. </b></a>'.$pub_row['cite'].'</p>';
    }
} 
?>
            </div>
        </div>
    </section>

    <!-- Admin Section -->
    <section id="contact" class="container content-section text-center">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <p>Alyssa Keimach is a student at the <a href="http://umich.edu/">University Of Michigan</a>. This dynamic website connects to a database storing articles she wrote for <a href="http://www.calacademy.org/explore-science/science-today">Science Today</a> while she was working at the <a href="http://www.calacademy.org/">California Academy of Sciences</a>. View the database through the admin portal.</p>
                <p><a href="editor_home.php">Admin Portal</a>
                </p>
            </div>
        </div>
    </section>

  
    <!-- Footer -->
    <footer>
        <div class="container text-center">
           
            <p>By Alyssa Keimach</p>
           </div>
    </footer>

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="js/jquery.easing.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="js/grayscale.js"></script>

</body>

</html>
