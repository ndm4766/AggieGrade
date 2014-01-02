<?php
define(NAME, "AggieGrade");
define(VERSION, "0.1 Beta");

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
?>