<?php
	require_once('../config.php');
	require_once('../menu.php');

	$NB_TAG_MAX = 5;

	function error($msg) {
		echo("<p class='alert-danger alert'>" . $msg . "</p>");
	}

	function displayError() {
		global $link;

		error("<b>Requête SQL échouée ! : </b>" . mysqli_error($link));
	}

	function displaySuccess() {
		echo "<p class='alert-success alert'><b>Requête SQL réussie !</b></p>";
	}


	function displayWarning() {
		echo "<p class='alert-warning alert'><b>Aucune requête SQL n'a été executée - Données manquantes !</b></p>";
	}

	$missingValues = true;

	function listDelete($table, $idKey, $keys, $tableClass = '') {
		global $link;
		global $missingValues;

		array_unshift($keys, $idKey);

		$deleteType = $table;
		if (isset($_POST['delete-type']) && $_POST['delete-type'] === $deleteType) {
			$deleteId = $_POST['delete-id'];
			$sqlDelete = "DELETE FROM " . $table . " WHERE " . $idKey . " = " . $deleteId;
			$result = mysqli_query($link, $sqlDelete);
			$missingValues = false;

			if ($result === false) {
				displayError();
			} else {
				displaySuccess();
			}
		}

		$sql = "SELECT * FROM " . $table;
		$result = mysqli_query($link, $sql);

		echo "<div><table class='deleteTables " . $tableClass . "'>";
		echo "<thead><tr>";
		echo "<th>ID</th>";
		$first = true;
		foreach ($keys as $key) {
			if ($first) {
				$first = false;
			} else {
				echo "<th>" . $key . "</th>";
			}
		}
		echo "<th>Supprimer</th>";
		echo "</tr></thead><tbody>";
		while ($row = mysqli_fetch_array($result)) {
			echo "<tr>";
			foreach ($keys as $key) {
				echo "<td>" . $row[$key] . "</td>";
			}
			echo "<td><form action=\"\" method=\"post\"><input type=\"hidden\" name=\"delete-type\" value=\"" . $deleteType . "\" /><input type=\"hidden\" name=\"delete-id\" value=\"" . $row[$idKey] . "\" /><input type=\"submit\" value=\"Supprimer\" /></form></td>";
			echo "</tr>";
		}
		echo "</tbody></table></div>";
	}

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$action = $_POST['action'];

		// Ajout d'une information
		if (!empty($_POST['description']) && !empty($_POST['fieldDescription']) && !empty($_POST['authorName']) && !empty($_POST['release_date'])) {
			if ($action === 'insertInformation') {
				
				$sql = "SELECT max(indexDisplayed) as indexDisplayed FROM info.Information;";
				if($result = mysqli_query($link, $sql)) {
					if(mysqli_num_rows($result) > 0){
						while($row = mysqli_fetch_array($result)) {
							$indexDisplayed = $row['indexDisplayed'];
						}						
						mysqli_free_result($result);
					}
				}
				
				$missingValues = false;
				$indexDisplayed = $indexDisplayed + 1 ;

				if($_POST['link'] != ""){
					$sql = "INSERT INTO info.Information (description, link, field,categoryMedia,author,insert_date, release_date, indexDisplayed)	
					VALUES (?, ?, ?, ?, ?, now(), ?, ?)";
					$statement = mysqli_prepare($link, $sql);
					mysqli_stmt_bind_param($statement,
						"ssiiisi",
						$_POST["description"],
						$_POST["link"],
						$_POST["fieldDescription"],
						$_POST["categoryMediaDescription"],
						$_POST["authorName"],
						$_POST["release_date"],
						$indexDisplayed
					);
				}else{					
					$sql = "INSERT INTO info.Information (description, field,categoryMedia,author,insert_date, release_date, indexDisplayed)	
					VALUES (?, ?, ?, ?, now(), ?, ?)";
					$statement = mysqli_prepare($link, $sql);
					mysqli_stmt_bind_param($statement,
						"siiisi",
						$_POST["description"],
						$_POST["fieldDescription"],
						$_POST["categoryMediaDescription"],
						$_POST["authorName"],
						$_POST["release_date"],
						$indexDisplayed
					);
				}				
				var_dump($statement);

				$result = mysqli_stmt_execute($statement);

				$idInformation = mysqli_insert_id($link);

				$success = true;
				if ($result === false) {
					displayError();
					$success = false;
				} else {
					for ($i = 1; $i <= $NB_TAG_MAX; ++$i) {
						$tagId = $_POST['tagName' . $i];

						if ($tagId) {
							$sql = "INSERT INTO info.Information_tag (idInformation, idTag)	VALUES ('" . $idInformation . "', '" . $tagId . "')";
							var_dump($sql);
							$result = mysqli_query($link, $sql);

							if ($result === false) {
								displayError();
								$success = false;
							}
						}
					}
				}
				if ($success){
					displaySuccess();
				}
			} else if ($action === 'updateInformation') {
				$missingValues = false;
				$idInformation = $_POST["idInformation"];

				$sql = "UPDATE info.Information SET description = ?, link = ?, field = ?, categoryMedia = ?, author = ?, release_date = ? WHERE idInformation = ?;";
				var_dump($sql);

				$statement = mysqli_prepare($link, $sql);
				mysqli_stmt_bind_param($statement,
					"ssiiisi",
					$_POST["description"],
					$_POST["link"],
					$_POST["fieldDescription"],
					$_POST["categoryMediaDescription"],
					$_POST["authorName"],
					$_POST["release_date"],
					$idInformation
				);
				$result = mysqli_stmt_execute($statement);

				mysqli_stmt_close($statement);

				$success = true;
				if ($result === false) {
					displayError();
					$success = false;
				} else {
					$sql = "DELETE FROM info.Information_tag WHERE idInformation = ?;";
					var_dump($sql);

					$statement = mysqli_prepare($link, $sql);
					mysqli_stmt_bind_param($statement,
						"i",
						$idInformation
					);
					$result = mysqli_stmt_execute($statement);
					mysqli_stmt_close($statement);

					if ($result === false) {
						displayError();
						$success = false;
					} else {
						for ($i = 1; $i <= $NB_TAG_MAX; ++$i) {
							$tagId = $_POST['tagName' . $i];

							if ($tagId) {
								$sql = "INSERT INTO info.Information_tag (idInformation, idTag)	VALUES ('" . $idInformation . "', '" . $tagId . "')";
								var_dump($sql);
								$result = mysqli_query($link, $sql);

								if ($result === false) {
									displayError();
									$success = false;
								}
							}
						}
					}
				}
				if ($success){
					displaySuccess();
				}
				/*
				if ($result == false) {
					displayError();
				} else {


					$_POST['tagName1']

					displaySuccess();
				}*/
			} else {
				error("Paramètre POST 'action' est manquant !");
			}
		}

		// Ajoût d'un auteur
		if (!empty($_POST['name'])) {
			$missingValues = false;

			var_dump($_POST);
			$author_name = $_POST['name'];
			$sql = "INSERT INTO info.Author (name) 
			VALUES ('" . $author_name . "')";

			$result = mysqli_query($link, $sql);
			var_dump($sql);
						
			if ($result === false) {
				displayError();
			}else{
				displaySuccess();
			}
		}

		// Ajoût d'un domaine
		if (!empty($_POST['field_description'])) {
			$missingValues = false;

			$field_description = $_POST['field_description'];
			$sql = "INSERT INTO info.Field (description) 
			VALUES ('" . $field_description . "')";
			$result = mysqli_query($link, $sql);
			var_dump($sql);
						
			if ($result === false) {
				displayError();
			}else{
				displaySuccess();
			}
		}

		// Ajoût d'un type de media
		if (!empty($_POST['typedemedia_description'])) {
			$missingValues = false;

			$typedemedia_description = $_POST['typedemedia_description'];
			$sql = "INSERT INTO info.CategoryMedia (description) 
			VALUES ('" . $typedemedia_description . "')";
			$result = mysqli_query($link, $sql) or die(mysqli_error($link));;
			var_dump($sql);
						
			if ($result === false) {
				displayError();
			}else{
				displaySuccess();
			}
		}

		// Ajoût d'un nouveau tag
		if (!empty($_POST['tag_name'])) {
			$missingValues = false;

			$tag_name = $_POST['tag_name'];
			$sql = "INSERT INTO info.Tag (name) 
			VALUES ('" . $tag_name . "')";
			$result = mysqli_query($link, $sql);
			var_dump($sql);
						
			if ($result === false) {
				displayError();
			}
		}

		if ($missingValues){
			displayWarning();
		}
	}
