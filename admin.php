
<?php
	include('config.php');
	
/*---------------- Benutzerdaten auf Uebereinstimmung pruefen--------------------------*/
		
	function pruefe_userdaten(){
	
	if(!empty($_POST['vorgang']) AND $_POST['vorgang'] == 'login'){
		
	/**Ist die $_POST['pname'] oder $_POST['ppasswort'] leer???
	dann Formular zum Ausfüllen anzeigen **/
	if(empty($_POST['pname']) or empty($_POST['ppasswort']))
	{
		echo"<h1>Geben Sie bitte Ihre Logindaten ein!</h1><br><br>";
		include("loginForm.php");
	}
	else
	{
		//Spezielle Zeichen innerhalb eines Strings maskieren
		$pname= mysql_real_escape_string($_POST['pname']); 
		$passwort= mysql_real_escape_string($_POST['ppasswort']);
	
	//Befehle für die MySQL Datenbank
	$abfrage = "select * FROM benutzer where pname='$pname' and ppasswort='$passwort'limit 1";
	
	//Prüfen ob der Benutzer in der Datenbank existiert
	$erg=mysql_query($abfrage);
	$anz=mysql_num_rows($erg);
	
	//Anzahl der gefundenen Einträge überprüfen
	if($anz > 0)
	{
	echo"<h2>Der Login war erfolgreich.</h2>";
	include('admin.html');
	}
	else
	{
		echo"<h2>Die Logindaten sind nicht korrekt.</h2>";
		include("loginForm.php");
	}
	}
}
}
pruefe_userdaten();


/*---------------- Neuer Kalenderwoche erstellen--------------------------*/

	function erzeuge_kalenderwoche(){
		
		if($_POST['vorgang'] == 'anlegen'){
			
			// Variable auf Existenz prüfen
			if(isset($_POST['woche_nummer_an']))
			{
				//String into Integer
				$num = (int)$_POST['woche_nummer_an'];

				//String konkatenieren
				if($num > 9){
					$Kw_to_drop = 'Kw_'.(string)$num;
				}
				else
				{
					$Kw_to_drop = 'Kw_0'.(string)$num;
				}
		// Kalenderwoche auf Existenz prüfen
		if(mysql_num_rows(mysql_query("SHOW TABLES LIKE '".$Kw_to_drop."'"))== 1)
		{
			echo "<h2>Die Kalenderwoche ".$Kw_to_drop." existiert bereit und wird nicht neu angelegt </h2>";
			echo"<h3><a href=\"http://localhost/terminvergabe/admin.html\">Zur&uuml;ck </h3></a>";
		}
		else
		{
			// Tabelle anlegen
			$query = "
			CREATE TABLE `".$Kw_to_drop."` (
			`Termin_ID` INT(20) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
			`Mo` VARCHAR( 200 ) NOT NULL ,
			`Di` VARCHAR( 200 ) NOT NULL ,
			`Mi` VARCHAR( 200) NOT NULL ,
			`Do` VARCHAR( 200) NOT NULL ,
			`Fr` VARCHAR( 200) NOT NULL 
			) 
			";
			$erg=mysql_query($query);
		
			if(!$erg)
				{
					die ("MySQL-Error: " . mysql_error());
				}
				else
				{
					// Datensätze in die Tabelle einfügen
					$query = "
					INSERT INTO `".$Kw_to_drop."` 
					( 
					`Mo` , `Di` , `Mi` , `Do` , 
					`Fr`  
					) 
					VALUES
					(
					'nb', 'nb', 'nb', 'nb' , 'nb'
					);
					";
	        
					for ($i = 1; $i <= 8; $i++) {
					$erg=mysql_query($query);
					if(!$erg)
						{
							die (" Beim Datensatz anlegen :  MySQL-Error: " . mysql_error());
						}
						else
						{
				
						}
				}
		
			echo"<h2><h2>Die Kalenderwoche ".$Kw_to_drop." wurde angelegt.</h2>";
			echo"<h3><a href=\"http://localhost/backend.html\">Zur&uuml;ck </h3></a>";
		}
	}
	}
		}
	}
	erzeuge_kalenderwoche();

	
