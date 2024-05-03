<!DOCTYPE html>

<?php
    session_start();

    require_once "database_connection.php";

    $studentID = $_SESSION['selected_student_id'];

    if(isset($_POST["studentFirst"], $_POST["studentMiddle"], $_POST["studentLast"], $_POST["studentBirth"],
         $_POST["studentAddress"], $_POST["studentSex"], $_POST["studentGradYear"], $_POST["studentFieldofStudy"]))
    {
        $studentFirst = $_POST["studentFirst"];
        $studentMiddle = $_POST["studentMiddle"];
        $studentLast = $_POST["studentLast"];
        $studentBirth = $_POST["studentBirth"];
        $studentAddress = $_POST["studentAddress"];
        $studentSex = $_POST["studentSex"];
        $studentGradYear = $_POST["studentGradYear"];
        $studentFieldofStudy = $_POST["studentFieldofStudy"];

        if(isset($_FILES['photo']) && ($_FILES['photo']['size'] > 0))
        {
            $image = addslashes(file_get_contents($_FILES['photo']['tmp_name']));
            
            $sql = "UPDATE STUDENT SET `FIRSTNAME`= '$studentFirst', `MIDDLEINITIAL`= '$studentMiddle', `LASTNAME` = '$studentLast',
            `BIRTHDATE` = '$studentBirth', `ADDRESS` = '$studentAddress', `SEX` = '$studentSex', `GRADYEAR` = '$studentGradYear', 
            `SFIELDOFSTUDY` = '$studentFieldofStudy', `PHOTO` = '$image' WHERE `STUDENTID` = '$studentID'";

        } else {
            $sql = "UPDATE STUDENT SET `FIRSTNAME`= '$studentFirst', `MIDDLEINITIAL`= '$studentMiddle', `LASTNAME` = '$studentLast',
            `BIRTHDATE` = '$studentBirth', `ADDRESS` = '$studentAddress', `SEX` = '$studentSex', `GRADYEAR` = '$studentGradYear', 
            `SFIELDOFSTUDY` = '$studentFieldofStudy' WHERE `STUDENTID` = '$studentID'";
        }

        if (mysqli_query($conn, $sql)) 
        {
            header("location: ../student_information.php");
        } 
        else 
        {
            echo "Something went wrong. Please try again later.";
        }
    }
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel ="stylesheet" href="../css/styles.css">
    <title>Edit Student</title>
</head>
<body>
    <nav>
        <ul>
            <li><a href="../home.html">Home</a></li>
            <li><a href="../available_classes.php">Available Classes</a></li>
            <li><a href="../my_classes.php">My Classes</a></li>
            <li><a href="../student_information.php">Student Information</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>
    <div class="container">
        <h1>Edit Student Information</h1>
        <!-- Displays Student Information in a way that allows editing -->
        <?php 

            require_once "database_connection.php";
    
            // Check if student ID is set in session
            if(isset($_SESSION['selected_student_id'])) 
            {
                $studentID = $_SESSION['selected_student_id'];

                $sql_query = "SELECT * FROM STUDENT WHERE STUDENTID = $studentID";

                if ($result = $conn ->query($sql_query)) 
                {
                    while ($row = $result -> fetch_assoc()) 
                    { 
                        $studentPhoto = $row["PHOTO"];
                        $studentID = $row["STUDENTID"];
                        $studentFirst = $row["FIRSTNAME"];
                        $studentMiddle = $row["MIDDLEINITIAL"];
                        $studentLast = $row["LASTNAME"];
                        $studentBirth = $row["BIRTHDATE"];
                        $studentAddress = $row["ADDRESS"];
                        $studentSex = $row["SEX"];
                        $studentGradYear = $row["GRADYEAR"];
                        $studentFieldofStudy = $row["SFIELDOFSTUDY"];
        ?>

        <form action="edit_student.php?STUDENTID=<?php echo $studentID; ?>" method="post" enctype="multipart/form-data">
            <div>
                <strong>Profile Picture</strong>
                <!-- Uses PHP to display Student Photo -->
                <?php
                    if (!empty($studentPhoto)) 
                    {
                        // Convert the binary image data to base64 encoding
                        $imageData = base64_encode($studentPhoto);
                        // Generate the data URL for embedding the image
                        $imageSrc = "data:image/jpeg;base64," . $imageData;
                        // Display the image using the data URL
                        echo '<div class="photo"><img src="' . $imageSrc . '" alt="Student Image"></div>';
                    } else {
                        echo '<div class="photo"><img src="../images/blank_head_shot.jpg" alt="Student Image"></div>';
                    }
                ?>
                <input class="edit_student" type="file" name="photo" accept="image/*">
            </div>
            <div>
                <strong>Student ID</strong>
                <input class="edit_student" type="text" name="studentID" placeholder="Student ID" value="<?php echo $studentID ?>" autocomplete="nope" required readonly disabled>
            </div>
            <div>
                <strong>First Name</strong>
                <input class="edit_student" type="text" name="studentFirst" placeholder="First Name" value="<?php echo $studentFirst ?>" autocomplete="nope" required>
            </div>
            <div>
                <strong>Middle Initial</strong>
                <input class="edit_student" type="text" name="studentMiddle" placeholder="Middle Name" value="<?php echo $studentMiddle ?>" autocomplete="nope" required>
            </div>
            <div>
                <strong>Last Name</strong>
                <input class="edit_student" type="text" name="studentLast" placeholder="Last Name" value="<?php echo $studentLast ?>" autocomplete="nope" required>
            </div>
            <div>
                <strong>Birth Date</strong>
                <input class="edit_student" type="date" name="studentBirth" placeholder="Birth Date" value="<?php echo $studentBirth ?>" autocomplete="nope" required>
            </div>
            <div>
                <strong>Address</strong>
                <input class="edit_student" type="text" name="studentAddress" placeholder="Address" value="<?php echo $studentAddress ?>" autocomplete="nope" required>
            </div>
            <div>
                <strong>Sex</strong>
                <select class="edit_student" name="studentSex" required>
                    <option value="Male" <?php if($studentSex == "Male") echo "selected"; ?>>Male</option>
                    <option value="Female" <?php if($studentSex == "Female") echo "selected"; ?>>Female</option>
                    <option value="Other" <?php if($studentSex == "Other") echo "selected"; ?>>Other</option>
                </select>
            </div>
            <div>
                <strong>Graduation Year</strong>
                <input class="edit_student" type="text" name="studentGradYear" placeholder="Graduation Year" value="<?php echo $studentGradYear ?>" autocomplete="nope" required>
            </div>
            <div>
                <strong>Field of Study</strong>
                <input class="edit_student" type="text" name="studentFieldofStudy" placeholder="Field Of Study" value="<?php echo $studentFieldofStudy ?>" autocomplete="nope" required>
            </div>
            <div>
                <input class="edit_student" type="submit" value="Update">
            </div>
        </form>

        <?php
                    }
                }
            } else {
                echo "Student ID not found in session!";
            }
        ?>
    </div>
</body>
</html>