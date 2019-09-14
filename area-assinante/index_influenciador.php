<!DOCTYPE html>
<html lang="en">
  <head>

     <?php  
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

        $result_ticket=mysql_query("SELECT * FROM ticketinfluenciador where idinfluenciador = '$idinfluenciador'") or die("Impossível executar a query1");         
        
        $qtd_diarias_aluguel=0;
        $pontos_influenciador = 0;
        while($row_ticket=mysql_fetch_object($result_ticket)) { //todos os tickets que o influenciador já teve        
          $qtd_diarias_aluguel=0;    
          //retorna todos os aluguéis que efetuados com o ticket do influenciador         
          $result_aluguel=mysql_query("SELECT * FROM aluguel where ticket_influenciador = '$row_ticket->ticketinfluenciador'") or die("Impossível executar a query1");                                     
          while($row_aluguel=mysql_fetch_object($result_aluguel)) { 
           
          //Para cada aluguel, soma-se a quantidade de diárias                   
            $data1 = $row_aluguel->dtini;          
            $data2 = $row_aluguel->dtfim; 

            $d1 = strtotime($data1); 
            $d2 = strtotime($data2);

            $dataFinal = ($d2 - $d1) /86400;

            if($dataFinal == 0) $dataFinal = 1;

            $qtd_diarias_aluguel += $dataFinal;         
            
          }
          //acumula os pontos do influenciador
          $pontos_influenciador+=$qtd_diarias_aluguel;          
        }           
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

    <section style="padding:6em 0" class="overflow-hidden cover-bg-indigo cover-bg-opacity text-left alug_img" id="section-home">
      <div class="container">
        <div class="row">          
           <div class="container-fluid relative bg-white rounded pb_form_v1" style='padding:20px'>            
              <h3 class="mb-4 mt-0">Seja bem vindo <strong><?php echo $_SESSION['nomeinfluenciador']; ?></strong></h3>
              <p>Você possuir <span class="span_alug">A$ 100</span>, que podem ser trocados por prêmios. Selecione abaixo o prêmio que curtiu:</p>               
              <hr/>

              <div id="accordion">               
                <div class="card">
                  <div class="card-header" id="headingTwo">
                    <h5 class="mb-0">
                      <button style="color:#007bff" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
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
                            <li data-target="#blogCarousel" style="background-color:black;" data-slide-to="3">
                            </li>   
                            <li data-target="#blogCarousel" style="background-color:black;" data-slide-to="4">
                            </li>
                             <li data-target="#blogCarousel" style="background-color:black;" data-slide-to="5">
                            </li>   
                            <li data-target="#blogCarousel" style="background-color:black;" data-slide-to="6">
                            </li>                          
                        </ol>
                        <!-- Carousel items -->
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <div class="row">
                                    <div class="col-md-3" style="margin-bottom:10px;">
                                        <a href="#" data-toggle="modal" data-target="#modal_prod" data-nome="Drone DJI Phantom 3 SE" data-img1="drone1.jpg" data-img2="drone2.jpg" data-img3="drone3.jpg" data-img4="drone4.jpg" data-itens="Drone DJI Phantom 3 SE, controle remoto, 1 bateria, carregadores e acessórios." data-conteudo="Agora você pode ter um drone sem precisar comprar um. Aluga, e paga somente pelo período que usar. O Phantom 3 SE tira fotos em 12mp, Filmes em 4k a 30fps, alcance de até 4km e autonomia de até 25 min." data-preco="129.90">
                                             <img src="../assets/images/produtos/premios/15desc.jpg" alt="Image" style="max-width:70%;">
                                        </a>
                                    </div>   
                                    <div class="col-md-3" style="margin-bottom:10px;">
                                        <a href="#" data-toggle="modal" data-target="#modal_prod" data-nome="XBox One" data-img1="videogame1.jpg" data-img2="videogame2.jpg" data-img3="videogame3.jpg" data-img4="videogame4.jpg" data-itens="console xbox one 500GB, 1 controle sem fio, fonte e cabo de alimentação, cabo HDMI, 53 jogos e fone de ouvido."  data-conteudo="Esse dispensa comentário né? Além do console da microsoft, você já leva um controle e mais de 50 jogos, entre eles: FIFA, Mortal Kombat, UFC, Forza." data-preco="45.90">
                                            <img src="../assets/images/produtos/premios/adesivos.jpg" alt="Image" style="max-width:70%;">
                                        </a>
                                    </div>                                   
                                    <div class="col-md-3" style="margin-bottom:10px;">
                                        <a href="#" data-toggle="modal" data-target="#modal_prod" data-nome="Projetor Multimídia Epson Powerlite S10" data-img1="projetor1.jpg" data-img2="projetor2.jpg" data-img3="projetor3.jpg" data-img4="projetor4.jpg" data-itens="projetor epson s10, bolsa para transporte, cabo de energia, cabo vga, adaptador hdmi, tela de projeção 1,80 x 1,70 e suporte para tela de projeção."  data-conteudo="Não tem como pensar em uma apresentação sem um desses né? Já viu o preço de um novo? Pois bem. Agora você pode pagar um precinho gente boa que corresponde só pelo tempo que usou." data-preco="47.90">
                                             <img src="assets/images/produtos/projetor1.jpg" alt="Image" style="max-width:70%;">
                                        </a>
                                    </div>
                                    <div class="col-md-3" style="margin-bottom:10px;">
                                        <a href="#" data-toggle="modal" data-target="#modal_prod" data-nome="Câmera Canon EOS Rebel T6" data-img1="camera_fotografica1.jpg" data-img2="camera_fotografica2.jpg" data-img3="camera_fotografica3.jpg" data-img4="camera_fotografica4.jpg" data-itens="câmera Canon EOS T6, objetiva 18-55mm, moldura de visor, 1 bateria, carregador, bolsa de transporte, cartão SD 32GB, cabo USB." data-conteudo="Que tal então essa Câmera profissional da Canon EOS Rebel T6. Aposto que aquele ensaio fotográfico tem tudo pra ser um sucesso agora, não é mesmo?" data-preco="56.90">
                                             <img src="assets/images/produtos/camera_fotografica1.jpg" alt="Image" style="max-width:100%;">
                                        </a>
                                    </div>
                                </div>
                                <!--.row-->
                            </div>
                            <!--.item-->

                            <div class="carousel-item">
                                <div class="row">
                                    <div class="col-md-3" style="margin-bottom:10px;">
                                        <a href="#" data-toggle="modal" data-target="#modal_prod" data-nome="GoPro Hero 7 Black" data-img1="gopro1.jpg" data-img2="gopro2.jpg" data-img3="gopro3.jpg" data-img4="gopro4.jpg" data-itens="câmera GoPro Hero 7 black, cabo usb, adatador para tomada, case de transporte, case de estanque, bastão retrátil, bastão flutuante, tripé flexível, suporte para vidro, suporte para pulso, suporte para peito, suporte para cabeça, maleta de transporte." data-conteudo="Esse espaço é pequeno demais para tamanhas possibilidades de se fazer com uma câmera dessas. Além da camera, você leva mais 10 acessórios." data-preco="55.90">
                                             <img src="assets/images/produtos/gopro1.jpg" alt="Image" style="max-width:100%;">
                                        </a>
                                    </div>
                                    <div class="col-md-3" style="margin-bottom:10px;">
                                        <a href="#" data-toggle="modal" data-target="#modal_prod" data-nome="Babá Eletrônica Motorola MBP-482" data-img1="baba_eletronica1.jpg" data-img2="baba_eletronica2.jpg" data-img3="baba_eletronica3.jpg" data-img4="baba_eletronica4.jpg" data-itens="monitor, câmera, bateria recarregável, adaptador para o monitor, adaptador para câmera, manual de instruções." data-conteudo="Tá precisando se acostumar com a ideia do seu neném no próprio quarto? Que tal uma vigiadinha pra ter certeza que está tudo bem por lá?" data-preco="23.90">
                                             <img src="assets/images/produtos/baba_eletronica1.jpg" alt="Image" style="max-width:100%;"> 
                                        </a>
                                    </div>
                                     <div class="col-md-3" style="margin-bottom:10px;">
                                        <a href="#" data-toggle="modal" data-target="#modal_prod" data-nome="Videokê VSK" data-img1="videoke1.jpg" data-img2="videoke2.jpg" data-img3="videoke3.jpg" data-img4="videoke4.jpg" data-itens="aparelho videokê com 340 músicas, 1 microfone, fonte de alimentação, cabo p2/RCA, cabo HDMI, catálogo de músicas." data-conteudo="Tem um talento escondido dentro de você e precisa com urgência exibi-lo para seus amigos? Que tal um videokê com mais de 300 músicas? Conecte ele na sua TV e a festa é certa" data-preco="34.90">
                                             <img src="assets/images/produtos/videoke1.jpg" alt="Image" style="max-width:100%;">
                                        </a>
                                    </div>                                    
                                    <div class="col-md-3" style="margin-bottom:10px;">
                                        <a href="#" data-toggle="modal" data-target="#modal_prod" data-nome="Caixa de som Mondial CM11 400W RMS" data-img1="caixa_som1.jpg" data-img2="caixa_som2.jpg" data-img3="caixa_som3.jpg" data-img4="caixa_som4.jpg" data-itens="caixa amplificadora mondial CM-11, cabo de energia, cabo para bateria externa, cabo RCA/P2, controle remoto, manual de instruções." data-conteudo="Quer dar um volume na sua festinha? Que tal essa caixa de som com conexão bluetooth, conexão para microfones, conexão usb, entre outras? Ainda por cima, são 400W RMS, já pensou?" data-preco="23.90">
                                            <img src="assets/images/produtos/caixa_som1.jpg" alt="Image" style="max-width:100%;">
                                        </a>
                                    </div>
                                </div>
                                <!--.row-->
                            </div>
                            <!--.item-->

                            <div class="carousel-item">
                                <div class="row">
                                    <div class="col-md-3" style="margin-bottom:10px;">
                                        <a href="#" data-toggle="modal" data-target="#modal_prod" data-nome="Caixa de som JBL Flip 3" data-img1="jbl1.jpg" data-img2="jbl2.jpg" data-img3="jbl3.jpg" data-img4="jbl4.jpg" data-itens="caixa de som JBL Flip 3, cabo usb."  data-conteudo="Já viu o estrago que uma caixinha desse tamanho pode causar? Aluga e tire a sua prova real." data-preco="20.90">
                                             <img src="assets/images/produtos/jbl1.jpg" alt="Image" style="max-width:100%;">
                                        </a>
                                    </div>
                                    <div class="col-md-3" style="margin-bottom:10px;">
                                        <a href="#" data-toggle="modal" data-target="#modal_prod" data-nome="Carregador portátil Powerbank 20.000mAh" data-img1="carregador_portatil1.jpg" data-img2="carregador_portatil2.jpg" data-img3="carregador_portatil3.jpg" data-img4="carregador_portatil4.jpg" data-itens="carregador portátil pineng 20.000mAh, cabo usb."  data-conteudo="Vai para uma viagem e sabe que vai ficar sem bateria? Pra que sofrer com isso? Aqui você leva esse carregador portátil que te dá de 6 a 10 cargas completas no seu celular." data-preco="14.90">
                                             <img src="assets/images/produtos/carregador_portatil1.jpg" alt="Image" style="max-width:100%;">
                                        </a>
                                    </div>
                                    <div class="col-md-3" style="margin-bottom:10px;">
                                        <a href="#" data-toggle="modal" data-target="#modal_prod" data-nome="Fujifilm Instax Mini 8" data-img1="polaroid1.jpg" data-img2="polaroid2.jpg" data-img3="polaroid3.jpg" data-img4="polaroid4.jpg" data-itens="câmera Fujifilm Instax Mini 8, 2 pilhas AA, 10 fotos instax mini." data-conteudo="Depois das câmeras digitais, diga aí, quantas vezes você imprimiu uma foto? Essa câmera instantânea nos remete aos velhos e bons tempos." data-preco="38.90">
                                             <img src="assets/images/produtos/polaroid1.jpg" alt="Image" style="max-width:100%;">
                                        </a>
                                    </div>
                                    <div class="col-md-3" style="margin-bottom:10px;">
                                        <a href="#" data-toggle="modal" data-target="#modal_prod" data-nome="Impressora HP Sprocket" data-img1="impressora1.jpg" data-img2="impressora2.jpg" data-img3="impressora3.jpg" data-img4="impressora4.jpg" data-itens="impressora HP Sprocket, cabo usb, 5 papéis para foto zink paper." data-conteudo="Que tal criar uma lembrança maior ainda daquele final de semana com os amigos? Com a impressora HP Sprocket, você imprime de maneira instantânea qualquer foto tirada pelo seu smartphone." data-preco="34.90">
                                            <img src="assets/images/produtos/impressora1.jpg" alt="Image" style="max-width:100%;">
                                        </a>
                                    </div>
                                </div>
                                <!--.row-->
                            </div>
                            <!--.item-->

                            <div class="carousel-item">
                                <div class="row">
                                    <div class="col-md-3" style="margin-bottom:10px;">
                                        <a href="#" data-toggle="modal" data-target="#modal_prod" data-nome="Microfone sem fio VWS-20" data-img1="microfone1.jpg" data-img2="microfone2.jpg" data-img3="microfone3.jpg" data-img4="microfone4.jpg" data-itens="2 microfones sem fio, base receptora, 4 pilhas AA, cabo p10, cabo de energia, manual de instruções." data-conteudo="Com esse par de microfones, suas apresentações serão muito mais participativas, e o melhor de tudo, você paga um precinho camarada pelo seu uso." data-preco="19.90">
                                            <img src="assets/images/produtos/microfone1.jpg" alt="Image" style="max-width:100%;">
                                        </a>
                                    </div>
                                    <div class="col-md-3" style="margin-bottom:10px;">
                                        <a href="#" data-toggle="modal" data-target="#modal_prod" data-nome="Microfone de Lapela AMW BV58" data-img1="microfone_lapela1.jpg" data-img2="microfone_lapela2.jpg" data-img3="microfone_lapela3.jpg" data-img4="microfone_lapela4.jpg" data-itens="2 microfones auriculares, 2 bases de transmissão, 1 base receptora, 4 pilhas AA, cabo p10, cabo de energia. " data-conteudo="Quer microfone mais discreto que esses? Acredite, eles não deixam nada a desejar quanto ao volume e potência." data-preco="27.90">
                                             <img src="assets/images/produtos/microfone_lapela1.jpg" alt="Image" style="max-width:100%;">
                                        </a>
                                    </div>
                                    <div class="col-md-3" style="margin-bottom:10px;">
                                        <a href="#" data-toggle="modal" data-target="#modal_prod" data-nome="Estabilizador de câmera Steadycam" data-img1="estabilizador1.jpg" data-img2="estabilizador2.jpg" data-img3="estabilizador3.jpg" data-img4="estabilizador4.jpg" data-itens="estabilizador de câmera, 3 contrapesos, manopla, adaptador para celular e câmera."  data-conteudo="Quer gravar um vídeo sem deixar a impressão que estava descendo escada enquanto gravava? Que tal esse estabilizador manual de câmera?" data-preco="18.90">
                                             <img src="assets/images/produtos/estabilizador1.jpg" alt="Image" style="max-width:100%;">
                                        </a>
                                    </div>
                                    <div class="col-md-3" style="margin-bottom:10px;">
                                        <a href="#" data-toggle="modal" data-target="#modal_prod" data-nome="Controle PS4" data-img1="controle_ps4_1.jpg" data-img2="controle_ps4_2.jpg" data-img3="controle_ps4_3.jpg" data-img4="controle_ps4_4.jpg" data-itens="controle sem fio para PS4." data-conteudo="Jogar um game é legal né? Acompanhado de um amigo, pode ficar ainda mais divertido. Não se preocupe em comprar um controle novo para usar em um final de semana. Aqui você aluga um novinho e paga só pelo tempo que usar" data-preco="17.90">
                                             <img src="assets/images/produtos/controle_ps4_1.jpg" alt="Image" style="max-width:100%;">
                                        </a>
                                    </div>
                                </div>
                                <!--.row-->
                            </div>

                            <div class="carousel-item">                              
                                <div class="row">
                                    <div class="col-md-3" style="margin-bottom:10px;">
                                        <a href="#" data-toggle="modal" data-target="#modal_prod" data-nome="Controle XBox One" data-img1="controle_xbox1.jpg" data-img2="controle_xbox2.jpg" data-img3="controle_xbox3.jpg" data-img4="controle_xbox4.jpg" data-itens="controle sem fio para XBOX One, 2 pilhas AA." data-conteudo="Para os amantes do XBOX One, aqui você encontra controles para convidar seus amigos para aquela jogatina." data-preco="20.90">
                                             <img src="assets/images/produtos/controle_xbox1.jpg" alt="Image" style="max-width:100%;">
                                        </a>
                                    </div>
                                    <div class="col-md-3" style="margin-bottom:10px;">
                                        <a href="#" data-toggle="modal" data-target="#modal_prod" data-nome="Kindle Paperwhite 8˚ Geração" data-img1="kindle1.jpg" data-img2="kindle2.jpg" data-img3="kindle3.jpg" data-img4="kindle4.jpg" data-itens="kindle paperwhite, cabo USB, manual de instruções."  data-conteudo="Quem imaginou que em um aparelho tão pequeno fosse possível carregar centenas de milhares de livros? Com o Kindle você leva seus livros preferidos onde quiser, e alugando, é ainda melhor." data-preco="20.90">
                                             <img src="assets/images/produtos/kindle1.jpg" alt="Image" style="max-width:100%;">
                                        </a>
                                    </div>
                                    <div class="col-md-3" style="margin-bottom:10px;">
                                        <a href="#" data-toggle="modal" data-target="#modal_prod" data-nome="Apresentador de Slide Logitech R400" data-img1="apresentador1.jpg" data-img2="apresentador2.jpg" data-img3="apresentador3.jpg" data-itens="apresentador Logitech R400, receptor USB, estojo de transporte, 2 pilhas AAA." data-img4="apresentador4.jpg" data-conteudo="Quer dar aquela incrementada nas suas apresentações? Dá uma olhada nesse apresentador de slides que temos para te alugar." data-preco="15.90">
                                             <img src="assets/images/produtos/apresentador1.jpg" alt="Image" style="max-width:100%;">
                                        </a>
                                    </div>
                                    <div class="col-md-3" style="margin-bottom:10px;">
                                        <a href="#" data-toggle="modal" data-target="#modal_prod" data-nome="Tripé para máquina fotográfica" data-img1="tripe1.jpg" data-img2="tripe2.jpg" data-img3="tripe3.jpg" data-img4="tripe4.jpg" data-itens="tripé para câmera, bolsa para transporte." data-conteudo="Sabe aquelas fotos vibradas que você tira? Então, agora você não precisa mais. Leva esse tripé e desse problema não sofre mais." data-preco="14.90">
                                            <img src="assets/images/produtos/tripe1.jpg" alt="Image" style="max-width:100%;">
                                        </a>
                                    </div>
                                </div>
                                <!--.row-->
                            </div>

                            <div class="carousel-item">
                                <div class="row">
                                    <div class="col-md-3" style="margin-bottom:10px;">
                                        <a href="#" data-toggle="modal" data-target="#modal_prod" data-nome="Google Chromecast 2" data-img1="chromecast1.jpg" data-img2="chromecast2.jpg" data-img3="chromecast3.jpg" data-img4="chromecast4.jpg" data-itens="Google chromecast 2, cabo usb, adaptador de tomada." data-conteudo="Quer transmitir vídeos e filmes do seu celular direto pra sua TV? Com o Google Chromecast você transforma sua TV em smart em poucos minutos." data-preco="17.90">
                                             <img src="assets/images/produtos/chromecast1.jpg" alt="Image" style="max-width:100%;">
                                        </a>
                                    </div>    
                                    <div class="col-md-3" style="margin-bottom:10px;">
                                        <a href="#" data-toggle="modal" data-target="#modal_prod" data-nome="Adaptador HDMI" data-img1="adaptadorhdmi1.jpg" data-img2="adaptadorhdmi2.jpg" data-img3="adaptadorhdmi3.jpg" data-img4="adaptadorhdmi4.jpg" data-itens="adaptador HDMI." data-conteudo="Precisou conectar um equipamento e só agora percebeu que não tem a conexão necessária? Relaxa que temos a solução." data-preco="13.90">
                                             <img src="assets/images/produtos/adaptadorhdmi1.jpg" alt="Image" style="max-width:100%;">
                                        </a>
                                    </div> 
                                    <div class="col-md-3" style="margin-bottom:10px;">
                                        <a href="#" data-toggle="modal" data-target="#modal_prod" data-nome="HD Externo Samsung 1TB" data-img1="hd1.jpg" data-img2="hd2.jpg" data-img3="hd3.jpg" data-img4="hd4.jpg" data-itens="hd Samsung 1TB, cabo usb." data-conteudo="Vai formatar o PC e está sem espaço para o backup? Leva o HD, faz o backup e paga só pelo tempo que usou, quer vantagem maior?" data-preco="19.90">
                                             <img src="assets/images/produtos/hd1.jpg" alt="Image" style="max-width:100%;">
                                        </a>
                                    </div>  
                                    <div class="col-md-3" style="margin-bottom:10px;">
                                        <a href="#" data-toggle="modal" data-target="#modal_prod" data-nome="Tela de Projeção + Tripé" data-img1="tela_projecao1.jpg" data-img2="tela_projecao2.jpg" data-img3="tela_projecao3.jpg" data-img4="tela_projecao4.jpg" data-itens="Tripé 3m, Tela de 1,80m x 1,70m, Bolsa para transporte do tripé." data-conteudo="Está precisando projetar mas não tem um lugar preparado? Agora não precisa mais se preocupar com isso. Com essa tela de projeção você monta onde quiser." data-preco="14.90">
                                             <img src="assets/images/produtos/tela_projecao1.jpg" alt="Image" style="max-width:100%;">
                                        </a>
                                    </div>                              
                                </div>
                                <!--.row-->
                            </div>
                            <!--.item-->  
                            <div class="carousel-item">
                                <div class="row">
                                    <div class="col-md-3" style="margin-bottom:10px;">
                                        <a href="#" data-toggle="modal" data-target="#modal_prod" data-nome="Tela de Encosto 9' Motor One" data-img1="tela_encosto1.jpg" data-img2="tela_encosto2.jpg" data-img3="tela_encosto3.jpg" data-img4="tela_encosto4.jpg" data-itens="1 tela de encosto 9' com leitor de DVD/CD/USB e SD, acessórios e plugues de instalação, fonte para tomada veicular, controle para videogame, controle remoto,  " data-conteudo="Vai levar a criançada em uma viagem longa? Já sabe que elas vão se entediar né? Que tal levar uma tela encosto de 9'?" data-preco="25.90">
                                             <img src="assets/images/produtos/tela_encosto1.jpg" alt="Image" style="max-width:100%;">
                                        </a>
                                    </div>                                                                     
                                </div>
                                <!--.row-->
                            </div>
                            <!--.item-->           

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
                    <button style="color:#007bff" class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                      Alug's realizados com meus tickets 
                    </button>
                  </h5>
                </div>                  
                <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                  <div class="card-body">
                    <div class="table-responsive" style="font-size:10pt;">
                      <table class="table table-hover">
                        <thead>
                          <tr>                                                
                            <th scope="col">Cliente</th>
                            <th scope="col">Produto</th>
                            <th scope="col">Diárias</th>                        
                            <th scope="col">Ticket</th> 
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

                              echo "<tr>    
                              <td>$row_aluguel->nome</td>  
                              <td>$row_aluguel->descrproduto</td>                                                              
                              <td>$dif</td>
                              <td>$row_aluguel->ticket_influenciador</td>

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
