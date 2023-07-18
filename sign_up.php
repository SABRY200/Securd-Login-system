<?php $currentPage = "Sign UP"; ?>
<?php require_once("include/header.php"); ?>

    <div class="container">
        <div class="content">
            <h2 class="heading">Sign Up</h2>

            <?php
                if(isset($_POST['sign-up'])) {
                    
                    $first_name     = escape($_POST['first_name']);
                    $last_name      = escape($_POST['last_name']);
                    $user_name      = escape($_POST['user_name']);
                    $user_email     = escape($_POST['user_email']);
                    $user_pass      = escape($_POST['user_password']);
                    $user_con_pass  = escape($_POST['user_confirm_password']);

                    //first name validation
                    $pattern_fn = "/^[a-zA-Z ]{3,12}$/";
                    if(!preg_match($pattern_fn, $first_name)) {
                        $err_fn = "Must be at lest 3 character long, letter and space allowed";
                    }

                    //last name validation
                    $pattern_ln = "/^[a-zA-Z ]{3,12}$/";
                    if(!preg_match($pattern_ln, $last_name)) {
                        $err_ln = "Must be at lest 3 character long, letter and space allowed";
                    }

                    //user name validation
                    //at lest 3 character, letter, numeber and underscore allowed
                    $pattern_un = "/^[a-zA-Z0-9_]{3,16}$/";
                    if(!preg_match($pattern_un, $user_name)) {
                        $err_un = "Must be at lest 3 character long, letter, number and underscore allowed";
                    }

                    //email validation
                    //filter_var($user_email, FILTER_VALIDATE_EMAIL);
                    $pattern_ue = "/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/i";
                    if(!preg_match($pattern_ue, $user_email)) {
                        $err_ue = "Invalid format of email";

                    }

                    if($user_pass == $user_con_pass) {
                        //password validation
                        $pattern_up = "/^.*(?=.{4,56})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).*$/";
                        if(!preg_match($pattern_up, $user_pass)) {
                            $errPass = "Must be at lest 4 character long, 1 upper case, 1 lower case letter and 1 number exist";
                        }
                    } else {
                        $errPass = "Password dosen't matched";
                    }

                    if(!isset($err_fn) && !isset($err_ln) && !isset($err_un) && !isset($err_ue) && !isset($errPass)) {
                        $hash = password_hash($user_pass, PASSWORD_BCRYPT, ['cost'=>10]);
                        
                        $query = "INSERT INTO users (first_name, last_name, user_name, user_email, user_password, validation_key, registration_date) VALUES ('$first_name', '$last_name', '$user_name', '$user_email', '$hash', 0, 0)";
                        $query_conn = mysqli_query($connection, $query);
                        if(!$query_conn) {
                            die("Query failed" . mysqli_error($connection));
                        } else {
                            echo "Success";
                        }

                    }
                    
                }

            ?>





            <!-- <div class='notification'>Sign up successful. Check your email for activation link</div> -->
            <form action="sign_up.php" method="POST">
                <div class="input-box">
                    <input type="text" class="input-control" placeholder="First name" name="first_name" value="<?php if (isset($_POST['first_name'])) {
                                                                                                                            echo $_POST['first_name'];
                                                                                                                      } ?>" autocomplete="off">
                    <?php echo isset($err_fn)?"<span class='error'>{$err_fn}</span>":""; ?>
                    <!-- <span class='error'>Error messages</span> -->
                </div>
                <div class="input-box">
                    <input type="text" class="input-control" placeholder="Last name" name="last_name" value="<?php if (isset($_POST['last_name'])) {
                                                                                                                        echo $_POST['last_name'];
                                                                                                                    } ?>" autocomplete="off">
                    <?php echo isset($err_ln)?"<span class='error'>{$err_ln}</span>":""; ?>
                </div>
                <div class="input-box">
                    <input type="text" class="input-control" placeholder="Username" name="user_name" value="<?php if (isset($_POST['user_name'])) {
                                                                                                                        echo $_POST['user_name'];
                                                                                                                    } ?>" autocomplete="off">
                    <?php echo isset($err_un)?"<span class='error'>{$err_un}</span>":""; ?>
                </div>
                <div class="input-box">
                    <input type="email" class="input-control" placeholder="Email address" name="user_email" value="<?php if (isset($_POST['user_email'])) {
                                                                                                                        echo $_POST['user_email'];
                                                                                                                    } ?>" autocomplete="off">
                    <?php echo isset($err_ue)?"<span class='error'>{$err_ue}</span>":""; ?>
                </div>
                <div class="input-box">
                    <input type="password" class="input-control" placeholder="Enter password" name="user_password" autocomplete="off">
                    <?php echo isset($errPass)?"<span class='error'>{$errPass}</span>":""; ?>
                    
                </div>
                <div class="input-box">
                    <input type="password" class="input-control" placeholder="Confirm password" name="user_confirm_password" autocomplete="off">
                    <?php echo isset($errPass)?"<span class='error'>{$errPass}</span>":""; ?>
                    
                </div>
                <div class="input-box">
                    <input type="submit" class="input-submit" value="SIGN UP" name="sign-up">
                </div>
                <div class="sign-up-cta"><span>Already have an account?</span> <a href="login.php">Login here</a></div>
            </form>

        </div>
    </div>
<?php require_once("include/footer.php"); ?>