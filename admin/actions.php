<?php
include("../db.php");
include("../user.php");
session_start();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_GET[''])) {
    }
} else if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: ../index.php");
}
