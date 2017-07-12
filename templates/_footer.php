<?php
require_once("Message.class.php");

if( Message::isErrorMessage() ) 
{ 
?>
	<script>
	$(function() {
		$( "#dialog-modal" ).dialog({
			width: 750,
			modal: true
		});
	});
	</script>
	<div id="dialog-modal" title="Ein Fehler ist aufgetreten">
		<p>
			&nbsp; <br /> 
<?php
	foreach( Message::getErrorMessages() as $strMessage ) 
	{
		echo $strMessage . "<br />\n";
	} 
?>
		</p>
		<br />
<?php 
	if( Message::isLink() )
	{
?>	
		<p>
			<strong>Weiterleiten zu: </strong>
<?php
		$c = 0;
		foreach( Message::getLinks() as $arrLink ) 
		{
			if( $c++>0 )
			{
				echo '&nbsp;-&nbsp;';
			}
			echo '<a href="'.$arrLink['link'].'" style="text-decoration: underline;"><nobr>' . htmlentities($arrLink['text']). '</nobr></a>';
		} 
?>
		</p>
<?php 
	}
?>
	</div>
<?php 
}
else if( Message::isInfoMessage() )
{
?>
	<script>
	$(function() {
		$( "#dialog-modal" ).dialog({
			width: 750,
			modal: true
		});
	});
	</script>
	<div id="dialog-modal" title="Hint: ">
		<p>
			&nbsp; <br /> 
<?php
	foreach( Message::getInfoMessages() as $strMessage ) 
	{
		echo $strMessage . "<br />\n";
	} 
?>
		</p>
		<br />
<?php 
	if( Message::isLink() )
	{
?>	
		<p>
			<strong>Weiterleiten zu: </strong>
<?php
		$c = 0;
		foreach( Message::getLinks() as $arrLink ) 
		{
			if( $c++>0 )
			{
				echo '&nbsp;-&nbsp;';
			}
			echo '<a href="'.$arrLink['link'].'" style="text-decoration: underline;"><nobr>' . htmlentities($arrLink['text']). '</nobr></a>';
		} 
?>
		</p>
<?php 
	}
?>		
	</div>
<?php 
}
?>
	</body>
</html>

