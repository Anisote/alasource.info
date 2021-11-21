<?php
  $page = 'index';
  require_once('menu.php');

  $tooltip = '⭐⭐⭐⭐ : Exceptionnel
⭐⭐⭐ : Extrêmement intéressant
⭐⭐ : Très intéressant
⭐ : Intéressant';
?>


<div id="content" class="no-padding">
  <div>
    <div id="tutorial" class="center">
      <video id="tutorial-video" fullScreen onclick="manageVideoTutorial()">
      <source src="themes/tutorial.mp4" type="video/mp4">
    </div>
    <div id="searchfields" class="center">
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
        <a class="button-style desktop" aria-current="page" href="#">Rechercher</a>
        <a class="button-style" onclick='clean();' aria-current="page">Reset</a>
      </div>
      <div class="helpers">
        <div class="alert alert-info alert-screen-orientation hidden">Pour plus de confort, vous pouvez pivoter l'écran.</div>

        <div class="form-check form-switch inline-block" class="informationButton">
          <input class="form-check-input" type="checkbox" onchange="toggleCompactMode()" role="switch" id="compactModeSwitch">
          <label class="form-check-label text-success pointer compact" for="compactModeSwitch">Mode compact</label>        
        </div>
        <?php
          $tagsPopover = "";
          foreach($tags as $tag){
            $tagsPopover = $tagsPopover . $tag['name'] . "<br/>";
          }
        ?>
        <div id=informationButtonDomaines class="informationButton" data-trigger="focus"  data-bs-html="true" data-bs-toggle="popover" title="Domaines" data-bs-placement="bottom" data-bs-content="<?php  echo($tagsPopover) ?>" >
          <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" width="1em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 1024 1024"><path d="M512 64C264.6 64 64 264.6 64 512s200.6 448 448 448s448-200.6 448-448S759.4 64 512 64zm0 820c-205.4 0-372-166.6-372-372s166.6-372 372-372s372 166.6 372 372s-166.6 372-372 372z" fill="currentColor"/><path d="M464 336a48 48 0 1 0 96 0a48 48 0 1 0-96 0zm72 112h-48c-4.4 0-8 3.6-8 8v272c0 4.4 3.6 8 8 8h48c4.4 0 8-3.6 8-8V456c0-4.4-3.6-8-8-8z" fill="currentColor"/></svg> Domaines 
        </div>
        <div id=informationButtonMarks  class="informationButton"data-trigger="focus" data-bs-html="true" data-bs-toggle="popover" title="Avis" data-bs-placement="bottom" data-bs-content="⭐⭐⭐⭐ Exceptionnel<br/>⭐⭐⭐ Extrêmement intéressant<br/>⭐⭐ Très intéressant<br/>⭐ Intéressant" >          
          <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" width="1em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 1024 1024"><path d="M512 64C264.6 64 64 264.6 64 512s200.6 448 448 448s448-200.6 448-448S759.4 64 512 64zm0 820c-205.4 0-372-166.6-372-372s166.6-372 372-372s372 166.6 372 372s-166.6 372-372 372z" fill="currentColor"/><path d="M464 336a48 48 0 1 0 96 0a48 48 0 1 0-96 0zm72 112h-48c-4.4 0-8 3.6-8 8v272c0 4.4 3.6 8 8 8h48c4.4 0 8-3.6 8-8V456c0-4.4-3.6-8-8-8z" fill="currentColor"/></svg> Avis
        </div>
        <div id=informationButtonHelp class="informationButton" onclick="manageVideoTutorial()" >
          <svg viewBox="0 0 512 512" class="pointer svg" aria-hidden="true"data-prefix="fas" data-icon="info-circle" class="svg-inline--fa fa-info-circle fa-w-4" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 4096 4096"><path fill="currentColor" d="M256 8C119.043 8 8 119.083 8 256c0 136.997 111.043 248 248 248s248-111.003 248-248C504 119.083 392.957 8 256 8zm0 448c-110.532 0-200-89.431-200-200 0-110.495 89.472-200 200-200 110.491 0 200 89.471 200 200 0 110.53-89.431 200-200 200zm107.244-255.2c0 67.052-72.421 68.084-72.421 92.863V300c0 6.627-5.373 12-12 12h-45.647c-6.627 0-12-5.373-12-12v-8.659c0-35.745 27.1-50.034 47.579-61.516 17.561-9.845 28.324-16.541 28.324-29.579 0-17.246-21.999-28.693-39.784-28.693-23.189 0-33.894 10.977-48.942 29.969-4.057 5.12-11.46 6.071-16.666 2.124l-27.824-21.098c-5.107-3.872-6.251-11.066-2.644-16.363C184.846 131.491 214.94 112 261.794 112c49.071 0 101.45 38.304 101.45 88.8zM298 368c0 23.159-18.841 42-42 42s-42-18.841-42-42 18.841-42 42-42 42 18.841 42 42z"></path></svg> Aide 
        </div>
        <div class="font-size-em0-7 mt-1 center desktop display-block">
            ⭐⭐⭐⭐ Exceptionnel &nbsp;&nbsp;-&nbsp;&nbsp; ⭐⭐⭐ Extrêmement intéressant &nbsp;&nbsp;-&nbsp;&nbsp; ⭐⭐ Très intéressant &nbsp;&nbsp;-&nbsp;&nbsp; ⭐ Intéressant
        </div>
      </div>
    </div>
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
              echo "<td class='center padding-em0-5'><span>" . $row['indexDisplayed'] . "</span></td>";
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
                echo "<td><a href='" . $row['link'] . "' target='_blank' rel='noopener noreferrer nofollow'>" . $row['infodesc'] . "</a></td>";
              }else{
                echo "<td>" . $row['infodesc'] . "</td>";
              }

              if ($row['mark'] == 1){
                echo "<td class='center star no-padding' data-toggle='tooltip' title='$tooltip'>⭐</td>";
              }
              if ($row['mark'] == 2){
                echo "<td class='center star no-padding' data-toggle='tooltip' title='$tooltip'>⭐&nbsp;⭐</td>";
              }
              if ($row['mark'] == 3){
                echo "<td class='center star no-padding' data-toggle='tooltip' title='$tooltip'>⭐&nbsp;⭐&nbsp;⭐</td>";
              }
              if($row['mark'] == 4){
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
                          .search( val ? `(^| )${val}($| )` : '', true, false )
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

    function manageVideoTutorial() {
      var tutorial = document.getElementById("tutorial");
      var vid = document.getElementById("tutorial-video");
      var menu = document.getElementById("menu");
      var searchfields = document.getElementById("searchfields");
      var datatable = document.getElementById("table_id");
      var footer = document.getElementById("footer");

      if (tutorial.style.display === "none" || tutorial.style.display === "" ) {
        tutorial.style.display = "block";
        menu.style.display = "none";
        searchfields.style.display = "none";
        datatable.style.display = "none";
        footer.style.display = "none";

        vid.play();
      } else {
        tutorial.style.display = "none";
        menu.style.display = "block";
        searchfields.style.display = "block";
        datatable.style.display = "block";
        footer.style.display = "block";

        vid.pause();
        vid.currentTime = 0;
      }
    }

    // enable popover
    var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
    var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
      return new bootstrap.Popover(popoverTriggerEl)
    });

    // Disable tooltip when clicking outside
    $('html').on('click', function (e) {
    $('[data-bs-toggle=popover]').each(function () {
        if (!$(this).is(e.target) && $(this).has(e.target).length === 0 && $('.popover').has(e.target).length === 0) {
            $(this).popover('hide');
        }
    });
  });
    </script>

</div>
<?php
  require_once('footer.php');
?>