<?php
if (isset($_SESSION["name"])) {
  ?>
  <!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/foods.css">
    <title>Document</title>
  </head>
  <body>
    

<nav class="navbar navbar-expand-lg navbar-expand-md navbar-dark bg-gradient bg-dark" style="margin-top:5px; border-radius:800px ;">
    <div class="container-fluid" style="margin-top:5px;">
        <a class="navbar-brand text-light text-center bg-gradient bg-light bg-opacity-25 rounded-pill px-4"
            href="./"><span class="fa fa-user"></span> <B>Bienvenido</B> <?php echo $_SESSION["name"]; ?></a>
        
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="index.php"><span class="fa fa-cutlery"></span>
                        Foods</a></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./cart.php"><span class="fa fa-shopping-cart"></span> Cart (<?php
						if(isset($_SESSION["cart"])){
						$count = count($_SESSION["cart"]); 
						echo "$count"; 
							}
						else
							echo "0";
						?>)
						</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./logout.php"><i class="fa fa-sign-out-alt"></i> Log Out</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
</body>
  </html>
<?php        
}
?>