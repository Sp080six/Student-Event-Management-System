#Function

#5: To get count of participants from each department
DROP FUNCTION IF EXISTS GetCount;

DELIMITER //

CREATE FUNCTION GetCount(d VARCHAR(25)) RETURNS INT
BEGIN
    DECLARE count INT;
    
    SELECT COUNT(*) INTO count
    FROM participant
    WHERE Department = d;

    RETURN count;
END //

DELIMITER ;

SELECT Department, GetCount(Department) AS Count
FROM participant
GROUP BY Department;
