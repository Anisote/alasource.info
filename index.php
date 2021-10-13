<?php
  require_once('menu.php');

  $tooltip = '⭐⭐⭐⭐ : Exceptionnel
⭐⭐⭐ : Extrêmement intéressant
⭐⭐ : Très intéressant
⭐ : Intéressant';
?>

<div id="content">
  <div class="center-20">
    <input list="tags-fields" type="search" placeholder="Cliquer ici" aria-label="Rechercher" oninput='search()' id="searchBox" />
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
    <div id="button">
      <a class="button-style" aria-current="page" href="#">Rechercher</a>
      <a class="button-style" onclick='clean();' aria-current="page">Reset</a>
    </div>
    <div style="display:inline-block;">
      <div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" onchange="toggleCompactMode()" role="switch" id="compactModeSwitch">
        <label class="form-check-label text-success" for="compactModeSwitch">Mode compact</label>
      </div>
    </div>
  </div>
  <div class="center-20 font-size-em0-7 mt-1 mb-3 desktop">
      ⭐⭐⭐⭐ Exceptionnel &nbsp;&nbsp;-&nbsp;&nbsp; ⭐⭐⭐ Extrêmement intéressant &nbsp;&nbsp;-&nbsp;&nbsp; ⭐⭐ Très intéressant &nbsp;&nbsp;-&nbsp;&nbsp; ⭐ Intéressant
  </div>
  <?php

  $sql = "SELECT idInformation, indexDisplayed, Information.description as infodesc, Tag.name as fielddesc, CategoryMedia.description as cateMediadesc,link, mark, DATE_FORMAT(release_date, '%d/%m/%Y') as datePublication, DATE_FORMAT(insert_date, '%d/%m/%Y') as dateAjout FROM Information
  inner join CategoryMedia on categoryMedia = CategoryMedia.idCategoryMedia
  inner join Tag on Information.field = Tag.idTag
  order by indexDisplayed asc;";

