<?php 
include_once 'config/Database.php';
include_once 'class/Clientes.php';

$database = new Database();
$db = $database->getConnection();

$customer = new Customer($db);

if($customer->loggedIn()) {	
	header("Location: index.php");	
}

$loginMessage = '';
if($_SERVER['REQUEST_METHOD'] == 'POST'):
if(!empty($_POST["login"]) && !empty($_POST["email"]) && !empty($_POST["password"])) {	
	$customer->email = $_POST["email"];
	$customer->password = $_POST["password"];	
	if($customer->login()) {
		header("Location: index.php");	
	} else {
		$loginMessage = 'Revise su Email o Contraseña';
	}
} else {
	$loginMessage = 'No se encuentra registrado';
}
endif;
include('vista/header4.php');
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
<style>
html,
body,
body>.container {
    height: 100%;
    width: 100%;
    background-color:rgb(177, 245, 236);
    background-image:url(images/fondo.jpg);
    background-repeat: repeat;
}

</style>
<div id= "t" class="content h-100 d-flex w-100 justify-content-center align-items-center">
    <div class="col-lg-4 col-md-5 col-sm-10 col-xs-12">
        <div class="card card-info rounded-0">
            <div id="s" class="card-header">
                <div class="card-title h4 mb-0 fw-bold text-center">Inicio de sesion del Cliente</div>
            </div>
            <div style="" class="card-body">
                <?php if ($loginMessage != '') { ?>
                <div id="login-alert" class="alert alert-danger col-sm-12 rounded-0 py-1"><?php echo $loginMessage; ?></div>
                <?php } ?>
				<?php if (isset($_SESSION['success'])) { ?>
                <div id="login-alert" class="alert alert-success col-sm-12 rounded-0 py-1"><?php echo $_SESSION['success']; ?></div>
                <?php 
					unset($_SESSION['success']);
					} 
				?>
                <form id="loginform" class="form-horizontal" role="form" method="POST" action="">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" id="email" name="email"
                            value="<?php if(!empty($_POST["email"])) { echo $_POST["email"]; } ?>" placeholder="Email" required>
                        <span class="input-group-text"><i class="fa fa-user"></i></span>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" id="password" name="password"
                            value="<?php if(!empty($_POST["password"])) { echo $_POST["password"]; } ?>" placeholder="Contraseña" required>
                        <span class="input-group-text"><i class="fa fa-lock"></i></span>
                    </div>
                    <div class="text-center">
                        <div class="col-sm-12 controls">
                            <input id="a" type="submit" name="login" value="Acceder" class="btn btn-primary rounded-0">
                            <a id="a" href="./register.php" class="btn btn-light bg-gradient border rounded-0">Registrarse</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include('vista/footer.php');?>  
</body>
</html>