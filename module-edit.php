<?php
include 'config.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
}
$module = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM `tutors` INNER JOIN `modules` ON `tutors`.`tutor_id`=`modules`.`tutor_id` WHERE `module_id` = $id"));

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $time = $_POST['time'];
    $description = $_POST['description'];
    $q = mysqli_query($con, "UPDATE `modules` SET `module_name`='$name',`module_desc`='$description',`module_time`='$time' WHERE `module_id`='$id'");
    if ($q) {
        header('location:module-view.php?mid=' . $id);
        exit();
    } else {

        header('location:module-edit.php?mid=' . $id);
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <style>
        input {
            position: relative;
            opacity: 1;
            z-index: 100;
        }
    </style>

    <script>
                if(!(sessionStorage.getItem('userType') === 'tutor')) {
                    alert("You don't have permission to access this page");
                    removeSessionData();
                    window.location.replace('home.php');
                }

            function removeSessionData() {
                sessionStorage.clear();
                window.location.replace('home.php');
            }
    </script>
</head>

<body>
    <div class="edit"></div>
    <header
        class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-1 mb-4 border-bottom header">
        <div class="col-md-3 mb-2 mb-md-0 side-margin"> <a href="/" class="d-inline-flex link-body-emphasis text-decoration-none">
                <img class="icon-image" src="images/logo.png"> </a> </div>
        <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
            <li><a href="home.php" class="nav-link px-2">Home</a></li>
            <li><a href="modules.html" class="nav-link px-2">Modules</a></li>
            <li><a href="about-us.html" class="nav-link px-2">About Us</a></li>
            <li><a href="faq.html" class="nav-link px-2">FAQs</a></li>
        </ul>
        <div class="col-md-3 text-end side-margin"> <button type="button" class="btn btn-outline-primary" onclick="removeSessionData()">Logout</button> </div>
    </header>
    <div class="result"></div>
    <div class="module-overview_container">
        <div class="module-overview_imageSection">
            <img src="assets/74d067bf3d9b2f54a00a7cdd09146a33.jpg" class="module-overview_image" alt="avatar">
        </div>
        <div class="module-overview_texts">
            <h2 class="module-overview_title" id="name">
                <?= $module['module_name'] ?>
            </h2>
            <span id="tutor">
                <?= $module['tutor_name'] ?>
            </span>
            <span>
                Duration:
                <i id="duration"><?= $module['module_time'] ?> hours</i>
            </span>
            <!-- <span style="color: #425f7e;">
                <span style="color: black;">231</span>
                students are in the course!
            </span> -->
            <div>
                <p>overveiw:</p>
                <span id="desc">
                    <?= $module['module_desc'] ?>
                </span>
            </div>
        </div>
        <form action="" method="post">
            <table>
                <tr>
                    <td>Module Name:</td>
                    <td><input type="text" name="name" value="<?= $module['module_name'] ?>"></td>
                </tr>
                <tr>
                    <td>Module Time:</td>
                    <td><input type="number" name="time" value="<?= $module['module_time'] ?>"></td>
                </tr>
                <tr>
                    <td>Module Description:</td>
                    <td><input type="text" name="description" value="<?= $module['module_desc'] ?>"></td>
                </tr>
                <tr>
                    <td colspan="2"><button class="btn btn-primary" name="submit" type="submit">Submit</button></td>
                </tr>
            </table>
        </form>
    </div>

    <footer class="bg-light text-center text-lg-start">
            <div class="container p-4">
                <div class="row">
                    <div class="col-lg-6 col-md-12 mb-4 mb-md-0">
                        <h5 class="text-uppercase">About Us</h5>
                        <p> Beyond the Classroom is an innovative e-learning platform that brings education directly to your fingertips. We believe that learning should not be confined to traditional classrooms, and our goal is to provide accessible and engaging online courses for students of all ages. </p>
                    </div>
                    <div class="col-lg-6 col-md-12 mb-4 mb-md-0">
                        <h5 class="text-uppercase">Our Mission</h5>
                        <p> Our mission is to revolutionize the way education is delivered by harnessing the power of technology. We aim to make learning more convenient, flexible, and personalized for every learner, regardless of their location or schedule. We strive to create a supportive and inclusive learning environment where students can thrive and reach their full potential. </p>
                    </div>
                </div>
            </div>
            <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);"> © 2023 Copyright: <a class="text-dark" href="AboutUs.html">Beyond The Classroom</a> </div>
        </footer>
</body>
<script src="jquery-3.0.0.min.js"></script>
<script src="jquery.editable.js"></script>
<!-- <script>
    var $editables = $('.edit');
    function makeThingsEditable() {
        $editables.editable({
            emptyMessage: '<em>Please write something...</em>',
            callback: function (data) {
                //$info.hide();
                //$info.eq(0).show();
                var ename = data.$el[0].getAttribute('id');
                var material = data.$el[0].getAttribute('data');
                var matlink = data.$el[0].getAttribute('data');
                if (data.content) {
                    $.ajax({
                        url: "ajax.php",
                        method: "POST",
                        data: "ename=" + ename + "&content=" + data.content + '&material=' + material + '&matlink=' + matlink,
                        success: function (res) { }
                    })
                }
            }
        });
    }
    makeThingsEditable();
</script> -->

</html>