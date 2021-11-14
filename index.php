<?php
  $page = 'index';
  require_once('menu.php');

  $tooltip = '⭐⭐⭐⭐ : Exceptionnel
⭐⭐⭐ : Extrêmement intéressant
⭐⭐ : Très intéressant
⭐ : Intéressant';
?>

<div id="content" class="no-padding">
  <div class="center">
    <input id="searchBoxMobile" class="searchBox mobile" type="search" placeholder="Critères de recherches" aria-label="Rechercher" oninput='search(this)'/>
    <input id="searchBoxDesktop" class="searchBox desktop" type="search" list="tags-fields" type="search" placeholder="Critères de recherches" aria-label="Rechercher" oninput='search(this)'/>
    <datalist id="tags-fields">
      <?php
          $sqlInformationTag = "SELECT idTag, name, count(idTag) as tagCount FROM info.Information_tag NATURAL JOIN Tag GROUP BY idTag ORDER BY REGEXP_REPLACE(name,'^[^a-zA-Z]+? ', '') ASC;";
          $tags = Array();
          if($result = mysqli_query($link, $sqlInformationTag)) {
              if(mysqli_num_rows($result) > 0){
                  while($row = mysqli_fetch_array($result)) {
                      $tags[] = Array('name' => $row['name'], 'id' => $row['idTag'], 'count' => $row['tagCount']);
                  }
                  
                  mysqli_free_result($result);
              } else {
                  echo "No records matching your query were found.";
              }
          } else {
              echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
          }

          foreach($tags as $tagEntry) {
            echo '<option value="' . $tagEntry['name'] . '">' . $tagEntry['count'] . ' élément' . ($tagEntry['count'] > 1 ? 's' : '') . '</option>';
          }
        ?>
    </datalist>
    <div class="button-search-reset">
      <a class="button-style" aria-current="page" href="#">Rechercher</a>
      <a class="button-style" onclick='clean();' aria-current="page">Reset</a>
    </div>
    <div>
      <div class="alert alert-info alert-screen-orientation hidden">Pour plus de confort, vous pouvez pivoter l'écran.</div>

      <div class="form-check form-switch inline-block">
        <input class="form-check-input" type="checkbox" onchange="toggleCompactMode()" role="switch" id="compactModeSwitch">
        <label class="form-check-label text-success pointer compact" for="compactModeSwitch">Mode compact</label>        
      </div>

      <?php

          $tagsPopover = "";
          foreach($tags as $tag){
            $tagsPopover = $tagsPopover . $tag['name'] . "<br/>";
          }
        ?>
        <div id=informationButtonDomaines  data-bs-html="true" data-bs-toggle="popover" title="Domaines" data-bs-placement="bottom" data-bs-content="<?php  echo($tagsPopover) ?>" >
          <svg viewBox="0 0 512 512" class="pointer svg" aria-hidden="true"data-prefix="fas" data-icon="info-circle" class="svg-inline--fa fa-info-circle fa-w-4" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 4096 4096"><path fill="currentColor" d="M256 8C119.043 8 8 119.083 8 256c0 136.997 111.043 248 248 248s248-111.003 248-248C504 119.083 392.957 8 256 8zm0 110c23.196 0 42 18.804 42 42s-18.804 42-42 42-42-18.804-42-42 18.804-42 42-42zm56 254c0 6.627-5.373 12-12 12h-88c-6.627 0-12-5.373-12-12v-24c0-6.627 5.373-12 12-12h12v-64h-12c-6.627 0-12-5.373-12-12v-24c0-6.627 5.373-12 12-12h64c6.627 0 12 5.373 12 12v100h12c6.627 0 12 5.373 12 12v24z"></path></svg> Domaines 
        </div>
        <div id=informationButtonMarks  data-bs-html="true" data-bs-toggle="popover" title="Avis" data-bs-placement="bottom" data-bs-content="⭐⭐⭐⭐ Exceptionnel<br/>⭐⭐⭐ Extrêmement intéressant<br/>⭐⭐ Très intéressant<br/>⭐ Intéressant" >
          <svg viewBox="0 0 512 512" class="pointer svg" aria-hidden="true"data-prefix="fas" data-icon="info-circle" class="svg-inline--fa fa-info-circle fa-w-4" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 4096 4096"><path fill="currentColor" d="M256 8C119.043 8 8 119.083 8 256c0 136.997 111.043 248 248 248s248-111.003 248-248C504 119.083 392.957 8 256 8zm0 110c23.196 0 42 18.804 42 42s-18.804 42-42 42-42-18.804-42-42 18.804-42 42-42zm56 254c0 6.627-5.373 12-12 12h-88c-6.627 0-12-5.373-12-12v-24c0-6.627 5.373-12 12-12h12v-64h-12c-6.627 0-12-5.373-12-12v-24c0-6.627 5.373-12 12-12h64c6.627 0 12 5.373 12 12v100h12c6.627 0 12 5.373 12 12v24z"></path></svg> Avis 
        </div>
    </div>
  </div>
  <div class="font-size-em0-7 mt-1 center desktop display-block">
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

  $sqlInformationTag = "SELECT idInformation, name FROM Information_tag NATURAL JOIN Tag ORDER BY REGEXP_REPLACE(name,'^[^a-zA-Z]+? ', '') ASC;";
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
                  echo "<th class='small-padding' data-split=' '>Domaine</th>";
                  echo "<th class='small-padding'>Auteur</th>";
                  echo "<th class='small-padding'>Média</th>";
                  echo "<th class='small-padding width-100'>Description</th>";
                  echo "<th class='star small-padding' data-toggle='tooltip' data-html='true' title='$tooltip'>Avis</th>";
                  echo "<th class='small-padding'>Date de publication</th>";
                  echo "<th class='hidden'>Tags</th>";
              echo "</tr>";
         echo "</thead>";
         echo "<tbody>";
          while($row = mysqli_fetch_array($result)){
              $id = $row['idInformation'];
              $informationTags = isset($informationTag[$id]) ? $informationTag[$id] : NULL;
              if(empty($informationTags)) {
                  $informationTags = Array();
              }

              $tagsStr = join(', ', $informationTags);
              $tagsIconsStr = join(' ', array_map(function($value) {
                $values = explode(' ', $value);
                return "<span data-toggle='tooltip' title='$values[1]'>" . $values[0] . "</span>";
              }, $informationTags));

              echo "<tr>";
              echo "<td class='center'><span>" . $row['indexDisplayed'] . "</span></td>";
              echo "<td class='text-nowrap center domaine no-padding'>" . $tagsIconsStr . "</td>";

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
                echo "<td class='center star no-padding' data-toggle='tooltip' title='$tooltip'>⭐</td>";
              }
              if ($row['mark'] == 2){
                echo "<td class='center star no-padding' data-toggle='tooltip' title='$tooltip'>⭐&nbsp;⭐</td>";
              }
              if ($row['mark'] == 3){
                echo "<td class='center star no-padding' data-toggle='tooltip' title='$tooltip'>⭐&nbsp;⭐&nbsp;⭐</td>";
              }
              if ($row['mark'] == 4){
                echo "<td class='center star no-padding' data-toggle='tooltip' title='$tooltip'>⭐&nbsp;⭐&nbsp;⭐&nbsp;⭐</td>";
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
  <script>
    function fullScreen(isFullScreen) {
      if(isFullScreen === undefined) {
        return document.fullscreenElement;
      } else {
        if(isFullScreen) {
            if(document.documentElement.requestFullscreen) {
              document.documentElement.requestFullscreen();
            } else if(document.documentElement.webkitRequestFullScreen) {
              document.documentElement.webkitRequestFullScreen();
            }
        } else if(document.fullscreenElement) {
          if(document.exitFullscreen) {
            document.exitFullscreen();
          }
        }
      }
    }

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
                targets: [<?=$COLUMNS['fieldDesktop']?>, <?=$COLUMNS['media']?>],
                render: function (data, type, row) {
                  if (type === 'sort') {
                    return data.replace(/.*? /,'');
                  }
                  return data;
                }
              },
              { responsivePriority: 1, targets: [<?=$COLUMNS['description']?>, <?=$COLUMNS['marks']?>] },
              { responsivePriority: 2, targets: [<?=$COLUMNS['fieldDesktop']?>] },
              { responsivePriority: 3, targets: [<?=$COLUMNS['media'] ?>] },
              { responsivePriority: 4, targets: [<?=$COLUMNS['author'] ?>] },
              { responsivePriority: 5, targets: [<?=$COLUMNS['publishDate'] ?>] },
              { responsivePriority: 6, targets: [<?=$COLUMNS['id'] ?>] },
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
                if (column.index() != <?=$COLUMNS['id']?> && column.index() != <?=$COLUMNS['description']?> && column.index() != <?=$COLUMNS['publishDate']?> ){
                  // Disable search by regex for author column
                  if (column.index() == <?=$COLUMNS['author']?>){
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
                  else if(column.index() == <?=$COLUMNS['marks']?>){
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
                  else if([ <?=$COLUMNS['fieldDesktop']?> ].includes(column.index())){
                    select = $('<select class="select-filter" onclick="event.stopPropagation();"><option value=""></option></select>')
                      .appendTo( $(column.header()) )
                      .on( 'change', function () {
                        var val = jQuery.fn.dataTable.ext.type.search.html($.fn.dataTable.util.escapeRegex(
                          $(this).val()
                        ));
                        val = val ? val.split(' ')[0] : val;
                        column
                          .search( val ? val : '', true, false )
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
                  const values = [];
                  for(var i = 0; i < data.length; ++i) {
                    values.push($('<div/>').html(data[i]).text());
                  }

                  const splitChar = $(column.header()).data('split') || ',';

                  // useful when multiple author
                  const columnValues = values
                    .map(v => v.split(splitChar))
                    .reduce((p, c) => {
                      for(let item of c) {
                        item = item && item.trim();
                        if(!p.includes(item)) {
                          p.push(item);
                        }
                      }
                      return p;
                    }, []);

                  const tags = <?= json_encode($tags) ?>;

                  if (column.index() == <?=$COLUMNS['author'] ?>){
                    columnValues.sort();
                  } else if (column.index() == <?=$COLUMNS['fieldDesktop'] ?>){
                    const getName = (value) => tags.find(tag => tag.name.includes(value)).name.split(' ')[1];
                    columnValues.sort((a, b) => getName(a).localeCompare(getName(b)));
                  }

                  for(let item of columnValues) {
                    let optionValue = item;
                    if(item != ""){
                      let nb = undefined;
                      if([ <?=$COLUMNS['fieldDesktop']?> ].includes(column.index())){
                        const tagInfo = tags.find(tag => tag.name.includes(item));
                        if(tagInfo) {
                          nb = tagInfo.count;
                          item = tagInfo.name;
                        }
                      }

                      select.append( '<option onclick="event.stopPropagation()" value="' + optionValue + '">' + item.substr(0,35) + (nb ? ` (${nb})` : '') + '</option>' );
                    }
                  }
                }
                selects.push(select);
            } );
        }
      } );
      table.order( [ 0, 'asc' ] ).draw();
      setCompactMode(isMobile());
    } );

    function isMobile() {
      return $(window).width() <= <?= $COMPACT_MODE_TRIGGER_SCREEN_WIDTH ?>;
    }

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
        split: {
          [<?=$COLUMNS['author']?>]: ', ',
          [<?=$COLUMNS['fieldDesktop']?>]: ' '
        }[selects.indexOf(s)]
      }))
      selects.filter(s => s).forEach(s => refreshSelect(selectsData.find(d => d.$select === s), selectsData.filter(d => d.$select !== s)))
    }


    function search(input){
      input = input || $('#searchBoxDesktop')[0];
      
      if(input.id == 'searchBoxMobile'){
        $('#searchBoxDesktop').val($(input).val()); 
      }else{
        $('#searchBoxMobile').val($(input).val());
      }

      var table = $('#table_id').DataTable();
      console.log("Valeur input : " + input.value)

      table.search(jQuery.fn.dataTable.ext.type.search.html(input.value)).draw();
    };

    function clean(){
      var table = $('#table_id').DataTable();

      document.getElementById("searchBoxMobile").value = "";
      document.getElementById("searchBoxDesktop").value = "";

      table.search("").draw();
    };

    let compactMode = undefined;
    let fullScreenInfoTimeout;
    function setCompactMode(isCompact) {
      if(isCompact !== compactMode) {
        var table = $('#table_id').DataTable();
        var columnsToHide = [ <?= $COMPACT_MODE_COLUMNS_TO_HIDE ?> ];

        for(const column of columnsToHide) {
          table.column(column).visible(!isCompact);
        }

        if(!isCompact){
          let events = document.getElementsByClassName("description")
          for (let ev of events) {
              ev.style.width = '1000px';
          }
        }

        compactMode = isCompact;
        document.getElementById('compactModeSwitch').checked = isCompact;

        if(isMobile()) {
          fullScreen(!isCompact);

          const fullScreenInfoEl = document.querySelector('.alert-screen-orientation');
          clearTimeout(fullScreenInfoTimeout);
          if(!isCompact) {
            fullScreenInfoEl.classList.remove('hidden');
            fullScreenInfoEl.onclick = () => {
              fullScreenInfoEl.classList.add('hidden');
              clearTimeout(fullScreenInfoTimeout);
              fullScreenInfoTimeout = undefined;
            }
            fullScreenInfoTimeout = setTimeout(() => {
              fullScreenInfoEl.classList.add('hidden');
              fullScreenInfoTimeout = undefined;
            }, 5000)
          } else {
            fullScreenInfoEl.classList.add('hidden');
          }
        }
      }
    }
    function toggleCompactMode() {
      setCompactMode(!compactMode);
    }

    // enable popover
    var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
    var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
      return new bootstrap.Popover(popoverTriggerEl)
    });
    </script>

</div>
<?php
  require_once('footer.php');
?>
