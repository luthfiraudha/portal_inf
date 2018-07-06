<select class="form-control" id="id_fitur" name="id_fitur">
  <?php 
  foreach($fitur as $rowx)
  { 
    echo '<option value="'.$rowx->id_fitur.'">'.$rowx->nama_fitur.'</option>';
  }
  ?>
  
</select>