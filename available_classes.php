<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Available Classes</title>

</head>
<body>
    <nav>
        <ul>
            <li><a href="index.html">Home</a></li>
            <li><a href="available_classes.php">Available Classes</a></li>
            <li><a href="my_classes.php">My Classes</a></li>
            <li><a href="student_information.php">Student Information</a></li>
        </ul>
    </nav>
    <div class="container">

        <?php

        require_once "database_connection.php";

        // Query the database
	$sql = "SELECT c.*, t.FIRSTNAME AS TEACHER_FIRSTNAME, t.MIDDLEINITIAL AS TEACHER_MIDDLE, t.LASTNAME AS TEACHER_LASTNAME
        	FROM COURSE c
        	INNER JOIN TEACHER t ON c.CTEACHERID = t.TEACHERID";
	$result = $conn->query($sql);


        // Fetch and display the available classes
        if ($result->num_rows > 0) 
	{
            echo "<h2>Available Classes</h2>";

            while ($row = $result->fetch_assoc()) 
	    {
                echo '<div class="class">';
                echo '<div class="info">Subject: ' . $row["SUBJECT"] . '</div>';
                echo '<div class="info">Time: ' . $row["TIME"] . '</div>';
		echo '<div class="info">Teacher: ' . $row["TEACHER_FIRSTNAME"] . ' ' . $row["TEACHER_MIDDLE"] . ' ' . $row["TEACHER_LASTNAME"] . '</div>';
		echo '<div class="info">Course ID: ' . $row["COURSEID"] . '</div>';
                echo '<div class="info">Cost: ' . $row["COST"] . '</div>';
                echo '<form method="post" action="fetch_courses.php">';
                echo '<input type="hidden" name="course_id" value="' . $row["COURSEID"] . '">';
                echo '<button type="submit" class="add-btn">Add Course</button>';
                echo '</form>';
                echo '</div>';
            }
        } 
	else 
	{
            echo "No available classes.";
        }
	if ($_SERVER["REQUEST_METHOD"] == "POST") 
	{
    		// Get the course ID from the form
    		$courseID = $_POST["course_id"];

		// Get the student ID (you may need to change this based on your authentication system)
    		$studentID = 1; // Assuming a default student ID for demonstration purposes

		// Check if the course is already enrolled for the student
    		$checkSql = "SELECT * FROM ENLISTEDCLASSES WHERE ESTUDENTID = $studentID AND ECOURSEID = $courseID";
	
		$checkResult = $conn->query($checkSql);
	
		if ($checkResult->num_rows > 0) 
		{	
			echo "This course is already enrolled.";
		}
		else 
		{
        		// Add the course for the student
        		$sql = "INSERT INTO ENLISTEDCLASSES (ESTUDENTID, ECOURSEID) VALUES ($studentID, $courseID)";

			if ($conn->query($sql) === TRUE) 
			{	
				// Redirect back to the available classes page after adding the course header("Location: available_classes.php");
            			exit();
			}
			else 
			{	
				echo "Error: " . $sql . "<br>" . $conn->error;
			}

		}
	}


	// Close the database connection
        $conn->close();
        ?>
    </div>
</body>
</html>
