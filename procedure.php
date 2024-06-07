<?php
include 'connect.php';

// Stored procedure definition
$sqlProcedure = <<<SQL
CREATE PROCEDURE GetEventDetailsWithOtherTable()
BEGIN
    SELECT 
        p.Srn,
        p.Name AS ParticipantName,
        p.Department,
        p.Semester,
        r.EventName AS RegisteredEvent,
        d.DomainName
    FROM
        participant p
    LEFT JOIN
        registerfor r ON p.Srn = r.Srn
    LEFT JOIN
        domain d ON r.DomainId = d.DomainId;
END
SQL;

// Execute the stored procedure definition
if ($conn->query($sqlProcedure)) {
    echo "Stored procedure created successfully.";
} else {
    echo "Error creating stored procedure: " . $conn->error;
}

// Check if the button is clicked
if (isset($_POST['executeProcedure'])) {
    // Call the stored procedure
    $sql = "CALL GetEventDetailsWithOtherTable()";
    $result = $conn->query($sql);

    if ($result) {
        // Process and display the result
        while ($row = $result->fetch_assoc()) {
            // Process each row
            echo "<pre>" . print_r($row, true) . "</pre>";
        }
    } else {
        // Handle the error
        echo "Error: " . $conn->error;
    }
}
?>
