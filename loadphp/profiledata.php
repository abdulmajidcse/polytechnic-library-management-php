<!--profile data select-->
<?php
$query = "SELECT * FROM lm_log WHERE id='$userid'";
$query = $db->select($query);
if ($query != false) {
	while ($result = $query->fetch_assoc()) {
		$fname = $result['fname'];
		$sname = $result['sname'];
		$image = $result['image'];
		$uname = $result['uname'];
		$email = $result['email'];
	}
}
?><!--end of profile data select-->