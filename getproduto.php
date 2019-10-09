


<html lang="en">
	<head>
       
<?php

//header ('Content-type: text/html; charset=ISO-8859-1');
header('Content-Type: text/html; charset=utf-8');


$host = "localhost:3306"; 
$username = "alugapp_root"; 
$password = "eclenice123@"; 
$db = "alugapp_alug";



/*
$host = "localhost:8080"; 
$username = "root"; 
$password = ""; 
$db = "alug"; 
*/

if(!array_key_exists('idprod',$_GET)){ echo "<script> window.location.replace('index.php') </script>"; } 

$id_prod = $_GET['idprod'];

if (empty($id_prod)) {echo "<script> window.location.replace('index.php') </script>";}




$nomeprod = "";
$conteudoprod = "";


mysql_connect($host,$username,$password) or die("Impossível conectar ao banco."); 

@mysql_select_db($db) or die("Impossível conectar ao banco"); 

mysql_query("SET NAMES 'utf8'");
mysql_query('SET character_set_connection=utf8');
mysql_query('SET character_set_client=utf8');
mysql_query('SET character_set_results=utf8');

$result=mysql_query("SELECT * FROM produto where idproduto = $id_prod") or die("Impossível executar a query"); 

if(mysql_num_rows($result) > 0){
    $row=mysql_fetch_object($result);
    $nomeprod = $row->descrproduto;
    $conteudoprod = $row->conteudo;

}
else{    
    echo "<script> window.location.replace('index.php') </script>";
}

