<script>
$(function(){
	//alert("detail_inpass");
	$(".loader").show();
	no_pak		= $("#get_pak").val();	
	//alert(no_pak);
	$.ajax({
		url:"./kelas/detail.php",
        data:"op=detail_pak&no_pak="+no_pak,
        cache:false,
            success:function(msg){
			data=msg.split("|");
				//Data PErorangan
				$("#nip_baru").val(data[0]);
				$("#nama").val(data[1]);
				$("#ttl").val(data[2]);
				$("#jk").val(data[3]);
				//Data PAK
				$("#no_pak").val(data[4]);
				$("#tgl_pak").val(data[5]);
				$("#tgl_mulai").val(data[6]);
				$("#tgl_sampai").val(data[7]);
				$("#nama_pejabat").val(data[59]);
				//GOL
				$("#nama_gol").val(data[9]);
				$("#tmt_gol").val(data[10]);
				//alert(data[10]);
				$("#pangkat").val(data[11]);
				$("#jab_lama_guru").val(data[12]);
				$("#jab_baru_guru").val(data[13]);
				//mAsa Kerja
				$("#mk_awal_bln").val(data[16]);
				$("#mk_awal_thn").val(data[17]);
				masa_kerja();
				$("#sekolah").val(data[18]);
				//alert(data[18]);
				$("#kd_skpd").val(data[19]);
				$("#jenjang").val(data[60]);
				$("#jurusan").val(data[21]);
				$("#th_lulus").val(data[22]);
				//JAFUNG
				$("#tugas_mengajar").val(data[23]);
				$("#tmt_jafung").val(data[24]);
				$("#jenis_guru").val(data[25]);
				//Nilai PAK
				$("#pend_lama").val(data[26]);
				$("#pend_baru").val(data[27]);
				$("#pend_total").val(data[28]);
				$("#diklat_lama").val(data[29]);
				$("#diklat_baru").val(data[30]);
				$("#diklat_total").val(data[31]);
				$("#pbt_lama").val(data[32]);
				$("#pbt_baru").val(data[33]);
				$("#pbt_total").val(data[34]);
				$("#pd_lama").val(data[35]);
				$("#pd_baru").val(data[36]);
				$("#pd_total").val(data[37]);
				$("#pi_lama").val(data[38]);
				$("#pi_baru").val(data[39]);
				$("#pi_total").val(data[40]);
				$("#ki_lama").val(data[41]);
				$("#ki_baru").val(data[42]);
				$("#ki_total").val(data[43]);
				$("#unsur_utama_lama").val(data[44]);
				$("#unsur_utama_baru").val(data[45]);
				$("#unsur_utama_total").val(data[46]);
				$("#sttb_tdksesuai_lama").val(data[47]);
				$("#sttb_tdksesuai_baru").val(data[48]);
				$("#sttb_tdksesuai_total").val(data[49]);
				$("#dukung_tugas_lama").val(data[50]);
				$("#dukung_tugas_baru").val(data[51]);
				$("#dukung_tugas_total").val(data[52]);
				$("#unsur_penunjang_lama").val(data[53]);
				$("#unsur_penunjang_baru").val(data[54]);
				$("#unsur_penunjang_total").val(data[55]);
				$("#ak_lama").val(data[56]);
				$("#ak_baru").val(data[57]);
				$("#ak_total").val(data[58]);
				// Tabel Rekomendasi
				hitung_ak_capaian();
				$(".loader").hide();
            }
        })
// fungsi untuk AK -PD
	function hitung_ak_capaian(){
		nip_baru		=  $("#nip_baru").val();
		no_pak			=  $("#no_pak").val();
		pd_baru			= $("#pd_baru").val();// untuk perhitungan update pd_baru pada no pak ini
		ak_total		= $("#ak_total").val();
		//alert(ak_total);
			$.ajax({
						url:"./kelas/proses.php",
                        data:"op=hitung_ak_capaian&nip_baru="+nip_baru+"&no_pak="+no_pak+"&pd_baru="+pd_baru+"&ak_total="+ak_total,
                        cache:false,
                        success:function(msg){
							//alert (msg);
							data=msg.split("|");
							// AK MIN DETAIL
							$("#ak_min_komulatif").val(data[0]);
							$("#ak_min_pd").val(data[1]);
							$("#ak_min_piki").val(data[2]);
							$("#ak_capaian_komulatif").val(data[3]);
							$("#ak_capaian_pd").val(data[4]);
							$("#ak_capaian_piki").val(data[5]);
							$("#kesimpulan_komulatif").val(data[6]);
							$("#kesimpulan_pd").val(data[7]);
							$("#kesimpulan_piki").val(data[8]);
							// AK MIN cetak
							$("#ak_min_komulatif_cetak").val(data[0]);
							$("#ak_min_pd_cetak").val(data[1]);
							$("#ak_min_piki_cetak").val(data[2]);
							$("#kesimpulan_komulatif_cetak").val(data[6]);
							$("#kesimpulan_pd_cetak").val(data[7]);
							$("#kesimpulan_piki_cetak").val(data[8]);//centang PIKI							$("#makalah").val(data[9]);							if ( data[9] == "Wajib" ) {							if ( data[10] >=1) {								document.getElementById("capaian_makalah").checked = true;								$("#kesimpulan_makalah").val("Terpenuhi");								$("#kesimpulan_makalah_cetak").val("Terpenuhi");								var makalah = 1;							}else{								document.getElementById("capaian_makalah").checked = false;								$("#kesimpulan_makalah").val("Belum Terpenuhi");								$("#kesimpulan_makalah_cetak").val("Belum Terpenuhi");								var makalah = 0;							}							}else{								document.getElementById("capaian_makalah").checked = false;								$("#kesimpulan_makalah").val("");								$("#kesimpulan_makalah_cetak").val("Tidak Wajib");								var makalah = 1;							}														$("#artikel").val(data[11]);							if ( data[11] == "Wajib" ) {							if ( data[12] >= 1) {								document.getElementById("capaian_artikel").checked = true;								$("#kesimpulan_artikel").val("Terpenuhi");								$("#kesimpulan_artikel_cetak").val("Terpenuhi");								var artikel = 1;							}else{								document.getElementById("capaian_artikel").checked = false;								$("#kesimpulan_artikel").val("Belum Terpenuhi");								$("#kesimpulan_artikel_cetak").val("Belum Terpenuhi");								var artikel = 0;							}							}else{								document.getElementById("capaian_artikel").checked = false;								$("#kesimpulan_artikel").val("");								$("#kesimpulan_artikel_cetak").val("Tidak Wajib");								var artikel = 1;							}														$("#buku").val(data[13]);							if ( data[13] == "Wajib" ) {							if ( data[14] >= 1) {								document.getElementById("capaian_buku").checked = true;								$("#kesimpulan_buku").val("Terpenuhi");								$("#kesimpulan_buku_cetak").val("Terpenuhi");								var buku = 1;							}else{								document.getElementById("capaian_buku").checked = false;								$("#kesimpulan_buku").val("Belum Terpenuhi");								$("#kesimpulan_buku_cetak").val("Belum Terpenuhi");								var buku = 0;							}							} else {								document.getElementById("capaian_buku").checked = false;								$("#kesimpulan_buku").val("");								$("#kesimpulan_buku_cetak").val("Tidak Wajib");								var buku = 1;							}														//rekom manual							document.getElementById("rekomendasi").value = data[15];														//rekom otomatis							/**							if (  ( data[6] == 'Terpenuhi') &&  ( data[7] == 'Terpenuhi') && ( data[8] == 'Terpenuhi')  &&  ( makalah >= 1) && ( artikel >= 1) && ( buku >= 1)  ) {								document.getElementById("rekomendasi").value = 1;							} else {								document.getElementById("rekomendasi").value = 2;							}							**/
                        }
                    })
	}
	// fungsi untuk menghitung masa kerja
	function masa_kerja(){
		tmt_gol		= data[10];
		tgl_sampai	= data[7];
		mk_awal_thn	= $("#mk_awal_thn").val();
		mk_awal_bln	= $("#mk_awal_bln").val();
		//alert(tgl_sampai);
			$.ajax({
				url:"./kelas/proses.php",				data:"op=hitung_mk_pak&tmt_gol="+tmt_gol+
												"&tgl_sampai="+tgl_sampai+
												"&mk_awal_thn="+mk_awal_thn+
												"&mk_awal_bln="+mk_awal_bln,
                        cache:false,
                        success:function(msg){
							data=msg.split("|");
							//alert (msg);
							$("#jm_mk_thn").val(data[0]);
							$("#jm_mk_bln").val(data[1]);
							//field cetak
							//$("#mk_awal_thn_cetak").val(mk_awal_thn);
							//$("#mk_awal_bln_cetak").val(mk_awal_bln);
							//$("#jm_mk_thn_cetak").val(data[0]);
							//$("#jm_mk_bln_cetak").val(data[1])
                        }
                    })
	}
});
</script>
<div class="media_print">
<?php
$no_pak = $_GET['no_pak'];include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'../kelas/pustaka.php';Connect::getConnection();$nip = mysql_fetch_object(mysql_query("SELECT nip_baru FROM dt_pak WHERE no_pak='$no_pak' "));
$id = mysql_fetch_object(mysql_query("SELECT id_pegawai FROM dt_pegawai WHERE nip_baru='$nip->nip_baru' "));
?>
</div>
<input type="hidden" value="<?php echo $no_pak;  ?>" id="get_pak">
<img src="./images/loader/load4.gif" class="loader"><a href="?page=history_pak&aksi=history_pak&id=<?php echo $id->id_pegawai; ?>"><button class="ui-state-default refresh"  >Lihat History PAK</button></a><br><br>
<div class="kiri" style="height:1195px">
<table width="94%" class="form" border="1">
<tr>
    <th width="*%">Data Perorangan</th>
