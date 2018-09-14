<?php

$con = mysqli_connect("178.249.243.15", "g_admin", "2314800", "super_optimum");

if (mysqli_connect_errno()) {
	echo "Failed to connect to mysql server :" . mysqli_connect_errno();

}
// Change character set to utf8
mysqli_set_charset($con, "utf8");
