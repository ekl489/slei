<?php
ob_start();
session_start();
require_once 'dbconnect.php';
if( isset($_SESSION['user'])!="" ){
    header("Location: index.php");
}
$error = false;

if( isset($_POST['btn-login']) ) {

    // prevent sql injections/ clear user invalid inputs
    $email = trim($_POST['email']);
    $email = strip_tags($email);
    $email = htmlspecialchars($email);

    $pass = trim($_POST['pass']);
    $pass = strip_tags($pass);
    $pass = htmlspecialchars($pass);
    // prevent sql injections / clear user invalid inputs

    if(empty($email)){
        $error = true;
        $emailError = "Please enter your email address.";
    } else if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
        $error = true;
        $emailError = "Please enter valid email address.";
    }

    if(empty($pass)){
        $error = true;
        $passError = "Please enter your password.";
    }

    // if there's no error, continue to login
    if (!$error) {

        $password = hash('sha256', $pass); // password hashing using SHA256

        $res=mysql_query("SELECT userId, userName, userPass FROM users WHERE userEmail='$email'");
        $row=mysql_fetch_array($res);
        $count = mysql_num_rows($res); // if uname/pass correct it returns must be 1 row

        if( $count == 1 && $row['userPass']==$password ) {
            $_SESSION['user'] = $row['userId'];
            header("Location: index.php");
        } else {
            $errMSG = "Incorrect Credentials, Try again...";
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

        <title><?php echo $title;?> Login</title>

        <!-- Latest compiled and minified Bootstrap -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

        <!-- Theme CSS -->
        <link href="css/styles.css" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Roboto+Slab" rel="stylesheet">
    </head>
    <body>
        <!-- Main Content -->
        <div class="container">
            <div id="login-form">
                <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">
                    <div class="col-md-12">
                        <div class="form-group">
                            <h2 class="">Sign In.</h2>
                        </div>

                        <div class="form-group">
                            <hr/>
                        </div>

                        <?php
                        if ( isset($errMSG) ) {

                        ?>
                        <div class="form-group">
                            <div class="alert alert-danger">
                                <?php echo $errMSG; ?>
                            </div>
                        </div>
                        <?php
                        }
                        ?>

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
                                <input type="email" name="email" class="form-control" placeholder="Your Email" value="<?php echo $email; ?>" maxlength="40" />
                            </div>
                            <span class="text-danger"><?php echo $emailError; ?></span>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                                <input type="password" name="pass" class="form-control" placeholder="Your Password" maxlength="15" />
                            </div>
                            <span class="text-danger"><?php echo $passError; ?></span>
                        </div>

                        <div class="form-group">
                            <hr />
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-block btn-primary" name="btn-login">Sign In</button>
                        </div>

                        <div class="form-group">
                            <hr />
                        </div>

                        <div class="form-group">
                            <a href="register.php">Register an account</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </body>
</html>
