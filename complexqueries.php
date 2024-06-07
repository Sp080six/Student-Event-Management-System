<?php
// Include the database connection file
include 'connect.php';

// Check if the form is submitted for the first query
if (isset($_POST['query1'])) {
    // Execute the query for participants in the specified event
    $query1 = "SELECT Srn, Name, Department, Semester
               FROM participant
               WHERE Srn IN (SELECT Srn FROM registerfor WHERE eventName ='Anveshana')";
    $result1 = mysqli_query($conn, $query1);
}

// Check if the form is submitted for the second query
if (isset($_POST['query2'])) {
    // Execute the query for events joined with club information
    $query2 = "SELECT EventName, RoomNo, Building, Floor, DateOfEvent, ClubName
               FROM event
               INNER JOIN club ON event.clubid = club.clubid";
    $result2 = mysqli_query($conn, $query2);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show Participants and Events</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        form {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        /* Additional styling for the second table */
        table + table {
            margin-top: 30px;
        }

        table + table th {
            background-color: #3498db;
            color: white;
        }

        table + table tr:nth-child(even) {
            background-color: #ecf0f1;
        }
    </style>
</head>

<body>
    <form method="post" action="">
        <input type="submit" name="query1" value="Show Participants in Anveshana">
        <input type="submit" name="query2" value="Show Events with Club Information">
    </form>

    <?php
    // Display the result in a table for the first query
    if (isset($result1) && $result1) {
        echo "<table>
                <tr>
                    <th>Srn</th>
                    <th>Name</th>
                    <th>Department</th>
                    <th>Semester</th>
                </tr>";

        while ($row = mysqli_fetch_assoc($result1)) {
            echo "<tr>
                    <td>{$row['Srn']}</td>
                    <td>{$row['Name']}</td>
                    <td>{$row['Department']}</td>
                    <td>{$row['Semester']}</td>
                </tr>";
        }

        echo "</table>";
    } elseif (isset($result1)) {
        echo "Error in Query 1: " . mysqli_error($conn);
    }

    // Display the result in a table for the second query
    if (isset($result2) && $result2) {
        echo "<table>
                <tr>
                    <th>EventName</th>
                    <th>RoomNo</th>
                    <th>Building</th>
                    <th>Floor</th>
                    <th>DateOfEvent</th>
                    <th>ClubName</th>
                </tr>";

        while ($row = mysqli_fetch_assoc($result2)) {
            echo "<tr>
                    <td>{$row['EventName']}</td>
                    <td>{$row['RoomNo']}</td>
                    <td>{$row['Building']}</td>
                    <td>{$row['Floor']}</td>
                    <td>{$row['DateOfEvent']}</td>
                    <td>{$row['ClubName']}</td>
                </tr>";
        }

        echo "</table>";
    } elseif (isset($result2)) {
        echo "Error in Query 2: " . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
    ?>
</body>

</html>
