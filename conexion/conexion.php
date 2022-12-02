<?php
session_start();
class Database{
	
	private $host  = 'localhost';
    private $user  = 'root';
    private $password   = "";
    private $database  = "Proyecto_U1"; 
    
    public function getConnection(){		
		$conn = new mysqli($this->host, $this->user, $this->password, $this->database);
		if($conn->connect_error){
			die("Error al conectar con MySQL: " . $conn->connect_error);
		} else {
			return $conn;
		}
    }
}
?>