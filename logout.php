<?php
session_start();
session_destroy();
echo "<script>alert('you are now logout')</script>";
echo "<script>window.location.href='./loginform.php';</script>";