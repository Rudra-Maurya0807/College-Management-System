<?php
session_start();
include("../config/db.php");

// Only students
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'student') {
    header("Location: ../auth/login.php");
    exit();
}

// Get student id
$username = $_SESSION['username'];
$student = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM students WHERE email='$username'"));
$student_id = $student['student_id'];

$fee = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM fees WHERE student_id='$student_id'"));
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Fees</title>
</head>
<body>
    <h2>My Fee Status</h2>
    <?php if ($fee) { ?>
        <p><b>Amount:</b> <?php echo $fee['amount']; ?></p>
        <p><b>Status:</b> <?php echo $fee['status']; ?></p>
        <p><b>Due Date:</b> <?php echo $fee['due_date']; ?></p>
    <?php } else { ?>
        <p>No fee record found.</p>
    <?php } ?>
</body>
</html>
