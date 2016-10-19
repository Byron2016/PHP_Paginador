
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
		print_r(get_required_files());
		$_db = new Db();
	for($i=0; $i<=55; $i++){
		//mysql_query("insert into usaurios values(null, 'aa$i', 'cc$i')", Db::connect());
		$query = "insert into posts values(null, 'aa$i', 'cc$i')";
		echo $query . '<br>';
		//$consulta = $this->_db->query($query);
		$_db->query($query);
	}

	*/
	$paginador = new Paginador();
	$pagina =$_GET['pagina'];
	print_r($paginador->paginar("select * from posts",$pagina));
	$params = $paginador->getPaginacion();
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
					<?php for($i=1; $i<=$params['total']; $i++): ?>
						<?php if($params['actual'] != $i): ?>
						<a href="?pagina=<?php echo $i; ?>"><?php echo $i; ?>
						</a>
					<?php else: ?>
						<?php echo $i; ?>

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