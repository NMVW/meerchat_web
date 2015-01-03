<?php

ini_set('upload_max_filesize', '10M');
ini_set('post_max_size', '10M');
ini_set('max_input_time', 300);
ini_set('max_execution_time', 300);



$uploaddir = '/var/www/html/userPosts/';
$uploadfile = $uploaddir . sprintf("'%s'_post_'%s'_'%s'_'%s'_1.mp4",
 mysql_real_escape_string($_POST["UIDr"]),
 mysql_real_escape_string($_POST["at_tag"]),
 mysql_real_escape_string($_POST["hash_tag"]),
 mysql_real_escape_string($_POST["category"]));


echo basename($_FILES['userfile']['name']);

print_r($_FILES);



echo $uploadfile;
echo "\n";




$myFile = "/var/www/html/userPosts/testFile.txt";
$fh = fopen($myFile, 'w') or die("can't open file");
fwrite($fh, $sql);

foreach ($_POST as &$value) {
fwrite($fh, $value);
    fwrite($fh, "\n");
}

fclose($fh);

  if( $_POST["UIDr"] && $_POST["at_tag"]  && $_POST["hash_tag"]  && $_POST["category"]  && $_POST["GPSLat"]  && $_POST["GPSLon"] )
  {

    $dbhost = 'localhost:3036';
    $dbuser = 'bafituser';
    $dbpass = 'bafit12pw';
    $conn = mysql_connect($dbhost, $dbuser, $dbpass);


$myFile = "/var/www/html/userPosts/testFile.txt";


    if(! $conn )
    {
      die('Could not connect: ' . mysql_error());
    }

    mysql_select_db( 'BafitDB' );

    $sql = sprintf("INSERT INTO post_table VALUES ('%s', '%s', '%s', '%s', '%s', '%s', '%s')",
 mysql_real_escape_string($_POST["UIDr"]),
 mysql_real_escape_string($_POST["GPSLat"]),
 mysql_real_escape_string($_POST["GPSLon"]),
 mysql_real_escape_string($myFile),
 mysql_real_escape_string($_POST["at_tag"]),
 mysql_real_escape_string($_POST["hash_tag"]),
 mysql_real_escape_string($_POST["category"]));


    $retval = mysql_query( $sql, $conn );
    if(! $retval )
    {
      die('Could not create table: ' . mysql_error());
    }

    mysql_close($conn);


$fh = fopen($myFile, 'w') or die("can't open file");
fwrite($fh, $sql);
fclose($fh);


    echo "TRUE";
    exit();
  }
?>
