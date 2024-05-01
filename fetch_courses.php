<?php
require_once "database_connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the course ID from the form
    $courseID = $_POST["course_id"];
    
    // Get the student ID (you may need to change this based on your authentication system)
    $studentID = 1; // Assuming a default student ID for demonstration purposes
    
    // Check if the course is already enrolled for the student
    $checkSql = "SELECT * FROM ENLISTEDCLASSES WHERE ESTUDENTID = $studentID AND ECOURSEID = $courseID";
    $checkResult = $conn->query($checkSql);
    
    if ($checkResult->num_rows > 0) {
        echo "This course is already enrolled.";
    } else {
        // Add the course for the student
        $sql = "INSERT INTO ENLISTEDCLASSES (ESTUDENTID, ECOURSEID) VALUES ($studentID, $courseID)";
        
        if ($conn->query($sql) === TRUE) {
            // Redirect back to the available classes page after adding the course
            header("Location: available_classes.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

$conn->close();
?>
