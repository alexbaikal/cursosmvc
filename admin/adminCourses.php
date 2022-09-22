<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="stylesheet" type="text/css" href="../styles/admin.css">
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
echo "<input type='text' name='search' placeholder='Cerca per nom o DNI'>";
echo "<input type='submit' value='Cerca'>";
echo "</form>";
echo "</div>";

//if the search bar is not empty, search for the teacher
$query = "SELECT * FROM courses";
if (isset($_GET['search'])) {

  $query = 'SELECT * FROM courses WHERE teacher_id LIKE "%' . $_GET['search'] . '%" OR name LIKE "%' . $_GET['search'] . '%"';

}

  $result = mysqli_query($con, $query);

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



  while ($row = mysqli_fetch_array($result)) {

    if( isset($_GET['delete_teacher_id']) && $row['teacher_id'] == $_GET['delete_teacher_id'] ){

      $deleteQuery = "DELETE FROM courses WHERE teacher_id = '" . $row['teacher_id']."'";
      
      if (mysqli_query($con, $deleteQuery)  === TRUE) {
        echo"Deleted successfuly: ".$row['teacher_id'];
        header("Refresh:2");
      } else {
        echo "error";

      }
  
      //header('location:adminTeachers.php');
      //exit;
  
  }    else {
  }

    echo "<tr>";

    echo "<td>" . $row['teacher_id'] . "</td>";

    echo "<td>" . $row['name'] . "</td>";

    echo "<td>" . $row['description'] . "</td>";

    echo "<td>" . $row['duration'] . "</td>";

    echo "<td>" . $row['start'] . "</td>";

    echo "<td>" . $row['end'] . "</td>";

    
    echo "<form method='post' action=".htmlspecialchars($_SERVER["PHP_SELF"])." >";
    echo "<td><a href='adminTeachersEdit.php?teacher_id=".$row['teacher_id']."'>Editar</a>";
    echo "<td><a href='adminTeachers.php?delete_teacher_id=".$row['teacher_id']."'>Eliminar</a>";
   
    echo "</td>";
    echo "</tr>";
  }

  echo "</table>";



  mysqli_close($con);

  ?>
  </div>
  <a href="adminTeachers.php" class="btn btn-primary">Tornar</a>
  <button type="button" onclick="window.location.href='adminCoursesAdd.php'" class="btn btn-primary">Afegir curs</button>

</body>

</html>