<?php include 'connect.php';?>

<?php include 'connect.php';
//inserting data inside table
if(isset($_POST['submit'])){
    //echo "success";
    $EventName=$_POST['EventName'];
    $EventVenue=$_POST['EventVenue'];
    $EventDate=$_POST['EventDate'];
    
    echo $EventName;
    echo $EventVenue;
    echo $EventDate;

    //insert query
    $sql = "insert into `event` (EventName, EventVenue, EventDate) values ('$EventName', '$EventVenue', '$EventDate')";
    $result = mysqli_query($conn, $sql);
    if($result){
        header('location:display_event.php');
    }else{
        echo die("Data not inserted");
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Add Event Details</title>
<!-- css file -->
<link rel = "stylesheet" href="style.css">
</head>
<body>
    <h1>Add Event Details</h1>
    <a href = "display_event.php">View Data</a>
    <form action="" method="post">
        <input type="text" placeholder="Enter Event Name" required autocomplete="off" name="EventName">
        <input type="text" placeholder="Enter Event Venue" required autocomplete="off" name="EventVenue">
        <input type="date" placeholder="Enter Event Date" required autocomplete="off" name="EventDate">
        <input type="submit" class="btn" name="submit">

    </form>
    <a href=""></a>

</body>
</html>

