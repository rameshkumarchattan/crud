<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update PDF</title>
    <style type="text/css">
        .container {
            width: 50%;
            margin: 0 auto;
            text-align: center;
            margin-top: 50px;
        }

        input[type="file"] {
            margin-bottom: 20px;
        }

        button {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
        }

    </style>
</head>
<body>
<div style="margin:auto; margin-left: 209px;">
    <h2>Update PDF</h2>
    <form action="" method="post" enctype="multipart/form-data">

        <div class="form-group course">

            <br>
            <label for="Course">Select the course outline</label><br><br>
            <select name="course" id="course" style="height: 55px; width:606px;">
                <option value="" selected disabled>Select your Course</option>
                <option value="Web-development">Web-development</option>
                <option value="Full-Stack">Full-Stack</option>
                <option value="Advance-python">Advance-python</option>
                <option value="Cyber-Security">Cyber-security</option>
                <option value="none">None</option>
            </select>
            <br>
            <br>
            <label for="Name" style="text-align: right;">Choose the file you want to Update</label><br>
            <br> <div style="width: 595px; height: 30px;  padding-top: 10px; padding-left: 5px;  border: 1px solid black;">
                <input type="file" name="pdfFile" id="pdfFile" style="width:600px; border: 1px; "> </div>
        </div>
        <br>
        <button type="submit" name="submit" style="border-radius:15px;">Update</button>

        <button type="button" name="reset" style="background-color:gray; border-radius: 15px;">
            <a href="fetch.php" style="text-decoration: none; color:white;">Cancel </a>
        </button>

    </form>
</div>
<?php
// Include config file
require_once "config.php";

// Check if id parameter is provided
if(isset($_GET['id'])) {
    $id = $_GET['id'];

    // Check if form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
        // Check if file was uploaded without errors
        if (isset($_FILES["pdfFile"]) && $_FILES["pdfFile"]["error"] == 0) {
            $fileName = $_FILES["pdfFile"]["name"];
            $fileTempName = $_FILES["pdfFile"]["tmp_name"];
            $fileType = $_FILES["pdfFile"]["type"];
            $folder = "pdfs/".$fileName;

            // Move uploaded file to destination folder
            if (move_uploaded_file($fileTempName, $folder)) {
                // Check file type
                if ($fileType == "application/pdf") {
                    // Read the file content
                    $pdfContent = file_get_contents($folder);
                    // Escape special characters
                    $pdfContent = mysqli_real_escape_string($link, $pdfContent);

                    // Update file content in database
                    $query = "UPDATE c_outline SET file_name = '$fileName', file_content = '$pdfContent' WHERE id = $id";
                    if (mysqli_query($link, $query)) {
                        echo "PDF file updated successfully.";
                    } else {
                        echo "Error: " . mysqli_error($link);
                    }
                } else {
                    echo "Error: Only PDF files are allowed.";
                }
            } else {
                echo "Error moving file to destination folder.";
            }
        } else {
            echo "Error uploading file.";
        }
    }
} else {
    echo "Error: ID parameter is missing.";
}

// Close connection
mysqli_close($link);
?>

</body>
</html>
