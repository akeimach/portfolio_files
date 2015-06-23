
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
<html lang="en">

<?php include "header.php"; ?>



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
                        <a class="page-scroll" href="#current">Current Projects</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#past">Past Projects</a>
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
                        <h1 class="brand-heading"><a href="http://www.eecs.umich.edu/db/">Database Systems</a>      </h1>
                        <p class="intro-text">Projects Page<br><a href="http://web.eecs.umich.edu/~mozafari/">Barzan Mozafari</a></p>
                        <a href="#current" class="btn btn-circle page-scroll">
                            <i class="fa fa-angle-double-down animated"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- current projects Section -->
    <section id="current" class="container content-section">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <h2>Current Projects</h2>




<?php
$query = "SELECT * FROM project WHERE project.curr_tag = 1 ORDER BY project.timein DESC";
$result = mysql_query($query);

while ($row = mysql_fetch_assoc($result)) {

    echo '<p><a href="#'.$row['proj_link'].'">'.$row['full_title'];
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
    
    echo '<p><font size="3"><br>'.$row['summary'].'</p>';

    $news_query = "SELECT * FROM news WHERE proj = '".$row['proj']."' ORDER BY timein DESC";
    $news_result = mysql_query($news_query);

    while ($news_row = mysql_fetch_assoc($news_result)) {
        
        echo '<p><font size="2"><font color="#A1D8C4">News: '.$news_row['headline'].'</font><br>'.$news_row['description'].'</font></p>';
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
   
        echo '<b><a href="'.$pub_row['pub_link'].'">'.$pub_row['title'].'. </b></font></a>'.$pub_row['cite'].'</p>';

    }
} 


?>








            </div>
        </div>
    </section>





    <!-- past projects Section -->
    <section id="past" class="container content-section">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <h2>Past Projects</h2>




<?php
$query = "SELECT * FROM project WHERE project.curr_tag = 0 ORDER BY project.timein DESC";
$result = mysql_query($query);

while ($row = mysql_fetch_assoc($result)) {

   echo '<p><a href="#'.$row['proj_link'].'">'.$row['full_title'];
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
    
    echo '<p><font size="3"><br>'.$row['summary'].'</p>';

    $news_query = "SELECT * FROM news WHERE proj = '".$row['proj']."' ORDER BY timein DESC";
    $news_result = mysql_query($news_query);

    while ($news_row = mysql_fetch_assoc($news_result)) {
        
        echo '<p><font size="2"><font color="#A1D8C4">News: '.$news_row['headline'].'</font><br>'.$news_row['description'].'</font></p>';
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
   
        echo '<b><a href="'.$pub_row['pub_link'].'">'.$pub_row['title'].'. </b></font></a>'.$pub_row['cite'].'</p>';

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
                <p>Barzan Mozafari is an Assistant Professor of Computer Science and Engineering at the <a href="http://umich.edu/">University Of Michigan</a>. He studies databases, distributed systems, and large-scale data-intensive systems.</p>
                <p><a href="login.php">Admin Portal</a>
                </p>
            </div>
        </div>
    </section>

  
    <!-- Footer -->
    <footer>
        <div class="container text-center">
           
            <p>By Alyssa Keimach</p>
     <p>Created with Bootstrap</p>
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