/*---------------- Kalenderwoche loeschen--------------------------*/

	function delete_kalenderwoche(){
		if($_POST['vorgang'] == 'delete'){
			
			// Variable $_POST['woche_nummer_aus'] auf Existenz prüfen
	if(isset($_POST['woche_nummer_aus']))
	{

		// String to Integer
		$num = (int)$_POST['woche_nummer_aus'];

		if($num > 9)
		{
			// String konkatenieren
			$Kw_to_drop = 'Kw_'.(string)$num;
		}
		else
		{
			$Kw_to_drop = 'Kw_0'.(string)$num;
		}

		// Tabelle auf Existenz prüfen
		if(mysql_num_rows(mysql_query("SHOW TABLES LIKE '".$Kw_to_drop."'"))==1){

		// Tabelle löschen
		$query="drop table ".$Kw_to_drop." ;";
		$erg=mysql_query($query);
		
		if(!$erg)
			{
				die ("MySQL-Error: " . mysql_error());
			}
			else
			{
				echo"<h2><h2>Die Kalenderwoche ".$Kw_to_drop." wurde gelöscht.</h2>";
				echo"<h3><a href=\"http://localhost/terminvergabe/admin.html\">Zur&uuml;ck </h3></a>";
			}
	}
	else
	{
		echo "<h2>Die Kalenderwoche ".$Kw_to_drop." existiert nicht in der Datenbank und kann daher nicht gel&ouml;scht werden</h2>";
		echo"<h3><a href=\"http://localhost/terminvergabe/admin.html\">Zur&uuml;ck </h3></a>";
	}

	}
	}
	}
	delete_kalenderwoche();
	

/*----------------------Termin loeschen-------------------------------*/
	
	function loesche_termin(){
		
		if($_POST['vorgang'] == 'loeschen'){
			
			// Formular valideren
			if(empty($_POST['id'])) 
			{
				echo"<h3>Geben sie bitte Ihre Vorgangsnummer ein.</h3>";
				echo"<h3> <a href=\"http://localhost/terminvergabe/daten_anzeigen.php\">Zur&uuml;ck  </a></h3>";
		}
		else
		{
			// spezielle Zeichen innerhalb eines Strings maskieren
			$id=mysql_real_escape_string($_POST['id']);
	
			// Daten aus der Tabelle terminkalender selektieren
			$query = "select * from terminkalender where id='$id' limit 1 ";
			$erg =mysql_query($query);
			$anz=mysql_num_rows($erg);
	
			//Anzahl der gefundenen Einträge überprüfen
			if($anz > 0)
				{
					//Datensatz löschen
					$query="delete from terminkalender where id='$id' limit 1 ";
					$result=mysql_query($query);
					echo"<h2>Der Datensatz wurde erfolgreich gelöscht.</h2>";
					echo"<h3> <a href=\"http://localhost/terminvergabe/admin.html\">Zur&uuml;ck  </a></h3>";
				}
				else
				{
					echo"<h2>Anfrage fehlgeschlagen-Falsche Vorgangsnummer</h2>";
					echo"<h3> <a href=\"http://localhost/terminvergabe/daten_anzeigen.php\">Zur&uuml;ck  </a></h3>";
				}
			}
		}
	}
	loesche_termin();
	
