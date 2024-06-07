<?php
// Include the database connection file
include 'connect.php';

// Check if the form is submitted
if (isset($_POST['show'])) {
    // Execute the query for events
    $eventQuery = "SELECT * FROM `event` WHERE RoomNo = 1";
    $eventResult = mysqli_query($conn, $eventQuery);
}

// Check if the "View Sponsors" button is clicked
// Check if the "View Sponsors" button is clicked
if (isset($_POST['viewSponsors'])) {
    // Execute the query for sponsors
    $sponsorQuery = "SELECT * FROM `sponsor` WHERE EventName='BinaryBattle'"; // Fix the table name here
    $sponsorResult = mysqli_query($conn, $sponsorQuery);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show Events and Sponsors</title>
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
        <input type="submit" name="show" value="Show Events">
        <input type="submit" name="viewSponsors" value="View Sponsors">
    </form>

    <?php
    // Display the result in a table for events
    if (isset($eventResult) && $eventResult) {
        echo "<table>
                <tr>
                    <th>EventName</th>
                    <th>RoomNo</th>
                    <th>Building</th>
                    <th>Floor</th>
                    <th>DateOfEvent</th>
                    <th>ClubId</th>
                </tr>";

        while ($row = mysqli_fetch_assoc($eventResult)) {
            echo "<tr>
                    <td>{$row['EventName']}</td>
                    <td>{$row['RoomNo']}</td>
                    <td>{$row['Building']}</td>
                    <td>{$row['Floor']}</td>
                    <td>{$row['DateOfEvent']}</td>
                    <td>{$row['ClubId']}</td>
                </tr>";
        }

        echo "</table>";
    } elseif (isset($eventResult)) {
        echo "Error in Events Query: " . mysqli_error($conn);
    }

    // Display the result in a table for sponsors if the "View Sponsors" button is clicked
    if (isset($sponsorResult) && $sponsorResult) {
        echo "<table>
                <tr>
                    <th>SponorName</th>
                    <th>SponsorContact</th>
                    <th>SponsorAmount</th>
                    <th>SponsorStartDate</th>
                    <th>EventName</th>
                </tr>";

        while ($row = mysqli_fetch_assoc($sponsorResult)) {
            echo "<tr>
                    <td>{$row['SponorName']}</td>
                    <td>{$row['SponsorContact']}</td>
                    <td>{$row['SponsorAmount']}</td>
                    <td>{$row['SponsorStartDate']}</td>
                    <td>{$row['EventName']}</td>
                </tr>";
        }

        echo "</table>";
    } elseif (isset($sponsorResult)) {
        echo "Error in Sponsors Query: " . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
    ?>
</body>

</html>
