
<?php
	require_once 'config.php';
	require_once 'DataBase.php';
	require_once 'paginador.php';

?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<pre>
	<?php
	//echo "\n".'$_GET'."\n"; var_dump($_GET);
	//echo "\n".'$_GET_1:'."\n"; var_dump($_GET['pagina']);

	
/*
//para insertar registros
$_db = new Database();
	for($i=0; $i<=550; $i++){
		//mysql_query("insert into usaurios values(null, 'aa$i', 'cc$i')", Db::connect());
		$query = "insert into posts values(null, 'aa$i', 'cc$i')";
		echo $query . '<br>';
		//$consulta = $this->_db->query($query);
		$_db->query($query);
	}

exit;
*/

	$paginador = new Paginador();
	$pagina =$_GET['pagina'];
	print_r($paginador->paginar("select * from posts",$pagina));
	$params = $paginador->getRangoPaginacion();
	print_r($paginador->getPaginacion());



?>

	</pre>
	<ul>	
			<li style='display: inline; margin-right: 	5px'>	
					<?php if($params['primero']): ?>
						<a href="?pagina=<?php echo $params['primero']; ?>">Primero
						</a>
					<?php else: ?>
						Primero
					<?php endif;?>

			</li>
			<li style='display: inline; margin-right: 	5px'>	
					<?php if($params['anterior']): ?>
						<a href="?pagina=<?php echo $params['anterior']; ?>">Anterior
						</a>
					<?php else: ?>
						Anterior
					<?php endif;?>

			</li>
			<li style='display: inline; margin-right: 	5px'>	
					<?php for($i = 0; $i < count($params['rango']); $i++): ?>
						<?php if($params['actual'] != $params['rango'][$i]): ?>
						<a href="?pagina=<?php echo $params['rango'][$i]; ?>"><?php echo $params['rango'][$i]; ?>
						</a>
					<?php else: ?>
						<?php echo $params['rango'][$i]; ?>

					<?php endif;?>
					<?php endfor;?>

			</li>
			<li style='display: inline; margin-right: 	5px'>	
					<?php if($params['siguiente']): ?>
						<a href="?pagina=<?php echo $params['siguiente']; ?>">Siguiente
						</a>
					<?php else: ?>
						Siguiente
					<?php endif;?>

			</li>
			<li style='display: inline; margin-right: 	5px'>	
					<?php if($params['ultimo']): ?>
						<a href="?pagina=<?php echo $params['ultimo']; ?>">Ultimo
						</a>
					<?php else: ?>
						Ultimo
					<?php endif;?>

			</li>
	</ul>
	
	
	
</body>
</html>