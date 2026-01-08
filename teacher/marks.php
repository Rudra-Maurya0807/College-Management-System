<?php
session_start();
include("../config/db.php");

if (!isset($_SESSION['username']) || $_SESSION['role'] != 'teacher') {
    header("Location: ../auth/login.php");
    exit();
}

// Save marks
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_id = $_POST['student_id'];
    $subject = $_POST['subject'];
    $marks = $_POST['marks'];

    $sql = "INSERT INTO marks (student_id, subject, marks) 
            VALUES ('$student_id', '$subject', '$marks')";
    mysqli_query($conn, $sql);

    echo "<p>Marks uploaded successfully ✅</p>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Upload Marks</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center p-6">

  <div class="bg-white p-8 rounded-3xl shadow-xl w-full max-w-md">
    <h2 class="text-3xl font-bold text-gray-800 mb-6 text-center">📝 Upload Marks</h2>

    <form method="POST" class="space-y-4">
      <div>
        <label class="block text-gray-700 mb-2" for="student">Student</label>
        <select name="student_id" id="student" required
                class="w-full px-4 py-2 border rounded-xl focus:ring-2 focus:ring-blue-500 outline-none">
          <option value="">Select a student</option>
          <?php
          $students = mysqli_query($conn, "SELECT * FROM students");
          while ($row = mysqli_fetch_assoc($students)) {
              echo "<option value='".$row['student_id']."'>".$row['name']."</option>";
          }
          ?>
        </select>
      </div>

      <div>
        <label class="block text-gray-700 mb-2" for="subject">Subject</label>
        <input type="text" name="subject" id="subject" required placeholder="Enter subject"
               class="w-full px-4 py-2 border rounded-xl focus:ring-2 focus:ring-blue-500 outline-none">
      </div>

      <div>
        <label class="block text-gray-700 mb-2" for="marks">Marks</label>
        <input type="number" name="marks" id="marks" required placeholder="Enter marks"
               class="w-full px-4 py-2 border rounded-xl focus:ring-2 focus:ring-blue-500 outline-none">
      </div>

      <button type="submit"
              class="w-full bg-blue-500 text-white font-semibold py-2 rounded-xl hover:bg-blue-600 transition">
        💾 Save Marks
      </button>
    </form>
  </div>

</body>
</html>
