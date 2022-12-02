<?php 
include_once 'config/Database.php';
include_once 'class/Clientes.php';

$database = new Database();
$db = $database->getConnection();

$customer = new Customer($db);

if(!$customer->loggedIn()) {	
	header("Location: login.php");	
}
include('vista/header.php');
?>
<title>Orden</title>
  <link rel="stylesheet" type = "text/css" href ="css/foods.css">

<div class="content">
	<div class="container-fluid">		
		
		
		
		<div class="my-3">
			<div class="card rounded-0 shadow">
				<div class="card-body">
					<div class="container-fluid">
						<?php
						$orderTotal = 0;
						foreach($_SESSION["cart"] as $keys => $values){
							$total = ($values["item_quantity"] * $values["item_price"]);
							$orderTotal = $orderTotal + $total;
						}
						?>
						<div class='row'>
							<div class="col-md-6 lh-1">
								<h3>Datos del usuario:</h3>
								<?php 
								$addressResult = $customer->getAddress();
								$count=0;
								while ($address = $addressResult->fetch_assoc()) { 
								?>

								<table class="table">
								<thead>
									<tr>
									<th scope="col"></th>
									<th scope="col">Direccion</th>
									<th scope="col">Telefono</th>
									<th scope="col">Email</th>
									</tr>
								</thead>
								<tbody class="table-group-divider">
									<tr>
									<th scope="row"></th>
									<td><p class="mb-1"><?php echo $address["address"]; ?></p></td>
									<td><p class="mb-1"><strong></strong><?php echo $address["phone"]; ?></p></td>
									<td><p class="mb-1"><strong></strong><?php echo $address["email"]; ?></p></td>
									</tr>

								</tbody>
								</table>
							
								<?php
								}
								?>				
							</div>
							<?php 

							$randNumber1 = rand(100000,999999); 
							$randNumber2 = rand(100000,999999); 
							$randNumber3 = rand(100000,999999);
							$orderNumber = $randNumber1.$randNumber2.$randNumber3;
							?>
							<div class="col-md-6 lh-1">
								<h3>Detalle de compra</h3>
								<table class="table">
								<thead>
									<tr>
									<th scope="col"></th>
									<th scope="col">Total productos</th>
									<th scope="col">Valor a cancelar</th>
									</tr>
								</thead>
								<tbody class="table-group-divider">
									<tr>
									<th scope="row"></th>
									<td><p class="mb-1"><strong></strong>$<?php echo $orderTotal; ?></td>
									<td><p class="mb-1"><strong></strong>$<?php echo $orderTotal; ?></td>
									</tr>
								</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
				<div class="card-footer py-1">
					<div class="row justify-content-center">
						<div class="col-lg-3 col-md-4 col-sm-12 col-xs-12">
							<div class="d-grid">
								<a href="process_order.php?order=<?php echo $orderNumber;?>"  class="btn btn-warning rounded-0">Confirmar orden</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		   
    </div>        
		
<?php include('vista/footer.php');?>
