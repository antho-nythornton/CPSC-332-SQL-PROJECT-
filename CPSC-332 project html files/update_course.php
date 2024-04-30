<!DOCTYPE html>
<html lang="en">
<?php
    require_once "database_connection.php";
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel ="stylesheet" href="styles.css">
    <title>Update Course</title>

</head>
<body>
    <nav>
        <ul>
            <li><a href="index.html">Home</a></li>
            <li><a href="available_classes.html">Available Classes</a></li>
            <li><a href="my_classes.html">My Classes</a></li>
            <li><a href="student_information.html">Student Information</a></li>
        </ul>
    </nav>
    <div class="container">
        <h1>Updating Course</h1>
    </div>
    <?php 
        require_once "database_connection.php";
        $sql_query = "SELECT * FROM COURSE WHERE COURSEID = ".$_GET["COURSEID"];
        if ($result = $conn ->query($sql_query)) 
        {
            while ($row = $result -> fetch_assoc()) 
            { 
                $courseID = $row["COURSEID"];
                $courseSubject = $row["SUBJECT"];
                $courseCost = $row["COST"];
                $courseTime = $row["TIME"];
                $courseInfo = $row["COURSEINFO"];
    ?>
    <form action="update_course.php?COURSEID=<?php echo $courseID; ?>" method="post">
    <div>
        <label>Course ID</label>
        <input type="text" name="courseID" placeholder="Course ID" value="<?php echo $courseID ?>" autocomplete="nope" required>
    </div>
    <div>
        <label>Course Subject</label>
        <input type="text" name="courseSubject" placeholder="Course Subject" value="<?php echo $courseSubject ?>" autocomplete="nope" required>
    </div>
    <div>
        <label>Course Cost</label>
        <input type="text" name="courseCost" placeholder="Course Cost" value="<?php echo $courseCost ?>" autocomplete="nope" required>
    </div>
    <div>    
        <label>Course Time</label>
        <input type="text" name="courseTime" placeholder="Course Time" value="<?php echo $courseTime ?>" autocomplete="nope" required>
    </div>
    <div>    
        <label>Course Info</label>
        <input type="text" name="courseInfo" placeholder="Course Info" value="<?php echo $courseInfo ?>" autocomplete="nope" required>
        <button type="submit">Update</button>
    </form>
    <?php
            }
        }
    ?>
</body>
</html>