<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>My Classes</title>
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

        // Get the student ID (you may need to change this based on your authentication system)
        $studentID = 1; // Assuming a default student ID for demonstration purposes

        // Query the database for enrolled classes for the specific student
        $sql = "SELECT c.*, ec.ESTUDENTID
                FROM COURSE c
                INNER JOIN ENLISTEDCLASSES ec ON c.COURSEID = ec.ECOURSEID
                WHERE ec.ESTUDENTID = $studentID";
        $result = $conn->query($sql);

        // Fetch and display the enrolled classes
        if ($result->num_rows > 0) {
            echo "<h2>My Classes</h2>";
            while ($row = $result->fetch_assoc()) {
                echo '<div class="class">';
                echo '<div class="info">Subject: ' . $row["SUBJECT"] . '</div>';
                echo '<div class="info">Time: ' . $row["TIME"] . '</div>';
                echo '<div class="info">Cost: ' . $row["COST"] . '</div>';
                echo '<form method="post" action="fetch_mycourses.php">';
                echo '<input type="hidden" name="course_id" value="' . $row["COURSEID"] . '">';
                echo '<button type="submit" class="remove-btn">Remove Course</button>';
                echo '</form>';
                echo '</div>';
            }
        } else {
            echo "You haven't enrolled in any classes yet.";
        }

        $conn->close();
        ?>
    </div>
</body>
</html>
