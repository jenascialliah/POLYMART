<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "student_schedule");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Step 1: Get the last added professor (the new professor)
$result = $conn->query("SELECT professor_id, name FROM professors ORDER BY professor_id DESC LIMIT 1");
$row = $result->fetch_assoc();
$new_prof_id = $row['professor_id'];
$new_prof_name = $row['name'];

echo "Assigning students to new professor: $new_prof_name (ID: $new_prof_id)<br>";

// Start transaction
$conn->begin_transaction();

try {
    // Step 2: Get all programs from class table
    $programs_result = $conn->query("SELECT DISTINCT program FROM class");

    if ($programs_result->num_rows > 0) {
        while ($prog = $programs_result->fetch_assoc()) {
            $program_name = $prog['program'];

            // Step 3: Add 3 new students for this program
            for ($i = 1; $i <= 3; $i++) {
                $student_name = "Student_{$program_name}_{$i}";
                $student_email = strtolower($student_name) . "@gmail.com";
                $student_phone = "0917" . rand(1000000, 9999999);
                $student_age = rand(18, 22);
                $student_gender = (rand(0,1) == 0) ? 'Male' : 'Female';

                // Insert new student
                $conn->query("INSERT INTO students(name, age, gender, email, phone_number)
                              VALUES('$student_name', $student_age, '$student_gender', '$student_email', '$student_phone')");
                $student_id = $conn->insert_id;

                echo "Added student: $student_name (ID: $student_id) to program: $program_name <br>";

                // Step 4: Enroll the student in all subjects of the new professor
                $conn->query("INSERT INTO schedule(class_id, student_id, subject_id, professor_id, time_start, time_end, day, room)
                              SELECT class_id, $student_id, subject_id, professor_id, time_start, time_end, day, room
                              FROM schedule
                              WHERE professor_id = $new_prof_id AND student_id IS NULL");
            }
        }
    }

    $conn->commit();
    echo "<br>All students enrolled successfully under the new professor!";

} catch(Exception $e) {
    $conn->rollback();
    echo "Transaction failed: " . $e->getMessage();
}

// Close connection
$conn->close();
?>
