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
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>
<button type="button" onclick="window.location.href='adminTeachersAdd.php'" class="btn btn-primary">Afegir professor</button>
<table>
  <thead>
    <tr>
      <th>Nom</th>
      <th>Cognoms</th>
      <th>Títol</th>
      <th>Descripció</th>
      <th>Data creació</th>
      <th></th>
    </tr>
   </thead>
   <tbody>
     <tr>
       <td>text1.1</td>
       <td>text1.2</td>
       <td>text1.3</td>
       <td>text1.3</td>
       <td>text1.3</td>
       <td>
       <button type="button" class="btn btn-primary">Editar</button>
       <button type="button" class="btn btn-primary">Eliminar</button>
       </td>

     </tr>
     <tr>
       <td>text2.1</td>
       <td>text2.2</td>
       <td>text2.3</td>
       <td>text1.3</td>
       <td>text1.3</td>
       <td>
       <button type="button" class="btn btn-primary">Editar</button>
       <button type="button" class="btn btn-primary">Eliminar</button>
       </td>

     </tr>
     <tr>
       <td>text3.1</td>
       <td>text3.2</td>
       <td>text3.3</td>
       <td>text1.3</td>
       <td>text1.3</td>
       <td>
       <button type="button" class="btn btn-primary">Editar</button>
       <button type="button" class="btn btn-primary">Eliminar</button>
       </td>

     </tr>
     <tr>
     </tr>
  </tbody>
</table>
</body>
</html>