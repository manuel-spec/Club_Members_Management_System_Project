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
                    `email` VARCHAR(255) ,
                    `profile` VARCHAR(255) DEFAULT 'https://avatars0.githubusercontent.com/u/38799309?v=4',
                    PRIMARY KEY (`id`)
                ) ENGINE = InnoDB;

                INSERT INTO users (username, password, time_stamp, role)
                VALUES
                    ('user1', :hashedPassword, CURRENT_TIMESTAMP, 'user'),
                    ('user2', :hashedPassword, CURRENT_TIMESTAMP, 'user'),
                    ('admin', :hashedPassword, CURRENT_TIMESTAMP, 'admin');
            ";
            $sql2 = "
            CREATE TABLE `clubmembers`.`events` (`id` INT NOT NULL AUTO_INCREMENT , `posted_by` VARCHAR(255) NOT NULL , `event_title` VARCHAR(255) NOT NULL , `event_desc` VARCHAR(255) NOT NULL , `time_stamp` DATE NOT NULL DEFAULT CURRENT_TIMESTAMP , PRIMARY KEY (`id`)) ENGINE = InnoDB;
            ";
            $sql3 = "CREATE TABLE `clubmembers`.`eventsStatus` (`id` INT NOT NULL AUTO_INCREMENT ,`username` VARCHAR(255) NOT NULL , `event_title` VARCHAR(255) NOT NULL ,)";

            $hashed_password = password_hash('password', PASSWORD_DEFAULT);
            $stmt = $conn->prepare($sql);
            $stmt2 = $conn->prepare($sql2);
            $stmt3 = $conn->prepare($sql3);
            $stmt->bindParam(':hashedPassword', $hashed_password);
            $stmt->bindParam(':hashedPassword', $hashed_password);
            $stmt->bindParam(':hashedPassword', $hashed_password);
            $stmt->execute();
            $stmt2->execute();
            $stmt3->execute();
            echo "DONE !!";
        } catch (Exception $e) {
            echo $e;
        }
    }
}

$seed = new Seeder();
