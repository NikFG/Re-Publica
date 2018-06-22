	<?php 

            session_start();
            /*Condição para retirar a session*/
            echo $_SESSION['logado'];
            if(!isset($_SESSION['logado'])){
                header('location:login.php');
                }


            /*Condição para manter a sessão e redirecionar para a página real de anunciar.php*/    
            else{     
            header('location:anunciar.php');
        	}
    ?>