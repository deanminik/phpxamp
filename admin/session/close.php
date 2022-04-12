<?php

session_start();
session_destroy(); // delete all variables of the session 

header("Location:../index.php");
