<?php
  if( $_GET["FBemail"] )
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
    $sql = sprintf("SELECT UID, BUN FROM user_table WHERE FBemail = '%s';", mysql_real_escape_string($_GET["FBemail"]));
    $retval = mysql_query( $sql, $conn );
    if(! $retval )
    {
      echo "F";
      die(' Could not select: ' . mysql_error());
      exit();
    }
    $record = mysql_fetch_array($retval);
    mysql_close($conn);

    echo $record['UID'].",".$record['BUN'];
    exit();
  }
?>
