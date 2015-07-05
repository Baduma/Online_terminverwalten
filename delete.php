<?php 

// Verbindung zur Datenbank herstellen
include('config.php');

//Ist die Variable $_POST['id']?
if(empty($_POST['id'])) 
{
	echo"<h3>Geben sie bitte Ihre Vorgangsnummer ein.</h3>";
	echo"<h3> <a href=\"http://localhost/terminvergabe/deleteForm.php \">Zur&uuml;ck  </a></h3>";
}
else
{
	//Spezielle Zeichen innerhalb eines String prüfen	
	$id=mysql_real_escape_string($_POST['id']);
	// Daten aus der Tabelle terminkalender selektieren
	$query = "select * from terminkalender where id='$id' limit 1 ";
	$erg =mysql_query($query);
	$anz=mysql_num_rows($erg);
	//Die Anzahl der gefundenen Einträge überprüfen 
	if($anz > 0)
	{
		// Datensatz löschen
		$query="delete from terminkalender where id='$id' limit 1 ";
		$result=mysql_query($query);
		echo"<h2>Der Datensatz wurde erfolgreich gel&ouml;scht.</h2>";
	    echo"<h3> <a href=\"http://localhost/menu1.html\">Zur&uuml;ck zur Startseite  </a></h3>";
	}
		else
		{
			echo"<h2>Anfrage fehlgeschlagen-Falsche Vorgangsnummer</h2>";
			echo"<h3> <a href=\"http://localhost/terminvergabe/deleteForm.php\">Zur&uuml;ck  </a></h3>";
		}
	  
}
?>
