<?php
//...................
// Для сохранения картинки ноды при импорте нод с обновлением добавить в темплейт эту ф-цию

function stroiploshadka54_filefield_widget_preview($item) {
	//drupal_set_message ('function stroiploshadka54_filefield_widget_preview');
//echo "<pre>";
//print_r($item);
//echo "</pre>";

  // Remove the current description so that we get the filename as the link.
  if (isset($item['data']['description'])) {
    //unset($item['data']['description']);
  }

  return '<div class="filefield-file-info">'.
           '<div class="filename">'. theme('filefield_file', $item) .'</div>'.
           '<div class="filesize">'. format_size($item['filesize']) .'</div>'.
           '<div class="filemime">'. $item['filemime'] .'</div>'.
         '</div>';
}
