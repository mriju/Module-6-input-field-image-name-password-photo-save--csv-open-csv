<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complete</title>
</head>
<body>
    <?php 
    session_start();
    if(isset($_SESSION['name']))
    {?>
    <h5 style="text-align: center; color:blue; margin-top:10px">Welcome, <?= $_SESSION['name'] ?>, Thanks for your registration.</h5>
    <?php 
        unset($_SESSION['name']);
    } ?>
</body>
</html>