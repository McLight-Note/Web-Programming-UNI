<?php
$servername = "localhost";
$username = "root";
$password = "";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database
$sql = "CREATE DATABASE IF NOT EXISTS myDB";
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully<br>";
} else {
    echo "Error creating database: " . $conn->error . "<br>";
}

// Select database
$conn->select_db("myDB");

// Create table
$sql = "CREATE TABLE IF NOT EXISTS MyGuests (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    firstname VARCHAR(30) NOT NULL,
    lastname VARCHAR(30) NOT NULL,
    email VARCHAR(50),
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
    echo "Table MyGuests created successfully<br>";
} else {
    echo "Error creating table: " . $conn->error . "<br>";
}

// Insert 20 records
$sql = "INSERT INTO MyGuests (firstname, lastname, email) VALUES 
    ('John', 'Doe', 'john@example.com'),
    ('Mary', 'Smith', 'mary@example.com'),
    ('James', 'Johnson', 'james@example.com'),
    ('Sarah', 'Williams', 'sarah@example.com'),
    ('Michael', 'Brown', 'michael@example.com'),
    ('Emily', 'Jones', 'emily@example.com'),
    ('David', 'Miller', 'david@example.com'),
    ('Lisa', 'Davis', 'lisa@example.com'),
    ('Robert', 'Garcia', 'robert@example.com'),
    ('Jennifer', 'Rodriguez', 'jennifer@example.com'),
    ('William', 'Wilson', 'william@example.com'),
    ('Elizabeth', 'Martinez', 'elizabeth@example.com'),
    ('Richard', 'Anderson', 'richard@example.com'),
    ('Susan', 'Taylor', 'susan@example.com'),
    ('Joseph', 'Thomas', 'joseph@example.com'),
    ('Margaret', 'Moore', 'margaret@example.com'),
    ('Charles', 'Jackson', 'charles@example.com'),
    ('Patricia', 'Martin', 'patricia@example.com'),
    ('Thomas', 'Lee', 'thomas@example.com'),
    ('Barbara', 'Perez', 'barbara@example.com')";

if ($conn->query($sql) === TRUE) {
    echo "20 records inserted successfully";
} else {
    echo "Error inserting records: " . $conn->error;
}

$conn->close();
?> 