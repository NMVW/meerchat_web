<?php
  if( $_GET["BUN"] )
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
    $sql = sprintf("SELECT BUN FROM user_table WHERE BUN = '%s';", mysql_real_escape_string($_GET["BUN"]));
    $retval = mysql_query( $sql, $conn );
    if(! $retval )
    {
      echo "F";
      die(' Could not select: ' . mysql_error());
      exit();
    }
    $record = mysql_fetch_array($retval);
    mysql_close($conn);

    if( strcmp(strtolower($record['BUN']), strtolower($_GET["BUN"])) == 0)
    {
      echo "F";
      exit();
    }

    echo "T";
    exit();
  }
?>
