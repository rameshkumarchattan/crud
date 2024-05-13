<?php include('db.php'); ?>

<!DOCTYPE html>  
<html>  
<head>  
</head>  
<body>
    <center>
    <?php
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $query = "SELECT * FROM c_outline WHERE id = '$id'";
        $run = mysqli_query($con, $query);
        $fetch = mysqli_fetch_assoc($run);

        if (!$fetch) {
            die("Invalid ID.");
        }

        $pdf_path = $fetch['pdf_path'];
        $name = $fetch['user_name'];
        $lastname = $fetch['last_name']; 
        $course = $fetch['course'];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['Name'];
            $lastname = $_POST['Last_name'];
            $course = $_POST['course'];

            // Update data into the database
            $updateQuery = "UPDATE c_outline SET user_name = '$name', last_name = '$lastname', course = '$course' WHERE id = '$id'";
            mysqli_query($con, $updateQuery);
            
            // Redirect back to the main page after editing the record
            header("Location: Display.php");
            exit();
        }
    } else {
        die("Invalid Request.");
    }
    ?>

    <form action="" method="post" enctype="multipart/form-data">  
        <div class="container">  
            <center><h1>Edit PDF Record</h1></center>  
            <hr>  
            <label>PDF</label>
            <input type="text" name="pdf_path" value="<?php echo $pdf_path; ?>" disabled><br><br>
            <label>User Name</label>   
            <input type="text" name="Name" placeholder="User Name" size="15" value="<?php echo $name; ?>" required />   
            <label>Last Name:</label>    
            <input type="text" name="Last_name" placeholder="Last Name" size="15" value="<?php echo $lastname; ?>" required />  
            <label>Course</label>
            <select name="course" required>
                <option value="Web-development" <?php if($course == "Web-development") echo "selected"; ?>>Web Development</option>
                <option value="Full-Stack" <?php if($course == "Full-Stack") echo "selected"; ?>>Full Stack</option>
                <option value="Advance-python" <?php if($course == "Advance-python") echo "selected"; ?>>Advance Python</option>
                <option value="Cyber-Security" <?php if($course == "Cyber-Security") echo "selected"; ?>>Cyber Security</option>
            </select>
            <button type="submit" name="submit" class="registerbtn">Update</button> 
            <button type="button" class="registerbtn"><a href="display.php" style="text-decoration: none;">Cancel</a></button>    
        </div>
    </form>  
    </center>
</body>
</html>
