
<?php 

session_start();

 // variable to calculate credits
 $creditsAllowed = 0;

 // result
 $result = "";

include('../includes/config.php');

if(isset($_SESSION['Enrollment_No']))
{
    $Enrollment_No = $_SESSION['Enrollment_No'];
}

if(isset($_POST['submit']))

{
 
  $First_Name = $_POST['First_Name'];
  $Last_Name = $_POST['Last_Name'];
  $Department = $_POST['Department'];
  $Category = $_POST['Category'];
  $Semester = $_POST['Semester'];
  $Subject_1 = $_POST['Subject_1'];
  $Subject_2 = $_POST['Subject_2'];
  $Subject_3 = $_POST['Subject_3'];
  $Subject_4 = $_POST['Subject_4'];
  $Subject_5 = $_POST['Subject_5'];

// $update_query = mysqli_query($database,"UPDATE `Student` SET `Last_Name` = 'dadd' WHERE `Student`.`Enrollment_No` = 'CSB17074' ");


$insert_query = mysqli_query($database, "INSERT INTO `students` 
(`First_Name`, `Last_Name`, `Department`, `Semester`, `Subject_1`, `Subject_2`, `Subject_3`, `Subject_4`, `Subject_5`, `Enrollment_No`)
VALUES
('$First_Name', '$Last_Name', '$Department', '$Semester', '$Subject_1', '$Subject_2', '$Subject_3', '$Subject_4', '$Subject_5', '$Enrollment_No')");



  // $update_query = mysqli_query($database,"UPDATE `Student` SET `First_Name` = '$First_Name', `Last_Name` = '$Last_Name', `Department` = '$Department', `Semester` = '$Semester', `SGPA` = '$SGPA', `CGPA` = '$CGPA', `Category` = '$Category',`Fee_Amount` = '$Fee_Amount',`Journal_Number` = '$Journal_Number' WHERE `Student`.`Enrollment_No` = '$Enrollment_No' ");

if($update_query)
{
$_SESSION['msg']="Student Record updated Successfully !!";
}
else
{
  $_SESSION['$msg']="Error : Student Record not update";
}


header('location: dashboard.php');
}




 ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Colorlib Templates">
    <meta name="author" content="Colorlib">
    <meta name="keywords" content="Colorlib Templates">

    <!-- Title Page-->
    <title>Admin Panel // Edit Registration</title>

    <!-- Icons font CSS-->
    <link href="../others/vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href="../others/vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <!-- Font special for pages-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">

    <!-- Vendor CSS-->
    <link href="../others/vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="../others/vendor/datepicker/daterangepicker.css" rel="stylesheet" media="all">

    <!-- Main CSS-->

    <!-- Main CSS-->
    <link href="../others/css/main.css" rel="stylesheet" media="all">

    <script type="text/javascript">

    function confSubmit(form) {
    if (confirm("Are you sure you want to submit the form?")) 
    {
        var sbj_1 = document.getElementById('subj1').value;
        var sbj_2 = document.getElementById('subj2').value;
        var sbj_3 = document.getElementById('subj3').value;
        var sbj_4 = document.getElementById('subj4').value;
        var sbj_5 = document.getElementById('subj5').value;

        // Regular expression to capture the last character of a word to find number of credits for each course
        const regex = /\w$/;

        // Input string
        const inputString_1 = sbj_1;
        // Use the regular expression to find the last character
        const match_1 = inputString_1.match(regex);
        const credit_sbj_1 = match_1[0];

        // Input string
        const inputString_2 = sbj_2;
        // Use the regular expression to find the last character
        const match_2 = inputString_2.match(regex);
        const credit_sbj_2 = match_2[0];

        // Input string
        const inputString_3 = sbj_3;
        // Use the regular expression to find the last character
        const match_3 = inputString_3.match(regex);
        const credit_sbj_3 = match_3[0];

        // Input string
        const inputString_4 = sbj_4;
        // Use the regular expression to find the last character
        const match_4 = inputString_4.match(regex);
        const credit_sbj_4 = match_4[0];

        // Input string
        const inputString_5 = sbj_5;
        // Use the regular expression to find the last character
        const match_5 = inputString_5.match(regex);
        const credit_sbj_5 = match_5[0];


        
        // converting the string credit number to integer
        credit_int_sbj1 =parseInt(credit_sbj_1);
        credit_int_sbj2 =parseInt(credit_sbj_2);
        credit_int_sbj3 =parseInt(credit_sbj_3);

        var total_credits =credit_int_sbj1 + credit_int_sbj2 + credit_int_sbj3;
        
        
        if(credit_sbj_4 != 'n'){
            credit_int_sbj4 = parseInt(credit_sbj_4);
            total_credits+=credit_int_sbj4;
        }
        if(credit_sbj_5 != 'n'){
            credit_int_sbj5 = parseInt(credit_sbj_5);
            total_credits+=credit_int_sbj5;
        }

        alert(total_credits);
        
        if (total_credits <= 18 && <?php echo $creditsAllowed; ?> == 18) {
        alert('true');
    }



        // alert(sbj_1);
        // alert(sbj_2);
        // alert(sbj_3);
        // alert(sbj_4);
        // alert(sbj_5);
        // form.submit();
    }
    else
    {
        return false;
    }
    }


    </script>

    <style>
        /* Add CSS for horizontal alignment */
        .rs-select2 label {
            display: inline-block;
            margin-right: 20px; /* Adjust the margin as needed */
            text-align: center;
        }
    </style>




</head>

<body>

    <div class="page-wrapper bg-gra-03 p-t-45 p-b-50">
        <div class="wrapper wrapper--w790">
            <div class="card card-5">
                <div class="card-heading">
                    <h2 class="title">Course Registration form </h2>
                    <div class="title"> <?php if(isset($update_query)){print_r($_SESSION['msg']);} ?> </div>
                </div>
                <div class="card-body">
                    <form name="admin" method="post">
                        <div class="form-row m-b-55">
                            <div class="name">Name</div>
                            <!-- <div class="value"> -->
                                <div class="row row-space">
                                    <div class="col-2">
                                        <div class="input-group-desc">
                                            <input class="input--style-5" type="text" name="First_Name" required="">
                                            <label class="label--desc">First name</label>
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="input-group-desc">
                                            <input class="input--style-5" type="text" name="Last_Name" required="">
                                            <label class="label--desc">Last name</label>
                                        </div>
                                    </div>
                                </div>
                            <!-- </div> -->
                        </div>

                        <div class="form-row">
                            <div class="name">Enrollment Number</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" type="text" name="Enrollment_Number" value="<?php echo htmlentities($Enrollment_No);?>" readonly>
                                </div>
                            </div>
                        </div>


                        <div class="form-row">
                            <div class="name">Department</div>
                            <div class="value">
                                <div class="input-group">
                                    <div class="rs-select2 js-select-simple select--no-search">
                                        <select name="Department" required="">
                                            <option disabled="disabled" selected="selected">Choose option</option>
                                            <?php 

                                            $subject_query = mysqli_query($database,"SELECT DISTINCT department from Subjects");


                                            $count = 0;
                                            while($row=mysqli_fetch_array($subject_query))
                                            {
                                             ?>
                                             <option><?php print_r($row[0]) ?></option>

                                             <?php 
                                                $count++;
                                            } 
                                            ?>
                                        </select>
                                        <div class="select-dropdown"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="name">Semester</div>
                            <div class="value">
                                <div class="input-group">
                                    <div class="rs-select2 js-select-simple select--no-search">
                                        <select name="Semester">
                                            <option  disabled="disabled" selected="selected">Choose option</option>
                                            <option>1</option>
                                            <option>2</option>
                                            <option>3</option>
                                            <option>4</option>
                                            <option>5</option>
                                            <option>6</option>
                                            <option>7</option>
                                            <option>8</option>
                                            <option>9</option>
                                            <option>10</option>
                                        </select>
                                        <div class="select-dropdown"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="name">Previous Results:</div>
                            <div class="value">
                                <div class="input-group">
                                    <div class="rs-select2 js-select-simple select--no-search">
                                        <label>
                                            <input type="radio" name="Category" value="Good Pass" onClick="determineCredit('Good Pass')"> Good Pass
                                        </label>
                                        <label>
                                            <input type="radio" name="Category" value="Conditional Pass" onClick="determineCredit('Conditional Pass')"> Conditional Pass
                                        </label>
                                        <label>
                                            <input type="radio" name="Category" value="Failed" onClick="determineCredit('Failed')"> Failed
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <div id="creditsContainer" style="margin-bottom:30px;">
                            <h5>You are allowed to register for credit</h5>
                        </div>

                        <script>
                            // show how many credits the user can register for
                            function determineCredit(x){
                                if(x == 'Good Pass'){
                                    document.getElementById('creditsContainer').innerHTML = "You are allowed to register for 18 credit";
                                    <?php
                                        $creditsAllowed = 18;
                                        $result = "Good Pass";
                                    ?>
                                }else if(x == 'Conditional Pass'){
                                    document.getElementById('creditsContainer').innerHTML = "You are allowed to register for 9 credit";
                                    <?php
                                        $creditsAllowed = 9;
                                        $result = "Conditional Pass";
                                    ?>
                                }else{
                                    document.getElementById('creditsContainer').innerHTML = "You have to repeat your previous semester";
                                    $result = "Failed";
                                }
                            }
                        </script>

                        

                        <div class="form-row">
                            <div class="name">Subject 1</div>
                            <div class="value">
                                <div class="input-group">
                                    <div class="rs-select2 js-select-simple select--no-search">
                                        <select name="Subject_1" id="subj1" required="">
                                            <option disabled="disabled" selected="selected">Choose option</option>
                                            <?php
                                                $subject_query = mysqli_query($database, "SELECT DISTINCT Course_Code, Course_Title, Course_Credit FROM Subjects");

                                                $count = 0;
                                                while ($row = mysqli_fetch_array($subject_query)) {
                                                    ?>
                                                    <option value="<?php echo $row['Course_Code']; ?>"><?php echo $row['Course_Code'] . ' - ' . $row['Course_Title'] . ' - ' . $row['Course_Credit']; ?></option>
                                                    <?php
                                                    $count++;
                                                }
                                            ?>

                                        </select>

                                        <div class="select-dropdown"></div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="form-row">
                            <div class="name">Subject 2</div>
                            <div class="value">
                                <div class="input-group">
                                    <div class="rs-select2 js-select-simple select--no-search">
                                        <select name="Subject_2" id="subj2" required="">
                                            <option disabled="disabled" selected="selected">Choose option</option>
                                            <?php
                                                $subject_query = mysqli_query($database, "SELECT DISTINCT Course_Code, Course_Title, Course_Credit FROM Subjects");

                                                $count = 0;
                                                while ($row = mysqli_fetch_array($subject_query)) {
                                                    ?>
                                                    <option value="<?php echo $row['Course_Code']; ?>"><?php echo $row['Course_Code'] . ' - ' . $row['Course_Title'] . ' - ' . $row['Course_Credit']; ?></option>
                                                    <?php
                                                    $count++;
                                                }
                                            ?>
                                        </select>
                                        <div class="select-dropdown"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="name">Subject 3</div>
                            <div class="value">
                                <div class="input-group">
                                    <div class="rs-select2 js-select-simple select--no-search">
                                        <select name="Subject_3" id="subj3" required="">
                                            <option disabled="disabled" selected="selected">Choose option</option>
                                            <?php
                                                $subject_query = mysqli_query($database, "SELECT DISTINCT Course_Code, Course_Title, Course_Credit FROM Subjects");

                                                $count = 0;
                                                while ($row = mysqli_fetch_array($subject_query)) {
                                                    ?>
                                                    <option value="<?php echo $row['Course_Code']; ?>"><?php echo $row['Course_Code'] . ' - ' . $row['Course_Title'] . ' - ' . $row['Course_Credit']; ?></option>
                                                    <?php
                                                    $count++;
                                                }
                                            ?>
                                        </select>
                                        <div class="select-dropdown"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="name">Subject 4</div>
                            <div class="value">
                                <div class="input-group">
                                    <div class="rs-select2 js-select-simple select--no-search">
                                        <select name="Subject_4" id="subj4" required="">
                                            <option disabled="disabled" selected="selected">Choose option</option>
                                            <?php
                                                $subject_query = mysqli_query($database, "SELECT DISTINCT Course_Code, Course_Title, Course_Credit FROM Subjects");

                                                $count = 0;
                                                while ($row = mysqli_fetch_array($subject_query)) {
                                                    ?>
                                                    <option value="<?php echo $row['Course_Code']; ?>"><?php echo $row['Course_Code'] . ' - ' . $row['Course_Title'] . ' - ' . $row['Course_Credit']; ?></option>
                                                    <?php
                                                    $count++;
                                                }
                                            ?>
                                        </select>
                                        <div class="select-dropdown"></div>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <div class="form-row">
                            <div class="name">Subject 5</div>
                            <div class="value">
                                <div class="input-group">
                                    <div class="rs-select2 js-select-simple select--no-search">
                                        <select name="Subject_5" id="subj5" required="">
                                            <option disabled="disabled" selected="selected">Choose option</option>
                                            <?php
                                                $subject_query = mysqli_query($database, "SELECT DISTINCT Course_Code, Course_Title, Course_Credit FROM Subjects");

                                                $count = 0;
                                                while ($row = mysqli_fetch_array($subject_query)) {
                                                    ?>
                                                    <option value="<?php echo $row['Course_Code']; ?>"><?php echo $row['Course_Code'] . ' - ' . $row['Course_Title'] . ' - ' . $row['Course_Credit']; ?></option>
                                                    <?php
                                                    $count++;
                                                }
                                            ?>
                                        </select>
                                        <div class="select-dropdown"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- <div class="form-row p-t-20">
                            <label class="label label--block">Do you confirm your inputs ?</label>
                            <div class="p-t-15">
                                <label class="radio-container m-r-55">Yes
                                    <input type="radio" checked="checked" name="exist">
                                    <span class="checkmark"></span>
                                </label>
                                <label class="radio-container">No
                                    <input type="radio" name="exist">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                        </div> -->
                        <div>
                            <button name="submit" class="btn btn--radius-2 btn--red" onClick="return confSubmit(this.form);"  type="submit">Submit ?</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Jquery JS-->
    <script src="../others/vendor/jquery/jquery.min.js"></script>
    <!-- Vendor JS-->
    <script src="../others/vendor/select2/select2.min.js"></script>
    <script src="../others/vendor/datepicker/moment.min.js"></script>
    <script src="../others/vendor/datepicker/daterangepicker.js"></script>

    <!-- Main JS-->
    <script src="../others/js/global.js"></script>

</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>
<!-- end document-->