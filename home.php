<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <link rel="stylesheet" href="common.css">
        <link rel="stylesheet" href="home.css">
        <link rel="stylesheet" href="global-styles.css">
        <title>Beyond the Classroom: High School Resources and Learning</title>
        <script>
            $('document').ready(function() {
                if(sessionStorage.getItem('id')) {
                    $("#loginBtn").hide();
                    $('#logoutBtn').show();
                }
            });

            function removeSessionData() {
                sessionStorage.clear();
                $('#loginBtn').show();
                $('#logoutBtn').hide();
            }
        </script>
    </head>

    <body>
        <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-1 mb-4 border-bottom header ">
            <div class="col-md-3 mb-2 mb-md-0 side-margin">
                <a href="/" class="d-inline-flex link-body-emphasis text-decoration-none">
                    <img class="icon-image" src="images/logo.png"> 
                </a>
            </div> 
            <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
                <li><a href="#" class="nav-link px-2">Home</a></li>
                <li><a href="modules.html" class="nav-link px-2">Modules</a></li>
                <li><a href="about-us.html" class="nav-link px-2">About Us</a></li>
                <li><a href="faq.html" class="nav-link px-2">FAQs</a></li>
            </ul>
            <div class="col-md-3 text-end side-margin"> 
                <button type="button" class="btn btn-primary" onclick="window.location='login.html';" id="loginBtn">Login</button> 
                <button type="button" style="display: none;" class="btn btn-outline-primary" onclick="removeSessionData()" id="logoutBtn">Logout</button>
            </div> 
        </header>

        <div class="banner">
            <section>
                <span>Beyond</span><span><br></span>
                <span style="font-size: 48px;">the </span>
                <span style="color: #FFB228;">Classroom</span>
                <br><br>
                <a href="register-student-account.html" class="banner-btn">Join Us Now</a>
            </section>
            <img src="images/banner.png" alt="banner-img">
        </div>

        <main>
            <h2>Suggested Courses</h2>
            <hr>

            <div class="course-list">
                
                <!-- <a class="course-box" href="#">
                    <img src="images/module.jpg" alt="course-img">
                    <div>
                        <h3>Mathematics</h3>
                        <span class="tutor">Arash Afsary</span>
                        <div class="info">
                            Duration: 9.5 hours<br>
                            Free course
                        </div>
                    </div>
                </a> -->
               
                <?php
                require_once('conn.php');

                $query = "SELECT * FROM modules";
                $result = mysqli_query($conn, $query);

                if(mysqli_num_rows($result) > 0)
                {
                    while($row = $result->fetch_assoc())
                    {
                        echo "
                        <a class=\"course-box\" href=\"#\">
                            <img src=\"images/module-image.jpg\" alt=\"course-img\">
                            <div>
                                <h3>".$row['module_name']."</h3>
                                <span class=\"tutor\">".getTutorName($row['tutor_id'], $conn)."</span>
                                <div class=\"info\">
                                    Duration: ".$row['module_time']." hours<br>
                                    ".$row['module_desc']."
                                </div>
                            </div>
                        </a>
                        ";
                    }
                }
                else if(mysqli_num_rows($result) == 0)
                {
                    echo "<span>No modules available yet.</span>";
                }
                else
                {
                    echo "<span>Error while trying to retrieve modules.</span>";
                }

                function getTutorName($id, $conn)
                {
                    $query = "SELECT * from tutors WHERE tutor_id=$id";
                    $result = mysqli_query($conn, $query);

                    if(mysqli_num_rows($result) != 0)
                    {
                        while($row = $result->fetch_assoc())
                        {
                            return $row['tutor_name'];
                        }
                    }
                    else
                    {
                        return 'Invalid Tutor';
                    }
                }
                ?>
            </div>
        </main>

        <main>
            <h2>Our Vision</h2>
            <hr>
            <div class="vision">
                Our vision at Beyond the Classroom is to empower high school students by providing a comprehensive and accessible online learning platform. We believe that education should be engaging, personalized, and flexible, enabling students to thrive academically and prepare for their future endeavors. Our website aims to revolutionize the traditional classroom experience by offering a diverse range of high-quality courses taught by experienced educators and industry professionals. Through interactive lessons, innovative teaching methods, and real-world applications, we strive to inspire a passion for learning and equip students with the knowledge and skills necessary for success in the 21st century. We are committed to fostering a supportive and inclusive community where students can collaborate, share ideas, and grow together. With our user-friendly interface and intuitive tools, we aim to make education accessible to all, breaking down barriers and unlocking the potential of every high school student. Together, let's redefine education and unleash the limitless possibilities within each student.
            </div>
        </main>

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
</html>