/*---------------------Termin updaten--------------------------------------*/

	function update_termin(){
		
		if($_POST['vorgang'] == 'updaten'){
			
			// Formularvalidierung
	if(empty($_POST['id'])) 
		{
			echo"<h3>Geben sie bitte Ihre Vorgangsnummer ein.</h3>";
			echo"<h3> <a href=\"http://localhost/terminvergabe/daten_anzeigen.php\">Zur&uuml;ck </a></h3>";
		}
		else
		{
			// spezielle Zeichen innerhalb eines Strings maskieren
			$id=mysql_real_escape_string($_POST['id']);
 
			// Daten aus der Tabelle terminkalender selektieren
			$query="select * from terminkalender where id='$id' limit 1";
			$erg=mysql_query($query);
			$erg=mysql_query($query);
			$anz=mysql_num_rows($erg);
	
			// Anzahl der gefundenen Einträge überprüfen
			if($anz > 0)
				{
					// Gefundener Datensatz einlesen
					while($rows=mysql_fetch_array($erg))
					{
						echo'<form name="form"  align="down" action="admin.php" method="post" enctype="multipart/form-data">';
						echo'<fieldset>';
						echo'<legend>';
						echo'<h3>Termin &aumlndern</h3>';
						echo'</legend>';
						echo'<label>Patientenname:</label>';
						echo'<input type="text" name="patientenname" class="small" value="';
						echo " ".$rows['patientenname'];
						echo'" />';
						echo'<label>Arztname:</label>';
						echo'<input type="text" name="arztname" class="small" value="';
						echo " ".$rows['arztname'];
						echo'" />';
						echo'<label>Email:</label>';
						echo'<input type="text" name="email" class="small" value="';
						echo " ".$rows['email'];;
						echo'" />';
						echo'<label> Aktueller Termin:</label>';
						echo'<input type="text" name="termin" class="small" value="';
						echo " ".$rows['termin'];
						echo'" />';
						echo "<label>";
						echo "Vorgangsnummer:";
						echo "</label>";
						echo'<input type="text" name="id" class="small" value="';
						echo " ".$rows['id'];
						echo'" />';
						echo'<br />';
						echo'<br />';
						echo'<label>Notiz_Patient:</label>';
						echo'<textarea name="notiz_patient" class="small" rows="5" ';
						echo'cols="75" />';
						echo $rows['notiz_patient'];
						echo'</textarea>';
						echo'<br />';
						echo'<br />';
						echo'<input type="submit" name="submit" value="Daten &auml;ndern" class="button" />';
						echo'<input type="hidden" name="vorgang" value="aendern">';
						echo'</fieldset>';
						echo'</form>';
					}
				}
				else
				{ 
					echo"<h3> Falsche Vorgangsnummer</h3>";
					echo"<h3> <a href=\"http://localhost/backend_daten_anzeigen.php\">Zur&uuml;ck </a></h3>";
				}
			}
		}
	}
	update_termin();
	
/*----------------------Daten aktualisieren--------------------*/

	function aendere_daten(){
		
		if($_POST['vorgang'] == 'aendern'){
			
			// Formularvalidierung
			if(isset($_POST['patientenname']) AND isset($_POST['arztname']) AND isset($_POST['email']) AND isset($_POST['termin']) AND isset($_POST['notiz_patient']) AND isset($_POST['id']))
			{
				// Spezielle Zeichen innerhalb eines Strings maskieren
				$id=mysql_real_escape_string($_POST['id']);
				$patientenname= mysql_real_escape_string($_POST['patientenname']);
				$arztname= mysql_real_escape_string($_POST['arztname']);
				$email= mysql_real_escape_string($_POST['email']);
				$termin= mysql_real_escape_string($_POST['termin']);
				$notiz_patient= mysql_real_escape_string($_POST['notiz_patient']);
			
				// Daten updaten
				$sql = "UPDATE terminkalender SET
				patientenname = '$patientenname',
				arztname = '$arztname',
				email = '$email',
				termin = '$termin',
				notiz_patient = '$notiz_patient'
				WHERE
				id = '$id'";
				$erg = mysql_query( $sql );
				// Überprüfen ob die Änderung geklappt hat
				if (!$erg )
				{
					// Fehlermeldung
					die("Ungültige Abfrage:  <hr />" . mysql_error());
				}
				else
				{
					echo "<h2> Ihr Termin wurde erfolgreich ge&auml;ndert !!!</h2>";
					echo"<h3> <a href=\"http://localhost/terminvergabe/admin.html\">Zur&uuml;ck </a></h3>";
				}
			}
			else
			{
				echo "Error";
			}
		}
	}
	aendere_daten();
?>


