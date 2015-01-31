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
							<form class="form-horizontal row-fluid" method="post" action="<?php $_PHP_SELF ?>" >
							<?php  require('config.php') ;
							
  						$titleErr = $descriptionErr= $category_idErr="";
                           $title = $description =$category_id= "";
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

						   	 //$title=$_POST["title"];
							 //$category_id=$_POST["category"];
							 //$description=$_POST["description"];
							  //print_r($category_id);
							 if(!empty($title)&&!empty($description&&!empty($category_id))){
							 if(!empty($_SESSION["user_name"]) && $_SESSION['login_attempt']=1){
							 $by=$_SESSION["user_id"];
						
							mysql_query("INSERT INTO `posts`( `title`, `description`, `category_id`,`create_by` ) VALUES ('".$title."','".$description."' ,'".$category_id."','".$by."')"); 
			                header('Location: post.php?success_id=1');
} else 		{
					mysql_query("INSERT INTO `posts`( `title`, `description`, `category_id`,`create_by` ) VALUES ('".$title."','".$description."' ,'".$category_id."','".$_SESSION["apiuser_id"]."')"); 
			                header('Location: post.php?success_id=1');
}					
							}//print_r($f);
							}
							?>
								
							<div class="control-group">
											<label class="control-label" for="basicinput">Title</label>
											<div class="controls">
												<input type="text" id="title" name="title" placeholder="Type something here..." class="span8"><?php echo $titleErr;?>
											</div>
										</div>
								
												<div class="control-group">
											<label class="control-label" for="basicinput">Select Category</label>
											<div class="controls">
												<select tabindex="1" data-placeholder="Select here.." name="category" class="span8">
												<option value="">Select here..</option>
		
<?php 	
	// require('config.php');
	if(!empty($_SESSION["user_name"]) && $_SESSION['login_attempt']=1){
		
							$sql=mysql_query("SELECT * FROM categories where created_by=".$_SESSION["user_id"]);
							//mysql_query($sql);
							while($row=mysql_fetch_array($sql)) {
							//print_r($row);
							
?> 
												
	<option value="<?php echo $row['category_id'];?>" >
	<?php echo $row['categoryname']; ?></option>;
<?php 

}
} else {
							$api=mysql_query("SELECT * FROM categories where created_by=".$_SESSION["apiuser_id"]);
							//mysql_query($sql);
							while($rows=mysql_fetch_array($api)) { ?>
								<option value="<?php echo $rows['category_id'];?>" >
	<?php echo $rows['categoryname']; ?></option>;
<?php 
	}
	}
?>
												</select><?php echo $category_idErr;?>
											</div>
										</div>
										
										<div class="control-group">
											<label class="control-label" for="description">Description</label>
											<div class="controls">
												<textarea class="span8" cols="20" rows="10"  name="description" ></textarea><?php echo $descriptionErr;?>
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