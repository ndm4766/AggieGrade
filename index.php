<?php
require_once("global.php");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?=heading("Home")?>
    </head>
    <body>
        <div class="container">
            <?=logo()?>
            <form class="form-signin" role="form" action="login.php" method="POST">
                <h2 class="form-signin-heading">Login to AggieGrade</h2>
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Username" required autofocus>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" placeholder="Password" required>
                </div>
                <div align='center'>
                    <input type="submit" class="btn btn-primary" value="Login">&nbsp;<input type="button" onClick="window.location='register.php'" class="btn btn-success" value="Register &raquo">
                </div>
            </form>
        </div>
    <?=footer()?>
  </body>
</html>
