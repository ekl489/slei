<?php

ob_start();
session_start();
error_reporting(0);
require_once 'dbconnect.php';
// select loggedin users detail
$res=mysql_query("SELECT * FROM users WHERE userId=".$_SESSION['user']);
$userRow=mysql_fetch_array($res);

$error = false;

if ( isset($_POST['post']) ) {
    // clean user inputs to prevent sql injections
    $title = trim($_POST['title']);
    $title = strip_tags($title);
    $title = htmlspecialchars($title);
    
    $text = trim($_POST['text']);
    $text = strip_tags($text);
    $text = htmlspecialchars($text);
    
    $author = $userRow['userName'];
    
    // basic title validation
    if (empty($title)) {
        $error = true;
        $titleError = "Please enter something";
    } else if (strlen($title) < 3) {
        $error = true;
        $titleError = "Title must have at least 3 characters.";
    }
    // basic text validation
    if (empty($text)) {
        $error = true;
        $textError = "Please enter something";
    } else if (strlen($text) < 3) {
        $error = true;
        $textError = "Text must have at least 3 characters.";
    }

    // if there's no error, continue
    if( !$error ) {

        $query = "INSERT INTO posts(author,title,text) VALUES('$author','$title','$text')";
        $res = mysql_query($query);

        if ($res) {
            $errTyp = "success";
            $errMSG = "Successfully posted";
            unset($title);
            unset($author);
            unset($text);
            header("Location: index.php");
        } else {
            $errTyp = "danger";
            $errMSG = "Something went wrong, try again later..."; 
        } 

    }


}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="A sample template">
        <meta name="author" content="Nick Ramsay">

        <title><?php echo $title;?> Home</title>

        <!-- Latest compiled and minified Bootstrap -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

        <!-- Theme CSS -->
        <link href="css/styles.css" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Roboto+Slab" rel="stylesheet">
    </head>
    <body>
        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-custom navbar-fixed-top">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header page-scroll">
                    <a class="navbar-brand" href="index.html">EKL Home</a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">                    
                    <ul class="nav navbar-nav navbar-right">
                        <li style="float: right;"><?php 
                            if( isset($_SESSION['user'])!="" ) {
                                echo '
                                <div class="dropdown">
                                    <button class="btn btn-sm dropdown-toggle" type="button" data-toggle="dropdown">'.$userRow['userName'].'
                                    <span class="caret"></span></button>
                                    <ul class="dropdown-menu dropdown-menu-left">
                                        <li><a href="#">Settings</a></li>
                                        <li><a href="logout.php?logout">Logout</a></li>
                                    </ul>
                                </div>';
                            }
                            if( isset($_SESSION['user'])=="" ) {
                                echo '<a href="register.php">Register</a>';
                            }
                            ?>
                        </li>
                        <li><?php
                            if( isset($_SESSION['user'])=="" ) {
                                echo '<a href="login.php">Login</a> ';
                            }
                            ?>
                        </li>
                    </ul>
                </div>
                <!-- /.navbar-collapse -->
            </div>
            <!-- /.container -->
        </nav>

        <!-- Page Header -->
        <header class="intro-header demo-ribbon" style="background-image: url('img/header.jpg')">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                        <div class="site-heading">
                            <h1>EKL Home</h1>
                            <hr class="small">
                            <span class="subheading">By Nicholas Ramsay</span>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <?php if( isset($_SESSION['user'])!="" ) {?>
                        
                        <h2 class="post-title">Post something</h2>
                        <div class="form-group">
                            <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">
                                <input type="text" class="form-control" placeholder="Post Title" name="title" value="<?php echo $title; ?>">
                                <textarea class="form-control" rows="5" placeholder="Text goes here" name="text" value="<?php echo $text; ?>"></textarea>
                                <button type="submit" name="post" class="btn btn-sm">Post</button>
                            </form>
                        <hr>

                    <?php }?>
                    <!--Posts-->
                            <div id="">
                    <?php
                            
                                $query = "SELECT * FROM `posts` WHERE 1 ORDER BY id DESC";
                            $results=mysql_query($query);
                            $row_count=mysql_num_rows($results);
                            $row_posts = mysql_fetch_array($results);                        

                            while ($row_posts = mysql_fetch_array($results)) {
                                //output a row here
                                //echo 'Hello there!';
                                echo '<div class="post-preview"> <a href="#"> <h2 class="post-title">'.$row_posts['title'].' </h2><h3 class="post-subtitle">'.$row_posts['text'].'</h3></a><p class="post-meta">'.$row_posts['author'].'</p></div><hr>';
                            }   
                            
                    ?>  
                            </div>
                            
                            
                            
                    <div class="post-preview">
                        <a href="#">
                            <h2 class="post-title">
                                Why can't everyone be like me?
                            </h2>
                            <h3 class="post-subtitle">
                                I'm going to have to be honest with you guys, why can't everyone be like me? I mean seriously, I am pretty much perfect in every way. I'm beautiful, smart, strong; what can stop me?
                            </h3>
                        </a>
                        <p class="post-meta">Nick</p>
                    </div>
                    <hr>                
                </div>
            </div>
        </div>

        <hr>

        <!-- Footer -->
        <footer>
            <div class="container">                                                           
                <p class="copyright text-muted">Copyright &copy; Your Website 2016</p>                                    
            </div>
        </footer>   

        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="bootstrap/js/bootstrap.min.js"></script>
    </body>
</html>
<?php ob_end_flush(); ?>