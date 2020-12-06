<?php if(!isset($_SERVER['HTTP_REFERER'])) { ?><script type="text/javascript">document.location  = "./index.php";</script><?php exit(); }  ?>

<script>
$(document).ready(function () {
no_dupak		=	$("#no_dupak").val();
p				=	$("#p").val();


$( "#tab_verifikasi_dupak" ).tabs( "disable", 3 );
$( "#tab_verifikasi_dupak" ).tabs( "disable", 4 );
$( "#tab_verifikasi_dupak" ).tabs( "disable", 5 );
$( "#tab_verifikasi_dupak" ).tabs( "disable", 6 );
$( "#tab_verifikasi_dupak" ).tabs( "disable", 7 );
/**
0 = data pribadi
1 = data pak
2 = data dupak
3 = pendidikan
4 = pbt
5 = pkb
6 = piki
7 = penunjang
**/

	

	$.ajax({
		url:"./kelas/proses.php",
        data:"op=cek_step&no_dupak="+no_dupak+"&p="+p,
                cache:false,
                success:function(msg){
				//alert(msg);
				data=msg.split("|");
				cek_step(data[0]);
				
				
				$( "#progressbar" ).progressbar({value: +data[2]});
			}
	})


	function cek_step(x){
		//alert(x);
		
		//alert(p);
		
		if (( x == 7 ) || ( x == 13 ) ) { 
			$( "#tab_verifikasi_dupak" ).tabs( "enable", 2 );
			$( "#tab_verifikasi_dupak" ).tabs( "option", "active", 2 );
		}
		if (( x == 8 ) || ( x == 14 ) ) { 
			$( "#tab_verifikasi_dupak" ).tabs( "enable", 3 );
			$( "#tab_verifikasi_dupak" ).tabs( "option", "active", 3 );
		}
		if (( x == 9 ) || ( x == 15 ) ) { 
			$( "#tab_verifikasi_dupak" ).tabs( "enable", 4 );
			$( "#tab_verifikasi_dupak" ).tabs( "option", "active", 4 );
		}
		if (( x == 10 ) || ( x == 16 ) ) { 
			$( "#tab_verifikasi_dupak" ).tabs( "enable", 5 );
			$( "#tab_verifikasi_dupak" ).tabs( "option", "active", 5 );
		}
		if (( x == 11 ) || ( x == 17 ) ) { 
			$( "#tab_verifikasi_dupak" ).tabs( "enable", 6 );
			$( "#tab_verifikasi_dupak" ).tabs( "option", "active", 6 );
		}
		if (( x == 12 ) || ( x == 18 ) ) { 
			$( "#tab_verifikasi_dupak" ).tabs( "enable", 7 );
			$( "#tab_verifikasi_dupak" ).tabs( "option", "active", 7 );
		}
		

		if (( (x >= 9) & ( p == 1 ) ) || ( (x >= 15) & (p == 2 ) ) ) { 
				$( "#tab_verifikasi_dupak" ).tabs( "enable", 3 );
		}
		
		if (( (x >=10) & ( p == 1 ) ) || ( (x >= 16) & (p == 2 ) )) {
				$( "#tab_verifikasi_dupak" ).tabs( "enable", 4 );
		}
		if (( (x >=11) & ( p == 1 ) ) || ( (x >= 17) & (p == 2 ) )) {
				$( "#tab_verifikasi_dupak" ).tabs( "enable", 5 );
		}
		if (( (x >=12) & ( p == 1 ) ) || ( (x >= 18) & (p == 2 ) )) {
				$( "#tab_verifikasi_dupak" ).tabs( "enable", 6 );
		}
		if (( (x >=13) & ( p == 1 ) ) || ( (x >= 19) & (p == 2 ) )) {
				$( "#tab_verifikasi_dupak" ).tabs( "enable", 7 );
		}
		
		
	}


});
</script>
<style>
	.ui-progressbar .ui-progressbar-value { background-image: url(./css/ui-lightness/images/pbar-ani.gif); }
	.ui-progressbar { height:1.3em; text-align: left; overflow: hidden; margin-bottom:10px; }
	.ui-progressbar .ui-progressbar-value {margin: -1px; height:100%; }
</style>

<?php
//NIP yang didapat dari get harus d cek terlebih dahulu,, apakah dalam proses pengajuan dupak atau tidak
$no_dupak 	 = isset($_GET['no_dupak']) ? $_GET['no_dupak'] : '';
$p			 = isset($_GET['p']) ? $_GET['p'] : '';
include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'../kelas/pustaka.php';
Connect::getConnection();
$id = mysql_fetch_object(mysql_query("SELECT id_pegawai FROM dt_dupak WHERE no_dupak='$no_dupak' "));


//echo $_SESSION['id_pegawai'];

?>
<input type="hidden"  value="<?php echo $p;?>" id="p" >
<input type="hidden"  value="<?php echo $no_dupak;?>" id="no_dupak" >
<input type="hidden"  value="<?php echo $id->id_pegawai;?>" id="id_pegawai" >

<!-- TAB MENU UNTUK PENGISIAN USULAN DUPAK BARU -->
<div id="progressbar"></div>

<div id="tab_verifikasi_dupak">
  <ul>
    <li>
		<a href="files_common/v_data_pribadi.php?no_dupak=<?php echo $no_dupak; ?>">
		<img src="images/forms/guru.png" width="60px" height="60px" class="icon_menu">
		<p style="margin:-40px 0 0 80px;">DATA PRIBADI</p>
		</a>
	</li>
		<li>
		<a href="files_common/v_pak_terakhir.php">
		<img src="images/forms/rekap.png" width="60px" height="60px" class="icon_menu">
		<p style="margin:-49px 0 0 80px;">PAK TERAKHIR</p>
		</a>
	</li>
	<li>
		<a href="files_common/v_data_dupak.php">
		<img src="images/forms/rekap.png" width="60px" height="60px" class="icon_menu">
		<p style="margin:-49px 0 0 80px;">DATA DUPAK</p>
		</a>
	</li>
	<li>
		<a href="files_common/v_pendidikan.php">
		<img src="images/forms/pendidikan.png" width="60px" height="60px" class="icon_menu">
		<p style="margin:-49px 0 0 80px;">PENDIDIKAN</p>
		</a>
	</li>
    <li>
		<a href="files_common/v_pbt.php">
		<img src="images/forms/pbt.png" width="60px" height="60px" class="icon_menu">
		<p style="margin:-50px 0 0 80px;">PEMBELAJARAN/BIMBINGAN<br>DAN TUGAS TERTENTU</p>
		</a>
	</li>
	<li>
		<a href="files_common/v_pkb.php">
		<img src="images/forms/pd.png" width="60px" height="60px" class="icon_menu">
		<p style="margin:-50px 0 0 80px;">PENGEMBANGAN KEPROFESIAN <BR>BERKELANJUTAN</p>
		</a>
	</li>
	<li>
		<a href="files_common/v_piki.php">
		<img src="images/forms/piki.png" width="60px" height="60px" class="icon_menu">
		<p style="margin:-50px 0 0 80px;">PUBLIKASI ILMIAH DAN KARYA<BR> INOVATIF</p>
		</a>
	</li>
	<li>
		<a href="files_common/v_penunjang.php">
		<img src="images/forms/pak.png" width="60px" height="60px" class="icon_menu">
		<p style="margin:-40px 0 0 80px;">PENUNJANG TUGAS GURU</p>
		</a>
	</li>
  </ul>
 
</div>
   
    
	
	
	
	
	
</div>



