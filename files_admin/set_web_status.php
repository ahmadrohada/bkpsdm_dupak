<?php if(!isset($_SERVER['HTTP_REFERER'])) { ?><script type="text/javascript">document.location  = "./home.php?page=data_guru";</script><?php exit(); }  ?>

<style>

.hover figure img {
	cursor:pointer;
	-webkit-transform: scale(1);
	transform: scale(1);
	-webkit-transition: .3s ease-in-out;
	transition: .3s ease-in-out;
}
.hover figure:hover img {
	-webkit-transform: scale(1.2);
	transform: scale(1.2);
}

.pilihan{
	position:absolute;
	margin-top:-80px;
	margin-left:-50px;
}

</style>

<script>
$(document).ready(function () {

	/**
	$("#polling_button_on").click(function(){
		//alert("tes");
		$.ajax({
		url:"./kelas/proses.php",
		data:"op=set_polling",
		cache:false,
        success:function(msg){
			alert(msg);
			
			update_data_polling();
			$("#polling_button_on").hide();
		}
		})
	
	});
	**/
	//$("#pilihan").val("");
	$("#pilih_mtc").html('<img src="images/forms/00.png" />');
	$("#pilih_online").html('<img src="images/forms/00.png" />');
	
	
	
	
	
	
	$("#mtc").click(function(){
		
		$("#pilih_mtc").html('<img src="images/forms/check.png" />');
		$("#pilih_online").html('<img src="images/forms/00.png" />');
		//alert("tes");
		$.ajax({
		url:"./kelas/proses.php",
		data:"op=set_mtc",
		cache:false,
        success:function(msg){
			//alert(msg);
			
			update_web_status();

		}
		})
		
	});





	$("#online").click(function(){
		$("#pilih_online").html('<img src="images/forms/check.png" />');
		$("#pilih_mtc").html('<img src="images/forms/00.png" />');
		$.ajax({
		url:"./kelas/proses.php",
		data:"op=set_online",
		cache:false,
        success:function(msg){
			//alert(msg);
			
			update_web_status();

		}
		})
	});
	
	
	function update_web_status(){
		$.ajax({
		url:"./kelas/detail.php",
		data:"op=detail_web_status",
		cache:false,
        success:function(msg){
			//alert(msg);
			
			if ( msg == 1){
				$("#pilih_mtc").html('<img src="images/forms/00.png" />');
				$("#pilih_online").html('<img src="images/forms/check.png" />');
			}else{
				$("#pilih_online").html('<img src="images/forms/00.png" />');
				$("#pilih_mtc").html('<img src="images/forms/check.png" />');
			}
			
		}
		})
	}
	update_web_status();
	
	
	
});
</script>

<h3 class="page-header">
SETTING WEB STATUS
</h3>

<div class="detail_guru" >
 	<table border="0" width="100%" cellpadding="0" cellspacing="0" class="data_form">
        <tr valign="top">
			<td width="25%" rowspan="2">
				
			</td>
			<td  width="25%" align="center">
				<div class="hover">
				<div>
					<figure><img id="mtc" src="images/forms/mtc_mode.png" /></figure>
				</div>
				</div>
			</td>
			<td  width="25%" align="center">
				<div class="hover">
				<div>
					<figure><img id="online" src="images/forms/online_mode.png" /></figure>
				</div>
				</div>
			</td>
			<td width="25%" rowspan="2">
				
			</td>
        </tr>
		<tr height="30px">
				<td  width="20%" align="center">
					<span id="pilih_mtc" class="pilihan" ></span>
				</td>
				<td  width="20%" align="center">
					<span id="pilih_online" class="pilihan" ></span>
				</td>
        </tr>
		
	</table>
</div>

