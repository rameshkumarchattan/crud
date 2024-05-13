<?php include('db.php'); ?>

<!DOCTYPE html>  
<html>  
<head>  
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .upload-btn {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }

        .upload-btn:hover {
            background-color: #45a049;
            /*text-decoration: none;*/
        }
    </style>
</head>  
<body>
    <center>
        <button class="upload-btn"><a href="pdf.php" style="text-decoration:none;">Upload New</a></button>

        <table border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User Name</th>
                    <th>Last Name</th>
                    <th>Course</th>
                    <th>PDF</th>
                    <th>Action</th>

                </tr>
            </thead>
            <tbody>
                <?php
                $query = "SELECT * FROM c_outline";
                $result = mysqli_query($con, $query);

                if ($result && mysqli_num_rows($result)) {
                    while ($fetch = mysqli_fetch_assoc($result)) {

                        $id = $fetch['id'];
                        $name = $fetch['user_name'];
                        $lastname = $fetch['last_name'];
                        $course = $fetch['course'];
                        $pdf = $fetch['pdf_path'];


                        echo 
                        "<tr>
                        <td>$id</td>
                        <td>$name</td>
                        <td>$lastname</td>
                        <td>$course</td>
                        <td>$pdf</td>
                        <td> 
                        <button><a href='edit.php?id=$id'>Edit</a></button>
                        <button><a href='Delete.php?id=$id'>Delete</a></button>
                        <button><a href='pdf.php?=$id'>Add new</a></button>
                        </td>
                        </tr>";



                      /*   echo "<tr>";
                         echo "<td>".$row['user_name']."</td>";
                         echo "<td>".$row['last_name']."</td>";
                         echo "<td>".$row['course']."</td>";
                         echo "<td><a href='".$row['pdf_path']."' target='_blank'>Download PDF</a></td>";
                         echo "<td> 
                             <button><a href='edit.php?id=".$row['id']."'>Edit</a></button>
                             <button><a href='Delete.php?id=".$row['id']."'>Delete</a></button>
                             <button><a href='pdf.php'>Add new</a></button>
                             </td>";

                         echo "</tr>";*/
                    }
                } else {
                    echo "<tr><td colspan='5'>No records found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </center>
</body>
</html>
