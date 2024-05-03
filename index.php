<?php
    session_start();

    require_once "includes/database_connection.php";

    // Check if a student has been selected
    if(isset($_POST['selected_student_id'])) 
    {
        $_SESSION['selected_student_id'] = $_POST['selected_student_id'];

        // Redirect to the same page to avoid resubmitting form on page refresh
        //header("Location: ".$_SERVER['PHP_SELF']);
        header("Location: home.html");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel ="stylesheet" href="css/styles.css">
    <title>Student Portal</title>
</head>

<body>
    <div class="container">
        <h1>Welcome</h1>
        <h1>Select a Student</h1>
        <div class="available_classes">
            <?php
                // Query the database
                $sql = "SELECT * FROM STUDENT";

                $result = $conn->query($sql);

                // Fetch and display the data
                if ($result->num_rows > 0) 
                {
                    while($row = $result->fetch_assoc()) 
                    {
                        echo '<div class="class">';

                        // Display student photo if available, otherwise display a placeholder
                        if(!empty($row["PHOTO"]))
                        {
                            // Convert the binary image data to base64 encoding
                            $imageData = base64_encode($row["PHOTO"]);
                            // Generate the data URL for embedding the image
                            $imageSrc = "data:image/jpeg;base64," . $imageData;
                            // Display the image using the data URL
                            echo '<div class="info"><img src="' . $imageSrc . '" alt="Student Photo" class="student-photo"></div>'; 
                        } else {
                            echo '<div class="info"><img src="images/blank_head_shot.jpg" alt="Student Image" class="student-photo"></div>';
                        }
                    
                        // Display student information
                        echo '<div class="info">Student ID: ' . $row["STUDENTID"] . '</div>';
                        echo '<div class="info">Name: ' . $row["FIRSTNAME"] . ' ' . $row["MIDDLEINITIAL"] . ' ' . $row["LASTNAME"] . '</div>';
                        echo '<div class="info">Birth Date: ' . $row["BIRTHDATE"] . '</div>';
                        echo '<div class="info">Sex: ' . $row["SEX"] . '</div>';
                        echo '<div class="info">Graduation Year: ' . $row["GRADYEAR"] . '</div>';
                        echo '<div class="info">Major: ' . $row["SFIELDOFSTUDY"] . '</div>';

                        // Add a form to select the student
                        echo '<form method="post" action="'.$_SERVER['PHP_SELF'].'" class="info">';
                        echo '<input type="hidden" name="selected_student_id" value="' . $row["STUDENTID"] . '">';
                        echo '<input class="info" type="submit" value="Select">';
                        echo '</form>';
                    
                        echo '</div>';
                    }
                } else {
                    echo "No student found";
                }

                // Close the database connection
                $conn->close();
            ?>

        </div>
    </div>
</body>
</html>
