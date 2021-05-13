<?php
  require_once('config.php');
  require_once('menu.php');
?>

Vous pouvez utiliser ce formulaire afin de me contacter.

<form action="contact.php" method="POST">
<p>Nom</p> <input required type="text" name="name">
<p>Email</p> <input type="email" name="email">

<p>Site internet</p> <input required type="text" name="website">


<p>Description courte de la demande</p> <input required type="text" name="description">

<p>Message</p><textarea required name="message" rows="6" cols="25"></textarea><br />
<input type="submit" value="Send"><input type="reset" value="Clear">
</form>


<?php

$name = htmlspecialchars($_POST['name']);
$email = htmlspecialchars($_POST['email']);
$website = htmlspecialchars($_POST['website']);
$description = htmlspecialchars($_POST['description']);
$message = htmlspecialchars($_POST['message']);
$formcontent=" From: $name and $email\n Website: $website \n Message: $message";
$recipient = "contact@alasource.info";
$subject = "Formulaire de contact - $description";
$mailheader = "From: user@alasource.info \r\n";

var_dump($_POST);
if (isset($name, $website, $description, $message, )) {
	mail($recipient, $subject, $formcontent, $mailheader) or die("Error!");
}else{
	echo "Merci de bien vouloir saisir tous les champs obligatoires";
}

?>
