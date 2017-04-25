<?php

$debug = TRUE;

// Assumes doc root is /var/www/html . "secrets" directory out of scope, safe to house database credentials.  
$d = '/var/www/secrets/';
require_once("$d/config.php"); 

require_once("addr_class.php");

$ac = new addr_class();

// Determine dev vs. prod environment
$host = gethostname();

switch ($host) {

case 'ip-10-1-0-100':
  $host = 'prod.production_server';
  $db = 'c1';
  break;

case "ip-10-0-0-200":
  $host = 'dev.development_server';
  $db = 'c2';
  break;

default:
  echo "Where are you anyway?  No database here.";
  exit;

}

// Database hookup
$user = DB_USER;
$pass= DB_PASS;
$charset = 'utf8';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

$opt = [
 PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
 PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
 PDO::ATTR_EMULATE_PREPARES => false
];


try{
 $dbh = new PDO($dsn, $user, $pass, $opt);
}  catch (PDOException $e) {
        echo 'Connection failure: ' . $e->getMessage();
   }



$csv = array_map('str_getcsv',file('data.csv'));

$n=0;

$parsed_addr = array();
foreach($csv as $line){
  $parsed_addr = $ac -> addrswitch(trim($line[1]));
  print_r($parsed_addr);  
  // Database insertion goes in here. Be sure to test!
  //$db_stmt = $dbh->prepare("INSERT INTO ...VALUES ...  ");
  //...
  $n++;
}


?>