<?php

  if( $_GET["UIDr"] && $_GET["UIDp"] && $_GET["GPSlat"] && $_GET["GPSlon"] )
  {

    include 'DBA.php';
    $conn = mysql_connect($dbhost, $dbuser, $dbpass);
    if(! $conn )
    {
      die('F Could not connect: ' . mysql_error());
    }
    mysql_select_db( $dbname );

    $sql = sprintf("UPDATE upost_table SET GPSlat = %f, GPSlon = %f WHERE UID = '%s';", $_GET["GPSlat"], $_GET["GPSlon"], $_GET["UIDr"]);
    $retval = mysql_query( $sql, $conn );
    if(! $retval )
    {
      die('F Could not insert: ' . mysql_error());
    }

    $sql = sprintf("INSERT INTO gps_table VALUES('%s', %f, %f, current_timestamp);", $_GET["UIDr"], $_GET["GPSlat"], $_GET["GPSlon"]);
    $retval = mysql_query( $sql, $conn );
    if(! $retval )
    {
      die('F Could not insert: ' . mysql_error());
    }

    $sql = sprintf("SELECT MTEXT, TS FROM text_table WHERE UID = '%s' and UIDp = '%s' and DELIVERED = 'F';" , $_GET["UIDp"], $_GET["UIDr"]);
    $retval = mysql_query( $sql, $conn );
    if(! $retval )
    {
      die('F Could not insert: ' . mysql_error());
    }

    $json = array();
    while( $row = mysql_fetch_assoc(  $retval ) ) {
      $json[] = $row;
    }

    echo json_encode( $json );

    $sql = sprintf("UPDATE text_table SET DELIVERED = 'T' WHERE UID = '%s' and UIDp = '%s' and DELIVERED = 'F';" , $_GET["UIDp"], $_GET["UIDr"]);
    $retval = mysql_query( $sql, $conn );
    if(! $retval )
    {
      die('F Could not insert: ' . mysql_error());
    }

    mysql_close($conn);
    exit();

  }


?>
