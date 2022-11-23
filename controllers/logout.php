<?php
session_start();
unset($_SESSION['user']);
session_regenerate_id();

header('Location: ../login.php');