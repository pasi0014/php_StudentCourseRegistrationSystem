<?php include("./common/EntityClass.php");?>
<?php include("./common/header.php");?>
<?php include("./common/functions.php");?>
<?php 

// check wether session is set, if not user will be redirected back to Login page
if(!isset($_SESSION['user']))
{
    header("Location:login.php");
}else{
    //if session for user is set, greeting will be displayed
    $user = $_SESSION["user"];
    $greeting = "Welcome ".$user->{'getName'}();
}
?>

<?php 

$selectedSemesterCode;
//Retrieve Selected Semester Code 
if (urldecode($_GET['selectedSemesterCode']) != NULL){
    $selectedSemesterCode = urldecode($_GET['selectedSemesterCode']);
    $_SESSION['selectedSemesterCode'] = $selectedSemesterCode;
}
else if($_SESSION['selectedSemesterCode'] != NULL) {
    $selectedSemesterCode = $_SESSION['selectedSemesterCode'];
}

// Retrieve all semesters 
$semesters = getAllSemesters();

// Exctract all POST data
extract($_POST);



// Retrieve student ID from the session
$studentId = $_SESSION["studentId"];
//Retrieve all course for specific semester from the DB
$coursesForSemester = getAllCoursesBySemester($selectedSemesterCode);
// 
$registeredCourses = getRegistrationCoursesBySemester($studentId, $selectedSemesterCode);
$registerCourseHours = getRegisterCourseHours($registeredCourses);
$availableHours = 16 - $registerCourseHours;
$errorArray = array();
$validation = true;



if(isset($btnSubmit)){
    try{
        // Check if user selected checkboxes 
        if(!isset($selectedCourseCodes)){
            //display error
         $errorArray["countError"] = "You need to select at least one course";
        }else{
            $selectedCourseHours = 0;
            foreach ($selectedCourseCodes as $courseCode){
               $course = GetCourseByCourseCode($courseCode);
               $courseHours = $course->getCourseHours();
               $selectedCourseHours += $courseHours;
               }
           if ($selectedCourseHours > $availableHours){
               $error = "Your selection exceed the max weekly hours";
               $errorArray["exceededHours"] = $error;
               $checked = 'checked';
               $validation = FALSE;
           }
           if($validation){
               foreach($selectedCourseCodes as $selCCode){
                   RegisterCourse($studentId, $selCCode, $selectedSemesterCode);
               }
               header('Location:courseSelection.php');
           }
        }
    }catch (Exception $e){
        echo "Caught exception: ", $e->getMessage(), "\n";
    }
}

$availableCoursesFor = getAvailableCourse($coursesForSemester, $registeredCourses);

?>


<div class="container">
    <h2 style="margin-top:20px;" class="text-center">Course Selection for <?php echo $studentId;?></h2>
    <div class="container-fluid">
        <p style="padding:15px;">Welcome, <b><?php echo $user->{'getName'}();?></b>!
        (not you? change user <a href="login.php">here</a>)<br>
        
            You have registered <span style="color:#3b59ef; font-weight:700;"><?php echo "$registerCourseHours" ?></span> hours for the selected semester.<br>
        
            You can register more <span style="color:#3b59ef; font-weight:700;"><?php echo "$availableHours" ?></span> hours of course(s) for the semester.
        </p>
        <form action="courseSelection.php" method="POST">
        <?php if(!empty($errorArray["countError"])):?>
                <span class="alert-danger">
                    <?php echo $errorArray["countError"];?>
                </span>
            <?php endif;?>

        <?php if(!empty($error)):?>
                <span class="alert-danger">
                    <?php echo $errorArray["exceededHours"];?>
                </span>
            <?php endif;?>
            <div class="col-xs-3 col-xs-offset-9">
            
            <select class = "form-control" style="width:250px;" id="selectedSemester" name = "selectSemester" onchange="ChangeSemester()" >
                    <?php
                    // ADD 
                       foreach ($semesters as $semester){
                           $semesterName = $semester->getName();
                           $semesterCode = $semester->getCode();  
                           if ($semesterCode == $selectedSemesterCode) {
                               echo "<option value = '$semesterCode' selected = 'selected'>$semesterName</option>";
                           }
                           else {
                               echo "<option value = '$semesterCode'>$semesterName</option>";
                           }
                       }
                    ?>
            </select>
            </div>
        <table class="table table-dark">
        <th>
            Code
        </th>
        <th>
            Course Title
        </th>
        <th>
            Hours
        </th>
        <th>
            Select
        </th>
        <?php
        if(isset($availableCoursesFor)){
            if(sizeof($availableCoursesFor) != 0){
                foreach($availableCoursesFor as $c)
                {
                    $cCode = $c->getCourseCode();
                    $cTitle = $c->getCourseTitle();
                    $cHours = $c->getCourseHours();
                    echo "<tr>";
                    if(count($coursesForSemester) == 0){
                        echo "*Please Select Semester*";
                    }
                    echo "<td>$cCode</td>";
                    echo "<td>$cTitle</td>";
                    echo "<td>$cHours</td>";
                    echo "<td><input type='checkbox' name='selectedCourseCodes[]' value='$cCode' checked='$checked'></td>";
                    echo "</tr>";
                }
            }else{
                echo "<tr>";
                echo "<td colspan='4' style='text-align:center;'><span style='color:red; font-weight:700;'>*Please Select Semester*</span></td>";
                echo "</tr>";
            }
        } else{
            echo "<tr>";
            echo "<td colspan='4' style='text-align:center;'><span style='color:red; font-weight:700;'>*No courses available*</span></td>";
            echo "</tr>"; 
        }
        
        
        ?>
        </table>
        <button type = "submit" name = "btnSubmit"  class = "btn btn-primary ">Submit</button>
        <button type = "submit" name = "btnClear" class = "btn btn-danger ">Clear</button>
        </form>
    </div>
</div>
<?php include("./common/footer.php");?>