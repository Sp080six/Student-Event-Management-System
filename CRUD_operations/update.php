<?php include 'connect.php';
//update query logic
if(isset($_POST['update_btn'])){
    $EventID=$_POST['EventID'];
    $EventName=$_POST['EventName'];
    $EventVenue=$_POST['EventVenue'];
    $EventDate=$_POST['EventDate'];
    #echo $data_id;
    //upadte query
    $sql="update `event` set EventName='$EventName', EventVenue='$EventVenue', EventDate='$EventDate' where EventID='$EventID'";
    $result=mysqli_query($conn, $sql);
    if($result){
        header('location:display_event.php');
        // echo "Updated successfully";
    }else{
        echo die("Error in updating the data");
    }
}


if(isset($_POST['update_btn'])){
    //echo "success";
    $EventName=$_POST['EventName'];
    $EventVenue=$_POST['EventVenue'];
    $EventDate=$_POST['EventDate'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset='UTF-8'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Data-Project</title>
    <link rel="stylesheet" href="style.css">
    <style>
    th, td{
    border: 1px double #000;
    padding: 5px;
    }
    </style>
</head>
    
<body>
    <h1>Update Event Details</h1>
    <a href = "display_event.php">View Data</a>
    <?php 
if (isset($_GET['edit'])){
    $edit_id = $_GET['edit'];
    echo $edit_id;
    $get_data = mysqli_query($conn, "Select * from `event` where EventName = '$edit_id'");
    if(mysqli_num_rows($get_data)>0){
        $fetch_data = mysqli_fetch_assoc($get_data);
        ?>
        <form action="" method="post">
        <input type="hidden" name="EventID" value="<?php echo $fetch_data['EventID']?>">
        <input type="text" required autocomplete="off" value="<?php echo $fetch_data['EventName']?>" name="EventName">
        <input type="text" required autocomplete="off" value="<?php echo $fetch_data['EventVenue']?>" name="EventVenue">
        <input type="date" required autocomplete="off" value="<?php echo $fetch_data['EventDate']?>" name="EventDate">
        <input type="submit" class="btn" name="update_btn" value="Update">
        </form>
        <?php 
    }
    
}   
?>
    
</body>
</html>
