

<script>
$(document).ready(function () {
	
	
	$(".verifikasi").click(function(){
		var no_dupak = $(this).attr('value'); //
		
		$.ajax({
			url:"./kelas/verifikasi.php",
			data:"op=cek_penilai&no_dupak="+no_dupak,
            cache:false,
            success:function(msg){
				/** HASIL CEK
				// P1 // P2 // progress P1 // Progress P2 // id skarang
				**/
					//alert(msg);
					//blm dinilai
					if (msg=='00000') {
						//verifikasi dupak dari nol
						window.location.assign("?page=verifikasi_dupak&no_dupak="+no_dupak+"&p=1");
					}
					if ( msg=='10000' ){
						alert_1();
					}
					if ( msg=='10001' ){
						window.location.assign("?page=verifikasi_dupak&no_dupak="+no_dupak+"&p=1");
					}
					if ( msg=='10100' ){
						//alert_1();
						window.location.assign("?page=verifikasi_dupak&no_dupak="+no_dupak+"&p=2");
					}
					if ( msg=='10101' ){
						window.location.assign("?page=verifikasi_dupak&no_dupak="+no_dupak+"&p=1");
					}
					if ( msg=='10102' ){
						window.location.assign("?page=verifikasi_dupak&no_dupak="+no_dupak+"&p=2");
					}
					if ( msg=='11101' ){
						window.location.assign("?page=verifikasi_dupak&no_dupak="+no_dupak+"&p=1");
					}
					if ( msg=='11102' ){
						window.location.assign("?page=verifikasi_dupak&no_dupak="+no_dupak+"&p=2");
					}
					if ( msg=='11110' ){
						alert_1();
					}	
					if ( msg=='11111' ){
						window.location.assign("?page=detail_dupak&no_dupak="+no_dupak);
					}
					if ( msg=='11112' ){
						window.location.assign("?page=detail_dupak&no_dupak="+no_dupak);
					}
			}
		})
		
		
		
    });
	
			
	function alert_1(){
			$("#alert").html(
				"<center><span class='ui-icon ui-icon-alert' style='float:left; margin:0 0 10px 5px;'></span>"
				+"DUPAK sedang dalam proses Tim Penilai yang lain</center>"
			);
			
			$("#alert").dialog({show:"clip",hide:"clip",draggable:false,resizable: false,modal: true,dialogClass: 'no-close',title  : 'SIPULPENPAKGURU',
				height: 150,
				width: 450,
				buttons: {
					"Tutup": function () {
					$(this).dialog('close');
					$("#d_hasil_pkg").focus();
					}
				}
			});
		
		
	}
		

});
</script>


<!--=====================================================- > 
**********************************************************
                   TAMPIL DATA DUPAK
**********************************************************
<--====================================================---->


<h3 class="page-header">
DATA DUPAK ( PROSES TIM PENILAI )
</h3>

<table  width="100%">
<tr>
	<td align="right">
		<form action="" method="post">
		Cari dengan No DUPAK, Nip Baru  atau Nama Pegawai &nbsp;&nbsp;&nbsp;<input  type="text" name="txtcari"  size="33" maxlength="34"> 
		<input type="submit" name="cari" value="Cari">
		</form>
	</td>
</tr>
</table>
<br>
<table border="1" class="data table-hover" width="100%">
<thead>
        <tr>
			<th width="4%">No</th>
			<th width="12%">NO DUPAK</th>
			<th width="13%">NIP BARU</th>
			<th>NAMA PEGAWAI</th>
			<th width="17%">PENILAI 1</th>
			<th width="17%">PENILAI 2</th>
			<th width="10%">AKSI</th>
        </tr>    
</thead>
<tbody>	
<?php
$penilai = isset($_SESSION['id_pegawai']) ? $_SESSION['id_pegawai'] : '';

if((!isset($_GET['hal'])) | (isset($_POST['cari'])))
	{
		$nohal = 1;
	} 
	else 
		$nohal = $_GET['hal'];

$nama_file = "data_pengajuan_dupak";		
$dataperhal = 20;
$offset = ($nohal - 1) * $dataperhal; //no record awal yang akan ditampilkan
$page= array(); //menampilkan data dengan pagination
$all= array(); //menampilkan data tanpa pagination


$page['limit'] = $offset.",".$dataperhal;
$page['urut'] = 'tgl_entry asc';
//PENCARIAN DATA
$_POST['cari'] = isset($_POST['cari']) ? $_POST['cari'] : '';
$_GET['cari'] = isset($_GET['cari']) ? $_GET['cari'] : '';

$page['field'] = "distinct dt_dupak.id_pegawai, dt_pegawai.nama, dt_pegawai.nip_baru,dt_dupak.no_dupak,dt_dupak.step,dt_dupak.status_dupak,dt_dupak.id_penilai_1,dt_dupak.id_penilai_2";
$all['field'] = "distinct dt_dupak.id_pegawai,dt_pegawai.nama, dt_pegawai.nip_baru,dt_dupak.no_dupak,dt_dupak.step,dt_dupak.status_dupak,dt_dupak.id_penilai_1,dt_dupak.id_penilai_2";


