
		<footer>
			<div class="center paddingBot-5">
				<a href="contact.php">Contact</a> | 
				<a href="mentionslegales.php">Mentions légales</a>
			</div>
		</footer>
	</body>
</html>
<?php
	if (isset($link)) {
		mysqli_close($link);
	}
?>