<?php
    include'dbconnect.php';
    if(isset($_POST['saveProduct'])){
        $nameProduct=$_POST['txtname'];
        $priceProduct=$_POST['txtprice'];


        if(!empty($nameProduct && $priceProduct)){
            $insert =   $pdo ->prepare("insert into tbl_product(productname,productprice) values(:name,:price)");
            $insert-> bindParam(':name',$nameProduct);
            $insert-> bindParam(':price',$priceProduct);
            $insert-> execute();
                if($insert-> rowCount())
                    echo "Insert Successfull";
                else
                    echo "Insert Fail";
        }else{
            echo "fail are Empty";
        }

        
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD</title>
</head>
<body>
    <h2>PHP PDO CRUD OPERATION</h2>
    <form action="" method="POST">
    <p><input type="text" name="txtname" placeholder="Entrer nom de produit"></p>
    <p><input type="text" name="txtprice" placeholder="Entrer prix de produit"></p>
        <input type="submit" name="saveProduct" value="enregistré">
    </form>
</body>

<hr>
<?php

    $select =   $pdo->prepare("select * from tbl_product");
    $select->execute();
    echo "<pre>";

   //fetch with name column and number of array
   /*
    while($row    =   $select->fetch()){
        print_r($row);
    }
    */

    //fetch with number in array
   /* 
        while($row = $select -> fetch(PDO::FETCH_NUM)){
            print_r($row);
        }
    */
   

    //if show Id of products  and name and price
/*
     while($row = $select -> fetch(PDO::FETCH_NUM)){
         echo "Id : ".$row[0]." name : ".$row[1]." price : ".$row[2]."</br></br>";
     }
    
 */

     //for fetch all without use loop while

   /*  $row = $select -> fetchAll();
     print_r($row);
    */

     //FETCH_ASSOC loop with name of column
    /*
        $row = $select -> fetchAll(PDO::FETCH_ASSOC);
        print_r($row);
        */

    //Fetch by obejct
    $row=$select -> fetchAll(PDO::FETCH_OBJ);
    print_r($row);
     echo "</pre>";
?>