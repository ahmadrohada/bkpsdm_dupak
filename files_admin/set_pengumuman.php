<script>
$(document).ready(function () {

	
});
</script>

<h3 class="page-header">
PENGUMUMAN
</h3>


<table border="1" class="data table-hover" width="100%">
<thead>
        <tr>
			<th width="4%">No</th>
			<th width="14%">Nama Penulis</th>
			<th width="*%">Isi Pengumuman</th>
			<th width="10%">Status</th>
			<th width="17%">AKSI</th>
        </tr>    
</thead>
<tbody>	
<?php

	include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'../kelas/pustaka.php';

	$dataPak	= 	New KelolaPengumuman();
	$hasil 		= 	$dataPak->TampilDataPengumuman();

	$no=1;
	
	foreach($hasil as $r)
	{
	
?>
<tr>
	<td align="center">
		<?php echo $no; ?>
	</td>
	<td>
		<?php echo $r->penulis; ?>
	</td>
	<td >
	<?php echo $r->isi_pengumuman; ?>
	</td>
	<td align="" >
	
	</td>
	<td >
	<?php
	
	?>
	</td>
</tr>
<?php
$no = $no+1;
}
?>
</tbody>
</table>
