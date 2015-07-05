

<html>
<head>
<title>Terminkalender</title> </head>
<body>
<h2>2.Terminauswahl</h2>
<p><b>Wählen Sie bitte den passenden Termin aus.</b></p>
<hr>
<script type="text/javascript">

var last_clicked = 'start';
var Woche = 1;


<?php

function kw_2_date ($jahr, $monat, $tag, $kw, $anfang_ende ){
    
	 
    $erst = mktime(0, 0, 0, $monat, $tag ,$jahr);
	$wte=date("w",$erst);

	if($wte==0){ 
	$kw1=$erst+86400;
	}
	 
	elseif($wte > 4) $kw1=$erst+((8-$wte)*86400);

	else $kw1=$erst-(($wte-1)*86400);


	$kws=$kw1+(($kw-1)*604800);
	$kwe=$kws+604799;
	
	if($anfang_ende == 1)
	{
		$result = substr(date(DATE_ATOM, $kws),0,10);
	}
	else {
	    $result = substr(date(DATE_ATOM, $kwe),0,10);
	}

    return $result;
}

?>

<?php

$Woche = $_POST['kwtoserver'];
$Kw_Woche = substr($Woche,3,2); 

$num = (int)$Kw_Woche;
$direction = $_POST['richtung'];

if($direction == 'prev' )
{
	if($num > 1){
	  $num--;
	}
	
}
if($direction == 'next')
{ 
    if( $num < 52){
	   $num++;
	}
     
}

if($num > 9){
	$Kw_Woche_updated = substr($_POST['kwtoserver'], 0,3).(string)$num;

}
else{
	$Kw_Woche_updated = substr($_POST['kwtoserver'], 0,3).'0'.(string)$num;

}


?>



function Terminfeldsetzen (event) {
	// param = param || window.event;
	//window.alert(event.target.id+"*"+event.target.innerHTML);
	
   if(Woche < 10){
	   document.getElementById("termin").value = 'Kw_0'+Woche.toString()+'_'+event.target.id;
	   
   }
   else{
       document.getElementById("termin").value = 'Kw_'+Woche.toString()+'_'+event.target.id;
   }
	 
	if(last_clicked != 'start'){
		document.getElementById(last_clicked).style='background-color: white';
	}
	 
	last_clicked = event.target.id;
	event.target.style='background-color: blue';

	}
	
function hintergrundGelb(event) {
    
	if(event.target.id != last_clicked){
		event.target.style='background-color: yellow';
	}
}

function hintergrundWeiss(event) {

    if(event.target.id != last_clicked){
		event.target.style='background-color: white';
	}

}
function nextWeek()
{

  document.getElementById("vor_prev").value = "next";
  document.getElementById("myform").action = "update.php"; 
  document.getElementById("myform").submit();
  
}

function prevWeek()
{

  document.getElementById("vor_prev").value = "prev";
  document.getElementById("myform").action = "update.php"; 
  document.getElementById("myform").submit();
  
}

</script>

<form action="terminvereinbaren.php" id = 'myform' method="post">  

<p >

<h3>2.Arztauswahl</h3>

	<select  name="arztname">
	<option>Auswahl</option>
	<optgroup label="Cardiologues" >
	<option>Dr. Douala Eric</option>
	<option>Dr. Maloko Francis</option></optgroup>
	<optgroup label="Dermatologues">
	<option >Dr. Essono Martin</option>
	<option >Dr. Mabola Féfé</option></optgroup>
	
	</select>
