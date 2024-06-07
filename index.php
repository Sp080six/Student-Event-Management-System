<?php 
include 'connect.php';

// inserting data
if(isset($_POST['submit']))
{
    $clubname = $_POST['clubname'];
    //$clubid = $_POST['clubid'];
    $noofmembers = $_POST['noofmembers'];
    $clubhead = $_POST['clubhead'];

    // insert query using prepared statement
    $stmt = $conn->prepare("INSERT INTO `club` (ClubID, ClubName, ClubHead, NumberofMembers) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sssi", $clubid, $clubname, $clubhead, $noofmembers);
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
            <input type="text" placeholder="Enter the Club Name" required autocomplete="off" name="clubname">
            <input type="number" placeholder="Enter Number of members" required autocomplete="off" name="noofmembers">
            <input type="text" placeholder="Enter Name of the Club head" required autocomplete="off" name="clubhead">
            <input type="submit" name="submit">
        </form>
</body>
</html>