<?php
session_start();
if (isset($_SESSION['status']) && isset($_SESSION['username']) && isset($_SESSION['token'])) {
   if(isset($_POST['logout']) && isset($_POST['token']) && $_POST['token'] == $_SESSION['token']){
       //process logout: clear session
        unset($_SESSION['status']);
        unset($_SESSION['username']);
        unset($_SESSION['token']);
   }
}
header('Location: ./index.php');
exit;
?>