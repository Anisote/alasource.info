<?php
  require_once('config.php');
  require_once('menu.php');
?>

<body>
  <div id="content">
    <p class ="center15">
      Ce site contient des liens vers des contenus que j’estime intéressants. Je peux ou non partager les points de vues des auteurs/contenus présents ici. Bonne découverte
    </p>

   <div class="center25">
    <form >
      <input type="search" placeholder="Rechercher" aria-label="Rechercher" oninput='searchBis()' id="searchBox">
      <a id="reset" onclick='clean();' aria-current="page" href="#">Reset</a>
    </form>
  </div>

    <?php

    $sql = "SELECT idInformation, Information.description as infodesc, Field.description as fielddesc, Author.name, CategoryMedia.description as cateMediadesc,link, date_ajout FROM Information
      inner join CategoryMedia on categoryMedia = CategoryMedia.idCategoryMedia
      inner join Field on field = Field.idField
      inner join Author on Author = Author.idAuthor
      order by fielddesc;
      ";
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
                    echo "<th>Date d'ajoût</th>";
                echo "</tr>";
           echo "</thead>";
           echo "<tbody>";
            while($row = mysqli_fetch_array($result)){
                echo "<tr>";
                    echo "<td>" . $row['idInformation'] . "</td>";
                    echo "<td>" . $row['fielddesc'] . "</td>";
                    echo "<td>" . $row['name'] . "</td>";
                    echo "<td>" . $row['cateMediadesc'] . "</td>";
                    echo "<td><a href='" . $row['link'] . "' target='_blank'>" . $row['infodesc'] . "</a></td>";
                    echo "<td>" . $row['date_ajout'] . "</td>";
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
                this.api().columns().every( function () {
                var column = this;
                var select = $('<select class="select_filter" onclick="event.stopPropagation();"><option value=""></option></select>')
                  .appendTo( $(column.header()) )
                  .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                  } );

                column.order('asc').draw(false).data().unique().each( function ( d, j ) { 
                    var val = $('<div/>').html(d).text();
                    select.append( '<option value="' + val + '">' + val.substr(0,35) + '</option>' );
                } );
            } );
          }
        } );
      } );

      function searchColumn(data){
        var table = $('#table_id').DataTable();
        table.column(1).search(data).draw();
      }

      function search(field){
        var table = $('#table_id').DataTable();
        table.search(field).draw();
      };

      function searchBis(){
        var table = $('#table_id').DataTable();
        table.search(document.getElementById("searchBox").value).draw();
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
