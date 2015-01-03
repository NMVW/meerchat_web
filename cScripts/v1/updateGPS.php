<?php
  if( $_GET["UIDr"] && $_GET["GPSlat"] && $_GET["GPSlon"] )
  {
    include 'DBA.php';
    $conn = mysql_connect($dbhost, $dbuser, $dbpass);

    if(! $conn )
    {
      echo "F";
      die('Could not connect: ' . mysql_error());
    }

    mysql_select_db( $dbname );
    $sql = sprintf("UPDATE upost_table SET GPSlat = %f, GPSlon = %f WHERE uid = '%s';", $_GET["GPSlat"], $_GET["GPSlon"], $_GET["UIDr"]);

    $retval = mysql_query( $sql, $conn );
    if(! $retval )
    {
      echo "F";
      die('Could not insert: ' . mysql_error());
      exit();
    }

    $sql = sprintf("INSERT INTO gps_table VALUES('%s', %f, %f, current_timestamp);", $_GET["UIDr"], $_GET["GPSlat"], $_GET["GPSlon"]);

    $retval = mysql_query( $sql, $conn );
    if(! $retval )
    {
      echo "F";
      die('Could not insert: ' . mysql_error());
      exit();
    }


    echo "T";
    mysql_close($conn);
    exit();

  }
?>
