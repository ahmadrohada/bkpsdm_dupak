<?php if(!isset($_SERVER['HTTP_REFERER'])) { ?><script type="text/javascript">document.location  = "./home.php?page=data_dupak_f";</script><?php exit(); }  ?>


<script>
$(document).ready(function () {
no_dupak		=	$("#no_dupak").val();
$( "#tab_verifikasi_dupak" ).tabs( "option", "active", 1 );
});
</script>


<?php
$no_dupak = isset($_GET['no_dupak']) ? $_GET['no_dupak'] : '';



include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'../kelas/pustaka.php';
Connect::getConnection();
$id = mysql_fetch_object(mysql_query("SELECT id_pegawai FROM dt_dupak WHERE no_dupak='$no_dupak' "));
?>

<input type="hidden" value="<?php echo $no_dupak;?>" id="no_dupak" >
<input type="hidden" value="<?php echo $id->id_pegawai;?>" id="id_pegawai" >
<!-- TAB MENU UNTUK PENGISIAN USULAN DUPAK BARU -->

<div id="tab_verifikasi_dupak">
  <ul>
    <li>
		<a href="files_common/detail_data_pribadi.php?no_dupak=<?php echo $no_dupak; ?>">
		<img src="images/forms/guru.png" width="60px" height="60px" class="icon_menu">
		<p style="margin:-40px 0 0 80px;">DATA PRIBADI</p>
		</a>
	</li>
	<li>
		<a href="files_common/detail_data_dupak.php">
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
	<li>
		<a href="files_common/v_rekap.php">
		<img src="images/forms/data.png" width="60px" height="60px" class="icon_menu">
		<p style="margin:-40px 0 0 80px;">REKAPITULASI</p>
		</a>
	</li>
  </ul>
 
</div>
   
    
	
	
	
	
	
</div>



