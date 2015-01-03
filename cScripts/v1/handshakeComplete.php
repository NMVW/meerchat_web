<?php
  if( $_GET["UIDr"] && $_GET["UIDp"] )
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

    $sql1 = sprintf("SELECT COUNT(*) FROM block_table WHERE UID = '%s' AND UIDp = '%s';", $_GET["UIDr"], $_GET["UIDp"]);
    $sql2 = sprintf("SELECT COUNT(*) FROM block_table WHERE UID = '%s' AND UIDp = '%s';", $_GET["UIDp"], $_GET["UIDr"]);

    $ret1 = mysql_query( $sql1, $conn );
    $ret2 = mysql_query( $sql2, $conn );

    if( !$ret1 || !$ret2 )
    {
      echo "F";
      die(' Could not select: ' . mysql_error());
      exit();
    }
    $rec1 = mysql_fetch_array($ret1);
    $rec2 = mysql_fetch_array($ret2);

    if( (intval($rec1['COUNT(*)']) > 0) || (intval($rec2['COUNT(*)']) > 0) )
    {
      echo "F";
      mysql_close($conn);
      exit();
    }


    $sql1 = sprintf("SELECT COUNT(*) FROM video_table WHERE UID = '%s' AND UIDp = '%s';", $_GET["UIDr"], $_GET["UIDp"]);
    $sql2 = sprintf("SELECT COUNT(*) FROM video_table WHERE UID = '%s' AND UIDp = '%s';", $_GET["UIDp"], $_GET["UIDr"]);

    $ret1 = mysql_query( $sql1, $conn );
    $ret2 = mysql_query( $sql2, $conn );

    if( !$ret1 || !$ret2 )
    {
      echo "F";
      die('Could not select: ' . mysql_error());
      exit();
    }
    $rec1 = mysql_fetch_array($ret1);
    $rec2 = mysql_fetch_array($ret2);
    if(intval($rec1['COUNT(*)']) > 0 && intval($rec2['COUNT(*)']) > 0)
    {
      echo "T";
      mysql_close($conn);
      exit();
    }
    mysql_close($conn);
    echo "F";
    exit();
  }
?>
