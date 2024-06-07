<?php
include 'connect.php';

// Drop the existing stored procedure if it exists
$sqlDropProcedure = "DROP PROCEDURE IF EXISTS GetEventDetailsWithParticipants";
$conn->query($sqlDropProcedure);

// Create the stored procedure
$sqlProcedure = <<<SQL
CREATE PROCEDURE GetEventDetailsWithParticipants()
BEGIN
    SELECT 
        e.EventName,
        e.RoomNo,
        e.Building,
        e.Floor,
        e.DateOfEvent,
        e.ClubId,
        c.ClubName,
        c.ClubHead,
        c.NumberOfMembers,
        g.Name AS GuestName,
        g.Age,
        p.Srn AS ParticipantSrn,
        p.Name AS ParticipantName,
        p.Department,
        p.Semester
    FROM
        Event e
    LEFT JOIN
        Club c ON e.ClubId = c.ClubId
    LEFT JOIN
        Guest g ON e.EventName = g.EventName
    LEFT JOIN
        RegisterFor r ON e.EventName = r.EventName
    LEFT JOIN
        Participant p ON r.Srn = p.Srn;
END;
SQL;

// Execute the stored procedure creation query
if ($conn->multi_query($sqlProcedure)) {
    echo "Stored Procedure created successfully.";
} else {
    echo "Error creating stored procedure: " . $conn->error;
}

// Close the connection
$conn->close();
?>
