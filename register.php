<?php
require_once("global.php");
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
                    <input type="text" class="form-control" name="uin" placeholder="UIN" maxlength="9" required autofocus>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="key" placeholder="Enrollment Key" maxlength="5" required>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="username" placeholder="Username" required>
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
