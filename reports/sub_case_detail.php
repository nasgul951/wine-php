<?php	include("../security/login_check.php");
		include("process/p_inc_case_detail.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Untitled Document</title>
<link rel="stylesheet" type="text/css" href="style/bin_detail.css">
<script src="script/bin_detail.js"></script>
</head>

<body>
<?php 
	include("sub_bottle_list.php");
?>

<form name="frmMain" action="sub_case_detail.php" method="post">
	<input type="hidden" name="case_no" value="">
</form>
</body>
</html>
