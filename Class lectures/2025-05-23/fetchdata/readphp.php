<?php 
  $servername = "localhost"; 
  $username = "root"; 
  $password = ""; 
  $databasename = "test"; 
  
  // CREATE CONNECTION 
  $conn = new mysqli($servername, 
    $username, $password, $databasename); 
  
  // GET CONNECTION ERRORS 
  if ($conn->connect_error) { 
      die("Connection failed: " . $conn->connect_error); 
  } 
  
  // SQL QUERY 
  $query = "SELECT * FROM `user_info`;"; 
  
  // FETCHING DATA FROM DATABASE 
  $result = $conn->query($query); 
  
    if ($result->num_rows > 0)  
    { 
        // OUTPUT DATA OF EACH ROW 
        while($row = $result->fetch_assoc()) 
        { 
            echo "ID No: " . 
                $row["id"]. " First Name: " . 
                $row["first_name"]. " | Last Name: " .  
                $row["last_name"]. " | Age: " .  
                $row["age"]. "<br>"; 
        } 
    }  
    else { 
        echo "0 results"; 
    } 
  
   $conn->close(); 
  
?>