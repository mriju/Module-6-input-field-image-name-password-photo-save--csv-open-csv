<?php
$error = 0;
$name = $email = $subject = $message = '';
function clean_text($string)
{
 $string = trim($string);
 $string = stripslashes($string);
 $string = htmlspecialchars($string);
 return $string;
}

if(isset($_POST["submit"]))
{
 if(empty($_POST["name"]))
 {
  $nameError= '<p><label style="color:red">*Please Enter your Name</label></p>';
  $error++;
 }
 else
 {
  $name = clean_text($_POST["name"]);
 }
 if(empty($_POST["email"]))
 {
    $emailError = '<p><label style="color:red">*Please Enter your Email</label></p>';
    $error++;
 }
 else
 {
  $email =  clean_text($_POST["email"]);
  if(!filter_var($email, FILTER_VALIDATE_EMAIL))
  {
    $emailError =  '<p><label style="color:red">*Invalid email format</label></p>';
    $error++;
  }
 }
 if(empty($_POST["password"]))
 {
    $passwordError =  '<p><label style="color:red">*Password is required</label></p>';
    $error++;
 }
 else
 {
  $password = clean_text($_POST["password"]);
 }

 if(empty($_FILES["picture"]['name']))
 {
    $pictureError =  '<p><label style="color:red">*Upload picture is required</label></p>';
    $error++;
 }
 else
 {
    $filename = date( 'Y-m-d_H-i-s' ) . '_' . $_FILES["picture"]['name'];
    $tempname = $_FILES["picture"]["tmp_name"];
    $folder = "image/".$filename;

 }
 


 if($error == 0)
 {
  $file_open = fopen("users.csv", "a");
  $no_rows = count(file("users.csv"));
  if($no_rows > 1)
  {
   $no_rows = ($no_rows - 1) + 1;
  }
  $form_data = array($no_rows,$name,$email,$password,$filename);
  fputcsv($file_open, $form_data);
  move_uploaded_file($tempname, $folder);
  $message = '<label style="color:green; font-size:20px; text-align:center">Thank you for registration. Your data save successfully</label>';
  session_start();
  setcookie( 'username', $name );
  $_SESSION['name'] = $name;
  header('Location: done.php');
 }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assignment One Form</title>
    <style>
        div{
            width: 60%;
            margin: 20px auto;
            border: 1px solid #f9f9f9;
        }
        form{
            width: 50%;
        }
        form input{
            width: 100%;
            margin-bottom: 5px;
            padding: 5px;
        }
        h3{
            text-align: center;
        }
        form input[type='submit']{
            width: 20%;
        }

    </style>
</head>
<body>
    <div>
        <form action="" method="POST" enctype="multipart/form-data">
            <h3>HTML Form</h3>
            <?php echo $message ?? "" ?> <br>
            <label for="name">Name</label>
            <input type="text" id="name" name="name" placeholder="Enter You Name">
            <?php echo $nameError ?? "" ?>
            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Enter You Email">
            <?php echo $emailError ?? "" ?>
            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Enter You Password">
            <?php echo $passwordError ?? "" ?>
            <label for="picture">Picture</label>
            <input type="file" id="picture" name="picture">
            <?php echo $pictureError ?? "" ?>
            <input type="submit" name="submit" value="Submit">
        </form>
    </div>
</body>
</html>