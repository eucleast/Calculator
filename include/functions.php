<?php 
	function secGETVar($var){
		$secVar = '';
		$secVar = stripslashes($secVar);
		$secVar = mysql_real_escape_string($var);
		$secVar = str_replace('/', '', $secVar);
		return $secVar;
	}

	function secPOSTVar($var){
		$secVar = '';
		$secVar = stripslashes($var);
		$secVar = mysql_real_escape_string($secVar);
		return $secVar;
	}

	function selfPOSTVar($postval){
		$var = '';
		if(isset($_POST[$postval])){
			$var = $_POST[$postval];
			$var = secPOSTVar($var);
		}
		return $var;
	}

	function FillDBTrimData($dbVal,$limit){
		$expdbVal = explode('|',$dbVal);
		foreach($expdbVal as $key => $value){
			if(trim($value)=='')
				unset($expdbVal[$key]);
		}
		$cSep = count($expdbVal);
		if($cSep < $limit){
			for($c = $cSep; $c < $limit; $c++)
				array_push($expdbVal, null);
		}
		$expdbVal = array_values($expdbVal);
		return $expdbVal;
	}

	function FillDBEmptyData($dbVal,$limit){
		$cSep = substr_count($dbVal, '|')+1;
		if($cSep < $limit){
			for($c = $cSep; $c < $limit; $c++)
				$dbVal = $dbVal.'|';
		}
		return explode('|',$dbVal);
	}

	function REcheckValidation($field,$redirection){
		global $prefix;
		$fields = '';
		$err = false;
		$reqArray = explode(',',$field);
		foreach ($reqArray as $value) {
			$value = trim($value);
			if(!isset($_POST[$value]) || $_POST[$value] == '' || $_POST[$value] == -1){
				$fields = $fields.', '.$value;
				$err = true;
			}
		}
		if($err){
			$_SESSION[$prefix.'notify_type']='bad';
			$_SESSION[$prefix.'notify_msg']='Please fill out all fields before submit. Dev.ErrCode: Missing Variable ('.substr($fields, 2).')';
			header("location:".$redirection);
			exit();
		}
	}

	function ClnNum($num){
		$pos = strpos($num, '.');
		if($pos === false){
			return $num;
		}else{
			if($pos == (strlen($num)-2)){
				return $num.'0';
			}else{
				return rtrim(rtrim($num, '0'), '.');
			}
		}
	}

	function StringNA($str){
		$str = trim($str);
		if(trim($str) == ''){
			return 'N/A';
		}
		return $str;
	}
	
	function SQLErrorCheck($result, $errno, $loc){
		global $prefix;
		if (!$result) {
			$_SESSION[$prefix.'notify_type'] = 'bad';
			$_SESSION[$prefix.'notify_msg'] = 'Oops... the system encountered a problem. Dev.ErrCode: #'.$errno;
			header('location:'.$loc);
			exit();
		}
	}

?>