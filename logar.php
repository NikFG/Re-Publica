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
                while ($row = $stmt->fetch()) {
                    $nome = $row[0];
                  
                }
            
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        } finally {
            $conn = null;
           
        }
        echo "Usuario conectado:". $nome;
      
      
      ?>
        <script>
        
        
        window.setTimeout("location.href='index.html'",10000);
 

    </script>
       
    </body>
</html>
