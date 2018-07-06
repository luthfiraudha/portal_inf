<select id="connectTo_fitur" type="text" name="connectTo_fitur" required="required" onchange="hello()" class="form-control col-md-7 col-xs-12">
  <option></option>
  <?php 
  foreach($nama_fit as $row)
  { 
    echo '<option value="'.$row->id_fitur.'">'.$row->nama_fitur.'</option>';
  }

  ?>
  <option value="Other">Other Fitur</option>
  
</select>