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
        $idbairro;
        $idlogradouro;
        $idrep;
        $imagem = $_FILES['upload']['tmp_name'];
        $tamanho = $_FILES['upload']['size'];
        $fp = fopen($imagem, "rb");
        $conteudo = fread($fp, $tamanho);
        $conteudo = addslashes($conteudo);
        fclose($fp);
        
        
        $imagem = $_FILES['uploadi']['tmp_name'];
        $tamanho = $_FILES['uploadi']['size'];
        $fp = fopen($imagem, "rb");
        $conteudoo = fread($fp, $tamanho);
        $conteudoo = addslashes($conteudoo);
        fclose($fp);
        
        
        $imagem = $_FILES['uploadie']['tmp_name'];
        $tamanho = $_FILES['uploadie']['size'];
        $fp = fopen($imagem, "rb");
        $conteudooo = fread($fp, $tamanho);
        $conteudooo = addslashes($conteudooo);
        fclose($fp);
        
        
         try {
          $conn = new PDO("mysql:host=$servidor;dbname=$banco", $user, $senha);
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $sql = "insert into bairro (nomeBairro,Municipio_idMunicipio) VALUES ('" . $_POST["bairro"] . "' ,"
          . "1)";

          $stmt = $conn->prepare($sql);
          $stmt->execute();

          $sql = "select idBairro from bairro where nomeBairro='" . $_POST["bairro"] . "'";
          $stmt = $conn->prepare($sql);
          $stmt->execute();
          $result = $stmt->setFetchMode(PDO::FETCH_NUM);
          while ($row = $stmt->fetch()) {
          $idbairro = $row[0];
          }
          $sql = "insert into logradouro (nomeLogradouro,Bairro_idBairro) VALUES ('" . $_POST["endereco"] . "' ,"
          . "'" . $idbairro . "')";
          $stmt = $conn->prepare($sql);
          $stmt->execute();
          $sql = "select idLogradouro from logradouro where nomeLogradouro='" . $_POST["endereco"] . "'";
          $stmt = $conn->prepare($sql);
          $stmt->execute();
          $result = $stmt->setFetchMode(PDO::FETCH_NUM);
          while ($row = $stmt->fetch()) {
          $idlogradouro = $row[0];
          }
          $sql = "insert into tbrepublica(nomeRepublica,numeroRepublica,numQuartosRepublica,descricaoRepublica,"
          . "precoRepublica,zipzaporungaRepublica,idPessoa,Logradouro_idLogradouro,sexo) VALUES"
          . "('" . $_POST["name"] . "','" . $_POST["numero"] . "','" . $_POST["numquartos"] . "','"
          . "" . $_POST["descricao"] . "','" . $_POST["preco"] . "','" . $_POST["phone"] . "',1,'"
          . "" . $idlogradouro . "','" . $_POST["sexo"] . "')";



          $stmt = $conn->prepare($sql);
          $stmt->execute();

          $sql = "select idRepublica from tbrepublica where nomeRepublica='" . $_POST["name"] . "'";
          $stmt = $conn->prepare($sql);
          $stmt->execute();
          $result = $stmt->setFetchMode(PDO::FETCH_NUM);
          while ($row = $stmt->fetch()) {
          $idrep = $row[0];
          }

          $sql = "insert into tbimagemrepublica(imagemRepublica,TbRepublica_idRepublica,imagemPrincipal) VALUES"
          . "('" .$conteudo . "','" . $idrep . "',1)";



          $stmt = $conn->prepare($sql);
          $stmt->execute();
          
          $sql = "insert into tbimagemrepublica(imagemRepublica,TbRepublica_idRepublica,imagemPrincipal) VALUES"
          . "('" .$conteudoo . "','" . $idrep . "',0)";
          $stmt = $conn->prepare($sql);
          $stmt->execute();
          
          $sql = "insert into tbimagemrepublica(imagemRepublica,TbRepublica_idRepublica,imagemPrincipal) VALUES"
          . "('" .$conteudooo . "','" . $idrep . "',0)";
          $stmt = $conn->prepare($sql);
          $stmt->execute();
          
          
          
          
          
          } catch (PDOException $e) {
          echo "Error: " . $e->getMessage();
          } finally {
          $conn = null;
          } 
        ?>
        <script>
        
        
        window.setTimeout("location.href='index.html'",500);
 

    </script>
    </body>
     
</html>
