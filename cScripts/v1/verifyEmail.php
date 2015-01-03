<?php
  if( $_GET["BAFemail"] )
  {
    list($s1, $s2) = explode( "@", $_GET["BAFemail"]);
    $ehost = strtolower(substr($s2,0,7));
/*
    if( strcmp ($ehost,"ufl.edu") == 0 )
    {
*/
      include 'DBA.php';
      $RVC = rand(100000,999999);

      require 'Send_Mail.php';
      $to = $_GET["BAFemail"];
      $subject = "Meerchat Verification Code";
      $body = "Verification Code: $RVC";
      Send_Mail($to,$subject,$body);

      $conn = mysql_connect($dbhost, $dbuser, $dbpass);
      if(! $conn )
      {
        echo "F";
        die(' Could not connect: ' . mysql_error());
        exit();
      }
      mysql_select_db( $dbname );
      $sql = sprintf("INSERT INTO verify_table (BAFemail, RVC, TS) VALUES('%s', %d, current_timestamp) ON DUPLICATE KEY UPDATE RVC=VALUES(RVC), TS=VALUES(TS);", mysql_real_escape_string($_GET["BAFemail"]), $RVC);
      $retval = mysql_query( $sql, $conn );
      if(! $retval )
      {
        echo "F";
        die(' Could not insert: ' . mysql_error());
        exit();
      }
      mysql_close($conn);
      echo "T";
/*
    }
    else
    {
      echo "F";
    }
*/
    exit();
  }
?>
