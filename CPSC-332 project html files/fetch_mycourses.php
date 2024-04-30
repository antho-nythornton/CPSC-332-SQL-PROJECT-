<?php

require_once "database_connection.php";

// Uses student ID to fetch courses enrolled in
$studentID = 1;

// Query the database
$sql = "SELECT c.*, t.FIRSTNAME AS TEACHER_FIRSTNAME, t.MIDDLEINITIAL AS TEACHER_MIDDLE, t.LASTNAME AS TEACHER_LASTNAME
        FROM COURSE c
        INNER JOIN TEACHER t ON c.CTEACHERID = t.TEACHERID
        INNER JOIN ENLISTEDCLASSES ec ON c.COURSEID = ec.ECOURSEID
        WHERE ec.ESTUDENTID = $studentID";
$result = $conn->query($sql);

// Fetch and display the data
if ($result->num_rows > 0) 
{
    while($row = $result->fetch_assoc()) 
    {
        echo '<div class="class">';
        echo '<div class="info">Subject: ' . $row["SUBJECT"] . '</div>';
        echo '<div class="info">Time: ' . $row["TIME"] . '</div>';
        echo '<div class="info">Teacher: ' . $row["TEACHER_FIRSTNAME"] . ' ' . $row["TEACHER_MIDDLE"] . ' ' . $row["TEACHER_LASTNAME"] . '</div>';
        echo '<div class="info">Course ID: ' . $row["COURSEID"] . '</div>';
        echo '<div class="info">Cost: ' . $row["COST"] . '</div>';
        echo '<button class="info">Remove Course</button>';
        echo '</div>';
    }
    
} else {
    echo "No courses found";
}

// Close the database connection
$conn->close();