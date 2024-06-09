#Simple queries

#1: Display events whose venue is MRD Auditorium
SELECT * FROM `event` WHERE EventName like 'MRD Auditorium';

#2: Display participants from the Electronics dept and studying in 7th semester
SELECT * FROM `participant` WHERE Department like 'ECE' and Semester like 7;

#Nested queries

#3: Display participant details who registered for Hacknight
SELECT Name, Department
FROM participant
WHERE SRN IN (SELECT SRN FROM registersfor WHERE EventName = 'Hacknight');

#4: Display number of event regitrations for each participant
SELECT Name,
       (SELECT COUNT(*) FROM registersfor WHERE SRN = participant.SRN) AS NumberOfRegistrations
FROM participant;

