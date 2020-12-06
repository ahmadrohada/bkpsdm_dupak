<?php if(!isset($_SERVER['HTTP_REFERER'])) { ?><script type="text/javascript">document.location  = "./index.php";</script><?php exit(); }  ?>


<script>
$(document).ready(function () {
	
	
	$( "#tab_new_pengguna" ).tabs( "option", "active", 3 );
	
});
</script>


<div id="tab_new_pengguna">
	
	
  <ul>
	<!-- TAB 0 -->
    <li>
		<a href="files_admin/tab_tambah_pengguna.php?level=administrator">
		<img src="images/forms/admin.png" width="60px" height="60px" class="icon_menu">
		<p style="margin:-40px 0 0 80px;">ADMINISTRATOR</p>
		</a>
	</li>
	<!-- TAB 1 -->
    <li>
		<a href="files_admin/tab_tambah_pengguna.php?level=sekretariat">
		<img src="images/forms/sekretariat.png" width="63px" height="63px" class="icon_menu">
		<p style="margin:-40px 0 0 80px;">SEKRETARIAT</p>
		</a>
	</li>
	
	<!-- TAB 2 -->
    <li>
		<a href="files_admin/tab_tambah_pengguna.php?level=tim_penilai">
		<img src="images/forms/penilai.png" width="60px" height="60px" class="icon_menu">
		<p style="margin:-40px 0 0 80px;">TIM PENILAI</p>
		</a>
	</li>
	<!-- TAB 3 -->
    <li>
		<a href="files_admin/tab_tambah_pengguna.php?level=petugas_sekolah">
		<img src="images/forms/data_entry.png" width="60px" height="60px" class="icon_menu">
		<p style="margin:-40px 0 0 80px;">PETUGAS SEKOLAH</p>
		</a>
	</li>
	
  </ul>
 
</div>
   
    
	
	
	
	
	
</div>



