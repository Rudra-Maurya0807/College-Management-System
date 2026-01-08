<?php
session_start();
include("../config/db.php");

if (!isset($_SESSION['username']) || $_SESSION['role'] != 'student') {
    header("Location: ../auth/login.php");
    exit();
}

// Get student id
$username = $_SESSION['username'];
$student = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM students WHERE email='$username'"));
$student_id = $student['student_id'];

$result = mysqli_query($conn, "SELECT * FROM attendance WHERE student_id='$student_id'");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My Attendance</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">

  <!-- Header -->
  <header class="bg-blue-600 text-white p-4 shadow-md">
    <div class="max-w-5xl mx-auto flex justify-between items-center">
      <h1 class="text-xl font-bold">📅 My Attendance</h1>
      <span class="text-sm">Welcome, <b><?php echo $_SESSION['username']; ?></b> 👋</span>
    </div>
  </header>

  <!-- Table Section -->
  <main class="max-w-5xl mx-auto p-6 flex-1">
    <div class="bg-white shadow-lg rounded-xl overflow-hidden">
      <table class="min-w-full text-left border-collapse">
        <thead class="bg-blue-600 text-white">
          <tr>
            <th class="py-3 px-6">Date</th>
            <th class="py-3 px-6">Status</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr class="border-b hover:bg-gray-50 transition">
              <td class="py-3 px-6 text-gray-700"><?php echo $row['date']; ?></td>
              <td class="py-3 px-6">
                <?php if ($row['status'] == 'Present') { ?>
                  <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-sm font-medium">✅ Present</span>
                <?php } else { ?>
                  <span class="px-3 py-1 bg-red-100 text-red-700 rounded-full text-sm font-medium">❌ Absent</span>
                <?php } ?>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </main>

  <!-- Footer -->
  <footer class="bg-gray-200 text-center py-4 text-sm text-gray-600">
    &copy; <?php echo date("Y"); ?> Student Portal. All Rights Reserved.
  </footer>

</body>
</html>
