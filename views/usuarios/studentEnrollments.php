<h1>Gestionar matriculas</h1>

<div style="width: 100%; display: flex; justify-content: center; margin-bottom: 20px; align-items:center; flex-direction: column;">

<?php
require_once "./config.php";

$con = mysqli_connect("localhost", "root", "");

if (!$con) {

    die('Could not connect.');
}



mysqli_select_db($con, "courses");

//add a search bar

echo "<div style='display: flex; justify-content: center; margin-bottom: 20px; align-items:center;'>";
echo "<form action='./index.php?controller=Student&action=studentEnrollments' method='POST'>";
echo "<input type='text' name='search' placeholder='Cerca per nom o descripció del curs'>";
echo "<input type='submit' value='🔎'>";
echo "</form>";
echo "</div>";

//if the search bar is not empty, search for the teacher
$query = "SELECT * FROM courses";
if (isset($_POST['search'])) {

    $query = 'SELECT * FROM courses WHERE teacher_id LIKE "%' . $_POST['search'] . '%" OR name LIKE "%' . $_POST['search'] . '%" OR description LIKE "%' . $_POST['search'] . '%"';
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

<th>Nota</th>
<th>Opciones</th>

</tr>";

    //select from teacher where dni coincides with the one in the url

    $query = 'SELECT * FROM teacher';

    $result = mysqli_query($con, $query);

    if ($result == null) {

        echo "No s'ha trobat els professors";

        exit;
    }



    while ($course_row = mysqli_fetch_array($courses)) {



        if (isset($_GET['quit_id_course']) && $course_row['id_course'] == $_GET['quit_id_course']) {
            //remove enrollment where id_course and id_student coincide
            $quitQuery = 'DELETE FROM enrollment WHERE id_course = ' . $_GET['quit_id_course'] . ' AND id_student = ' . $_SESSION['id'];

            //execute query

            $quitResult = mysqli_query($con, $quitQuery);

            if ($quitResult == null) {

                echo "No s'ha pogut eliminar la matricula";

                exit;
            } else {

                echo "Matricula eliminada";
                header('location:index.php?controller=Student&action=studentEnrollments');

                exit;
            }
        }
        //check if $course_row['id_course'] is in the enrollment table for the current user ($_SESSION['id'])
        $enrollmentQuery = "SELECT * FROM enrollment WHERE id_course = " . $course_row['id_course'] . " AND id_student = " . $_SESSION['id'];

        $resultQuery = mysqli_query($con, $enrollmentQuery);

        //check if resultQuery is empty



        if (mysqli_num_rows($resultQuery) > 0) {



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

            //get grade from resultQuery

            $grade = mysqli_fetch_array($resultQuery);

            if (!isset($grade['grade'])) {

                echo "<td>-</td>";
            } else {

                echo "<td>" . $grade['grade'] . "</td>";
            }

            //check if course has finished. if not, add quit button

            if ($course_row['end'] > time()) {

                echo "<td><a href='./index.php?controller=Student&action=studentEnrollments&quit_id_course=" . $course_row['id_course'] . "'>Baja❌</a>";
            } else {

                echo "<td>-</td>";
            }

            echo "</td>";

            echo "</tr>";
        }
        mysqli_data_seek($result, 0);
    }




    echo "</table>";

    mysqli_close($con);

    ?>

</div>
<a href="./index.php?controller=Usuario&action=studentPanel" class="btn btn-primary">◀️ Volver</a>
