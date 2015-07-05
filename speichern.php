<!DOCTYPE html>
<html>
	<head>
		<title>Daten-speichern</title>
	</head>
	<body bgcolor="lightblue">

		<?php 

			//Verbindung zur Datenbank herstellen	
			include('config.php');

			// Ist die Variable $_POST['vorgang'] nicht leer???	
			if(!empty($_POST['vorgang']))
			{
				// Wert von der Variable $_POST['vorgang'] prüfen
				if ( $_POST['vorgang'] == 'bestaetigen' )
				{
					// function für das Einfügen von Daten	
					function daten_einfügen()
					{
						// Variablen auf Inhalt prüfen
						if(isset($_POST['patientenname']) AND isset($_POST['arztname']) AND isset($_POST['email']) AND isset($_POST['termin']) AND isset($_POST['beschreibung']))
						{
		
							//Spezielle Zeichen innerhalb eines Strings maskieren
							$patientenname= mysql_real_escape_string($_POST['patientenname']);
							$arztname= mysql_real_escape_string($_POST['arztname']);
							$email= mysql_real_escape_string($_POST['email']);
							$termin= mysql_real_escape_string($_POST['termin']);
							$notiz_patient= mysql_real_escape_string($_POST['beschreibung']);
		
							// Wert von der Variable $_POST['$_POST['gebucht_or_not']'] prüfen	
							if($_POST['gebucht_or_not'] == 'belegt')
								{
									echo"<h2>Der Termin konnte nicht gebucht werden. Navigieren Sie bitte auf die Start-Seite zur&uuml;ck und Nehmen Sie bitte einen anderen Termin</h2>";
									echo"<h3> <a href=\"http://localhost/terminvergabe/start.php\">Zur&uuml;ck  </a></h3>";
								}
								else
								{
									//Datensatz in der Tabelle terminkalender einfügen
									$query=" insert into terminkalender
									(id,patientenname,arztname,email,termin,notiz_patient)	
									values
									('','$patientenname','$arztname','$email','$termin','$notiz_patient')";
									$erg=mysql_query($query);
	
									echo"<h2>Der Termin wurde erfolgreich gebucht.</h2>";
									echo"<h3> <a href=\"http://localhost/terminvergabe/start.php\">Zur&uuml;ck zur Startseite </a></h3>";
								}
							}
						}
					}
				daten_einfügen();

			}

		?>
	</body>
<html>
