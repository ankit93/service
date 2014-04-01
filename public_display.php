 <?php
 require_once 'data.php' ; 
 if(isset($_GET['id']))
	{
	  global $id,$data,$id,$name,$img,$next,$wpdb;
	  $id=$_GET['id'];
	  $data = $wpdb->get_results( "SELECT * FROM wp_service where id=$id");
	  if (count($data) == 0)
	 	{
		  echo	$msg = "Empty array";
	  	}
	  foreach($data as $row)
	    {
		  $id = $row->id;	
		  $name=$row->ftitle;
		  $content=$row->content;
		  $img=$row->img;
	    ?>
 		 <div class="serviceImg" ><img src="<?php echo plugins_url(); ?>/service/upload/<?php echo $img;?>" /></div>
 		 <div class="serviceContent">
			<div class="serPostTitle"><?php  echo $name ;?></div>
			<div class="postDesc">
 				<?php echo $content; ?>
			</div>
			<?php $next = $wpdb->get_results( "SELECT id FROM wp_service WHERE id > $id limit 1");
			foreach($next as $row)
			 {
			   $next= $row->id;	
			 }
			if(is_numeric($next))
			  { 
			 ?>
			<div class="nextService"><a href="./?id=<?php echo $next  ;?>"><img src="<?php bloginfo('template_directory'); ?>/images/nextService.png"/></a></div>
		<?php } else  {	?>
			<div class="nextService"><a href="<?php echo site_url(); ?>/service/"><img src="<?php bloginfo('template_directory'); ?>/images/back.png"/></a></div>
            <?php } ?>
     </div>
  <?php  	
       }
     }
	   
	   
	   
else{	   
	   	
   $display .= '<div class="pageDesc">The Idea Grove offers a unique combination of old-school experience and online savvy that puts clients at ease and earns their trust.  When you work with our team, you are in good hands.</div>';
 
  global $wpdb,$data,$res;
 
  $results=content();

 foreach ($results as $res)
 {	
  $id = $res->id;	
  $name=$res->ftitle;
  $content=$res->content;
  $img=$res->img;

  $display .= '<div class="industryPostfull">';
  
  $display .='<div class="industryImg"><img src="'.plugins_url().'/service/upload/'.$img.'"/></div>';

  $display .='<div class="contentfull">';
  $display .='<div class="serPostTitle"><a href="./?id='.$id .'">'. $name .'</a></div>';
  
  $display .='<div class="postDesc">'.$string=substr(strip_tags($content), 0, 170)."...".'</div>';
  
  
  $display .='<div class="teaminfo">';

  $display .='<div class="ReadMore2"><a href="./?id='.$id.'">Read More...</a></div>';
  $display .='</div>';

  $display .='</div>';

  $display .='<div class="lineGreyIndustry"></div>';

  $display .='</div>';
  
  
  }
  echo $display;
  }
 ?>