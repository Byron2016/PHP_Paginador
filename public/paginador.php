<?php

/**
* 
*/
class paginador 
{
	private $_datos; //registros devueltos
	private $_paginacion; //datos de la paginacion
	protected $_db;

	public function __construct() {
		$this->_datos = array();
		$this->_paginacion = array();
		$this->_db = new Database();
		//echo 'fin pag';
	}

	public function paginar($query, $pagina = false, $limite = false)
	{
		if($limite && is_numeric($limite))
		{
			$limite = $limite;
		} else {
			$limite = 10;
		}

		if($limite && is_numeric($pagina))
		{
			$pagina = $pagina;
			$inicio = ($pagina -1) * $limite;
		} else {
			$pagina = 1;
			$inicio = 0;
		}

		//$consulta = mysql_query($query, Db::Connect());
		//echo $query;
		$post = $this->_db->query($query)->fetchAll();

		//$consulta = $this->_db->query($query);
		//$registros = mysql_num_rows($consulta);
		$registros = Count($post);
		//echo $registros;
		$total = ceil($registros / $limite);
		$query = $query . ' LIMIT ' . $inicio . ','.  $limite;
		//echo $query;
		//echo ' valores: ' . $limite .' ' . $inicio;
		//$consulta = mysql_query($query, Db::Connect());

		$consulta = $this->_db->query($query);
		/*

		while($regs = mysql_fetch_assocc($consulta)){
			$this->_datos[] = $regs;
		}

$stmt = $db->query(...);
while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {


		*/

		if(!$consulta)
		{
  				die("Execute query error, because: ". print_r($this->_db->errorInfo()) );
		}
		//success case
		else{
     		//continue flow
     		while($regs = $consulta->fetch()){
					$this->_datos[] = $regs;
			}
		}

		//echo 'aaa';

		

		$paginacion = array();
		$paginacion['actual'] = $pagina;
		$paginacion['total'] = $total;

		if($pagina > 1){
			$paginacion['primero'] = 1;
			$paginacion['anterior'] = $pagina - 1;
		} else {
			$paginacion['primero'] = '';
			$paginacion['anterior'] = '';
		}

		if($pagina < $total){
			$paginacion['ultimo'] = $total;
			$paginacion['siguiente'] = $pagina + 1;
		} else {
			$paginacion['ultimo'] = '';
			$paginacion['siguiente'] = '';
		}		

		$this->_paginacion = $paginacion;

		return $this->_datos;

	}

	public function getPaginacion()
	{
		if($this->_paginacion){
			return $this->_paginacion;
		} else {
			return false;
		}
		
	}


}