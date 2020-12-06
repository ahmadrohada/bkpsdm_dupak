<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>



<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="description" content="Pengisian DUPAK online . Halaman web yang digunakan untuk melakukan pengisian DUPAK secara online" />
<meta name="keywords" content="sipulpenpakguru,sipulpen,dupak,bkd karawang,pns,penilaian,angka kredit,simpak,dupak karawang,dupak online" />
<meta name="author" content="BKPSDM Kab Karawang" /> 
<meta name="subject" content="Aplikasi berbasis web untuk pengajuan DUPAK" />




<title>Sipulpenpakguru</title>
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
<link rel="stylesheet" href="./css/my_style.css" type="text/css" media="screen" title="default" />
<link rel="stylesheet" href="./css/menu.css" type="text/css" media="screen" title="default" />

<link rel="stylesheet" href="./css/ui-lightness/jquery-ui-1.10.3.custom.css" >
<script src="js/jquery-1.9.1.js"></script>
<script src="js/jquery-ui-1.10.3.custom.js"></script>
<script src="js/custom_ajax.js"></script>



<script type="text/javascript">
$(function(){
	
	
	$("#login").click(function(){
		window.location.assign("index.php");
	});	

	$(".reset_password").click(function(){
		//alert()
		nama_user 	= $("#nama_user").val();
		email		= $("#email").val();
		$.ajax({
			url:"./kelas/forgot_password_handler.php",
			method:"POST",
            data:"op=forgot-password&nama_user="+nama_user+"&email="+email,

            cache:false,
            success:function(msg){
				//alert(msg);
				data=msg.split("|");
							
				if ( data[0] == "error" ) {
					$(".cek_login").hide();
					$(".error_login").delay(60).fadeIn();
							
				} else if (data[0] == "sukses"){
					$(".cek_login").hide();
					$(".sukses_login").delay(30).fadeIn();
					//window.location.href="home.php?page=dashboard";
					window.location.assign("?page=dashboard");
							
				}
							

            }
        })
	});	
	

	
	
					
});
</script>
</head>
<body id="login-bg" > 
 
<?php 

session_start();
if ( !isset($_SESSION['id_user'])){ 
?>
 
<!-- Start: login-holder -->
<div id="login-holder">
	<div class="clear"></div>
	<!--  start loginbox ................................................................................. -->
	<div id="loginbox">
	<!--  start login-inner -->
	<div id="login-inner">
	<form id="login-form">
    	<label>NAMA USER</label>
		<input type="text" id="nama_user" class="login_input"><br>
		<label>EMAIL &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
		<input type="text" id="email" style="margin-left:12px;" class="login_input"><br>

		
		<input type="button" id="login" class="button_login" />
		<div style="float:right; margin-right:40px; margin-top:10px;">
		<button class="btn btn-block reset_password">RESET</button>
		</div>
		
	</form>
	</div>
	
    
    
    
 	<!--  end login-inner -->
	<div class="clear"></div>
 </div>
 <!--  end loginbox -->
</div>

<!-- End: login-holder -->
<?php } else { ?>
<script>
	//alert("udah");
	window.location.href="home.php?page=dashboard";
</script>
<?php } ?>

</body>

</html>