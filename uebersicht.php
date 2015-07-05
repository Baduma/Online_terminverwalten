
<!DOCTYPE html>
<html>
	<head>
		<title>Daten&uuml;bersicht</title>
	</head>

	<body bgcolor="lightblue">

		<h2>3.Daten&uuml;bersicht</h2>
		<form action="speichern.php" onsubmit=" return checkFormular()" name="Formular" method="post">
		<table width="100%">
		
			<tr>
				<td align="right"><label for="patientenname">Patientenname</label></td>
				<td><input type="text" id="patientenname" name="patientenname" value="<?php echo $_POST['patientenname']; ?>" size="30" /></td></tr>
			<tr>
			<tr>
				<td align="right"><label for="arztname">Arztname*</label></td>
				<td><input type="text" id="arztname" name="arztname" value="<?php if(isset($_POST['arztname'])){ echo $_POST['arztname'];} ?>" size="30" /></td></tr>
			 <tr>
				<td align="right"><label for="arztname">Email</label></td>
				<td><input type="text" id="email" name="email" value="<?php if(isset($_POST['email'])){ echo $_POST['email'];} ?>" size="30" /></td></tr>
			 
			<tr>
				<td align="right"><label for="termin">Termin</label></td>
				<td><input type="text" id="termin" name="termin" value="<?php echo $termin; ?>" size="30" /></td></tr>
			
			<tr>
				<td align="right" valign="top"><label for="beschreibung">Notiz_patient </label></td>
				<td><textarea name="beschreibung" id="beschreibung" cols="30" rows="5"><?php echo $_POST['beschreibung']; ?></textarea></td></tr>
						
			<tr>
				<td>     </td>
				<td>
				<input type="hidden" name="gebucht_or_not" value="<?php echo $_set; ?>" />
				<input type="hidden" name="vorgang" value="bestaetigen" />
				<INPUT TYPE="button" VALUE="Zurueck" onClick="history.back()"> 
				<input type="submit" name="Abschicken" id="Abschicken" value="Weiter" /></td>
			
				 </tr>
	</table>
			<tr><td><hr></td> </tr>
	</form>
	
	</body>
	</html>