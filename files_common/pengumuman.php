<div id="related-activities">
    <!--  start related-act-top -->
    <div id="related-act-top"> <img src="images/forms/pengumuman.jpg" width="271" height="43" alt="" /> </div>
    <!-- end related-act-top -->
    <!--  start related-act-bottom -->
    <div id="related-act-bottom">
      <!--  start related-act-inner -->
      <div id="related-act-inner">
	  
	  <!-- *************************************************   -->
	  <!--------------   ISI DARI PENGUMUMAN NYA ---------------->
	  <!-- *************************************************   -->
	  
	  <!-- SAMLPE 
        <div class="left"><a href=""><img src="images/forms/krw.png" width="21" height="21" alt="" /></a></div>
        <div class="right">
		
          <h5>Badan Kepegawaian dan Diklat</h5>
          Badan Kepegawaian Daerah mulai terbentuk pada Tahun 2008 pada saat diterapkannya SOTK .... 
		  <a href="http://bkd.karawangkab.go.id/profil/sejarah-singkat"  target="blank">lanjut</a>
          <ul class="greyarrow">
            <li><a href="http://bkd.karawangkab.go.id/" target="blank">Click here to visit</a></li>
          </ul>
        </div>
        <div class="clear"></div>
        <div class="lines-dotted-short"></div>
       
	   -->
	   <?php
			include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'../kelas/pustaka.php';
			Connect::getConnection();
			
			
			$query = mysql_query("SELECT * FROM tb_pengumuman WHERE status = '1' ");
			$no =1;
			while($row=mysql_fetch_array($query))
			{ ?>
				
				<h4><?php echo $row['penulis']; ?></h4>
				<?php echo $row['isi_pengumuman']; ?>
				<div class="clear"></div>
				<div class="lines-dotted-short"></div>		
			<?php } ?>
	   
	  <!-- *************************************************   -->
	  <!--------------   END ISI DARI PENGUMUMAN NYA ------------->
	  <!-- *************************************************   -->
	   
	   
      </div>
      <!-- end related-act-inner -->
      <div class="clear"></div>
    </div>
    <!-- end related-act-bottom -->
  </div>