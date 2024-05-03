<?php
    session_start();
    
    require_once "database_connection.php";
    
    // Check if student ID is set in session
    if(isset($_SESSION['selected_student_id'])) 
    {
        $studentID = $_SESSION['selected_student_id'];

        // Query the database
        $sql = "SELECT * FROM STUDENT WHERE STUDENTID = $studentID";
        
        $result = $conn->query($sql);
        
        // Fetch and display the data
        if ($result->num_rows > 0) 
        {
            while($row = $result->fetch_assoc()) 
            {
                if(!empty($row["PHOTO"]))
                {
                    // Convert the binary image data to base64 encoding
                    $imageData = base64_encode($row["PHOTO"]);
                    // Generate the data URL for embedding the image
                    $imageSrc = "data:image/jpeg;base64," . $imageData;
                    // Display the image using the data URL
                    echo '<div class="photo"><img src="' . $imageSrc . '" alt="Student Image"></div>'; 
                } else {
                    echo '<div class="photo"><img src="images/blank_head_shot.jpg" alt="Student Image"></div>';
                }

                echo '<div class="text">';
                echo '<div class="student_info"><span class="bold">Student ID:</span> ' . $row["STUDENTID"] . '</div>';
                echo '<div class="student_info"><span class="bold">Name:</span> ' . $row["FIRSTNAME"] . ' ' . $row["MIDDLEINITIAL"] . ' ' . $row["LASTNAME"] . '</div>';
                echo '<div class="student_info"><span class="bold">Birth date:</span> ' . $row["BIRTHDATE"] . '</div>';
                echo '<div class="student_info"><span class="bold">Address:</span> ' . $row["ADDRESS"] . '</div>';
                echo '<div class="student_info"><span class="bold">Sex:</span> ' . $row["SEX"] . '</div>';
                echo '<div class="student_info"><span class="bold">Graduation year:</span> ' . $row["GRADYEAR"] . '</div>';
                echo '<div class="student_info"><span class="bold">Major:</span> ' . $row["SFIELDOFSTUDY"] . '</div>';
                echo '<form class="student_info" method="post" action="includes/edit_student.php">
                        <input type="submit" name="redirect" value="Edit Information">
                      </form>';
                echo '</div>';
            }
        } else {
            echo "No student found";
        }
    } else {
        echo "Student ID not found in session!";
    }
    
    // Close the database connection
    $conn->close();

?>
