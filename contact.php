<?php
  require_once('config.php');
  require_once('menu.php');
?>

<body>
  <div id="content">
  	<p>Vous pouvez utiliser ce formulaire afin de me contacter.</p>

	<form action="contact.php" method="POST">
	<p>Nom : <br/><input required type="text" name="name" maxlength="50" size="45"></p>
	<p>Email : <br/><input type="email" name="email" maxlength="50" size="45"></p>

	<p>Site internet : <br/><input required type="text" name="website" maxlength="50" size="45"></p>

	<p>Description de la demande : <br/><input required type="text" name="description" maxlength="100" size="90"></p>

	<p>Message :<br/><textarea required name="message" rows="8" cols="90" maxlength="350"></textarea></p>
	<p><input type="submit" value="Send"><input type="reset" value="Clear"></p>
	</form>


	<?php

	$name = htmlspecialchars($_POST['name']);
	$email = htmlspecialchars($_POST['email']);
	$website = htmlspecialchars($_POST['website']);
	$description = htmlspecialchars($_POST['description']);
	$message = htmlspecialchars($_POST['message']);
	$formcontent=" From: $name and $email\n Website: $website \n Message: $message";
	$recipient = "contact@alasource.info";
	$subject = "Formulaire de contact - $description\n";
	$mailheader = "From: user@alasource.info \r\n";

	if (isset($name, $website, $description, $message, )) {
		# mail not yet enabled on the server 
		# mail($recipient, $subject, $formcontent, $mailheader) or die("Error!");
		$myfile = fopen("mail/contact.txt", "a");
		$content = mb_strimwidth("From: $name and $email\nWebsite: $website\nMessage: $message\nFormulaire de contact - $description\n$message\n------------------------------------\n", 0, 600, "...");;
		fwrite($myfile, $content); 
		echo "Merci pour votre message !";
	}else{
		echo "Merci de bien vouloir saisir tous les champs obligatoires";
	}

	?>

</div>
</body>

</html>
