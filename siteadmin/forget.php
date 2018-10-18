


	
	

<html>
<head>
<title>Change Password</title>
<link href="../css/bootstrap.css" rel="stylesheet" type="text/css">
</head>
 <body>
 <div class="modal-content">
<div class="modal-dialog">
 
     <div align="left" style="margin-left:24px;">
       <h2>Please Input Your email address</h2>
       <?php
if(isset($_POST['submit'])){
	
	$username=$_POST['email'];
	
	$conn=new PDO("mysql:dbhost = 127.0.0.1; dbname=agritech;",'root','');
	$access=$conn->prepare("select * from admin where email_addr=?");
	$access->bindValue(1,$username);
	
	$access->execute();
	$count=0;
	while($rows=$access->fetch(PDO::FETCH_ASSOC)){
		
		$count++;
		}
		if($count===1){
			
			header("location:reset.php");
			
			}
			else{
				
				
				echo"There is no Such user!!";
				
				}
}


?>

       <form method="post"action="forget.php">
          
           Email Address:<br/>
           <input name="email"type="email"id="email"size="40"/>
           <br/><br/><br/>
             <input type="submit"name="submit"id="submit"value="submit"/>
         </form>
		 <a href="forget.php">Forgot Password??</a>
         <p>&nbsp;</p>      
</div>
<br/><br/><br/>
</div>
</div>  
 
 </body>
 </html>