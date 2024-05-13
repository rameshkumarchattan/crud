<?php
// Check if form is submitted
if(isset($_POST["submit"])) {
    // Database connection
    $conn = new mysqli("localhost", "root", "", "outline");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // File details
    $fileName = $_FILES["fileToUpload"]["name"];
    $fileTmpName = $_FILES["fileToUpload"]["tmp_name"];

    // Read file data
    $fileData = file_get_contents($fileTmpName);

    // Prepare SQL statement
    $stmt = $conn->prepare("INSERT INTO outline (file_name, file_data) VALUES (?, ?)");
    $stmt->bind_param("ss", $fileName, $fileData);

    // Execute SQL statement
    if($stmt->execute()) {
        echo "PDF uploaded successfully.";
    } else {
        echo "Error uploading PDF: " . $conn->error;
    }

    // Close statement and database connection
    $stmt->close();
    $conn->close();
}
?>
