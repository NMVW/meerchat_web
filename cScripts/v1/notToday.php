<?php
  if( $_GET["UIDr"] && $_GET["UIDp"] && $_GET["MC"] )
  {
    include 'DBA.php';

    $conn = mysql_connect($dbhost, $dbuser, $dbpass);
    if(! $conn )
    {
      echo "F ";
      die('Could not connect: ' . mysql_error());
      exit();
    }
    mysql_select_db( $dbname );


    if(strcmp($_GET["UIDr"], $_GET["UIDp"]) == 0 || in_array($_GET["UIDr"],array('ECDB8BA7-3FDD-4CDE-80E1-9826B499CE3B','438F53E7-C86C-49A2-BC65-C25D53589A39','075613E4-62E5-4337-9E00-49B40B7B4581','536F2E74-4D4E-4096-98D7-8A3CD334E1C5','FB28EB1B-3C44-4284-B0A8-2DA041658936')))
    {

      $sql = sprintf("DELETE FROM upost_table WHERE UID = '%s' AND MC = %d;", $_GET["UIDp"], $_GET["MC"]);

      $retval = mysql_query( $sql, $conn );
      if(! $retval )
      {
        echo "F";
        die('Could not delete: ' . mysql_error());
        exit();
      }
    }
    else
    {
      $sql = sprintf("INSERT INTO not_today_table VALUES('%s', '%s', %d, current_timestamp);", $_GET["UIDr"], $_GET["UIDp"], $_GET["MC"]);

      $retval = mysql_query( $sql, $conn );
      if(! $retval )
      {
        echo "F";
        die('Could not insert: ' . mysql_error());
        exit();
      }
    }

    mysql_close($conn);
    echo "T";
    exit();
  }
?>
