<?php

  if( $_GET["UIDr"] && $_GET["GPSlat"] && $_GET["GPSlon"] )
  {

    include 'DBA.php';
    $conn = mysql_connect($dbhost, $dbuser, $dbpass);
    if(! $conn )
    {
      die('F Could not connect: ' . mysql_error());
    }
    mysql_select_db( $dbname );

    $sql = sprintf("UPDATE upost_table SET GPSlat = %f, GPSlon = %f WHERE UID = '%s';", $_GET["GPSlat"], $_GET["GPSlon"], $_GET["UIDr"]);
    $retval = mysql_query( $sql, $conn );
    if(! $retval )
    {
      die('F Could not insert: ' . mysql_error());
    }

    $sql = sprintf("INSERT INTO gps_table VALUES('%s', %f, %f, current_timestamp);", $_GET["UIDr"], $_GET["GPSlat"], $_GET["GPSlon"]);
    $retval = mysql_query( $sql, $conn );
    if(! $retval )
    {
      die('F Could not insert: ' . mysql_error());
    }

/*
    $fe = sprintf("SELECT UID, BUN, FBID, ROUND(SQRT((GPSlat-(%f))*(GPSlat-(%f))+(GPSlon-(%f))*(GPSlon-(%f))),2) AS dist, vidURI, hash_tag, category, MC, TS FROM upost_table WHERE UID NOT IN (select nt.UIDp as UID from not_today_table as nt, upost_table as up where nt.UID = '%s' and nt.UIDp = up.UID and nt.MC = up.MC) AND UID NOT IN (select UIDp as UID from block_table where UID = '%s')", $_GET["GPSlat"], $_GET["GPSlat"], $_GET["GPSlon"], $_GET["GPSlon"], $_GET["UIDr"], $_GET["UIDr"] );
*/

    $fe = sprintf("SELECT UID, BUN, FBID, 69*ROUND(SQRT(pow(GPSlat-(%f),2)+pow(GPSlon-(%f),2)),2) AS dist, vidURI, hash_tag, category, MC, TS FROM upost_table WHERE UID NOT IN (select nt.UIDp as UID from not_today_table as nt, upost_table as up where nt.UID = '%s' and nt.UIDp = up.UID and nt.MC = up.MC) AND UID NOT IN (select UIDp as UID from block_table where UID = '%s')", $_GET["GPSlat"], $_GET["GPSlon"], $_GET["UIDr"], $_GET["UIDr"] );

	$filt = '';
    if( $_GET["Filter"] == 1 && $_GET["FilterValue"] > 0 && $_GET["FilterValue"] <= 4)
    {
      $filt = sprintf(" AND category = %d", $_GET["FilterValue"]);
    }
	
	$Oby = " ORDER BY TS DESC";
	if($_GET["Oby"] == 1)
	{
      $Oby = " ORDER BY dist";	
	}
	
	$limit = " LIMIT 0, 100";
	
	$sql = "$fe" . "$filt" . "$Oby" . "$limit" . ";";

    $retval = mysql_query( $sql, $conn );
    $json = array();
    while( $row = mysql_fetch_assoc(  $retval ) ) {
      $json[] = $row;
    }
    echo json_encode( $json );

    mysql_close($conn);
    exit();

  }

?>

