<?php
session_start();

// Check if user is logged in as teacher
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'teacher') {
    header("Location: ../auth/login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Teacher Dashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex">

  <!-- Sidebar -->
  <aside class="w-64 bg-white shadow-lg p-6 flex flex-col">
    <h1 class="text-2xl font-bold text-green-600 mb-8">Teacher Panel</h1>
    <nav class="flex flex-col gap-4">
      <a href="attendance.php" class="p-3 rounded-lg hover:bg-green-100 hover:text-green-700 transition">Mark Attendance</a>
      <a href="marks.php" class="p-3 rounded-lg hover:bg-green-100 hover:text-green-700 transition">Upload Marks</a>
      <a href="../auth/logout.php" class="p-3 rounded-lg hover:bg-red-100 hover:text-red-600 transition">Logout</a>
    </nav>
  </aside>

  <!-- Main Content -->
  <main class="flex-1 p-10">
    <div class="bg-white p-8 rounded-3xl shadow-xl mb-8">
      <h2 class="text-3xl font-bold mb-4">Welcome, Teacher <?php echo $_SESSION['username']; ?> 👋</h2>
      <p class="text-gray-600">Use the sidebar to mark attendance, upload student marks, or logout.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
      <div class="bg-green-500 text-white p-6 rounded-2xl shadow hover:shadow-lg transition">
        <h3 class="text-xl font-bold mb-2">Mark Attendance</h3>
        <p>Quickly mark attendance for your classes.</p>
      </div>
      <div class="bg-blue-500 text-white p-6 rounded-2xl shadow hover:shadow-lg transition">
        <h3 class="text-xl font-bold mb-2">Upload Marks</h3>
        <p>Upload students' marks efficiently and securely.</p>
      </div>
    </div>
  </main>

</body>
</html>

