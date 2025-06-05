<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "myDB";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected to MySQL successfully<br>";

// Create database if it doesn't exist
$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn->query($sql) === TRUE) {
    echo "Database created or already exists<br>";
} else {
    echo "Error creating database: " . $conn->error . "<br>";
}

// Select the database
$conn->select_db($dbname);

// Create table for graph data
$sql = "CREATE TABLE IF NOT EXISTS graph_data (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    value INT(6) NOT NULL,
    date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
    echo "Table graph_data created or already exists<br>";
} else {
    echo "Error creating table: " . $conn->error . "<br>";
}

// Check if table is empty
$result = $conn->query("SELECT COUNT(*) as count FROM graph_data");
$row = $result->fetch_assoc();
if ($row['count'] == 0) {
    // Insert sample data only if table is empty
    $sql = "INSERT INTO graph_data (value) VALUES 
        (10),
        (15),
        (20),
        (25),
        (30)";

    if ($conn->query($sql) === TRUE) {
        echo "Sample data inserted successfully<br>";
    } else {
        echo "Error inserting data: " . $conn->error . "<br>";
    }
} else {
    echo "Table already has data<br>";
}

// Get data for graph
$sql = "SELECT value FROM graph_data ORDER BY id";
$result = $conn->query($sql);

// Debug information
echo "Number of records found: " . $result->num_rows . "<br>";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Simple Line Graph</title>
    <style>
        .graph {
            width: 500px;
            height: 300px;
            border: 1px solid #000;
            position: relative;
            margin: 20px;
            background-color: #f5f5f5;
        }
        .line {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 2px;
            background-color: blue;
            transform-origin: bottom left;
        }
        .point {
            position: absolute;
            width: 10px;
            height: 10px;
            background-color: red;
            border-radius: 50%;
            transform: translate(-50%, -50%);
        }
        .debug {
            margin: 20px;
            padding: 10px;
            background-color: #f0f0f0;
            border: 1px solid #ccc;
        }
    </style>
</head>
<body>
    <h2>Simple Line Graph</h2>
    <div class="graph">
        <?php
        if ($result->num_rows > 0) {
            $maxValue = 0;
            $values = array();
            
            // Get all values and find maximum
            while($row = $result->fetch_assoc()) {
                $values[] = $row["value"];
                if($row["value"] > $maxValue) {
                    $maxValue = $row["value"];
                }
            }
            
            // Calculate positions and draw points
            $width = 500;
            $height = 300;
            $spacing = $width / (count($values) - 1);
            
            for($i = 0; $i < count($values); $i++) {
                $x = $i * $spacing;
                $y = $height - ($values[$i] / $maxValue * $height);
                echo "<div class='point' style='left: {$x}px; top: {$y}px;'></div>";
                
                // Draw line to next point
                if($i < count($values) - 1) {
                    $nextX = ($i + 1) * $spacing;
                    $nextY = $height - ($values[$i + 1] / $maxValue * $height);
                    $length = sqrt(pow($nextX - $x, 2) + pow($nextY - $y, 2));
                    $angle = atan2($nextY - $y, $nextX - $x) * 180 / M_PI;
                    
                    echo "<div class='line' style='left: {$x}px; top: {$y}px; height: {$length}px; transform: rotate({$angle}deg);'></div>";
                }
            }
        } else {
            echo "No data found in the table";
        }
        ?>
    </div>
    
    <div class="debug">
        <h3>Debug Information:</h3>
        <?php
        echo "Values: ";
        print_r($values);
        echo "<br>Max Value: " . $maxValue;
        ?>
    </div>
</body>
</html>

<?php
$conn->close();
?> 