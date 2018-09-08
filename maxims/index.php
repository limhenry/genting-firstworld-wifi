<?
session_start();
$_SESSION['prop_id']=8;
if(isset($_GET['prop_id'])){
	$_SESSION['prop_id']=$_GET['prop_id'];	
}
?>
<!DOCTYPE html>
<html lang='en'>
<head>
<meta charset='utf-8' />
<meta name='viewport' content='width=device-width, initial-scale=1' />
<title>Resorts World Genting</title>
<link rel='shortcut icon' type='image/x-icon' href='../favicon.ico' />
<link rel='stylesheet' href='template/red/css/style.css' type='text/css' media='all' />
<link rel='stylesheet' href='template/red/css/flexslider.css' type='text/css' media='all' />
<link rel='stylesheet' href='template/red/css/form.css' type='text/css' media='all' />
<!--<link href='http://fonts.googleapis.com/css?family=Ubuntu:400,500,700' rel='stylesheet' type='text/css' />-->
<script src='template/red/js/jquery-1.8.0.min.js' type='text/javascript'></script>
<!--[if lt IE 9]>
        <script src='template/red/js/modernizr.custom.js'></script>
    <![endif]-->
<script src='template/red/js/jquery.flexslider-min.js' type='text/javascript'></script>
<script src='template/red/js/functions.js' type='text/javascript'></script>
<!-- Javscript Substitution -->
<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript" src="script.js"></script>
<script type="text/javascript">
function do_submit(){
	if(document.getElementById("userid").value==""){
		document.getElementById("error").innerHTML="Empty Room No";		
	}else if(document.getElementById("passwd").value==""){
		document.getElementById("error").innerHTML="Empty Last Name";
	}else if(!document.getElementById("chk").checked){
		document.getElementById("error").innerHTML="Please accept the Terms and Conditions";
	}else{
		document.getElementById("f1").submit();
	}
}
</script>
<!-- Javscript Substitution -->
<!-- LOGO CSS -->
<style></style>
<!-- LOGO CSS -->
</head>
<body>
<div id='wrapper'>
	<!-- header -->
	<header  id='header'>
		<!-- shell -->
		<div class='shell'>
			<div class='header-inner'>
				<!-- slider -->
				<div class='slider-holder'>
					<div class='flexslider'>
						<ul class='slides'>
							<li><img src='images/slider/slide1.png' alt='' /></li>
							<li><img src='images/slider/slide2.png' alt='' /></li>
							<li><img src='images/slider/slide3.png' alt='' /></li>
						</ul>
					</div>
				</div>
				<!-- end of slider -->
				
				<!-- header-cnt -->
				<div class='header-cnt'>
					<center>
					<h1 id='logo'>
						<a href='#'>Logo</a>
					</h1>
					<p>
						<span class='mobile'>Welcome to Resorts World Genting</span>
						<span class='desktop'>Welcome to Resorts World Genting</span>
					</p>
					<!--<a href='#' class='blue-btn'>GET STARTED NOW</a>-->
					</center>
				</div>
				<!-- end of header-cnt -->
				
				<div class='cl'>
					&nbsp;
				</div>
			</div>
			<div class='cl'>
				&nbsp;
			</div>
		</div>
		<!-- end of shell -->
	</header>
	<!-- end of header -->
	<!-- main -->
	<div class='main'>
		<span class='shadow-top'></span>
		<!-- shell -->
		<div class='shell'>
			<!-- container -->
			<div class='container'>
				<!-- testimonial -->
				<section class='testimonial'>
					<!-- content -->
					<div id='form-content'>
						<center>
						<form id='f1' method='POST' action='proc1.php'>
							<input type="hidden" name="prop_id" value="<? echo $_SESSION['prop_id'];?>"/>
							<div id="error" style="color:#F00">
							<? echo $_GET['error'];?>
							</div>
							<div style="width:250px;text-align:left;"/>
							Please key-in room No.
							</div>
							<div>
								<input type="text" name="userid" id="userid" placeholder="Room No" style="width:250px"/>
							</div>
							<div style="width:250px;text-align:left;"/>
							First 3 characters of last name.
							</div
							><div>
								<input type="text" name="passwd" id="passwd" placeholder="Last Name" style="width:250px"/>
							</div>
							<div>
								<input type="button" value="Connect" class="button" id="next" onclick="do_submit();" />
							</div>
							<div class='clear'>
							</div>
							<div id='tos_div'>
								<input type="checkbox" id="chk"> I agree to the <a href="">Terms and Conditions</a>
							</div>
							<!-- end of form -->
						</form>
						</center>
					</div>
					<!-- end of content -->
				</section>
				<!-- testimonial -->
			</div>
			<!-- end of container -->
		</div>
		<!-- end of shell -->
	</div>
	<!-- end of main -->
</div>
<!-- footer-push -->
<div id='footer-push'>
</div>
<!-- end of footer-push -->
<!-- end of wrapper -->
<!-- footer -->
<div id='footer'>
	<span class='shadow-bottom'></span>
	<div class='footer-bottom'>
		<div class='shell'>
			<p class='copy'></p>
		</div>
	</div>
</div>
<!-- end of footer -->
</body>
</html>
