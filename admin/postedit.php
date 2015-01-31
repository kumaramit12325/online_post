<?php include('header.php'); ?>
                    <!--/.span3-->
                    <div class="span9">
                        
<div class="content">	
<div class="module">
<div class="module-head">
<h3>Add Post</h3>
							</div>
							<div class="module-body">
					
							
												<a href="post.php" class="btn" >Posts List</a>
											<br>
											<br>
							<form class="form-horizontal row-fluid" method="post"action="<?php $_PHP_SELF  ?>">
							<?php  require('config.php') ;

							
  						$titleErr = $descriptionErr= $category_idErr="";
                           $title = $description =$category_id= "";
						   $id=$_GET["id"];
							if(isset($_POST["submit"])){
						
							
 if ($_SERVER["REQUEST_METHOD"] == "POST") {

   if (empty($_POST["title"])) {
     $titleErr = "Title is required";
   } else {
     $title = $_POST["title"];
   }
   
   if (empty($_POST["description"])) {
     $descriptionErr = "Description is required";
   } else {
     $description = $_POST["description"];
   }
      if (empty($_POST["category"])) {
     $category_idErr = "Category is required";
   } else {
     $category_id = $_POST["category"];
   }
     }      
                          //   $title=$_POST["title"];
							// $category_id=$_POST["category"];
							 //$description=$_POST["description"];
							
							
						   	 //print_r($category_id);
							 if(!empty($title)&&!empty($description&&!empty($category_id))){
							 if(!empty($_SESSION["user_name"]) && $_SESSION['login_attempt']=1){
							 $by=$_SESSION["user_id"];
							mysql_query("update `posts` SET `title` = '".$title."', `category_id` ='".$category_id."',`description` = '".$description."', `create_by` = '".$by."'  Where `id`=".$id); 
                        header('Location: post.php?success_id=2');
						} else{
						mysql_query("update `posts` SET `title` = '".$title."', `category_id` ='".$category_id."',`description` = '".$description."', `create_by` = '".$_SESSION["apiuser_id"]."'  Where `id`=".$id); 
                        header('Location: post.php?success_id=2');
						}
						} 
							}
							//$id=$_GET["id"];
							//print_r($id);
						$post=mysql_query("Select * FROM posts where id=".$id);
						$row=mysql_fetch_array($post);
							?>
								
							<div class="control-group">
											<label class="control-label" for="basicinput">Title</label>
											<div class="controls">
												<input type="text" id="title" name="title" value="<?php echo $row['title'] ;?>" placeholder="Type something here..." class="span8"><?php echo $titleErr;?>
											</div>
										</div>
								
												<div class="control-group">
											<label class="control-label" for="basicinput">Select Category</label>
											<div class="controls">
												<select tabindex="1" data-placeholder="Select here.." name="category" class="span8">
												<option value="">Select here..</option>
		
<?php 	
//	 require('config.php');
			 if(!empty($_SESSION["user_name"]) && $_SESSION['login_attempt']=1){
			
							$sql=mysql_query("SELECT * FROM categories where created_by=".$_SESSION["user_id"]);
							//mysql_query($sql);
							while($ro=mysql_fetch_array($sql)) {
							//print_r($row);
							$selected=($ro['category_id']==$row['category_id']? ' selected="selected"':'')
?> 
												
	<option value="<?php echo $ro['category_id'];?>" <?php echo $selected;?> >
	<?php echo $ro['categoryname']; ?></option>;
<?php 

} }
else{
$ss=mysql_query("SELECT * FROM categories where created_by=".$_SESSION["apiuser_id"]);
							//mysql_query($sql);
							while($rows=mysql_fetch_array($ss)) {
							//print_r($row);
							$selecte=($rows['category_id']==$rows['category_id']? ' selected="selected"':'') ?>
							<option value="<?php echo $rows['category_id'];?>" <?php echo $selecte;?> >
	<?php echo $rows['categoryname']; ?></option>;
	<?php 
 }}
?>
												</select><?php echo $category_idErr;?>
											</div>
										</div>
										
										<div class="control-group">
											<label class="control-label" for="description">Description</label>
											<div class="controls">
												<textarea class="span8" cols="20" rows="10"  name="description" ><?php echo $row['description']; ?></textarea><?php echo $descriptionErr;?>
											</div>
										</div>
										<div class="control-group">
											<div class="controls">
												<button type="submit" name="submit" class="btn-inverse">Save Post</button><a href="post.php" style="text-decoration: none;" class="btn">Cancel</a>
											</div>
										</div>
										</form>
							
</div>
      </div>
	  </div>
	   </div>
            </div>
			</div>
            <!--/.container-->
        </div>
		<?php include('footer.php'); ?>