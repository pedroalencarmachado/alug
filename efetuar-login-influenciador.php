
<?php


/*$host = "localhost:3306"; 
$username = "alugapp_root"; 
$password = "eclenice123@"; 
$db = "alugapp_alug";
*/

$host = "localhost:8080"; 
$username = "root"; 
$password = ""; 
$db = "alug"; 


session_start();


$login = $_POST['email'];
$senha = $_POST['cpf'];

mysql_connect($host,$username,$password) or die("Impossível conectar ao banco."); 

@mysql_select_db($db) or die("Impossível conectar ao banco"); 

$result=mysql_query("SELECT * FROM influenciador where emailinfluenciador = '$login' and cpfinfluenciador = '$senha'") or die("Impossível executar a query"); 

if(mysql_num_rows($result) > 0){
	$row=mysql_fetch_object($result);
	$_SESSION['logininfluenciador'] = $login;
    $_SESSION['senhainfluenciador'] = $senha;
    $_SESSION['idinfluenciador'] = $row->idinfluenciador;
    $_SESSION['nomeinfluenciador'] = $row->nomeinfluenciador;
     $_SESSION['emailinfluenciador'] = $row->emailinfluenciador;
    echo "<script> window.location.replace('area-assinante/index_influenciador.php') </script>";

}
else{
    unset ($_SESSION['login']);
    unset ($_SESSION['senha']);
    echo "<script> window.location.replace('login.html') </script>";
}

?>