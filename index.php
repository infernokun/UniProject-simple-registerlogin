<?php
$page = "homepage";
session_start();

include('view/header.php');

if (isset($_SESSION['session_email'])) {
    $loggedIn = true;
    $type = $_SESSION['user_type'];
} else {
    $loggedIn = false;
    $type = "";
}
?>

<head><title>AUM - Homepage</title>
    <style>table, tr, th {
        border: solid black 5px;
}
    tr {
    font-size: 13px;
    }</style></head>

<div class="jumbotron p-4 p-md-5 text-white rounded bg-dark">
    <div class="col-md-6 px-0">
        <h1 style="width: 1000px; font-weight: bold;" class="display-4">Auburn University at Montgomery</h1>
        <p style="width: 1000px;" class="lead my-3">Auburn University at Montgomery (AUM) is recognized by U.S. News and World Report, as well as, The Princeton Review as one of the best colleges in the Southeast. What else do we have going for us?</p>
        <p class="lead mb-0 font-weight-bold">What else do we have going for us?</p>
    </div>
</div>

<div class="row mb-2">
    <div class="col-md-6">
        <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
            <div class="col p-4 d-flex flex-column position-static">
                <strong class="d-inline-block mb-2 text-primary">Campus</strong>
                <h3 class="mb-0">Campus Life</h3>
                <div class="mb-1 text-muted">Nov 25</div>
                <p class="card-text mb-auto">A vast and beautiful campus available for you to learn, live, and explore!</p>
                <a href="#" class="stretched-link">See more...</a>
            </div>
            <div class="col-auto d-none d-lg-block">
                <img class="bd-placeholder-img" width="200" height="250" focusable="false" src="../images/AUM_at_night.png">
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
            <div class="col p-4 d-flex flex-column position-static">
                <strong class="d-inline-block mb-2 text-success">Our Vision</strong>
                <h3 class="mb-0">Graduation Preview</h3>
                <div class="mb-1 text-muted">Nov 11</div>
                <p class="mb-auto">Graduates students who become engaged alumni with a life-long interest in and personal connection to AUM.</p>
                <a href="#" class="stretched-link">See more...</a>
            </div>
            <div class="col-auto d-none d-lg-block">
                <img class="bd-placeholder-img" width="200" height="250" focusable="false" src="../images/aumgrad518-scaled.jpg">
            </div>
        </div>
    </div>
</div>
</div>

<main role="main" class="container">
    <div class="row">
        <div class="col-md-8 blog-main">

            <div class="blog-post">
                <h2 class="blog-post-title">College of Sciences</h2>

                <p>At AUM’s College of Sciences, you will work side by side with leading researchers and help them make new discoveries using state-of-the-art laboratories and equipment. </p>
                <hr>
                    <p>Through our academic departments—Biology and Environmental Science, Chemistry, Computer Science, Mathematics, and Psychology–we offer students robust academics, hands-on learning experiences, and an elite community of dedicated teacher/scholars and students.</p>
                    <p>Our Geographic Information System (GIS) programs, which teach the job-ready skills you’ll need to find a position upon graduation, have strong collaborations with state agencies and those relationships provide many opportunities for internships. </p>
                    <h2>Computer Science</h2>
                    <p>The Department of Computer Science is a place that brings motivated students, professors, and professionals together.  We train high-quality students to become problem solvers.  </p>
                    <p>Our majors are active and engaged in campus life.  Students clubs such as Computer Science Club and Engineering Club are among the most active on campus.  This allows us to provide exceptional future prospects to all those who study with us or collaborate with us.</p>
                    
                    <h3>Cyber Security</h3>
                    <p>There is an ever-increasing need in society for greater cybersystems and information security. This need calls for the development of leaders who can implement, monitor, and respond to security issues, as well as researchers who can develop original and innovative technologies to improve cybersystems security. </p>
                    <pre><code>if ($example == "working") {
    print("cool");
}</code></pre>
                    <p>The Master of Science in Computer Information Systems and Cyber Security program from AUM provides specialized training in computer network and information security, secure software engineering, operating system security, secure network engineering, and applied cryptology.</p>
                    <h3>Put Your Degree to Work</h3>
                    <table>
                        <tr>
                            <th>&nbsp;</th>
                            <th>U. S. Bureau of Labor Statistics sample data</th>
                            <th>&nbsp;</th>
                        </tr>
                        
                        <tr>
                            <th><strong>Job</strong></th>
                            <th><strong>Median Annual Pay</strong></th>
                            <th><strong>Job Growth through 2028</strong></th>
                        </tr>
                        
                        <tr>
                            <th>Computer and Information Research Scientists</th>
                            <th>$118,370</th>
                            <th>16%</th>
                        </tr>
                        
                        <tr>
                            <th>Network and Computer Systems Administrators</th>
                            <th>$82,050</th>
                            <th>5%</th>
                        </tr>
                        
                        <tr>
                            <th>Information Security Analysts</th>
                            <th>$98,350</th>
                            <th>32%</th>
                        </tr>
                    </table>
            </div><!-- /.blog-post -->

        </div><!-- /.blog-main -->

        <aside class="col-md-4 blog-sidebar">
            <div class="p-4 mb-3 bg-light rounded">
                <h4 class="font-italic">About</h4>
                <p class="mb-0">The mission of Auburn University at Montgomery is to provide quality and diverse educational opportunities at the undergraduate and graduate levels through use of traditional and electronic delivery systems, and to foster and support an environment conducive to teaching, research, scholarship, and collaboration with government agencies, our community, and other educational institutions.</p>
            </div>

            <div class="p-4">
                <h4 class="font-italic">For More Information</h4>
                <ol class="list-unstyled mb-0">
                    <li>Department of Computer Science</li>
                    <li>Auburn University at Montgomery</li>
                    <li>Goodwyn Hall 213</li>
                    <li>334-244-3677</li>
                    <li>mathcs@aum.edu</li>
                </ol>
            </div>

            <div class="p-4">
                <h4 class="font-italic">Elsewhere</h4>
                <ol class="list-unstyled">
                    <li><a href="#">GitHub</a></li>
                    <li><a href="#">Twitter</a></li>
                    <li><a href="#">Facebook</a></li>
                </ol>
            </div>
        </aside><!-- /.blog-sidebar -->

    </div><!-- /.row -->

</main><!-- /.container -->
</body>
<?php include('view/footer.php'); ?>
</html>