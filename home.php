<?php 
session_start();
if(isset($_SESSION['id_user'])){
include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'kelas/pustaka.php';
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>



<meta http-equiv="Content-Type" content="text/html;" />
<meta charset="utf-8" />
<meta name="description" content="Pengisian DUPAK online . Halaman web yang digunakan untuk melakukan pengisian DUPAK secara online" />
<meta name="keywords" content="sipulpenpakguru,sipulpen,dupak,bkd karawang,pns,penilaian,angka kredit,simpak,dupak karawang,dupak online" />
<meta name="author" content="BKD Kab Karawang" /> 
<meta name="subject" content="Aplikasi berbasis web untuk pengajuan DUPAK" />

<title>Sipulpenpakguru</title>
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
<link rel="stylesheet" href="./css/my_style.css"  />
<link rel="stylesheet" href="./css/tabel.css" />
<link rel="stylesheet" href="./css/menu.css"  />





<link rel="stylesheet" href="./css/ui-lightness/jquery-ui-1.10.3.custom.css" >
<!--  jquery core -->
<!-- Core Scripts - Include with every page -->
    <script src="js/jquery-1.9.1.js"></script>
<!--  ui -->
	<script src="js/jquery-ui-1.10.3.custom.js"></script>
   
	
<!-- Custom jquery scripts -->
<script src="./js/custom_ajax.js"></script>

<script type="text/javascript">
       $(document).ready(function () {
		
		$(".se-pre-con").fadeOut(550);
		
        });
</script> 
 

      
    </head>
    
    <body> 
	<div class="se-pre-con"></div>
    <!-- Start: page-top-outer -->
    <div id="page-top-outer">    
    
    <!-- Start: page-top -->
    <div id="page-top">
    
        <div id="logo">
        <a href="#"><img src="images/shared/logo.png" width="56" height="74" alt="dupak karawang" /></a> 
		<div class="baner">
		
		<FONT style="font-size:12pt; letter-spacing:8pt; font-family:verdana,calibri; "><i>SISTEM INFORMASI</i></FONT><br>
		<FONT style="font-size:15pt; font-weight:bold; letter-spacing:2pt; font-family:comic,calibri; ">PENGUSULAN PENILAIAN DAN PENETAPAN</FONT><br>
		<FONT style="font-size:13pt; font-weight:bold; letter-spacing:5pt;">ANGKA KREDIT GURU</FONT>

		
		
		</div>


        </div>
        <!-- end logo -->
       
        <!--  start top-search -->
        <div id="top-search">
        </div>
        <!--  end top-search -->
        <div class="clear"></div>
    
    </div>
    <!-- End: page-top -->
    
    </div>
    <!-- End: page-top-outer -->
        
    <div class="clear">&nbsp;</div>
     
    <!--  start nav-outer-repeat................................................................................................. START -->
    <div class="nav-outer-repeat"> 
    <!--  start nav-outer -->
    <div class="nav-outer"> 
    
            <!-- start nav-right -->
            <div id="nav-right">
            
                <div class="nav-divider">&nbsp;</div>
				<a href="?page=setting">
                <div class="showhide-account">
					<?php
					$group = isset($_SESSION['group']) ? $_SESSION['group'] : '';
                    if ( $group == '5' ) { ?>
						<img src="images/shared/nav/guru.gif" width="130" height="16" alt="" />
					<?php } else if ( $group == '4' ) { ?>
						<img src="images/shared/nav/tu.png" width="130" height="16" alt="" />
					<?php } else if ( $group == '3' ) { ?>
						<img src="images/shared/nav/penilai.png" width="130" height="16" alt="" />
					<?php } else if ( $group == '2' ) { ?>
						<img src="images/shared/nav/sekretariat.png" width="130" height="16" alt="" />
					<?php } else if ( $group == '1' ) { ?>
						<img src="images/shared/nav/admin.png" width="130" height="16" alt="" />
					<?php } ?> 
				</div>
				</a>
                <div class="nav-divider">&nbsp;</div>
                <a href="logout.php" id="logout" onclick="return confirm('Apakah Anda yakin?')">
					<img src="images/shared/nav/nav_logout.gif" width="64" height="14" alt="" />
				</a>
                <div class="clear">&nbsp;</div>
            
                <!--  
                <div class="account-content">
                <div class="account-drop-inner">
                    <a href="?page=setting" id="acc-settings">Settings</a>
                    <div class="clear">&nbsp;</div>
                </div>
                </div>
                 -->
            
            </div>
            <!-- end nav-right -->
    
    
            <!--  start nav -->
            <div class="nav">
            <div class="table">

    		<?php 
			$group=$_SESSION['group'];
			//echo $group;
			if($group=='5'){
				include "menu-guru.php";
			}

			if($group=='4'){
				include "menu-tata_usaha.php";
			}
			
			if($group=='2'){
				include "menu-sekretariat.php";
			}
			
			if($group=='3'){
				include "menu-tim_penilai.php";
			}
			
			if($group=='1'){
				include "menu-admin.php";
			}
			
			?>
			
           
            <div class="clear"></div>
            </div>
            <div class="clear"></div>
            </div>
            <!--  start nav -->
     
    </div>
    <div class="clear"></div>
    <!--  start nav-outer -->
    </div>
    <!--  start nav-outer-repeat................................................... END -->
    
      <div class="clear"></div>
     
    <!-- start content-outer ........................................................................................................................START -->
    <div id="content-outer">
    <!-- start content -->
    <div id="content">
		<div id="dialog-confirm"></div>
		<div id="dialog-form"></div>
		<div id="alert"></div>
    	<?php include "konten.php"; ?>
	
    </div>
    <!--  end content -->
    <div class="clear">&nbsp;</div>
    </div>
    <!--  end content-outer........................................................END -->
    
    <div class="clear">&nbsp;</div>
        
    <!-- start footer -->         
    <div id="footer">
    <!-- <div id="footer-pad">&nbsp;</div> -->
        <!--  start footer-left -->
        <div id="footer-left">
        BADAN KEPEGAWAIAN DAN DIKLAT KABUPATEN KARAWANG 2016
		</div>
        <!--  end footer-left -->
        <div class="clear">&nbsp;</div>
    </div>
    <!-- end footer -->
     
    </body>
    </html>
    
<?php
}else{
	session_destroy();
	header('Location:index.php?status=Silahkan_Login');
}
?>	
