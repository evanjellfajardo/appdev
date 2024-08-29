<?php 
include 'pdo.php';
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>CRUD using PHP PDO and MySQL</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="row mt-3">
            <div class="col-sm-6 mx-auto">
                <nav aria-label="breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active" aria-current="page">Welcome <?php echo $_SESSION['username']; ?></li>
                        </ol>
                    </nav>
                </nav>
                <?php
                //sql statement para makuha lahat ng members sa database
                $sql = 'select * from products';

                //prepared statement natin
                $stmt = $con->prepare($sql);

                //execute na natin dito
                $stmt->execute();

                //fetchAll() function ay para makuha lahat
                $members = $stmt->fetchAll();
                //var_dump($members);exit;
                ?>
                <h2></h2>
                <table class="table table-bordered">
                	<thead>
                		<tr>
                			<td>ID</td>
                			<td>Name</td>
                			<td>Description</td>
                            <td>Price</td>
                            <td>Quantity</td>
                			<td>Action</td>
                		</tr>
                	</thead>
                	<tbody>
                		<!-- ito na yun loop para makuha ang list ng users. PDO::FETCH_ASSOC ang ginamit natin sa taas kaya associative array ang output ni variable members. so pwede natin gamitin si foreach loop -->
                		<?php foreach($products as $products): ?>
                			<tr>
                				<td><?php echo $products['id']; ?></td>
                				<td><?php echo $products['name']; ?></td>
                				<td><?php echo $products['description']; ?></td>
                                <td><?php echo $products['price']; ?></td>
                                <td><?php echo $products['quantity']; ?></td>
                				<!--yun dalawang link jan na mukhang button ay para sa update at delete.so sa bawat loop kinuha ko id kc un ang unique sa bawat records.-->
                				<td><a class="btn btn-info" role="button" href="update.php?id=<?php echo $member['id']; ?>">Update</a>&nbsp;<a class="btn btn-danger" role="button" href="delete.php?id=<?php echo $member['id']; ?>">Delete</a></td>
                			</tr>
                		<?php endforeach ?>
                	</tbody>
                </table>
                <a href="index.php" class="btn btn-primary" role="button">Add New</a>&nbsp;<a href="create.php" class="btn btn-primary" role="button">Logout</a>
            </div>
        </div>
    </div>
</body>
</html>