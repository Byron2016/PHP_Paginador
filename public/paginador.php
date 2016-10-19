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
		echo 'valor de pagina: ' . $pagina;
		if($limite && is_numeric($limite))
		{
			$limite = $limite;
		} else {
			$limite = 10;
		}

		if($pagina && is_numeric($pagina))
		{
			//echo 'esta en pagina asignacion';
			$pagina = $pagina;
			$inicio = ($pagina -1) * $limite;
		} else {
			echo 'esta en pagina asignacion else';
			$pagina = 1;
			$inicio = 0;
		}

		//$consulta = mysql_query($query, Db::Connect());
		echo $query.'<br>';
		$post = $this->_db->query($query)->fetchAll();

		//$consulta = $this->_db->query($query);
		//$registros = mysql_num_rows($consulta);
		$registros = Count($post);
		//echo $registros;
		$total = ceil($registros / $limite);
		$query = $query . ' LIMIT ' . $inicio . ','.  $limite;
		echo ' 2: ' . $query.'<br>';
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
     		while($regs = $consulta->fetchAll()){
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

	public function getRangoPaginacion($limite = false)
	{
		if($limite && is_numeric($limite))
		{
			$limite = $limite;
		} else {
			$limite = 10;
		}

		$total_paginas = $this->_paginacion['total'];
		$pagina_seleccionada = $this->_paginacion['actual'];
		$rango = ceil($limite / 2);
		$paginas = array();

		$rango_derecho = $total_paginas - $pagina_seleccionada;
		
		if($rango_derecho < $rango)
		{
			$resto = $rango - $rango_derecho;
		} else {
			$resto = 0;
		}

		$rango_izquierdo = $pagina_seleccionada	- ($rango + $resto);

		//echo 'rango_derecho: '. $rango_derecho . ' rango ' . $rango . ' total_paginas ' . $total_paginas . ' pagina_seleccionada ' . $pagina_seleccionada . ' resto ' . $resto . ' rango_izquierdo ' . $rango_izquierdo;

		for ($i = $pagina_seleccionada; $i > $rango_izquierdo; $i--) { 
			if ($i == 0) {
				break;
			}
			$paginas[] = $i;
		}

		sort($paginas);

		if($pagina_seleccionada < $rango){
			$rango_derecho = $limite;

		} else {
			$rango_derecho = $pagina_seleccionada + $rango;
		}

		for($i = $pagina_seleccionada + 1; $i <= $rango_derecho; $i++){
			if($i > $total_paginas)
			{
				break;
			}
			$paginas[] = $i;
		}

		$this->_paginacion['rango'] = $paginas;
		return $this->_paginacion;

	}

	public function getPaginacion()
	{
		echo 'entro';
		if($this->_paginacion){
			echo 'en ';
			return $this->_paginacion;
		} else {
			//echo 'en false';
			return false;
		}
		
	}


}