<?php
  require_once('menu.php');

  $tooltip = '
⭐⭐⭐⭐ : Exceptionnel
⭐⭐⭐ : Extrêmement intéressant
⭐⭐ : Très intéressant
⭐ : Intéressant';
?>

<div id="content">
  <div class="center-25">
    <input list="tags-fields" type="search" placeholder="" aria-label="Rechercher" oninput='search()' id="searchBox" />
    <datalist id="tags-fields">
        <?php
            $sql = "SELECT name FROM Tag as tag ORDER BY REGEXP_REPLACE(name,'^[^a-zA-Z]+? ', '') ASC;";

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
    <a class="button-style" aria-current="page" href="#">Rechercher</a>
    <a class="button-style" onclick='clean();' aria-current="page" href="#">Reset</a>
  </div>
  <div class="center-25 font-size-em0-7 mt-1">
      ⭐⭐⭐⭐ Exceptionnel &nbsp;&nbsp;-&nbsp;&nbsp; ⭐⭐⭐ Extrêmement intéressant &nbsp;&nbsp;-&nbsp;&nbsp; ⭐⭐ Très intéressant &nbsp;&nbsp;-&nbsp;&nbsp; ⭐ Intéressant
  </div>
  <?php

  $sql = "SELECT idInformation, indexDisplayed, Information.description as infodesc, Tag.name as fielddesc, CategoryMedia.description as cateMediadesc,link, mark, DATE_FORMAT(release_date, '%d/%m/%Y') as datePublication, DATE_FORMAT(insert_date, '%d/%m/%Y') as dateAjout FROM Information
  inner join CategoryMedia on categoryMedia = CategoryMedia.idCategoryMedia
  inner join Tag on Information.field = Tag.idTag
  order by indexDisplayed asc;";

