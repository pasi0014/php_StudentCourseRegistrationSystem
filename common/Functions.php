<?php
include_once './common/EntityClass.php';
function ValidatePrincipal($principalAmount)
{
  if(empty($principalAmount)){
    return "Principal Amount is required";
  }
  if(!is_numeric($principalAmount) || $principalAmount <= 0 ){
    return 'Principal Amount must be numeric and greater than zero';
  }else{
    return "";
  }
}


function ValidateId($studentId)
{
  if(empty($studentId)){
    return "Student ID is required";
  }
}

function ValidateInterest($interestRate)
{
  if(empty($interestRate)){
    return "Interest Rate is required";
  }
  if(!is_numeric($interestRate) || $interestRate <=0){
    return "Interest Rate must be numeric and not negative";
  }else{
    return "";
  }
}

function ValidateYearsToDeposit($yearsToDeposit)
{
  if($yearsToDeposit[0] == "0"){
    return "Required years to deposit";
  }
  else{
    return "";
  }
}

function ValidateName($name){
    if(empty($name)){
      return "Name is required";
    }else{
      return "";
    }
  }

function ValidatePassword($password)
{
  if($password === ""){
    return "You need to enter password!";
  }
  if(preg_match("^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{6,}^", $password) === 1){
    return "";
  }
  return "Password needs to be 6 characters long and have at least 1 Upper Case and 1 Lower Case letter and a digit!";
}

  function ValidatePostalCode($postalCode) {
    if ($postalCode === "") {
        return "Postal code is required";
    }
    if (preg_match("/[a-z]\d[a-z]\ ?\d[a-z]\d$/i", $postalCode) === 1) {
        return "";
    }
    return "Postal code is invalid";
}

  function ValidatePhoneNumber($phoneNumber){
    if(empty($phoneNumber)){
      return "Phone Number is required";
    }
    if(preg_match("/^[0-9]{3}-[0-9]{3}-\d{4}$/", $phoneNumber) === 1){
      return "";
    }else{
      return "Phone Number is invalid";
    }
  }
  
  function ValidateEmail($email){
    if(empty($email)){
      return "Email Address is required";
    }
    if(preg_match("/[A-Za-z\d.]+\@[A-Za-z\d]+\.[A-Za-z.]{2,4}$/", $email) === 1){
      return "";
    }else{
      return "Email Address in invalid";
    }
  }

function ValidatePasswords($password, $passConfirm){

  if(empty($passConfirm)){
    return "Password confirmation required";
  }
  if($password != $passConfirm){
    return "Password did not match. Try again.";
  }else{
    return "";
  }
}


// CREATES DB CONNECTION
function getPDO()
{
    $dbConnection = parse_ini_file("./common/db_connection.ini");
    extract($dbConnection);
    return new PDO($dsn, $user, $password);  
}

function getUserByIdAndPassword($userId, $password)
{
    $pdo = getPDO();
    
    $sql = "SELECT StudentId, Name, Phone FROM Student WHERE StudentId = '$userId' AND Password = '$password'";
        
    $resultSet = $pdo->query($sql);
    if ($resultSet)
    {
        $row = $resultSet->fetch(PDO::FETCH_ASSOC);
        if ($row)
        {
           return new User($row['UserId'], $row['Name'], $row['Phone'] );            
        }
        else
        {
            return null;
        }
    }
    else
    {
        throw new Exception("Query failed! SQL statement: $sql");
    }
}

// FUNCTION RETURNS USERS BY GIVEN ID
function getUserById($userId)
{
    $pdo = getPDO();
    
    $sql = "SELECT StudentId, Name, Phone FROM Student WHERE StudentId = '$userId'";
        
    $resultSet = $pdo->query($sql);
    if ($resultSet)
    {
        $row = $resultSet->fetch(PDO::FETCH_ASSOC);
        if ($row)
        {
           return new User($row['UserId'], $row['Name'], $row['Phone'] );            
        }
        else
        {
            return null;
        }
    }
    else
    {
        throw new Exception("Query failed! SQL statement: $sql");
    }
}

// FUNCTION ADDS NEW USERS
function addNewUser($userId, $name, $phone, $password)
{
   $pdo = getPDO();
     
    $sql = "INSERT INTO Student (StudentId, Name, Phone, Password) VALUES( '$userId', '$name', '$phone', '$password')";
    $pdoStmt = $pdo->query($sql);
}


// SECTION FOR COURSESELECTION PAGE:



// GET ALL AVAILABLE SEMESTERS
function getAllSemesters()
{
    $pdo = getPDO();
    $semesters = array();

    $sql = "SELECT * FROM semester";
    
    $resultSet = $pdo->prepare($sql);
    $resultSet->execute();
    
    
    foreach($resultSet as $row)
    {
        $semester = new Semester($row['SemesterCode'], $row['Term'], $row['Year']);
        $semesters[] = $semester;
    }
    return $semesters;
}



//Get courses by course code
function getCourseByCourseCode($courseCode){
  $pdo = getPDO();
  $sql = 'SELECT * FROM Course WHERE CourseCode = :courseCode';
  $resultSet = $pdo->prepare($sql);
  $resultSet->execute(['courseCode'=>$courseCode]);
  $row = $resultSet->fetch(PDO::FETCH_ASSOC);
  if ($row){
      $course = new Course($row['CourseCode'], $row['Title'], $row['WeeklyHours']);
      return $course;
  }
  else{
      return NULL;
  }
}



