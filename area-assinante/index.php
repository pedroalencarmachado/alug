<!DOCTYPE html>
<html lang="en">
  <head>

     <?php  
        session_start();
        if((!isset ($_SESSION['login']) == true) and (!isset ($_SESSION['senha']) == true)){
            unset($_SESSION['login']);
            unset($_SESSION['senha']);
            header('location:../login.html');
        }
        $logado = $_SESSION['login'];

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
        
        $idcliente = $_SESSION['idcliente'];        

        $link = mysql_connect($host,$username,$password) or die("Impossível conectar ao banco."); 

        @mysql_select_db($db, $link) or die("Impossível conectar ao banco"); 

        $result_cliente=mysql_query("SELECT * FROM cliente where idcliente = '$idcliente'") or die("Impossível executar a query1"); 

        $row_cliente=mysql_fetch_object($result_cliente);
         
        $result_plano=mysql_query("SELECT * FROM cliente_plano, cliente, plano WHERE cliente_plano.idcliente = cliente.idcliente AND cliente_plano.idplano = plano.idplano and cliente_plano.status =1 and cliente_plano.idcliente = '$idcliente'", $link) or die(mysql_error($link)); 

        $row_plano=mysql_fetch_object($result_plano); 

        /*
          $data1 = $row_aluguel->dtini;          
          $data2 = $row_aluguel->dtfim;                                                               
          $d1 = strtotime($data1); 
          $d2 = strtotime($data2);
          $d1final = date("d-m-y", $d1);
          $d2final = date("d-m-y", $d2);
        */       

        $dia_vcto = $row_plano->dtvencimento;
        $mes_vcto = date('m');
        $ano_vcto = date('Y');
        $data = $dia_vcto."-".$mes_vcto."-".$ano_vcto;

        $data_vcto = date('d/m/Y', strtotime($data));

        if($data_vcto > date('d/m/Y')){
          $novo_mes = $mes_vcto -1;          
          $dtaux = $dia_vcto."-".$novo_mes."-".$ano_vcto;
          $dtinicio = date('Y/m/d', strtotime($dtaux));

          $dtaux = $dia_vcto."-".$mes_vcto."-".$ano_vcto;          
          $dtfim = date('Y/m/d', strtotime($dtaux));

          //echo $dtinicio." a ".$dtfim;
        }else{               
          $dtaux = $dia_vcto."-".$mes_vcto."-".$ano_vcto;
          $dtinicio = date('Y/m/d', strtotime($dtaux));

          $novo_mes = $mes_vcto +1;
          $dtaux = $dia_vcto."-".$novo_mes."-".$ano_vcto;          
          $dtfim = date('Y/m/d', strtotime($dtaux));

         //echo $dtinicio." a ".$dtfim;
        }

        $result_aluguel=mysql_query("SELECT * FROM aluguel,produto WHERE aluguel.dtfim is not null and DATE_FORMAT(aluguel.dtfim,'%Y/%m/%d') BETWEEN '$dtinicio' and '$dtfim' and aluguel.idproduto = produto.idproduto and aluguel.idcliente_plano = $row_plano->idclienteplano") or die("Impossível executar a query3"); 

        $qtd_diarias_usadas = 0;
        while($row_aluguel=mysql_fetch_object($result_aluguel)) { 
          $data1 = $row_aluguel->dtini;          
          $data2 = $row_aluguel->dtfim; 

          $d1 = strtotime($data1); 
          $d2 = strtotime($data2);

          $dataFinal = ($d2 - $d1) /86400;

          if($dataFinal == 0) $dataFinal = 1;

          $qtd_diarias_usadas += $dataFinal;
        }   

        $qtd_diarias_restantes = $row_plano->numdiaria - $qtd_diarias_usadas;     

      ?>
    

    <meta charset="utf-8">
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
            <li class="nav-item"><a class="nav-link" href="index.php">Área do assinante</a></li>      
            <li class="nav-item"><a class="nav-link" href="../index.php#section-pricing">Contato</a></li>         
            <li class="nav-item"><a class="nav-link" href="https://medium.com/alug-escreve" target="_blank">Blog</a></li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- END nav -->

    <section class="pb_cover_v3 overflow-hidden cover-bg-indigo cover-bg-opacity text-left alug_img" id="section-home">
      <div class="container">
        <div class="row">
          <div class="col-md-4 relative align-self-center " style='margin-bottom:20px; font-size:10pt;'>            
            <form action="efetuar-login.php" method="POST" enctype="multipart/form-data" class="bg-white rounded pb_form_v1" style="padding:20px">              
              <h3 class="mb-4 mt-0 text-center">Plano</h3>
              <hr/>
              <div class="mb-4 mt-0 text-left">
                <i class="fa fa-user-circle" aria-hidden="true"></i>
                <?php echo $row_cliente->nome ?>
                <br/><br/>
                <i class="fa fa-address-card" aria-hidden="true"></i>
                <?php echo $row_plano->descrplano ?>
                <br/><br/>                
                <i class="fa fa-check-circle" aria-hidden="true"></i>
                Vigente
                <br/><br/>                
                <i class="fa fa-truck" aria-hidden="true"></i>
                <?php 
                  echo $qtd_diarias_restantes." diárias restantes";
                ?>                              
              </div>   
            </form>
          </div>
          <br/>
           <div class="col-md-8 relative align-self-center bg-white rounded pb_form_v1" style='padding:20px'>            
              <h3 class="mb-4 mt-0 text-center">Aluguéis no mês</h3>
                <div class="table-responsive" style="font-size:10pt;">
                  <table class="table table-hover">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Início</th>
                        <th scope="col">Fim</th>
                        <th scope="col">Diárias</th>
                        <th scope="col">Produto</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        $count = 1; 

                        //echo "SELECT * FROM aluguel,produto WHERE aluguel.dtfim is not null and DATE_FORMAT(aluguel.dtfim,'%Y/%m/%d') BETWEEN $dtinicio and $dtfim and aluguel.idproduto = produto.idproduto and aluguel.idcliente_plano = $row_plano->idclienteplano";
                        $result_aluguel=mysql_query("SELECT * FROM aluguel,produto WHERE aluguel.dtfim is not null and DATE_FORMAT(aluguel.dtfim,'%Y/%m/%d') BETWEEN '$dtinicio' and '$dtfim' and aluguel.idproduto = produto.idproduto and aluguel.idcliente_plano = $row_plano->idclienteplano") or die("Impossível executar a query3"); 
                        
                        while($row_aluguel=mysql_fetch_object($result_aluguel)) { 
                          $data1 = $row_aluguel->dtini;          
                          $data2 = $row_aluguel->dtfim;                                                     
                          
                          $d1 = strtotime($data1); 
                          $d2 = strtotime($data2);

                          $d1final = date("d-m-y", $d1);
                          $d2final = date("d-m-y", $d2);

                          $dif = ($d2 - $d1) /86400;
                          if($dif == 0) $dif = 1;

                          echo "<tr>
                                  <td>$count</td>
                                  <td>$d1final</td>
                                  <td>$d2final</td>
                                  <td>$dif</td>
                                  <td>$row_aluguel->descrproduto</td>
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
        <script src="assets/js/flexslides.jquery.min.js"></script>


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


  </body>
</html>
