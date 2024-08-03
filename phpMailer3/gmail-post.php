<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'libmail/vendor/autoload.php';
if (isset($_POST['enviar'])) {
    
    //chamando a classe do phpmailer (criando objeto)
    $mail = new PHPMailer(true);

    try {
        
        //$mail->SMTPDebug = SMTP::DEBUG_SERVER; // obtendo infomações do servidor para saber se ou qual tipo de erro ocorreu                      //Enable verbose debug output
        $mail->isSMTP(); //chamando função do phpmailer   
                                                
        $mail->Host       = 'smtp.gmail.com';                     //informação SMTP do site de hospedagem
        $mail->SMTPAuth   = true;                                   //habilitando autenticação SMTP

        $mail->Username   = 'wisebowildbo@gmail.com';                     //Seu Email
        $mail->Password   = 'vazio';                           //Senha de app criada no gmail apos criar a autenticação de 2 fatores (so existe essa atualmente)
        
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //O remetente da mensagem (email, nome)
        $mail->setFrom('wisebowildbos@gmail.com', 'Deivide');
        
        //Para quem estou enviando
        $mail->addAddress('grupodevs77130s@gmail.com', 'GrupoDevs');     
        //$mail->addReplyTo('info@example.com', 'Information');  // para quem será enviado o email de resposta (caso responda ao email)
        //$mail->addAddress('ellen@example.com');               //adicionando mais um email que ira receber a mensagem (o nome é opicional)
        //$mail->addCC('cc@example.com');                       //copia de email
        //$mail->addBCC('bcc@example.com');                     //com copia oculta

        //para adicionar anexo ao email
        //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
        //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

        //Content
        $mail->isHTML(true);                                  //enviando email no formato de HTML
        $mail->Subject = 'Testando PHP mailer';               //assunto do email
        
        $body = "Mensagem enviada através do site, segue informações abaixo:<br>
                Nome:". $_POST['name'] . "<br>
                Email:" . $_POST['email'] . "<br>
                Mensagem:". $_POST['assunto'] . "<br>";
        
        $mail->Body    = $body; // Mensagem ou texto dentro do email
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients'; // enviando em texto limpo

        $mail->send();
        echo 'Email enviado com sucesso!';
    } catch (Exception $e) {
        echo "Mensagem nao enviada. Mailer Error: {$mail->ErrorInfo}";
    }
}else{
    echo "tu nao mandou essa bagaça pelo botao brother";
}

?>