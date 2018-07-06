
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2><?php echo $this->menu;?> | <small><?php echo $this->fitur;?></small></h2>

                <div class="clearfix"></div>
            </div>

            <?php cetak_flash_msg();?>
            <?php if (!empty($alert['message'])) {?>
                <div class="alert alert-<?php echo $alert['class'];?> alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true" ></button>
                    <?php echo $alert['message'];?>
                </div>
            <?php }
?>

            <div class="x_content">


               <!--  <div>
                    <h4>Informasi</h4>
                    <ul>
                        <li>Hak Akses tidak dapat dihapus.</li>
                        <li>Beberapa Hak Akses tidak dapat diubah.</li>
                    </ul>
                </div> -->
                <div class="row">
                    <div class="col-xs-12">
                        <!--<form  method="POST" id="demo-form2" action="<?php echo base_url($this->cname. '/search/');?>" data-parsley-validate class="form-horizontal form-label-left">-->

                    <form  id="form-filter" class="form-horizontal form-label-left" >
                           
            
                      <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" >Tanggal
                            </label>
                               <div class="control-group">
                                    <div class="controls">
                                        <div class="col-md-6 col-sm-6 col-xs-12 xdisplay_inputx form-group has-feedback">
                                         <input type="text" name="tanggal" class="form-control has-feedback-left" id="tgl_pmslan" 
                                         value="">
                                        <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>                        
                                        </div>
                                    </div>
                                 </div>
                        </div>
                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" >Nomor surat
                            </label>
                               <div class="control-group">
                                    <div class="controls">
                                        <div class="col-md-6 col-sm-6 col-xs-12 xdisplay_inputx form-group has-feedback">
                                         <input type="text" name="nmr_surat" class="form-control has-feedback-left" id="nmr_surat" value="">
                                        
                                        </div>
                                    </div>
                                 </div>
                        </div>
                        
                        
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                             <!--<button type="submit" class="btn btn-sm btn-primary" data-toggle='confirmation'><i class="fa fa-search"></i> Filter </button>
                             <a type="button" href="<?php echo base_url($this->cname);?>" class="btn btn-sm btn-default">Reset</a>-->
                                
                               
                            <button type="button" id="btn-filter" class="btn btn-sm btn-primary"><i class="fa fa-search"></i> Filter </button>
                                <button type="button" id="btn-reset" class="btn btn-sm btn-default">Reset</button>
                                
                            </div>  
                                    
                        </div>
                        
                       
                    </form>
                    </div>
                </div>
                </br>

                <div class="row">
                <table id="data-pmslan" class="table table-striped table-bordered" style="zoom:100%;">
                    <thead>
                        <tr>
                            <th rowspan="1">NO</th>
                            <th width="" rowspan="1">PENGIRIM</th>
                            <th width="" rowspan="1">JENIS</th>
                            <th width="" rowspan="1">SMU</th>
                            <th width="" rowspan="1">SKU</th>
                            <th width="" rowspan="1">SUK</th>
                            <th width="" rowspan="1">IP</th>
                            <th width="" rowspan="1">SPH</th>
                            <th width="" rowspan="1">SPK</th>
                            <th width="" rowspan="1">SIK</th>
                            <th width="" rowspan="1">BAI</th>
                            <th width="" rowspan="1">BAST</th>
                            <th width="" rowspan="1">KET.EXCLUDE</th>
                            <th width="" rowspan="1">AKSI</th>
                        </tr>
                        <!-- <tr>
                            <th rowspan="2">NO</th>
                            <th width="" rowspan="2">KANWIL/DIVISI</th>
                            <th width="" rowspan="2">KANCA / BAGIAN</th>
                            <th width="" rowspan="2">JENIS</th>
                            <th width="" colspan="2">SURAT MASUK UKER</th>
                            <th width="" colspan="2">SURAT KELUAR UKER</th>
                            <th width="" colspan="2">SURAT UKER KEDUA</th>
                            <th width="" colspan="2">IJIN PRINSIP</th>
                            <th width="" colspan="2">SPH</th>
                            <th width="" colspan="2">SPK</th>
                            <th width="" colspan="2">SIK</th>
                            <th width="" rowspan="2">BAI</th>
                            <th width="" rowspan="2">BAST</th>
                        </tr>
                        <tr>
                            <th width="">NO</th>
                            <th width="">DETAIL</th>
                            <th width="">NO</th>
                            <th width="">DETAIL</th>
                            <th width="">NO</th>
                            <th width="">DETAIL</th>
                            <th width="">NO</th>
                            <th width="">DETAIL</th>
                            <th width="">NO</th>
                            <th width="">DETAIL</th>
                            <th width="">NO</th>
                            <th width="">DETAIL</th>
                            <th width="">NO</th>
                            <th width="">DETAIL</th>
                        </tr> -->
                    </thead>


                </table>
                </div>
            </div>
        </div>
    </div>
</div>
<style>


</style>
<script>

</script>