<?php
	require_once('../config.php');
	require_once('../menu.php');

	define("NB_TAG_MAX", 5);
	define("NB_AUTHOR_MAX", 10);
	define("NON_SAISI_VALUE", 1000);

	function error($msg) {
		echo "<p class='alert-danger alert'>" . $msg . "</p>";
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

	function displayWarningDataAlreadyInsert() {
		echo "<p class='alert-warning alert'><b>Aucune requête SQL n'a été executée - Donnée déjà présente en bdd !</b></p>";
	}

	if(DEBUG){
		echo "<pre>", var_dump($_POST), "</pre>";
	}

	function execPrepareStmt($sql, $params) {
		global $link;

		if(DEBUG){
			echo "<pre>", var_dump($sql, $params), "</pre>";
		}		

		$statement = mysqli_prepare($link, $sql);

		mysqli_stmt_bind_param($statement, ...$params);

		$result = mysqli_stmt_execute($statement);
	
		mysqli_stmt_close($statement);

		return $result;
	}

	$missingValues = true;

	function listDelete($table, $idKey, $keys, $tableClass = '') {
		global $link;
		global $missingValues;

		array_unshift($keys, $idKey);

		$deleteType = $table;
		if (isset($_POST['delete-type']) AND $_POST['delete-type'] === $deleteType) {
			$deleteId = $_POST['delete-id'];


			if( $idKey == 'idInformation'){
				$sqlDelete = "DELETE FROM Information_tag WHERE " . $idKey . " = " . $deleteId;
				$result = mysqli_query($link, $sqlDelete);

				if (!$result) {
					displayError();
				} else {
					displaySuccess();
				}

				$sqlDelete = "DELETE FROM Information_author WHERE " . $idKey . " = " . $deleteId;
				$result = mysqli_query($link, $sqlDelete);

				if (!$result) {
					displayError();
				} else {
					displaySuccess();
				}
			}

			if($table == 'Author'){
				$sql = "SELECT idAuthor FROM info.Information_author where idAuthor = " . NON_SAISI_VALUE . ";";
				$result = mysqli_query($link, $sql);
				
				if(is_null(mysqli_fetch_array($result))){
					$result = execPrepareStmt(
						"UPDATE Information_author SET idAuthor = " . NON_SAISI_VALUE . " WHERE " . $idKey . " = ?",
						[
							"i", $deleteId
						]
					);
				}else{
					$result = execPrepareStmt(
						"DELETE FROM Information_author WHERE idAuthor = ?;",
						[
							"i", $deleteId
						]
					);
				}
	
				var_dump($result);
				if ($result) {
					displaySuccess();
				} else {
					displayError();
				}
			}

			if($table == 'CategoryMedia'){
				$result = execPrepareStmt(
					"UPDATE Information SET categoryMedia = " . NON_SAISI_VALUE . " WHERE categoryMedia = ?",
					[
						"i", $deleteId
					]
				);
	
				if ($result) {
					displaySuccess();
				} else {
					displayError();
				}
			}

			if($table == 'Tag'){				
				$result = execPrepareStmt(
					"UPDATE Information SET field = " . NON_SAISI_VALUE . " WHERE field = ?",
					[
						"i", $deleteId
					]
				);
	
				if ($result) {
					displaySuccess();
				} else {
					displayError();
				}

				$sql = "SELECT idTag FROM info.Information_tag where idTag = " . NON_SAISI_VALUE . ";";
				$result = mysqli_query($link, $sql);
				
				if(is_null(mysqli_fetch_array($result))){
					$result = execPrepareStmt(
						"UPDATE Information_tag SET idTag = " . NON_SAISI_VALUE . " WHERE idTag = ?",
						[
							"i", $deleteId
						]
					);
				}else{
					$result = execPrepareStmt(
						"DELETE FROM Information_tag WHERE idTag = ?;",
						[
							"i", $deleteId
						]
					);
				}
				$missingValues = false;

				if ($result) {
					displaySuccess();
				} else {
					displayError();
				}
			}

			$result = execPrepareStmt(
				"DELETE FROM " . $table . " WHERE " . $idKey . " = ?",
				[
					"i", $deleteId
				]
			);

			if (!$result) {
				displayError();
			} else {
				displaySuccess();
			}
		}
	}

	function generateDeleteTable($table, $idKey, $keys, $tableClass = '') {
		global $link;
		$sql = "SELECT * FROM " . $table;
		$result = mysqli_query($link, $sql);
		$deleteType = $table;

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

		$authorNotEmpty = false;
		for ($i = 1; $i <= NB_AUTHOR_MAX; $i++) {
			if (!is_null($_POST['authorName' . $i]))
			{
				$authorNotEmpty = true;
				break;
			}
		}

		$fieldDescriptionNotEmpty = false;


		listDelete("Information", "idInformation", Array("description"), "deleteTableInformation");
		listDelete("CategoryMedia", "idCategoryMedia", Array("description"));
		listDelete("Author", "idAuthor", Array("name"));
		listDelete("Tag", "idTag", Array("name"));
		
		// Ajout d'une information
		if (!empty($_POST['description']) AND !empty($_POST['fieldDescription']) AND !empty($_POST['release_date']) AND $authorNotEmpty) {
			if ($action === 'insertInformation') {
				
				$sql = "SELECT max(indexDisplayed) as indexDisplayed FROM info.Information;";
				$result = mysqli_query($link, $sql);
				if(mysqli_num_rows($result) > 0) {
					while($row = mysqli_fetch_array($result)) {
						$indexDisplayed = $row['indexDisplayed'];
					}
					mysqli_free_result($result);
				}
				
				$missingValues = false;
				$indexDisplayed = $indexDisplayed + 1;

				$result = execPrepareStmt(
					"INSERT INTO info.Information (description, link, field, categoryMedia, mark, insert_date, release_date, indexDisplayed) VALUES (?, ?, ?, ?, ?, now(), ?, ?)",
					[
						"ssiiisi",
						trim($_POST["description"]),
						trim($_POST['link']) != "" ? trim($_POST["link"]) : null,
						$_POST["fieldDescription"],
						$_POST["categoryMediaDescription"],
						$_POST["mark"],
						$_POST["release_date"],
						$indexDisplayed
					]
				);

				$idInformation = mysqli_insert_id($link);

				$success = true;
				if (!$result) {
					displayError();
					$success = false;
				} else {
					$sql = "INSERT INTO info.Information_tag (idInformation, idTag)	VALUES ('" . $idInformation . "', '" . $_POST["fieldDescription"] . "')";
					$result = mysqli_query($link, $sql);
					for ($i = 1; $i <= NB_TAG_MAX; ++$i) {
						$tagId = $_POST['tagName' . $i];

						if ($tagId) {
							$sql = "INSERT INTO info.Information_tag (idInformation, idTag)	VALUES ('" . $idInformation . "', '" . $tagId . "')";
							$result = mysqli_query($link, $sql);

							if (!$result) {
								displayError();
								$success = false;
							}
						}
					}
					for ($i = 1; $i <= NB_AUTHOR_MAX; ++$i) {
						$authorId = $_POST['authorName' . $i];

						if ($authorId) {
							$sql = "INSERT INTO info.Information_author (idInformation, idAuthor) VALUES (?,?)";
							
							$statement = mysqli_prepare($link, $sql);
							$request = mysqli_stmt_bind_param($statement,
								"ii",
								$idInformation,
								$authorId
							);
							
							$result = mysqli_stmt_execute($statement);
						
							mysqli_stmt_close($statement);

							if (!$result) {
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

				$result = execPrepareStmt(
					"UPDATE info.Information SET description = ?, link = ?, field = ?, categoryMedia = ?, mark = ?, release_date = ? WHERE idInformation = ?",
					[
						"ssiiisi",
						trim($_POST["description"]),
						trim($_POST['link']) != "" ? trim($_POST["link"]) : null,
						$_POST["fieldDescription"],
						$_POST["categoryMediaDescription"],
						$_POST["mark"],
						$_POST["release_date"],
						$idInformation
					]
				);

				$success = true;
				if (!$result) {
					displayError();
					$success = false;
				} else {
					$result = execPrepareStmt(
						"DELETE FROM info.Information_tag WHERE idInformation = ?;",
						[
							"i",
							$idInformation
						]
					);

					if (!$result) {
						displayError();
						$success = false;
					} else {
						$result = execPrepareStmt(
							"INSERT INTO info.Information_tag (idInformation, idTag) VALUES (?, ?)",
							[
								"ii",
								$idInformation,
								$_POST["fieldDescription"]
							]
						);

						for ($i = 1; $i <= NB_TAG_MAX; ++$i) {
							$tagId = $_POST['tagName' . $i];
							$result = true;
							if (!is_null($tagId) AND !empty($tagId) AND $tagId !== $_POST["fieldDescription"]) {									
								$result = execPrepareStmt(							
								"INSERT INTO info.Information_tag (idInformation, idTag) VALUES (?, ?)",
								[
									"ii",
									$idInformation,
									$tagId
								]
								);
							}

							if (!$result) {
								displayError();
								$success = false;
							}
						}
						if($success){
							$result = execPrepareStmt(							
								"DELETE FROM info.Information_author WHERE idInformation = ?;",
								[
									"i",
									$idInformation
								]
							);
		
							if (!$result) {
								displayError();
								$success = false;
							} else {			
								for ($i = 1; $i <= NB_AUTHOR_MAX; ++$i) {
									$authorId = $_POST['authorName' . $i];
		
									if ($authorId) {
										$result = execPrepareStmt(
											"INSERT INTO info.Information_author (idInformation, idAuthor) VALUES (?, ?)",
											[
												"ii",
												$idInformation,
												$authorId,
											]
										);
		
										if (!$result) {
											displayError();
											$success = false;
										}
									}
								}
							}
						}
					}
				}
				if ($success){
					displaySuccess();
				}
			} else {
				error("Paramètre POST 'action' est manquant !");
			}
		}

		// Ajoût d'un auteur
		if (!empty($_POST['name'])) {
			$missingValues = false;

			$sql = "SELECT * FROM info.Author;";
			$result = mysqli_query($link, $sql);

			$authors = [];
			while ($row = mysqli_fetch_array($result)) {
				$authors[] = $row['name'];
			}

			if(! in_array($_POST['name'], $authors)){
				$result = execPrepareStmt(
					"INSERT INTO info.Author (name) VALUES (?)",
					[ "s", $_POST['name'] ]
				);				
				if (!$result) {
					displayError();
				}else{
					displaySuccess();
				}
			}else {
				displayWarningDataAlreadyInsert();
			}
		}

		// Ajoût d'un type de media
		if (!empty($_POST['typedemedia_description'])) {
			$missingValues = false;

			$sql = "SELECT * FROM CategoryMedia ORDER BY description ASC";
			$result = mysqli_query($link, $sql);

			$medias = [];
			while ($row = mysqli_fetch_array($result)) {
				$medias[] = $row['description'];
			}

			if(! in_array($_POST['typedemedia_description'], $medias)){
				$result = execPrepareStmt(
					"INSERT INTO info.CategoryMedia (description) VALUES (?)",
					[ "s", $_POST['typedemedia_description'] ]
				);					
				if (!$result) {
					displayError();
				}else{
					displaySuccess();
				}
			}else {
				displayWarningDataAlreadyInsert();
			}
		}

		// Ajoût d'un nouveau tag
		if (!empty($_POST['tag_name'])) {
			$missingValues = false;

			$sql = "SELECT * FROM Tag as tag ORDER BY REGEXP_REPLACE(name,'^[^a-zA-Z]+? ', '') ASC;";
			$result = mysqli_query($link, $sql);

			$tags = [];
			while ($row = mysqli_fetch_array($result)) {
				$tags[] = $row['name'];
			}

			if(! in_array($_POST['tag_name'], $tags)){
				$result = execPrepareStmt(
					"INSERT INTO info.Tag (name) VALUES (?)",
					[ "s", $_POST['tag_name'] ]
				);							
				if (!$result) {
					displayError();
				}else{
					displaySuccess();
				}
			}else {
				displayWarningDataAlreadyInsert();
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
		console.log(j);
		i.querySelector('[type=submit]').disabled = !idInformation;

		updateValue('description', j.description);
		updateValue('link', j.link);
		updateValue('fieldDescription', j.infoField);
		updateValue('categoryMediaDescription', j.infoCategoryMedia);
		updateValue('mark', j.mark);
		updateValue('release_date', j.infoReleaseDate);
		updateValue('idInformation', idInformation);

		for(var k = 0; k < <?php echo NB_TAG_MAX; ?>; k++){
			updateValue('tagName' + (k+1), "")
		}

		if (j.tags != null) {
			j.tags.split(',').forEach(
				(element,index) => updateValue('tagName' + (index+1), element)
			);
		}

		for(var k = 0; k < <?php echo NB_AUTHOR_MAX; ?>; k++){
			updateValue('authorName' + (k+1), "")
		}

		if (j.authors != null) {
			j.authors.split(',').forEach(
				(element,index) => updateValue('authorName' + (index+1), element)
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
							$sql = "SELECT * FROM Tag as tag ORDER BY REGEXP_REPLACE(name,'^[^a-zA-Z]+? ', '') ASC;";
							$result = mysqli_query($link, $sql);

							echo "<br><label for='fieldDescription'>Domaine :&nbsp;</label>";
							echo "<select name='fieldDescription'>";
							echo "<option value=''></option>";
							while ($row = mysqli_fetch_array($result)) {
								echo "<option value='" . $row['idTag'] . "'>" . $row['name'] . "</option>";
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

							$sql = "SELECT * FROM Author ORDER BY name";
							$result = mysqli_query($link, $sql);

							$authorArray = [];
							while ($row = mysqli_fetch_array($result)) {
								$authorArray[] = Array("id" => $row['idAuthor'], "name" => $row['name']);
							}
							for ($i = 1; $i <= NB_AUTHOR_MAX; ++$i) {
								echo "<br><label for='authorName" . $i . "'>Author " . $i . ": &nbsp;</label>";
								echo "<select class='small_th' name='authorName" . $i . "'>";
								echo "<option value=''></option>";
								foreach ($authorArray as $author) {
									echo "<option value='" . $author['id'] . "'>" . $author['name'] . "</option>";
								}
								echo "</select>&nbsp;";
							}

							echo "<br><label for='mark'>Note :&nbsp;</label>";
							echo "<select class='select-200' name='mark'>";
							echo "<option value='1'>1</option>";
							echo "<option value='2'>2</option>";
							echo "<option value='3'>3</option>";
							echo "<option value='4'>4</option>";
							echo "</select>";

							$sql = "SELECT * FROM Tag as tag ORDER BY REGEXP_REPLACE(name,'^[^a-zA-Z]+? ', '') ASC;";
							$result = mysqli_query($link, $sql);

							$tagArray = [];
							while ($row = mysqli_fetch_array($result)) {
								$tagArray[] = Array("id" => $row['idTag'], "name" => $row['name']);
							}
							for ($i = 1; $i <= NB_TAG_MAX; ++$i) {
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
							$sql = "SELECT Information.*, GROUP_CONCAT(DISTINCT Information_tag.idTag SEPARATOR ',') as tags, GROUP_CONCAT(DISTINCT Information_author.idAuthor SEPARATOR ',') as authors FROM info.Information
							left Join Information_tag on Information_tag.idInformation = Information.idInformation
							left Join Information_author on Information_author.idInformation = Information.idInformation
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
									'authors' => $row['authors'],
									'mark' => $row['mark'],
									'tags' => $row['tags'],
									'infoReleaseDate' => $row['release_date']
								);
							}
							echo "</select><br>";

							$jsEncodedSelectInformationUpdate = json_encode($informationArray);

							echo "<script type='text/javascript'>";
							echo "var jsArraySelectInformationUpdate = ". $jsEncodedSelectInformationUpdate . ";\n";
							echo "</script>";
						?>						

						<label for="description">Description :&nbsp;</label>
						<input type="text" id="description" name="description"><br>
						<label for="link">Lien :&nbsp;</label>
						<input type="text" id="link" name="link">
						<?php
							$sql = "SELECT * FROM Tag as tag ORDER BY REGEXP_REPLACE(name,'^[^a-zA-Z]+? ', '') ASC;";
							$result = mysqli_query($link, $sql);

							echo "<br><label for='fieldDescription'>Domaine :&nbsp;</label>";
							echo "<select name='fieldDescription'>";
							echo "<option value=''></option>";
							while ($row = mysqli_fetch_array($result)) {
								echo "<option value='" . $row['idTag'] . "'>" . $row['name'] . "</option>";
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

							// Authors
							$sql = "SELECT * FROM Author ORDER BY name";
							$result = mysqli_query($link, $sql);

							$authorArray = [];
							while ($row = mysqli_fetch_array($result)) {
								$authorArray[] = Array("id" => $row['idAuthor'], "name" => $row['name']);
							}
							for ($i = 1; $i <= NB_AUTHOR_MAX; ++$i) {
								echo "<br><label for='authorName" . $i . "'>Author " . $i . ": &nbsp;</label>";
								echo "<select class='small_th' name='authorName" . $i . "'>";
								echo "<option value=''></option>";
								foreach ($authorArray as $author) {
									echo "<option value='" . $author['id'] . "'>" . $author['name'] . "</option>";
								}
								echo "</select>&nbsp;";
							}							

							// Mark
							echo "<br><label for='mark'>Note :&nbsp;</label>";
							echo "<select class='select-200' name='mark'>";
							echo "<option value='1'>1</option>";
							echo "<option value='2'>2</option>";
							echo "<option value='3'>3</option>";
							echo "<option value='4'>4</option>";
							echo "</select>";

							// Tags
							$sql = "SELECT * FROM Tag as tag ORDER BY REGEXP_REPLACE(name,'^[^a-zA-Z]+? ', '') ASC;";
							$result = mysqli_query($link, $sql);

							$tagArray = [];
							while ($row = mysqli_fetch_array($result)) {
								$tagArray[] = Array("id" => $row['idTag'], "name" => $row['name']);
							}
							for ($i = 1; $i <= NB_TAG_MAX; ++$i) {
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
				<?php generateDeleteTable("Information", "idInformation", Array("description"), "deleteTableInformation"); ?>
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
				<?php generateDeleteTable("Author", "idAuthor", Array("name")); ?>
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
				<?php generateDeleteTable("CategoryMedia", "idCategoryMedia", Array("description")); ?>
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
				<?php generateDeleteTable("Tag", "idTag", Array("name")); ?>
			</div>
		</div>
	</div>
</div>

<?php
  require_once('../footer.php');
?>