<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
    <title>Register - Online Drivers Education App</title>
    <!-- Bootstrap Core CSS -->
    <link href="css/lib/bootstrap/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/helper.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:** -->
    <!--[if lt IE 9]>
    <script src="https:**oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https:**oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
    
</head>

<body class="fix-header fix-sidebar">
    <?php
        $refer = $_GET['refer'];
    ?>
    <!-- Preloader - style you can find in spinners.css -->
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
			<circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
    </div>
    <!-- Main wrapper  -->
    <div id="main-wrapper">
        <div class="unix-login">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-lg-4">
                        <div class="login-content card">
                            <div class="login-form">
                                <h4>Register</h4>
                                <form data-toggle="validator" method="post" id="register_form">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input id="username" type="name" name="name" class="form-control" placeholder="First & Last Name" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Age</label>
                                        <input type="dob" id="age" name="age"class="form-control" placeholder="03/26/2001" required></div>
                                    <div class="form-group">
                                        <label>Email address</label>
                                        <input id="email" type="email" name="email" class="form-control" placeholder="Email" data-error="This email is invalid" required>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input id="password" type="password" name="password" class="form-control" placeholder="Password" data-minlength="8" data-error="Minimum of 8 characters" required>
                                        <div class="help-block"></div>
                                    </div>
                                    <div class="form-group">
                                        <label>Choose Your Course</label>
                                        <select name="course" class="form-control">
                                            <option value="0" selected>Texas Parent Taught Drivers Ed</option>
                                            <option value="1">Texas Instructor Taught Drivers Ed</option>
                                            <option value="2">Texas Adult Drivers Ed</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Referral</label>
                                        <input id="referral" type="text" name="referral" class="form-control" placeholder="Referral Code" value="<?php echo $refer?>">
                                    </div>
                                    <div class="form-group checkbox">
                                        <label>
										<input id="policy" type="checkbox" data-error="Don't you agree?" required> Agree the terms and Privacy Policy
									    </label>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                    <button name="register" type="submit" class="btn btn-primary btn-flat m-b-30 m-t-30" >Register</button>
                                    <div class="register-link m-t-15 text-center">
                                        <p>Already have account? <a href="page-login.html"> Sign in</a></p>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- End Wrapper -->
    <!-- All Jquery -->
    <script src="js/lib/jquery/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="js/lib/bootstrap/js/popper.min.js"></script>
    <script src="js/lib/bootstrap/js/bootstrap.min.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="js/jquery.slimscroll.js"></script>
    <!--Menu sidebar -->
    <script src="js/sidebarmenu.js"></script>
    <!--stickey kit -->
    <script src="js/lib/sticky-kit-master/dist/sticky-kit.min.js"></script>
    <!--Custom JavaScript -->
    <script src="js/custom.min.js"></script>
    <script src="js/validator.js"></script>
    <script src="js/register.js"></script>
	<?php
	include('config.php');
	if(isset($_POST['register']))
	{
	
        $password= $_POST['password'];
        
        $en= md5($password);
        
        
        
        $sq ="INSERT INTO `user` (`id`, `name`, `age`, `email`, `password`, `course`, `referral`, `created_at`) VALUES (NULL, '".$_POST['name']."', '".$_POST['age']."', '".$_POST['email']."', '$en', '".$_POST['course']."', '".$_POST['referral']."', '".date("Y-m-d h:i:sa")."');";
        $qu =mysqli_query($conn,$sq);
        if($qu)
        {
            $sq ="SELECT * FROM `user` WHERE email='".$_POST['email']."' AND password='$en'";
            $qu =mysqli_query($conn,$sq);
            $newaccount=mysqli_fetch_array($qu);
            
            $referral = $_POST['referral'];
            if(!is_null($referral) && strlen($referral) > 0)
            {
                $referral = strtolower(str_replace(' ', '', $referral));

                $sql="SELECT * FROM `user`";
                $res=mysqli_query($conn,$sql); 
                while($row = mysqli_fetch_assoc($res))
                {
                    $name = strtolower(str_replace(' ', '', $row['name']));
                    if($referral == $name)
                    {
                        $sq ="INSERT INTO `referral` (`id`, `user_id`, `sender_id`, `reward`, `status`, `created_at`) VALUES (NULL, '".$row['id']."', '".$newaccount['id']."', '10', '0', '".date("Y-m-d h:i:sa")."');";
                        $qu =mysqli_query($conn,$sq);
                        break;
                    }
                }
            }
            echo "<script>alert('Your Account Has Been Created')</script>";
                    echo "<script>window.open('page-login.php','_self')</script>";
        }
        else
        {
            echo "<script>alert('Your Account Has not  Been Created')</script>";
        }
        
	}
	
	?>
    
</body>

</html>