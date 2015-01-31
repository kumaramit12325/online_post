<?php include('header.php'); ?>
                    <!--/.span3-->
                    <div class="span9">
                        
<div class="content">	
<div class="module">
<div class="module-head">
<h3>Categories List</h3>
							</div>
							<div class="module-body">
							
							<form class="form-horizontal row-fluid" method="post"action="<?php $_PHP_SELF ?>" >
								  <?php 
									
								  require("config.php");
								  if(isset($_POST['submit'])){ 
								  if(empty($_POST['categoryname'])){
								  echo "enter the text";
								  }else{
								  $categoryname = $_POST['categoryname'];
								  								  if(!empty($_SESSION["user_name"]) && $_SESSION['login_attempt']=1){
								 mysql_query("INSERT INTO `categories`( `categoryname`,`created_by`) VALUES ('".$categoryname."','".$_SESSION['user_id']."') "); 
								 }
								 else{
								 mysql_query("INSERT INTO `categories`( `categoryname`,`created_by`) VALUES ('".$categoryname."','".$_SESSION['apiuser_id']."') "); 
							//print_r($categoryname);
								 }
                                 }								 
								 }

								 
									 if(!empty($_GET['id'])){
								 
								 $category_id = $_GET['id'];
								  $q= mysql_query("SELECT * FROM `categories` WHERE `category_id`=".$category_id);
								 //print_r(mysql_affected_rows($conn));
								//	print_r($q);
								 if(!empty(mysql_num_rows($q))){
								 $category_id = $_GET['id'];
								
								 $quer = mysql_query("DELETE FROM categories WHERE category_id=".$category_id);	
                             
							   echo "Category is Delete";
							   			 // print_r(count($quer));
							  
							   //$url1=$_SERVER['REQUEST_URI'];
header("Refresh: 5; URL=categories.php");

              
               }
              else{ 
			 // header('Location: categories.php');
             echo "not delete";
              }
			  }
  			                     	  			  


           		
							 
			  
								 ?>	
								 
							<div class="control-group">
											<label class="control-label" for="categoryname">Category Name</label>
											<div class="controls">
												<input type="text" id="categoryname" name="categoryname" placeholder="Type something here..." class="span8">
												
												<button type="submit" name="submit" class="btn-inverse">Add Category</button>
											</div>
											
										</div>
										

										<br/>
										<table class="table table-striped table-bordered table-condensed">
								  <thead>
									<tr>
									  <th>#</th>
									  <th>Category Name</th>
									  <th>Action</th>
									</tr>
								  </thead>
								  <?php require("config.php");
								   $ser=1;
								  if(!empty($_SESSION["user_name"]) && $_SESSION['login_attempt']=1){
								  $cat=mysql_query("SELECT * FROM categories where created_by=".$_SESSION["user_id"]);
                                   

		$sr=1;
			while($row=mysql_fetch_array($cat))
{ 
		?>
								  <tbody>
									
									<tr>
									  <td><?php echo $sr++; ?></td>
									  <td><?php echo  $row['categoryname']; ?></td>
									  <td><a href="categories.php?id=<?php echo  $row['category_id']; ?>" title="Delete" onclick="return confirm('Are you sure Delete the category?')" class="icon-2 info-tooltip">Delete</a></td>
								</tr>
								<?php  } } else { 
		   $api=mysql_query("SELECT * FROM categories where created_by=".$_SESSION["apiuser_id"]);
		  
		   While($rows=mysql_fetch_array($api)){
//print_r($rows);		   ?> <tr>
		                            <td><?php echo $ser++; ?></td>
									  <td><?php echo  $rows['categoryname']; ?></td>
									  <td><a href="categories.php?id=<?php echo  $rows['category_id']; ?>" title="Delete" onclick="return confirm('Are you sure Delete the category?')" class="icon-2 info-tooltip">Delete</a></td>
<?php		   
								} }	?>
									</tr>

								  </tbody>
								</table>

										
										</div>
</form>
</div>
      </div>
	  </div>
	   </div>
            </div>
            <!--/.container-->
        </div>
		<?php include('footer.php'); ?>