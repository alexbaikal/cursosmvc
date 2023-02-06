<?php
// Initialize the session

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $_SESSION["role"] !== "teacher") {
    header("location: teacherLogin.php");
    exit;
}
?>
<h1>Gestionar curso</h1>
<?php
require_once "./config.php";

$con = mysqli_connect("localhost", "root", "");

if (!$con) {

    die('Could not connect.');
}



mysqli_select_db($con, "courses");

//add a search bar

echo "<div style='display: flex; justify-content: center; margin-bottom: 20px; align-items:center;'>";
echo "<form action='./index.php?controller=Profesor&action=profesorCourse&id_course=". $_GET['id_course'] ."' method='POST'>";
echo "<input type='text' name='search' placeholder='Cerca per nom del curs o DNI'>";
echo "<input type='submit' value='🔎'>";
echo "</form>";
echo "</div>";

//if the search bar is not empty, search for the teacher
$query = "SELECT * FROM courses WHERE id_course = " . $_GET["id_course"];

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
                    header('location:studentCourses.php');
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
                if ($teacher_row['teacher_id'] == $teacher_row['teacher_id']) {
                    $teacher_name = $teacher_row['name'];
                }
            }
            if ($course_row['teacher_id'] == $_SESSION['id']) {
                echo "<td>" . $teacher_name . "</td>";

                echo "<td>" . $course_row['name'] . "</td>";

                echo "<td>" . $course_row['description'] . "</td>";

                echo "<td>" . $course_row['duration'] . "</td>";

                echo "<td>" . date('d/m/Y', $course_row['start']) . "</td>";

                echo "<td>" . date('d/m/Y', $course_row['end']) . "</td>";

                //store end date in date format to compare it with current date
                $end_date = date('d/m/Y', $course_row['end']);


                echo "<form method='post' action='./index.php?controller=Profesor&action=profesorCourse" . "&id_course=" . $_GET['id_course'] . "'>";


                echo "</td>";

                echo "</tr>";
            }
        }
        mysqli_data_seek($result, 0);
    }




    echo "</table>";



    ?>
</div>
<h1>Alumnos matriculados</h1>

<div style="width: 100%; display: flex; justify-content: center; margin-bottom: 20px; align-items:center;">

    <?php
    $enrollmentsQuery = "SELECT * FROM enrollment WHERE id_course = " . $_GET["id_course"];
    $enrollments = mysqli_query($con, $enrollmentsQuery);


    echo "<table border='1'>

    <tr>

        <th>Nombre</th>

        <th>Apellidos</th>

        <th>Edad</th>

        <th>Imagen</th>
    
    ";
    if ($end_date < date('d/m/Y')) {
        echo "<th>Nota</th>";
        echo "</tr>";
    }


    while ($enrollment_row = mysqli_fetch_array($enrollments)) {
        $studentsQuery = "SELECT * FROM students WHERE id_student = " . $enrollment_row["id_student"];
        $students = mysqli_query($con, $studentsQuery);
        while ($student_row = mysqli_fetch_array($students)) {
            echo "<tr>";
            echo "<td>" . $student_row["name"] . "</td>";
            echo "<td>" . $student_row["surname"] . "</td>";
            echo "<td>" . $student_row["age"] . "</td>";
            if (strpos($student_row['image'], 'jpg') !== false || strpos($student_row['image'], 'png') !== false || strpos($student_row['image'], 'gif') !== false || strpos($student_row['image'], 'jpeg') !== false) {

                echo "<td><img style='width: 50px;height:50px' src='../profilepics/" . $student_row['image'] . "'/></td>";
            } else {

                echo "<td>S/I</td>";
            }
            //check if end date is lower than current date
            if ($end_date < date('d/m/Y')) {


                //create a dropdown of grades from 1 to 10

                echo "<form method='post' action='/index.php?controller=Profesor&action=profesorCourse&id_course=" . $_GET['id_course'] . "'>";
                echo '<td><select name="grade">';
                //check if the grade is already set
                if ($enrollment_row['grade'] != null) {
                    echo '<option value="' . $enrollment_row['grade'] . '">' . $enrollment_row['grade'] . '</option>';
                    //create a for loop of the rest of the grades
                    for ($i = 1; $i <= 10; $i++) {
                        if ($i != $enrollment_row['grade']) {
                            echo '<option value="' . $i . '">' . $i . '</option>';
                        }
                    }

                    echo "</select>";
                } else {
                    for ($i = 1; $i <= 10; $i++) {
                        echo "<option value='" . $i . "'>" . $i . "</option>";
                    }
                    echo "</select>";
                }
                echo '<input type="submit" value="✔️"></td>';
                echo '</form>';

                $option = isset($_POST['grade']) ? $_POST['grade'] : false;

                if ($option) {
                    $gradeQuery = "UPDATE enrollment SET grade = " . $_POST['grade'] . " WHERE id_course = " . $_GET["id_course"] . " AND id_student = " . $student_row["id_student"];
                    $grade = mysqli_query($con, $gradeQuery);
                }
            }

            echo "</tr>";
        }
    }


    echo "</table>";
    mysqli_close($con);

    ?>
</div>
<a href="./index.php?controller=Profesor&action=profesorCourses" class="btn btn-primary">
    ◀️ Volver</a>