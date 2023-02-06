<?php

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $_SESSION["role"] !== "student") {
    header("location:index.php?controller=Usuario&action=studentLogin");
    exit;
}
?>
<h1>Administrar cursos</h1>
<?php
require_once "./config.php";

$con = mysqli_connect("localhost", "root", "");

if (!$con) {

    die('Could not connect.');
}



mysqli_select_db($con, "courses");

//add a search bar

echo "<div style='display: flex; justify-content: center; margin-bottom: 20px; align-items:center;'>";
echo "<form action='./index.php?controller=Student&action=studentCourses' method='POST'>";
echo "<input type='text' name='search' placeholder='Cerca per nom del curs o DNI'>";
echo "<input type='submit' value='🔎'>";
echo "</form>";
echo "</div>";

//if the search bar is not empty, search for the teacher
$query = "SELECT * FROM courses";
if (isset($_POST['search'])) {

    $query = 'SELECT * FROM courses WHERE teacher_id LIKE "%' . $_POST['search'] . '%" OR name LIKE "%' . $_POST['search'] . '%"';
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



        if (isset($_GET['join_id_course']) && $course_row['id_course'] == $_GET['join_id_course']) {

            //check if the student is already enrolled in the course
            $query = 'SELECT * FROM enrollments WHERE id_course = ' . $_GET['join_id_course'] . ' AND id_student = ' . $_SESSION['id'];

            $result = mysqli_query($con, $query);

            if (mysqli_num_rows($result) == 0) {

                $joinQuery = "INSERT INTO enrollment (id_course, id_student) VALUES (" . $_GET['join_id_course'] . ", " . $_SESSION['id'] . ")";

                if (mysqli_query($con, $joinQuery)  === TRUE) {
                    echo "Dado de alta correctamente.";
                    header('location:index.php?controller=Student&action=studentCourses');
                } else {
                    echo "error";
                }
            } else {
                echo "Ya estás matriculado en este curso";
            }
        }
        //check if $course_row['id_course'] is in the enrollment table for the current user ($_SESSION['id'])
        $enrollmentQuery = "SELECT * FROM enrollment WHERE id_course = " . $course_row['id_course'] . " AND id_student = " . $_SESSION['id'];

        $resultQuery = mysqli_query($con, $enrollmentQuery);

        //check if resultQuery is empty



        if ($course_row['start'] > time() && mysqli_num_rows($resultQuery) == 0) {



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

            echo "<td><a href='./index.php?controller=Student&action=studentCourses&join_id_course=" . $course_row['id_course'] . "'>Alta 📋</a>";

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