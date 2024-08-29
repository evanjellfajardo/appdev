<?php 
include 'pdo.php';
session_start();


$ID = $Name = $Description = $Price = "";
$ID_err = $ProductName_err = $Description_err = $Price_err= $Quantity_err=  "";
 
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $input_ID = trim($_POST["ID"]);
    if(empty($input_ID)){
        $ID_err = "Enter the ID.";
    } else{
        $ID = $input_ID;
    }
    
    $input_ProductName = trim($_POST["Name"]);
    if(empty($input_ProductName)){
        $ProductName_err = "Please enter the product name.";     
    } else{
        $ProductName= $input_Name;
    }
    
    $input_Description = trim($_POST["Description"]);
    if(empty($input_Description)){
        $Description_err = "Please enter the description of the product.";     
    } else{
        $Description = $input_Description;
    }
    
    $input_Price = trim($_POST["Price"]);
    if(empty($input_Price)){
        $Price_err = "Please enter the price.";     
    } else{
        $Price = $input_Price;
    }

    $input_Price = trim($_POST["Quantity"]);
    if(empty($input_Price)){
        $Price_err = "Please enter the quantity.";     
    } else{
        $Price = $input_Quantity;
    }

    if(empty($ID_err) && empty($ProductName_err) && empty($Description_err) && empty($Price_err)){
        $sql = "INSERT INTO Products (ID, Name, Description, Price, Quantity) VALUES (?, ?, ?, ?, ?)";
 
        if($stmt = $mysqli->prepare($sql)){
            $stmt->bind_param("sssd", $param_ID, $param_Name, $param_Description, $param_Price, $param_Quantity);
            
            $param_ID = $ID;
            $param_ProductName= $ProductName;
            $param_Description = $Description;
            $param_Price = $Price;
            $param_Price = $Quantity;

            if($stmt->execute()){
                header("location: index.php");
                exit();
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
            $stmt->close(); 
        } else {
            
            echo "Error: " . $mysqli->error;
        }
    }
    
    $mysqli->close();
}
?>

</head>
<body>
<div class="overlay"></div>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5">Create Record</h2>
                    <p>Please fill this form and submit to add record to the database.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="form-group">
                        <label for="ID">ID:</label>
                        <input type="number" class="form-control" name="ID" required>
                    </div>
                    <div class="form-group">
                        <label for="Name">Name:</label>
                        <input type="text" class="form-control" name="Name" required>
                    </div>
                    <div class="form-group">
                        <label for="Description">Description:</label>
                        <input type="text" class="form-control" name="Description" required>
                    </div>
                    <div class="form-group">
                        <label for="Price">Price:</label>
                        <input type="float" class="form-control" name="Price" required>
                    </div>

                    <div class="form-group">
                        <label for="Quantity">Quantity:</label>
                        <input type="text" class="form-control" name="Quantity" required>
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
