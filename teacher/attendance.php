<?php
session_start();
include("../config/db.php");

// Only teacher can access
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'teacher') {
    header("Location: ../auth/login.php");
    exit();
}

// Get teacher department
$teacher_email = $_SESSION['username'];
$teacher = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM teachers WHERE email='$teacher_email'"));
$department = $teacher['department'];

// Handle attendance submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $date = date("Y-m-d");
    foreach ($_POST['status'] as $student_id => $status) {
        $check = mysqli_query($conn, "SELECT * FROM attendance WHERE student_id='$student_id' AND date='$date'");
        if(mysqli_num_rows($check) > 0){
            mysqli_query($conn, "UPDATE attendance SET status='$status' WHERE student_id='$student_id' AND date='$date'");
        } else {
            mysqli_query($conn, "INSERT INTO attendance (student_id,date,status) VALUES ('$student_id','$date','$status')");
        }
    }
    $message = "Attendance marked successfully for $department ✅";
}

// Fetch students from this teacher's department
$students = mysqli_query($conn, "SELECT * FROM students WHERE department='$department'");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Mark Attendance - <?php echo $department; ?> Department</title>
</head>
<body>
    <h2>Mark Attendance - <?php echo $department; ?> Department</h2>
    <?php if(isset($message)) { echo "<p>$message</p>"; } ?>
    <form method="POST">
        <table border="1">
            <tr>
                <th>Student</th>
                <th>Present</th>
                <th>Absent</th>
            </tr>
            <?php while($row = mysqli_fetch_assoc($students)) { ?>
            <tr>
                <td><?php echo $row['name']; ?></td>
                <td><input type="radio" name="status[<?php echo $row['student_id']; ?>]" value="Present" required></td>
                <td><input type="radio" name="status[<?php echo $row['student_id']; ?>]" value="Absent"></td>
            </tr>
            <?php } ?>
        </table>
        <br>
        <button type="submit">Save Attendance</button>
    </form>
</body>
</html>
