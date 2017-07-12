<?php 
$iIdUser = $_SESSION['iduser'];
$User = new Tomekuser();
$arrUser = $User->get($iIdUser);
$strRole = $arrUser['role'];

?>
<div id="navi">
	<ul class="topnavi">
		<li <?php if( $_GET['func']=='model' && $_GET['subfunc']=='neu') { ?>class="active" <?php } ?>>
			<a href="<?php echo $GLOBALS['HOST']; ?>model/neu/"> <?php if ($strRole=='user' || $strRole=='admin')  {?> 
				   <?php echo 'Neu Modele'; }?></a>
		</li>
		<li <?php if( $_GET['func']=='model' && $_GET['subfunc']=='list' ) { ?>class="active" <?php } ?>>
			<a href="<?php echo $GLOBALS['HOST']; ?>model/list/"><?php if ($strRole=='user' || $strRole=='admin')  {?>   <?php  echo 'Model List'; }?></a>
		</li>
			<li <?php if( $_GET['func']=='benutzer' && $_GET['subfunc']=='list' ) { ?>class="active" <?php } ?>>
			<a href="<?php echo $GLOBALS['HOST']; ?>benutzer/list/"><?php if ( $strRole=='admin')  {?>   <?php  echo 'Benutzer'; }?></a>
		</li>
		</li>
			<li <?php if( $_GET['func']=='model' && $_GET['subfunc']=='suchen' ) { ?>class="active" <?php } ?>>
			<a href="<?php echo $GLOBALS['HOST']; ?>model/suchen/"><?php if ( $strRole=='admin')  {?>   <?php  echo 'Model-Suchen'; }?></a>
		</li>
		<li >
			<form action="" method="post">
		Hello <?php echo $arrUser['uname']; ?>. <input type="submit" name="logout" value="Log out" />
		</form>	
		</li>
	</ul>
	
</div>	