?>
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-143772833-1"></script>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8" />        
                
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <title>Alug - Porque seus sonhos valem muito mais do que o dinheiro pode comprar</title>
        <meta name="description" content="Tenha tudo sem precisar comprar nada. Somos uma proposta de coscientização. Por que comprar, se você pode alugar?">
    		
        <meta name="keywords" content="alug, alugbr, aluguel, alugue, produtos, aluguel em dois vizinhos, dois vizinhos, videogame, projetor, xbox, ps4, gopro, camera, fujifilm, instax, bicicleta, bike, oggi, aluguel de bike, moutain bike, videoke, tela de encosto, baba eletronica, baba, caixa de som, jbl, microfone, joystick, controle, auricular, lapela, kindle, tripe, apresentador, slides, chromecast, ferramentas, bosh, furadeira, parafusadeira, brocas, chaves, philips, wap, extratora, home cleaner, lavadora de alta pressao, transbike, airfryer, fritadeira, eletrica, violao, grow, perfil, imagem e acao, inalador, caixa termica, cadeirinha infantil">

        <meta name="author" content="Alug">

        <link href="https://fonts.googleapis.com/css?family=Crimson+Text:400,400i,600|Montserrat:200,300,400" rel="stylesheet">

    	<link rel="stylesheet" href="assets/css/bootstrap/bootstrap.css">
        <link rel="stylesheet" href="assets/fonts/ionicons/css/ionicons.min.css">
        <link rel="stylesheet" href="assets/fonts/law-icons/font/flaticon.css">

        <link rel="stylesheet" href="assets/fonts/fontawesome/css/font-awesome.min.css">


        <link rel="stylesheet" href="assets/css/slick.css">
        <link rel="stylesheet" href="assets/css/slick-theme.css">

        <link rel="stylesheet" href="assets/css/helpers.css">
        <link rel="stylesheet" href="assets/css/style.css">
        <link rel="stylesheet" href="assets/css/alug.css">
        <link rel="stylesheet" href="assets/css/landing-2.css">

        <link rel="stylesheet" href="assets/css/flexslider.css" type="text/css" media="screen" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

	</head>

	<body data-spy="scroll" data-target="#pb-navbar" class="pb_cover_v3 overflow-hidden cover-bg-indigo cover-bg-opacity text-left alug_img" data-offset="200">

        <nav class="navbar navbar-expand-lg navbar-dark pb_navbar pb_scrolled-light" id="pb-navbar">
          <div class="container">
            <a class="navbar-brand" href="index.php"><img class="img_alug" src="assets/images/logotipo.png" style="width:120px"></a>
            <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse" data-target="#probootstrap-navbar" aria-controls="probootstrap-navbar" aria-expanded="false" aria-label="Toggle navigation">
              <span><i class="ion-navicon"></i></span>
            </button>
            <div class="collapse navbar-collapse" id="probootstrap-navbar">
              <ul class="navbar-nav ml-auto">
                <li class="nav-item"><a class="nav-link" href="index.php#section-home">Início</a></li>
                <li class="nav-item"><a class="nav-link" href="index.php#section-features">Conheça mais</a></li>
                <li class="nav-item"><a class="nav-link" href="index.php#section-reviews">Produtos</a></li>
                <li class="nav-item"><a class="nav-link" href="index.php#section-planos">Planos</a></li>
                <li class="nav-item"><a class="nav-link" href="login.html">Acesso restrito</a></li>      
                <li class="nav-item"><a class="nav-link" href="index.php#section-pricing">Contato</a></li>         
                <li class="nav-item"><a class="nav-link" href="https://medium.com/alug-escreve" target="_blank">Blog</a></li>
              </ul>
            </div>
          </div>
        </nav>

            <div class="container" id="modal-conteudo-prod2" style="margin-top:8%" >                                
                
            <form action="#" onsubmit="return confirma_interesse_produto()">
                <div class="row" style="height:auto;">                    
                    <div class="card mb-3"  style="width:100%">
                      <div class="row no-gutters">
                        <div class="col-md-4">
                          <div class="card-body">
                            <i class="fa fa-address-card-o card-img" style="text-align:center; font-size:5em;" aria-hidden="true"></i>
                          </div>
                        </div>
                        <div class="col-md-8">
                          <div class="card-body">
                            <h5 class="card-title" id="nomeprod"><?php echo $nomeprod; ?></h5>
                            <p class="card-text" id="modal-conteudo-itens-prod">Nesse aluguel está incluso: <?php echo $conteudoprod; ?></p>                            
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="card mb-3"  style="width:100%">
                      <div class="row no-gutters">
                        <div class="col-md-4">
                          <div class="card-body">
                            <i class="fa fa-calendar-o card-img" style="text-align:center; font-size:5em;" aria-hidden="true"></i>
                          </div>
                        </div>
                        <div class="col-md-8">
                          <div class="card-body">
                            <h5 class="card-title">Informe o Período</h5>
                            <div class="form-row">
                              <div class="col-6" style="text-align:left">                               
                                <input type="date" placeholder="Alugar de" required class="form-control py-3 reverse" name="dtini" id="dtini" />                             
                              </div> 
                              <div class="col-6">                                    
                                <input type="date" class="form-control py-3 reverse" required placeholder="Alugar até" name="dtfim" id="dtfim" />             
                              </div>
                            </div>                                
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="card mb-3" style="width:100%">
                      <div class="row no-gutters">
                        <div class="col-md-4">
                          <div class="card-body">
                            <i class="fa fa-tags card-img" style="text-align:center; font-size:5em;" aria-hidden="true"></i>
                          </div>
                        </div>                        
                        <div class="col-md-8">
                          <div class="card-body">
                            <h5 class="card-title">Insira seu Cupom</h5>                            
                            <div class="form-group">
                              <input type="text" name="nome" class="form-control py-3 reverse" name="cupom_prod" id="cupom_prod" placeholder="Informe o código do cupom">
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>    
                    <div class="form-group" style="width:100%">
                        <input type="submit" class="btn btn-success btn-lg btn-block pb_btn-pill  btn-shadow-green" value="Quero alugar">
                    </div>  
                </div> 
            </form>             


     <script type="text/javascript">
      function confirma_interesse_produto(){
        //Acionado de dentro da modal de produto
        var dtini = $('#dtini').val();
        var dtfim = $('#dtfim').val();

        var dtini = $('#dtini').val();
        var dtfim = $('#dtfim').val();

        var dtiniformatada = moment(dtini);
        dtiniformatada = dtiniformatada.format("DD/MM");

        var dtfimformatada = moment(dtfim);
        dtfimformatada = dtfimformatada.format("DD/MM");

        var cupom = $('#cupom_prod').val();
        cupom = cupom.replace(/^\s+|\s+$/g,"");   

        var mensagem ="Tenho interesse no produto " + $('#nomeprod').text() + " Para o período: " +dtiniformatada + " a " +dtfimformatada;

        if(cupom){
          mensagem = mensagem + ". Recebi o cupom: "+cupom;
        }else{          
        }        
        //alert(mensagem);
        window.open('https://api.whatsapp.com/send?phone=5546999303401&text='+mensagem,'_blank');
      }

    </script>
                    

       
    <div id="pb_loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#1d82ff"/></svg></div>

    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/flexslides.jquery.min.js"></script>
    <script src="assets/js/moment.js"></script>


    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/slick.min.js"></script>
    <script src="assets/js/jquery.mb.YTPlayer.min.js"></script>

    <script src="assets/js/jquery.waypoints.min.js"></script>
    <script src="assets/js/jquery.easing.1.3.js"></script>
     <script src="assets/js/main.js"></script>

    <script type="text/javascript" src="assets/js/jquery.autocomplete.js"></script>
    <script type="text/javascript" src="assets/js/countries.js"></script>
    <script type="text/javascript" src="assets/js/demo.js"></script>
    <script type="text/javascript" src="assets/js/jquery.mockjax.js"></script>
    <script src="assets/js/jquery.mask.js"></script>




    </body>

</html>