<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display Data</title>
</head>
<body>
    <table border="1" width="100%">
        <tr>
            <td>Name</td>
            <td>Email</td>
            <td>Password</td>
            <td>Photo</td>
        </tr>
        
        <?php
        $files = fopen('users.csv', 'r');
        // die;        
        while (($data = fgetcsv($files)) !== false) {?>    
        <tr>
            <td><?php echo $data[1];?></td>        
            <td><?php echo $data[2];?></td>        
            <td><?php echo $data[3];?></td>        
            <td><img src="image/<?php echo $data[4];?>" width="100" height="100"></img></td>        
        </tr>
        <?php        
         }
         fclose($files);
         ?>
    </table>
</body>
</html>