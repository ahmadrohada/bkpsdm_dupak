

<script>
$(document).ready(function () {
	id_pegawai		=	$("#id_pegawai").val();
	//$("#tab_new_dupak").hide();
	//cek apakan nip yang dimasukan benar benar dari sekolah yang bersangkutan
	
	
	//cek step dupak
	$.ajax({
		url:"./kelas/proses.php",
        data:"op=status_dupak&id_pegawai="+id_pegawai,
                    cache:false,
                    success:function(msg){
						//alert (msg);
						
						
						data=msg.split("|");
						
						//alert(data[1]);
						/** hasil cek status bisa berupa
						0. belum ada proses dupak baru ( dupak lama sudah level sektretariat/terkirim oleh TU ) / tampilkan form input
						1. dalam proses pengisian TU
						2. Sudah diajukan ke TIM penilai/sekretariat
						3. Bukan termasuk guru dari sekolah anda
						
						**/
						
						if ( data[0] == 0 || data[0] == 1){
							$("#step").val(data[1]);
							$("#no_dupak").val(data[2]);
							cek_step(data[1]);
						} else if ( data[0] == 2 ){
							alert("DuPAK sudah diajukan ke Tim Penilai");
							window.location.assign("?page=data_dupak&cari="+data[12]);	
						}else if ( data[0] == 3 ){
							alert("Maap Nip yang anda masukan bukan Guru dari Sekolah anda");
							window.location.assign("?page=data_guru");	
						}else if ( data[0] == 4 ){
							alert("Maap Nip yang anda masukan salah");
							window.location.assign("?page=data_guru");	
						}
						
						
						
                    }
        })

		
	//disabled
	function cek_step(x){
		//alert(x);
		
		if ( x >= 1 ) $( "#tab_new_dupak" ).tabs( "enable", 3 );
		if ( x >= 2 ) $( "#tab_new_dupak" ).tabs( "enable", 4 );
		if ( x >= 3 ) $( "#tab_new_dupak" ).tabs( "enable", 5 );
		if ( x >= 4 ) $( "#tab_new_dupak" ).tabs( "enable", 6 );
		if ( x >= 5 ) $( "#tab_new_dupak" ).tabs( "enable", 7 );
		if ( x >= 6 ) $( "#tab_new_dupak" ).tabs( "enable", 8 );
		
		if ( x == 0 ) $( "#tab_new_dupak" ).tabs( "option", "active", 2 );
		if ( x == 1 ) $( "#tab_new_dupak" ).tabs( "option", "active", 3 );
		if ( x == 2 ) $( "#tab_new_dupak" ).tabs( "option", "active", 4 );
		if ( x == 3 ) $( "#tab_new_dupak" ).tabs( "option", "active", 5 );
		if ( x == 4 ) $( "#tab_new_dupak" ).tabs( "option", "active", 6 );
		if ( x == 5 ) $( "#tab_new_dupak" ).tabs( "option", "active", 7 );
		if ( x == 6 ) $( "#tab_new_dupak" ).tabs( "option", "active", 8 );
		
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
		<a href="files_common/f_data_dupak.php">
		<img src="images/forms/data.png" width="60px" height="60px" class="icon_menu">
		<p style="margin:-40px 0 0 80px;">DATA DUPAK BARU</p>
		</a>
	</li>
	<!-- TAB 3 -->
    <li>
		<a href="files_common/f_pendidikan.php">
		<img src="images/forms/pendidikan.png" width="60px" height="60px" class="icon_menu">
		<p style="margin:-40px 0 0 80px;">PENDIDIKAN</p>
		</a>
	</li>
		
	
	<!-- TAB 4 -->
    <li>
		<a href="files_common/f_pbt.php">
		<img src="images/forms/pbt.png" width="60px" height="60px" class="icon_menu">
		<p style="margin:-50px 0 0 80px;">PEMBELAJARAN/BIMBINGAN<br>DAN TUGAS TERTENTU</p>
		</a>
	</li>
	<!-- TAB 5 -->
	<li>
		<a href="files_common/f_pkb.php">
		<img src="images/forms/pd.png" width="60px" height="60px" class="icon_menu">
		<p style="margin:-50px 0 0 80px;">PENGEMBANGAN KEPROFESIAN <BR>BERKELANJUTAN</p>
		</a>
	</li>
	<!-- TAB 6 -->
	<li>
		<a href="files_common/f_piki.php">
		<img src="images/forms/piki.png" width="60px" height="60px" class="icon_menu">
		<p style="margin:-50px 0 0 80px;">PUBLIKASI ILMIAH DAN KARYA<BR> INOVATIF</p>
		</a>
	</li>
	<!-- TAB 7 -->
	<li>
		<a href="files_common/f_penunjang.php">
		<img src="images/forms/pp.png" width="60px" height="60px" class="icon_menu">
		<p style="margin:-40px 0 0 80px;">PENUNJANG TUGAS GURU</p>
		</a>
	</li>
	<!-- TAB 8 -->
	<li>
		<a href="files_common/f_rekap.php">
		<img src="images/forms/rekap.png" width="60px" height="60px" class="icon_menu">
		<p style="margin:-40px 0 0 80px;">REKAPITULASI DATA</p>
		</a>
	</li>

	
  </ul>
 
</div>
   
    
	
	
	
	
	
</div>



