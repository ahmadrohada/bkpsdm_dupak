<?php
**********************************************************
<--====================================================---->	
<h3 class="page-header">
DATA SURAT PENGANTAR&nbsp;&nbsp; [ <?php echo $sekolah; ?> ]
</h3>
<thead>
        <tr>
			<th width="6%">No</th>
            <th width="23%">NO SURAT</th>
            <th width="24%">TANGGAL</th>
			<th >AKSI</th>
        </tr>    
</thead>
<tbody>	
<?php
	$data = mysql_query("SELECT * FROM dt_dupak_pengantar WHERE kd_skpd='$kd_skpd' ");
?>
<tr>
	<td align="center" width="5%">
		<?php echo $no; ?>
	</td>
	<td width="">
		<?php echo $r['no_surat']; ?>
	</td>
    <td align="center">
		<?php echo $d->tgl_form($r['tgl_surat']); ?>
	</td>
	<td align="center">
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