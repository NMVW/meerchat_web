<?php
  if( $_GET["name"] &&  $_GET["email"] )
  {
    include 'DBA.php';
    $conn = mysql_connect($dbhost, $dbuser, $dbpass);
    mysql_select_db( $dbname );

    $TNL = "F";
    if( strcmp($_GET["NL"],"T") == 0 )
    {
      $TNL = "T";
    }

    $TBT = "F";
    if( strcmp($_GET["BETA"],"T") == 0 )
    {
      $TBT = "T";
    }

    $sql = sprintf("INSERT INTO email_NL_table (name, email, ref, NL, BETA, AC, TS) VALUES('%s', '%s', '%s', '%s', '%s', '%s', current_timestamp) ON DUPLICATE KEY UPDATE name=VALUES(name), ref=VALUES(ref), NL=VALUES(NL), BETA=VALUES(BETA), AC=VALUES(AC), TS=VALUES(TS);", mysql_real_escape_string($_GET["name"]), mysql_real_escape_string($_GET["email"]), mysql_real_escape_string($_GET["ref"]), $TNL, $TBT, mysql_real_escape_string($_GET["AC"]));
    $retval = mysql_query( $sql, $conn );

    mysql_close($conn);
  }

  header( 'Location: ' . $_SERVER['HTTP_REFERER'] );
  exit();

?>
