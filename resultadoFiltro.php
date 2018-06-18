<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="content-type" content="txt/html"; charset="utf-8">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="js/resultadoLista.js"></script>
        <script type="text/javascript">
            var a;
            function submitform(a) {
                document.getElementById("codigo").value = a;
                document.formCodigo.submit();

            }

        </script>

        <link rel="stylesheet" type="text/css" href="css/resultadolista.css">

        <title>Re-Publica</title>
    </head>
    <body>
    <center>


        <img id="logoSite" src="imgs/logo_transp.png">
        <br>

        <p><a id="textoResultados">Exibindo resultados para "XXX"..</a></p>

        <!--DIVS ABAIXO -->

        <!--DIVFILTROS-->
        <div id="divFiltro" class="container">
            <ul id="ulFiltrocidade">	<!-- FILTRO CIDADE -->


                <a href="#" class="btn btn-info btn-lg" id="afiltroFormiga"> <span class="glyphicon glyphicon-asterisk"></span>Localização</a><!--BOTAOZINHO AZUL DA LOCALIZAÇÃO-->


                <a id=afitlrodivi" href="#"><br>Divinópolis</a><br>Itapecerica<br>Samonte</ul> ______________________

            <br><br>


            <ul id="ulFiltropreco"> <!-- FILTRO PREÇO -->

                <a href="#" class="btn btn-info btn-lg" id="afiltroPreco"> <span class="glyphicon glyphicon-asterisk"></span>Valor</a>
                <!--BOTAOZINHO AZUL DO PREÇO-->

                <a id="afiltro150a300" href="#"><br>De R$150,00 a R$300,00</a>

                <br>De R$300,00 a R$500,00<br>De R$500,00 a R$800,00<br></ul> 

        </div>



        <br><br><br>
        <form method="POST" action="resultadoclick.php" name="formCodigo">
            <?php
            // include ("codigo.php");
            $servidor = "localhost";
            $user = "root";
            $senha = "";
            $banco = "dbrepublica";
            $filtro = "";
            $aux = $_POST["filtro"];
            switch ($aux) {
                case 1:
                    $filtro = "and rep.precoRepublica between 150 and 300";
                    break;
            }
            try {
                $conn = new PDO("mysql:host=$servidor;dbname=$banco", $user, $senha);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                //SQL INSERT
                //$sql ="INSERT INTO `tbpessoa`(`nome`, `senha`, `cpf`, `rg`) "
                //        . "VALUES ('Arildo','senha','12811221678','aa')";
                // SQL UPDATE 
                //   $sql="UPDATE tbpessoa SET senha='poha' WHERE nome='Nikao' ";
                //SQL SELECT
                $sql = "SELECT rep.nomeRepublica, logr.nomeLogradouro, "
                        . "rep.zipzaporungaRepublica, p.nome, rep.numeroRepublica, "
                        . "rep.precoRepublica, b.nomeBairro, mun.nomeMunicipio, rep.idRepublica "
                        . "FROM tbrepublica rep, logradouro logr, tbpessoa p, bairro b,"
                        . " municipio mun WHERE rep.idPessoa = p.idTbPessoa and"
                        . " logr.idLogradouro = rep.Logradouro_idLogradouro and "
                        . "b.idBairro = logr.Bairro_idBairro and b.Municipio_idMunicipio = mun.idMunicipio " . $filtro;
                $stmt = $conn->prepare($sql);
                $stmt->execute();

                //SOMENTE PRO SELECT
                $result = $stmt->setFetchMode(PDO::FETCH_NUM);
                while ($row = $stmt->fetch()) {
//<input type='text' name='codigo" . $row[8] . "' value=$row[8]> 
                    echo"<div id='divDoMeio' class='container'>
            <div class='row'>
                <div id='divAnuncio001' class='col-*-*'>

                    <ul id='ulAnuncio001'>
                        <div class='col-*-*'>
                        
                            <a id='aAnuncio001nome' href='javascript: submitform(" . $row[8] . ")'><u><b> República " . $row[0] . "</b></u></a><br><!--O ID É ESTE PARA ALTERAR E VER SE MUDA O TEXTO-->
                            <a id='aAnuncio001endereco'>Endereço: " . $row[1] . " " . $row[4] . ", " . $row[6] . " " . $row[7] . "</a><br>
                            <a id='aAnuncio001contato'>Contato: " . $row[2] . " (" . $row[3] . ")</a><br><br>
                        </div>
                    </ul>


            </div>";
                }
                //while ($row = $stmt->fetch()) {
                //     print $row[0] . "\t" . $row[1] . "\t" . $row[2] . "\t" . $row[3] . "<br>";
                // }
                //fim select
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            } finally {
                $conn = null;
            }
            ?>
            <!--DIV001
            <div id="divDoMeio" class="container">
                <div class="row">
                    <div id="divAnuncio001" class="col-*-*">
    
                        <ul id="ulAnuncio001">
                            <div class="col-*-*">
                                <a id="aAnuncio001nome" href="resultadoclick.html"><u><b>República Takalepau</b></u></a><br><!--O ID É ESTE PARA ALTERAR E VER SE MUDA O TEXTO
                                <a id="aAnuncio001endereco">Endereço: </a><br>
                                <a id="aAnuncio001contato">Contato:</a><br><br>
                            </div>
                        </ul>
    
    
                    </div>
                </div>
            </div>-->
            <input type="hidden"  name="codigo" id="codigo">
        </form>
    </div>




</center> 
</body>

<br><br><br><br>


</html>