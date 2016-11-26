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
        <link href="http://fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet" type="text/css">
    </head>
    <body>
        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-custom navbar-fixed-top">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header page-scroll">
                    <a class="navbar-brand" href="index.html">Slei Online</a>
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
        </nav><br><br>

        <!-- Main Content -->
        <div class="container-fluid main-content">
            <div class="row main-content-row">
                <div class="statistics-menu col-md-10">
                    <div class="panel panel-primary">
                        <div class="panel-heading">Stats</div>
                        <div class="panel-body">
                           <div class="row">
                            <div class="progress col-md-12">
                        <div class="progress-bar progress-bar-success" style="width: 80%">
                            <span>80% Win</span>
                        </div>
                        <div class="progress-bar progress-bar-warning progress-bar-striped" style="width: 0%">
                            <span>sgdsgsdgsdg</span>
                        </div>
                        <div class="progress-bar progress-bar-danger" style="width: 20%">
                            <span>20% Loss</span>
                        </div>
                    </div>
                            <div class="col-lg-4 col-md-12">
                        <div class="panel panel-success">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <span class="glyphicon glyphicon-flag glyphicon-big"></span>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><h3>26</h3></div>
                                        <div>Wins</div>
                                    </div>
                                </div>
                            </div>
                        </div>
    </div>
                            <div class="col-lg-4 col-md-12">
                                <div class="panel panel-danger">
                                    <div class="panel-heading">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <span class="glyphicon glyphicon-remove glyphicon-big"></span>
                                            </div>
                                            <div class="col-xs-9 text-right">
                                                <div class="huge"><h3>4</h3></div>
                                                <div>Losses</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-12">
                                <div class="panel panel-info">
                                    <div class="panel-heading">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <span class="glyphicon glyphicon-play-circle glyphicon-big"></span>
                                            </div>
                                            <div class="col-xs-9 text-right">
                                                <div class="huge"><h3>30</h3></div>
                                                <div>Games</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="community-menu panel panel-primary">
                        <div class="panel-heading">Community</div>
                        <div class="panel-body">
                            <ul class="community-menu-list">
                                <li>
                                    <button class="btn btn-warning" type="button">
                                        DJMuffins <span class="badge">4</span>
                                    </button>
                                </li>
                                <li>
                                    <button class="btn btn-warning" type="button">
                                        G.E.W.P Lotso <span class="badge">4</span>
                                    </button>
                                </li>
                                <li>
                                    <button class="btn btn-warning" type="button">
                                        333ramPage333 <span class="badge">4</span>
                                    </button>
                                </li>
                                <li>
                                    <button class="btn btn-warning" type="button">
                                        clevercat <span class="badge">4</span>
                                    </button>
                                </li>
                                <li>
                                    <button class="btn btn-warning" type="button">
                                        CheeckyCookies <span class="badge">4</span>
                                    </button>
                                </li>
                                <li>
                                    <button class="btn btn-warning" type="button">
                                        CheeckyCookies <span class="badge">4</span>
                                    </button>
                                </li>
                                <li>
                                    <button class="btn btn-warning" type="button">
                                        panda101 <span class="badge">4</span>
                                    </button>
                                </li>
                                <li>
                                    <button class="btn btn-warning" type="button">
                                        yurmum53254 <span class="badge">4</span>
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <hr>

        <!-- Footer -->
        <footer>
            <div class="container">
                <p class="copyright text-muted">Copyright &copy; Slei Online 2016</p>
            </div>
        </footer>

        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="bootstrap/js/bootstrap.min.js"></script>
    </body>
</html>
<?php ob_end_flush(); ?>
