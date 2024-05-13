<?php
include('db.php');

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    // Retrieve PDF path from the database
    $query = "SELECT pdf_path FROM c_outline WHERE id = $id";
    $result = mysqli_query($con, $query);
    
    if($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $pdf_path = $row['pdf_path'];

        // Delete the PDF file from the directory
        if(unlink($pdf_path)) {
            // Delete record from the database
            $delete_query = "DELETE FROM c_outline WHERE id = $id";
            $delete_result = mysqli_query($con, $delete_query);
            
            if($delete_result) {
                echo "PDF record and file deleted successfully.";
            } else {
                echo "Error deleting PDF record: " . mysqli_error($con);
            }
        } else {
            echo "Error deleting PDF file.";
        }
    } else {
        echo "Record not found.";
    }
} else {
    echo "Invalid request.";
}
?>
