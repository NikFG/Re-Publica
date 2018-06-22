<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        session_start();

        $servidor = "localhost";
        $user = "root";
        $senha = "";
        $banco = "dbrepublica";
        $nome;
       
       
        try {
            $conn = new PDO("mysql:host=$servidor;dbname=$banco", $user, $senha);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql ="select nome from tbpessoa where nome = '".$_POST["login"]."' and senha = '".$_POST["senha"]."'";
            $stmt = $conn->prepare($sql);
            $stmt->execute();

            $result = $stmt->setFetchMode(PDO::FETCH_NUM);
            $aux;
            if($stmt->rowCount() >0){
                $aux = 1;
                while ($row = $stmt->fetch()) {
                    $nome = $row[0];
                  
        
                 echo "Usuario conectado: ". $nome;
                 $_SESSION['logado'] = true;
                 header("refresh: 3;index.php");
            }
               // header("refresh: 2;login.php");
            }else{
                echo"Login Incorreto, digite novamente!";
            
        } }catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        } finally {
            $conn = null;
           
        }
       
      
      
      ?>
        <script>
        
        
        window.setTimeout("location.href='index.php'",100);
        
 

    </script>
       
    </body>
</html>
