<?php

if (session_status()!=2){session_start();}
session_destroy();
header('Location: login.php');

?>