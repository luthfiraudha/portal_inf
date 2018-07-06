<div class="row">
   <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
         <div class="x_title">
            <h2><?php echo $this->menu; ?> |<small><?php echo $this->fitur; ?></small></h2>
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
            <br />
            <form  method="POST" id="demo-form2" action="<?php echo base_url($this->cname.'/kategori_add');?>" data-parsley-validate class="form-horizontal form-label-left">
              
               <div class="form-group">
                  <label class="control-label col-md-2 col-sm-2 col-xs-12" >Nama Kategori <span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                     <input type="text" name="nama_kategori" required="required" class="form-control col-md-7 col-xs-12">
                  </div>
               </div>
               
              
               <div class="ln_solid">
               </div>
               <div class="form-group">
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <!--  <a class="btn btn-sm bg-blue" href="<?php echo base_url($this->cname); ?>"><i class="fa fa-arrow-left"></i> Kembali</a> -->
                
                   
                     <button type="submit" class="btn btn-primary" ><i class="fa fa-check-square-o"></i> Add Kategori</button>
                    
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>


<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2><?php echo $this->menu;?> |<small><?php echo $this->fitur;?></small></h2>

                <div class="clearfix"></div>
            </div>

           
            <div class="x_content">

                <table id="datatable-buttons" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th width="30px">No</th>
                          <th>Kategori</th>
                          <th>Action</th>
                        </tr>
                      </thead>


                      <tbody>
                      <?php $no=1;?>
                      <?php foreach ($kategori as $key): ?>
                        <tr>
                          <td><?php echo $no;?></td>
                          <td><?php echo $key->nama_kategori?></td>
                          <td style='text-align:center' width='140px'>
                            <a title='Lihat' href="<?php echo base_url($this->cname.'/action/kategori_view/'.$key->id_kategori); ?>" class='btn btn-circle btn-sm bg-green'>
                                <i class='fa fa-folder'></i>
                            </a>
                            <a title='Edit' href="<?php echo '#'; //base_url($this->cname.'/action/kategori_edit/'.$key->id_kategori); ?>" class='btn btn-circle btn-sm bg-blue'>
                            <i class='fa fa-edit'></i>
                            </a> 
                            <a title='Delete' data-href="<?php echo base_url($this->cname.'/action/kategori_delete/'.$key->id_kategori); ?>" class='btn btn-circle btn-sm bg-red' data-toggle='modal' data-target='.delete-modal'>
                                <i class='fa fa-trash'></i>
                            </a>

                        </td>
                          
                        </tr>
                        <?php $no++;?>
                      <?php endforeach ?>
                        
                       
                      </tbody>
                    </table>
            </div>
        </div>
    </div>
</div>