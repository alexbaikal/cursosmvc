<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="../styles/admin.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin - professors</title>
</head>

<body>
  <?php
  // Initialize the session
  session_start();

  // Check if the user is logged in, if not then redirect him to login page
  if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $_SESSION["role"] !== "admin") {
    header("location: adminLogin.php");
    exit;
  }
  ?>
  <h1>Administrar professors</h1>
  <?php
  require_once "../config.php";


  if (!$link) {

    die('Could not connect.');
  }




  //add a search bar

  echo "<div style='display: flex; justify-content: center; margin-bottom: 20px; align-items:center;'>";
  echo "<form action='adminTeachers.php' method='GET'>";
  echo "<input type='text' name='search' placeholder='Cerca per nom o DNI'>";
  echo "<input type='submit' value='Cerca'>";
  echo "</form>";
  echo "</div>";

  //if the search bar is not empty, search for the teacher
  $query = "SELECT * FROM teacher";
  if (isset($_GET['search'])) {

    $query = 'SELECT * FROM teacher WHERE dni LIKE "%' . $_GET['search'] . '%" OR name LIKE "%' . $_GET['search'] . '%"';
  }

  $result = mysqli_query($link, $query);

  ?>

  <div style="width: 100%; display: flex; justify-content: center; margin-bottom: 20px; align-items:center;">

    <?php

    echo "<table border='1'>

<tr>

<th>DNI</th>

<th>Nombre</th>

<th>Apellidos</th>

<th>Título</th>

<th>Descripción</th>

<th>Imagen</th>

</tr>";



    while ($row = mysqli_fetch_array($result)) {

      if (isset($_GET['delete_dni']) && $row['dni'] == $_GET['delete_dni']) {

        $deleteQuery = "DELETE FROM teacher WHERE dni = '" . $row['dni'] . "'";

        if (mysqli_query($link, $deleteQuery)  === TRUE) {
          echo "Eliminado correctamente: " . $row['dni'];
          if (isset($row['image'])) {
            //delete image from server inside ../profilepics
            unlink("../profilepics/" . $row['image']);
          }

          header("Refresh:2");
        } else {
          echo "error";
        }

        //header('location:adminTeachers.php');
        //exit;

      } else {
      }

      echo "<tr>";

      echo "<td>" . $row['dni'] . "</td>";

      echo "<td>" . $row['name'] . "</td>";

      echo "<td>" . $row['surname'] . "</td>";

      echo "<td>" . $row['title'] . "</td>";

      echo "<td>" . $row['description'] . "</td>";

      //check if image contains a valid image format (jpg, png, gif, jpeg), if so, display it

      if (strpos($row['image'], 'jpg') !== false || strpos($row['image'], 'png') !== false || strpos($row['image'], 'gif') !== false || strpos($row['image'], 'jpeg') !== false) {

        echo "<td><img style='width: 50px;height:50px' src='../profilepics/" . $row['image'] . "'/></td>";
      } else {

        echo "<td>sense imatge</td>";
      }

      echo "<form method='post' action=" . htmlspecialchars($_SERVER["PHP_SELF"]) . " >";
      echo "<td><a href='adminTeachersEdit.php?dni=" . $row['dni'] . "'>Editar</a>";
      echo "<td><a href='adminTeachers.php?delete_dni=" . $row['dni'] . "'>Eliminar</a>";

      echo "</td>";
      echo "</tr>";
    }

    echo "</table>";



    mysqli_close($link);

    ?>
  </div>
  <button type="button" onclick="window.location.href='adminPanel.php'" class="btn btn-primary">
    <- Volver panel administrador</button>

      <button type="button" onclick="window.location.href='adminTeachersAdd.php'" class="btn btn-primary">+ Añadir profesor</button>

</body>

</html>