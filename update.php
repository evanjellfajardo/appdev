<?php
require_once "connection.php";
 
$ID = $ProductName = $Description = $Price = "";
$ID_err = $ProductName_err = $Description_err = $Price_err = $Quantity_err = "";
 
if(isset($_POST["ID"]) && !empty($_POST["ID"])){
    $ID = $_POST["ID"];
    
    $input_ProductName = trim($_POST["ProductName"]);
    if(empty($input_Name)){
        $ProductName_err = "Enter new product name.";
    } else{
        $ProductName = $input_Name;
    }
    
    $input_Description = trim($_POST["Description"]);
    if(empty($input_Description)){
        $Description_err = "Enter the new description.";     
    } else{
        $Description = $input_Description;
    }
    
    $input_Price = trim($_POST["Price"]);
    if(empty($input_Price)){
        $Price_err = "Enter the new price.";     
    } else{
        $Price = $input_Price;
    }

    $input_Price = trim($_POST["Quantity"]);
    if(empty($input_Price)){
        $Price_err = "Enter the new quantity.";     
    } else{
        $Price = $input_Quantity;
    }
    
    if(empty($ProductName_err) && empty($Description_err) && empty($Price_err)){
        $sql = "UPDATE Products SET ProductName=?, Description=?, Price=?, =? WHERE ID=?";
 
        if($stmt = $mysqli->prepare($sql)){
            $stmt->bind_param("sssi", $param_ProductName, $param_Description, $param_Price, $param_Quantity, $param_ID);
            
            $param_ProductName= $ProductName;
            $param_Description = $Description;
            $param_Price = $Price;
            $param_Quantity = $Quantity;
            $param_ID = $ID;
            
            if($stmt->execute()){
                header("location: index.php");
                exit();
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
            $stmt->close();
        }
    }
} else{
    if(isset($_GET["ID"]) && !empty(trim($_GET["ID"]))){
        $ID =  trim($_GET["ID"]);
        
        $sql = "SELECT * FROM Products WHERE ID = ?";
        if($stmt = $mysqli->prepare($sql)){
            $stmt->bind_param("i", $param_ID);
            
            $param_ID = $ID;
            
            if($stmt->execute()){
                $result = $stmt->get_result();
                
                if($result->num_rows == 1){
                    $row = $result->fetch_array(MYSQLI_ASSOC);
                  
                    $ProductName = $row['ProductName'];
                    $Description = $row['Description'];
                    $Price = $row['Price'];
                } else{
                    header("location: error.php");
                    exit();
                }
                
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        
        $stmt->close();
    }  else{
        header("location: error.php");
        exit();
    }
}

$mysqli->close();
?>

 </head>
<body>
<div class="overlay"></div>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5">Update Record</h2>
                    <p>Please edit the input values and submit to update the product record.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                    <div class="form-group">
                            <label for="ID">ID:</label>
                            <input type="number" class="form-control" name="ID" value="<?php echo htmlspecialchars($ID); ?>" required>
                        </div> 
                    
                    <div class="form-group">
                            <label for="Name">Name:</label>
                            <input type="text" class="form-control" name="ProductName" value="<?php echo htmlspecialchars($Name); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="Description">Description:</label>
                            <input type="text" class="form-control" name="Description" value="<?php echo htmlspecialchars($Description); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="Price">Price:</label>
                            <input type="float" class="form-control" name="Price" value="<?php echo htmlspecialchars($Price); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="Price">Quantity:</label>
                            <input type="text" class="form-control" name="Quantity" value="<?php echo htmlspecialchars($Price); ?>" required>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>
