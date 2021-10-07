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
    <hr>
    <table id="producttable" border="1">
        <thead>
            <th>ID</th>
            <th>NameProduct</th>
            <th>PriceProduct</th>
            <th>Edit</th>
            <th>Delete</th>
        </thead>
             <tbody>
        <?php
             $select =   $pdo->prepare("select * from tbl_product");
             $select->execute();
            while( $row = $select -> fetch(PDO::FETCH_NUM)){
                echo "<tr><td>".$row[0]."</td>".
                "<td>".$row[1]."</td>".
                "<td>".$row[2]."</td>".
                "<td><button type='submit' value=".$row[0]." >Edite</button></td>".
                "<td><button type='submit'  value=".$row[0]." >Delete</button></td></tr>";
            }
        ?>
        
        </tbody>
    </table>
</body>
