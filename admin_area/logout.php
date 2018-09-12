<?php


session_start();

session_destroy();

echo "<script>window.open('login.php?logged_out=You Have Logged OUT, come back Soon!','_seflf')</script>";

?>