<?php if(!isset($_SERVER['HTTP_REFERER'])) { ?><script type="text/javascript">document.location  = "./index.php";</script><?php exit(); }  ?>

<script>
$(document).ready(function () {

	$(".detail_pengguna").click(function(){
		var id_pengguna = $(this).attr('value');
		//alert(id_pegawai);
		window.location.assign("?page=detail_pengguna&id="+id_pengguna);
	})
});
</script>

<!--=====================================================- > 
**********************************************************
                  TAMPIL DATA PENGGUNA
**********************************************************
<--====================================================---->	  
<h3 class="page-header">
DATA PENGGUNA
</h3>

<table  width="100%">
<tr>
	<td align="left">
		<a href="?page=tambah_pengguna"><button class="ui-state-default tambah"  >Tambah Pengguna</button></a>
	</td>
	<td align="right">
		<form action="" method="post">
		Cari Nama Pegawai &nbsp;&nbsp;&nbsp;<input  type="text" name="txtcari"  size="20" maxlength="30" > <input type="submit" name="cari" value="Cari">
		</form>
	</td>
</tr>
</table>

<br>

<table border="1" class="data table-hover" width="100%">
<thead>
        <tr>
			<th width="4%">No</th>
			<th width="13%">NIP</th>
            <th width="22%">Nama lengkap</th>
			<th width="3%">JK</th>
			<th width="12%">Username</th>
			<th width="12%">Group</th>
			<th width="*%">Sekolah</th>
			<th width="13%">Log Terakhir</th>
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
$nama_file = "data_pengguna";		
$dataperhal = 20;
$offset = ($nohal - 1) * $dataperhal; //no record awal yang akan ditampilkan


$page= array(); //menampilkan data dengan pagination
$all= array(); //menampilkan data tanpa pagination



$page['limit'] = $offset.",".$dataperhal;

$page['field'] = "dt_dupak_pengguna.*";
$all['field'] = "dt_dupak_pengguna.*";


//PENCARIAN DATA
$_POST['cari'] = isset($_POST['cari']) ? $_POST['cari'] : '';
$_GET['cari'] = isset($_GET['cari']) ? $_GET['cari'] : '';

if( (isset($_POST['cari'])) | (isset($_GET['cari']))){
		if($_POST['cari']!=null){
			$txtcari=$_POST['txtcari'];
		}else
			$txtcari=$_GET['cari'];
		//pencarian data

			$page['jika'] = "nama_pengguna LIKE '%$txtcari%'";
			$all['jika'] = "nama_pengguna LIKE '%$txtcari%'";
		
		$_SESSION['cari']="&cari=".$txtcari; //menyiapkan GET cari untuk pagination
		$_SESSION['nama_file']= $nama_file;

} else {

		
			$page['jika'] = "";
			$all['jika'] = "";

}


	include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'../kelas/pustaka.php';

	$dataPengguna	 	= 	New KelolaPengguna();
	$hasil 				= 	$dataPengguna->TampilDataPengguna("dt_dupak_pengguna",$page);

	//mencari jumlah seluruh data
	$hasil2= $dataPengguna->TampilDataPengguna("dt_dupak_pengguna",$all);
	$jumdata=0;
	foreach($hasil2 as $j){ $jumdata=$jumdata+1; }
	//mencari jumlah data yang harus ditampilkan perhalaman

	$jumhal = ceil($jumdata/$dataperhal);
	//penomoran data
	$no=1 + ($nohal*$dataperhal) -$dataperhal;

	foreach($hasil as $r)
	{
	
	//warna baris
	if ($r->status == 0 ){
		$warna = "red";
	}else{
		$warna = "";
	}
?>
<tr style="color:<?php echo $warna; ?>;">
	<td align="center">
		<?php echo $no; ?>
	</td>
	<td align="center">
		<?php echo $r->nip_pengguna; ?>
	</td>
	<td width="">
		<a href="#" class="detail_pengguna" value="<?php echo $r->id ;?>">
		<?php echo $r->nama_pengguna; ?>
		</a>
	</td>
    <td align="center">
		<?php 
		if ($r->jk == 1) echo "L"; 
		if ($r->jk == 2) echo "P";
		?>
	</td>
	<td align="">
		<?php echo $r->user_login; ?>
	</td>
	<td align="">
		<?php 
			if ( $r->group == 1 ) echo "Admin";
			if ( $r->group == 2 ) echo "Sekretariat";
			if ( $r->group == 3 ) echo "Penilai";
			if ( $r->group == 4 ) echo "Opr Sekolah";
		?>
	</td>

	<td width="">
		<?php
		if ($r->kd_skpd != null ){
			$sql	= mysql_fetch_object(mysql_query("SELECT sekolah as x FROM kd_skpd where kd_skpd='$r->kd_skpd'")); 
			echo $sql->x;
		}else{
			echo "-";
		}
		?>
	</td>
	<td align="center">
		<?php echo $r->time_log; ?>
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
