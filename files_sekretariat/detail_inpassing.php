<script>
$(function(){
	//alert("detail_inpass");
	$(".loader").show();
	no_pak		= $("#get_pak").val();	
	//alert(no_pak);
	$.ajax({
		url:"./kelas/detail.php",
        data:"op=detail_pak_inpass&no_pak="+no_pak,
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
				$("#tgl_mulai").val(data[7]);
				$("#tgl_sampai").val(data[8]);
				$("#nama_pejabat").val(data[9]);
				//GOL
				$("#nama_gol").val(data[10]);
				$("#tmt_gol").val(data[11]);
				$("#pangkat").val(data[12]);
				$("#jab_lama_guru").val(data[13]);
				$("#jab_baru_guru").val(data[14]);
				//mAsa Kerja
				$("#mk_awal_bln").val(data[17]);
				$("#mk_awal_thn").val(data[18]);
				hitung_mk();
				$("#sekolah").val(data[19]);
				$("#skpd").val(data[20]);
				$("#skpd2").val(data[21]);
				$("#jenjang").val(data[22]);
				$("#jurusan").val(data[23]);
				$("#th_lulus").val(data[24]);
				//JAFUNG
				$("#jafung").val(data[25]);
				$("#tmt_jafung").val(data[26]);
				$("#tugas_mengajar").val(data[27]);
				$("#jenis_guru").val(data[28]);
				//PAK LAMA
				$("#no_pak_lama").val(data[29]);
				//NILAI PAK LAMA
				$("#pend_lama").val(data[30]);
				$("#diklat_lama").val(data[31]);
				$("#pbm_lama").val(data[32]);
				$("#pp_lama").val(data[33]);
				$("#penunjang_lama").val(data[34]);
				$("#pend_baru").val(data[35]);
				$("#diklat_baru").val(data[36]);
				$("#pbm_baru").val(data[37]);
				$("#pp_baru").val(data[38]);
				$("#penunjang_baru").val(data[39]);
				$("#pend").val(data[40]);
				$("#jegur").val(data[41]);
				cek_nilai();
				$(".loader").hide();
            }
        })
	function cek_nilai() {	
				a	= parseFloat(encodeURIComponent(document.getElementById("pend_lama").value));
				b	= parseFloat(encodeURIComponent(document.getElementById("pend_baru").value));
				$("#pend_lama_cetak").val(a.toFixed(3));
				$("#pend_baru_cetak").val(b.toFixed(3));
				$("#jm_pend_cetak").val((a+b).toFixed(3));
				$("#jm_pend").val((a+b).toFixed(3));
				c  	= parseFloat(encodeURIComponent(document.getElementById("diklat_lama").value));
				d	= parseFloat(encodeURIComponent(document.getElementById("diklat_baru").value));
				$("#diklat_lama_cetak").val(c.toFixed(3));
				$("#diklat_baru_cetak").val(d.toFixed(3));
				$("#jm_diklat_cetak").val((c+d).toFixed(3));
				$("#jm_diklat").val((c+d).toFixed(3));
				$("#total_pend_lama").val((a+c).toFixed(3));
				$("#total_pend_baru").val((b+d).toFixed(3));
				$("#total_pend").val((a+b+c+d).toFixed(3));
				$("#total_pend_lama_cetak").val((a+c).toFixed(3));
				$("#total_pend_baru_cetak").val((b+d).toFixed(3));
				$("#total_pend_cetak").val((a+b+c+d).toFixed(3));
				e	= parseFloat(encodeURIComponent(document.getElementById("pbm_lama").value));
				f	= parseFloat(encodeURIComponent(document.getElementById("pbm_baru").value));
				$("#jm_pbm").val((e+f).toFixed(3));
				$("#pbm_lama_cetak").val(e.toFixed(3));
				$("#pbm_baru_cetak").val(f.toFixed(3));
				$("#jm_pbm_cetak").val((e+f).toFixed(3));
				g	= parseFloat(encodeURIComponent(document.getElementById("pp_lama").value));
				h	= parseFloat(encodeURIComponent(document.getElementById("pp_baru").value));
				$("#jm_pp").val((g+h).toFixed(3));
				$("#pp_lama_cetak").val(g.toFixed(3));
				$("#pp_baru_cetak").val(h.toFixed(3));
				$("#jm_pp_cetak").val((g+h).toFixed(3));
				$("#total_unsur_utama_lama").val((a+c+e+g).toFixed(3));
				$("#total_unsur_utama_baru").val((b+d+f+h).toFixed(3));
				$("#total_jm_unsur_utama").val((a+b+c+d+e+f+g+h).toFixed(3));
				$("#total_unsur_utama_lama_cetak").val((a+c+e+g).toFixed(3));
				$("#total_unsur_utama_baru_cetak").val((b+d+f+h).toFixed(3));
				$("#total_jm_unsur_utama_cetak").val((a+b+c+d+e+f+g+h).toFixed(3));
				i	= parseFloat(encodeURIComponent(document.getElementById("penunjang_lama").value));
				j	= parseFloat(encodeURIComponent(document.getElementById("penunjang_baru").value));
				$("#jm_penunjang").val((i+j).toFixed(3));
				$("#penunjang_lama_cetak").val(i.toFixed(3));
				$("#penunjang_baru_cetak").val(j.toFixed(3));
				$("#jm_penunjang_cetak").val((i+j).toFixed(3));
				$("#total_ak_lama").val((a+c+e+g+i).toFixed(3));
				$("#total_ak_baru").val((b+d+f+h+j).toFixed(3));
				$("#total_jm_ak").val((a+b+c+d+e+f+g+h+i+j).toFixed(3));
				$("#total_ak_lama_cetak").val((a+c+e+g+i).toFixed(3));
				$("#total_ak_baru_cetak").val((b+d+f+h+j).toFixed(3));
				$("#total_jm_ak_cetak").val((a+b+c+d+e+f+g+h+i+j).toFixed(3));
				//NILAI INPASS
				k	= parseFloat(encodeURIComponent(document.getElementById("pend").value));
				l	= parseFloat(encodeURIComponent(document.getElementById("diklat").value));
				$("#pend_cetak").val(k.toFixed(3));
				$("#diklat_cetak").val(l.toFixed(3));
				$("#jumlah_pend").val((l+k).toFixed(3));
				$("#jumlah_pend_cetak").val((l+k).toFixed(3));
				var pbt = e+f;
				$("#pi").val((g+h).toFixed(3));
				$("#pi_cetak").val((g+h).toFixed(3));
				$("#pd").val((c+d).toFixed(3));
				var pd = c+d;
				var penunjang = i+j;
				// Jka jumlah pendidikan pak lama lebih besar dari pendi inpass
				// yang terpengaruh adalah nilai PD inpass
				if ( ((a+b) > $("#pend").val()) & ($("#pend").val() != 0 ) )
					{
						$("#pd").val(( ((a+b)-$("#pend").val()) + (c+d) ).toFixed(3));
						var pd =  ((a+b)-$("#pend").val()) + (c+d);
					}
				// Jka jumlah pendidikan pak lama lebih kecil dari pendi inpass
				if ( (a+b) < $("#pend").val() )
					{
						// ambil adri unsur penunjang
						var penunjang = penunjang-($("#pend").val()-(a+b));
						// jika masih kurang ambil dari pbm
						if ( penunjang < 0 ) 
						{
							var pbt = pbt+penunjang;
							var penunjang = 0;
						}
					}
				$("#pd_cetak").val((pd).toFixed(3));	
				$("#pbt_cetak").val((pbt).toFixed(3));
				$("#pbt").val((pbt).toFixed(3));
				//jenis guru
				xx = $("#jegur").val();
				//alert(xx);
				if ( xx == 11 ) { // guru pelajaran
					$("#pembelajaran").val((pbt).toFixed(3));
					$("#pembelajaran_cetak").val((pbt).toFixed(3));
					$("#bimbingan").val("0.000");
					$("#bimbingan_cetak").val("0.000");
					} else if ( xx == 22 ){ //guru BP
					$("#pembelajaran").val("0.000");
					$("#pembelajaran_cetak").val("0.000");
					$("#bimbingan").val((pbt).toFixed(3));
					$("#bimbingan_cetak").val((pbt).toFixed(3));
					} else {
					$("#pembelajaran").val("0.000");
					$("#bimbingan").val("0.000");
					$("#pembelajaran_cetak").val("0.000");
					$("#bimbingan_cetak").val("0.000");
					}
				$("#jm_unsur_utama_inpass").val((k+pbt+pd+g+h).toFixed(3));
				$("#penunjang").val(penunjang.toFixed(3));
				$("#dukung_tugas").val(penunjang.toFixed(3));
				$("#jm_unsur_utama_inpass_cetak").val((k+pbt+pd+g+h).toFixed(3));
				$("#penunjang_cetak").val(penunjang.toFixed(3));
				$("#dukung_tugas_cetak").val(penunjang.toFixed(3));
				$("#jm_dukung_tugas_cetak").val(penunjang.toFixed(3));
				$("#ijazah_tdksesuai_cetak").val("0.000");
				if ($("#pend").val() != 0 ) {
				$("#total_ak_inpass").val((k+pbt+pd+g+h+penunjang).toFixed(3));
				$("#total_ak_inpass_cetak").val((k+pbt+pd+g+h+penunjang).toFixed(3));
				} else {
				$("#total_ak_inpass").val("0.000");
				$("#total_ak_inpass_cetak").val("0.000");
				}
	}
	// fungsi untuk menghitung masa kerja
	function hitung_mk(){
		tmt_gol		= data[11];
		tgl_pak		= data[5];
		mk_awal_thn	= $("#mk_awal_thn").val();
		mk_awal_bln	= $("#mk_awal_bln").val();
		//alert(tmt_gol);
			$.ajax({
						url:"./kelas/proses.php",
                        data:"op=hitung_mk_inpass&tmt_gol="+tmt_gol+
												"&tgl_pak="+tgl_pak+
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
$no_pak = $_GET['no_pak'];
include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'../kelas/pustaka.php';
Connect::getConnection();
$nip = mysql_fetch_object(mysql_query("SELECT nip_baru FROM dt_pak WHERE no_pak='$no_pak' "));
$dt_pegawai = mysql_fetch_object(mysql_query("SELECT id_pegawai FROM dt_pegawai WHERE nip_baru='$nip->nip_baru' "));
?>

</div>
<input type="hidden" value="<?php echo $no_pak;  ?>" id="get_pak">
<img src="./images/loader/load4.gif" class="loader">
<a href="?page=history_pak&aksi=history_pak&id=<?php echo $dt_pegawai->id_pegawai; ?>"><button class="ui-state-default refresh"  >Lihat History PAK</button></a>

<br><br>
<div class="kiri" style="height:1095px">
<table width="94%" class="form" border="1">
<tr>
    <th width="*%">Data Diri Pribadi</th>
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
    <th width="*%">Pendidikan Terakhir</th>
</tr>
<tr>
    <td>
        <table width="100%" border="0">
            <tr>
                <td width="30%">Jenjang</td>
				<td width="*%" >
                   &nbsp;&nbsp;
					<input type="text" size="25px" id="jenjang" disabled>
                </td>
            </tr>
            <tr>
                <td>Jurusan/Tahun Lulus</td>
                <td>
					&nbsp;&nbsp;
					<input type="text" size="35px" id="jurusan" disabled> &nbsp;<input type="text" size="4px"  id="th_lulus" disabled>
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
                <td>Pangkat / TMT Gol </td>
                <td>
                   &nbsp;&nbsp;
				   <input type="text" size="28" id="pangkat" disabled> 
				   <input type="text" id="tmt_gol"  size="10px" disabled>
                </td>
			</tr>
			<tr>
                <td>Jabatan Lama / TMT Jab</td>
                <td>
                   &nbsp;&nbsp;
				   <input type="text" size="28" id="jab_lama_guru" disabled> 
				   <input type="text" id="tmt_jafung" size="10px" disabled >
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
					<textarea style="width:320px; height:40px; padding:2px 0 5px 5px; resize: none; background-color: #e6eaeb;" id="sekolah" disabled></textarea>
					<input type="hidden" size="50px" id="skpd" disabled>
					<input type="hidden" size="50px" id="skpd2" disabled>
                </td>
			</tr>
        </table>
	</td>
</tr>
</table></div><div class="kanan"  style="height:1095px">
<table width="94%" class="form" border="1">
<tr>
    <th width="*%">DATA  INPASSING PAK</td>
</tr>
<tr>
    <td>
        <table width="100%" border="0">
			<tr>
                <td width="30%">No Pak Lama</td>
                <td width="*%" class="isi" >
                    &nbsp;&nbsp;
					<input type="text"  id="no_pak_lama" size="40px" disabled>
                </td>
            </tr>
			<tr>
                <td>Masa Penilaian</td>
                <td>
					&nbsp;&nbsp;
					<input type="text"  id="tgl_mulai" size="10px" disabled> 
					&nbsp; s.d &nbsp; <input type="text" id="tgl_sampai" size="10px" disabled>
                </td>
			</tr> 
            <tr>
                <td width="30%">No Inpassing PAK</td>
                <td width="*%" class="isi" >
                    &nbsp;&nbsp;
					<input type="text"  id="no_pak" size="40px" disabled>
                </td>
            </tr>
			<tr>
                <td>Tgl Inpassing PAK</td>
                <td>
					&nbsp;&nbsp;
					<input type="text" id="tgl_pak" size="10px" disabled>
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
    <th width="50%">KEPMENPAN No 84/ 1993</td>
    <th width="50%">PERMENNEGPAN dan RB No 16 Tahun 2009</td>
</tr>
<tr class="judul">
    <td ><label>1. Unsur Utama</label></td>
    <td><label>1. Unsur Utama</label></td>
</tr>
<tr>
    <td>
		<label>a. Pendidikan</label>
        <table width="100%" border="0">
			<tr>
                <td></td>
                <td align="center" class="isi">
                    Lama
                </td>
                <td align="center" class="isi">
					Baru
                <td align="center" class="isi">
					Jumlah
            </tr>
            <tr>
                <td>Pendidikan Sekolah</td>
                <td>
                    <input  type="text" style="text-align:right; width:45px;"  value="0" id="pend_lama" disabled />
                </td>
                <td>
					<input type="text" style="text-align:right; width:45px;"   value="0" id="pend_baru" disabled  ></td>
                <td>
					<input type="text"   style="text-align:right; width:45px;" id="jm_pend" value="0" disabled ></td>
            </tr>
            <tr>
                <td>Diklat Kedinasan</td>
                <td>
                    <input type="text"  style="text-align:right; width:45px;"  id="diklat_lama" value="0" disabled />
                </td>
                <td>
					<input type="text"  style="text-align:right; width:45px;"  value="0" id="diklat_baru" disabled />
				</td>
                <td>
					<input type="text" style="text-align:right; width:45px;" id="jm_diklat"  value="0" disabled >
				</td>
            </tr>
            <tr>
                <td>Jumlah Pendidikan</td>
                <td>
                    <input type="text"  style="text-align:right; width:45px;" value="0"  id="total_pend_lama" disabled />
                </td>
				<td>
					<input type="text" style="text-align:right; width:45px;" value="0"   value="0" id="total_pend_baru" disabled />
				</td>
                <td>
					<input type="text" style="text-align:right; width:45px;" id="total_pend"  value="0" disabled >
				</td>
            </tr>
        </table>
	</td>
    <td><label>a. Pendidikan</label>
        <table width="100%" border="0">
            <tr>
                <td  width="75%">Pendidikan Sekolah</td>
                <td>
					<input  type="text" style="text-align:right; width:45px;" id="pend"  value="0" disabled>
				</td>
            </tr>
            <tr>
                <td >Diklat Prajabatan</td>
                <td >
					<input type="text" style="text-align:right; width:45px;" id="diklat"  value="0" disabled>
				</td>
            </tr>
			<tr>
                <td >Jumlah Pendidikan</td>
                <td ><input  type="text" style="text-align:right; width:45px;" id="jumlah_pend"  value="0" disabled /></td>
                    </tr>
        </table>
	</td>
</tr>
<tr valign="top">
    <td><label>b. PBM/ Pembimbingan</label>
		<table border="0">
            <tr>
                <td>pbm/ pembimbingan</td>
                <td>
                    <input type="text" style="text-align:right; width:45px;"  value="0" id="pbm_lama" disabled />
                </td>
                <td>
					<input type="text"  style="text-align:right; width:45px;"  value="0" id="pbm_baru" disabled />
				</td>
                <td>
					<input  type="text" style="text-align:right; width:45px;" id="jm_pbm"  value="0"  disabled>
				</td>
            </tr>
        </table>
    </td>
    <td><label>b. PBM / Pembimbingan dan Tugas</label>
        <table width="100%" border="0">
			<tr>
                <td width="75%">PBM</td>
                <td>
					<input type="text" style="text-align:right; width:45px;" id="pbt"  value="0" disabled >
				</td>
            </tr>
            <tr>
                <td width="75%">Pembelajaran</td>
                <td>
					<input type="hidden" id="jegur" >
					<input type="text" style="text-align:right; width:45px;" id="pembelajaran"  value="0" disabled>
				</td>
            </tr>
            <tr>
                <td >Bimbingan</td>
                <td >
					<input type="text" style="text-align:right; width:45px;" id="bimbingan"  value="0" disabled>
				</td>
            </tr>
        </table>
	</td>
</tr>
<tr valign="top">
    <td ><label>c. Pengembangan Profesi</label>
		<table width="100%" border="0">
            <tr>
                <td>Pengembangan Profesi</td>
                <td>
                    <input type="text" style="text-align:right; width:45px;"   id="pp_lama" value="0" disabled />
                </td>
                    <td><input type="text"  style="text-align:right; width:45px;"  value="0" id="pp_baru" disabled />
				</td>
                    <td><input type="text" style="text-align:right; width:45px;" id="jm_pp"  value="0" disabled >
				</td>
            </tr>
        </table>
    </td>
    <td><label>c. Pengembangan Keprofesian Berkelanjutan</label>
        <table width="100%" border="0">
            <tr>
                <td width="75%">Pengembangan Diri</td>
                <td>
					<input type="text" style="text-align:right; width:45px;" id="pd"  value="0" disabled>
				</td>
            </tr>
            <tr>
                <td>Publikasi ilmiah</td>
                <td><input type="text" style="text-align:right; width:45px;" id="pi"  value="0" disabled>
			</td>
            </tr>
            <tr>
                <td>Karya Inovatif</td>
                <td>
					<input type="text" style="text-align:right; width:45px;" id="ki"  value="0" disabled>
				</td>
            </tr>
        </table>                  
	</td>
</tr>
<tr valign="top">
    <td>
		<table width="100%" border="0">
            <tr>
                <td>JUMLAH UNSUR UTAMA</td>
                <td>
                    <input type="text" style="text-align:right; width:45px;"   value="0" id="total_unsur_utama_lama" value="0" disabled />
                </td>
                    <td><input type="text" style="text-align:right; width:45px;"   value="0" id="total_unsur_utama_baru"  disabled >
				</td>
                    <td><input type="text" style="text-align:right; width:45px; " id="total_jm_unsur_utama"  value="0" disabled >
				</td>
            </tr>
        </table>
    </td>
    <td>
        <table width="100%" border="0">
            <tr>
                <td width="75%">JUMLAH UNSUR UTAMA</td>
                <td>
					<input type="text" style="text-align:right; width:45px; " id="jm_unsur_utama_inpass"  value="0" disabled >
				</td>
            </tr>
        </table>                  
	</td>
</tr>
<tr class="judul">
    <td><label>2. Unsur Penunjang</label></td>
    <td><label>2. Unsur Penunjang</label></td>
</tr>
<tr valign="top">
    <td>
		<table width="100%" border="0">
            <tr>
                <td>Unsur Penunjang</td>
                <td>
                    <input type="text" style="text-align:right; width:45px;"   id="penunjang_lama" value="0" disabled />
                </td>
                <td>
					<input type="text" style="text-align:right; width:45px;"   value="0" id="penunjang_baru" disabled />
				</td>
                    <td><input type="text" style="text-align:right; width:45px; " id="jm_penunjang"  value="0" disabled >
				</td>
            </tr>
        </table>
	</td>
    <td>
        <table width="100%" border="0">
            <tr>
                <td width="75%">Unsur Penunjang</td>
                <td>
					<input type="text" style="text-align:right; width:45px; " id="penunjang"  value="0" disabled >
				</td>
            </tr>
            <tr>
                <td>Pendukung Tugas</td>
                <td>
					<input type="text" style="text-align:right; width:45px;" id="dukung_tugas"  value="0" disabled >
				</td>
            </tr>
        </table>                 
	</td>
</tr>
<tr>
    <td>
		<table width="100%" border="0">
            <tr>
                <td>Total Angka Kredit Lama</td>
                <td>
                    <input type="text" style="text-align:right; width:45px;" id="total_ak_lama"   value="0" disabled >
                </td>
                <td >
					<input type="text" style="text-align:right; width:45px;" id="total_ak_baru"  value="0"  disabled>
				</td>
                <td >
					<input type="text"  style="text-align:right; width:45px; " id="total_jm_ak"  value="0" disabled >
				</td>
            </tr>
		</table>
    </td>
    <td>
		<table width="100%" border="0">
            <tr>
                <td width="75%">Total Angka Kredit Inpas</td>
                <td>
					<input type="text" style="text-align:right; width:45px; " id="total_ak_inpass"  value="0" disabled>
				</td>
            </tr>
        </table>
	</td>
</tr>
</table></div> <!-- end kanan -->
