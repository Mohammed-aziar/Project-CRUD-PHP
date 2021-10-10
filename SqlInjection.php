<?php
    include 'dbconnect.php';
   /* 
        this code easy to access a databasse with sqlinjection
    if(isset($_POST['sub']))
    {
        $email=$_POST['email'];
        $select = $pdo->prepare("select * from tbl_email where email='$email'");
        $select->execute();
        if($select->rowCount())
            echo    "email matched ".$_POST['email'];
        else
            echo    "wrong email";
    }
    */
    //i injected code in input for drop a teble ';DROP TABLE nameOfTable;'--


    if(isset($_POST['sub'])){
        $email=$_POST['email'];
        $select=$pdo -> prepare("select * from tbl_email where email=:email");
        $select->bindParam("email",$email);
        $select->execute();

        $row = $select->fetch(PDO::FETCH_ASSOC);
        if($row['email']=$email)
            echo 'Email matched '.$email;
        else
            echo 'wrong email';
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h2>SQL injection</h2>
<form action="" method="POST">
    <p><input type="text" name="email" placeholder="entre email"></p>
    <input type="submit" value="envoye" name="sub">
</form>
</body>
</html>