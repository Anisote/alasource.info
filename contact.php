<?php
  session_start();
  require_once('config.php');
  require_once('menu.php');

  include_once './securimage/securimage.php';
  include_once '/securimage/securimage.php';

  $PATH_SECURIMAGE = '/securimage';

  $securimage = new Securimage();

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

	<p><img id="captcha" src= '<?php echo "$PATH_SECURIMAGE" ?>/securimage_show.php' alt="CAPTCHA Image" />
	<a href="#" onclick="document.getElementById('captcha').src = '<?php echo "$PATH_SECURIMAGE" ?>/securimage_show.php?' + Math.random(); return false">[ Image différente ]</a>
	<input type="text" name="captcha_code" size="10" maxlength="6" /></p>

	<p><input type="submit" value="Send"><input type="reset" value="Clear"></p>
	</form>


	<?php
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {		
		if ($securimage->check($_POST['captcha_code']) == false) {
		  echo "Le code de sécurité est incorrecte, merci de réessayer.<br /><br />";
		}else
		{
			$name = htmlspecialchars($_POST['name']);
			$email = htmlspecialchars($_POST['email']);
			$website = htmlspecialchars($_POST['website']);
			$description = htmlspecialchars($_POST['description']);
			$message = htmlspecialchars($_POST['message']);
			$formcontent=" From: $name and $email\n Website: $website \n Message: $message";
			$recipient = "contact@alasource.info";
			$subject = "Formulaire de contact - $description\n";
			$mailheader = "From: user@alasource.info \r\n";

			if (isset($name, $website, $description, $message, )) {		# mail not yet enabled on the server 
					# mail($recipient, $subject, $formcontent, $mailheader) or die("Error!");
					$myfile = fopen("mail/contact.txt", "a");
					$content = mb_strimwidth("From: $name and $email\nWebsite: $website\nMessage: $message\nFormulaire de contact - $description\n$message\n------------------------------------\n", 0, 600, "...");;
					fwrite($myfile, $content); 
					echo "Merci pour votre message !";

			}else
			{
					echo "Merci de bien vouloir saisir tous les champs obligatoires";
			}
	
		}
	}
	?>

</div>

  <?php
    require_once('footer.php');
  ?>
</body>

</html>
