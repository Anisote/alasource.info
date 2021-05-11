<?php
  require_once('config.php');
  require_once('menu.php');
?>

<body>
  <div id="content">
    <p>
      Ce site contient des liens vers des contenus que j’estime intéressants. Je peux ou non partager les points de vues des auteurs/contenus présents ici. Bonne découverte
    </p>

    <?php

    $sql = "SELECT idInformation, Information.description as infodesc, Field.description as fielddesc, Author.name, CategoryMedia.description as cateMediadesc,CategoryAuthor.description as cateAuthdesc, link, date_ajout FROM Information
      inner join CategoryMedia on categoryMedia = CategoryMedia.idCategoryMedia
      inner join Field on field = Field.idField
      inner join Author on Author = Author.idAutor
      inner join CategoryAuthor on CategoryAuthor.idCategoryAuthor = Author.categoryAuthor
      order by field ;
      ";
    if($result = mysqli_query($link, $sql)){
        if(mysqli_num_rows($result) > 0){
            echo "<table id='table_id' class='display'>";
            echo "<thead>";
                echo "<tr>";
                    echo "<th>ID</th>";
                    echo "<th>Domaine</th>";
                    echo "<th>Description</th>";
                    echo "<th>Média</th>";
                    echo "<th>Auteur</th>";
                    echo "<th>Profession de l'auteur</th>";
                    echo "<th>Date d'ajoût</th>";
                echo "</tr>";
           echo "</thead>";
           echo "<tbody>";
            while($row = mysqli_fetch_array($result)){
                echo "<tr>";
                    echo "<td>" . $row['idInformation'] . "</td>";
                    echo "<td>" . $row['fielddesc'] . "</td>";
                    echo "<td><a href='" . $row['link'] . "' target='_blank'>" . $row['infodesc'] . "</a></td>";
                    echo "<td>" . $row['cateMediadesc'] . "</td>";
                    echo "<td>" . $row['name'] . "</td>";
                    echo "<td>" . $row['cateAuthdesc'] . "</td>";
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
      <script>$(document).ready( function () {
        
          $('#table_id thead tr').clone(true).appendTo( '#table_id thead' );
	  $('#table_id thead tr:eq(1) th').each( function (i) {
 	      var title = $(this).text();
              $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
      
              $( 'input', this ).on( 'keyup change', function () {
                  if ( table.column(i).search() !== this.value ) {
                      table
                          .column(i)
                          .search( this.value )
                          .draw();
                  }
              } );
          } );

          var table = $('#table_id').DataTable({
                SearchPanes : true,
                responsive: true,
                orderCellsTop: true,
                fixedHeader: true,
                "pageLength": 25,
                "dom": '<"top">rt<"bottom"flp><"clear">',
          });

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
        table.search("").draw();
      };
      </script>
</div>
</body>

</html>
