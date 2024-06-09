
<?php
include 'connect.php';
if(isset($_GET['delete'])){
    $delete_id = $_GET['delete'];
    echo $delete_id;

    //delete query
    $delete_data = mysqli_query($conn, "Delete from `event` where EventName like '$delete_id'") or die("Query failed");
    
    // $stmt = mysqli_prepare($conn, "DELETE FROM `event` WHERE EventName = ?");
    // mysqli_stmt_bind_param($stmt, "s", $delete_id);
    if ($stmt){
        header('location:display_event.php');
    }
    else{
        header('location:display_event.php');
    }
}

?>
