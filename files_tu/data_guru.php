<script>
$(document).ready(function () {

//alert();




$(".input").click(function(){
	var id_pegawai = $(this).attr('value');
	//cek step dupak
	//alert(id_pegawai);
	$.ajax({
		url:"./kelas/proses.php",
        data:"op=status_dupak&id_pegawai="+id_pegawai,
                    cache:false,
                    success:function(msg){
						//alert (msg);
						data=msg.split("|");
						/** hasil cek status bisa berupa
						0. belum ada proses dupak baru ( dupak lama sudah level sektretariat/terkirim oleh TU ) / tampilkan form input
						1. dalam proses pengisian TU
						2. Sudah diajukan ke TIM penilai/sekretariat
						3. Bukan termasuk guru dari sekolah anda
						
						**/
						if ( data[0] == 0 ){
							window.location.assign("?page=form_dupak&id_pegawai="+id_pegawai);
						} 
						if ( data[0] == 1 ){
							window.location.assign("?page=form_dupak&id_pegawai="+id_pegawai);
						
						}
						if ( data[0] == 2 ){
							proses_penilai(data[1]);
								
						}
						if ( data[0] == 3 ){
							bukan_guru_anda();
						}
						if ( data[0] == 4 ){
							$("#alert").html(
								"<center><span class='ui-icon ui-icon-alert' style='float:left; margin:0 0 10px 5px;'></span>"
								+"NIP Pegawai Salah / Tidak Aktif</center>"
							);
							
							$("#alert").dialog({show:"clip",hide:"clip",draggable:false,resizable: false,modal: true,dialogClass: 'no-close',title  : 'SIPULPENPAKGURU',
								height: 170,
								width: 450,
								buttons: {
									"Tutup": function () {
									$(this).dialog('close');
									
									}
								}
							});
						}
						
						
						
                    }
        })

})

	function proses_penilai(nama){
		$("#dialog-form").html(
		"<center><span class='ui-icon ui-icon-alert' style='float:left; margin:0 0 10px 5px;'></span>"
		+"DUPAK sedang dalam proses Tim Penilai</center>"
		);
	
		$("#dialog-form").dialog({
		//autoOpen: false,
		show:"clip",
		hide:"clip",
		draggable:false,
		resizable: false,
		modal: true,
		title  : 'SIPULPENPAKGURU',
		height: 170,
		width: 450,
        buttons: {
				"Tutup": function () {
                $(this).dialog('close');
				
            },
			"Lihat Data": function () {
                $(this).dialog('close');
				window.location.assign("?page=data_dupak&cari="+nama);
			},
        }
		
    });	
	
	}	
	
	function bukan_guru_anda(){
		$("#dialog-confirm").html("<center>Maap Nip yang anda masukan bukan Guru dari Sekolah anda</center>");
		$("#dialog-confirm").dialog({
        resizable: false,
        modal: true,
        title: "SIPULPENPAKGURU",
        height: 170,
        width: 450,
        buttons: {
				"Tutup": function () {
                $(this).dialog('close');
            }
        }
    });	
	}	


});
</script>

<?php
//CARI DATA SKPD
$kd_skpd = isset($_SESSION['kd_skpd']) ? $_SESSION['kd_skpd'] : '';
Connect::getConnection();
$skpd	= mysql_fetch_object(mysql_query("SELECT sekolah FROM kd_skpd WHERE kd_skpd='$kd_skpd' "));

$sekolah = isset($skpd->sekolah) ? $skpd->sekolah : 'all data';

//echo $kd_skpd;

