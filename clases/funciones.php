<?php
require('config/mysql.php');

class Logeo extends Mysql {

	public function Login($rut,$pass){

		$check = mysqli_query($this->conexion(), "SELECT * FROM users WHERE rut='".$rut."' and password=PASSWORD('".$pass."')");
		$row = mysqli_fetch_array($check,MYSQLI_ASSOC);

		if($row['status'] == 'Desabilitado') {
			return false;
			exit();
		}
		else {
		if($row['rut']) {
			$_SESSION['rut'] = $row['rut'];
			$_SESSION['nombre'] = $row['nombre'];
			$_SESSION['rol_usuario'] = $row['rol_usuario'];

			return true;
		}
		
		else
		{
			return false;
		}
	  }
   }
}

class Mantenedores extends Mysql {

		public function validar_rut($rut)
			{
			    $rut = preg_replace('/[^k0-9]/i', '', $rut);
			    $dv  = substr($rut, -1);
			    $numero = substr($rut, 0, strlen($rut)-1);
			    $i = 2;
			    $suma = 0;
			    foreach(array_reverse(str_split($numero)) as $v)
			    {
			        if($i==8)
			            $i = 2;
			        $suma += $v * $i;
			        ++$i;
			    }
			    $dvr = 11 - ($suma % 11);
			    
			    if($dvr == 11)
			        $dvr = 0;
			    if($dvr == 10)
			        $dvr = 'K';
			    if($dvr == strtoupper($dv))
			        return true;
			    else
			        return false;
			}

		public function scape($post) {

				return mysqli_real_escape_string($this->conexion(),$post);
		}

		public function get_name_rol($id_rol) {

				$find = mysqli_query($this->conexion(),"SELECT * FROM user_rol WHERE id_rol='".$id_rol."'");
				$row = mysqli_fetch_array($find,MYSQLI_ASSOC);

				if($row['id_rol'] == 1){

					$rol = '<span style="margin-top:5px;" class="label label-success col-md-10">'.$row['rol_name'].'</span>';
				}
				else if($row['id_rol'] == 2){

					$rol = '<span style="margin-top:5px;" class="label label-danger col-md-10">'.$row['rol_name'].'</span>';
				}
				else if($row['id_rol'] == 3){

					$rol = '<span style="margin-top:5px;" class="label label-warning col-md-10">'.$row['rol_name'].'</span>';
				}


				return $rol;
		}

		public function get_rol() {

			$find = mysqli_query($this->conexion(),"SELECT * FROM user_rol");
			while ($row = mysqli_fetch_array($find,MYSQLI_ASSOC)) {
				$option = $option.'<option value='.$row['id_rol'].'>'.$row['rol_name'].'</option>';
			}

			return $option;
		}

		public function user_exist($rut){

				$find = mysqli_query($this->conexion(),"SELECT nombre FROM users WHERE rut='".$rut."'");
				$row = mysqli_fetch_array($find,MYSQLI_ASSOC);
				if($row['nombre']){
					return true;
				}
				else
				{
					return false;
				}
		}

		public function add_user($rut,$nombre,$apellidop,$apellidom,$password,$fecha_nac,$email,$rol_usuario,$status) {

			$ins = mysqli_query($this->conexion(),"INSERT INTO users VALUES ('".$rut."','".$nombre."','".$apellidop."','".$apellidom."','".$fecha_nac."','".$email."',PASSWORD('".$password."'),'".$rol_usuario."','".$status."')");
			if($ins){
				return true;
			}
			else {
				return false;
			}
		}

		public function num_rows($table){

			$result = mysqli_query($this->conexion(),"SELECT * FROM ".$table." ");
			$total = $result->num_rows;

			return $total;
		}

		public function user_update($rut,$nombre,$apellidop,$apellidom,$password,$fecha_nac,$email,$rol_usuario,$status){
			$sql= mysqli_query($this->conexion(),"UPDATE users set rut='".$rut."',nombre='".$nombre."',apellido_paterno='".$apellidop."',apellido_materno='".$apellidom."', password=PASSWORD('".$password."'),fecha_nac='".$fecha_nac."',email='".$email."', rol_usuario='".$rol_usuario."',status='".$status."' WHERE rut='".$rut."' LIMIT 1");
			if($sql){
				return true;
			}
		}

