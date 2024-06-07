<?php 
include 'connect.php';

// inserting data
if(isset($_POST['submit']))
{
    $srn = $_POST['srn'];
    $name = $_POST['name'];
    $department = $_POST['department'];
    $semester = $_POST['semester'];

    // insert query using prepared statement
    $stmt = $conn->prepare("INSERT INTO `participant` (Srn, Name, Department, Semester) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sssi", $srn, $name, $department, $semester);
    
    if($stmt->execute()) {
        echo "Data inserted Successfully";
    } else {
        echo "Data isn't inserted: " . $stmt->error;
    }

    $stmt->close();
}
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP CRUD-Project</title>
    <!--css file-->
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>PHP CRUD<h1>
        <form action="" method="post">
            <input type="text" placeholder="Enter the SRN" required autocomplete="off" name="srn">
            <input type="text" placeholder="Enter Name" required autocomplete="off" name="name">
            <input type="text" placeholder="Enter Department" required autocomplete="off" name="department">
            <input type="number" placeholder="Enter Semester" required autocomplete="off" name="semester">
            <input type="submit" name="submit">
        </form>
</body>
</html>