// GET ALL AVAILABLE COURSES FOR SPECIFIC SEMESTER
function getAllCoursesBySemester($semesterCode)
{
    //Get db connection
    $pdo = getPDO();
    $courses = array();
    //SQL QUERY
    $sql = "SELECT 
    *
FROM
    Course
        INNER JOIN
    CourseOffer ON Course.CourseCode = CourseOffer.CourseCode
WHERE
    CourseOffer.SemesterCode = :semesterCode";

    $resultSet = $pdo->prepare($sql);

    $resultSet->execute(['semesterCode'=>$semesterCode]);

    foreach($resultSet as $row)
      {
        //create new Course object
        $course = new Course($row['CourseCode'], $row["Title"], $row["WeeklyHours"]);
        //add object into an array
        $courses[] = $course;
      }
      return $courses;
    
    
}

//Retrieve registrations for specific student, function takes student ID and semester Code as an argument
function getRegistrationCoursesBySemester($studentId, $semesterCode)
{
        $courses = array();
        $courseCodes = array();
        $pdo = getPDO();
        
        $sql = 'SELECT CourseCode From Registration WHERE StudentId = :studentId && SemesterCode = :semesterCode ORDER BY CourseCode ASC';
        
        $resultSet = $pdo->prepare($sql);

        $resultSet->execute( ['studentId'=>$studentId, 'semesterCode'=>$semesterCode] );
        
        foreach ($resultSet as $row)
        {
            if ($row) {
                $courseCodes[] = $row['CourseCode'];
            }  
        }
        if (count($courseCodes) > 0) {
            foreach ($courseCodes as $courseCode){
                
                $course = getCourseByCourseCode($courseCode);
                if ($course != NULL) {
                    $courses[] = $course;
                }
            }
            if (count($courses) > 0) {
                return $courses;
            }
            else {
                return NULL;
            }
        }
        else {
            return NULL;
        }
}

//Get all registered courses by semester code
function getRegistrationSemesterCodes($studentId){
  $registrationSemesterCodes = array();
  $pdo = getPDO(); 
  $sqlStatement = 'SELECT DISTINCT(SemesterCode) FROM Registration WHERE StudentId = :studentId ORDER BY SemesterCode ASC';
  $pStmt = $pdo->prepare($sqlStatement);
  $pStmt->execute(['studentId'=>$studentId]);
  foreach ($pStmt as $row){
      if ($row){
          $registrationSemesterCodes[] = $row['SemesterCode'];
      }
     
  }
return $registrationSemesterCodes;
}

//Retrieve all semesters by its code
function getSemesterByCode($semesterCode){
  $pdo = getPDO();
  $sqlStatement = 'SELECT * FROM Semester WHERE SemesterCode = :semesterCode';
  $pStmt = $pdo->prepare($sqlStatement);
  $pStmt->execute(['semesterCode'=>$semesterCode]);
  $row = $pStmt->fetch(PDO::FETCH_ASSOC);
  if ($row){
      $semester = new Semester($row['SemesterCode'], $row['Term'], $row['Year']);
      return $semester;
  }
  else {
      return NULL;
  }
}

//Get registered course hours
function getRegisterCourseHours($registeredCourses){
  $totalHours = 0;
  if ($registeredCourses == NULL){
      return 0;
  }
  foreach ($registeredCourses as $course){
      $hour = $course->getCourseHours();
      $totalHours += (int) $hour;
  }
  return $totalHours;
}

//Register Courses
function registerCourse($studentId, $courseCode, $semesterCode){
  $pdo = getPDO();  
  $sql = "INSERT INTO Registration VALUES(:studentId, :courseCode, :semesterCode)";
  $resultSet = $pdo->prepare($sql);
  $resultSet->execute(['studentId'=>$studentId, 'courseCode'=>$courseCode, 'semesterCode'=>$semesterCode]);
}

//Delete course registration
function DeleteRegistrationRecord($studentId, $courseCode, $semesterCode){
  $pdo = getPDO();
  $sql = 'DELETE FROM Registration WHERE StudentId = :studentId && CourseCode = :courseCode && SemesterCode = :semesterCode';
  $resultSet = $pdo->prepare($sql);
  $resultSet->execute(['studentId'=>$studentId, 'courseCode'=>$courseCode, 'semesterCode'=>$semesterCode]);
}

//Get all avaiable courses
function getAvailableCourse($semesterCourses, $registeredCourses){
  $availableCourses = array();
  if ($registeredCourses == NULL){
      return $semesterCourses;
  }
  //loop thru courses for specific semester and check if registered courses array doesn't contain course record, record will be added into available courses array
  for($i = 0; $i < count($semesterCourses); $i++){
     if (!in_array($semesterCourses[$i], $registeredCourses)){
         $availableCourses[] = $semesterCourses[$i];
     }
 }
 // Return array of avalable courses only when it's larger than 0
 if (count($availableCourses) > 0) {
     return $availableCourses;
 }
 else {
     return NULL;
 }
}


// GET ALL AVAILABLE COURSES
function getAllCourses()
{
    $pdo = getPDO();
    
    $sql = "SELECT CourseCode, Title FROM Course";
        
    $resultSet = $pdo->query($sql);
    
    $courses = array();
    
    foreach($resultSet as $row)
    {
        $courses[] = $row["CourseCode"] . ' - ' .  $row["Title"];
    }
    return $courses;
}
?>