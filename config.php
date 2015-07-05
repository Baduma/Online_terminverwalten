<?php


$HOST="localhost";
$BENUTZER="root";
$KENNTWORT="";
$DATENBANK="webnutzer";


//Datenbankverbindung zu MySQL Server herstellen
$con=mysql_connect($HOST,$BENUTZER,$KENNTWORT,$DATENBANK);

//Verbindung geklappt?
if(!$con)
	{
	die("MySQL-Error: " . mysql_error());
	}
	
//Verbindung zur richtige Datenbank herstellen
$datenbank=mysql_select_db("webnutzer");
if(!$datenbank)
	{
		echo "Kann die Datenbank nicht benutzen";
		mysql_close($con);	//Datenbank schliessen
		exit;				//Programm beenden
	}
	else
	{
		//echo "Die Verbindung wurde erfolgreich hergestellt.";
	}
	
?>