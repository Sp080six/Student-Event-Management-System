<?php include 'connect.php';?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset='UTF-8'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display Data-Project</title>
    <link rel="stylesheet" href="style.css">
    <style>
    th, td{
    border: 1px double #000;
    padding: 5px;
    }
    </style>
</head>
    
<body>
    <h1>View Event Details </h1>
    <a href = "index_event.php">Back</a>
    
    <?php
$display_data = mysqli_query($conn, "Select * from `event`");
$num = 1;
if(mysqli_num_rows($display_data)>0){
    echo "<table>
    <thead>
        <th>Sl No</th>
        <th>EventName</th>
        <th>EventVenue</th>
        <th>EventDate</th>
        <th>Operations</th>
    </thead>
    <tbody>";
    while($row=mysqli_fetch_assoc($display_data)){
?>

        <tr>
            <td><?php echo $num;?></td>
            <td><?php echo $row['EventName']?></td>
            <td><?php echo $row['EventVenue']?></td>
            <td><?php echo $row['EventDate']?></td>
            <td>
                <a href="delete.php?delete=<?php echo $row ['EventName']?>" onclick = "return confirm ('Are you sure you want to delete this event?');">Delete</a>
                <a href="update.php?edit=<?php echo $row ['EventName']?>">Edit</a>
            </td>
        </tr>  
<?php
$num++;
    }
}else{
    echo "<div>No data</div>";
}
#echo $number_rows;
?>   

    
    </tbody>
</table>
</body>
