<?php
  session_start();
  require_once('config.php');
  require_once('menu.php');

  $display = array(
    'name' => '',
    'email' => '',
    'website' => '',
    'description' => '',
    'message' => ''
  );

	if($_SERVER['REQUEST_METHOD'] == 'POST'){
	    foreach($_POST as $key => $value){
	        if(isset($display[$key])){
	            $display[$key] = htmlspecialchars($value);
	        }
	    }
	}
?>

<body>
  <div id="content">
	<h2>Formulaire de contact</h2>
  	<p>Vous pouvez utiliser ce formulaire afin de me contacter.</p>

	<form action="contact.php" method="POST">
	<p>Nom : <br/><input required type="text" name="name" value="<?php echo $display['name']; ?>" maxlength="50" size="45"></p>
	<p>Email : <br/><input type="email" name="email" value="<?php echo $display['email']; ?>" maxlength="50" size="45"></p>

	<p>Site internet : <br/><input required type="text" name="website" value="<?php echo $display['website']; ?>" maxlength="50" size="45"></p>

	<p>Description de la demande : <br/><input required type="text" name="description" value="<?php echo $display['description']; ?>" maxlength="100" size="90"></p>

	<p>Message :<br/><textarea required name="message" value="<?php echo $display['message']; ?>" rows="8" cols="90" maxlength="350"><?php echo $display['message']; ?></textarea></p>

	<p><input type="submit" value="Send"><input type="reset" value="Clear"></p>
	</form>


	<?php
	if ($_SERVER['REQUEST_METHOD'] === 'POST') 
	{
		
		$name = htmlspecialchars($_POST['name']);
		$email = htmlspecialchars($_POST['email']);
		$website = htmlspecialchars($_POST['website']);
		$description = htmlspecialchars($_POST['description']);
		$message = htmlspecialchars($_POST['message']);
		
		if (isset($name, $website, $description, $message, )) {	
			$to = "contact@alasource.info";
	        $subject = "Formulaire de contact - $description\n";
	                  
	        $header = "From:contact@alasource.info\r\n";
	        $header .= "MIME-Version: 1.0\r\n";
	        $header .= "Content-type: text/html\r\n";
	         
	        $retval = mail ($to,$subject,$message,$header);

	        if( $retval == true ) {
				echo "Merci pour votre message !";
	        }else {
	            echo "Erreur dans l'envois du message.";
	        }
		}else
		{
			echo "Merci de bien vouloir saisir tous les champs obligatoires";
		}

	}
	?>

</div>

  <?php
    require_once('footer.php');
  ?>
</body>

</html>
