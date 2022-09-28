<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="stylesheet" href="../styles/admin.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin - cursos</title>
</head>

<body>
  <?php
  // Initialize the session
  session_start();

  // Check if the user is logged in, if not then redirect him to login page
  if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: ../login.php");
    exit;
  }
  ?>
  <h1>Administrar cursos</h1>
  <?php
  require_once "../config.php";

  $con = mysqli_connect("localhost", "root", "");

  if (!$con) {

    die('Could not connect.');
  }



  mysqli_select_db($con, "courses");

  //add a search bar

  echo "<div style='display: flex; justify-content: center; margin-bottom: 20px; align-items:center;'>";
  echo "<form action='adminCourses.php' method='GET'>";
  echo "<input type='text' name='search' placeholder='Cerca per nom del curs o DNI'>";
  echo "<input type='submit' value='Cerca'>";
  echo "</form>";
  echo "</div>";

  //if the search bar is not empty, search for the teacher
  $query = "SELECT * FROM courses";
  if (isset($_GET['search'])) {

    $query = 'SELECT * FROM courses WHERE teacher_id LIKE "%' . $_GET['search'] . '%" OR name LIKE "%' . $_GET['search'] . '%"';
  }

  $courses = mysqli_query($con, $query);






  ?>

  <div style="width: 100%; display: flex; justify-content: center; margin-bottom: 20px; align-items:center;">

    <?php

    echo "<table border='1'>

<tr>

<th>Professor</th>

<th>Nom</th>

<th>Descripció</th>

<th>Duració</th>

<th>Inici</th>

<th>Fi</th>

</tr>";

    //select from teacher where dni coincides with the one in the url

    $query = 'SELECT * FROM teacher';

    $result = mysqli_query($con, $query);

    if ($result == null) {

      echo "No s'ha trobat els professors";

      exit;
    }


    while ($course_row = mysqli_fetch_array($courses)) {

      if (isset($_GET['delete_id_course']) && $course_row['id_course'] == $_GET['delete_id_course']) {

        $deleteQuery = "DELETE FROM courses WHERE id_course = '" . $course_row['id_course'] . "'";

        if (mysqli_query($con, $deleteQuery)  === TRUE) {
          echo "Deleted successfuly: " . $course_row['id_course'];
          header("Refresh:2");
        } else {
          echo "error";
        }

        //header('location:adminTeachers.php');
        //exit;

      }

      echo "<tr>";
      //pick theacher name that coincides with course_row teacher_id
      while ($teacher_row = mysqli_fetch_array($result)) {
        if ($course_row['teacher_id'] == $teacher_row['teacher_id']) {
          echo "<td>" . $teacher_row['name'] . "</td>";
        }
      }
      echo "<td>" . $course_row['name'] . "</td>";

      echo "<td>" . $course_row['description'] . "</td>";

      echo "<td>" . $course_row['duration'] . "</td>";

      echo "<td>" . date('d/m/Y', $course_row['start']) . "</td>";

      echo "<td>" . date('d/m/Y', $course_row['end']) . "</td>";

      echo "<form method='post' action=" . htmlspecialchars($_SERVER["PHP_SELF"]) . " >";

      echo "<td><a href='adminCoursesEdit.php?id_course=" . $course_row['id_course'] . "'>Editar</a>";

      echo "<td><a href='adminCourses.php?delete_id_course=" . $course_row['id_course'] . "'>Eliminar</a>";

      echo "</td>";

      echo "</tr>";

      mysqli_data_seek($result, 0);
    }




    echo "</table>";



    mysqli_close($con);

    ?>
  </div>
  <a href="adminPanel.php" class="btn btn-primary"><- Volver</a>
  <button type="button" onclick="window.location.href='adminCoursesAdd.php'" class="btn btn-primary">+ Añadir curss</button>

</body>

</html>