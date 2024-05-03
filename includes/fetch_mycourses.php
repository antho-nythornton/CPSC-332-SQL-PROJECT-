<?php
    session_start();

    require_once "database_connection.php";

    if(isset($_SESSION['selected_student_id'])) 
    {
        $studentID = $_SESSION['selected_student_id'];
    } else {
        header("Location: index.php");
    }

    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") 
    {
        // Retrieve the course ID from the form
        $courseID = $_POST["course_id"];

        // Prepare the SQL statement to remove the course from ENLISTEDCLASSES
        $sql = "DELETE FROM ENLISTEDCLASSES WHERE ESTUDENTID = $studentID AND ECOURSEID = $courseID";

        // Execute the SQL statement
        if ($conn->query($sql) === TRUE) 
        {
            // Redirect to my_classes.php after removing the course
            header("Location: ../my_classes.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    $conn->close();
?>