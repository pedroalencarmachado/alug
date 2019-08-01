<?php
	// Destinatário
	$para = "faleconosco@alug.app";

	// Assunto do e-mail
	$assunto = "Mensagem através do site";

	// Campos do formulário de contato
	$nome = $_POST['nome'];
	$email = $_POST['email'];	
	$mensagem = $_POST['mensagem'];

	// Monta o corpo da mensagem com os campos
	$corpo = "<html><body>";
	$corpo .= "Nome: $nome ";
	$corpo .= "Email: $email Mensagem: $mensagem";
	$corpo .= "</body></html>";

	// Cabeçalho do e-mail
	$email_headers = implode("\n", array("From: $nome", "Reply-To: $email", "Subject: $assunto", "Return-Path: $email", "MIME-Version: 1.0", "X-Priority: 3", "Content-Type: text/html; charset=UTF-8"));

	//Verifica se os campos estão preenchidos para enviar então o email
	if (!empty($nome) && !empty($email) && !empty($mensagem)) {
	    mail($para, $assunto, $corpo, $email_headers);
	    $msg = "Obrigado pelo seu contato. Fique ligado que em breve terá mais notícias.";
	    echo "<script>alert('$msg');window.location.assign('http://www.alug.app');</script>";
	} else {
	    $msg = "Ooops. Encontramos dificuldades para enviar sua mensagem. Tente novamente mais tarde.";
	    echo "<script>alert('$msg');window.location.assign('http://www.alug.app');</script>";
	}

?>