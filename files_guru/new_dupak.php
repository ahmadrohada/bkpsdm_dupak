

<script>
$(document).ready(function () {
	id_pegawai		=	$("#id_pegawai").val();
	
	//cek step dupak
	

		
	//disabled
	function cek_step(x){
		//alert(x);
		if ( x == 0 ) $( "#tab_new_dupak" ).tabs( "option", "active", 2 );
		
	}

//disabled
$( "#tab_new_dupak" ).tabs( "disable", 3 );
$( "#tab_new_dupak" ).tabs( "disable", 4 );
$( "#tab_new_dupak" ).tabs( "disable", 5 );
$( "#tab_new_dupak" ).tabs( "disable", 6 );
$( "#tab_new_dupak" ).tabs( "disable", 7 );
$( "#tab_new_dupak" ).tabs( "disable", 8 );


	
	
});
</script>
<style>
	.ui-progressbar .ui-progressbar-value { background-image: url(./css/ui-lightness/images/pbar-ani.gif); }
	.ui-progressbar { height:1.3em; text-align: left; overflow: hidden; margin-bottom:10px; }
	.ui-progressbar .ui-progressbar-value {margin: -1px; height:100%; }
</style>

<?php
//NIP yang didapat dari get harus d cek terlebih dahulu,, apakah dalam proses pengajuan dupak atau tidak
$id_pegawai = isset($_GET['id_pegawai']) ? $_GET['id_pegawai'] : '';
?>

<input type="hidden" value="<?php echo $id_pegawai;?>" id="id_pegawai" >
<input type="hidden"  id="no_dupak" >
<input type="hidden"  id="step" >

<input type="hidden"  id="kd_skpd" value="<?php echo $_SESSION['kd_skpd']; ?>">

<!-- TAB MENU UNTUK PENGISIAN USULAN DUPAK BARU -->
<div id="progressbar"></div>

<div id="tab_new_dupak">
	
	
  <ul>
	<!-- TAB 0 -->
    <li>
		<a href="files_common/f_data_pribadi.php?id_pegawai=<?php echo $id_pegawai;?>">
		<img src="images/forms/guru.png" width="60px" height="60px" class="icon_menu">
		<p style="margin:-40px 0 0 80px;">DATA PRIBADI</p>
		</a>
	</li>
	<!-- TAB 1 -->
    <li>
		<a href="files_common/f_pak_terakhir.php">
		<img src="images/forms/pak.png" width="63px" height="63px" class="icon_menu">
		<p style="margin:-40px 0 0 80px;">ANGKA KREDIT PAK TERAKHIR</p>
		</a>
	</li>
	<!-- TAB 2 -->
    <li>
		<a href="files_common/f_new_dupak.php">
		<img src="images/forms/data.png" width="60px" height="60px" class="icon_menu">
		<p style="margin:-40px 0 0 80px;">DATA DUPAK BARU</p>
		</a>
	</li>
	<!-- TAB 3 -->
    <li>
		<a href="#">
		<img src="images/forms/pendidikan.png" width="60px" height="60px" class="icon_menu">
		<p style="margin:-40px 0 0 80px;">PENDIDIKAN</p>
		</a>
	</li>
		
	
	<!-- TAB 4 -->
    <li>
		<a href="#">
		<img src="images/forms/pbt.png" width="60px" height="60px" class="icon_menu">
		<p style="margin:-50px 0 0 80px;">PEMBELAJARAN/BIMBINGAN<br>DAN TUGAS TERTENTU</p>
		</a>
	</li>
	<!-- TAB 5 -->
	<li>
		<a href="#">
		<img src="images/forms/pd.png" width="60px" height="60px" class="icon_menu">
		<p style="margin:-50px 0 0 80px;">PENGEMBANGAN KEPROFESIAN <BR>BERKELANJUTAN</p>
		</a>
	</li>
	<!-- TAB 6 -->
	<li>
		<a href="#">
		<img src="images/forms/piki.png" width="60px" height="60px" class="icon_menu">
		<p style="margin:-50px 0 0 80px;">PUBLIKASI ILMIAH DAN KARYA<BR> INOVATIF</p>
		</a>
	</li>
	<!-- TAB 7 -->
	<li>
		<a href="#">
		<img src="images/forms/pp.png" width="60px" height="60px" class="icon_menu">
		<p style="margin:-40px 0 0 80px;">PENUNJANG TUGAS GURU</p>
		</a>
	</li>
	<!-- TAB 8 -->
	<li>
		<a href="#">
		<img src="images/forms/rekap.png" width="60px" height="60px" class="icon_menu">
		<p style="margin:-40px 0 0 80px;">REKAPITULASI DATA</p>
		</a>
	</li>

	
  </ul>
 
</div>
   
    
	
	
	
	
	
</div>



