<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=yes">
        <link rel="stylesheet" type="text/css" href="css/anunciar.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="
              sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
        <script type="text/javascript" src="js/jquery.mask.min.js"></script>

        <script>
            $(document).ready(function (e) {
                var obj = $('.msk-celular');

                $(obj).mask(($(obj).val().length > 13) ? '(00)00000-0000' : '(00)00000-0000',
                        {onKeyPress: function (phone, e, currentField, options) {
                                var new_sp_phone = phone.match(/^(\(11\)9(5[0-9]|6[0-9]|7[01234569]|8[0-9]|9[0-9])[0-9]{1})/g);
                                new_sp_phone ? $(currentField).mask('(00)00000-0000', options) : $(currentField).mask('(00)00000-0000', options)
                            }});
            });
        </script>

            

        <title>Anunciar</title>
    </head>
    <body bgcolor="#d1e0e0" >
        <div class="container-fluid">
            <div class="row menu">
                <div class="col-sm-12">
                    <ul class="nav justify-content-end">
                        <li class="nav-item">
                            <a class="nav-link active" href="index.php">Página Inicial</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php">Sair</a>
                        </li>
                    </ul>
                </div>    
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <center>
                            <a href="index.html"><img id="img-logo" src="img/logo_transp.png"></a>
                        </center>
                    </div>
                </div>
                <div class="row conteudo">
                    <div class="col-sm-12">
                        <form id="conteudo" method="post" action="cadastrarep.php" enctype="multipart/form-data">

                            <h1 id="titulo">Cadastre sua Republica</h1>


                            <div class="form-group">
                                <label for="titulo" >Título do anúncio</label>
                                <input name="name" type="text" class="form-control" id="titulo" placeholder="Ex: casa da mãe Joana" required>
                            </div>

                            <div class="form-group">
                                <label for="descricao">Descrição</label>
                                <textarea name="descricao" class="form-control" rows="3" id="descricao" placeholder="Digite oque achar necessário que o locatário saiba ;)"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="bairro" >Bairro</label>
                                <input name="bairro" type="text" class="form-control" id="endereco" placeholder="Bairro" required>
                            </div>
                            <div class="form-group">
                                <label for="endereco" >Endereço</label>
                                <input name="endereco" type="text" class="form-control" id="endereco" placeholder="Rua" required>
                            </div>
                            <div class="form-group">
                                <label for="numero" >Numero</label>
                                <input name="numero" type="text" class="form-control" id="endereco" placeholder="00000" required>
                            </div>
                            <div class="form-group">
                                <label for="tel">Telefone de contato:</label>
                                <input name="phone"  type="text" class="msk-celular" placeholder="Ex.: (00) 00000-0000" required /> 
                            </div>
                            <div class="form-group">
                                <label for="numeroquartos">Numero de Quartos:</label>
                                <input name="numquartos"  type="text"  placeholder="Ex:7" required /> 
                            </div>
                            <div class="form-group">
                                <label for="preco">Preco:</label>
                                <input name="preco"  type="text" placeholder="Ex:200" required /> 
                            </div>



                            <div class="radio-inline">
                                <label> Para qual gênero será o quarto?</label><br>
                                <label  class="radio-inline"><input type="radio" name="sexo" value="1">Masculino</label>
                                <label  class="radio-inline"><input type="radio" name="sexo" value="2">Feminino</label>
                                <label  class="radio-inline"><input type="radio" name="sexo" value="0" checked>Ambos</label>
                            </div>



                            <div class="form-group">
                                <label for="exampleInputFile">Inserir Imagem Principal:</label>
                                <input type="file" id="upload" name="upload" class="btn-outline-secondary"  accept="image/jpeg"  />
                                <p class="help-block">Imagem que ficara na capa do anuncio (Somente arquivos .png e .jpeg). </p>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile">Demais Imagens:</label>
                                <input type="file" id="upload" name="uploadi" class="btn-outline-secondary"  accept="image/jpeg" />
                                <p class="help-block">Somente arquivos (.png) e (.jpeg). </p>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile">Demais Imagens:</label>
                                <input type="file" id="upload" name="uploadie" class="btn-outline-secondary"  accept="image/jpeg" />
                                <p class="help-block">Somente arquivos (.png) e (.jpeg). </p>
                            </div>
                            <br>

                            <center>

                                <button class="btn btn-outline-secondary btn-md" type="reset">Limpar</button>

                                <button onclick="" class="btn btn-outline-primary btn-md" type="submit">Concluir</button><br><br><br>
                            </center>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>