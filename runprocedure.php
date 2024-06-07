<?php
include 'connect.php';

// Check if the form is submitted
if (isset($_POST['runProcedure'])) {
    // Call the stored procedure
    $procedureCall = "CALL GetEventDetailsWithParticipants()";
    $result = $conn->query($procedureCall);

    if (!$result) {
        echo "Error executing the stored procedure: " . $conn->error;
    } else {
        // Display the result in a table
        echo "<table class='result-table'>
                <tr>
                    <th>EventName</th>
                    <th>RoomNo</th>
                    <th>Building</th>
                    <th>Floor</th>
                    <th>DateOfEvent</th>
                    <th>ClubId</th>
                    <th>ClubName</th>
                    <th>ClubHead</th>
                    <th>NumberOfMembers</th>
                    <th>GuestName</th>
                    <th>Age</th>
                    <th>ParticipantSrn</th>
                    <th>ParticipantName</th>
                    <th>Department</th>
                    <th>Semester</th>
                </tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['EventName']}</td>
                    <td>{$row['RoomNo']}</td>
                    <td>{$row['Building']}</td>
                    <td>{$row['Floor']}</td>
                    <td>{$row['DateOfEvent']}</td>
                    <td>{$row['ClubId']}</td>
                    <td>{$row['ClubName']}</td>
                    <td>{$row['ClubHead']}</td>
                    <td>{$row['NumberOfMembers']}</td>
                    <td>{$row['GuestName']}</td>
                    <td>{$row['Age']}</td>
                    <td>{$row['ParticipantSrn']}</td>
                    <td>{$row['ParticipantName']}</td>
                    <td>{$row['Department']}</td>
                    <td>{$row['Semester']}</td>
                </tr>";
        }

        echo "</table>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Run Stored Procedure</title>
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

        .result-table {
            width: 50%;
            margin: 20px auto;
            border-collapse: collapse;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }

        .result-table, th, td {
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
        <input type="submit" name="runProcedure" value="Run Stored Procedure">
    </form>
</body>
</html>
