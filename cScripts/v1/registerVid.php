<?php
  if( $_GET["UIDr"] && $_GET["UIDp"] )
  {
    include 'DBA.php';

    $conn = mysql_connect($dbhost, $dbuser, $dbpass);
    if(! $conn )
    {
      echo "F";
      die('Could not connect: ' . mysql_error());
      exit();
    }
    mysql_select_db( $dbname );

    $sql = sprintf("UPDATE user_table SET  MC = LAST_INSERT_ID(MC) + 1 WHERE UID = '%s';", $_GET["UIDr"]);
    $retval = mysql_query( $sql, $conn );
    if(! $retval )
    {
      echo "F";
      die('Could not update: ' . mysql_error());
      exit();
    }

    $sql = "select last_insert_id();";
    $retval = mysql_query( $sql, $conn );
    if(! $retval )
    {
      echo "F";
      die('Could not select: ' . mysql_error());
      exit();
    }

    $record = mysql_fetch_array($retval);
    $MC = $record['last_insert_id()'];
    $FName = $_GET["UIDr"] . "_" . $_GET["UIDp"] . "_" . $MC;

    $sql = "INSERT INTO upload_table VALUES('$FName', current_timestamp);";
    $retval = mysql_query( $sql, $conn );
    if(! $retval )
    {
      echo "F";
      die('Could not insert: ' . mysql_error());
      exit();
    }

    $sql = sprintf("INSERT INTO video_table VALUES('%s', '%s', $MC, current_timestamp);",$_GET["UIDr"], $_GET["UIDp"]);
    $retval = mysql_query( $sql, $conn );
    if(! $retval )
    {
      echo "F";
      die('Could not insert: ' . mysql_error());
      exit();
    }

    $sql = "INSERT INTO thumb_table VALUES('$FName', current_timestamp);";
    $retval = mysql_query( $sql, $conn );
    if(! $retval )
    {
      echo "F";
      die('Could not insert: ' . mysql_error());
      exit();
    }

    mysql_close($conn);
    echo '[{"FName":"' . $FName . '","MC":"' . $MC . '"}]';
    exit();
  }
?>
