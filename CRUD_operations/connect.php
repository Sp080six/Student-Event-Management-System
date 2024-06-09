<?php

$conn = mysqli_connect('localhost', 'root', '', 'student_event');
if(!$conn){
    echo "Connection refused";
}
