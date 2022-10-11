<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" type="text/css" href="../styles/admin.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="./styles/sidebar.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - editar curs</title>
</head>

<body>

    <!--sidebar on top of everything using bootstrap and grid-->
    <div class="row">
        <div class="col-2">
            <div class="sidebar">
                <!--button to hide sidebar-->
                <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">❌</a>
                <a href="./adminPanel.php">Inici</a>
                <a href="./adminCourses.php">Cursos 🏫</a>
                <a href="./adminTeachers.php">Professors 👨‍🎓</a>
                <a href="../logout.php">Tancar sessió ❌</a>
            </div>
            <!--button that calls openNav()-->
            <button class="openbtn" onclick="openNav()">☰</button>

        </div>
        <div class="col-10">

        </div>
    </div>



    <?php
    // Initialize the session
    session_start();

    // Check if the user is logged in, if not then redirect him to login page
    if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $_SESSION["role"] !== "admin") {
        header("location: adminLogin.php");
        exit;
    }
    ?>
    <h1>Editar curs</h1>

    <div style="display: flex; justify-content: center; margin-bottom: 20px; align-items:center;">

        <?php
        require_once "../config.php";

        $param_upload_image = $upload_image = $location = "";

        $con = mysqli_connect("localhost", "root", "");

        if (!$con) {

            die('Could not connect.');
        }



        mysqli_select_db($con, "courses");


        if (isset($_GET['id_course'])) {

            //select from courses where id coincides with the one in the url

            $query = 'SELECT * FROM courses WHERE id_course = "' . $_GET['id_course'] . '" LIMIT 1';

            $result = mysqli_query($con, $query);

            if ($result == null) {

                echo "No s'ha trobat el curs amb el id: " . $_GET['id_course'];

                exit;
            } else {

                $course = mysqli_fetch_assoc($result);

                //create a form with inputs stacked one on top of another

                //each input should have the value of the courses s data

        ?>
                <form style='display: flex; flex-direction: column; align-items: center; justify-content: center;' action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?id_course=' . $course['id_course'] ?>' method='post' enctype="multipart/form-data">
            <?php
                echo "<input type='hidden' name='id_course' value='" . $course['id_course'] . "' />";
                echo "<input type='hidden' name='teacher_id' value='" . $course['id_course'] . "' />";

                echo "<label for='name'>Nombre curso</label>";

                echo "<input type='text' name='name' value='" . $course['name'] . "' />";

                echo "<label for='description'>Descripción</label>";

                echo "<input type='text' name='description' value='" . $course['description'] . "' />";

                echo "<label for='duration'>Duración</label>";

                echo "<input type='text' name='duration' value='" . $course['duration'] . "' />";

                echo "<label for='start'>Inicio</label>";

                echo "<input type='datetime-local' name='start' value='" . date("Y-m-d\TH:i:s", $course['start']) . "' />";

                echo "<label for='end'>Final</label>";

                echo "<input type='datetime-local' name='end' value='" . date("Y-m-d\TH:i:s", $course['end']) . "' /><br/>";

                echo '<input type="submit" name="submitbtn" class="btn btn-primary" value="Editar">';

                echo "</form>";

                echo "</div>";
            }
        } else {

            echo "No s'ha trobat el curs amb el id: " . $_GET['id_course'];
        }
            ?>
            <div style="display: flex; justify-content: center; margin-bottom: 20px; align-items:center;">
                <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {

                    //update courses with the data from the form

                    //if it isn't, update the course's data without changing the image

                    $start = trim($_POST["start"]);
                    $end = trim($_POST["end"]);

                    $start = strtotime($start);
                    $end = strtotime($end);


                    $query = 'UPDATE courses SET name = "' .
                        $_POST['name'] .
                        '", description = "' .
                        $_POST['description'] .
                        '", duration = "' .
                        $_POST['duration'] .
                        '", start = "' .
                        $start . '", end = "' .
                        $end .
                        '" WHERE id_course = "' .
                        $_POST['id_course'] . '"';

                    $result = mysqli_query($con, $query);

                    if ($result == null) {

                        echo "No s'ha pogut editar el curs amb el id: " . $_POST['id_course'];
                        header("Refresh:5");

                        exit;
                    } else {

                        echo "S'ha editar el curs amb el id: " . $_POST['id_course'];
                    }

                    header("Refresh:2");
                }



                mysqli_close($con);

                ?>
            </div>
            <a href="adminCourses.php" class="btn btn-primary">
                <- Volver</a>
                    <script>
                        closeNav();

                        function openNav() {
                            document.getElementsByClassName("sidebar")[0].style.width = "250px";
                        }

                        function closeNav() {
                            document.getElementsByClassName("sidebar")[0].style.width = "0";
                        }
                    </script>
</body>

</html>