<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Admin-Login</title>
	</head>
	<body bgcolor="lightblue">
	
		<hr>
		<h1 align="middle">Login(Admin)</h1><br /><br />
		<form action="admin.php" method="post" >
		<table width="100%">
			<tr>
				<td align="right">
					<label for="pname">Nutzername:</label>
				</td>
				<td>
					<input type="text" name="pname" maxlenght="20" required />
				</td>
			</tr>
			
			<tr>
				<td align="right">
					<label for="ppasswort">Passwort:</label>
				</td>
				<td>
					<input type="password" name="ppasswort" maxlength="20" required />
				</td>
			</tr>
			<tr>
				<td>     </td>
				<td>
					<input type="submit" name="Abschicken" value="Anmelden" />
					<input type="hidden" name="vorgang" value="login">
				</td>
			</tr>
				
		</table>
		</form>
		<hr>
	</body>
</html>
	

