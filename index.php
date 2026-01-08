<?php
session_start();

// Check if user is logged in as student
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'student') {
    header("Location: ../auth/login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Student Dashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">

  <!-- Header -->
  <header class="bg-blue-600 text-white p-4 shadow-md">
    <div class="max-w-6xl mx-auto flex justify-between items-center">
      <h1 class="text-xl font-bold">🎓 Student Dashboard</h1>
      <span class="text-sm">Welcome, <b><?php echo $_SESSION['username']; ?></b> 👋</span>
    </div>
  </header>

  <!-- Main content -->
  <main class="flex-1 max-w-6xl mx-auto p-6">
    <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">

      <!-- Profile -->
      <a href="profile.php" class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition text-center">
        <div class="text-blue-600 text-3xl mb-3">👤</div>
        <h2 class="text-lg font-semibold text-gray-800">My Profile</h2>
        <p class="text-sm text-gray-500">View and edit your details</p>
      </a>

      <!-- Attendance -->
      <a href="attendance.php" class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition text-center">
        <div class="text-green-600 text-3xl mb-3">📅</div>
        <h2 class="text-lg font-semibold text-gray-800">My Attendance</h2>
        <p class="text-sm text-gray-500">Check your attendance records</p>
      </a>

      <!-- Results -->
      <a href="results.php" class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition text-center">
        <div class="text-purple-600 text-3xl mb-3">📊</div>
        <h2 class="text-lg font-semibold text-gray-800">My Results</h2>
        <p class="text-sm text-gray-500">View your academic results</p>
      </a>

      <!-- Logout -->
      <a href="../auth/logout.php" class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition text-center">
        <div class="text-red-600 text-3xl mb-3">🚪</div>
        <h2 class="text-lg font-semibold text-gray-800">Logout</h2>
        <p class="text-sm text-gray-500">Sign out of your account</p>
      </a>

    </div>
  </main>

  <!-- Footer -->
  <footer class="bg-gray-200 text-center py-4 text-sm text-gray-600">
    &copy; <?php echo date("Y"); ?> Student Portal. All Rights Reserved.
  </footer>

</body>
</html>

