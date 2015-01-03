<?php

if (strcmp(end(explode(".", $_FILES["file"]["name"])), "mp4") == 0 ) {
  if ($_FILES["file"]["error"] > 0) {
    echo "F Return Code: " . $_FILES["file"]["error"] . "<br>";
    exit();
  } else {
    if (file_exists("/var/www/html/userPosts/" . $_FILES["file"]["name"])) {
      echo "F " . $_FILES["file"]["name"] . " already exists" . "<br>";
      exit();
    } else {
      include 'DBA.php';

      $conn = mysql_connect($dbhost, $dbuser, $dbpass);
      if(! $conn )
      {
        echo "F ";
        die('Could not connect: ' . mysql_error());
        exit();
      }
      mysql_select_db( $dbname );

      $sql = sprintf("select FName from upload_table WHERE FName = '%s';", basename($_FILES["file"]["name"],".mp4"));
      $retval = mysql_query( $sql, $conn );
      if(! $retval )
      {
        echo "F ";
        die('Could not select: ' . mysql_error());
        exit();
      }

      $record = mysql_fetch_array($retval);
      $FName = $record['FName'] . ".mp4";

      if( strcmp($FName, $_FILES["file"]["name"]) == 0)
      {
        move_uploaded_file($_FILES["file"]["tmp_name"], "/var/www/html/userPosts/" . $_FILES["file"]["name"]);
        $sql = sprintf("DELETE FROM upload_table WHERE FName = '%s';", basename($_FILES["file"]["name"],".mp4"));
        $retval = mysql_query( $sql, $conn );
        if(! $retval )
        {
          echo "F ";
          die('Could not delete: ' . mysql_error());
          exit();
        }
      }
      else
      {
        echo "F Unregistered File";
        exit();
      }
    }
  }
} else {
  echo "F Invalid file ";
  exit();
}

mysql_close($conn);
echo "T";



?>
