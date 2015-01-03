<?php
  if( $_GET["UIDr"] && $_GET["UIDp"] && $_GET["GPSlat"] && $_GET["GPSlon"] && strcmp($_GET["UIDr"], $_GET["UIDp"]) != 0)
  {
    include 'DBA.php';

    $conn = mysql_connect($dbhost, $dbuser, $dbpass);
    if(! $conn )
    {
      echo "F";
      die(' Could not connect: ' . mysql_error());
      exit();
    }
    mysql_select_db( $dbname );
    $sql = sprintf("INSERT INTO block_table VALUES('%s', '%s', current_timestamp);", $_GET["UIDr"], $_GET["UIDp"]);

    $retval = mysql_query( $sql, $conn );
    if(! $retval )
    {
      echo "F";
      die(' Could not insert: ' . mysql_error());
      exit();
    }

    $sql = sprintf("INSERT INTO gps_table VALUES('%s', %f, %f, current_timestamp);", $_GET["UIDr"], $_GET["GPSlat"], $_GET["GPSlon"]);

    $retval = mysql_query( $sql, $conn );
    if(! $retval )
    {
      echo "F";
      die(' Could not insert: ' . mysql_error());
      exit();
    }

    mysql_close($conn);
    echo "T";
    exit();
  }
?>
