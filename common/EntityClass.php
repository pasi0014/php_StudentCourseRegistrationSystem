<?php
class User {
    private $userId;
    private $name;
    private $phone;
    private $hoursRegistered;
    
    private $messages;
    
    public function __construct($userId, $name, $phone)
    {
        $this->userId = $userId;
        $this->name = $name;
        $this->phone = $phone;
        
        $this->messages = array();
    }
    

    public function getHoursRegistered(){
        return $this->hoursRegistered;
    }

    public function checkHours(){
        if($this->hoursRegistered > 16){
            return "You exceeded maximum hours";
        }
    }

    public function getUserId() {
        return $this->userId;
    }

    public function getName() {
        return $this->name;
    }

    public function getPhone() {
        return $this->phone;
    }
}


Class Course{
    private $courseCode;
    private $courseTitle;
    private $courseHours;

    public function __construct($courseCode, $courseTitle, $courseHours)
    {
        $this->courseCode = $courseCode;
        $this->courseTitle = $courseTitle;
        $this->courseHours = $courseHours;
    }

    public function getCourseCode(){
        return $this->courseCode;
    }

    public function getCourseTitle(){
        return $this->courseTitle;
    }

    public function getCourseHours(){
        return $this->courseHours;
    }

    public function __toString(){
        return $this->courseCode. " - ";
    }
}

Class Semester {
    private $code;
    private $term;
    private $year;
    
    public function __construct($code, $term, $year) {
        $this->code = $code;
        $this->term = $term;
        $this->year = $year;
    }
    
    public function getCode() {
        return $this->code;
    }
    public function getTerm() {
        return $this->term;
    }
    public function getYear() {
        return $this->year;
    }
    public function getName(){
        return $this->year." ".$this->term;
    }
}
Class CourseOffer {
    private $courseCode;
    private $semesterCode;
    
    public function __construct($courseCode, $semesterCode) {
        $this->courseCode = $courseCode;
        $this->semesterCode = $semesterCode;
    }
    public function getCourseCode(){
        return $this->courseCode;
    }
    public function getSemesterCode(){
        return $this->semesterCode;
    }
}

Class Registration {
    private $studentId;
    private $courseCode;
    private $semesterCode;
    
    public function __construct($studentId, $courseCode, $semesterCode) {
        $this->studentId = $studentId;
        $this->courseCode = $courseCode;
        $this->semesterCode = $semesterCode;
    }
    
    public function getStudentId(){
        return $this->studentId;
    }
    public function getCourseCode(){
        return $this->courseCode;
    }
    public function getSemesterCode(){
        return$this->semesterCode;
    }
}

?>