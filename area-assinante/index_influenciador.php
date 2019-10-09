<!DOCTYPE html>
<html lang="en">
  <head>

     <?php  
      header('Content-Type: text/html; charset=utf-8');
        session_start();
        if((!isset ($_SESSION['logininfluenciador']) == true) and (!isset ($_SESSION['senhainfluenciador']) == true)){
            unset($_SESSION['logininfluenciador']);
            unset($_SESSION['senhainfluenciador']);
            header('location:../login.html');
        }
        $logado = $_SESSION['logininfluenciador'];

        
        $host = "localhost:8080"; 
        $username = "root"; 
        $password = ""; 
        $db = "alug"; 
        
        
        /*
        $host = "localhost:3306"; 
        $username = "alugapp_root"; 
        $password = "eclenice123@"; 
        $db = "alugapp_alug";
        */
        
        $idinfluenciador = $_SESSION['idinfluenciador'];        

        $link = mysql_connect($host,$username,$password) or die("Impossível conectar ao banco."); 

        @mysql_select_db($db, $link) or die("Impossível conectar ao banco"); 
        mysql_query("SET NAMES 'utf8'");
        mysql_query('SET character_set_connection=utf8');
        mysql_query('SET character_set_client=utf8');
        mysql_query('SET character_set_results=utf8');

        $result_ticket=mysql_query("SELECT * FROM ticketinfluenciador where idinfluenciador = '$idinfluenciador'") or die("Impossível executar a query1");         
        
        $qtd_diarias_aluguel=0;
        $pontos_influenciador = 0;
        $peso_ticket = 0;
        while($row_ticket=mysql_fetch_object($result_ticket)) { //todos os tickets que o influenciador já teve        
          $qtd_diarias_aluguel=0;    
          $peso_ticket= $row_ticket->peso;  //recupera peso que o ticket tem para multiplicar pela quantidade de diárias    
          //retorna todos os aluguéis que efetuados com o ticket do influenciador         
          $result_aluguel=mysql_query("SELECT * FROM aluguel where ticket_influenciador = '$row_ticket->ticketinfluenciador'") or die("Impossível executar a query1");                                     
          while($row_aluguel=mysql_fetch_object($result_aluguel)) { 
           
          //Para cada aluguel, soma-se a quantidade de diárias                   
            /*$data1 = $row_aluguel->dtini;          
            $data2 = $row_aluguel->dtfim; 

            $d1 = strtotime($data1); 
            $d2 = strtotime($data2);

            $dataFinal = ($d2 - $d1) /86400; //diferença entre os dias para quantidade de diárias

            if($dataFinal == 0) $dataFinal = 1; //se é um dia considera-se 1 diária*/

            $qtd_diarias_aluguel += (1 * $peso_ticket);         
            
          }
          //acumula os pontos do influenciador
          $pontos_influenciador+=$qtd_diarias_aluguel;          
        }           
      ?>
    

    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />   
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Alug - Porque seus sonhos valem muito mais do que o dinheiro pode comprar</title>
    <meta name="description" content="Tenha tudo sem precisar comprar nada. Somos uma proposta de coscientização. Por que comprar, se você pode alugar?">
    
    <meta name="keywords" content="alug, alugbr, aluguel, alugue, produtos, aluguel em dois vizinhos, dois vizinhos, videogame, projetor, xbox, ps4, gopro, camera, fujifilm, instax, bicicleta, bike, oggi, aluguel de bike, moutain bike, videoke, tela de encosto, baba eletronica, baba, caixa de som, jbl, microfone, joystick, controle, lapela, kindle, tripe, apresentador, slides, chromecast, ferramentas, bosh, furadeira, parafusadeira, brocas, chaves, philips, wap, extratora, home cleaner, lavadora de alta pressao, transbike, airfryer, fritadeira, eletrica, violao, grow, perfil, imagem e acao, inalador, caixa termica, cadeirinha infantil">

    <meta name="author" content="Alug">

    <link href="https://fonts.googleapis.com/css?family=Crimson+Text:400,400i,600|Montserrat:200,300,400" rel="stylesheet">

    <link rel="stylesheet" href="../assets/css/bootstrap/bootstrap.css">
    <link rel="stylesheet" href="../assets/fonts/ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="../assets/fonts/law-icons/font/flaticon.css">

    <link rel="stylesheet" href="../assets/fonts/fontawesome/css/font-awesome.min.css">


    <link rel="stylesheet" href="../assets/css/slick.css">
    <link rel="stylesheet" href="../assets/css/slick-theme.css">

    <link rel="stylesheet" href="../assets/css/helpers.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/alug.css">
    <link rel="stylesheet" href="../assets/css/landing-2.css">

    <link rel="stylesheet" href="../assets/css/flexslider.css" type="text/css" media="screen" />    

   


  </head>
  <body data-spy="scroll" data-target="#pb-navbar" data-offset="200">

    <nav class="navbar navbar-expand-lg navbar-dark pb_navbar pb_scrolled-light" id="pb-navbar">
      <div class="container">
        <a class="navbar-brand" href="../index.php"><img class="img_alug" src="../assets/images/logotipo.png" style="width:120px"></a>
        <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse" data-target="#probootstrap-navbar" aria-controls="probootstrap-navbar" aria-expanded="false" aria-label="Toggle navigation">
          <span><i class="ion-navicon"></i></span>
        </button>
        <div class="collapse navbar-collapse" id="probootstrap-navbar">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item"><a class="nav-link" href="../index.php#section-home">Início</a></li>
            <li class="nav-item"><a class="nav-link" href="../index.php#section-features">Conheça mais</a></li>
            <li class="nav-item"><a class="nav-link" href="../index.php#section-reviews">Produtos</a></li>
            <li class="nav-item"><a class="nav-link" href="../index.php#section-planos">Planos</a></li>
            <li class="nav-item"><a class="nav-link" href="index.php">Acesso restrito</a></li>      
            <li class="nav-item"><a class="nav-link" href="../index.php#section-pricing">Contato</a></li>         
            <li class="nav-item"><a class="nav-link" href="https://medium.com/alug-escreve" target="_blank">Blog</a></li>
            <?php
              if((isset ($_SESSION['logininfluenciador']) == true) and (isset ($_SESSION['senhainfluenciador']) == true)){
                echo '<li class="nav-item"><a class="nav-link" href="encerra_sessao.php">Sair</a></li>';
              }
            ?>
          </ul>
        </div>
      </div>
    </nav>
    <!-- END nav -->


      <div class="modal fade bd-example-modal-lg" id="modal_prod" tabindex="-1"  aria-labelledby="modal_label" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content"> 
            <div class="modal-header">
              <h5 class="modal-title" id="modal_label"></h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>                     
            <div class="modal-body">
              <div class="row">
                <div class="col-sm-6">
                  <div id="container" class="cf">   
                    <img class="img_prod1 img-fluid" />                
                 </div>
                </div>
                <div class="col-md-6">
                  <p id="conteudo_prod" style="padding:20px;"></p>             
                </div>
              </div>
              <input type="hidden" id="mensagem">
              <input type="hidden" id="preco_produto">
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
              <button type="submit" id="enviarbtn" class="btn btn-success">Tenho interesse</button>
            </div>
          </div>
        </div>
      </div>


    <section style="padding:6em 0" class="overflow-hidden cover-bg-indigo cover-bg-opacity text-left alug_img" id="section-home">
      <div class="container">
        <div class="row">          
           <div class="container-fluid relative bg-white rounded pb_form_v1" style='padding:20px'>            
              <h3 class="mb-4 mt-0">Seja bem vindo <strong><?php echo $_SESSION['nomeinfluenciador']; ?></strong></h3>
              <p>Você possui A$<span class="span_alug"><?php echo $pontos_influenciador ?></span>
                , que podem ser trocados por prêmios. Selecione abaixo o prêmio que curtiu:</p>               
              <hr/>

              <div id="accordion">               
                <div class="card">
                  <div class="card-header" id="headingTwo">
                    <h5 class="mb-0">
                      <button style="color:#007bff; text-align:left;" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        Prêmios
                      </button>
                    </h5>
                  </div>
                  <div id="collapseTwo" class="show collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                    <div class="card-body">
                      <div class="col-md-12">
                    <div id="blogCarousel" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators" style="top:100%"> 
                            <li data-target="#blogCarousel" style="background-color:black;" data-slide-to="0" class="active">
                            </li>
                            <li data-target="#blogCarousel" style="background-color:black;" data-slide-to="1">
                            </li>
                            <li data-target="#blogCarousel" style="background-color:black;" data-slide-to="2">
                            </li>                          
                        </ol>
                        <!-- Carousel items -->
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <div class="row">
                                    <div class="col-md-3" style="margin-bottom:10px;">
                                        <a href="#" data-toggle="modal" data-target="#modal_prod" data-nome="5 por cento de desconto em diárias" data-img1="5desc.jpg" data-conteudo="Troque seus pontos por desconto no seu Alug. Garanta 5% a menos no valor total." data-preco="10,00">
                                             <img src="../assets/images/produtos/premios/5desc.jpg" alt="Image" class="img-fluid" style="max-width:70%;">
                                        </a>
                                    </div>   
                                    <div class="col-md-3" style="margin-bottom:10px;">
                                        <a href="#" data-toggle="modal" data-target="#modal_prod" data-nome="10 por cento de desconto em diárias" data-img1="10desc.jpg" data-conteudo="Troque seus pontos por desconto no seu Alug. Garanta 10% a menos no valor total." data-preco="20,00">
                                            <img src="../assets/images/produtos/premios/10desc.jpg" alt="Image" style="max-width:70%;">
                                        </a>
                                    </div>                                   
                                    <div class="col-md-3" style="margin-bottom:10px;">
                                        <a href="#" data-toggle="modal" data-target="#modal_prod" data-nome="15 por cento de desconto em diárias" data-img1="15desc.jpg" data-conteudo="Troque seus pontos por desconto no seu Alug. Garanta 15% a menos no valor total." data-preco="30,00">
                                             <img src="../assets/images/produtos/premios/15desc.jpg" alt="Image" style="max-width:70%;">
                                        </a>
                                    </div>
                                    <div class="col-md-3" style="margin-bottom:10px;">
                                        <a href="#" data-toggle="modal" data-target="#modal_prod" data-nome="50 por cento de desconto em diárias" data-img1="50desc.jpg" data-conteudo="Troque seus pontos por desconto no seu Alug. Pague somente a metade do seu Alug." data-preco="70,00">
                                             <img src="../assets/images/produtos/premios/50desc.jpg" alt="Image" style="max-width:70%;">
                                        </a>
                                    </div>
                                </div>
                                <!--.row-->
                            </div>
                            <!--.item-->

                            <div class="carousel-item">
                                <div class="row">
                                    <div class="col-md-3" style="margin-bottom:10px;">
                                        <a href="#" data-toggle="modal" data-target="#modal_prod" data-nome="Adesivos do Alug" data-img1="adesivos.jpg" data-conteudo="Troque seus pontos por estilosos adesivos do Alug e venha fazer parte da nossa comunidade." data-preco="3,00">
                                             <img src="../assets/images/produtos/premios/adesivos.jpg" alt="Image" style="max-width:70%;">
                                        </a>
                                    </div>
                                    <div class="col-md-3" style="margin-bottom:10px;">
                                        <a href="#" data-toggle="modal" data-target="#modal_prod" data-nome="Boné do Alug" data-img1="bones.jpg" data-conteudo="E que tal um desses bonés estilosos do Alug? Troque seus pontos por um desses e além de descolado, faça parte de uma comunidade de fazedores do bem." data-preco="10,00">
                                             <img src="../assets/images/produtos/premios/bones.jpg" alt="Image" style="max-width:70%;"> 
                                        </a>
                                    </div>
                                     <div class="col-md-3" style="margin-bottom:10px;">
                                        <a href="#" data-toggle="modal" data-target="#modal_prod" data-nome="Ecobag 50x50" data-img1="ecobag50.jpg" data-conteudo="Uma sacola estilosa dessa e ainda sustentável? Tem também!" data-preco="20,00">
                                             <img src="../assets/images/produtos/premios/ecobag50.jpg" alt="Image" style="max-width:70%;">
                                        </a>
                                    </div>                                    
                                    <div class="col-md-3" style="margin-bottom:10px;">
                                        <a href="#" data-toggle="modal" data-target="#modal_prod" data-nome="Ecobag 35x40" data-img1="ecobag35.jpg" data-conteudo="Uma sacola estilosa dessa e ainda sustentável? Tem também!" data-preco="20,00">
                                            <img src="../assets/images/produtos/premios/ecobag35.jpg" alt="Image" style="max-width:70%;">
                                        </a>
                                    </div>
                                </div>
                                <!--.row-->
                            </div>
                            <!--.item-->

                            <div class="carousel-item">
                                <div class="row">
                                    <div class="col-md-3" style="margin-bottom:10px;">
                                        <a href="#" data-toggle="modal" data-target="#modal_prod" data-nome="1 diária extra no meu Alug" data-img1="diaria.jpg" data-conteudo="Está precisando de um diazinho a mais no seu Alug? Pronto, tá aqui." data-preco="25,00">
                                             <img src="../assets/images/produtos/premios/diaria.jpg" alt="Image" style="max-width:70%;">
                                        </a>
                                    </div>
                                    <div class="col-md-3" style="margin-bottom:10px;">
                                        <a href="#" data-toggle="modal" data-target="#modal_prod" data-nome="1 diária de qualquer produto" data-img1="diaria_todos.jpg" data-conteudo="Escolha qualquer um dos nossos produtos, e a diária é por nossa conta." data-preco="100,00">
                                             <img src="../assets/images/produtos/premios/diaria_todos.jpg" alt="Image" style="max-width:70%;">
                                        </a>
                                    </div>
                                    <div class="col-md-3" style="margin-bottom:10px;">
                                        <a href="#" data-toggle="modal" data-target="#modal_prod" data-nome="1 diária da extratora de estofados" data-img1="diaria_extratora.jpg" data-conteudo="Quer dar um talento no sofá ou estofado? Troque seus pontos por 1 diária dessa tão comentada extratora." data-preco="75,00">
                                             <img src="../assets/images/produtos/premios/diaria_extratora.jpg" alt="Image" style="max-width:70%;">
                                        </a>
                                    </div>
                                    <div class="col-md-3" style="margin-bottom:10px;">
                                        <a href="#" data-toggle="modal" data-target="#modal_prod" data-nome="1 diária do Drone Phantom 3 SE" data-img1="diaria_drone.jpg" data-conteudo="Que tal um rolêzinho de Drone sem precisar comprar um? Quer melhor? Indica os amigos, acumule pontos e faz um passeio desse sem precisar pagar nada." data-preco="90,00">
                                            <img src="../assets/images/produtos/premios/diaria_drone.jpg" alt="Image" style="max-width:70%;">
                                        </a>
                                    </div>
                                </div>
                                <!--.row-->
                            </div>
    
                        </div>
                        <!--.carousel-inner-->
                    </div>
                    <!--.Carousel-->
                    </div>
                  </div>
                </div>

              <div class="card">
                <div class="card-header" id="headingOne">
                  <h5 class="mb-0">
                    <button style="color:#007bff;text-align:left;" class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                      Alug's realizados com meus tickets 
                    </button>
                  </h5>
                </div>                  
                <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                  <div class="card-body">
                    <div class="table-responsive" style="font-size:9pt;">
                      <table class="table table-hover">
                        <thead>
                          <tr>                                                
                            <th scope="col">Cliente</th>
                            <th scope="col">Produto</th>
                            <th scope="col">Diárias</th>                        
                            <th scope="col">Ticket</th> 
                            <th scope="col">A$ Acumulado</th> 
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                            $count = 1; 

                            //echo "SELECT * FROM aluguel,produto WHERE aluguel.dtfim is not null and DATE_FORMAT(aluguel.dtfim,'%Y/%m/%d') BETWEEN $dtinicio and $dtfim and aluguel.idproduto = produto.idproduto and aluguel.idcliente_plano = $row_plano->idclienteplano";
                            $result_aluguel=mysql_query("SELECT * FROM aluguel,produto,cliente WHERE aluguel.dtfim is not null and aluguel.idcliente = cliente.idcliente and aluguel.ticket_influenciador IN(SELECT ticketinfluenciador from ticketinfluenciador where idinfluenciador = $idinfluenciador )  and aluguel.idproduto = produto.idproduto") or die("Impossível executar a query3"); 

                            while($row_aluguel=mysql_fetch_object($result_aluguel)) { 
                              $data1 = $row_aluguel->dtini;          
                              $data2 = $row_aluguel->dtfim;                                                     

                              $d1 = strtotime($data1); 
                              $d2 = strtotime($data2);

                              $d1final = date("d-m-y", $d1);
                              $d2final = date("d-m-y", $d2);

                              $dif = ($d2 - $d1) /86400;
                              if($dif == 0) $dif = 1;

                              $result_ticket=mysql_query("SELECT * FROM ticketinfluenciador WHERE ticketinfluenciador = '$row_aluguel->ticket_influenciador'") or die("Impossível executar a query3"); 
                              $row_ticket=mysql_fetch_object($result_ticket);
                              $pontos_acumulados = 1 * $row_ticket->peso;

                              echo "<tr>    
                              <td>$row_aluguel->nome</td>  
                              <td>$row_aluguel->descrproduto</td>                                                              
                              <td>$dif</td>
                              <td>$row_aluguel->ticket_influenciador</td>
                              <td>$pontos_acumulados</td>
                              </tr>";

                              $count ++;
                            }
                          ?>                    
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>          
        </div>                
      </div>                  
    </section>

    <!-- END section -->

    <footer class="pb_footer bg-light" role="contentinfo">
      <div class="container">
        <div class="row text-center">
          <div class="col">
            <ul class="list-inline">
              <li class="list-inline-item"><a href="https://fb.com/alugbr" class="p-2"><i class="fa fa-facebook"></i></a></li>
              <li class="list-inline-item"><a href="https://instagram.com/alugbr" class="p-2"><i class="fa fa-instagram"></i></a></li>
              <li class="list-inline-item"><a href="https://api.whatsapp.com/send?phone=5546999303401" class="p-2"><i class="fa fa-whatsapp"></i></a></li>
            </ul>
          </div>
        </div>
        <div class="row">
          <div class="col text-center">
            <p class="pb_font-14">&copy; 2019. All Rights Reserved.</p>
            <p class="pb_font-14">Feito com amor <i class="fa fa-heart"></i></p>
          </div>
        </div>
      </div>
    </footer>

    <!-- loader -->
    <div id="pb_loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#1d82ff"/></svg></div>

    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/js/flexslides.jquery.min.js"></script>


    <script src="../assets/js/popper.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/js/slick.min.js"></script>
    <script src="../assets/js/jquery.mb.YTPlayer.min.js"></script>

    <script src="../assets/js/jquery.waypoints.min.js"></script>
    <script src="../assets/js/jquery.easing.1.3.js"></script>
     <script src="../assets/js/main.js"></script>

    <script type="text/javascript" src="../assets/js/jquery.autocomplete.js"></script>
    <script type="text/javascript" src="../assets/js/countries.js"></script>
    <script type="text/javascript" src="../assets/js/demo.js"></script>
    <script type="text/javascript" src="../assets/js/jquery.mockjax.js"></script>
    <script src="../assets/js/jquery.mask.js"></script>

     <script type="text/javascript">
      $('#modal_prod').on('show.bs.modal', function (event) {        
        //$(window).trigger('resize');
        var button = $(event.relatedTarget); // Botão que acionou o modal
        
        var nome = button.data('nome');        
        var conteudo = button.data('conteudo');        
        var preco = button.data('preco');    
        var imagem1 = button.data('img1');
        $('#conteudo_prod').html(conteudo);        
        // Se necessário, você pode iniciar uma requisição AJAX aqui e, então, fazer a atualização em um callback.
        // Atualiza o conteúdo do modal. Nós vamos usar jQuery, aqui. No entanto, você poderia usar uma biblioteca de data binding ou outros métodos.
        var modal = $(this);
        modal.find('.modal-title').text(nome);
        //modal.find('.modal-body input').val(recipient)
        //modal.find('.modal-title').text('Nova mensagem para ' + recipient)
        $('#mensagem').text('Gostaria de trocar meus A$ por um(a): '+nome);
        $('#preco_produto').text(preco);               

        $('.img_prod1').attr("src","../assets/images/produtos/premios/" + imagem1);

        var resizeEnd;
        resizeEnd = setTimeout(function() {
            initFlexModal();
        }, 250);

      })

      $( "#enviarbtn" ).click(function() {        
        //alert(mensagem);
        mensagem = $('#mensagem').text();
        window.open('https://api.whatsapp.com/send?phone=5546999303401&text='+mensagem,'_blank');
        //location.href= "https://api.whatsapp.com/send?phone=5546999303401&text="+mensagem;        
      });

      $('.carousel').carousel({
        pause: true,
        interval: false
      });        

    </script>


  </body>
</html>
