
<?php
	require_once 'config.php';
	require_once 'db.php';
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
		print_r(get_required_files());
		$_db = new Db();

	

	for($i=0; $i<=55; $i++){
		//mysql_query("insert into usaurios values(null, 'aa$i', 'cc$i')", Db::connect());
		$query = "insert into posts values(null, 'aa$i', 'cc$i')";
		echo $query . '<br>';
		//$consulta = $this->_db->query($query);
		$_db->query($query);
	}
	?>
	
	
	</pre>
	
</body>
</html>