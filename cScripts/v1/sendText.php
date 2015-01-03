<?php
  if( $_GET["UIDr"] && $_GET["UIDp"] && $_GET["TEXT"] )
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

    $sql = sprintf("UPDATE user_table SET  MC = LAST_INSERT_ID(MC) + 1 WHERE UID = '%s';", $_GET["UIDr"]);
    $retval = mysql_query( $sql, $conn );
    if(! $retval )
    {
      echo "F";
      die(' Could not delete: ' . mysql_error());
      exit();
    }

    $sql = "select last_insert_id();";
    $retval = mysql_query( $sql, $conn );
    if(! $retval )
    {
      echo "F";
      die(' Could not delete: ' . mysql_error());
      exit();
    }

    $record = mysql_fetch_array($retval);
    $MC = $record['last_insert_id()'];

    $sql = sprintf("INSERT INTO text_table VALUES('%s', '%s', %d, '%s', 'F', current_timestamp);", $_GET["UIDr"], $_GET["UIDp"], $MC, $_GET["TEXT"]);
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
