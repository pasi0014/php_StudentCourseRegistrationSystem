
<?php include("./common/header.php")?>
<?php include("./common/functions.php");?>


<?php


// initialize variables
$errorArray = array();
$loginErrorMsg = '';
extract($_POST);

//validation bool variable
$validate = false;

if(isset($login))
{
    if($validate == false){
        //validate student id if empty error will occur
        $idError = ValidateId($studentId);
        if(!empty($idError)){
            $errorArray['idError'] = $idError;
        }
        // check if password is empty, if so user will be provided with error
        if(empty($password)){
            $errorArray["passError"] = "Password required!";
        }else{
            // if user entered password, it will be hashed
            $hashedPass = hash("sha256", $password);
        }
        if(empty($errorArray)){
            // if error of arrays empty, validate variable will be set to true
            $validate = true;
        }
    }

    
    if($validate == true){
        try {
            // function will find match of users 
            $user = getUserByIdAndPassword($studentId, $hashedPass);
        }
        catch (Exception $e)
        {
            die("The system is currently not available, try again later");
        }
        //if user was not found error will occur
        if ($user == null)
        {
            $loginErrorMsg = 'Incorrect StudentID and/or Password Combination!';
        }
        else
        {
            //Create session for user and redirect to Course Selection page
            $_SESSION["studentId"] = $studentId; 
            $_SESSION['user'] = $user; 
            header("Location: courseSelection.php");
            exit();
        }    
    }
       
}


?>



<div class="container">
    <h2 class="text-center">Log In</h2>
    <hr>
    <form action="login.php" method="POST", name="login">
    <div class="form-form-group-row" style="padding:10px;">
    <p>You need to <a href="newUser.php">sign up</a> if you are a new user</p>
    <!-- Display error -->
    <?php if(!empty($loginErrorMsg)):?>
            <small class="alert-danger">
            <?php echo $loginErrorMsg;?>
            </small>
            <?php endif;?>
    </div>
   
    <div class="form-gourp row" style="padding:10px;">
            <span class="col-sm-2 col-form-label" style="font-weight:600; font-size:1.6rem;">Student ID:</span>
            <div class="col-sm-4">
                <input type="text" name="studentId" class="form-control w-25" id="studentId" value="<?php echo isset($studentId) ? $studentId : '' ?>">
            </div>
            <!-- Error -->
            <?php if(!empty($errorArray["idError"])):?>
                <small class="alert-danger">
                    <?php echo $errorArray["idError"];?>
                </small>
            <?php endif;?>
    </div>

    <div class="form-gourp row" style="padding:10px;">
            <span class="col-sm-2 col-form-label" style="font-weight:600; font-size:1.6rem;">Password:</span>
            <div class="col-sm-4">
               <input type="password" name="password" class="form-control">
            </div>
            <!-- Error -->
            <?php if(!empty($errorArray["passError"])):?>
                <small class="alert-danger">
                    <?php echo $errorArray["passError"];?>
                </small>
            <?php endif;?>
    </div>

        <div class="form-group-row" style="padding:10px;">
            <input type="submit" name="login" class="btn btn-primary" value="Submit">
            <button name="reset" value="reset" class="btn btn-danger">Clear</button>
        </div>
    </form>
</div>

<?php include("./common/footer.php");?>