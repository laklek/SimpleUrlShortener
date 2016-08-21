<?php

$dbHost = "localhost";
$dbUser = "root";
$dbPass = "";
$dbName = "";

$mysqli = new mysqli($dbHost, $dbUser, $dbPass, $dbName); //connect to the MySQL remote server using the improved MySQL wrapper. Syntax: $host, $username, $pass, $db


$shortUrl = $_GET['u']; // $_GET['u'] returns the full path without the protocol (http, https) so we'll have to remove that

if($shortUrl) {

    $longUrl = getLongUrl($shortUrl);
    if (!$longUrl) {
        header("Location: /"); //invalid short url, returning to home page.
        exit; //Prevent the script from executing further if somehow client blocked redirects.
    }

    header("Location: " . $longUrl);  //Redirect to longer Url. You could implement a check here but I don't want to cause I want to use
    exit;                           //custom host names like http://workstation or ftp://myPi. Not recommended to use this for public use.

}elseif($_GET['short']||$_GET['long']){
    die(registerShortUrl($_GET['short'], $_GET['long'])); //Both GET and POST support
}elseif($_POST['short']||$_POST['long']) {
    die(registerShortUrl($_POST['short'], $_POST['long']));
}elseif($_GET["del"]){
    die(unRegister($_GET["del"]));
}elseif($_POST["del"]){
    die(unRegister($_POST["del"]));
}else{
    header("Location: /"); //You're drunk, go home.
    exit;
}

function registerShortUrl($short, $long){
    global $mysqli;

    if(strlen($short) > 0 && strlen($long) > 0){

    $mysqlLongUrlQry = $mysqli->query("SELECT * FROM short WHERE shortUrl='$short'");
    if ($mysqlLongUrlQry->num_rows == 0) {
        if($mysqli->query("INSERT INTO `short` (`shortUrl`, `longUrl`) VALUES ('$short', '$long')")){
            return "ok";
        }else{
            return "Error while inserting.";
        }
    }else{
        $longUrl = getLongUrl($short);
        return "Error: $short already taken. Points to: <a href=" . '"' . $longUrl . '"' . ">$longUrl</a> .";
    }
    }else{
        return "Please fill both the short and long URL in.";
    }
}

function unRegister($short){
    global $mysqli;

    $mysqlDelQry = $mysqli->query("DELETE FROM short WHERE shortUrl='$short'");
    if($mysqlDelQry === false){
        return "An error occurred.";
    }else{
        return "ok";
    }
}

function getLongUrl($short){
    global $mysqli;

    $mysqlLongUrlQry = $mysqli->query("SELECT * FROM short WHERE shortUrl='$short'");
    if ($mysqlLongUrlQry->num_rows == 0) {
        return false;
    }else{
        $longUrl = $mysqlLongUrlQry->fetch_assoc()["longUrl"];
        return $longUrl;
    }
}

function addHttp($url) { //making sure it's an absolute path
    if (!preg_match("/[a-zA-Z]+:\/\//", $url)) {
        $url = "http://" . $url;
    }
    return $url;
}
