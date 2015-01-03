<?php
  if( $_GET["FBemail"] && $_GET["Data"] && $_GET["Flist"])
  {
    include 'DBA.php';

    $conn = mysql_connect($dbhost, $dbuser, $dbpass);
    if(! $conn )
    {
      die('F Could not connect: ' . mysql_error());
      exit();
    }
    mysql_select_db( $dbname );

    $sql = sprintf("INSERT INTO FB_table VALUES('%s', '%s', '%s', current_timestamp);", $_GET["FBemail"], $_GET["Data"], $_GET["Flist"]);
    $retval = mysql_query( $sql, $conn );
    if(! $retval )
    {
      die('F Could not insert: ' . mysql_error());
      exit();
    }

    mysql_close($conn);
    echo "T";
    exit();
  }
?>