$p=isset($_GET['aksi'])?$_GET['aksi']:null;
switch($p){
default:
?>
<!--=====================================================- > 
**********************************************************
                   TAMPIL DATA GURU
**********************************************************
<--====================================================---->	
<h3 class="page-header">
DATA PEGAWAI&nbsp;&nbsp; [ <?php echo $sekolah; ?> ]
</h3>


<table  width="100%">
<tr>
<!--
	<td align="left">
		<a href="?page=data_pegawai&aksi=tambah"><button class="ui-state-default tambah"  >Tambah Data Pegawai</button></a>
	</td>
-->
	<td align="right">
		<form action="" method="post">
		Cari dengan Nama atau Nip Baru &nbsp;&nbsp;&nbsp;<input  type="text" name="txtcari"  size="20" maxlength="30" > <input type="submit" name="cari" value="Cari">
		</form>
	</td>
</tr>
</table>
<br>
<table border="1" class="data table-hover" width="100%">
<thead>
        <tr>
			<th width="3%">No</th>
            <th width="13%">NIP BARU</th>
            <th width="10%">NIP LAMA</th>
			<th width="25%">NAMA LENGKAP</th>
			<th width="6%">JK</th>
			<th width="19%">TEMPAT/TANGGAL LAHIR</th>
			<th >AKSI</th>
        </tr>    
</thead>
<tbody>	

<?php
if((!isset($_GET['hal'])) | (isset($_POST['cari'])))
	{
		$nohal = 1;
	} 
	else 
		$nohal = $_GET['hal'];
$nama_file = "data_guru";		
$dataperhal = 20;
$offset = ($nohal - 1) * $dataperhal; //no record awal yang akan ditampilkan

$page= array(); //menampilkan data dengan pagination
$all= array(); //menampilkan data tanpa pagination

$page['limit'] = $offset.",".$dataperhal;
//PENCARIAN DATA
$_POST['cari'] = isset($_POST['cari']) ? $_POST['cari'] : '';
$_GET['cari'] = isset($_GET['cari']) ? $_GET['cari'] : '';

$page['field'] = " dt_pegawai.id_pegawai,dt_pegawai.nip_baru,dt_pegawai.nip_lama,dt_pegawai.nama,dt_pegawai.gelar_dpn,dt_pegawai.gelar_blk, dt_pegawai.jk, dt_pegawai.tmp_lahir,dt_pegawai.tgl_lahir, dt_pegawai.kd_skpd,dt_pegawai.kedudukan_peg,kd_skpd.kd_skpd,kd_skpd.sekolah,kd_skpd.skpd";
$all['field']  = " dt_pegawai.id_pegawai,dt_pegawai.nip_baru,dt_pegawai.nip_lama,dt_pegawai.nama,dt_pegawai.gelar_dpn,dt_pegawai.gelar_blk, dt_pegawai.jk, dt_pegawai.tmp_lahir,dt_pegawai.tgl_lahir, dt_pegawai.kd_skpd,dt_pegawai.kedudukan_peg,kd_skpd.kd_skpd,kd_skpd.sekolah,kd_skpd.skpd";
if( (isset($_POST['cari'])) | (isset($_GET['cari']))){
		if($_POST['cari']!= null ){
			$txtcari=$_POST['txtcari'];
		}else{
			$txtcari=$_GET['cari'];
		}
		//pencarian data
			//$page['jika'] = "kd_skpd='$kd_skpd' and ( kedudukan_peg != 'Pensiun' and kedudukan_peg != 'Meninggal Dunia') and nama LIKE '%$txtcari%' or nip_baru = '$txtcari' ";
			//$all['jika'] = "kd_skpd='$kd_skpd' and ( kedudukan_peg != 'Pensiun' and kedudukan_peg != 'Meninggal Dunia') and nama LIKE '%$txtcari%' or nip_baru = '$txtcari'";
			$page['jika'] = "dt_pegawai.kd_skpd = kd_skpd.kd_skpd and dt_pegawai.kd_skpd='$kd_skpd' and  nama LIKE '%$txtcari%' or nip_baru = '$txtcari' ";
			$all['jika'] = "dt_pegawai.kd_skpd = kd_skpd.kd_skpd and  dt_pegawai.kd_skpd='$kd_skpd' and  nama LIKE '%$txtcari%' or nip_baru = '$txtcari'";
			
		$_SESSION['cari']="&cari=".$txtcari; //menyiapkan GET cari untuk pagination
		$_SESSION['nama_file']= $nama_file;
		
} else {
		
			//$page['jika'] = "kd_skpd='$kd_skpd' and ( kedudukan_peg != 'Pensiun' and kedudukan_peg != 'Meninggal Dunia')";
			//$all['jika'] = "kd_skpd='$kd_skpd' and ( kedudukan_peg != 'Pensiun' and kedudukan_peg != 'Meninggal Dunia')";
			$page['jika'] = "dt_pegawai.kd_skpd='$kd_skpd'";
			$all['jika'] = "dt_pegawai.kd_skpd='$kd_skpd'";
}

	include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'../kelas/pustaka.php';
	$dataPeg	 	= 	New KelolaPegawai();
	$hasil 			= 	$dataPeg->TampilDataPegawai("dt_pegawai,kd_skpd",$page);
	//mencari jumlah seluruh data
	$hasil2= $dataPeg->TampilDataPegawai("dt_pegawai,kd_skpd",$all);
	$jumdata=0;
	foreach($hasil2 as $j){ $jumdata=$jumdata+1; }
	//mencari jumlah data yang harus ditampilkan perhalaman
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
	$glr		=   mysql_fetch_object(mysql_query("SELECT gelar_dpn,gelar_blk FROM tb_pak_guru_pend WHERE no_pak='$pak_terakhir' "));
	$d 			= 	New FormatTanggal();
	
	//warna baris
	if ($r->kedudukan_peg != 'Aktif' ){
		$warna = "red";
	}else{
		$warna = "";
	}
	
?>
<tr style="color:<?php echo $warna; ?>;">
	<td align="center" width="5%">
		<?php echo $no; ?>
	</td>
	<td width="">
		<?php echo $r->nip_baru; ?>
	</td>
    <td align="center">
		<?php echo $r->nip_lama; ?>
	</td>
    <td width="">
		<?php 
		$g_blk = isset($glr->gelar_blk) ? $glr->gelar_blk : '';
		if ($g_blk == null ) 
		{ $koma = ""; } else { $koma = ", ";};
		$g_dpn = isset($glr->gelar_dpn) ? $glr->gelar_dpn : '';
		if ($g_dpn == null ) 
		{ $titik = ""; } else { $titik = ". ";};
	?>
		<a href="?page=detail_pegawai&id=<?php echo $r->id_pegawai; ?>" style="color:<?php echo $warna; ?>;">
		<?php echo  $g_dpn.$titik.ucwords(strtolower($r->nama)).$koma.$g_blk; ?>
		</a>
	</td>
	 <td align="center">
		<?php
		if ( $r->jk==1) echo "L";
		if ( $r->jk==2) echo "P";
		?>
	</td>
	<td width="">
		<?php 
		//tempat tanggal lahir
		$tl		= $d->balik($r->tgl_lahir);
		echo ucwords(strtolower($r->tmp_lahir)).", ".$tl;
		?>
	</td>
	<td align="center">
		<a href="#" class="aksi input" value="<?php echo $r->id_pegawai; ?>">INPUT DUPAK</a>
		<a href="?page=history_pak&id=<?php echo $r->id_pegawai; ?>" class="aksi">HISTORY PAK</a>
	</td>
</tr>
<?php
$no = $no+1;
}
?>
</tbody>
</table>
<br>
<?php
include ("kelas/pagination.php");
break;
}
?>