//PENCARIAN DATA
if( (isset($_POST['cari'])) | (isset($_GET['cari']))){
		if($_POST['cari']!=null){
			$txtcari=$_POST['txtcari'];
		}else
		$txtcari=$_GET['cari'];
		
		//pencarian data
		$page['jika'] = "dt_pegawai.id_pegawai = dt_dupak.id_pegawai and (dt_pegawai.nip_baru = '$txtcari' or nama LIKE '%$txtcari%' or dt_dupak.no_dupak = '$txtcari') and status_dupak='level_2' and step <= 19 ";
		$all['jika'] = "dt_pegawai.id_pegawai = dt_dupak.id_pegawai and (dt_pegawai.nip_baru = '$txtcari' or nama LIKE '%$txtcari%' or dt_dupak.no_dupak = '$txtcari') and status_dupak='level_2' and step <= 19 ";
		
		$_SESSION['cari']= $txtcari; //menyiapkan GET cari untuk pagination
		$_SESSION['nama_file']= $nama_file;
		
} else {
		//defaul data	
		//$page['jika'] = "dt_pegawai.id_pegawai = dt_dupak.id_pegawai and ( (dt_dupak.step='7') or ((dt_dupak.step='13') and ( ((dt_dupak.id_penilai_1 != '$penilai') and (dt_dupak.id_penilai_2 != '$penilai')) )))";
		$page['jika'] = "dt_pegawai.id_pegawai = dt_dupak.id_pegawai and status_dupak='level_2' and step <= 19 ";
		$all['jika'] = "dt_pegawai.id_pegawai = dt_dupak.id_pegawai and status_dupak='level_2' and step <= 19  ";
}

	include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'../kelas/pustaka.php';
	$dataPak	= 	New KelolaDataDupak();
	$hasil 		= 	$dataPak->TampilDataDupak("dt_dupak,dt_pegawai",$page);

	//mencari jumlah data yang harus ditampilkan perhalaman
	$hasil2= $dataPak->TampilDataDupak("dt_dupak,dt_pegawai",$all);
	$jumdata=0;
	foreach($hasil2 as $j){ $jumdata=$jumdata+1; }
	$jumhal = ceil($jumdata/$dataperhal);
	//penomoran data
	$no=1 + ($nohal*$dataperhal) -$dataperhal;



	foreach($hasil as $r)
	{
	
	//pencarian gelar pada data PAK
	$x = mysql_query("SELECT no_pak FROM dt_pak WHERE nip_baru='$r->nip_baru' ORDER BY tgl_pak ASC");
	$data = mysql_num_rows($x);
	//jika ditemukan data lebih dari 1
	if ( $data > 1 ) {
		while ($c = mysql_fetch_array($x)){
					$dpt = $c['no_pak'];
			}
					$pak_terakhir = mysql_fetch_object(mysql_query("SELECT * FROM dt_pak WHERE no_pak='$dpt' "));
			} else {
					$pak_terakhir = mysql_fetch_object(mysql_query("SELECT * FROM dt_pak WHERE nip_baru='$r->nip_baru' ORDER BY tgl_pak DESC"));
			}
	
	$pak_terakhir = isset($pak_terakhir->no_pak) ? $pak_terakhir->no_pak : '';
	
	$glr		=   mysql_fetch_object(mysql_query("SELECT gelar_dpn,gelar_blk FROM tb_pak_guru_pend WHERE no_pak='$pak_terakhir' "));
	$d 			= 	New FormatTanggal();	
	
	//penilai
	if ( $r->id_penilai_1 != '' ){
		$z = mysql_fetch_object(mysql_query("SELECT nama,gelar_dpn,gelar_blk,nip_baru FROM dt_pegawai WHERE id_pegawai='$r->id_penilai_1' "));
		if ($z->gelar_blk == null ) 
		{ $koma = ""; } else { $koma = ", ";};
		if ($z->gelar_dpn == null ) 
		{ $titik = ""; } else { $titik = ". ";};
		$nama_penilai_1 	= $z->gelar_dpn.$titik.ucwords(strtolower($z->nama)).$koma.$z->gelar_blk;
		
	}else{
		$nama_penilai_1 = '';
	}
	
	if ( $r->id_penilai_2 != '' ){
		$z = mysql_fetch_object(mysql_query("SELECT nama,gelar_dpn,gelar_blk,nip_baru FROM dt_pegawai WHERE id_pegawai='$r->id_penilai_2' "));
		if ($z->gelar_blk == null ) 
		{ $koma = ""; } else { $koma = ", ";};
		if ($z->gelar_dpn == null ) 
		{ $titik = ""; } else { $titik = ". ";};
		$nama_penilai_2 	= $z->gelar_dpn.$titik.ucwords(strtolower($z->nama)).$koma.$z->gelar_blk;
		
	}else{
		$nama_penilai_2 = '';
	}
	
	
?>
<tr>
	<td align="center">
		<?php echo $no; ?>
	</td>
	<td width="20%"  align="center">
		<?php echo $r->no_dupak; ?>
	</td>
	<td align="center">
	<?php echo $r->nip_baru; ?>
	</td>
	<td align="" >
	<?php 
		$g_blk = isset($glr->gelar_blk) ? $glr->gelar_blk : '';
		if ($g_blk == null ) 
		{ $koma = ""; } else { $koma = ", ";};
		$g_dpn = isset($glr->gelar_dpn) ? $glr->gelar_dpn : '';
		if ($g_dpn == null ) 
		{ $titik = ""; } else { $titik = ". ";};
		echo  $g_dpn.$titik.ucwords(strtolower($r->nama)).$koma.$g_blk;
	?>
	</td>
	<td align="" >
	<?php 
		echo  $nama_penilai_1;
	?>
	</td>
	<td align="" >
	<?php 
		echo  $nama_penilai_2;
	?>
	</td>
	<td align="center">
		<a href="#" class="aksi verifikasi" value="<?php echo $r->no_dupak; ?>" >LIHAT</a>
	</td>
</tr>
<?php
$no = $no+1;
}
?>
</tbody>
</table>

<?php
include ("kelas/pagination.php"); 
?>
