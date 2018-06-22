<?php

	session_start();

	unset ($_SESSION['logado']);
	echo "Logout feito com sucesso!";
	header("refresh: 3;index.php");

?>