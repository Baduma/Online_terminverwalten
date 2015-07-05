<!DOCTYPE html>
<html>
	<head>
		<title>Daten&uuml;bersicht</title>
	</head>
	<body bgcolor="lightblue">

	
	<?php

	//Verbindung zur Datenbank herstellen
	require_once('config.php'); 
	
	// Ist die Variable $_POST['termintoserver'] nicht leer???
	if(!empty($_POST['termintoserver']))
	{
		$Woche = $_POST['kwtoserver'];

		// String zerschneiden
		$tag =substr($_POST['termintoserver'],6 ,2);
		$std =substr($_POST['termintoserver'],9 ,5);
		$_set = "nicht_belegt";
		$termin=$Woche ." ".$tag." ".$std;

		// Kalenderwoche auf existenz prüfen 
		if(mysql_query('SELECT * FROM '.$Woche.';')) 
		{

			//Daten aus der Tabelle selektieren
			$query = 'select ' .$tag . ' from ' .$Woche .' where ' .' id = ' .$std . ' ;';
			$erg = mysql_query($query)or die ("MySQL-Error: " . mysql_error());
			//Den gefundenen Datensatz einlesen
			$belegung = mysql_fetch_array($erg);
			echo '<td bgcolor="green" >'.$belegung[$tag].'</td>';

			//Inhalt der Variable $belegung[$tag] prüfen 
			if($belegung[$tag] == 'nb' )
			{ 
				/*Termin nicht belegt
				Daten in der Tabelle ändern*/
				$query='UPDATE '.$Woche.' SET '.$tag.' = \'b\' WHERE id = '.$std.';';
				$erg = mysql_query($query);
					if($erg)
					{
						echo "<p style=\"color: red;\"><b>Pruefen Sie bitte Ihre Angaben und klicken Sie dann auf 'weiter'.</b></p>";
						echo"<hr />";
						echo"<br />";
						require_once('uebersicht.php');
					}
					else
					{
						die ("MySQL-Error: " . mysql_error());
					}
			}
			else
			{
				$_set = "belegt";
				require_once('uebersicht.php');
			}

		}
		else
		{
			echo "<h2>Diese Kalenderwoche existiert nicht. W&auml;hlen Sie bitte eine andere Kalenderwoche aus. </h2>";
			echo "<h2><a href=\"http://localhost/terminvergabe/start.php\">Zur&uuml;ck</a></h2>";
		}

	}
	else
	{
		echo"<h3>Buchung fehlgeschlagen. W&auml;hlen Sie bitte einen Termin aus!</h3>";
		echo"<h3> <a href=\"http://localhost/terminvergabe/start.php\">Zur&uuml;ck  </a></h3>";
	}

		//Datenbankverbindung wieder schliessen
		mysql_close();
	?>

	</body>
</html>