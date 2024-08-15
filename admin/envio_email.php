<?php
$email = $_POST['email'];
$mensagem = $_POST['mensagem'];
require'../PHPMailer/PHPMailerAutoload.php';

$mail = new PHPMailer;
$mail->isSMTP();

// configurações do servidor de email
$mail->Host = "smtp.gmail.com";
$mail->Port = "587";
$mail->SMTPSecure = "tls";
$mail->SMTPAuth = "true";
$mail->Username = "antoniocarlosdasilvaalves699@gmail.com";
$mail->Password = "31032007";

$mail->setForm($mail->Username,"Antonio Carlos");
$mail->addAdress(""); // destinatario
$mail->Subject = "Fala conosco"; // assunto do email

$conteudo_email = "
Você recebeu uma mensagem da churrascaria chuleta quente ($email):
<br><br>
Mensagem:<br>
$mensagem
";
$mail->IsHTML(true);
$mail->Body = $conteudo_email;

if ($mail->send()){
    echo "Email enviado com sucesso!!";
} else{
    echo "Falha ao enviar o email:".$mail->ErrorInfo;
}
?>