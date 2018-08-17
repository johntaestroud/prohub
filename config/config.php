<?php

ob_start(); # Turns on output buffering
session_start(); #starts a session which allows the storage of variables

$timezone = date_default_timezone_set("America/New_York");

$con = mysqli_connect("localhost", "root", "", "hub" ); #host, username, pw, db name

if(mysqli_connect_errno()) #error warning
{
  echo "Failed to connect: " . mysqli_connect_errno();
}

?>