		public function user_modify($status,$rut) {

			if($status == 1)
			{
				$status = 'Habilitado';
			}
			else
			{
				$status = 'Desabilitado';
			}

			$update = mysqli_query($this->conexion(), "UPDATE users set status = '".$status."' WHERE rut='".$rut."'");

			if($update) {
				return true;
			}
			else {
				return mysqli_error();
			}
			
		}

		public function status_name($status) {
			if($status == 'Habilitado'){
				$status = '<span style="margin-top:5px;" class="label label-success col-md-9">Habilitado</span>';
			}
			else {
				$status = '<span style="margin-top:5px;" class="label label-danger col-md-9">Desabilitado</span>';
			}
			return $status;
		}

		public function list_user($consulta) {

			$list = $consulta;

			while($row=mysqli_fetch_array($list,MYSQLI_ASSOC)){
				$result = $result.'<tr><td>'.$row['rut'].'</td>';
				$result = $result.'<td>'.$row['nombre'].'</td>';
				$result = $result.'<td>'.$row['password'].'</td>';
				$result = $result.'<td>'.$this->get_name_rol($row['rol_usuario']).'</td>';
				$result = $result.'<td>'.$this->status_name($row['status']).'</td>';
				$result = $result.'<td><a class="btn btn-warning btn-xs" href="index.php?s=moduser&user=edit&id='.$row['rut'].'"><span title="Editar" class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>&nbsp;<a class="btn btn-danger btn-xs" title="Desabilitar" href="index.php?s=moduser&action=down&id='.$row['rut'].'"><span class="glyphicon glyphicon-arrow-down" aria-hidden="true"></span></a>&nbsp;<a class="btn btn-success btn-xs" title="Habilitar" href="index.php?s=moduser&action=up&id='.$row['rut'].'"><span class="glyphicon glyphicon-arrow-up" aria-hidden="true"></span></a>&nbsp;<a class="btn btn-warning btn-xs" data-toggle="modal" data-target="#myModal" title="Ver Detalles" href="modal.php?id='.$row['rut'].'"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> Ver</a></td></tr>';
			}

			return $result;
		}
				

		public function search_user($rut) {
			
			$list = mysqli_query($this->conexion(),"SELECT * FROM users WHERE rut='".$rut."' LIMIT 1");
			
			while($row=mysqli_fetch_array($list,MYSQLI_ASSOC)){
				$result = $result.'<tr><td>'.$row['rut'].'</td>';
				$result = $result.'<td>'.$row['nombre'].'</td>';
				$result = $result.'<td>'.$row['password'].'</td>';
				$result = $result.'<td>'.$this->get_name_rol($row['rol_usuario']).'</td>';
				$result = $result.'<td>'.$this->status_name($row['status']).'</td>';
				$result = $result.'<td><a class="btn btn-warning btn-xs" href="index.php?s=moduser&user=edit&id='.$row['rut'].'"><span title="Editar" class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>&nbsp;<a class="btn btn-danger btn-xs" title="Desabilitar" href="index.php?s=moduser&action=down&id='.$row['rut'].'"><span class="glyphicon glyphicon-arrow-down" aria-hidden="true"></span></a>&nbsp;<a class="btn btn-success btn-xs" title="Habilitar" href="index.php?s=moduser&action=up&id='.$row['rut'].'"><span class="glyphicon glyphicon-arrow-up" aria-hidden="true"></span></a>&nbsp;<a class="btn btn-warning btn-xs" data-toggle="modal" data-target="#myModal" title="Ver Detalles" href="modal.php?id='.$row['rut'].'"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> Ver</a></td></tr>';
			}

			return $result;
		}

