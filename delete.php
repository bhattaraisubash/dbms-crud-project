<?php
session_start();
if (!isset($_SESSION['status']) && !isset($_SESSION['username']) && !isset($_SESSION['token'])) {
    header('Location: ./login.php');
    exit;
} else {
    if (isset($_POST['delete']) && isset($_POST['id'])
            && isset($_POST['address_id']) 
            && $_POST['delete'] == $_SESSION['token']) {
        include('functions.php');
        include('config/db.php');

        $id = validate($_POST['id']);
        $address_id = validate($_POST['address_id']);
        $query = "DELETE FROM address WHERE id='$address_id';";

        if(mysqli_query($conn, $query)){
            //deleted
            header('Location: ./index.php');
            exit;
        }else{
            echo mysqli_error($conn);
        }
    }
}
?>