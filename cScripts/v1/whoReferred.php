<?php
  if( $_GET["BAFemail"] )
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
  
    $sql = sprintf("INSERT INTO referral_table (email, referrer, TS) VALUES('%s', '%s', current_timestamp) ON DUPLICATE KEY UPDATE referrer=VALUES(referrer), TS=VALUES(TS);", mysql_real_escape_string($_GET["BAFemail"]), mysql_real_escape_string($_GET["referrer"]));
    $retval = mysql_query( $sql, $conn );
    if(! $retval )
    {
      echo "F";
      die('Could not insert: ' . mysql_error());
      exit();
    }
    mysql_close($conn);
    echo "T";
    exit();
  }
?>
