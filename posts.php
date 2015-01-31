<?php include('header.php')?>
                    <!--/.span3-->
                    <div class="span9">
   			<div class="span9">
	                     
<div class="content">
<div class="module">
<div class="module-head">
<?php require('connection.php');
$id= $_GET['id'];


$sql=mysql_query("Select * from categories where category_id=".$id);
while($row=mysql_fetch_array($sql))
{

?>
								<h3><?php echo $row['categoryname']; }?></h3>
							</div>
							<?php require('connection.php');
$id= $_GET['id'];

$query=mysql_query("Select * from posts where category_id=".$id);


?>
					
				<div class="module-body">
				<?php
while($ro=mysql_fetch_array($query)){ 			
?>
				<dl>
  <dt><a href="post.php?id=<?php echo $ro['id']; ?>" style="text-decoration:None;color:grey"><?php echo $ro['title']; ?> </a></dt>
  <dd align="justify"><?php echo substr($ro['description'],0,200); ?>.......</dd>
</dl>

 
<?php }		
		?>		
			
		</div>
						

						</div>						
	</div>

</div>
                        <!--/.content-->
                    </div>
                    <!--/.span9-->
                </div>
            </div>
            <!--/.container-->
        </div>
        <!--/.wrapper-->
		<?php include('footer.php'); ?>
        