<?php session_start();?>
<?php include("./common/header.php")?>
<?php include("./common/Functions.php")?>

<?php
include_once "./common/EntityClass.php"; 

//initialize variables
$errorArray = array();
$customerInfo = array();

//create validation bool variable
$validate = false;

if(isset($_POST["submit"])){


    $studentId = $_POST["studentId"];
    $name = $_POST["name"];
    $phoneNumber = $_POST["phoneNumber"];
    $password = $_POST["pass"];
    $passConfirm = $_POST["passConfirm"];


    //Validate name 
    $nameError = ValidateName($name);
    $customerInfo["nameInfo"] = $name; 
    if(!empty($nameError)){
        $errorArray["nameError"] = $nameError;
    }
    // Validate student id
    $studentIdError = ValidateId($studentId);
    $customerInfo["studentIdInfo"] = $studentId;
    if(!empty($studentIdError)){
        $errorArray["studentIdError"] = $studentIdError;
    }
    // Validate Phone
    $phoneNumberError = ValidatePhoneNumber($phoneNumber);
    $customerInfo["phoneInfo"] = $phoneNumber;
    if(!empty($phoneNumberError)){
        $errorArray["phoneError"] = $phoneNumberError;
    }
    //Validate password
    $passwordError = ValidatePassword($password);
    $customerInfo["password"] = $password;
    if(!empty($passwordError)){
        $errorArray["passwordError"] = $passwordError;
    }
    //Validate password match
    $passConfirmError = ValidatePasswords($password, $passConfirm);
    if(!empty($passConfirmError)){
        $errorArray["passConfirmError"] = $passConfirmError;
    }else{
        //Create hashed password
        $hashedPassword = hash("sha256", $password);
    }
    //Check if entered student Id already exists in the DB, if so user will be provided with error
    if(getUserById($studentId) != null){
        $existsError = "User with such studentID already exists";
        $errorArray["existsError"] = $existsError;
    }

    //if array of errors is empty, validation is set to true
    if(empty($errorArray)){
        $validate = true;
    }


}

if($validate == true){
    try {
        //add new user object to the DB
        addNewUser($studentId, $name, $phoneNumber, $hashedPassword);
        //get user object
        $user = getUserById($studentId);
        //create session for the user object
        $_SESSION["user"] = $user;
        //regirect user to the Course Selection page
        header("Location:courseSelection.php");
        exit();
    }
    catch (Exception $e)
    {
        die("The system is currently not available, try again later");
    }
}



?>






<div class="container">
    <h2 class="text-center">Sign Up</h2>
    <hr>
    <form action="newUser.php" method="POST", name="signup">
    <div class="form-gourp row" style="padding:10px;">
            <span class="col-sm-2 col-form-label" style="font-weight:600; font-size:1.6rem;">Student ID:</span>
            <div class="col-sm-4">
                <input type="text" name="studentId" class="form-control w-25" id="studentId" value="<?php echo isset($customerInfo["studentIdInfo"]) ? $customerInfo["studentIdInfo"] : '' ?>">
            </div>
            <!-- DISPLAY VALIDATION ERROR -->
            <?php if(!empty($existsError)):?>
                <small class="alert-danger">
                    <?php echo $errorArray["existsError"];?>
                </small>
            <?php endif;?>
            <!-- DISPLAY VALIDATION ERROR -->
            <?php if(!empty($studentIdError)):?>
            <small class="alert-danger">
            <?php echo $errorArray["studentIdError"];?>
            </small>
            <?php endif;?>
    </div>

    <div class="form-gourp row" style="padding:10px;">
            <span class="col-sm-2 col-form-label" style="font-weight:600; font-size:1.6rem;">Name:</span>
            <div class="col-sm-4">
                <input type="text" name="name" class="form-control w-25" id="name" value="<?php echo isset($customerInfo["nameInfo"]) ? $customerInfo["nameInfo"] : '' ?>">
            </div>
            <!-- DISPLAY VALIDATION ERROR -->
            <?php if(!empty($nameError)):?>
            <small class="alert-danger">
            <?php echo $errorArray["nameError"];?>
            </small>
            <?php endif;?>
    </div>

    <div class="form-gourp row" style="padding:10px;">
            <span class="col-sm-2 col-form-label" style="font-weight:600;">Phone Number:</span>
            <div class="col-sm-4">
                <input type="phone" name="phoneNumber" class="form-control w-25" id="phoneNumber" placeholder="(nnn)-(nnn)-(nnnn)"  value="<?php echo isset($customerInfo["phoneInfo"]) ? $customerInfo["phoneInfo"] : '' ?>">
            </div>
            <!-- DISPLAY VALIDATION ERROR -->
            <?php if(!empty($phoneNumberError)):?>
            <small class="alert-danger">
            <?php echo $errorArray["phoneError"];?>
            </small>
            <?php endif;?>

        </div>


        <div class="form-gourp row" style="padding:10px;">
            <span class="col-sm-2 col-form-label" style="font-weight:600;">Password:</span>
            <div class="col-sm-4">
                <input type="password" name="pass" class="form-control w-25" id="pass" value="<?php echo isset($customerInfo["password"]) ? $customerInfo["password"] : '' ?>">
            </div>
            <!-- DISPLAY VALIDATION ERROR -->
            <?php if(!empty($passwordError)):?>
            <small class="alert-danger">
            <?php echo $errorArray["passwordError"];?>
            </small>
            <?php endif;?>
        </div>

        <div class="form-gourp row" style="padding:10px;">
            <span class="col-sm-2 col-form-label" style="font-weight:600;">Password Confirmation:</span>
            <div class="col-sm-4">
                <input type="password" name="passConfirm" class="form-control w-25" id="passConfirm">
            </div>
            <!-- DISPLAY VALIDATION ERROR -->
            <?php if(!empty($passConfirmError)):?>
            <small class="alert-danger">
            <?php echo $errorArray["passConfirmError"];?>
            </small>
            <?php endif;?>
        </div>

        <div class="form-group-row" style="padding:10px;">
            <input type="submit" name="submit" class="btn btn-primary" value="Submit">
            <button name="reset" value="reset" class="btn btn-danger">Clear</button>
        </div>
    </form>
</div>




<?php include("./common/footer.php");?>