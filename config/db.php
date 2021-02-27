<?php
    $host = 'localhost';
    $user = 'subash';
    $password = 'pass';
    $db_name = 'dbmsproject';

    $conn = mysqli_connect($host, $user, $password, $db_name);
    
    if(!$conn){
        $db_error = 'Could Not Connect To Database !';
    }else{
        $admins_create = "CREATE TABLE IF NOT EXISTS admins (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(100) NOT NULL,
            email VARCHAR(100) NOT NULL,
            username VARCHAR(20) NOT NULL,
            password VARCHAR(256) NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )";
        $address_create = "CREATE TABLE IF NOT EXISTS address (
            id INT AUTO_INCREMENT PRIMARY KEY,
            nation VARCHAR(60) NOT NULL,
            state INT NOT NULL,
            city VARCHAR(20) NOT NULL,
            street VARCHAR(255) NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )";
        $students_create = "CREATE TABLE IF NOT EXISTS students (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(100) NOT NULL,
            email VARCHAR(100) NOT NULL,
            phone VARCHAR(20) NOT NULL,
            roll_no VARCHAR(100) NOT NULL,
            address_id INT NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY(address_id) REFERENCES address(id)
        )";
        
        mysqli_query($conn, $admins_create);
        mysqli_query($conn, $address_create);
        mysqli_query($conn, $students_create);
    }
?>