</tr>
<tr>
    <td>
        <table width="100%" border="0">
            <tr>
                <td width="30%">NIP BARU</td>
                <td width="*%" >
					&nbsp;&nbsp; 
					<input id="nip_baru" type="text" size="30" disabled> 
                </td>
            </tr>
            <tr>
                <td>Nama Lengkap</td>
                <td>
                   &nbsp;&nbsp;
				   <input type="text" size="48"  id="nama"  disabled> 
                </td>
			</tr>
            <tr>
                <td>Tempat Tanggal Lahir</td>
                <td>
                    &nbsp;&nbsp;
					<input type="text" size="48"  id="ttl"  disabled> 
                </td>
			</tr> 
            <tr>
                <td>Jenis Kelamin</td>
                <td>
					&nbsp;&nbsp;
					<input type="text" size="10" id="jk" disabled>
                </td>
			</tr>
        </table>
	</td>
</tr>
</table>
<table width="94%" class="form" border="1">
<tr>
    <th width="*%">DATA PAK</td>
</tr>
<tr>
    <td>
        <table width="100%" border="0">
            <tr>
                <td width="30%">NO PAK</td>
                <td width="*%" class="isi" >
                    &nbsp;&nbsp;
					<input type="text"  id="no_pak" size="40px" disabled>
                </td>
            </tr>
           <tr>
                <td>Tanggal Pak</td>
                <td>
					&nbsp;&nbsp;
					<input type="text" id="tgl_pak" size="8px" disabled>
                </td>
			</tr>
            <tr>
                <td>Masa Penilaian</td>
                <td>
					&nbsp;&nbsp;
					<input type="text"  id="tgl_mulai" size="8px" disabled> 
					&nbsp; s.d &nbsp; <input type="text" id="tgl_sampai" size="8px" disabled>
                </td>
			</tr> 
            <tr>
                <td>Nama Pejabat</td>
                <td>
					&nbsp;&nbsp;
					<input type="text"  id="nama_pejabat" size="34px" disabled> 
                </td>
			</tr>
        </table>
	</td>
