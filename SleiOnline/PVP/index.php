<?php
require_once 'dbconnect.php';
$res=mysql_query("SELECT * FROM users WHERE userId=".$_SESSION['onlinegames']);
$gameRow=mysql_fetch_array($res);


$query = "INSERT INTO onlinegames(gamePlayer1,gamePLayer2,userPass) VALUES('$name','$email','$password')";
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Slei PVP</title>
    </head>
    <body>

        <input type="text" placeholder="Name">

        <br><hr><br>

        <input type="text" placeholder="ID">
        <button>Join</button>

        <br><hr><br>

        <button>Create Session</button>

        <br><hr><br>

        <button>Do 10 damage</button>
        <button>Do 0 damage</button>
        <p>Your Health: <span id="pHealth"><? echo $userRow['gamePlayer1']; ?></span></p>
        <p>Enemy Health: <span id="eHealth">100</span></p>
    </body>
</html>
