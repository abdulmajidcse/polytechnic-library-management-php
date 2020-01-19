<!--forgotten password email check-->
<?php
require("phpmailer/PHPMailerAutoload.php");
$mail = new PHPMailer();
if($_SERVER['REQUEST_METHOD'] == "POST"){
	if(empty($_POST['email'])){
		$msg = "<p class='alert alert-warning'>Please, write your valid e-mail address!</p>";
	} else{
		$email = $fm->validation($_POST['email']);
		
		$email = mysqli_escape_string($db->conn, $email);
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$msg = "<p class='alert alert-warning'>Invalid e-mail address!</p>";
		} else {
			$query = "SELECT * FROM lm_log WHERE email='$email' LIMIT 1";
			$query = $db->select($query);
			if ($query != false) {
				$result = mysqli_num_rows($query);
				if ($result > 0) {
					while ($row = $query->fetch_assoc()) {
						$userid = $row['id'];
						$uname = $row['uname'];
						$email = $row['email'];
					}
					$txt = substr($email, 1, 4);
					$rand = rand(100, 99999);
					$newpassword = "$txt$rand";
					$password = sha1(md5($newpassword));
					
					$from = "security@abdulmajid.xyz";
					$subject = "Your Password";
					$message = "Your username is " . $uname . " and new password is " . $newpassword . ". Please, visit website for login.";
					$mail->Host = "smtp.gmail.com";
                    $mail->Port = 587;
                    $mail->SMTPAuth = true;
                    $mail->SMTPSecure = "tls";
                    $mail->SetFrom($from);
                    $mail->Subject = $subject;
                    $mail->Body = $message;
                    $mail->AddAddress($email);
                    if(!$mail->Send()){
                        $msg = "<p class='alert alert-warning'>E-mail not sent!</p>";
                    }else{
                        $query = "UPDATE lm_log
							SET
							password='$password'
							WHERE id='$userid'";
						$query = $db->update($query);
						$msg = "<p class='alert alert-success'>Please, check your e-mail for new password!</p>";
                    }
				} else {
					$msg = "<p class='alert alert-warning'>E-mail adress no match!</p>";
				}
			} else{
				$msg = "<p class='alert alert-warning'>E-mail address no match!</p>";
			}
		}
	}
}
?><!--end of forgotten password email check-->