$sqlInformationAuthor = "SELECT idInformation, name FROM Information_author NATURAL JOIN Author ORDER BY name;";
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
                  echo "<th class='smallest_th'>Dom</th>";
                  echo "<th class='small_th'>Domaine</th>";
                  echo "<th class='small_th'>Auteur</th>";
                  echo "<th class='small_th'>Média</th>";
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
              echo "<td class='center '><span>" . $row['indexDisplayed'] . "</span></td>";
              $fieldDesc = explode(' ', $row['fielddesc']);
              echo "<td class='text-nowrap center font-size-em0-7'><span data-toggle='tooltip' title='$fieldDesc[1]'>" . $fieldDesc[0] . "</span></td>";
              echo "<td class='text-nowrap '><span>" . $fieldDesc[0] . " <div class='field_desc_full'>$fieldDesc[1]</div></span></td>";
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

              echo "<td class='text-nowrap'><span>" . $row['cateMediadesc'] . "</span></td>";

              if($row['link'] != ""){
                echo "<td class='description'><a href='" . $row['link'] . "' target='_blank' rel='noopener noreferrer nofollow'>" . $row['infodesc'] . "</a></td>";
              }else{
                echo "<td class='description'>" . $row['infodesc'] . "</td>";
              }

              if($row['mark'] == 1){
                echo "<td class='center star' data-toggle='tooltip' title='$tooltip'>⭐</td>";
              }
              if ($row['mark'] == 2){
                echo "<td class='center star' data-toggle='tooltip' title='$tooltip'>⭐&nbsp;⭐</td>";
              }
              if ($row['mark'] == 3){
                echo "<td class='center star' data-toggle='tooltip' title='$tooltip'>⭐&nbsp;⭐&nbsp;⭐</td>";
              }
              if ($row['mark'] == 4){
                echo "<td class='center star' data-toggle='tooltip' title='$tooltip'>⭐&nbsp;⭐&nbsp;⭐&nbsp;⭐</td>";
              }
                  
              if($row['datePublication'] != "00/00/0000"){
                echo "<td class='center text-nowrap'>" . $row['datePublication'] . "</td>";
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

  <div class="star mobile"> 
      ⭐⭐⭐⭐ Exceptionnel &nbsp;&nbsp;-&nbsp;&nbsp; ⭐⭐⭐ Extrêmement intéressant &nbsp;&nbsp;-&nbsp;&nbsp; ⭐⭐ Très intéressant &nbsp;&nbsp;-&nbsp;&nbsp; ⭐ Intéressant
  </div>

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
            responsive: false,
            "sDom": '<"top"ftrlpi>',
            columnDefs: [{
                targets: [1,2,4],
                render: function (data, type, row) {
                  if (type === 'sort') {
                    return data.replace(/.*? /,'');
                  }
                  return data;
                }
              },
              { responsivePriority: 1, targets: [5, 6] },
              { responsivePriority: 2, targets: [2] },
              { responsivePriority: 3, targets: [4] },
              { responsivePriority: 4, targets: [3] },
              { responsivePriority: 5, targets: [7] },
              { responsivePriority: 6, targets: [0] },
            ],
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
                if (column.index() != 0 && column.index() != 5 && column.index() != 7 ){
                  // Disable search by regex for author column
                  if (column.index() == 3){
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
                  else if(column.index() == 6){
                    select = $('<select class="select-filter text-center" onclick="event.stopPropagation();"><option value=""></option></select>')
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
                  }else{
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
                  var columnValues = values
                    .map(v => v.split(', '))
                    .reduce((p, c) => {
                      for(var item of c) {
                        if(!p.includes(item)) {
                          p.push(item);
                        }
                      }
                      return p;
                    }, []);

                  if (column.index() == 3 || column.index() == 4){
                    columnValues.sort();
                  }

                  for(var item of columnValues) {
                    if(item != ""){
                      select.append( '<option onclick="event.stopPropagation()" value="' + item + '">' + item.substr(0,35) + '</option>' );
                    }
                  }
                }
                selects.push(select);
            } );
        }
      } );
      table.column(1).visible(false);
      table.order( [ 0, 'asc' ] ).draw();
      setCompactMode($(window).width() <= <?= $COMPACT_MODE_TRIGGER_SCREEN_WIDTH ?>);
    } );

    var api;
    function refreshSelect(selectData, others) {
      var $select = selectData.$select;
      var data = api.rows().data().filter(d => others.every(o => {
        var dataValue = jQuery.fn.dataTable.ext.type.search.html(d[o.dataIndex]);
        if(o.split) {
          dataValue = dataValue.split(o.split);
        } else {
          dataValue = [dataValue];
        }
        console.log(o.value);
        return !o.value || dataValue.includes(o.value)
      }));
      var $options = $select.children('option');

      var optionsToDisplay = [];

      for(var i = 0; i < data.length; ++i) {
        var row = data[i];
        var cellValue = jQuery.fn.dataTable.ext.type.search.html(row[selectData.dataIndex]);
        if(selectData.split) {
          cellValue = cellValue.split(selectData.split);
        } else {
          cellValue = [cellValue];
        }

        var option = [];
        for(var j = 0; j < $options.length; ++j) {
          if(cellValue.includes(jQuery.fn.dataTable.ext.type.search.html($($options[j]).attr('value')))) {
            option.push($options[j]);
          }
        }

        if(option.length > 0) {
          for(var op of option) {
            if(!optionsToDisplay.includes(option)) {
              optionsToDisplay.push(op);
            }
          }
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
        dataIndex: selects.indexOf(s),
        split: selects.indexOf(s) === 2 ? ', ' : undefined
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

    let compactMode = undefined;
    function setCompactMode(isCompact) {
      if(isCompact !== compactMode) {
        var table = $('#table_id').DataTable();
        var columnsToHide = [ <?= $COMPACT_MODE_COLUMNS_TO_HIDE ?> ];

        for(const column of columnsToHide) {
          table.column(column).visible(!isCompact);
          table.column(1).visible(isCompact);
        }

        if(!isCompact){
          let events = document.getElementsByClassName("description")
          for (let ev of events) {
              ev.style.width = '1000px';
          }

          // document.getElementById('table_id').style.width = '2000px !important';
          console.log(document.getElementById('table_id').style.width);
        }

        compactMode = isCompact;        
        document.getElementById('compactModeSwitch').checked = isCompact; 
      }
    }
    function toggleCompactMode() {
      setCompactMode(!compactMode);
    }
    </script>

</div>
<?php
  require_once('footer.php');
?>
