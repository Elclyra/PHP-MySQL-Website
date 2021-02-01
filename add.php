<?php 

include "config/db_connect.php";

$SKU = $Name = $Type = $Price = $Size = $Weight = $Height = $Width = $Length = "";
$errors = array("SKU"=>"", "Name"=>"", "Type"=>"", "Price"=>"", "Size"=>"", "Weight"=>"", "Height"=>"", "Width"=>"", "Length"=>"");

if(isset($_POST["submit"])){

    //check SKU
    if(empty($_POST["SKU"])){
        $errors["SKU"] = "SKU is required <br />";
    } else{
        $SKU = $_POST["SKU"];
        if(!preg_match("/^[a-zA-Z\d, space, ']+$/", $SKU)){
            $errors["SKU"] = "SKU must be letters and numbers only";
        }
    }
    //check name
    if(empty($_POST["Name"])){
        $errors["Name"] = "Name is required <br />";
    } else{
        $Name = $_POST["Name"];
        if(!preg_match("/^[a-zA-Z\d, space, ']+$/", $Name)){
            $errors["Name"] = "Name must be letters and numbers only";
        }
    }
    //check type
    if(empty($_POST["Type"])){
        $errors["Type"] = "Please select a valid type <br />";
    } else{
        $Type = $_POST["Type"];
    }
    //check Price
    if(empty($_POST["Price"])){
        $errors["Price"] = "Price is required <br />";
    } else{
        $Price = $_POST["Price"];
        if(filter_var($Price, FILTER_VALIDATE_INT) === false){
            $errors["Price"] = "Price must be a number";
        }
    }
    //check Size
    if($Type == "DVD"){
        if(empty($_POST["Size"])){
            $errors["Size"] = "Size is required <br />";
        } else{
            $Size = $_POST["Size"];
            if(filter_var($Size, FILTER_VALIDATE_INT) === false){
                $errors["Size"] = "Size must be a number";
            }
        }
    }
    //check Weight
    if($Type == "Book"){
        if(empty($_POST["Weight"])){
            $errors["Weight"] = "Weight is required <br />";
        } else{
            $Weight = $_POST["Weight"];
            if(filter_var($Weight, FILTER_VALIDATE_INT) === false){
                $errors["Weight"] = "Weight must be a number";
            }
        }
    }
    //check Height
    if($Type == "Furniture"){
        if(empty($_POST["Height"])){
            $errors["Height"] = "Height is required <br />";
        } else{
            $Height = $_POST["Height"];
            if(filter_var($Height, FILTER_VALIDATE_INT) === false){
                $errors["Height"] = "Height must be a number";
            }
        }
    //check Width
    if(empty($_POST["Width"])){
        $errors["Width"] = "Width is required <br />";
    } else{
        $Width = $_POST["Width"];
        if(filter_var($Width, FILTER_VALIDATE_INT) === false){
            $errors["Width"] = "Width must be a number";
        }
    }
    //check Length
    if(empty($_POST["Length"])){
        $errors["Length"] = "Length is required <br />";
    } else{
        $Length = $_POST["Length"];
        if(filter_var($Length, FILTER_VALIDATE_INT) === false){
            $errors["Length"] = "Length must be a number";
        }
    }
}


    if(array_filter($errors)){
        //echo "errors in the form";
    } else{

        $SKU = mysqli_real_escape_string($conn, $_POST["SKU"]);
        $Name = mysqli_real_escape_string($conn, $_POST["Name"]);
        $Type = mysqli_real_escape_string($conn, $_POST["Type"]);
        $Price = mysqli_real_escape_string($conn, $_POST["Price"]);
        $Size = mysqli_real_escape_string($conn, $_POST["Size"]);
        $Weight = mysqli_real_escape_string($conn, $_POST["Weight"]);
        $Height = mysqli_real_escape_string($conn, $_POST["Height"]);
        $Width = mysqli_real_escape_string($conn, $_POST["Width"]);
        $Length = mysqli_real_escape_string($conn, $_POST["Length"]);
        // Create sql
        $sql = "INSERT INTO products(SKU,Name,Type, Price, Size, Weight, Height, Width, Length) VALUES('$SKU', '$Name', '$Type', '$Price', '$Size', '$Weight', '$Height', '$Width', '$Length')";

        // Save to db and check
        if(mysqli_query($conn, $sql)){
            //Success
            header("Location: index.php");
        } else{
            //error
            echo "query error: " . mysqli_error($conn);
        }
    }
} // End of post check


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Add</title>
    <link href="style.css" rel="stylesheet" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
    <div class="header d-flex">
        <div class="p-2 flex-grow-1"><h1>Product Add</h1></div>
        <div class="p-2"><a href="index.php"><button class="btn btn-outline-dark" type="submit" name="submit" value="submit" form="mainForm">Save</button></a></div>
        <div class="p-2"><a href="index.php"><button class="btn btn-outline-dark">Cancel</button></a></div>
    </div>
    <div class="mainAdd" >
    <section class="container-fluid grey-text">
        <form action="add.php" method="post" id="mainForm">
            <label>SKU</label>
            <input type="text" name="SKU" value = "<?php echo $SKU ?>"><br>
            <div><?php echo $errors["SKU"]; ?></div>
            <label>Name</label>
            <input type="text" name="Name" value = "<?php echo $Name ?>">
            <div><?php echo $errors["Name"]; ?></div>
            <label>Price ($)</label>
            <input type="text" name="Price" value = "<?php echo $Price?>">
            <div><?php echo $errors["Price"]; ?></div>
      
            <div id="Selector">
                <select name="Type" class="Type">
                    <option selected disabled>Type Switcher </option>
                    <option value="Book" name="Type">Book</option>
                    <option value="DVD" name="Type">DVD</option>
                    <option value="Furniture" name="Type">Furniture</option>
                </select>
                <div><?php echo $errors["Type"]; ?></div>
            </div>
        <div class="dynamicForm">
            <div class="DVD">
                <div class="mb-3">
                    <label>Size (MB)</label>
                    <input type="text" name="Size" value = "<?php echo $Size?>">
                    <div><?php echo $errors["Size"]; ?></div>
                </div>
            </div>
            <div class="Furniture mb-3" id="Furni">
                    <label>Height (CM)</label>
                    <input type="text" name="Height" value = "<?php echo $Height?>">
                    <div><?php echo $errors["Height"]; ?></div>
                    <label>Width (CM)</label>
                    <input type="text" name="Width" value = "<?php echo $Width?>">
                    <div><?php echo $errors["Width"]; ?></div>
                    <label>Length (CM)</label>
                    <input type="text" name="Length" value = "<?php echo $Length?>">
                    <div><?php echo $errors["Length"]; ?></div><br>
                    <p>Please provide dimensions in HxWxL format.</p>


            </div>
            <div class="Book">
                <div class="mb-3">
                    <label>Weight (KG)</label>
                    <input type="text" name="Weight" value = "<?php echo $Weight?>">
                    <div><?php echo $errors["Weight"]; ?></div>
                </div>
            </div>
        </div>
        </form>
    </section> 
</div>
<div class="footer">
        <small><p>&copy; Copyright 2021, Edvard Nurk</p></small>
</div> 
<script> 
$(document).ready(function(){
    $("select.Type").change(function(){
        var selectedType = $(this).children("option:selected").val();
        if (selectedType == "Book"){
            $(".Book").show(1000);
            $(".DVD").hide(1000);
            $(".Furniture").hide(1000);
        }
        else if(selectedType == "DVD"){
            $(".DVD").show(1000);
            $(".Book").hide(1000);
            $(".Furniture").hide(1000);
        }
        else if(selectedType == "Furniture"){
            $(".Furniture").show(1200);
            $(".Book").hide(1000);
            $(".DVD").hide(1000);
        }
    });
});
</script>
</body>
</html>