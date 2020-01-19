<?php
	include("../config/config.php");
	include("../lib/Database.php");
	include("../format/Format.php");
	require("../phpmailer/PHPMailerAutoload.php");

	$mail = new PHPMailer();
	$db = new Database();
	$fm = new Format();

	if (isset($_POST['uname']) && $_POST['uname'] != NULL && isset($_POST['email']) && $_POST['email'] != NULL && isset($_POST['totalfine']) && $_POST['totalfine'] != NULL) {
		$uname = $fm->validation($_POST['uname']);
		$email = $fm->validation($_POST['email']);
		$totalfine = $fm->validation($_POST['totalfine']);

		$uname = mysqli_escape_string($db->conn, $uname);
		$email = mysqli_escape_string($db->conn, $email);
		$totalfine = mysqli_escape_string($db->conn, $totalfine);

		$query = "SELECT fine FROM lm_fine";
		$query = $db->select($query);
		if ($query != false) {
		  $tfine = 0;
		  while ($result = $query->fetch_assoc()) {
		  	$tfine += $result['fine'];
		  }
		  if ($totalfine == $tfine) {
		  	$txt = substr(time(), 1, 4);
			$rand = rand(100, 99999);
			$newcode = "$txt$rand";

		  	$from = "security@abdulmajid.xyz";
					$subject = "Your verification code";
					$message = "Your username is " . $uname . " and verification code is " . $newcode;
					$mail->Host = "smtp.gmail.com";
                    $mail->Port = 587;
                    $mail->SMTPAuth = true;
                    $mail->SMTPSecure = "tls";
                    $mail->SetFrom($from);
                    $mail->Subject = $subject;
                    $mail->Body = $message;
                    $mail->AddAddress($email);
                    if(!$mail->Send()){
                        $msg = "<p class='alert alert-warning'>Verification code not sent!</p>";
                        echo $msg;
                    }else{
						$msg = "<p class='alert alert-success'>Please, check your e-mail for verification code!</p>";

						$del = "DELETE FROM lm_fine_verification";
						$del = $db->delete($del);

						$query = "INSERT INTO lm_fine_verification(uname, email, code) VALUES('$uname', '$email', '$newcode')";
						$query = $db->insert($query);
						echo $msg; ?>

						<script type="text/javascript">
							$('#finesubmit').hide();
							$('#finesubmitConfirm').css('display', 'block');
						</script>

           <?php    }
		  }
		} else {
			$msg = "<p class='text-warning'>Something went wrong!</p>";
			echo $msg;
		}
	} elseif (isset($_POST['finesubmitCode']) && $_POST['finesubmitCode'] != NULL) {
		$vcode = $fm->validation($_POST['finesubmitCode']);

		$vcode = mysqli_escape_string($db->conn, $vcode);
		$query = "SELECT code FROM lm_fine_verification WHERE code='$vcode'";
		$query = $db->select($query);
		if ($query != false) {
			//select data 
			$selectdata = "SELECT uname, email FROM lm_fine_verification WHERE code='$vcode'";
			$selectdata = $db->select($selectdata);
			while ($result = $selectdata->fetch_assoc()) {
				$uname = $result['uname'];
				$email = $result['email'];
			}

			$userdata = "SELECT fname, sname, mobile, department, designation FROM lm_user WHERE uname='$uname'";
			$userdata = $db->select($userdata);
			while ($getuserdata = $userdata->fetch_assoc()) {
				$name = $getuserdata['fname'] . " " . $getuserdata['sname'];
				$mobile = $getuserdata['mobile'];
				$department = $getuserdata['department'];
				$designation = $getuserdata['designation'];
			}

			$getfine = "SELECT fine FROM lm_fine";
			$getfine = $db->select($getfine);
			$totalfine = 0;
			while ($resultfine = $getfine->fetch_assoc()) {
				$totalfine += $resultfine['fine'];
			}
			$fine = $totalfine;
			$submitteddate = date("Y-m-d");


			$finedatainsert = "INSERT INTO lm_finesubmit(name, mobile, email, department, designation, submitteddate, amount) VALUES('$name', '$mobile', '$email', '$department', '$designation', '$submitteddate', '$fine')";
			$finedatainsert = $db->insert($finedatainsert);
			
			$del_fine_verification = "DELETE FROM lm_fine_verification";
			$del_fine_verification = $db->delete($del_fine_verification);

			$del_fine = "DELETE FROM lm_fine";
			$del_fine = $db->delete($del_fine);
			
			$msg = "<span class='text-success'>Success!</span>";
			echo $msg; ?>
			<script type="text/javascript">
				alert("Success!");
				window.location = 'overduefine.php';
			</script>
  <?php } else {
			$msg = "<span class='text-danger'>Wrong!</span>";
			echo $msg;
		}
	}
?>