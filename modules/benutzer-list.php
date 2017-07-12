<?php
$iIdUser = $_SESSION['iduser'];
$User = new Tomekuser();
$arrUser = $User->get($iIdUser);
$strRole = $arrUser['role'];
$Modele=new Tomekuser();
$arrModels=$Modele->getAll();


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
		header("Location: " . $GLOBALS['HOST'] . "benutzer/list/");
		
	}
}

if (isset ($_POST['aktivieren'])) 
{
	$_POST['idkunde']=($_POST['idkunde']);
	foreach($_POST['idkunde'] as $iIdKunde) 
	{
		$Modele->upd($iIdKunde, array("is_activ"=>"1"));
		header("Location: " . $GLOBALS['HOST'] . "benutzer/list/");
		
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
<form action="" method="post">
<div id="content" class="kundenunbezahlt">
	<div id="tableContainer" class="tableContainer">
		<table class="kundenliste">
			<thead class="fixedHeader">
			<tr>
				<th class="first">Name</th>
				<th class="second">Nachname</th>
				<th class="third">Email</th>
				<th class="fifth">Role</th>
				<th class="eleventh">Is_Aktiv</th>
			</tr>
			</thead>
			<tbody class="scrollContent">
<?php 

foreach($arrModels as $arrModel) 
{
	$i++;
?>
			<tr id="<?php echo $arrModel['iduser']; ?>"  class="context-menu-one <?php if($i%2==0) { echo 'alternateRow'; } ?>">
				<td class="first">
					<?php echo $arrModel['uname']; ?>
					<input name="idkunde[]" type="hidden" value="0"/>
				</td>
				<td class="second">
                <?php echo $arrModel['surname']; ?>
				</td>
				<td class="third">
					<?php echo $arrModel['email']; ?>
					
				</td>
				<td class="fifth">
					<?php echo $arrModel['role']; ?>
					
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
			<input name="kundeloeschen" type="submit" value="Benutzerlöschen" onclick="return confirm('Wollen Sie den Benutzer wirklich löschen ?');"/>
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
