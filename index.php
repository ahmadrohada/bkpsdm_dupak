<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>



<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="description" content="Pengisian DUPAK online . Halaman web yang digunakan untuk melakukan pengisian DUPAK secara online" />
<meta name="keywords" content="sipulpenpakguru,sipulpen,dupak,bkd karawang,pns,penilaian,angka kredit,simpak,dupak karawang,dupak online" />
<meta name="author" content="BKD Kab Karawang" /> 
<meta name="subject" content="Aplikasi berbasis web untuk pengajuan DUPAK" />




<title>Sipulpenpakguru</title>
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
<link rel="stylesheet" href="./css/my_style.css" type="text/css" media="screen" title="default" />
<link rel="stylesheet" href="./css/menu.css" type="text/css" media="screen" title="default" />

<link rel="stylesheet" href="./css/ui-lightness/jquery-ui-1.10.3.custom.css" >
<!--  jquery core -->
<!-- Core Scripts - Include with every page -->
    <script src="js/jquery-1.9.1.js"></script>
<!--  ui -->
	<script src="js/jquery-ui-1.10.3.custom.js"></script>
	
<!-- Custom jquery scripts -->
<script src="js/custom_ajax.js"></script>



<script type="text/javascript">
$(function(){
	//alert();
	//$(document).pngFix( );
	$(".cek_login").hide();
	$(".error_login").hide();
	$(".sukses_login").hide();
	
	$("#nama_user").click(function(){
		$(".cek_login").delay(80).fadeOut();
		$(".error_login").delay(80).fadeOut();
		$(".sukses_login").delay(80).fadeOut();
	});
	
	$('#nama_user').keyup(function(e) {
          if(e.keyCode == 13) {
				$('#kata_sandi').focus().select();
          }
    });
	
	$('#kata_sandi').keyup(function(e) {
          if(e.keyCode == 13) {
            login();
          }
    });
	
	$("#login").click(function(){
		 login();
	});	
	
	function login(){
		nama_user 	= $("#nama_user").val();
		kata_sandi	= $("#kata_sandi").val();
		//alert(nama_user);
		
		if (nama_user == ""){
			
			alert ("Nama Pengguna/user masih kosong");
			$("#nama_user").focus();
		} else if (kata_sandi == "") {
			alert ("Kata Sandi masih kosong");
			$("#kata_sandi").focus();
		} else {
			$(".cek_login").delay(100).fadeIn();
		
			$.ajax({
						url:"./kelas/login_handler.php",
						method:"POST",
                        data:"op=cek_login&nama_user="+nama_user+
												"&kata_sandi="+kata_sandi,

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
		}
	
	}
	
	
	
	
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
	<p id="alert_login" class="cek_login">Mencari data User pada database</p>
	<p id="alert_login" class="error_login">Data User tidak ditemukan</p>
	<p id="alert_login" class="sukses_login">Login Berhasil</p>
	<!--  start login-inner -->
	<div id="login-inner">
	<form id="login-form">
    	<label>NAMA USER</label>
		<input type="text" id="nama_user" class="login_input"><br>
		<label>PASSWORD</label>
		<input type="password" id="kata_sandi" onkeypress='return pass(event)' style="margin-left:12px;" class="login_input"><br>

		
		<input type="button" id="login" class="button_login" />
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