<?php
require_once "database_connection.php";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the course ID from the form
    $courseID = $_POST["course_id"];
    
    // Get the student ID (you may need to change this based on your authentication system)
    $studentID = 1; // Assuming a default student ID for demonstration purposes

    // Prepare the SQL statement to remove the course from ENLISTEDCLASSES
    $sql = "DELETE FROM ENLISTEDCLASSES WHERE ESTUDENTID = $studentID AND ECOURSEID = $courseID";

    // Execute the SQL statement
    if ($conn->query($sql) === TRUE) {
        // Redirect to my_classes.php after removing the course
        header("Location: my_classes.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
