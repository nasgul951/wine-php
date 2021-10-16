

<html>

<head>
<title>Wine Login</title>
<meta name="viewport" content="width=320" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" type="text/css" href="style/other/login.css">
</head>

<body>
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="">
<tr><td align="center" valign="middle">

<form action="process/p_login.php" method="post">
	<div id="div_login">
	<table id="login_table" border="0" cellspacing="0" cellpadding="0">
	<tr><td colspan="2">
		<div id="login_title">Wine Login</div>
	</td></tr>
	
	<tr><td class="login_detail"><div id="lbl_user">User:&nbsp;</div></td>
		<td class="login_detail"><input id="txt_user" type="text" name="user"></td></tr>
	<tr><td class="login_detail"><div id="lbl_pwd">Password:&nbsp;</div></td>
		<td class="login_detail"><input id="txt_pwd" type="password" name="pwd"></td></tr>
	<tr><td class="login_detail" colspan="2" align="right">
		<input id="btn_login" type="submit" value="Login" name="login"></td></tr>
	</table>
	</div>
</form>

</td></tr>
</table>
</body>

</html>