</tr>
</table>
<table width="94%" class="form" border="1">
<tr>
    <th width="*%">Pendidikan Terakhir</th>
</tr>
<tr>
    <td>
        <table width="100%" border="0">
            <tr>
                <td width="30%">Jenjang</td>
                <td width="*%" >
					&nbsp;&nbsp;
					<input type="text" size="8px" id="jenjang" disabled>
                </td>
            </tr>
            <tr>
                <td>Jurusan/Tahun Lulus</td>
                <td>
					&nbsp;&nbsp;
					<input type="text" size="38px" id="jurusan" disabled> &nbsp;<input type="text" size="2px"  id="th_lulus" disabled>
                </td>
			</tr>
        </table>
	</td>
</tr>
</table>
<table width="94%" class="form" border="1">
<tr>
    <th width="*%">Golongan dan Masa Kerja</th>
</tr>
<tr>
    <td>
        <table width="100%" border="0">
            <tr>
                <td width="30%">Golongan</td>
                <td width="*%" >
                    &nbsp;&nbsp;
					<input type="text"  id="nama_gol" size="4px" disabled> 
                </td>
            </tr>
            <tr>
                <td>Pangkat / TMT GOL</td>
                <td>
                   &nbsp;&nbsp;
				   <input type="text" size="28" id="pangkat" disabled> 
				   <input type="text" id="tmt_gol"  size="8px" disabled>
                </td>
			</tr>
			<tr>
                <td>Jabatan Lama / TMT Jab</td>
                <td>
                   &nbsp;&nbsp;
				   <input type="text" size="28" id="jab_lama_guru" disabled> 
				   <input type="text" id="tmt_jafung" size="8px" disabled >
                </td>
			</tr>
			<tr>
                <td>Jabatan Baru</td>
                <td>
                   &nbsp;&nbsp;
				   <input type="text" size="28" id="jab_baru_guru" disabled> 
                </td>
			</tr>
			<tr>
                <td>Tugas Mengajar</td>
                <td>
				&nbsp;&nbsp;
				<input type="text" size="40px" id="tugas_mengajar" disabled>
                </td>
			</tr>
			<tr>
                <td>Jenis Guru</td>
                <td>
				&nbsp;&nbsp;
				<input type="text" size="40px" id="jenis_guru" disabled>
                </td>
			</tr>
            <tr>
                <td>Masa Kerja Awal</td>
                <td>
                    &nbsp;&nbsp;
					<input type="text" size="1" id="mk_awal_thn" disabled> Thn &nbsp;&nbsp;&nbsp;&nbsp;
					<input type="text" size="1" id="mk_awal_bln" disabled> Bln
                </td>
			</tr> 
            <tr>
                <td>Masa Kerja Akhir</td>
                <td>
					&nbsp;&nbsp;
					<input type="text" size="1" id="jm_mk_thn" disabled> Thn &nbsp;&nbsp;&nbsp;&nbsp;
					<input type="text" size="1" id="jm_mk_bln" disabled> Bln
                </td>
			</tr>
			<tr>
			    <td width="30%">Sekolah</td>
                <td width="*%" >
                   &nbsp;&nbsp;
					<textarea style="width:330px; height:40px; padding:2px 0 5px 5px; resize: none; background-color: #e6eaeb;" id="sekolah" disabled></textarea>
					<input type="hidden" size="50px" id="kd_skpd" disabled>
                </td>
			</tr>
        </table>
	</td>
