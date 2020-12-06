<style>
	.ui-progressbar .ui-progressbar-value { background-image: url(./css/ui-lightness/images/pbar-ani.gif); }
	.ui-progressbar { height:1.3em; text-align: left; overflow: hidden; margin-bottom:10px; }
	.ui-progressbar .ui-progressbar-value {margin: -1px; height:100%; }
</style>

<script>
$(document).ready(function () {
	$( "#progressbar" ).progressbar({value: 0});
	$("#polling_button_off").hide();
	update_data_polling();
	
	
	$("#polling_button_on").click(function(){
		//alert("tes");
		$.ajax({
		url:"./kelas/proses.php",
		data:"op=set_polling",
		cache:false,
        success:function(msg){
			//alert(msg);
			
			update_data_polling();
			$("#polling_button_on").hide();
			$("#polling_button_off").show();
		}
		})
	
	});
	
	$("#polling_button_off").click(function(){
		//alert("tes");
		$.ajax({
		url:"./kelas/proses.php",
		data:"op=unset_polling",
		cache:false,
        success:function(msg){
			//alert(msg);
			
			update_data_polling();
			$("#polling_button_off").hide();
			$("#polling_button_on").show();
		}
		})
	
	});
	
	

	function update_data_polling(){
		$.ajax({
		url:"./kelas/detail.php",
		data:"op=detail_polling",
		cache:false,
        success:function(msg){
			//alert(msg);
			data=msg.split("|");
			/**
			if ( data[8] == 100){
				$("#polling_button_on").show();
				$("#polling_button_off").hide();
			}else{
				$("#polling_button_off").show();
				$("#polling_button_on").hide();
			}
			**/
			
			$("#status_polling").val(data[1]);
			$("#jm_pengguna").val(data[2]);
			$("#responder").val(data[3]+" / "+data[2]);
			$("#puas").val(data[4]+" / "+data[3]);
			$("#kurang").val(data[5]+" / "+data[3]);
			$("#p_puas").val(data[6]+" %");
			$("#p_kurang").val(data[7]+" %");
			$( "#progressbar" ).progressbar({value: +data[8]});
		
		
		
		}
		})
	}
	
			
	setInterval(function() {	
		update_data_polling();
		
   }, 5000);
	
});
</script>

<h3 class="page-header">
DATA HASIL POLLING PENGGUNA
</h3>

<div class="detail_guru" >
 	<table border="0" width="100%" cellpadding="0" cellspacing="0" class="data_form">
        <tr valign="top">
			<td width="50%"  rowspan="3">
				<table width="100%" border="0" class="data_form">
					<tr>
						<td width="30%">Status Pollling</td>
						<td width="*%" class="isi" >
							&nbsp;&nbsp;
							<input type="text"  id="status_polling" size="15px" disabled>
						</td>
					</tr>
					<tr>
						<td width="30%">Jumlah Pengguna Aktif</td>
						<td width="*%" class="isi" >
							&nbsp;&nbsp;
							<input type="text"  id="jm_pengguna" size="5px" disabled>
						</td>
					</tr>
				   <tr>
						<td>Responder</td>
						<td>
							&nbsp;&nbsp;
							<input type="text" id="responder" size="5px" disabled>
						</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td>
							
						</td>
					</tr> 
					<tr>
						<td>Merasa Puas</td>
						<td>
							&nbsp;&nbsp;
							<input type="text"  id="puas" size="5px" disabled> 
						</td>
					</tr>
					<tr>
						<td>Merasa Kurang Puas</td>
						<td>
							&nbsp;&nbsp;
							<input type="text"  id="kurang" size="5px" disabled> 
						</td>
					</tr>
				</table>

				
			</td>
			<td  width="25%" align="center">
				<div class="hover">
				<div>
					<figure><img id="puas" src="images/forms/bagus.png" /></figure>
				</div>
				</div>
			</td>
			<td  width="25%" align="center">
				<div class="hover">
				<div>
					<figure><img id="kurang_puas" src="images/forms/jelek.png" /></figure>
				</div>
				</div>
			</td>
        </tr>
		<tr valign="top">
			<td  align="center">
					<input type="text"  style="font-family:'serif'; font-size:24px; text-align:center; border:none;" id="p_puas" size="5px" disabled>
			</td>
			<td  align="center">
					<input type="text"  style="font-family:'serif'; font-size:24px; text-align:center; border:none;" id="p_kurang" size="5px" disabled>
			</td>
        </tr>
		<tr valign="top">
			<td  align="center" colspan="2" valign="bottom">
				<button class="ui-state-default lanjut" id="polling_button_on" >Aktifkan Polling Pengguna</button>
				<button class="ui-state-default lanjut" id="polling_button_off" >Matikan Polling Pengguna</button>
			</td>
        </tr>
	</table>
	<div id="progressbar"></div>
</div>

