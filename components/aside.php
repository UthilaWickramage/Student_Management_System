<?php

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" href="styles/sidebar.css">
  <title>Document</title>
</head>

<body>
  <div class="sidebar">
    <div class="logo-details">
    
      
      <?php
      $fname = null;
      $lname = null;
      if (isset($_SESSION["admin"])) {
        $fname = $_SESSION["admin"]["admin_name"];
        
      } else if (isset($_SESSION["officer"])) {
        $fname = $_SESSION["officer"]["first_name"];
        $lname = $_SESSION["officer"]["last_name"];
      } else if (isset($_SESSION["teacher"])) {
        $fname = $_SESSION["teacher"]["first_name"];
        $lname = $_SESSION["teacher"]["last_name"];
      } else if (isset($_SESSION["student"])) {
        $fname = $_SESSION["student"]["first_name"];
        $lname = $_SESSION["student"]["last_name"];
      }

      ?>
      <div class="logo_name fs-6 ms-3"><?php echo $fname . " " . $lname?></div>
      <i class='bx bx-menu' id="btn"></i>
    </div>
    <ul class="nav-list ps-0">

      <?php
      if (isset($_SESSION["admin"])) {

      ?>
        <li>
          <a href="dashboard.php">
            <i class='bx bx-grid-alt'></i>
            <span class="links_name">Dashboard</span>
          </a>
          <span class="tooltip">Dashboard</span>
        </li>
        <li>
          <a href="manageStudent.php">
            <i class='bx bx-user'></i>
            <span class="links_name">Manage Students</span>
          </a>
          <span class="tooltip">Manage Students</span>

        </li>
        <li>
          <a href="newTeacher.php">
            <i class='bx bxs-user-rectangle'></i>
            <span class="links_name">Register Teacher</span>
          </a>
          <span class="tooltip">Register Teacher</span>
        </li>
        <li>
          <a href="manageTeacher.php">
            <i class='bx bxs-user-account'></i>
            <span class="links_name">Manage Teacher</span>
          </a>
          <span class="tooltip">Manage Teacher</span>
        </li>
        <li>
          <a href="subjectCombination.php">
            <i class='bx bx-heart'></i>
            <span class="links_name">Subject Combinations</span>
          </a>
          <span class="tooltip">Subject Combinations</span>
        </li>
        <li>
          <a href="newOfficer.php">
            <i class='bx bxs-user-rectangle'></i>
            <span class="links_name">Register Officer</span>
          </a>
          <span class="tooltip">Register Officer</span>
        </li>
        <li>
          <a href="manageOfficer.php">
            <i class='bx bxs-user-account'></i>
            <span class="links_name">Manage Officer</span>
          </a>
          <span class="tooltip">Manage Officer</span>
        </li>
        <li>
          <a href="addSubject.php">
            <i class='bx bx-book-content'></i>
            <span class="links_name">New Subject</span>
          </a>
          <span class="tooltip">New Subject</span>
        </li>
        <li>
          <a href="addGrade.php">
            <i class='bx bxs-calendar-plus'></i>
            <span class="links_name">New Grade</span>
          </a>
          <span class="tooltip">New Grade</span>
        </li>
        
        <li>
          <a href="settings.php">
            <i class='bx bx-cog'></i>
            <span class="links_name">Settings</span>
          </a>
          <span class="tooltip">Settings</span>
        </li>
      <?php
      } else if (isset($_SESSION["officer"])) {

      ?>
       
        <li>
          <a href="newStudent.php">
            <i class='bx bxs-user-rectangle'></i>
            <span class="links_name">Register Student</span>
          </a>
          <span class="tooltip">Register Student</span>
        </li>
       
        <li>
          <a href="assignmentResults.php">
            <i class='bx bxs-book-content'></i>
            <span class="links_name">Assignment Results</span>
          </a>
          <span class="tooltip">View & Release Assignment Marks</span>
        </li>
        <li>
          <a href="settings.php">
            <i class='bx bx-cog'></i>
            <span class="links_name">Settings</span>
          </a>
          <span class="tooltip">Settings</span>
        </li>

      <?php
      } else if (isset($_SESSION["teacher"])) {

      ?>
        <li>
          <a href="dashboard.php">
            <i class='bx bx-grid-alt'></i>
            <span class="links_name">Dashboard</span>
          </a>
          <span class="tooltip">Dashboard</span>
        </li>
        <li>
          <a href="uploadLesson.php">
            <i class='bx bxs-user-rectangle'></i>
            <span class="links_name">Add lesson notes</span>
          </a>
          <span class="tooltip">Add lesson notes</span>
        </li>
        <li>
          <a href="uploadAssignment.php">
            <i class='bx bxs-user-account'></i>
            <span class="links_name">Add new assignments</span>
          </a>
          <span class="tooltip">Add new assignments</span>
        </li>
        <li>
          <a href="downloadAnswers.php">
            <i class='bx bxs-book-content'></i>
            <span class="links_name">View answer sheets</span>
          </a>
          <span class="tooltip">View answer sheets</span>
        </li>
        <li>
          <a href="submitResults.php">
            <i class='bx bxs-book-content'></i>
            <span class="links_name">Assignment Marks</span>
          </a>
          <span class="tooltip"> Assignment Marks</span>
        </li>
        <li>
          <a href="settings.php">
            <i class='bx bx-cog'></i>
            <span class="links_name">Settings</span>
          </a>
          <span class="tooltip">Settings</span>
        </li>
      <?php
      } else if (isset($_SESSION["student"])) {

      ?>
        <li>
          <a href="dashboard.php">
            <i class='bx bx-grid-alt'></i>
            <span class="links_name">Dashboard</span>
          </a>
          <span class="tooltip">Dashboard</span>
        </li>
        <li>
          <a href="downloadLessons.php">
            <i class='bx bxs-user-rectangle'></i>
            <span class="links_name">Lesson notes</span>
          </a>
          <span class="tooltip">Lesson notes</span>
        </li>
        <li>
          <a href="downloadAssignment.php">
            <i class='bx bxs-book-content'></i>
            <span class="links_name">View assignments</span>
          </a>
          <span class="tooltip">View assignments</span>
        </li>
        <li>
          <a href="viewResults.php">
            <i class='bx bxs-book-content'></i>
            <span class="links_name">View Results</span>
          </a>
          <span class="tooltip">View Results</span>
        </li>
        <li>
          <a href="settings.php">
            <i class='bx bx-cog'></i>
            <span class="links_name">Settings</span>
          </a>
          <span class="tooltip">Settings</span>
        </li>
      <?php
      }
      ?>



    </ul>
  </div>




  <script src="bootstrap.js"></script>
  <script src="bootstrap.bundle.js"></script>

</body>
<!-- <li class="profile">
        <div class="profile-details">
          <img src="profile.jpg" alt="profileImg">
          <div class="name_job">
            <div class="name">Prem Shahi</div>
            <div class="job">Web designer</div>
          </div>
        </div>
        <i class='bx bx-log-out' id="log_out"></i>
      </li> -->

</html>