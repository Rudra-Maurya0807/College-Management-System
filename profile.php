<?php
session_start();
include("../config/db.php");

// Only students can access
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'student') {
    header("Location: ../auth/login.php");
    exit();
}

// Fetch student info
$username = $_SESSION['username'];
$sql = "SELECT * FROM students WHERE email='$username'";
$result = mysqli_query($conn, $sql);
$student = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My Profile</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

  <div class="bg-white shadow-xl rounded-2xl p-8 w-full max-w-md">
    <div class="text-center mb-6">
      <div class="w-24 h-24 mx-auto rounded-full bg-gradient-to-r from-blue-400 to-blue-600 flex items-center justify-center text-white text-3xl font-bold">
        <?php echo strtoupper(substr($student['name'], 0, 1)); ?>
      </div>
      <h2 class="text-2xl font-bold text-gray-800 mt-4">My Profile</h2>
    </div>

    <div class="space-y-4">
      <p class="text-gray-700"><span class="font-semibold">Name:</span> <?php echo $student['name']; ?></p>
      <p class="text-gray-700"><span class="font-semibold">Email:</span> <?php echo $student['email']; ?></p>
      <p class="text-gray-700"><span class="font-semibold">Course:</span> <?php echo $student['course']; ?></p>
      <p class="text-gray-700"><span class="font-semibold">Department:</span> <?php echo $student['department']; ?></p>
    </div>

    <div class="mt-6 text-center">
      <a href="edit-profile.php" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
        Edit Profile
      </a>
    </div>
  </div>

</body>
</html>
