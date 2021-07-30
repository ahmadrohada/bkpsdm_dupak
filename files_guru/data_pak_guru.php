<?php if(!isset($_SERVER['HTTP_REFERER'])) { ?><script type="text/javascript">document.location  = "./index.php";</script><?php exit(); }  ?>
<!--=====================================================- > 
**********************************************************
                   TAMPIL DATA PAK PERSONAL
**********************************************************
<--====================================================---->
<h3 class="page-header">
DATA PAK PERSONAL
</h3>
<!-- <table  width="100%">
<tr>
	<td align="right">
		<form action="" method="post">
		Cari dengan No PAK, Nip Baru  atau Nama Pegawai &nbsp;&nbsp;&nbsp;<input  type="text" name="txtcari"  size="33" maxlength="34"> 
		<input type="submit" name="cari" value="Cari">
		</form>
	</td>
</tr>
</table> -->
<table border="1" class="data table-hover" width="100%">
<thead>
        <tr>
			<th width="4%">No</th>
			<th width="14%">NO PAK</th>
			<th width="9%">TGL PAK</th>
			<th width="13%">NIP BARU</th>
			<th>NAMA PEGAWAI</th>
			<th width="3%">JK</th>
			<th width="17%">TEMPAT TANGGAL LAHIR</th>
			<th width="16%">Aksi</th>
        </tr>    
</thead>
<tbody>	
<?php
$id_pegawai = isset($_SESSION['id_pegawai']) ? $_SESSION['id_pegawai'] : '';
if((!isset($_GET['hal'])) | (isset($_POST['cari'])))
	{
		$nohal = 1;
	} 
	else 
		$nohal = $_GET['hal'];
$nama_file = "data_pak";		
$dataperhal = 20;
$offset = ($nohal - 1) * $dataperhal; //no record awal yang akan ditampilkan
$page= array(); //menampilkan data dengan pagination
$all= array(); //menampilkan data tanpa pagination
$page['limit'] = $offset.",".$dataperhal;
$page['field'] = "distinct dt_pak.nip_baru, dt_pegawai.nama,dt_pak.no_pak,tgl_pak";
$all['field'] = "distinct dt_pak.nip_baru,dt_pegawai.nama,dt_pak.no_pak,tgl_pak";
//PENCARIAN DATA
$_POST['cari'] = isset($_POST['cari']) ? $_POST['cari'] : '';
$_GET['cari'] = isset($_GET['cari']) ? $_GET['cari'] : '';
if( (isset($_POST['cari'])) | (isset($_GET['cari']))){
		if($_POST['cari']!=null){
			$txtcari=$_POST['txtcari'];
		}else
			$txtcari=$_GET['cari'];
		//pencarian data
		$page['jika'] = "dt_pegawai.nip_baru = dt_pak.nip_baru and (dt_pegawai.nip_baru = '$txtcari' or nama LIKE '%$txtcari%' or dt_pak.no_pak = '$txtcari') and SUBSTRING_INDEX(SUBSTRING_INDEX(no_pak,'/',3),'/',-1) = 'TP.GURU' and dt_pegawai.id_pegawai = '$id_pegawai' ";
		$all['jika'] = "dt_pegawai.nip_baru = dt_pak.nip_baru and (dt_pegawai.nip_baru = '$txtcari' or nama LIKE '%$txtcari%' or dt_pak.no_pak = '$txtcari') and SUBSTRING_INDEX(SUBSTRING_INDEX(no_pak,'/',3),'/',-1) = 'TP.GURU' and dt_pegawai.id_pegawai = '$id_pegawai' ";
		$_SESSION['cari']="&cari=".$txtcari; //menyiapkan GET cari untuk pagination
		$_SESSION['nama_file']= $nama_file;
} else {
		//defaul data	
		$page['jika'] = "dt_pegawai.nip_baru = dt_pak.nip_baru and SUBSTRING_INDEX(SUBSTRING_INDEX(no_pak,'/',3),'/',-1) = 'TP.GURU' and dt_pegawai.id_pegawai = '$id_pegawai'";
		$all['jika'] = "dt_pegawai.nip_baru = dt_pak.nip_baru and SUBSTRING_INDEX(SUBSTRING_INDEX(no_pak,'/',3),'/',-1) = 'TP.GURU' and dt_pegawai.id_pegawai = '$id_pegawai'";
}
	include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'../kelas/pustaka.php';
	$dataPak	= 	New KelolaDataPak();
	$hasil 		= 	$dataPak->TampilDataPak("dt_pak,dt_pegawai",$page);
	//mencari jumlah data yang harus ditampilkan perhalaman
	$hasil2= $dataPak->TampilDataPak("dt_pak,dt_pegawai",$all);
	$jumdata=0;
	foreach($hasil2 as $j){ $jumdata=$jumdata+1; }
	$jumhal = ceil($jumdata/$dataperhal);
	//penomoran data
	$no=1 + ($nohal*$dataperhal) -$dataperhal;
	foreach($hasil as $r)
	{
	$dataPeg 	= 	mysql_fetch_object(mysql_query("SELECT nama,gelar_dpn,gelar_blk,tmp_lahir,tgl_lahir,jk,nip_baru FROM dt_pegawai WHERE nip_baru='$r->nip_baru' "));
	$glr		=   mysql_fetch_object(mysql_query("SELECT gelar_dpn,gelar_blk FROM tb_pak_guru_pend WHERE no_pak='$r->no_pak' "));
	$d 			= 	New FormatTanggal();	
?>
<tr>
	<td align="center">
		<?php echo $no; ?>
	</td>
	<td width="20%">
		<?php echo $r->no_pak; ?>
	</td>
	<td align="center">
		<?php echo $d->balik($r->tgl_pak); ?>
	</td>
	<td align="center" >
		<?php echo $dataPeg->nip_baru; ?>
	</td>
    <td>
		<?php 
		$g_blk = isset($glr->gelar_blk) ? $glr->gelar_blk : '';
		if ($g_blk == null ) 
		{ $koma = ""; } else { $koma = ", ";};
		$g_dpn = isset($glr->gelar_dpn) ? $glr->gelar_dpn : '';
		if ($g_dpn == null ) 
		{ $titik = ""; } else { $titik = ". ";};
		echo  $g_dpn.$titik.ucwords(strtolower($dataPeg->nama)).$koma.$g_blk;
		?>
	</td>
	<td  align="center">
		<?php
		if ( $dataPeg->jk==1) echo "L";
		if ( $dataPeg->jk==2) echo "P";
		?>
	</td>
	<td>
		<?php 
		//tempat tanggal lahir
		$tl		= $d->balik2($dataPeg->tgl_lahir);
		echo ucwords(strtolower($dataPeg->tmp_lahir)).", ".$tl;
		?>
	</td>
	<td align="center">
		<a href="?page=detail_pak&no_pak=<?php echo $r->no_pak; ?>" class="aksi">DETAIL</a>
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
?>


