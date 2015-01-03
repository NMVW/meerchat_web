<?php
  $sc = mail('bafit.llc@gmail.com','Feedback from ' . $_GET["BUN"], "issue= " . $_GET["issue"] .  "<br>issueDetail= " . $_GET["issueDetail"] . "<br>contFeedback= " . $_GET["contFeedback"] . "<br>recommend= " . $_GET["recommend"] . "<br>UID= " . $_GET["UID"] . "<br>BUN= " . $_GET["BUN"] . "<br>lat= " . $_GET["lat"] . "<br>lon= " . $_GET["lon"] . "\r\n", "From: Team.Bafit@bafit.mobi"."\r\n".'Content-type: text/html; charset=iso-8859-1'."\r\n".'MIME-Version: 1.0'."\r\n");

/*  echo "issue= " . $_GET["issue"] .  "<br>issueDetail= " . $_GET["issueDetail"] . "<br>contFeedback= " . $_GET["contFeedback"] . "<br>recommend= " . $_GET["recommend"] . "<br>UID= " . $_GET["UID"] . "<br>BUN= " . $_GET["BUN"] . "<br>lat= " . $_GET["lat"] . "<br>lon= " . $_GET["lon"] . "\r\n";
*/
  echo "T";
  exit();
?>
