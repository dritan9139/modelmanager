<!doctype html>
<html lang="en">
<?php
$User = new Tomekuser();


if( !empty($_SESSION['iduser']) )
{
	header("Location: " . $GLOBALS['HOST'] . "model/neu/");
	die();
}

if( isset($_POST['login-submit']) && !empty($_POST['username']) && !empty($_POST['password']) )	
{
	$arrUser = $User->getUserByCredentials($_POST['username'], $_POST['password']);
	$arrUser = $User->get($arrUser['iduser']);
    $strisActiv = $arrUser['is_activ'];
	if( !empty($arrUser) && $strisActiv=='1' )
	{
		$_SESSION['iduser'] = $arrUser['iduser'];
		header("Location: " . $GLOBALS['HOST'] . "login/n/");
		die();
	}
	else{
		
			?>
<script>
alert("Benutzername ist nicht aktiv!");
</script>
<?php
	}
}
if( isset($_POST['register-submit']) && !empty($_POST['uname']) && !empty($_POST['password']) && !empty($_POST['email']) )
{
	 $arrUser = $User->createUser($_POST['uname'],
	                              $_POST['email'] ,			
								  $_POST['password']
								);

}
?>
<head>
<link media="all" href="<?php echo $GLOBALS['CSS']; ?>styles.css" rel="stylesheet" type="text/css" />
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<div class="container">
        <div class="row">
			<div class="col-md-6 col-md-offset-3">
				<div class="panel panel-login">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-6">
								<a href="#" class="active" id="login-form-link">Login</a>
							</div>
							<div class="col-xs-6">
								<a href="#" id="register-form-link">Register</a>
							</div>
						</div>
						<hr>
					</div>
					<div class="panel-body">.
						<div class="row">
							<div class="col-lg-12">
								<form id="login-form"  method="post" role="form" style="display: block;">
									<div class="form-group">
										<input type="text" name="username" id="username" tabindex="1" class="form-control" placeholder="Username" value="">
									</div>
									<div class="form-group">
										<input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Password">
									</div>
									<!--<div class="form-group text-center">
										<input type="checkbox" tabindex="3" class="" name="remember" id="remember">
										<label for="remember"> Remember Me</label>
									</div>-->
									<div class="form-group">
										<div class="row">
											<div class="col-sm-6 col-sm-offset-3">
												<input type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-login" value="Log In">
											</div>
										</div>
									</div>
									<!--
									<div class="form-group">
										<div class="row">
											<div class="col-lg-12">
												<div class="text-center">
													<a href="" tabindex="5" class="forgot-password">Forgot Password?</a>
												</div>
											</div>
										</div>
									</div>
									-->
								</form>
								<form id="register-form"  method="post" role="form" style="display: none;">
									<div class="form-group">
										<input type="text" name="uname" id="uname" tabindex="1" class="form-control" placeholder="Username" value="">
									</div>
									<div class="form-group">
										<input type="email" name="email" id="email" tabindex="1" class="form-control" placeholder="Email Address" value="">
									</div>
									<div class="form-group">
										<input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Password">
									</div>
									<!--
									<div class="form-group">
										<input type="text" name="surname" id="surname" tabindex="1" class="form-control" placeholder="Surname" value="">
									</div>
									<div class="form-group">
										<input type="text" name="username" id="username" tabindex="1" class="form-control" placeholder="Username" value="">
									</div>
									
									<div class="form-group">
										<input type="password" name="confirm-password" id="confirm-password" tabindex="2" class="form-control" placeholder="Confirm Password">
									</div>
									<div class="form-group">
										<input type="text" name="adsress" id="adsress" tabindex="2" class="form-control" placeholder="Address">
									</div>
									-->
									<div class="form-group">
										<div class="row">
											<div class="col-sm-6 col-sm-offset-3">
												<input type="submit" name="register-submit" id="register-submit" tabindex="4" class="form-control btn btn-register" value="Register Now">
											</div>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script>
$(function() {

    $('#login-form-link').click(function(e) {
    	$("#login-form").delay(100).fadeIn(100);
 		$("#register-form").fadeOut(100);
		$('#register-form-link').removeClass('active');
		$(this).addClass('active');
		e.preventDefault();
	});
	$('#register-form-link').click(function(e) {
		$("#register-form").delay(100).fadeIn(100);
 		$("#login-form").fadeOut(100);
		$('#login-form-link').removeClass('active');
		$(this).addClass('active');
		e.preventDefault();
	});

});	
	
	
	
	</script>