<!DOCTYPE html>
<html>
    <head>
        <!--HEAD COM SCRIPS E CSS-->
        <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet"><!--FONTE-->
        <meta http-equiv="content-type" content="txt/html"; charset="utf-8">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


        <link rel="stylesheet" type="text/css" href="css/resultadoclick.css">
        <title>Re-Publica</title>

    </head>
    <body>
        <!--INICIO DO CONTAINER FLUID-->

        <div class="container-fluid">

            <!--LOGO SITE-->
            <div class="row" >
                <div class="container align-self-center d-flex justify-content-center"><!--DEIXAR NO CENTRO-->
                    <img class="img-responsive" src="imgs/logo_transp.png" alt="Imagem" id="logoSite" />
                </div>   
            </div>

            <br><br><br>

            <?php
            $servidor = "localhost";
            $user = "root";
            $senha = "";
            $banco = "dbrepublica";
            $codigo = $_POST["codigo"];
            $nomeRepublica;
            $descricao;
            $preco = 0;
            $contato;
            $endereco;
            $numQuartos;
            try {
                $conn = new PDO("mysql:host=$servidor;dbname=$banco", $user, $senha);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = "SELECT rep.nomeRepublica, rep.numQuartosRepublica, logr.nomeLogradouro, "
                        . "rep.zipzaporungaRepublica, p.nome,rep.precoRepublica, "
                        . "b.nomeBairro, mun.nomeMunicipio, rep.descricaoRepublica, rep.numeroRepublica  "
                        . "FROM tbrepublica rep, logradouro logr, tbpessoa p, municipio mun, "
                        . "bairro b WHERE rep.idPessoa = p.idTbPessoa and "
                        . "logr.idLogradouro = rep.Logradouro_idLogradouro"
                        . " and b.idBairro = logr.Bairro_idBairro and "
                        . "b.Municipio_idMunicipio = mun.idMunicipio and rep.idRepublica = " . $codigo;
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                //SOMENTE PRO SELECT
                $result = $stmt->setFetchMode(PDO::FETCH_NUM);
                while ($row = $stmt->fetch()) {
                    $nomeRepublica = $row[0];
                    $descricao = $row[8];
                    $preco = $row[5];
                    $numQuartos = $row[1];
                    $endereco = $row[2] . ", " . $row[9] . ". " . $row[7] . ", " . $row[6];
                    $contato = $row[3] . ", " . $row[4];
                }
                $sqlImg = "select imagemRepublica from tbimagemrepublica where TbRepublica_idRepublica = " . $codigo;
                $stmt = $conn->prepare($sqlImg);
                $stmt->execute();
                $result = $stmt->setFetchMode(PDO::FETCH_NUM);
                $imagem = array();
                while ($row = $stmt->fetch()) {
                    array_push($imagem, $row[0]);
                }
                //<!--DIV EM CIMA DA FOTO-- (NOME DA REPUBLICA)-->
                echo"<div class='row' id='embaixoAnuncio'>

                <div class='container align-self-center d-flex justify-content-center'>	

                    <div class='col-sm-4' id='embaixoAnuncio2'><center>
                            <div class='well well-sm' id='nomerepublica'><b>República " . $nomeRepublica . "</b></div>
                        </center></div> 
                </div>


            </div>";
                //<!--DIVI DA DESCCRIÇÃO-->
                echo"<div class='row'>

                <div class='container' id='descricao'>

                    <div class='panel panel-primary'>
                        <div class='panel-heading'>Descrição:
                        </div>
                        <div class='panel-body'>
                        " . $descricao . "
                        </div>
                    </div>

                </div>";
                //<!--DIV DA ROLAGEM(FOTOS NO CENTRO)-->
                echo "  <div class='col-sm-7'>

                <div id='myCarousel' class='carousel slide' data-ride='carousel'>

                    <!-- BOLINHA EM BAIXO DA ROLAGEM -->
                    <ol class='carousel-indicators'>
                        <li data-target='#myCarousel' data-slide-to='0' class='active'></li>
                        <li data-target='#myCarousel' data-slide-to='1'></li>
                        <li data-target='#myCarousel' data-slide-to='2'></li>
                    </ol>


                    <!-- ONDE AS FOTOS RODAM -->

                    <div class='carousel-inner' role='listbox' id='rolagem'>
                        <div class='item active'>
                            <!-- Foto 1 aqui -->
                           <img  id='foto' src='data:image/jpeg;base64," . base64_encode($imagem[0]) . "' class='img-thumbnail' alt='Primeira' > 
                            <div class='carousel-caption'>


                            </div>
                        </div>

                        <div class='item'>
                         <!-- FOTO 2 AQUI -->
                     <img id='foto' src='data:image/jpeg;base64," . base64_encode($imagem[1]) . "' class='img-thumbnail' alt='Segunda'>    
                            <div class='carousel-caption'>

                            </div>
                        </div>

                        <div class='item'>
                         <!-- FOTO 3 AQUI -->
                       <img id='foto' src='data:image/jpeg;base64," . base64_encode($imagem[2]) . "'class='img-thumbnail' alt='Terceira'>	  
                            <div class='carousel-caption'>

                            </div>
                        </div>

                    </div>



                    <!--BOTAO DA ESQUERDA E DIREITA NA DIVI DAS FOTOS -->
                    <a class='left carousel-control' href='#myCarousel' role='button' data-slide='prev' id='botaoesquerda'>
                        <span class='glyphicon glyphicon-chevron-left' aria-hidden='true'></span>
                        <span class='sr-only'>Anterior</span>
                    </a>
                    <a class='right carousel-control' href='#myCarousel' role='button' data-slide='next' id='botaodireita'>
                        <span class='glyphicon glyphicon-chevron-right' aria-hidden='true'></span>
                        <span class='sr-only'>Próxima</span>
                    </a>
                </div>
            </div> <!-- Fim da rolagem -->
        </div><!--FIM DO PRIMEIRO ROW-->";
                // <!--DIV EM BAIXO DA FOTO-- (INFORMAÇÕES)-->
                setlocale(LC_MONETARY, 'pt_BR');
             
              
               

                $fmt = new NumberFormatter('en_US', NumberFormatter::CURRENCY);
                $fmt->setTextAttribute(NumberFormatter::CURRENCY_CODE, 'R$');
                echo"<div class='row'>

                <div class='container' id='embaixoAnuncio3'><!--INFORMAÇÕES-->

                    <div class='panel panel-primary'>
                        <div class='panel-heading'>Informações:
                        </div>
                        <div class='panel-body'>Número de quartos: " . $numQuartos . "<br>
                            Contato: " . $contato . "<br>
                            Preço: R$" . number_format($preco, 2, ",", ".") . "<br>
                            Endereço: " . $endereco . "<br>
                        </div>
                    </div>

                </div>
            </div>";
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            } finally {
                $conn = null;
            }
            ?>




            <br>



            <a id="voltar" href="resultadolista.php"><!--BOTAO VOLTAR-->	
                <center>
                    <button type="button" class="btn btn-primary">Voltar</button>
                </center>
            </a>
        </div>	<!--FIM DO FLUID-->




    </body>
</html>