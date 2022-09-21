<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" type="text/css" href="../styles/admin.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - professors</title>
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
    <h1>Administrar professors</h1>

    <div style="display: flex; justify-content: center; margin-bottom: 20px; align-items:center;">
        
    <?php
  require_once "../config.php";

  $con = mysqli_connect("localhost", "root", "");

  if (!$con) {

    die('Could not connect.');
  }



  mysqli_select_db($con, "courses");


  if( isset($_GET['dni'])){

    //select from teacher where dni coincides with the one in the url

    $query = 'SELECT * FROM teacher WHERE dni = "' . $_GET['dni'].'" LIMIT 1';

    $result = mysqli_query($con, $query);
   
if( $result == null ){

      echo "No s'ha trobat el professor amb el DNI: " . $_GET['dni'];

      exit;

    } else {

      $teacher = mysqli_fetch_assoc($result);

    

/*
DNI

Nom

Cognoms

Títol

Descripció

Imatge

*/

//create a form with inputs stacked one on top of another

//each input should have the value of the teacher's data


      echo "<form style='display: flex; flex-direction: column; align-items: center; justify-content: center;'  action='adminTeachersEdit.php' method='post'>";

      echo "<input type='hidden' name='dni' value='" . $teacher['dni'] . "' />";

      echo "<label for='name'>Nom</label>";

      echo "<input type='text' name='name' value='" . $teacher['name'] . "' />";

      echo "<label for='surname'>Cognoms</label>";

      echo "<input type='text' name='surname' value='" . $teacher['surname'] . "' />";

      echo "<label for='title'>Títol</label>";

      echo "<input type='text' name='title' value='" . $teacher['title'] . "' />";

      echo "<label for='description'>Descripció</label>";

      echo "<input type='text' name='description' value='" . $teacher['description'] . "' />";

      echo "<label for='image'>Imatge</label>";

      //create a file input and display stored image on '../profilepics/$teacher['image']'

      echo "<input type='file' name='image' value='" . $teacher['image'] . "' />";
      
      echo "<img style='width:60px;height:60px;' src='../profilepics/" . $teacher['image'] . "' />";


      echo "<input type='submit' value='Guardar' />";

      echo "</form>";

    }

  } else {

    echo "No s'ha trobat el professor amb el DNI: " . $_GET['dni'];

  }




  




  mysqli_close($con);

  ?>
  </div>
    <div class="form-group">
        <br />
        <input type="submit" name="subbtn" class="btn btn-primary" value="Editar professor">
    </div>
</body>

</html>