		public function list_areas() {
			$list = mysqli_query($this->conexion(),"SELECT * FROM area");
			while($rs=mysqli_fetch_array($list,MYSQLI_ASSOC)){
				$result = $result.'<tr><td>'.$rs['id_area'].'</td>';
				$result = $result.'<td>'.$rs['nombre_area'].'</td>';
				$result = $result.'<td>'.$this->status_name($rs['area_status']).'</td>';
				$result = $result.'<td><a href="index.php?s=modarea&action=edit&id='.$rs['id_area'].'" class="btn btn-warning btn-xs"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Editar</a>&nbsp;<a href="index.php?s=modarea&action=down&id='.$rs['id_area'].'" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-arrow-down" aria-hidden="true"></span> Dar de baja</a>&nbsp;<a href="index.php?s=modarea&action=up&id='.$rs['id_area'].'" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-arrow-up" aria-hidden="true"></span> Dar de alta</a></td>';
			}
			return $result;
		}

		public function add_area($nombreArea) {
				$insert = mysqli_query($this->conexion(),"INSERT INTO area (nombre_area) VALUES('".$nombreArea."')");
				if($insert){
					return true;
				}
		}

		public function area_status($id_area,$action){
			if($action == 'down'){
				$status = 'Desabilitado';
			}
			else if($action == 'up'){
				$status = 'Habilitado';
			}
			$update = mysqli_query($this->conexion(),"UPDATE area set area_status='".$status."' WHERE id_area='".$id_area."' LIMIT 1");
			if($update){
				return true;
			}
		}

		public function update_area_name($id_area,$name_area) {
			$update = mysqli_query($this->conexion(),"UPDATE area set nombre_area='".$name_area."' WHERE id_area='".$id_area."' LIMIT 1");
			if($update) {
				return true;
			}
		}

		public function get_areas() {
			$sql = mysqli_query($this->conexion(), "SELECT * FROM area WHERE area_status ='Habilitado'");
			
			while($row = mysqli_fetch_array($sql,MYSQLI_ASSOC)) {
				$result = $result.'<option value="'.$row['id_area'].'">'.$row['nombre_area'].'</option>';
			}

			return $result;
		}

		public function get_maquinas() {
			$sql = mysqli_query($this->conexion(), "SELECT * FROM maquina INNER JOIN area ON maquina.codigo_area=area.id_area");
			while($rs=mysqli_fetch_array($sql,MYSQLI_ASSOC)){
				$result = $result.'<tr><td>1</td>';
				$result = $result.'<td>'.$rs['nombre_area'].'</td>';
				$result = $result.'<td>'.$rs['nombre_maquina'].'</td>';
				$result = $result.'<td>'.$this->status_name($rs['maquina_status']).'</td>';
				$result = $result.'<td><a href="index.php?s=modmaquina&action=edit&id='.$rs['id_maquina'].'" class="btn btn-warning btn-xs"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Editar</a>&nbsp;<a href="index.php?s=modmaquina&action=down&id='.$rs['id_maquina'].'" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-arrow-down" aria-hidden="true"></span> Dar de baja</a>&nbsp;<a href="index.php?s=modmaquina&action=up&id='.$rs['id_maquina'].'" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-arrow-up" aria-hidden="true"></span> Dar de alta</a></td>';

			}

			return $result;
		}

		public function add_maquina($name,$areaId) {
			$insert = mysqli_query($this->conexion() ,"INSERT INTO maquina (codigo_area,nombre_maquina) VALUES ('".$areaId."','".$name."')");
			if($insert) {
				return true;
			}
		}

		public function set_status($table,$status,$columna,$id){
			if($status == 'down'){
				$status = 'Desabilitado';
			}
			else if($status == 'up'){
				$status = 'Habilitado';
			}
			$update = mysqli_query($this->conexion(),"UPDATE maquina set maquina_status='".$status."' WHERE id_maquina='".$id."' LIMIT 1");
			if($update){
				return true;
			}
			else {
				return mysqli_error();
			}
		}

		public function update_maquina($idarea,$id,$NombreMaquina) {
			$status = 'Habilitado';
			$insert = mysqli_query($this->conexion() ,"UPDATE maquina SET codigo_area='".$idarea."', nombre_maquina='".$NombreMaquina."' WHERE id_maquina='".$id."' LIMIT 1");
			if($insert) {
				return true;
			}
		}

}


?>