$sqlInformationAuthor = "SELECT idInformation, name FROM Information_author NATURAL JOIN Author;";
$informationAuthor = Array();
if($result = mysqli_query($link, $sqlInformationAuthor)) {
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_array($result)) {
            $informationId = $row['idInformation'];

            if(empty($informationAuthor[$informationId])) {
                $informationAuthor[$informationId] = Array();
            }
            $informationAuthor[$informationId][] = $row['name'];
        }
        
        mysqli_free_result($result);
    } else {
        echo "No records matching your query were found.";
    }
} else {
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}

  $sqlInformationTag = "SELECT idInformation, name FROM Information_tag NATURAL JOIN Tag;";
  $informationTag = Array();
  if($result = mysqli_query($link, $sqlInformationTag)) {
      if(mysqli_num_rows($result) > 0){
          while($row = mysqli_fetch_array($result)) {
              $informationId = $row['idInformation'];

              if(empty($informationTag[$informationId])) {
                  $informationTag[$informationId] = Array();
              }

              $informationTag[$informationId][] = $row['name'];
          }
          
          mysqli_free_result($result);
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
                  echo "<th class='id_th'>ID</th>";
                  echo "<th class='small_th'>Domaine</th>";
                  echo "<th class='small_th'>Auteur</th>";
                  echo "<th class='small_th'>Type de média</th>";
                  echo "<th>Description</th>";
                  echo "<th data-toggle='tooltip' data-html='true' title='$tooltip'>Note</th>";
                  echo "<th class='small_th'>Date de publication</th>";
                  echo "<th class='hidden'>Tags</th>";
              echo "</tr>";
         echo "</thead>";
         echo "<tbody>";
          while($row = mysqli_fetch_array($result)){
              $id = $row['idInformation'];
              $tags = isset($informationTag[$id]) ? $informationTag[$id] : NULL;
              if(empty($tags)) {
                  $tags = Array();
              }

              $tagsStr = join(', ', $tags);

              echo "<tr>";
              echo "<td class='center'><span>" . $row['indexDisplayed'] . "</span></td>";
              echo "<td><span>" . $row['fielddesc'] . "</span></td>";
              $authorsDisplayed = "";
              $i = 0;
              foreach ($informationAuthor[$row['idInformation']] as $author ){
                  if($i == 0){
                    $authorsDisplayed = $author;
                  }else{
                    $authorsDisplayed = "$authorsDisplayed, $author";
                  }
                  $i = $i +1;
              }

              if(strlen($authorsDisplayed) > 50){
                echo "<td><span class='font-size-em0-7'>" . $authorsDisplayed . "</span></td>";
              }else{              
                echo "<td><span>" . $authorsDisplayed . "</span></td>";
              }
              // echo "<td><span>" . $row['name'] . "</span></td>";

              echo "<td><span>" . $row['cateMediadesc'] . "</span></td>";

              if($row['link'] != ""){
                echo "<td><a href='" . $row['link'] . "' target='_blank' rel='noopener noreferrer nofollow'>" . $row['infodesc'] . "</a></td>";
              }else{
                echo "<td>" . $row['infodesc'] . "</td>";
              }

              if($row['mark'] == 1){
                echo "<td class='center star' data-toggle='tooltip' title='$tooltip'>⭐</td>";
              }
              if ($row['mark'] == 2){
                echo "<td class='center star' data-toggle='tooltip' title='$tooltip'>⭐&nbsp;⭐</td>";
              }
              if ($row['mark'] == 3){
                echo "
                <td class='center star' data-toggle='tooltip' title='$tooltip'>⭐&nbsp;⭐&nbsp;⭐</td>";
              }
              if ($row['mark'] == 4){
                echo "
                <td class='center star' data-toggle='tooltip' title='$tooltip'>⭐&nbsp;⭐&nbsp;⭐&nbsp;⭐</td>";
              }
                  
              if($row['datePublication'] != "00/00/0000"){
                echo "<td class='center'>" . $row['datePublication'] . "</td>";
              }else{
                echo "<td class='center'></td>";
              }              
              echo "<td class='hidden'><span>" . $tagsStr . "</span></td>";
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
      var _div = document.createElement('div');
      jQuery.fn.dataTable.ext.type.search.html = function(data) {
        _div.innerHTML = data;
        return (_div.textContent ? _div.textContent : _div.innerText)
          .replace(/[áÁàÀâÂäÄãÃåÅæÆ]/g, 'a')
          .replace(/[çÇ]/g, 'c')
          .replace(/[éÉèÈêÊëË]/g, 'e')
          .replace(/[íÍìÌîÎïÏîĩĨĬĭ]/g, 'i')
          .replace(/[ñÑ]/g, 'n')
          .replace(/[óÓòÒôÔöÖœŒ]/g, 'o')
          .replace(/[ß]/g, 's')
          .replace(/[úÚùÙûÛüÜ]/g, 'u')
          .replace(/[ýÝŷŶŸÿ]/g, 'y');
      }

      $(document).ready(function() {
      $.fn.dataTable.moment( 'DD/MM/YYYY');

      var table = $('#table_id').DataTable({
            SearchPanes : true,
            responsive: true,
            "sDom": '<"top"><"bottom"ftrlpi><"clear">',
            columnDefs: [{
                targets: [1,3],
                render: function (data, type, row) {
                  if (type === 'sort') {
                    return data.replace(/.*? /,'');
                  }
                  return data;
                }
              }
            ],
            "pageLength": 100,
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
                if (column.index() != 0 && column.index() != 4 && column.index() != 6 ){
                  // Disable search by regex for author column
                  if (column.index() == 2){
                    select = $('<select class="select-filter" onclick="event.stopPropagation();"><option value=""></option></select>')
                      .appendTo( $(column.header()) )
                      .on( 'change', function () {
                        var val = jQuery.fn.dataTable.ext.type.search.html($.fn.dataTable.util.escapeRegex(
                          $(this).val()
                        ));
                        column
                          .search( val ? val: '', true, false )
                          .draw();
                        refreshDropdowns();
                      })
                  }
                  else{
                    select = $('<select class="select-filter" onclick="event.stopPropagation();"><option value=""></option></select>')
                      .appendTo( $(column.header()) )
                      .on( 'change', function () {
                        var val = jQuery.fn.dataTable.ext.type.search.html($.fn.dataTable.util.escapeRegex(
                          $(this).val()
                        ));
                        column
                          .search( val ? '^'+val+'$' : '', true, false )
                          .draw();
                        refreshDropdowns();
                      })
                  }

                  const data = column.order('asc').draw(false).data().unique();
                  let values = [];
                  for(var i = 0; i < data.length; ++i) {
                    values.push($('<div/>').html(data[i]).text());
                  }

                  // useful when multiple author
                  for(var val of values) {
                    const authors = val.split(", ");
                    authors.forEach(item =>{
                      select.append( '<option onclick="event.stopPropagation()" value="' + item + '">' + item.substr(0,35) + '</option>' ); 
                    }); 
                  }
                }                  
                selects.push(select);
            } );
            
        }
      } );
      table.order( [ 0, 'asc' ] ).draw();
    } );

    var api;
    function refreshSelect(selectData, others) {
      var $select = selectData.$select;
      var data = api.rows().data().filter(d => others.every(o => {
        return !o.value || jQuery.fn.dataTable.ext.type.search.html(d[o.dataIndex]) === o.value
      }));
      var $options = $select.children('option');

      var optionsToDisplay = [];

      for(var i = 0; i < data.length; ++i) {
        var row = data[i];
        var cellValue = jQuery.fn.dataTable.ext.type.search.html(row[selectData.dataIndex]);

        var option;
        for(var j = 0; j < $options.length; ++j) {
          if(jQuery.fn.dataTable.ext.type.search.html($($options[j]).attr('value')) === cellValue) {
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
        value: jQuery.fn.dataTable.ext.type.search.html(s.val()),
        dataIndex: selects.indexOf(s)
      }))
      selects.filter(s => s).forEach(s => refreshSelect(selectsData.find(d => d.$select === s), selectsData.filter(d => d.$select !== s)))
    }

    function search(){
      var table = $('#table_id').DataTable();
      var criteria = jQuery.fn.dataTable.ext.type.search.html(document.getElementById("searchBox").value);

      table.search(criteria).draw();
    };

    function clean(){
      var table = $('#table_id').DataTable();

      document.getElementById("searchBox").value = "";

      table.search("").draw();
    };
    </script>

</div>
<?php
  require_once('footer.php');
?>
