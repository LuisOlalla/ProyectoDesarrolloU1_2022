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
if(!empty($_POST["create"])) {	
	$customer->name = $_POST["name"];
	$customer->email = $_POST["email"];
	$customer->password = $_POST["password"];	
	$customer->phone = $_POST["phone"];
	$customer->address = $_POST["address"];	
	if($customer->register()) {
        $_SESSION['success'] = "Se ha creado la cuenta";
		header("Location: login.php");	
	} else {
		$loginMessage = 'Revise su Email o Contraseña';
	}
}
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
<div class="content h-100 d-flex w-100 justify-content-center align-items-center">
    <div class="col-lg-4 col-md-5 col-sm-10 col-xs-12">
        <div class="card card-info rounded-0">
            <div id="t" class="card-header">
                <div class="card-title h4 mb-0 fw-bold text-center">Registrarse</div>
            </div>
            <div style="" class="card-body">
                <?php if ($loginMessage != '') { ?>
                <div id="login-alert" class="alert alert-danger col-sm-12 rounded-0 py-1"><?php echo $loginMessage; ?></div>
                <?php } ?>
                <form id="loginform" class="form-horizontal" role="form" method="POST" action="">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" id="name" name="name"
                            value="<?php if(!empty($_POST["name"])) { echo $_POST["name"]; } ?>" placeholder="Nombre completo" required>
                        <span class="input-group-text"><i class="fa fa-user"></i></span>
                    </div>
                    <div class="input-group mb-3">
                        <input type="number" class="form-control" id="phone" name="phone"
                            value="<?php if(!empty($_POST["phone"])) { echo $_POST["phone"]; } ?>" placeholder="Numero de telefono" required
                            maxlength="10" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
                        <span class="input-group-text"><i class="fa fa-phone"></i></span>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" id="address" name="address"
                            value="<?php if(!empty($_POST["address"])) { echo $_POST["address"]; } ?>" placeholder="Dirección" required>
                        <span class="input-group-text"><i class="fa fa-map-marker-alt"></i></span>
                    </div>
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" id="email" name="email"
                            value="<?php if(!empty($_POST["email"])) { echo $_POST["email"]; } ?>" placeholder="Email" required>
                        <span class="input-group-text"><i class="fa fa-at"></i></span>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" id="password" name="password"
                            value="<?php if(!empty($_POST["password"])) { echo $_POST["password"]; } ?>" placeholder="Contraseña" required>
                        <span class="input-group-text"><i class="fa fa-lock"></i></span>
                    </div>
                    <div class="text-center">
                        <div class="col-sm-12 controls">
                            <input id="a" type="submit" name="create" value="Crear cuenta" class="btn btn-primary rounded-0">
                        </div>
                    </div>
                    <div class="text-center">
                    <a href="./login.php" class="text-decoration-none">Ya tienes una cuenta?</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include('vista/footer.php');?>
</body>
</html>