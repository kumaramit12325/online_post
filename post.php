<?php include('header.php')?>
                    <!--/.span3-->
                    <div class="span9">
   			<div class="span9">
	                     
<div class="content">
<div class="module">
<div class="module-head">
<?php require('connection.php');
$id= $_GET['id'];
//print_r(mysql_fetch_array($quer));
$sql=mysql_query("Select * from posts where id=".$id);

while($row=mysql_fetch_array($sql))
{
$user_id=$row['create_by'];

$date=new DateTime($row['Created']);

//$date = new DateTime($row['Created']);

?>
								<h3><?php echo $row['title']; ?></h3>
							</div>


					
				<div class="module-body">
				<dl>
  <dt><?php echo $row['title']; ?> </a></dt>
  <dd align="justify"><?php echo $row['description']; ?></dd>
</dl>
<p><h6>Post Created By <?php  if(!empty($user_id)){

$quer=mysql_query("Select * from admin where id=".$user_id);
$ro=mysql_fetch_array($quer);
if($ro["id"]==$user_id){
echo $ro['name']; 
}else{
$api=mysql_query("Select * from api_users where id=".$user_id);
$rows=mysql_fetch_array($api);

echo $rows['name'];

}

}
  ?> on <?php echo $date->format('d-M-Y'); 

}?></h6>  

 
	</p>	
			
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
        