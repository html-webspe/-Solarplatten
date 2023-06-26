<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    
    require 'phpmailer/src/Exception.php';
    require 'phpmailer/src/PHPMailer.php';
    require 'phpmailer/src/SMTP.php';
    
    $mail = new PHPMailer(true);
    $mail->CharSet = 'UTF-8';
    $mail->setLanguage('ru', 'phpmailer/language/');
    $mail->isSMTP();                                     // Отправка через SMTP

    $mail->Host = 'mail.adm.tools';                      // SMTP-сервер для отправки писем
    $mail->SMTPAuth = true;                              // Включение аутентификации SMTP
    $mail->Username = 'info@bveducation.com.ua';          // Логин SMTP
    $mail->Password = '221BBakerstreetinl';              // Пароль SMTP
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;      // Включение шифрования TLS или SSL
    $mail->Port = 465;                                   // Порт SMTP
    
    $mail->setFrom('info@bveducation.com.ua');           // Отправитель письма
    $mail->addAddress('andreypbiz@gmail.com');            // Получатель письма
    $mail->isHTML(true);                                 // Отправка письма в формате HTML
    $mail->Subject = 'Calculate';                         // Тема письма
    
    // Получение данных из формы
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $sizeEstate = $_POST["sizeEstate"];
        $electricBill = $_POST["electricBill"];
        $typeRoof = $_POST["typeRoof"];
        $sizeRoof = $_POST["sizeRoof"];
        $budgetPanel = $_POST["budgetPanel"];
        $financingOptions = $_POST["financingOptions"];
    
        $name = $_POST["name"];
        $phone = $_POST["phone"];
        $email = $_POST["email"];
        $adress = $_POST["sity"];
    
        // Формирование содержимого письма
        $body = '';
        $body .= '<p><b>sizeEstate:</b> ' . $sizeEstate . '</p>';
        $body .= '<p><b>electricBill:</b> ' . $electricBill . '</p>';
        $body .= '<p><b>typeRoof:</b> ' . $typeRoof . '</p>';
        $body .= '<p><b>sizeRoof:</b> ' . $sizeRoof . '</p>';
        $body .= '<p><b>budgetPanel:</b> ' . $budgetPanel . '</p>';
        $body .= '<p><b>financingOptions:</b> ' . $financingOptions . '</p>';
    
        $body .= '<p><b>Name:</b> ' . $name . '</p>';
        $body .= '<p><b>Phone:</b> ' . $phone . '</p>';
        $body .= '<p><b>Email:</b> ' . $email . '</p>';
        $body .= '<p><b>Sity:</b> ' . $adress . '</p>';
    
        $mail->Body = $body;
            // Отправка письма
        try {
            $mail->send();
            $message = 'Данные отправлены!';
        } catch (Exception $e) {
            $message = 'Ошибка при отправке данных: ' . $mail->ErrorInfo;
        }
    
        $response = ['message' => $message];
    
        header('Content-type: application/json');
        echo json_encode($response);
    }
?>
