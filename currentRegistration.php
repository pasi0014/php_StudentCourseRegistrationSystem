<?php include("./common/EntityClass.php");?>
<?php include("./common/header.php");?>
<?php include("./common/functions.php");?>

<?php 

if(!isset($_SESSION["user"])){
    header("location:login.php");
}else{
    $user = $_SESSION["user"];
}
$studentId = $_SESSION["studentId"];

$registeredSemestersForStudent = getRegistrationSemesterCodes($studentId);

extract($_POST);

if(isset($btnSubmit)){
    if(isset($selectRegistrations)){
        for ($i = 0; $i < count($selectRegistrations); $i++){
            $questionMarkIndex = strpos($selectRegistrations[$i], '?');
            $courseCode = substr($selectRegistrations[$i], $questionMarkIndex + 1);
            $semesterCode = substr($selectRegistrations[$i], 0, $questionMarkIndex);
            deleteRegistrationRecord($studentId, $courseCode, $semesterCode);
        }
    }else{
        $error = "You did not select any course.";
    }
}

?>

<div class="container">
    <h2 class="text-center">Current Registration</h2>
    <p>
        Hello <span style="font-weight:700"><?php echo $user->getName()?></span> (not you? change a user <a href="login.php">here</a>),
        The following are your current registrations.
    </p>
    <form method="post" action="currentRegistration.php">
        <table class="table table-striped">
            <thead>
                <th>Year</th>
                <th>Term</th>
                <th>Course Code</th>
                <th>Course Title</th>
                <th>Hours</th>
                <th>Select</th>
            </thead>
            <?php 
                    if(sizeof($registeredSemestersForStudent) == 0){
                        echo "<tr><td colspan='6' style='text-align:center'><span style='color:red; font-weight:700;'>*You have no registered courses yet*</span></td></tr>";
                    }
                    foreach ($registeredSemestersForStudent as $semesterCode){
                            $registeredCourses = getRegistrationCoursesBySemester($studentId, $semesterCode);
                            $registeredSemester = getSemesterByCode($semesterCode);
                            $year = $registeredSemester->getYear();
                            $term = $registeredSemester->getTerm();
                            $weeklyHours = 0;

                            if(isset($registeredCourses)){
                            foreach ($registeredCourses as $course){
                                $courseCode = $course->getCourseCode();
                                $courseTitle = $course->getCourseTitle();
                                $hours = $course->getCourseHours();
                                $weeklyHours += (int) $hours;
                                $selectId = $semesterCode.'?'.$courseCode;
                                echo "<tr>";
                                echo "<td>$year</td>";
                                echo "<td>$term</td>";
                                echo "<td>$courseCode</td>";
                                echo "<td>$courseTitle</td>";
                                echo "<td>$hours</td>";
                                echo "<td><input type='checkbox' name='selectRegistrations[]' value = '$selectId' /></td>";
                                echo "</tr>";
                            }
                            echo "<td colspan='4' style='text-align:right;'><span style='font-weight:700; color:#3f51b4;'>Total Weekly Hours</span></td><td colspan='2'><span style='color:#3f51b4; font-weight:700;'>$weeklyHours</span></td></tr>";
                            }else{
                                echo "<tr><td colspan='6' style='text-align:center;'><span style='font-weight:700; color:red;'>*You have removed all Courses*</span></td></tr>";
                            }
                            }
                        
                        
                    
                ?>
        </table>
        <?php if(!empty($error)):?>
            <span class="alert-danger">
                <?php echo $error;?>
            </span>
        <?php endif;?>
        <div class="form-group">
            <div class="col-sm col-sm-offset-9">
                <button type="submit" class="btn btn-primary" name="btnSubmit" onclick="confirmDelete()">Delete</button>
                <button type = "submit" name = "btnClear" class = "btn btn-danger ">Clear</button>
            </div>
        </div>
    </form>
</div>



<?php include("./common/Footer.php");?>