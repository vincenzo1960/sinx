<?php
/*======================================================================+
 File name   : conf_mod_pnota.php
 Begin       : 2010-08-04
 Last Update : 2011-04-08

 Description : confirmation and control
	       data insered

 Author: Sergio Capretta

 (c) Copyright:
               Sergio Capretta
             
               ITALY
               www.sinx.it
               info@sinx.it

Sinx for Association - Gestionale per Associazioni no-profit
    Copyright (C) 2011 by Sergio Capretta

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.
=========================================================================+*/
session_start();
$user = $_SESSION['utente'];
if ($user) {

	$id_mod = $_POST['id_mod'];
	$campo = $_POST['campo'];
	$nrecord = $_POST['record'];

$record = htmlspecialchars($nrecord, ENT_NOQUOTES, "UTF-8");

//Funzione per il redirect
function redirect($url,$tempo = FALSE ){
 if(!headers_sent() && $tempo == FALSE ){
  header('Location:' . $url);
 }elseif(!headers_sent() && $tempo != FALSE ){
  header('Refresh:' . $tempo . ';' . $url);
 }else{
  if($tempo == FALSE ){
    $tempo = 0;
  }
  echo "<meta http-equiv=\"refresh\" content=\"" . $tempo . ";" . $url . "\">";
  }
} 

//Controllo campi compilati
		if ($id_mod == "")
 		{
   		echo "<center><b>Il campo id &egrave obbligatorio</b></center>";
   		redirect('./InsPrimanota.php' ,2);
		break;
		}
		if ($campo == "")
 		{
   		echo "<center><b>Il campo 'Campo' &egrave obbligatorio</b></center>";
   		redirect('./InsPrimanota.php' ,2);
		break;
		}
		if ($record == "")
 		{
   		echo "<center><b>Il campo Nuovo record &egrave obbligatorio</b></center>";
   		redirect('./InsPrimanota.php' ,2);
		break;
		}
		if ($contoec == "Causale")
 		{
   		echo "<center><b>Il campo Voce Conto ec. &egrave obbligatorio</b></center>";
   		redirect('./InsPrimanota.php' ,2);
		break;
		}

	include ('./dati_db.inc');
	mysql_connect("$host", "$username", "$password")or die("cannot connect");
	mysql_select_db("$db_name")or die("cannot select DB");

 
		$sql="UPDATE tb_primanota SET $campo = '$record' WHERE id_primanota = '$id_mod'"; //inserisco i valori nel database
		$result=mysql_query($sql);

	if (!$result) {
 die(header('location: ./errore.html'));//"Errore nella query $query: " . mysql_error());
	//	header('location: errore.html'); //Vado alla pagina di errore
	}else{ 
		header('location: ./conferma.html'); //Vado alla pagina di conferma
		}

mysql_close();
} else {
header('Location: ./index.php');
}
?>