</p>
<br /><br /><br />
<table border=1 id='calendar'>
		<!--<tr style='visibility:collapse;' hidden>
			<td colspan=7 id='date_memory'>---</td>
		</tr>-->
		<tr>
			<td class='calendar_head' align="center" ><a class='calendar_link' onclick="prevweek()" 
				href='javascript:prevWeek()'> &laquo;</a></td>
			<th colspan=3 style='background-color: lightblue' class='calendar_head_week' id='calendar_week'>
				   <?php echo $Kw_Woche_updated; ?></th>
			<td class='calendar_head' align="center"><a class='calendar_link' onclick="nextweek()" 
				href='javascript:nextWeek()'> &raquo;</a></td>
		</tr>
		<tr><td colspan=2 >Start<br /><?php echo kw_2_date(2014,1,1, $num, 1);?></td> <td ></td>
		
		<td colspan=2>Ende<br /><?php echo kw_2_date(2014,1,1, $num, 0);?></td>
			
		
		<tr>
			<th class='calendar_day'>Mo</th>
			<th class='calendar_day'>Di</th>
			<th class='calendar_day'>Mi</th>
			<th class='calendar_day'>Do</th>
			<th class='calendar_day'>Fr</th>
			
			
		</tr>
		<tr>
			<td class='calendar_entry' id='Mo_1'  onclick="Terminfeldsetzen(event)" onMouseover = "hintergrundGelb(event)" onMouseout = "hintergrundWeiss(event)" >09-10</td>
			<td class='calendar_entry' id='Di_1'  onclick="Terminfeldsetzen(event)" onMouseover = "hintergrundGelb(event)" onMouseout = "hintergrundWeiss(event)" >09-10</td>
			<td class='calendar_entry' id='Mi_1'  onclick="Terminfeldsetzen(event)" onMouseover = "hintergrundGelb(event)" onMouseout = "hintergrundWeiss(event)" >09-10</td>
			<td class='calendar_entry' id='Do_1'  onclick="Terminfeldsetzen(event)" onMouseover = "hintergrundGelb(event)" onMouseout = "hintergrundWeiss(event)" >09-10</td>
			<td class='calendar_entry' id='Fr_1'  onclick="Terminfeldsetzen(event)" onMouseover = "hintergrundGelb(event)" onMouseout = "hintergrundWeiss(event)" >09-10</td>
			
			
		<tr>
			<td class='calendar_entry' id='Mo_2'  onclick="Terminfeldsetzen(event)" onMouseover = "hintergrundGelb(event)" onMouseout = "hintergrundWeiss(event)">10-11</td>
			<td class='calendar_entry' id='Di_2'  onclick="Terminfeldsetzen(event)" onMouseover = "hintergrundGelb(event)" onMouseout = "hintergrundWeiss(event)">10-11</td>
			<td class='calendar_entry' id='Mi_2'  onclick="Terminfeldsetzen(event)" onMouseover = "hintergrundGelb(event)" onMouseout = "hintergrundWeiss(event)">10-11</td>
			<td class='calendar_entry' id='Do_2'  onclick="Terminfeldsetzen(event)" onMouseover = "hintergrundGelb(event)" onMouseout = "hintergrundWeiss(event)">10-11</td>
			<td class='calendar_entry' id='Fr_2'  onclick="Terminfeldsetzen(event)" onMouseover = "hintergrundGelb(event)" onMouseout = "hintergrundWeiss(event)">10-11</td>
		</tr>
		
		<tr> 
			<td class='calendar_entry' id='Mo_3'  onclick="Terminfeldsetzen(event)" onMouseover = "hintergrundGelb(event)" onMouseout = "hintergrundWeiss(event)">11-12</td>
			<td class='calendar_entry' id='Di_3'  onclick="Terminfeldsetzen(event)" onMouseover = "hintergrundGelb(event)" onMouseout = "hintergrundWeiss(event)">11-12</td>
			<td class='calendar_entry' id='Mi_3'  onclick="Terminfeldsetzen(event)" onMouseover = "hintergrundGelb(event)" onMouseout = "hintergrundWeiss(event)">11-12</td>
			<td class='calendar_entry' id='Do_3'  onclick="Terminfeldsetzen(event)" onMouseover = "hintergrundGelb(event)" onMouseout = "hintergrundWeiss(event)">11-12</td>
			<td class='calendar_entry' id='Fr_3'  onclick="Terminfeldsetzen(event)" onMouseover = "hintergrundGelb(event)" onMouseout = "hintergrundWeiss(event)">11-12</td>
		</tr>
		
		<tr>
			<td class='calendar_entry' id='Mo_4'  onclick="Terminfeldsetzen(event)" onMouseover = "hintergrundGelb(event)" onMouseout = "hintergrundWeiss(event)">12-13</td>
			<td class='calendar_entry' id='Di_4'  onclick="Terminfeldsetzen(event)" onMouseover = "hintergrundGelb(event)" onMouseout = "hintergrundWeiss(event)">12-13</td>
			<td class='calendar_entry' id='Mi_4'  onclick="Terminfeldsetzen(event)" onMouseover = "hintergrundGelb(event)" onMouseout = "hintergrundWeiss(event)">12-13</td>
			<td class='calendar_entry' id='Do_4'  onclick="Terminfeldsetzen(event)" onMouseover = "hintergrundGelb(event)" onMouseout = "hintergrundWeiss(event)">12-13</td>
			<td class='calendar_entry' id='Fr_4'  onclick="Terminfeldsetzen(event)" onMouseover = "hintergrundGelb(event)" onMouseout = "hintergrundWeiss(event)">12-13</td>
					
		</tr>
		
		
		<tr>
			<td class='calendar_entry' id='Mo_5'  onclick="Terminfeldsetzen(event)" onMouseover = "hintergrundGelb(event)" onMouseout = "hintergrundWeiss(event)">13-14</td>
			<td class='calendar_entry' id='Di_5'  onclick="Terminfeldsetzen(event)" onMouseover = "hintergrundGelb(event)" onMouseout = "hintergrundWeiss(event)">13-14</td>
			<td class='calendar_entry' id='Mi_5'  onclick="Terminfeldsetzen(event)" onMouseover = "hintergrundGelb(event)" onMouseout = "hintergrundWeiss(event)">13-14</td>
			<td class='calendar_entry' id='Do_5'  onclick="Terminfeldsetzen(event)" onMouseover = "hintergrundGelb(event)" onMouseout = "hintergrundWeiss(event)">13-14</td>
			<td class='calendar_entry' id='Fr_5'  onclick="Terminfeldsetzen(event)" onMouseover = "hintergrundGelb(event)" onMouseout = "hintergrundWeiss(event)">13-14</td>

		</tr>

		<tr>
			<td class='calendar_entry' id='Mo_6'  onclick="Terminfeldsetzen(event)" onMouseover = "hintergrundGelb(event)" onMouseout = "hintergrundWeiss(event)">14-15</td>
			<td class='calendar_entry' id='Di_6'  onclick="Terminfeldsetzen(event)" onMouseover = "hintergrundGelb(event)" onMouseout = "hintergrundWeiss(event)">14-15</td>
			<td class='calendar_entry' id='Mi_6'  onclick="Terminfeldsetzen(event)" onMouseover = "hintergrundGelb(event)" onMouseout = "hintergrundWeiss(event)">14-15</td>
			<td class='calendar_entry' id='Do_6'  onclick="Terminfeldsetzen(event)" onMouseover = "hintergrundGelb(event)" onMouseout = "hintergrundWeiss(event)">14-15</td>
			<td class='calendar_entry' id='Fr_6'  onclick="Terminfeldsetzen(event)" onMouseover = "hintergrundGelb(event)" onMouseout = "hintergrundWeiss(event)">14-15</td>
		</tr>
		
		<tr>
			<td class='calendar_entry' id='Mo_7'  onclick="Terminfeldsetzen(event)" onMouseover = "hintergrundGelb(event)" onMouseout = "hintergrundWeiss(event)">15-16</td>
			<td class='calendar_entry' id='Di_7'  onclick="Terminfeldsetzen(event)" onMouseover = "hintergrundGelb(event)" onMouseout = "hintergrundWeiss(event)">15-16</td>
			<td class='calendar_entry' id='Mi_7'  onclick="Terminfeldsetzen(event)" onMouseover = "hintergrundGelb(event)" onMouseout = "hintergrundWeiss(event)">15-16</td>
			<td class='calendar_entry' id='Do_7'  onclick="Terminfeldsetzen(event)" onMouseover = "hintergrundGelb(event)" onMouseout = "hintergrundWeiss(event)">15-16</td>
			<td class='calendar_entry' id='Fr_7'  onclick="Terminfeldsetzen(event)" onMouseover = "hintergrundGelb(event)" onMouseout = "hintergrundWeiss(event)">15-16</td>
		</tr>
		
		<tr>
			<td class='calendar_entry' id='Mo_8'  onclick="Terminfeldsetzen(event)" onMouseover = "hintergrundGelb(event)" onMouseout = "hintergrundWeiss(event)">16-17</td>
			<td class='calendar_entry' id='Di_8'  onclick="Terminfeldsetzen(event)" onMouseover = "hintergrundGelb(event)" onMouseout = "hintergrundWeiss(event)">16-17</td>
			<td class='calendar_entry' id='Mi_8'  onclick="Terminfeldsetzen(event)" onMouseover = "hintergrundGelb(event)" onMouseout = "hintergrundWeiss(event)">16-17</td>
			<td class='calendar_entry' id='Do_8'  onclick="Terminfeldsetzen(event)" onMouseover = "hintergrundGelb(event)" onMouseout = "hintergrundWeiss(event)">16-17</td>
			<td class='calendar_entry' id='Fr_8'  onclick="Terminfeldsetzen(event)" onMouseover = "hintergrundGelb(event)" onMouseout = "hintergrundWeiss(event)">16-17</td>
		</tr><br />
		</table><br />
		
		<input type="hidden"  id="termin" name="termintoserver" value="hallo" />
		<input type="hidden"  id="kw" name="kwtoserver"  value= "<?php echo $Kw_Woche_updated; ?>"  />
		<input type="hidden"  id="vor_prev" name="richtung" value="hallo" />
		<input type="submit" name="Absenden" value="Termin buchen" style="background-color:skyblue" />
		
		
		
		<!--<input type="hidden"  name="vorgang" value="verwalten" />-->
		<input type="hidden"   name="patientenname" value="<?php if(isset($_POST['patientenname'])){ echo $_POST['patientenname'];} ?>" />
		<input type="hidden"   name="email" value="<?php if(isset($_POST['email'])){ echo $_POST['email'];} ?>" />
		<input type="hidden"   name="beschreibung" value="<?php if(isset($_POST['beschreibung'])){ echo $_POST['beschreibung'];} ?>" />
	
		
	
</form>


</body>
</html>