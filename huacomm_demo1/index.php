<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width" />
<title>RWS</title>
</head>
<body style="font-family:Arial, Helvetica, sans-serif;">
<center>
<div>
	<img src="img/rw.jpg" width="200px"/>
</div>
<div>
	<span style="font-size:18px; font-weight:bold;">Welcome to Resort World Genting</span>
</div>
<div>
	<br/>
	<span style="font-size:12px;">Please login with your Room No + Last Name.</span>
</div>
<div>
	<span style="font-size:12px;color:#F00;" id="error"><? echo $_GET['error'];?></span>
</div>
<form id="f1" method="post" action="proc.php">
<input type="hidden" name="test" value="yes"/>
<input type="hidden" name="prop_id" value="<? echo $_GET['prop_id']==""?8:$_GET['prop_id'];?>"/>
<div>
	<input type="text" placeholder="Room No." id="userid" name="userid" style="width:200px;height:30px; margin-top:10px;"/>
</div>
<div>
	<input type="text" placeholder="Last Name" id="passwd" name="passwd" style="width:200px;height:30px;margin-top:10px;"/>
</div>
</form>
<div style="margin-top:10px;">
	<span style="font-size:12px;"> By clicking below button,<br/>
	I agree to the
	<a href="#">Terms and Conditions.</a>
	</span>
</div>
<script>

function isInt(value) {
  if (isNaN(value)) {
    return false;
  }
  var x = parseFloat(value);
  return (x | 0) === x;
}

function do_submit1(){
	if(document.getElementById("userid").value.trim()==""){
		document.getElementById("error").innerHTML="Empty Room No.";
	}else if(!isInt(document.getElementById("userid").value.trim())){
		document.getElementById("error").innerHTML="Invalid Room No.";
	}else if(document.getElementById("passwd").value.trim()==""){
		document.getElementById("error").innerHTML="Empty Last Name.";
	}else{
		document.getElementById("f1").submit();	
	}
}
</script>
<div>
	<input type="button" value="Login" style="width:200px;height:30px;margin-top:10px;" onClick="do_submit1();"/>
</div>
</center>
</body>
</html>
