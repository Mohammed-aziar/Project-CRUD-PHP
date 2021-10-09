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

        
    }else if(isset($_POST['editProduct'])){
        $nameProduct    =   $_POST['txtname'];
        $priceProduct   =   $_POST['txtprice'];
        $idProduct      =   $_POST['txtid'];
        if(!empty($nameProduct && $priceProduct && $idProduct)){
            //method one 
            /*
            $upDate= $pdo->prepare("UPDATE tbl_product set productname='".$nameProduct."', productprice ='".$priceProduct."' WHERE id=".$idProduct);
            */
            //method two
            $upDate= $pdo->prepare("UPDATE tbl_product set productname=:name, productprice =:price WHERE id=".$idProduct);
            $upDate -> bindParam('name',$nameProduct);
            $upDate -> bindParam('price',$priceProduct);
            $upDate -> execute();
            if($upDate-> rowCount())
            echo "Insert Successfull";
            else
            echo "Insert Fail";
            
        }else{
            echo "file are Empty";
        }
    }
        if(isset($_POST['btndelete'])){
            $id =   $_POST['btndelete'];
            $delete = $pdo  ->  prepare("DELETE FROM tbl_product WHERE id=".$_POST['btndelete']);
            $delete ->  execute();
            if($delete -> rowCount())
            echo "data deleted successfull";
            else
            echo "Delete Fail!!!";
        }else{
            echo "erreur";
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
    <?php
        if(isset($_POST['btnedit'])){
            $select=$pdo->prepare("select * from tbl_product where id=".$_POST['btnedit']);
            $select->execute();
            $row=$select->fetch(PDO::FETCH_NUM);
            echo '<p><input type="text" hidden name="txtid"  value='.$row[0].'></p>
            <p><input type="text" name="txtname" placeholder="Entrer nom de produit" value='.$row[1].'></p>
            <p><input type="text" name="txtprice" placeholder="Entrer prix de produit" value='.$row[2].'></p>
                <input type="submit" name="editProduct" value="modifier">';
        }else{
            echo '<p><input type="text" name="txtname" placeholder="Entrer nom de produit"></p>
            <p><input type="text" name="txtprice" placeholder="Entrer prix de produit"></p>
            <input type="submit" name="saveProduct" value="enregistré">';
        }
    ?>
   
        
    
    
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
                "<td><button type='submit' value=".$row[0]." name='btnedit'>Edit</button></td>".
                "<td><button type='submit'  value=".$row[0]." name='btndelete'>Delete</button></td></tr>";
            }
        ?>
        
        </tbody>
    </table>
    </form>
</body>
