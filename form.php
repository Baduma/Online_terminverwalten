<!DOCTYPE html>
<html>
	<head>
		<title>patient-Form</title>
	</head>
	<body bgcolor="lightblue">
		<hr>
		<p>Pers&ouml;nliche Daten <br/>Die mit * gekennzeichneten Feldern sind Pflicht.</p>
		<hr>
		<h2>1.Patientenformular</h2>

<script type="text/javascript">
	function checkFormular(){
	
	if (document.Formular.patientenname.value == "") {
		alert("Geben Sie bitte Ihren Namen ein!");
		document.Formular.patientenname.focus();
		return false;
	}
	if (document.Formular.email.value.indexOf("@") == -1) {
		alert("Keine E-Mail-Adresse. Geben Sie bitte Ihre E-Mail-Adresse ein!");
		document.Formular.email.focus();
		return false;
	}
  }
  
</script>

	<form action="calender.php" onsubmit=" return checkFormular()" name="Formular" method="post">
		<table width="100%">
			<tr>
				<td align="right"><label for="name">Patientenname*</label></td>
				<td><input type="text" id="patientenname" name="patientenname" size="30" /></td></tr>
							
			<tr>
				<td align="right"><label for="email">E-mail*</label></td>
				<td><input type="text" id="email" name="email" size="30" /></td></tr>
			
			<tr>
				<td align="right" valign="top"><label for="symptome">Notiz_patient </label></td>
				<td><textarea name="beschreibung" id="beschreibung" cols="30" rows="5"></textarea></td></tr>
								
			<tr>
				<td>     </td>
				<input type="hidden" name="vorgang" value="neu" />
				<td><INPUT TYPE="button" VALUE="Zur&uuml;ck" onClick="history.back()">
				<input type="submit" name="Abschicken" id="Abschicken" value="Weiter" /></td>
			
				 </tr>
	</table>
			
	</form>
	</body>
	</html>			
