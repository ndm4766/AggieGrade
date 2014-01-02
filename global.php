<?php
session_start();

# Configuration values
require_once("config.php");

function database() {
    global $config;
    $db = new PDO("mysql:host=localhost;port=3306;dbname=" . $config["db"]["dbname"], $config["db"]["username"], $config["db"]["password"]);
    return $db;
}

function heading($title = "NULL") {
?>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/favicon.png">

    <title><?=NAME?> v<?=VERSION?> :: <?=$title?></title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/signin.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
<?php
}

function footer() {
?>
    <div id="footer">
        <footer>
            <p><?=NAME?> - Created by <a href="http://github.com/solewolf">Keith Armstrong</a>, <a href="http://github.com/ndm4766">Nick Melynk</a>, and <a href="https://github.com/Tvkwoodlands">Thomas Klingshirn</a></p>
            <p class="text-muted">Full source available on <a href='https://github.com/solewolf/AggieGrade/'>Github</a></p>
        </footer>
    </div>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
<?php
}

function logo() {
?>
    <a href="index.php"><img id="logo" src="img/tamu.png"></a>
<?php
}

function random($mode, $length) {
    # RANDOM_DEFAULT
    if ($mode == 1) {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
    }
    # RANDOM_NUMERIC
    if ($mode == 2) {
        $chars = "1234567890";
    }
    # RANDOM_ALPHA
    if ($mode == 3) {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
    }
    # RANDOM_UPPER
    if ($mode == 4) {
        $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    }
    #RANDOM_LOWER
    if ($mode == 5) {
        $chars = "abcdefghijklmnopqrstuvwxyz";
    }
    # RANDOM_UPPERNUM
    if ($mode == 6) {
        $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
    }
    # RANDOM_LOWERNUM
    if ($mode == 7) {
        $chars = "abcdefghijklmnopqrstuvwxyz1234567890";
    }
    # RANDOM_EVERYTHING
    if ($mode == 8) {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890~!@#$%^&*()_+-=`{}[]\\|;':\",.<>/?";
    }

    for ($i = 0; $i < $length; $i++)
        $result.= $chars[rand(0, strlen($chars) - 1)];
    return $result;
}
?>