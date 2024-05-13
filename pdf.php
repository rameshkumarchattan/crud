<?php include('db.php'); ?>

<!DOCTYPE html>  
<html>  
<head> 
<style type="text/css">
    a{
        text-decoration: none;
        color: white;
    }
</style> 
</head>  
<body><br>
    <fieldset style="width: 480px; height: 450px; margin:auto; background-color: ; border-radius: 20px;" >
    </center>
    <form action="" method="post" enctype="multipart/form-data">  
        <div class="container">  
            <center><h1>Upload New Outline</h1></center>  
            <hr>  
            <b><label>Uplaod the outline in PDF format</label><br>
            <input type="file" name="Uploadfile" style="width:380px; padding-left:5px; padding-top:8px; height: 30px; border: 1px solid black;  border-radius: 10px;"><br><br>
            <label>Uploader name</label>  <br> 
            <input type="text" name="Name" placeholder="User Name"  style="width:380px; height: 35px; border: 1px solid black;  border-radius: 10px;" size="15" required /><br><br>   
            <label>Uploader Last Name</label> <br>   
            <input type="text" name="Last_name" style="width:380px; padding-left:5px; padding-top:5px; height: 35px; border: 1px solid black;  border-radius: 10px;" placeholder="Last Name" size="15" required /><br> <br> 
            <label>Course</label><br>
            <select name="course" required style="width:386px; padding-left:5px; padding-top:5px; height: 40px; border: 1px solid black;  border-radius: 10px;">
                <option value="select the course">select the course</option>
                <option value="Web-development">Web Development</option>
                <option value="Full-Stack">Full Stack</option>
                <option value="Advance-python">Advance Python</option>
                <option value="Cyber-Security">Cyber Security</option>
            </select><br><br>
            <center><button type="submit" name="submit" class="registerbtn" style="padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer; border-radius:15px;">Upload</button> 
           </b>
            <button type="submit" name="submit" class="registerbtn" style="padding: 10px 20px;
            background-color:dimgrey;
            color: white;
            border: none;
            cursor: pointer; border-radius:15px;"><a href="display.php" >Cancel</a></button> </b>
              <button type="reset" name="reset" style="padding: 10px 20px;
            background-color:whitesmoke;
            color: black;
            border: none;
            border: 1px solid black;
            cursor: pointer; border-radius:15px;">Reset</button></center>


        </div>
    </form>  
    </fieldset>

    <?php
    if (isset($_POST['submit'])) {
        $filename = $_FILES['Uploadfile']['name'];
        $tem_name = $_FILES['Uploadfile']['tmp_name'];
        $folder = "pdfs/".$filename;
        move_uploaded_file($tem_name, $folder);
        $name = $_POST['Name'];
        $lastname = $_POST['Last_name'];
        $course = $_POST['course'];

        // Inserting data into the database
        $query = "INSERT INTO c_outline(pdf_path, user_name, last_name, course) VALUES('$folder', '$name', '$lastname', '$course')";
        $run = mysqli_query($con, $query);

        if ($run) {
            echo "Your data is successfully inserted into the database";
        } else {
            echo "Could not insert data into the database";
        }
    }
    ?>
</body>
</html>
