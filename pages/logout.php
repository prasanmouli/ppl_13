<?php
session_start();
if(!isset($_SESSION['username'])){
header("location: ../");
}
unset($_SESSION['username']);
unset($_SESSION['views']);
header("location: .././");
?>
