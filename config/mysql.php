<?php

class Mysql {

	private $host = "localhost";
	private $user = "root";
	private $pass = "123456";
	private $db	  = "tesis";

	public function conexion() {

			$mysqli = new mysqli($this->host, $this->user, $this->pass, $this->db);

			$mysqli->set_charset("utf8");

			if($mysqli) {
				return $mysqli;
			}
			else {
				return;
		   }
	 }

}

?>