</tr>
</table>
</div>
<div class="kanan"  style="height:1195px">
<table width="94%" class="form" border="1">
<tr>
    <th width="*%">PENETAPAN ANGKA KREDIT</th>
	<th width="13%">LAMA</th>
	<th width="13%">BARU</th>
	<th width="13%">JUMLAH</th>
</tr>
<tr class="judul">
    <td colspan="4"><label>1. Unsur Utama</label></td>
</tr>
<tr>
    <td colspan="4">
		<label>a. Pendidikan</label>
        <table width="100%" border="0">
            <tr>
                <td width="*%">Pendidikan Sekolah</td>
                <td width="14%" align="center">
                    <input  class="ak_field"  type="text"   id="pend_lama" disabled />
                </td>
                <td width="13%" align="center">
					<input class="ak_field"  type="text"    value="0" id="pend_baru" disabled  >
				</td>
                <td width="12%" align="center">
					<input class="ak_field" type="text"   id="pend_total" disabled >
				</td>
            </tr>
            <tr>
                <td >Diklat Kedinasan</td>
                <td align="center">
                    <input type="text" class="ak_field"   id="diklat_lama" disabled />
                </td>
                <td align="center">
					<input type="text" class="ak_field"    id="diklat_baru" disabled />
				</td>
                <td align="center">
					<input type="text" class="ak_field" id="diklat_total"  disabled >
				</td>
            </tr>
        </table>
	</td>
