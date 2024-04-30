<?php

require_once "database_connection.php";

// Query the database
$sql = "SELECT * FROM STUDENT LIMIT 1";
$result = $conn->query($sql);

// Fetch and display the data
if ($result->num_rows > 0) 
{
    while($row = $result->fetch_assoc()) 
    {
        echo '<div class="photo"><img src="' . $row["PHOTO"] . '" alt="Student Image"></div>';
        echo '<div class="text">';
        echo '<div class="student_info">Student ID: ' . $row["STUDENTID"] . '</div>';
        echo '<div class="student_info">Name: ' . $row["FIRSTNAME"] . ' ' . $row["MIDDLEINITIAL"] . ' ' . $row["LASTNAME"] . '</div>';
        echo '<div class="student_info">Birth date: ' . $row["BIRTHDATE"] . '</div>';
        echo '<div class="student_info">Address: ' . $row["ADDRESS"] . '</div>';
        echo '<div class="student_info">Sex: ' . $row["SEX"] . '</div>';
        echo '<div class="student_info">Graduation year: ' . $row["GRADYEAR"] . '</div>';
        echo '<div class="student_info">Major: ' . $row["SFIELDOFSTUDY"] . '</div>';
        echo '</div>';
    }
    
} else {
    echo "No student found";
}

// Close the database connection
$conn->close();