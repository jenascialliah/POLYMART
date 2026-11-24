<?php
// db connection
$conn = new mysqli("localhost", "root", "", "student_schedule");

// check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// fetch data from view
$sql = "SELECT * FROM student_schedule_view";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo $row['Student_Name'] . " - " . $row['Subject_Name'] . " - " . $row['Professor_Name'] . "<br>";
    }
} else {
    echo "No records found.";
}

$conn->close();
?>
