<?php
$iIdUser = $_SESSION['iduser'];
$User = new Tomekuser();
$arrUser = $User->get($iIdUser);
$strRole = $arrUser['role'];
$Modele=new Modele();
$arrModels=$Modele->getAll("and iduser='$iIdUser'");


/**
 * Zahlung ist angekommen Mail 
 */
if (isset ($_POST['bezahlt'])) 
{
	$_POST['idkunde']=($_POST['idkunde']);
	foreach($_POST['idkunde'] as $iIdKunde) 
	{
		
		$Modele->upd($iIdKunde, array("is_activ"=>"0"));
		header("Location: " . $GLOBALS['HOST'] . "model/list/");
		    }
}

/**
 * Artikel nicht bezahlt Mail 
 */
if (isset ($_POST['mahnungmail'])) 
{
	$_POST['idkunde']=clearArray($_POST['idkunde']);
	}

/**
 * Kunde löschen inkl. Bestellungen
 */
if (isset ($_POST['kundeloeschen'])) 
{
	$_POST['idkunde']=($_POST['idkunde']);
	foreach($_POST['idkunde'] as $iIdKunde) 
	{
		$Modele->del($iIdKunde);
		header("Location: " . $GLOBALS['HOST'] . "model/list/");
		
	}
}

if (isset ($_POST['aktivieren'])) 
{
	$_POST['idkunde']=($_POST['idkunde']);
	foreach($_POST['idkunde'] as $iIdKunde) 
	{
		$Modele->upd($iIdKunde, array("is_activ"=>"1"));
		header("Location: " . $GLOBALS['HOST'] . "model/list/");
		
	}
}

if (isset ($_POST['zahlungsdatenmail'])) 
{
	$_POST['idkunde']=clearArray($_POST['idkunde']);
	foreach($_POST['idkunde'] as $iIdKunde) 
	{
		$objMails->sendZahlungsdaten($iIdKunde );
	}
}
if (isset ($_POST['farbemail'])) 
{
	$_POST['idkunde']=clearArray($_POST['idkunde']);
	foreach($_POST['idkunde'] as $iIdKunde) 
	{
		$objMails->sendFarbeMail($iIdKunde, true);
	}
}
if (isset ($_POST['hausnummermail']))
{
	$_POST['idkunde']=clearArray($_POST['idkunde']);
	foreach($_POST['idkunde'] as $iIdKunde)
	{
		$objMails->sendHausnummerFehlt($iIdKunde, true);
	}
}

require("templates/_doctype.php");
require("templates/_navi.php");
?>
<style>
	a.snapchat {
  position: relative;
  background: lightgrey;
}

a.snapchat img {
  position: absolute !important;
  opacity: 0;
  width: 250px;
  height: 250px;
  left: 0;
  top: -20px;
  position: relative;
  transition: opacity .5s, top .5s;
}

a.snapchat:hover img {
  opacity: 1;
  top: 20px;
  z-index: 999;
}

</style>
<form action="" method="post">
<div id="content" class="kundenunbezahlt">
	<div id="tableContainer" class="tableContainer">
		<table class="kundenliste">
			<thead class="fixedHeader">
			<tr>
				<th class="first">Geburtstag</th>
				<th class="second">Name</th>
				<th class="third">Nachname</th>
				<th class="forth">Strasse</th>
				<th class="fifth">Ort</th>
				<th class="sixth">PLZ</th>
				<th class="seventh">Notizien</th>
				<th class="eigth" title="* bedeutet: es wurden mindestens .">Augen</th>
				<th class="ninth" title="Teilzahlung: ">Brust</th>
				<th class="tenth">Bild</th>
				<th class="eleventh">Is_Aktiv</th>
			</tr>
			</thead>
			<tbody class="scrollContent">
<?php 

foreach($arrModels as $arrModel) 
{
	$i++;
?>
			<tr id="<?php echo $arrModel['idmodel']; ?>"  class="context-menu-one <?php if($i%2==0) { echo 'alternateRow'; } ?>">
				<td class="first">
					<?php echo $arrModel['email']; ?>
					<input name="idkunde[]" type="hidden" value="0"/>
				</td>
				<td class="second">
                 <?php echo $arrModel['name']; ?>
				</td>
				<td class="third">
					<?php echo $arrModel['surname']; ?>
					
				</td>
				<td class="forth">
					<?php echo $arrModel['street']; ?>
				</td>
				<td class="fifth">
					<?php echo $arrModel['place']; ?>
				</td>
				<td class="sixth">
					<?php echo $arrModel['zip']; ?>
				</td>
				<td class="seventh">
					<?php echo $arrModel['notice']; ?>
									
				</td>
				<td class="eigth">
                <?php echo $arrModel['bewertung']; ?>
				</td>
				<td class="ninth" style="text-align: center;">	
					<?php echo $arrModel['brast']; ?>			
				</td>
				<td class="tenth">
					<a class="snapchat" style="margin: 5px 5px 0 -2px;" target="_blank" href="#">BILD<img src="<?php echo $GLOBALS['IMG'].$arrModel['foto1']?>" /></a>
				</td>
				<td class="eleventh">
					<?php
					if($arrModel['is_activ']==1)
					{
					?>
					<img src="https://cdn0.iconfinder.com/data/icons/round-ui-icons/512/tick_green.png" alt="active" width="20" height="20" />
					<?php	
		
					}
					if ($arrModel['is_activ']==0)
					{
					 ?>
					 <img src="http://www.freeiconspng.com/uploads/red-circle-icon-1.png" alt="deactive" width="20" height="20" />
					
					 <?php
					 	
					}
					 ?> 
				</td>
				</tr>
				<?php
			}
			?>		
			</tbody>
			
		</table>
	</div>
</div>
<div class="kunde-functions">
	<div style="position: relative;">
		<div class="statusmsg">
			<?php echo($i); ?> Ergebnisse
		</div>
		<label>
			Datum <input type="text" name="zahlungsdatum" id="datum_zahlung" value="<?php echo($_POST['zahlungsdatum'])?>" />
		</label>
		<label>			
			<input name="bezahlt" type="submit" value="Deaktivieren " />
		</label>
		<label>			
			<input name="aktivieren" type="submit" value="Aktivieren " />
		</label>	
		<label>		
			<input name="mahnungmail" type="submit" value="Mahnung-Mail" />
		</label>
		<label>	
			<input name="kundeloeschen" type="submit" value="Modellöschen" onclick="return confirm('Wollen Sie den Model wirklich löschen ?');"/>
		</label>
	</div>		
</div>
</form>
<?php
require("templates/_footerjs.php");
?>
<script type="text/javascript" language="JavaScript">
$(document).ready(function() {
	$("table.kundenliste tr").dblclick(function() {
		var id = $(this).prop("id");
		top.location.href = "<?php echo $GLOBALS['HOST']; ?>model/details/"+id+'/';
	});
	
	$("table.kundenliste tr").click(function() {
		var id = $(this).prop("id");
		if($('tr#'+id+' td input[type="hidden"]').prop("value")=="0") {
			$('tr#'+id+' td input[type="hidden"]').prop('value', id);			
			$(this).addClass("markiert");
		} else {
			$('tr#'+id+' td input[type="hidden"]').prop('value', 0);
			$(this).removeClass("markiert");
		}	
	 });
});
$.datepicker.setDefaults( $.datepicker.regional[ "de" ] );
$('input#datum_zahlung').datepicker();
</script>