?>
<script type="text/javascript">
	function updateInformationSelect(idInformation){
		const i = document.getElementById('updateInformation');
		var j = jsArraySelectInformationUpdate[idInformation] || {};

		i.querySelector('[type=submit]').disabled = !idInformation;

		updateValue('description', j.description);
		updateValue('link', j.link);
		updateValue('fieldDescription', j.infoField);
		updateValue('categoryMediaDescription', j.infoCategoryMedia);
		updateValue('authorName', j.infoAuthor);
		updateValue('release_date', j.infoReleaseDate);
		updateValue('description', j.description);
		updateValue('idInformation', idInformation);

		for(var k = 0; k < <?php echo $NB_TAG_MAX; ?>; k++){
			updateValue('tagName' + (k+1), "")
		}

		if (j.tags != null) {
			j.tags.split(',').forEach(
				(element,index) => updateValue('tagName' + (index+1), element)
			);
		}

		function updateValue(field, value){
			i.querySelector('[name=\'' + field + '\']').value = value || '';
		}
	}
</script>

<div id="content">
	<h1>MAJ de la bdd</h1>

	<div class="container">
		<div class="row">
			<div class="col">
				<h2>Ajout d'une information</h2>
				<p>
					<form action="" method="post">
						<label for="description">Description :&nbsp;</label>
						<input type="text" id="description" name="description">
						<br><label for="link">Lien :&nbsp;</label>
						<input type="text" id="link" name="link">
						<?php
							$sql = "SELECT * FROM Field ORDER BY description ASC";
							$result = mysqli_query($link, $sql);

							echo "<br><label for='fieldDescription'>Domaine :&nbsp;</label>";
							echo "<select name='fieldDescription'>";
							echo "<option value=''></option>";
							while ($row = mysqli_fetch_array($result)) {
								echo "<option value='" . $row['idField'] . "'>" . $row['description'] . "</option>";
							}
							echo "</select>";

							$sql = "SELECT * FROM CategoryMedia ORDER BY description ASC";
							$result = mysqli_query($link, $sql);

							echo "<br><label for='categoryMediaDescription'>Média :&nbsp;</label>";
							echo "<select name='categoryMediaDescription'>";
							echo "<option value=''></option>";
							while ($row = mysqli_fetch_array($result)) {
								echo "<option value='" . $row['idCategoryMedia'] . "'>" . $row['description'] . "</option>";
							}
							echo "</select>";

							$sql = "SELECT * FROM info.Author ORDER BY name ASC;";
							$result = mysqli_query($link, $sql);

							echo "<br><label for='authorName'>Nom de l'auteur :&nbsp;</label>";
							echo "<select class='select-200' name='authorName'>";
							echo "<option value=''></option>";
							while ($row = mysqli_fetch_array($result)) {
								echo "<option value='" . $row['idAuthor'] . "'>" . $row['name'] . "</option>";
							}
							echo "</select>";

							$sql = "SELECT * FROM info.Tag ORDER BY name ASC;";
							$result = mysqli_query($link, $sql);

							$tagArray = [];
							while ($row = mysqli_fetch_array($result)) {
								$tagArray[] = Array("id" => $row['idTag'], "name" => $row['name']);
							}
							for ($i = 1; $i <= $NB_TAG_MAX; ++$i) {
								echo "<br><label for='tagName" . $i . "'>Tag " . $i . ": &nbsp;</label>";
								echo "<select name='tagName" . $i . "'>";
								echo "<option value=''></option>";
								foreach ($tagArray as $tag) {
									echo "<option value='" . $tag['id'] . "'>" . $tag['name'] . "</option>";
								}
								echo "</select>&nbsp;";
							}
						?>
						 <br><label for="release_date">Date de publication :&nbsp;</label>
						 <input type="text" id="release_date" name="release_date" placeholder="yyyy-mm-dd" title="yyyy-mm-dd"size=10>
						 <input type="hidden" name="action" value="insertInformation" />
						 <br><input type="submit" value="Ajouter">
					</form>
				</p>
			</div>			
			<div class="col">
				<h2>Modification d'une information</h2>
				<p>
					<form action="" method="post" id="updateInformation">
						<label for="information">Information :&nbsp;</label>
						<?php
							$sql = "SELECT Information.*, GROUP_CONCAT(Information_tag.idTag SEPARATOR ',') as tags FROM info.Information
								left Join Information_tag on Information_tag.idInformation = Information.idInformation
								group by Information.idInformation
								ORDER BY Information.idInformation ASC;";

							$result = mysqli_query($link, $sql);
							echo "<select class='select-200' onChange='updateInformationSelect(this.value)' name='Information'>";
							echo "<option value=''></option>";

							$informationArray = Array();
							while ($row = mysqli_fetch_array($result)) {
								echo "<option value='" . $row['idInformation'] . "'>" . $row['description'] . "</option>";

								$informationArray[$row['idInformation']] = array(
									'description' => $row['description'],
									'link' => $row['link'],
									'infoField' => $row['field'],
									'infoCategoryMedia' => $row['categoryMedia'],
									'infoAuthor' => $row['author'],
									'infoReleaseDate' => $row['release_date'],
									'tags' => $row['tags']
								);
							}
							echo "</select>";

							$jsEncodedSelectInformationUpdate = json_encode($informationArray);

							echo "<script type='text/javascript'>";
							echo "var jsArraySelectInformationUpdate = ". $jsEncodedSelectInformationUpdate . ";\n";
							echo "</script>";
						?>						

						<label for="description">Description :&nbsp;</label>
						<input type="text" id="description" name="description">
						<br><label for="link">Lien :&nbsp;</label>
						<input type="text" id="link" name="link">
						<?php
							$sql = "SELECT * FROM Field ORDER BY description ASC";
							$result = mysqli_query($link, $sql);

							echo "<br><label for='fieldDescription'>Domaine :&nbsp;</label>";
							echo "<select name='fieldDescription'>";
							echo "<option value=''></option>";
							while ($row = mysqli_fetch_array($result)) {
								echo "<option value='" . $row['idField'] . "'>" . $row['description'] . "</option>";
							}
							echo "</select>";

							$sql = "SELECT * FROM CategoryMedia ORDER BY description ASC";
							$result = mysqli_query($link, $sql);

							echo "<br><label for='categoryMediaDescription'>Média :&nbsp;</label>";
							echo "<select name='categoryMediaDescription'>";
							echo "<option value=''></option>";
							while ($row = mysqli_fetch_array($result)) {
								echo "<option value='" . $row['idCategoryMedia'] . "'>" . $row['description'] . "</option>";
							}
							echo "</select>";

							$sql = "SELECT * FROM info.Author ORDER BY name ASC;";
							$result = mysqli_query($link, $sql);

							echo "<br><label for='authorName'>Nom de l'auteur :&nbsp;</label>";
							echo "<select class='select-200' name='authorName'>";
							echo "<option value=''></option>";
							while ($row = mysqli_fetch_array($result)) {
								echo "<option value='" . $row['idAuthor'] . "'>" . $row['name'] . "</option>";
							}
							echo "</select>";

							$sql = "SELECT * FROM info.Tag ORDER BY name ASC;";
							$result = mysqli_query($link, $sql);

							$tagArray = [];
							while ($row = mysqli_fetch_array($result)) {
								$tagArray[] = Array("id" => $row['idTag'], "name" => $row['name']);
							}
							for ($i = 1; $i <= $NB_TAG_MAX; ++$i) {
								echo "<br><label for='tagName" . $i . "'>Tag " . $i . ": &nbsp;</label>";
								echo "<select name='tagName" . $i . "'>";
								echo "<option value=''></option>";
								foreach ($tagArray as $tag) {
									echo "<option value='" . $tag['id'] . "'>" . $tag['name'] . "</option>";
								}
								echo "</select>&nbsp;";
							}
						?>
						 <br><label for="release_date">Date de publication :&nbsp;</label>
						 <input type="text" id="release_date" name="release_date" placeholder="yyyy-mm-dd" title="yyyy-mm-dd"size=10>
						 <input type="hidden" name="action" value="updateInformation" />
						 <input type="hidden" name="idInformation" />
						 <br><input type="submit" disabled="disabled" value="Mettre à jour">
					</form>
				</p>
			</div>
			<div class="col">
				<h2>Suppression d'une information</h2>
				<?php listDelete("Information", "idInformation", Array("description"), "deleteTableInformation"); ?>
			</div>
		</div>
		<div class="row">
			<div class="col">
			  	<h2>Ajoût d'un auteur</h2>
				<p>
					<form action="" method="post">
					 <label for="name">Nom :&nbsp;</label>
					 <input type="text" id="name" name="name">
					 <input type="submit" value="Ajouter">
					</form>
				</p>
			</div>
			<div class="col">
			  	<h2>Suppression d'un auteur</h2>
				<?php listDelete("Author", "idAuthor", Array("name")); ?>
			</div>
		</div>
		<div class="row">
			<div class="col">
				<h2>Ajoût d'un domaine</h2>
				<p>
					<form action="" method="post">
						<label for="field_description">Nom :&nbsp;</label>
						<input type="text" id="field_description" name="field_description">
						<input type="submit" value="Ajouter">
					</form>
				</p>
			</div>
			<div class="col">
				<h2>Suppression d'un domaine</h2>
				<?php listDelete("Field", "idField", Array("description")); ?>
			</div>
		</div>
		<div class="row">
			<div class="col">
				<h2>Ajoût d'un type de média</h2>
				<p>
					<form action="" method="post">
						<label for="typedemedia_description">Type de média :&nbsp;</label>
						<input type="text" id="typedemedia_description" name="typedemedia_description">
						<input type="submit" value="Ajouter">
					</form>
				</p>
			</div>
			<div class="col">
				<h2>Suppression d'un type de média</h2>
				<?php listDelete("CategoryMedia", "idCategoryMedia", Array("description")); ?>
			</div>
		</div>
		<div class="row">
			<div class="col">
				<h2>Ajoût d'un tag</h2>

				<p>
					<form action="" method="post">
						<label for="tag_name">Nom :&nbsp;</label>
						<input type="text" id="tag_name" name="tag_name">
						<input type="submit" value="Ajouter">
					</form>
				</p>
			</div>
			<div class="col">
				<h2>Suppression d'un tag</h2>
				<?php listDelete("Tag", "idTag", Array("name")); ?>
			</div>
		</div>
	</div>
</div>

<?php
  require_once('../footer.php');
?>