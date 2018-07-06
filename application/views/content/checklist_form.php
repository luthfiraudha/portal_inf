<div class="row">
   <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
         <div class="x_title">
            <h1><?php echo $main->jenis_field ?>  data center checklist</h1>
            <div class="clearfix"></div>
         </div>
         <?php cetak_flash_msg(); ?>
         <?php if (!empty($alert['message'])) { ?>
         <div class="alert alert-<?php echo $alert['class']; ?> alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
            <?php echo $alert['message']; ?>
         </div>
         <?php } ?>
        
         <div class="x_content">
         <div class="col-md-8 col-sm-8">
         <form  method="" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
            <br />
              
               <div class="form-group">
                  <label class="col-md-2 col-sm-2 col-xs-12" >Nama DC
                  </label>
                  <div class="col-md-3 col-sm-6 col-xs-12">
                     <p>: <?php echo $main->ck_nama; ?>
                     </p>
                  </div>
               </div>
               <div class="form-group">
                  <label class="col-md-2 col-sm-2 col-xs-12" >Tanggal
                  </label>
                  <div class="col-md-3 col-sm-6 col-xs-12">
                     <p>: <?php echo $main->ck_tgl; ?>
                     </p>
                  </div>
               </div>

               <div class="form-group">
                  <label class="col-md-2 col-sm-2 col-xs-12" >Total data
                  </label>
                  <div class="col-md-3 col-sm-6 col-xs-12">
                     <p>: <?php echo $empty->total;?> Not yet, <?php echo $ok->total;?>  ok, <?php echo $empty->total;?> not ok
                     </p>
                  </div>
               </div>
            </form>
         </div>
         <div class="col-md-4 col-sm-4">lallala</div>
              
         </div>
      </div>
   </div>
</div>

<?php 
foreach ($kategori as $kategori) {

?>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2><?php echo $kategori->nama_kategori?><small></small></h2>

                <div class="clearfix"></div>
            </div>
            <div class="x_content">

                 <table id="datatable-buttons" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Field</th>
                            <th>Status</th>
                            <th>Keterangan</th>
                            <th width="">Action</th>

                        </tr>
                    </thead>
                       <tbody>
                        <?php
                        $start = 0;
                        foreach (${$kategori->id_kategori} as $key) {
                          if($key->id_kategori == $kategori->id_kategori){


                        ?>
                        <tr>
                            <td><?php echo ++$start?></td>
                            <td><?php echo $key->nama_field?></td>
                            <td><?php echo $key->status?></td>
                            <td><?php echo $key->ket?></td>
                           
                            <td style="text-align:center" width="140px">
                                
                                 <a data-href="<?php echo base_url($this->cname . '/action/inputserver/' . $key->id_data);?>" class="btn btn-sm sbold bg-green" data-id="<?php echo $key->id_data; ?>"  data-toggle="modal" data-target=".add-data-modal">
		                        <i class="fa fa-plus"></i> Input Data
		                        </a>
                            </td>
                             
                        </tr>
                        <?php
                          }
                        }
                        ?>
                    </tbody>

<!--  -->
                </table>
            </div>
        </div>
    </div>
</div>

<?php } ?>
