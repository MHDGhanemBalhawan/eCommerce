<?php

	include_once 'phpmailer/PHPMailerAutoload.php';
	$errors = [];
	//print_r($_POST);
	if(isset($_POST['name'], $_POST['email'], $_POST['subject'], $_POST['comment'])){
		$fields = [
		'name' => $_POST['name'],
		'email' => $_POST['email'],
		'subject' => $_POST['subject'],
		'comment' => $_POST['comment']
		];
		foreach($fields as $field => $data){
			if(empty($data)){
				$errors[] = 'The '.$field. ' field is required.';
			}

			$_SESSION['fields'] = $fields;
		}
		// send message if there is no errors
		if(empty($errors)){
			$mail = new PHPMailer;

				//$mail->SMTPDebug = 3;                               // Enable verbose debug output
				$mail->isSMTP();                                      // Set mailer to use SMTP
				$mail->Host = 'smtp.gmail.com';  					  // Specify main and backup SMTP servers
				$mail->SMTPAuth = true;                               // Enable SMTP authentication
				// debug
				//$mail->SMTPDebug = 2; // the value could use 1 or 2
				$mail->Username = '';            // SMTP username
				$mail->Password = '';                       // SMTP password
				$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
				$mail->Port = 465;                                    // TCP port to connect to

				$mail->setFrom('from@example.com', 'Mailer');
				$mail->addAddress('', '');     // Add a recipient
				//$mail->addAddress('ellen@example.com');               // Name is optional
				//$mail->addReplyTo('info@example.com', 'Information');
				//$mail->addCC('cc@example.com');
				//$mail->addBCC('bcc@example.com');

				//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
				//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
				$mail->isHTML(true);                                  // Set email format to HTML

				$mail->Subject = 'Contact from Submitted';
				$mail->Body    = 'From: ' .$fields['name']. '(' .$fields['email']. ') <p>' .$fields['subject'].'</p><p>' .$fields['comment'].'</p>';
				//$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
				$mail->FromName = 'Contact';
				$mail->AddReplyTo($fields['email'], $fields['name']);


				 //send email
				if(!$mail->send()) {

					$errors[] = 'Sorry, could not send email. Try again later';
					//echo 'Message could not be sent.';
					//echo 'Mailer Error: ' . $mail->ErrorInfo;
				} else {
					header('Location: thanks.php');
					//echo 'Message has been sent';
				}

		}

	} else{
	//header('Location: contact.php');
		//$errors[] = 'Something went wrong';

	}

	$_SESSION['errors'] = $errors;


?>
