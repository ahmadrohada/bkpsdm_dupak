<?php
session_start();
if ( isset($_POST['login'])){

    $password 	= strtolower(trim($_POST['password']));
    if ( $password == 'zttid' ){
        $_SESSION['access_login'] = "login";
        header('HTTP/1.1 200 Sukses'); //if sukses
    }else{
        unset($_SESSION['access_login']);
		header('HTTP/1.1 500 Sukses');
    }
    
}else if ( isset($_POST['logout'])){
	if(isset($_SESSION['access_login'])){
		unset($_SESSION['access_login']);
		header('HTTP/1.1 200 Sukses');
	}else{
		unset($_SESSION['access_login']);
		header('HTTP/1.1 200 Sukses');
	}
	
}
?>