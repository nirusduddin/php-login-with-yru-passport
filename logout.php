<?php
@session_start();
unset($_SESSION['PASSPORT_PROFILE']);
header("location: index.php");