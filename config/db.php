<?php
    $host = 'localhost';
    $user = 'subash';
    $password = 'password';
    $db_name = 'dbmsproject';

    $conn = mysqli_connect($host, $user, $password, $db_name);
    
    if(!$conn){
        $error = 'Could Not Connect To Database: '. mysqli_connect_error();
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
            FOREIGN KEY(address_id) REFERENCES address(id) ON DELETE CASCADE
        )";
        if(!mysqli_query($conn, $admins_create)){
            $error =  "Error creating table: " . mysqli_error($conn);
        }
        if (!mysqli_query($conn, $address_create)) {
            $error = "Error creating admins table !";
        }
        if (!mysqli_query($conn, $students_create)) {
            $error = "Error creating admins table !";
        }

        //for initial super user
        // $hashed_password = password_hash('password', PASSWORD_DEFAULT);
        // $insert_super_user = "INSERT INTO admins(name,email,username,password) VALUES('Admin User','admin@admin.com','admin', '$hashed_password');";
        // if(!mysqli_query($conn, $insert_super_user)){
        //     $error = mysqli_error($conn);
        // }
    }
?>