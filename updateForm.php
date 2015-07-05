<!DOCTYPE html>
<html>
	<head>
		<title>Form update</title>
	</head>
	<body bgcolor="lightblue">
		<form name="form"  align="down" action="frontend_termin_anzeigen.php" method="POST" >
			<fieldset>
				<legend>
					<h3>Termin &auml;ndern</h3>
				</legend>
				Vorgangsnummer: <input type="text" name="id" />
				<input type="hidden" name="vorgang" value="löschen" />
				<input type="submit" name="submit" value="Daten zum &Auml;ndern anzeigen" class="button" />
			</fieldset>
		</form>
	</body>
</html>