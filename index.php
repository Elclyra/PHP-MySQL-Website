<?php 
include 'config/db_connect.php';
// write query for all products
$sql = "SELECT * FROM products";

//Make query and get results
$results = mysqli_query($conn, $sql);

// Fetch the resulting rows as an array
$products = mysqli_fetch_all($results, MYSQLI_ASSOC);

// delete records
if(isset($_POST['submit']))
{
    $arr = $_POST['checkbox'];
    foreach ($arr as $id) {
         mysqli_query($conn,"DELETE FROM products WHERE id = " . $id);
    }  
    header("Location:index.php");
}


// Free result for memory
mysqli_free_result($results);

// close the connection
mysqli_close($conn);


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product list</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link href="style.css" type="text/css" rel="stylesheet">
</head>
<body>
    <div class="header d-flex">
        <div class="p-2 flex-grow-1"><h1>Product List</h1></div>
        <div class="p-2"><a href="add.php"><button class="btn btn-outline-dark">ADD</button></a></div>
        <div class="p-2"><a href="index.php"><button class="btn btn-outline-dark" type="submit" name="submit" value="Submit" form="mainForm">MASS DELETE</button></a></div>
    </div>
<form action="index.php" method="post" id="mainForm" > 
    <div class="main row">
                    <?php  foreach($products as $product){ ?>
                        <div class="col-md-3">
                        <div class="card z-depth-0">
                        <input name="checkbox[]" type="checkbox" class='chkbox cardCheckbox' value="<?php echo $product['id']; ?>"/>
                            <div class="card-body">
                                <?php if($product["Type"] == "Book"){?>
                                    <div><?php echo htmlspecialchars($product["SKU"]); ?></div>
                                    <div><?php echo htmlspecialchars($product["Name"]); ?></div>
                                    <div><?php echo htmlspecialchars($product["Price"]); ?> $</div>
                                    <div><?php echo htmlspecialchars($product["Weight"]); ?> KG</div>

                                <?php }else if($product["Type"] == "DVD"){?>
                                    <div><?php echo htmlspecialchars($product["SKU"]); ?></div>
                                    <div><?php echo htmlspecialchars($product["Name"]); ?></div>
                                    <div><?php echo htmlspecialchars($product["Price"]); ?> $</div>
                                    <div>Size: <?php echo htmlspecialchars($product["Size"]); ?>MB</div>

                                <?php }else if($product["Type"] == "Furniture"){ ?>
                                    <div><?php echo htmlspecialchars($product["SKU"]); ?></div>
                                    <div><?php echo htmlspecialchars($product["Name"]); ?></div>
                                    <div><?php echo htmlspecialchars($product["Price"]); ?> $</div>
                                    <div>Dimensions: <?php echo htmlspecialchars($product["Height"]);?>x<?php echo htmlspecialchars($product["Width"]);?>x<?php echo htmlspecialchars($product["Length"]);?></div>
                                    
                                <?php } ?>     
                            </div>
                            
                        </div>
                        </div>
                        
                    <?php }?>
    </div>
    </form>
    <div class="footer">
        <small><p>&copy; Copyright 2021, Edvard Nurk</p></small>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</body>
</html>