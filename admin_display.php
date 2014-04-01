<?php 
require_once 'data.php' ; 
global $wpdb;
$table_name = $wpdb->prefix . "service";
if($_POST['send'] == 'Y')
 {
   	echo "add emp";
   	$name = $_POST['Empname'];  
    $desc = $_POST['description']; 
	$image_name= $_FILES["image"]["tmp_name"];
    require_once("thumbnail.php");
    $thumbImgName=thumbnail_image("$image_name", "120", "113", "../wp-content/plugins/service/upload/");
	$data=array('null',$name,$desc,$thumbImgName);
	print_r(insertData($data));
 }
	
if($_POST['update'])
  {
	 echo "update ";
	 $id = $_POST['update'];	
	 $name = $_POST['Empname'];  
     $desc = $_POST['description'];
	 $updateData=array($id ,$name,$desc);
	 updateData($updateData); 		
 }
?>
<?php 
if(isset($_GET['page']))
 {
  $dl=$_GET['dl'];
  if(isset($dl))
 	 {
 	    deleteData($dl); 	
 	 }
 	 
 ?>
 <h1>Service</h1>
 <div class="width:100%">
   <div class="width:100%"> 
     <div style="width:200px;float:left">Name</div>
     <div style="width:200px;float:left">Description</div>
     <div style="width:200px;float:left">Action</div> 
     <br />
   </div>
   <?php
   $data = content();
   foreach($data as $row)
 	{
 	 $id = $row->id;	
  	 $title=$row->ftitle;
  	 $content=$row->content;
   ?>
   <div class="width:100%">
     <div style="width:200px;float:left"><?php echo $title;  ?></div>
     <div style="width:200px;float:left"><?php echo substr(strip_tags($content), 0, 30)."...";  ?></div>
     <div style="width:200px;float:left"><a href="admin.php?page=service&ed=<?php echo $id;?>">edit</a> <a href="admin.php?page=service&dl=<?php echo $id;?>"> delete</a></div> 
   </div><br /> 
  <?php } ?>
 </div>
 
 
<div> 
<?php
$ed=$_GET['ed'];
 	 if(isset($ed))
 	 {	  
 		 $data=$wpdb->get_row("SELECT * FROM $table_name WHERE id=$ed",ARRAY_A   );	
 		 $id = $data['id'];	
    	 $title=$data['ftitle'];
    	 $content=$data['content'];
 ?>	
         <form action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>" method="POST" enctype="multipart/form-data">
             <input type="hidden" name="update" value="<?php echo $id ;?>"/> 
             <div>Title</div>
             <div><input type="text" name="Empname" size="50" value="<?php echo $title ;?>"/></div>  
             <div>Description</div>
             <div><textarea name="description" cols="51" rows="8" ><?php echo $content; ?></textarea></div>
             <div>Image</div>
             <div><input type="file" name="image"/></div>
             <div>Social media</div> 
             <div><input type="submit" value="submit"/></div>
         </form>
<?php }
  else{
?>
        <form action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>" method="POST" enctype="multipart/form-data">
          <input type="hidden" name="send" value="Y"/> 
          <div>Title</div>
          <div><input type="text" name="Empname" size="50"/></div>
          <div>Description</div>
          <div><textarea name="description" cols="51" rows="8" ></textarea></div> 
          <div>Image</div>
          <div><input type="file" name="image"/></div>
          <div><input type="submit" value="submit"/></div>
        </form>
 <?php  }?>
 </div>
 
 
 
 <?php 
 	}
 	else "no";	
 ?>