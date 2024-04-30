<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel ="stylesheet" href="styles.css">
    <title>Student Portal</title>

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
        <h1>Welcome to Student Portal</h1>
        <div class="Student_container">
            <!-- Uses "fetch_student.php" file to display students -->
            <?php
                include "fetch_student.php";
            ?>
        </div>
</div>
</body>
</html>