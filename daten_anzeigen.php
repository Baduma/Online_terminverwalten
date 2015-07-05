<html>
	<head>
		<title>Termin absagen</title>
	</head>
	<body bgcolor="lightblue">
	<form name="form"  align="down" action="admin.php" method="post" >
		<fieldset>
		<legend><h3>Termin l&oumlschen </h3></legend>
		Vorgangsnummer: <input type="text" name="id" />
		<input type="hidden" name="vorgang" value="loeschen" />
		<input type="submit" name="submit" value="Termin l&ouml;schen" class="button" />
		</fieldset>
	</form>
	</body>
</html>

<form name="form"  align="down" action="admin.php" method="post" >
	<fieldset>
	<legend><h3>Termin &auml;ndern</h3></legend>
	 Vorgangsnummer: <input type="text" name="id" />
	<input type="hidden" name="vorgang" value="updaten" />
	<input type="submit" name="submit" value="Termin &auml;ndern"  />
	</fieldset>
	</form>
	</body>
    </html>

<?php

	// Verbindung zur Datenbank
	include('config.php');

	// Alle Datensätze aus der Tabelle terminkalender selektieren
	$query="select * from terminkalender ";
	$erg=mysql_query($query);

	//Hat die Abfrage nicht geklappt?
	if ( ! $erg )
		{
			// Fehlermeldung
			die("Ungültige Abfrage: <hr />" . mysql_error());
		}
		else
		{
			echo '<table border="20" cellspacing="4" cellpadding="10 width="80%">';
			echo '<tr>';
			echo '<th bgcolor="white"> Vorgangsnummer </th>';
			echo '<th bgcolor="white"> Patientenname </th>';
			echo '<th bgcolor="white"> Arztname </th>';
			echo '<th bgcolor="white"> Email </th>';
			echo '<th bgcolor="white"> Termin </th>';
			echo '<th bgcolor="white"> Notiz_Patient </th>';
			echo '</tr>';
  
			// gefundene Datensätze einlesen
			while($rows=mysql_fetch_array($erg))
			{
				echo '<tr>';
				echo '<td bgcolor="white">'. $rows['id'] . '</td>';
				echo '<td bgcolor="white">';
				echo  $rows['patientenname'] .'</td>' ;
				echo '<td bgcolor="white">';
				echo $rows['arztname'] .'</td>';  echo '<td bgcolor="white">';
				echo $rows['email'] .'</td>';
				echo '<td bgcolor="white">';
				echo $rows['termin'] .'</td>' ;
				echo '<td bgcolor="white">'. $rows['notiz_patient'] . '</td>';
				echo '</tr>';
			}
			echo '</table>';
		}
 ?>
	 
	
	
	
