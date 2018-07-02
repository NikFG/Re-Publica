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
        try {
            $conn = new PDO("mysql:host=$servidor;dbname=$banco", $user, $senha);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "insert into tbpessoa(nome,senha,cpf,email) VALUES ( '" . $_POST["nome"] .
                    "', '" . $_POST["senha"] .
                    "', '" . $_POST["cpf"] .
                    "', '" . $_POST["email"] . "')";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        } finally {
            $conn = null;
           
        }
        ?>
    </body>
    <script>
        
        
        window.setTimeout("location.href='index.php'",500);
 

    </script>
</html>
