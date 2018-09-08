<?php
session_start();

require_once ($_SERVER ['DOCUMENT_ROOT'] . '/api/api.php');
require_once("config.php");

if(trim($_POST["userid"])==""){
	header("Location: index.php?error=Error : Empty Room No.");
	exit;	
}
if(trim($_POST["passwd"])==""){
	header("Location: index.php?error=Error : Empty Last Name");
	exit;	
}
$api=new API();
$api->SetArg('room_no',trim($_POST['prop_id']).trim($_POST['userid']));
$api->SetArg('type','mf');
if(!$api->Execute('pms_guest_status') || $api->GetResult('result')!='ok'){
		header("Location: index.php?error=Error 1: Please Contact Support!");
		exit;
}else{
	if($api->getResult("count")=="0"){
		header("Location: index.php?error=Error : Invalid Room No.");
		exit;
	}

	$guest_names_string=$api->getResult("guest_name");
	$guest_nos_string=$api->getResult("guest_no");
	$guest_departure_string=$api->getResult("guest_departure");
	
	$guest_names=explode("|",$guest_names_string);
	$guest_nos=explode("|",$guest_nos_string);	
	$guest_departures=explode("|",$guest_departure_string);
	
	$guest_index=-1;
	for($i=0;$i<count($guest_names);$i++){
		$guest_no=$guest_nos[$i];
		$guest_out=$guest_departures[$i];
		$guest_name=$guest_names[$i];
		if(is_matched($guest_name,$_POST["passwd"])){
			$guest_index=$i;
			break;
		}
	}

	if($guest_index==-1){
		header("Location: index.php?error=Error : Invalid Credentials");
		exit;
	}else{
		$need_create=1;
		
		$api->reset();
		$api->SetArg('room_no',trim($_POST['prop_id']).trim($_POST['userid']));
		if ( !$api->Execute("pms_room_status") || $api->getResult("result") != "ok" )
		{
			header("Location: index.php?error=Error : Invalid Credentials");
			exit;
		}
		// Get previous created VIP access code created
		$vip_user = trim($api->getResult("room_status_desc1"));
		if ( $vip_user != '' ){
			// Attemp to login 
			$api->reset();
			$api->setArg('code', $vip_user);
			$api->setArg('client_mac', $_GET['client_mac']);
			$api->setArg('client_ip', $_GET['client_ip']);
			$api->setArg('ppli', $_GET['ppli']);
			$api->setArg('location_index', $_GET['location_index']);
			if ( $api->Execute("auth_login") && $api->getResult("result") == "ok" ){
				header("Location: success.php");
				exit;
			}else{
				header("Location: index.php?error=Error : Sharing Limit Exceed!");
				exit;
			}
		}else{
			$api->Reset();
			$api->setArg("creator","pms");
			$api->setArg("plan_name",$config['plan']);
			$api->SetArg('valid_until',$valid_until);
			$api->SetArg('description',$_POST['passwd']);
			$api->SetArg('billing_id',$_POST['userid']);
			$api->SetArg('type','code');
			$api->SetArg('sharing_max',$config["sharing"]);
			if (! $api->Execute ( 'account_add' ) || $api->GetResult ( 'result' ) != 'ok') {
				header("Location: index.php?error=Error 2 : Please Contact Support!");
				exit;
			}
			$code = $api->GetResult('codes');
			$api->Reset();
			$api->SetArg('code',$code);
			$api->SetArg('client_mac',$_GET['client_mac'] );
			$api->SetArg('client_ip',$_GET['client_ip'] );
			$api->SetArg('location_index',$_GET['location_index'] );
			$api->SetArg('ppli',$_GET['ppli']);
			$api->SetArg('mode','login');
			if (!$api->Execute ('auth_login')||$api->GetResult ( 'result' ) != 'ok'){
				header("Location: index.php?error=Error : Sharing Limit Exceed!");
				exit;
			}else{
				$api->reset();
				$api->SetArg('room_no',trim($_POST['prop_id']).trim($_POST['userid']));
				$api->SetArg('room_status_desc1', $code);
				$api->Execute('pms_room_status_update');
				header("Location: success.php");
				exit;
			}
		}
	}
}
function is_matched($guest_name,$passwd){
	$guest_name=trim(strtoupper($guest_name));
	$guest_name=no_space(substr($guest_name,0,3));
	$passwd=trim(strtoupper($passwd));
	if($guest_name==$passwd){
		return true;
	}
	return false;
}
function no_space($string){
	return str_replace(' ', '', $string);
}
function clean_account($string) {
   $string = str_replace(' ', '-', $string); 
   return preg_replace('/[^A-Za-z0-9\-]/', '', $string); 
}
?>