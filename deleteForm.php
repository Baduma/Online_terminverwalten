<!DOCTYPE html>
<html>
	<head>
		<title>Form delete</title>
	</head>
	<body bgcolor="lightblue">
		<form name="form"  align="down"  action="delete.php" method="post" >
			<fieldset>
				<legend>
					<h3>Termin l&ouml;schen</h3>
				</legend>
				Vorgangsnummer: <input type="text" name="id" />
				<input type="hidden" name="vorgang" value="" />
				<input type="submit" name="submit" value="Termin absagen" class="button" />
			</fieldset>
		</form>
	</body>
</html>
	
