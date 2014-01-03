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

function logo() {
?>
    <a href="index.php"><img id="logo" src="img/tamu.png"></a>
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

function userExists($username) {
    $db = database();
    $statement = $db->prepare("SELECT username FROM aggie_user WHERE username = ?");
    $statement->execute(array($username));

    if ($statement->rowCount()) {
        return 1;
    }
    return 0;
}

function addUser($username, $password, $perm = 1) {
    $db = database();
    $statement = $db->prepare("INSERT INTO aggie_user (`username`, `password`, `salt`, `enrollment_key`, `joined`, `perm`) VALUES (?,?,?,?,?,?,?)");
    $salt = random(8, 10);
    $password = md5(md5($password) . md5($salt));
    $statement->execute(array($username, $password, $salt, random(7,5), time(), $perm));

    // Add action
    $user = getUserInfo($username);
    addAction($user->id, 1);
}

function extractData($data, $search, $ending, $specific = -1) {
    $matches = findall($search, $data);
    foreach ($matches as &$val) {
        $offset = 0;
        $val += strlen($search);
        while (substr($data, $val+$offset, strlen($ending)) != $ending) {
            $offset++;
        }
        $val = substr($data, $val, $offset);
    }
    if ($matches == false) {
        return "Error, no matches found.";
    }

    if ($specific == -1) {
        if (count($matches) == 1) {
            return $matches[0];
        }
        return $matches;
    }
    return $matches[$specific-1];
}

// Function I found online
// Rewrote it to look nicer (so many comments in the last version!)
function findall($needle, $haystack) { 
    $buffer = '';
    $pos = 0;
    $end = strlen($haystack);
    $getchar = '';
    $needlelen = strlen($needle); 
    $found = array();
    
    while ($pos < $end) { 
        $getchar = substr($haystack, $pos, 1);
        if ($getchar != "\\n" || $buffer < $needlelen) { 
            $buffer = $buffer . $getchar;
            if (strlen($buffer) > $needlelen) { 
                $buffer = substr($buffer, -$needlelen);
            }
            if ($buffer == $needle) { 
                $found[] = $pos - $needlelen + 1;
            } 
        } 
        $pos++;
    } 
    if (array_key_exists(0, $found)) { 
        return $found;
    }
    return false;
}

function validNetID($first, $last, $id) {
    $data = file_get_contents("https://services.tamu.edu/directory-search/?branch=people&cn=" . $first . "+" . $last);
    $results = extractData($data, '<a href="/directory-search/people/', '/">');

    if (!is_array($results)) {
        $results = array($results);
    }
    foreach ($results as $result) {
        $data = file_get_contents("https://services.tamu.edu/directory-search/people/" . $result . "/");
        $name = extractData($data, "<th>Name:</th>\n        <td>", "</td>");
        $netid = extractData($data, "<th>Email Address:</th>\n        <td><a href=\"mailto:", "@");
        if ($netid != "Error, no matches found.") {
            $ids[] = $netid;
        }
    }
    if (in_array($id, $ids)) {
        return 1;
    }
    return 0;
}
?>