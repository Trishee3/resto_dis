<?php

     class Database {
     	private $server_name = "localhost";
     	private $db_username = "root";
     	private $db_password = "";
     	private $db_name = "sales_oop";
     	protected $conn;

     	public function __construct(){

     		$this->conn = new mysqli($this->server_name, $this->db_username, $this->db_password, $this->db_name);

            if ($this->conn->connect_error){
            	die("Usable to connect to Database" .$this->db_name . " : ". 4this->conn->connect_error);
          }
     }    
}    