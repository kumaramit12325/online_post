<?php include('header.php'); ?>
                    <!--/.span3-->
                    <div class="span9">
                        
<div class="content">	
<div class="module">
<div class="module-head">
<h3>Posts List</h3>
							</div>
							<div class="module-body">
					
							<form class="form-horizontal row-fluid" method="post"action="<?php $_PHP_SELF ?>" >
								  <?php 
									
								  require("config.php");
								  

								
									 if(!empty($_GET['id'])){
								 
								 $id = $_GET['id'];
								  $q= mysql_query("SELECT * FROM `posts` WHERE `id`=".$id);
								 //print_r(mysql_affected_rows($conn));
								//	print_r($q);
								 if(!empty(mysql_num_rows($q))){
								// $category_id = $_GET['id'];
								
								 $quer = mysql_query("DELETE FROM posts WHERE id=".$id);	
                             
							   echo "post is Delete";
							   			 // print_r(count($quer));
							  
							   //$url1=$_SERVER['REQUEST_URI'];
header("Refresh: 5; URL=post.php");

              
               }
              else{ 
			 // header('Location: categories.php');
             echo "not delete";
              }
			  }
  	if(!empty($_GET['success_id'])){
	
	if ($_GET['success_id']==1) {
    echo "post is Successfully Created";
} elseif ($_GET['success_id']==2) {
     echo "post is Successfully Update";
} else {
  header("location: post.php");
}
	header("Refresh: 5; URL=post.php");
	}
			  
			  

           		
							 
			  
								 ?>	
								  		<div class="module-option clearfix">
												<a href="add_post.php" class="btn"> Add Post</a>
											</div>
					

										<br/>
										<table class="table table-striped table-bordered table-condensed">
								  <thead>
									<tr>
									  <th>#</th>
									  <th>Title Name</th>
									  <th>Category Name</th>
									  <th>Action</th>
									</tr>
								  </thead>
								  <?php require("config.php");
								  if(!empty($_SESSION["user_name"]) && $_SESSION['login_attempt']=1){
			
								  $cat=mysql_query("SELECT * FROM categories, posts where categories.category_id= posts.category_id && categories.created_by=".$_SESSION['user_id']);
                                   
 
		$sr=1;
			while($row=mysql_fetch_array($cat))
{ 

		?>
								  <tbody>
									
									<tr>
									  <td><?php echo $sr++; ?></td>
							          <td><?php echo  $row['title']; ?></td>
									  <td><?php echo  $row['categoryname']; ?></td>
									  <td><a href="postedit.php?id=<?php echo  $row['id']; ?>" title="edit" >Edit</a>&nbsp <a href="post.php?id=<?php echo  $row['id']; ?>" title="Delete" onclick="return confirm('Are you sure Delete the post?')" >Delete</a>
									  </td>
									  </tr>								<?php  }} else { 
									  
								$api=mysql_query("SELECT * FROM categories, posts where categories.category_id= posts.category_id && categories.created_by=".$_SESSION['apiuser_id']);
                                 
										$ser=1;
			while($rows=mysql_fetch_array($api))
{ ?>
<tr>
									  <td><?php echo $ser++; ?></td>
							          <td><?php echo  $rows['title']; ?></td>
									  <td><?php echo  $rows['categoryname']; ?></td>
									  <td><a href="postedit.php?id=<?php echo  $rows['id']; ?>" title="edit" >Edit</a>&nbsp <a href="post.php?id=<?php echo  $row['id']; ?>" title="Delete" onclick="return confirm('Are you sure Delete the post?')" >Delete</a>
									  </td>
								
						<?php 	}} ?>
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