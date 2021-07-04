<?php
  require_once('config.php');
  require_once('menu.php');
?>

<body>
  <div id="content">
    <p class ="center15">
      Ce site contient des liens vers des contenus que j’estime intéressants. Je peux ou non partager les points de vues des auteurs/contenus présents ici, bonne découverte.
    </p>

    <div class="center25">
        <form >
            <input list="tags-fields" type="search" placeholder="Rechercher" aria-label="Rechercher" oninput='search()' id="searchBox" />
            <datalist id="tags-fields">
                <?php
                    $sql = "SELECT description AS name FROM Field as field WHERE EXISTS (SELECT idInformation FROM Information AS info WHERE field.idField = info.field) UNION (SELECT name FROM Tag as tag WHERE idTag IN (SELECT idTag FROM Information_tag)) ORDER BY name ASC;";

                    $options = Array();
                    if($result = mysqli_query($link, $sql)) {
                        if(mysqli_num_rows($result) > 0){
                            while($row = mysqli_fetch_array($result)) {
                                $options[] = $row['name'];
                            }
                            
                            mysqli_free_result($result);
                        } else {
                            echo "No records matching your query were found.";
                        }
                    } else {
                        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
                    }

                    foreach($options as $option) {
                        echo '<option value="' . $option . '"></option>';
                    }
                ?>
            </datalist>
          <a id="reset" onclick='clean();' aria-current="page" href="#">Reset</a>
        </form>
    </div>

    <?php

    $sql = "SELECT idInformation, Information.description as infodesc, Field.description as fielddesc, Author.name, CategoryMedia.description as cateMediadesc,link, DATE_FORMAT(release_date, '%d/%m/%Y') as datePublication, DATE_FORMAT(insert_date, '%d/%m/%Y') as dateAjout FROM Information
      inner join CategoryMedia on categoryMedia = CategoryMedia.idCategoryMedia
      inner join Field on field = Field.idField
      inner join Author on Author = Author.idAuthor
      order by fielddesc;
      ";

    $sqlInformationTag = "SELECT idInformation, name FROM Information_tag NATURAL JOIN Tag;";
    $informationTag = Array();
    if($resultInformationTag = mysqli_query($link, $sqlInformationTag)) {
        if(mysqli_num_rows($resultInformationTag) > 0){
            while($row = mysqli_fetch_array($resultInformationTag)) {
                $informationId = $row['idInformation'];

                if(empty($informationTag[$informationId])) {
                    $informationTag[$informationId] = Array();
                }

                $informationTag[$informationId][] = $row['name'];
            }
            
            mysqli_free_result($resultInformationTag);
        } else {
            echo "No records matching your query were found.";
        }
    } else {
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
    }

    if($result = mysqli_query($link, $sql)){
        if(mysqli_num_rows($result) > 0){
            echo "<table id='table_id' class='display'>";
            echo "<thead>";
                echo "<tr>";
                    echo "<th>ID</th>";
                    echo "<th>Domaine</th>";
                    echo "<th>Auteur</th>";
                    echo "<th>Type de média</th>";
                    echo "<th>Description</th>";
                    echo "<th data-type='date'>Date de publication</th>";
                    echo "<th data-type='date'>Date d'ajoût</th>";
                    echo "<th class='hidden'>Tags</th>";
                echo "</tr>";
           echo "</thead>";
           echo "<tbody>";
            while($row = mysqli_fetch_array($result)){
                $id = $row['idInformation'];
                $tags = $informationTag[$id];
                if(empty($tags)) {
                    $tags = Array();
                }

                $tagsStr = join(', ', $tags);

                echo "<tr>";
                    echo "<td class='center'>" . $id . "</td>";
                    echo "<td>" . $row['fielddesc'] . "</td>";
                    echo "<td>" . $row['name'] . "</td>";
                    echo "<td>" . $row['cateMediadesc'] . "</td>";
                    echo "<td><a href='" . $row['link'] . "' target='_blank' rel='nofollow'>" . $row['infodesc'] . "</a></td>";
                    echo "<td class='center'>" . $row['datePublication'] . "</td>";
                    echo "<td class='center'>" . $row['dateAjout'] . "</td>";
                    echo "<td class='hidden'>" . $tagsStr . "</td>";
                echo "</tr>";
            }
            echo "</tbody>";
            echo "</table>";
            // Free result set
            mysqli_free_result($result);
        } else{
            echo "No records matching your query were found.";
        }
    } else{
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
      }
    ?>

      <script>
        $(document).ready(function() {
        var table = $('#table_id').DataTable({
              SearchPanes : true,
              responsive: true,
              orderCellsTop: true,
              "pageLength": 25,
              "language": {
                  "lengthMenu": "Afficher _MENU_ enregistrements par page",
                  "zeroRecords": "Aucun résultat trouvé",
                  "info": "Affichage de la page _PAGE_ sur _PAGES_",
                  "infoEmpty": "Aucun résultat disponible",
                  "infoFiltered": "(Filtré à partir de _MAX_ enregistrements totaux)",
                   "paginate": {
                        "first":      "Premier",
                        "last":       "Dernier",
                        "next":       "Suivant",
                        "previous":   "Précédent"
                    },
              },

              initComplete: function () {
                api = this.api();
                api.columns().every( function () {
                  var column = this;
                  var select;
                  if (column.index() != 4){
                    select = $('<select class="select_filter" onclick="event.stopPropagation();"><option value=""></option></select>')
                      .appendTo( $(column.header()) )
                      .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                          $(this).val()
                        );
                        column
                          .search( val ? '^'+val+'$' : '', true, false )
                          .draw();

                        refreshDropdowns();
                      })

                    const dataType = select.parent().data('type');

                    const data = column.order('asc').draw(false).data().unique();
                    let values = [];
                    for(var i = 0; i < data.length; ++i) {
                      values.push($('<div/>').html(data[i]).text());
                    }

                    if(dataType === 'date') {
                      const dateToNumber = (dateStr) => parseInt(dateStr.split('/').reverse().join(''));
                      values = values.sort((a, b) => dateToNumber(b) - dateToNumber(a));
                    }

                    for(var val of values) {
                      select.append( '<option onclick="event.stopPropagation()" value="' + val + '">' + val.substr(0,35) + '</option>' );
                    }
                  }                  
                  selects.push(select);
              } );
          }
        } );
      } );

      var api;
      function refreshSelect(selectData, others) {
        var $select = selectData.$select;
        var data = api.rows().data().filter(d => others.every(o => {
          return !o.value || d[o.dataIndex] === o.value
        }));
        var $options = $select.children('option');

        var optionsToDisplay = [];

        for(var i = 0; i < data.length; ++i) {
          var row = data[i];
          var cellValue = row[selectData.dataIndex];

          var option;
          for(var j = 0; j < $options.length; ++j) {
            if($($options[j]).attr('value') === cellValue) {
              option = $options[j];
              break;
            }
          }

          if(option && !optionsToDisplay.includes(option)) {
            optionsToDisplay.push(option);
          }
        }

        for(var j = 0; j < $options.length; ++j) {
          var option = $options[j];
          if($(option).attr('value')) {
            if(optionsToDisplay.includes(option)) {
              $(option).show();
            } else {
              $(option).hide();
            }
          }
        }
      }

      var selects = [];
      function refreshDropdowns() {
        var selectsData = selects.filter(s => s).map(s => ({
          $select: s,
          value: s.val(),
          dataIndex: selects.indexOf(s)
        }))
        selects.filter(s => s).forEach(s => refreshSelect(selectsData.find(d => d.$select === s), selectsData.filter(d => d.$select !== s)))
      }

      function search(){
        var table = $('#table_id').DataTable();
        var criteria = document.getElementById("searchBox").value;
        console.log(criteria);
        table.search(criteria).draw();
      };

      function clean(){
        var table = $('#table_id').DataTable();

        document.getElementById("searchBox").value = "";

        /*
        for (let item of document.getElementsByClassName("select_filter")) {
            item.selectedIndex=0;
        }
        */

        table.search("").draw();
      };
      </script>

      <?php
        require_once('footer.php');
      ?>
</div>


</body>

</html>
