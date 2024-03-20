<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Set the title of the webpage -->
    <title>REGISTER</title>
    <!-- Link to the Bootstrap CSS file -->
    <link rel="stylesheet" type="text/css" href="bootstrap.css">
</head>
<body style="background-image: url('twice-i-got-you-members-4k-wallpaper-uhdpaper.com-817@1@n.jpg');
            background-size: cover;
            background-attachment: fixed;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            height: 100vh; 
    ">
    <?php
    $euname = isset($_GET['euname']) ? htmlspecialchars($_GET['euname']) : '';
    $efname = isset($_GET['efname']) ? htmlspecialchars($_GET['efname']) : '';
    $emname = isset($_GET['emname']) ? htmlspecialchars($_GET['emname']) : '';
    $elname = isset($_GET['elname']) ? htmlspecialchars($_GET['elname']) : '';
    $eemail = isset($_GET['eemail']) ? htmlspecialchars($_GET['eemail']) : '';
    ?>
    <!-- Container to center content, with top margin -->
    <div class="container mt-5">
        <!-- Row to justify content in the center -->
        <div class="row justify-content-center">
            <!-- Column with medium width -->
            <div class="col-md-6">
                <!-- Card with a border and info outline -->
                <div class="card border-outline-info" style="backdrop-filter: blur(10px); background-color: rgba(255, 255, 255, 0.5);">
                    <!-- Card header containing a form with action to register.php -->
                    <div class="card-header">
                        <form action="register.php" method="post">
                        <!-- Heading with large text and centered alignment -->    
                        <h1 class="display-4 text-center text-info">REGISTER</h1>
                    </div>
                    <!-- Card body for main content -->
                    <div class="card-body">
                    <?php if (isset($_GET['error'])) { ?>
                            <!-- Paragraph with error styling and text from GET parameter -->
                            <p class="error display-6 text-decoration-underline text-danger text-center"><?php echo $_GET['error']; ?></p>
                        <?php } ?>
                        <!-- Form group for username input -->
                        <div class="form-group">
                            <label class="display-6 text-start text-info">User Name</label>
                            <input type="text" class="form-control form-control-lg bg-white fs-6" name="uname" placeholder="User Name*" value="<?php echo $euname; ?>" >
                        </div>
                        <!-- Form group for name input -->
                        <div class="form-group">
                            <label class="display-6 text-start text-info">Name</label>
                             <!-- Input fields for first, middle, and last names with   attribute -->
                            <div style="display: flex; gap: 10px;">
                                <input type="text" class="form-control form-control-lg bg-white fs-6" class="placeholder" style="width: 33%;" name="fname" placeholder=" First*" pattern="[A-Za-z\s]+" title="don't input a number and special character" value="<?php echo $efname; ?>"  >
                                <input type="text" class="form-control form-control-lg bg-white fs-6" class="placeholder" style="width: 33%;" name="mname" placeholder=" Middle" pattern="[A-Za-z\s]+" title="don't input a number and special character" value="<?php echo $emname; ?>">
                                <input type="text" class="form-control form-control-lg bg-white fs-6" class="placeholder" style="width: 33%;" name="lname" placeholder=" Last*" pattern="[A-Za-z\s]+" title="don't input a number and special character" value="<?php echo $elname; ?>"  >
                            </div>
                        </div>
                        <!-- Form group for email input -->
                        <div class="form-group">
                            <label class="display-6 text-start text-info">Email</label>
                            <input type="email" class="form-control form-control-lg bg-white fs-6" name="email" placeholder="Your Email*" value="<?php echo $eemail; ?>"  >
                        </div>    
                        <!-- Form group for password input -->
                        <div class="form-group">
                            <label class="display-6 text-start text-info">Password</label>
                            <input type="password" class="form-control form-control-lg bg-white fs-6" name="password" placeholder="Your Password*">
                        </div> 
                        <!-- Form group for password confirmation input -->
                        <div class="form-group">
                            <label class="display-6 text-start text-info">Confirm Password</label>
                            <input type="password" class="form-control form-control-lg bg-white fs-6" name="cpassword" placeholder="Confirm Password*"><br>
                        </div> 
                        <div class="form-group " style="display: flex; gap: 10px;">
                            <input type="checkbox" name="terms">
                            <label class=" text-start text-info">I agree to the <a href="#">terms and conditions</a></label>
                        </div> 
                        <!-- Button to submit the registration form -->
                        <div class="d-grid gap-2 col-6 mx-auto">
                           <br> <button type="submit" name="create" class="btn btn-outline-info">Register</button>
                        </div>    
                    </div>    
                    <!-- Card footer containing a link to the login form -->
                    <div class="card-footer">
                        <!-- Paragraph with a link to the login form -->
                        <p class="text-info">Already have an account? <a href="loginform.php">Login here</a></p>
                    </form>
                    </div>
                </div>
            </div>
        </div>    
    </div>    
</body>
</html>
