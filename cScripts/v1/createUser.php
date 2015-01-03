<?php
  if( $_GET["UIDr"] && $_GET["BUN"] && $_GET["BAFemail"] &&  $_GET["FBemail"] && $_GET["GPSlat"] && $_GET["GPSlon"] )
  {
    include 'DBA.php';

    $conn = mysql_connect($dbhost, $dbuser, $dbpass);
    if(! $conn )
    {
      echo "1";
      die(' : Could not connect: ' . mysql_error());
      exit();
    }
    mysql_select_db( $dbname );
    $sql = sprintf("SELECT RVC FROM verify_table WHERE BAFemail = '%s';", mysql_real_escape_string($_GET["BAFemail"]));
    $retval = mysql_query( $sql, $conn );
    if(! $retval )
    {
      echo "2";
      die(' : Could not select: ' . mysql_error());
      exit();
    }
    $record = mysql_fetch_array($retval);

    if(intval($record['RVC']) != intval($_GET["RVC"]))
    {
      echo "3";
      die(' : Provided RVC does not match RVC in database ' );
      exit();
    }

    $sql = sprintf("INSERT INTO user_table (UID, BUN, BAFemail, RVC, FBemail, MC, TS) VALUES('%s', '%s', '%s', %d, '%s', 1, current_timestamp);", $_GET["UIDr"], mysql_real_escape_string($_GET["BUN"]), mysql_real_escape_string($_GET["BAFemail"]), $_GET["RVC"], mysql_real_escape_string($_GET["FBemail"]));

    $retval = mysql_query( $sql, $conn );
    if(! $retval )
    {
      echo "4";
      die(' : Could not insert: ' . mysql_error());
      exit();
    }

    $sql = sprintf("INSERT INTO gps_table VALUES('%s', %f, %f, current_timestamp);", $_GET["UIDr"], $_GET["GPSlat"], $_GET["GPSlon"]);

    $retval = mysql_query( $sql, $conn );
    if(! $retval )
    {
      echo "5";
      die(' : Could not insert: ' . mysql_error());
      exit();
    }

    $sql = sprintf("INSERT INTO users VALUES('%s', '%s', current_timestamp);", $_GET["BUN"], $_GET["BUN"]);

    $retval = mysql_query( $sql, $conn );
    if(! $retval )
    {
      echo "6";
      die(' : Could not insert: ' . mysql_error());
      exit();
    }

    mysql_close($conn);
    echo "T";
    exit();
  }
?>
