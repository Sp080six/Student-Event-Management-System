<?php
// Include the database connection file
include 'connect.php';

// Check if the form is submitted for the first query
if (isset($_POST['queryEventsAndSponsors'])) {
    // Execute the query to retrieve events and their sponsors
    $queryEventsAndSponsors = "SELECT event.EventName, RoomNo, Building, Floor, DateOfEvent, ClubName, SponorName 
    FROM event
    INNER JOIN club ON event.clubid = club.clubid
    LEFT JOIN sponsor ON event.EventName = sponsor.EventName";
    $resultEventsAndSponsors = mysqli_query($conn, $queryEventsAndSponsors);
}

// Check if the form is submitted for the second query
if (isset($_POST['queryParticipantsInClubEvents'])) {
    // Execute the query to retrieve participants in events organized by a specific club
    $queryParticipantsInClubEvents = "SELECT Srn, Name, Department, Semester
                                      FROM participant
                                      WHERE Srn IN (SELECT Srn FROM registerfor WHERE eventName IN 
                                                        (SELECT EventName FROM event WHERE clubid = 1))";
    $resultParticipantsInClubEvents = mysqli_query($conn, $queryParticipantsInClubEvents);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show Events, Sponsors, and Participants</title>
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
    </style>
</head>

<body>
    <form method="post" action="">
        <input type="submit" name="queryEventsAndSponsors" value="Show Events and Sponsors">
        <input type="submit" name="queryParticipantsInClubEvents" value="Show Participants in Club Events">
    </form>

    <?php
    // Display the result in a table for events and sponsors
    if (isset($resultEventsAndSponsors) && $resultEventsAndSponsors) {
        echo "<table>
                <tr>
                    <th>EventName</th>
                    <th>RoomNo</th>
                    <th>Building</th>
                    <th>Floor</th>
                    <th>DateOfEvent</th>
                    <th>ClubName</th>
                    <th>SponorName</th>
                </tr>";

        while ($row = mysqli_fetch_assoc($resultEventsAndSponsors)) {
            echo "<tr>
                    <td>{$row['EventName']}</td>
                    <td>{$row['RoomNo']}</td>
                    <td>{$row['Building']}</td>
                    <td>{$row['Floor']}</td>
                    <td>{$row['DateOfEvent']}</td>
                    <td>{$row['ClubName']}</td>
                    <td>{$row['SponorName']}</td>
                </tr>";
        }

        echo "</table>";
    } elseif (isset($resultEventsAndSponsors)) {
        echo "Error in Query 1: " . mysqli_error($conn);
    }

    // Display the result in a table for participants in club events
    if (isset($resultParticipantsInClubEvents) && $resultParticipantsInClubEvents) {
        echo "<table>
                <tr>
                    <th>Srn</th>
                    <th>Name</th>
                    <th>Department</th>
                    <th>Semester</th>
                </tr>";

        while ($row = mysqli_fetch_assoc($resultParticipantsInClubEvents)) {
            echo "<tr>
                    <td>{$row['Srn']}</td>
                    <td>{$row['Name']}</td>
                    <td>{$row['Department']}</td>
                    <td>{$row['Semester']}</td>
                </tr>";
        }

        echo "</table>";
    } elseif (isset($resultParticipantsInClubEvents)) {
        echo "Error in Query 2: " . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
    ?>
</body>

</html>
