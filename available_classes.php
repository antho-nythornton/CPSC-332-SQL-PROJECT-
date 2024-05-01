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

        // Query the database for available classes
        $sql = "SELECT * FROM COURSE WHERE COURSEID IN (SELECT COURSEID FROM AVAILABLECLASSES)";
        $result = $conn->query($sql);

        // Fetch and display the available classes
        if ($result->num_rows > 0) {
            echo "<h2>Available Classes</h2>";
            while ($row = $result->fetch_assoc()) {
                echo '<div class="class">';
                echo '<div class="info">Subject: ' . $row["SUBJECT"] . '</div>';
                echo '<div class="info">Time: ' . $row["TIME"] . '</div>';
                echo '<div class="info">Cost: ' . $row["COST"] . '</div>';
                echo '<form method="post" action="fetch_courses.php">';
                echo '<input type="hidden" name="course_id" value="' . $row["COURSEID"] . '">';
                echo '<button type="submit" class="add-btn">Add Course</button>';
                echo '</form>';
                echo '</div>';
            }
        } else {
            echo "No available classes.";
        }

        $conn->close();
        ?>
    </div>
</body>
</html>