</tr>
<tr valign="top">
    <td colspan="4"><label>b.Pembelajaran /Bimbingan dan Tugas Tertentu</label>
		<table WIDTH="100%" border="0">
            <tr>
                <td width="*%">Pembelajaran /Bimbingan dan Tugas Tertentu</td>
                <td width="14%" align="center">
                    <input class="ak_field" type="text"    id="pbt_lama" disabled />
                </td>
                <td width="13%" align="center">
					<input class="ak_field" type="text"    id="pbt_baru"  disabled />
				</td>
                <td width="12%" align="center">
					<input  class="ak_field" type="text" id="pbt_total"    disabled>
				</td>
            </tr>
        </table>
    </td>
</tr>
<tr valign="top">
    <td colspan="4"><label>c. Pengembangan Keprofesian Berkelanjutan</label>
		<table width="100%" border="0">
            <tr>
                <td width="*%">Pengembangan Diri</td>
                <td width="14%" align="center" >
                    <input type="text" class="ak_field"   id="pd_lama" disabled />
                </td >
                <td width="13%" align="center">
					<input type="text"  class="ak_field"   id="pd_baru" disabled  />
				</td>
                <td width="12%" align="center">
					<input type="text" class="ak_field" id="pd_total"   disabled >
				</td>
            </tr>
			<tr>
                <td width="*%">Publikasi Ilmiah</td>
                <td width="14%" align="center">
                    <input type="text" class="ak_field"   id="pi_lama" disabled  />
                </td >
                <td width="13%" align="center">
					<input type="text" class="ak_field"   id="pi_baru" disabled  />
				</td>
                <td width="12%" align="center">
					<input type="text" class="ak_field" id="pi_total"   disabled >
				</td>
            </tr>
			<tr>
                <td width="*%">Karya Inovatif</td>
                <td width="14%" align="center">
                    <input type="text" class="ak_field"   id="ki_lama" disabled  />
                </td>
                <td width="13%" align="center">
					<input type="text"  class="ak_field"   id="ki_baru" disabled  />
				</td>
                <td width="12%" align="center">
					<input type="text" class="ak_field" id="ki_total"   disabled >
				</td>
            </tr>
        </table>
    </td>
</tr>
<tr valign="top">
    <td colspan="4">
		<table width="100%" border="0">
            <tr>
                <td width="*%">JUMLAH UNSUR UTAMA</td>
                <td width="14%" align="center">
                    <input type="text"  class="ak_field" style="font-weight:bold"  id="unsur_utama_lama"   disabled   />
                </td>
                <td width="13%" align="center">
					<input type="text"  class="ak_field" style="font-weight:bold"  id="unsur_utama_baru"  disabled >
				</td>
                <td width="12%" align="center">
					<input type="text" class="ak_field" style="font-weight:bold" id="unsur_utama_total"   disabled >
				</td>
            </tr>
        </table>
    </td>
