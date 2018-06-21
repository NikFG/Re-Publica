	<?php 

            session_start();
            if((!isset ($_SESSION['login']) == true) and (!isset ($_SESSION['senha']) == true))
            {
                unset($_SESSION['login']);
                unset($_SESSION['senha']);
                header('location:login.php');
                }
            else{ 
            $logado = $_SESSION['login'];
            header('location:anunciar.php');
        	}
    ?>