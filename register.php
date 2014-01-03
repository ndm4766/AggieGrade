<?php
require_once("global.php");

if ($_POST != null) {
    echo validNetID($_POST['first'], $_POST['last'], $_POST['NetID']);
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?=heading("Register")?>
    </head>
    <body>
        <div class="container">
            <?=logo()?>
            <form class="form-signin" role="form" action="register.php" method="POST">
                <h2 class="form-signin-heading">Register to AggieGrade</h2>
                <div class="form-group">
                    <input type="text" class="form-control" name="NetID" placeholder="NetID - This will be your username" required autofocus>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="first" placeholder="First Name" required>
                    <input type="text" class="form-control" name="last" placeholder="Last Name" required>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name="password" placeholder="Password" required>
                    <input type="password" class="form-control" name="verify" placeholder="Verify Password" required>
                </div>
                <div align='center'>
                    <input type="button" class="btn btn-primary" onClick="window.location='index.php'" value="&laquo Home">&nbsp;<input type="submit" class="btn btn-success" value="Submit">
                </div>
            </form>
        </div>
    <?=footer()?>
  </body>
</html>