</tr>
<tr class="judul">
    <td colspan="4"><label>2. Unsur Penunjang</label></td>
</tr>
<tr valign="top">
    <td colspan="4">
		<table width="100%" border="0">
            <tr>
                <td width="*%">Ijazah yang tidak sesuai</td>
                <td width="14%" align="center">
                    <input type="text"  class="ak_field"  id="sttb_tdksesuai_lama" disabled  />
                </td>
                <td width="13%" align="center">
					<input type="text" class="ak_field"    id="sttb_tdksesuai_baru" disabled />
				</td>
                <td width="12%" align="center">
					<input type="text" class="ak_field" align="center" id="sttb_tdksesuai_total"   disabled >
				</td>
            </tr>
			<tr>
                <td width="*%">Pendukung Tugas Guru</td>
                <td width="14%" align="center">
                    <input type="text" class="ak_field"   id="dukung_tugas_lama" disabled />
                </td>
                <td width="13%" align="center">
					<input type="text" class="ak_field"    id="dukung_tugas_baru" disabled />
				</td>
                <td width="12%" align="center">
					<input class="ak_field" type="text" id="dukung_tugas_total"  disabled >
				</td>
            </tr>
        </table>
	</td>
</tr>
<tr valign="top">
    <td colspan="4">
		<table width="100%" border="0">
            <tr>
                <td width="*%">JUMLAH UNSUR PENUNJANG</td>
                <td width="14%" align="center">
                    <input type="text"  class="ak_field" style="font-weight:bold"   id="unsur_penunjang_lama" value="0" disabled />
                </td>
                <td width="13%" align="center">
					<input type="text" class="ak_field" style="font-weight:bold"    id="unsur_penunjang_baru"  disabled >
				</td>
                <td width="12%" align="center">
					<input type="text" class="ak_field" style="font-weight:bold" id="unsur_penunjang_total"  disabled >
				</td>
            </tr>
        </table>
    </td>
</tr>
<tr>
    <td colspan="4">
		<table width="100%" border="0">
            <tr>
                <td width="*%"><b>Total Angka Kredit</b></td>
                <td width="14%" align="center">
                    <input type="text" class="ak_field" style="font-weight:bold" id="ak_lama"    disabled >
                </td>
                <td width="13%" align="center">
					<input type="text" class="ak_field" style="font-weight:bold" id="ak_baru"   disabled>
				</td>
                <td width="12%" align="center">
					<input type="text" class="ak_field" style="font-weight:bold"  id="ak_total"   disabled >
				</td>
            </tr>
		</table>
    </td>
</tr>
</table>
<br>
<?php
include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'../kelas/pustaka.php';
Connect::getConnection();
$pak = mysql_fetch_object(mysql_query("SELECT * FROM dt_pak WHERE no_pak='$no_pak' ORDER BY tgl_pak DESC LIMIT 1"));
$pgr = mysql_fetch_object(mysql_query("SELECT * from tb_pak_guru_gol WHERE no_pak='$no_pak' "));
$gol = mysql_fetch_object(mysql_query("SELECT * from kd_golongan WHERE nama_gol='$pgr->nama_gol' "));
?>
<table width="94%" class="form" border="1">
<tr>
    <th>Rekomendasi</th>
