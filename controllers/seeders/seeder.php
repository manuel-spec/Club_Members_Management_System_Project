<?php

class Seeder
{
    public $servername = "localhost";
    public $username = "root";
    public $password = "";

    public function __construct()
    {
        try {
            $conn = new PDO("mysql:host=$this->servername", $this->username, $this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Create the database
            $sql = "CREATE DATABASE IF NOT EXISTS clubmembers";
            $conn->exec($sql);

            // Create a new PDO instance for the clubmembers database
            $conn = new PDO("mysql:host=$this->servername;dbname=clubmembers", $this->username, $this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Create the users table and insert data
            $sql = "
                CREATE TABLE `users` (
                    `id` INT NOT NULL AUTO_INCREMENT,
                    `username` VARCHAR(255) NOT NULL,
                    `password` VARCHAR(255) NOT NULL,
                    `time_stamp` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
                    `role` VARCHAR(255) NOT NULL DEFAULT 'user',
                    PRIMARY KEY (`id`)
                ) ENGINE = InnoDB;

                INSERT INTO users (username, password, time_stamp, role)
                VALUES
                    ('user1', :hashedPassword, CURRENT_TIMESTAMP, 'user'),
                    ('user2', :hashedPassword, CURRENT_TIMESTAMP, 'user'),
                    ('admin', :hashedPassword, CURRENT_TIMESTAMP, 'admin');
            ";

            $hashed_password = password_hash('password', PASSWORD_DEFAULT);
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':hashedPassword', $hashed_password);
            $stmt->bindParam(':hashedPassword', $hashed_password);
            $stmt->bindParam(':hashedPassword', $hashed_password);
            $stmt->execute();
            echo "DONE !!";
        } catch (Exception $e) {
            echo $e;
        }
    }
}

$seed = new Seeder();
