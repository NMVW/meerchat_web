<?php

/*
echo 'HEADER dump ' . '<br>';
$headers =  getallheaders();
foreach($headers as $key=>$val){
  echo $key . ': ' . $val . '<br>';
}

echo '<br>';
echo '$_GET var dump : ';
echo var_dump($_GET) . '<br>';

echo '<br>';
echo '$_REQUEST var dump : ';
echo var_dump($_REQUEST) . '<br>';

echo '<br>';
echo '$_SERVER var dump : ';
echo var_dump($_SERVER) . '<br>';
*/

  if( $_GET["UIDr"] && $_GET["BUN"] && $_GET["category"]  && $_GET["GPSLat"] && $_GET["GPSLon"] && $_GET["FBID"])
  {
    include 'DBA.php';

    $conn = mysql_connect($dbhost, $dbuser, $dbpass);
    if(! $conn )
    {
      echo "F";
      die('Could not connect: ' . mysql_error());
    }
    mysql_select_db( $dbname );

    $sql = sprintf("INSERT INTO upost_table VALUES( '%s', '%s', '%s', %f, %f, '%s', '%s', %d, %d, current_timestamp) on duplicate key update GPSlat=%f, GPSlon=%f, vidURI='%s', hash_tag='%s', MC=%d, TS=current_timestamp;", $_GET["UIDr"], $_GET["BUN"], $_GET["FBID"], $_GET["GPSLat"], $_GET["GPSLon"], $_GET["FName"], $_GET["hash_tag"], $_GET["category"], $_GET["MC"], $_GET["GPSLat"], $_GET["GPSLon"], $_GET["FName"], $_GET["hash_tag"], $_GET["MC"]);

    $retval = mysql_query( $sql, $conn );
    if(! $retval )
    {
      echo "F";
      die('Could not insert: ' . mysql_error());
    }
    mysql_close($conn);

    echo "T";
    exit();
  }
?>