</tr>
<tr>
    <td colspan="4">
        <table width="100%" >
            <tr>
                <td width="43%">
				</td>
                <td width="15%" align="center">
                    AK Min
                </td>
                <td width="17%" align="center">
					AK Capaian
				</td>
                <td width="*%" align="center">
					Kesimpulan
				</td>
            </tr>
			<tr>
                <td width="30%">
					Angka Kredit Komulatif
				</td>
                <td width="15%" align="right" class="isi">
					<input type="text" class="ak_field" style="background:transparent; border:none; font-weight: bold; " id="ak_min_komulatif"  disabled>
                </td>
                <td width="15%" align="right" class="isi">
					<input type="text" class="ak_field"  style="background:transparent; border:none; font-weight: bold; " id="ak_capaian_komulatif" disabled>
				</td>
                <td  width="*%" class="isi">
					<input type="text"  style="background:transparent; border:none; font-weight: bold; " id="kesimpulan_komulatif" disabled>
				</td>
            </tr>
			<tr>
                <td width="30%">
					Angka Kredit Pengembangan Diri
				</td>
                <td width="15%" align="right" class="isi">
					<input type="text" class="ak_field" style="background:transparent; border:none; font-weight: bold; " id="ak_min_pd"  disabled>
                </td>
                <td width="15%" align="right" class="isi">
					<input type="text" class="ak_field" style="background:transparent; border:none; font-weight: bold;" id="ak_capaian_pd" disabled>
				</td>
                <td width="*%"  class="isi">
					<input type="text"  style="background:transparent; border:none; font-weight: bold; " id="kesimpulan_pd" disabled>
				</td>
            </tr>
			<tr>
                <td width="30%">
					Angka Kredit PIKI
				</td>
                <td width="15%" align="right" class="isi">
					<input type="text" class="ak_field" style="background:transparent; border:none; font-weight: bold; " id="ak_min_piki" disabled >
                </td>
                <td width="15%" align="right" class="isi">
					<input type="text" class="ak_field" style="background:transparent; border:none; font-weight: bold;" id="ak_capaian_piki" disabled>
				</td>
                <td width="*%"  class="isi">
					<input type="text"  style="background:transparent; border:none; font-weight: bold; " id="kesimpulan_piki" disabled>
				</td>
            </tr>
			<tr>
                <td width="30%">
					Makalah / Penelitian
				</td>
                <td width="15%" align="right" class="isi">					<input type="text" style="background:transparent; border:none; font-weight: bold; width:34px;" id="makalah" disabled >
                </td>
                <td width="15%" align="center">
					<input type='checkbox' id="capaian_makalah" disabled>
				</td>
                <td width="*%"  class="isi">					<input type="text"  style="background:transparent; border:none; font-weight: bold; " id="kesimpulan_makalah" disabled>
				</td>
            </tr>
			<tr>                <td width="30%">					Artikel di Jurnal				</td>                <td width="15%" align="right" class="isi">					<input type="text" style="background:transparent; border:none; font-weight: bold; width:34px;" id="artikel" disabled >                </td>                <td width="15%" align="center">					<input type='checkbox' id="capaian_artikel" disabled>				</td>                <td width="*%"  class="isi">					<input type="text"  style="background:transparent; border:none; font-weight: bold; " id="kesimpulan_artikel" disabled>				</td>            </tr>			<tr>                <td width="30%">					Buku				</td>                <td width="15%" align="right" class="isi">					<input type="text"  style="background:transparent; border:none; font-weight: bold; width:34px;" id="buku" disabled >                </td>                <td width="15%" align="center">					<input type='checkbox' id="capaian_buku" disabled>				</td>                <td width="*%"  class="isi">					<input type="text"  style="background:transparent; border:none; font-weight: bold; " id="kesimpulan_buku" disabled>				</td>            </tr>
			<tr>
                <td width="30%" height="65px" valign="top">
					Rekomendasi
				</td>
                <td colspan="3" style="padding-left:12px;" >					&nbsp;&nbsp;					<select id="rekomendasi" style="margin-top:-15px; height:50px; width:410px; word-wrap: break-word; background:#e6eaeb;" disabled>						<?php							$row = mysql_query("SELECT * FROM kd_rekomendasi ");							while ($r = mysql_fetch_array($row)){						?>							<option value="<?php echo $r['kd_rekom']; ?>"  selected><?php echo $r['rekomendasi']; ?></option>						<?php } ?>					</select>
                </td>
            </tr>
        </table>  
</tr>
</table></div>