
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2><?php echo $this->menu;?><small><?php echo $this->fitur;?></small></h2>

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
                        <form  method="POST" id="demo-form2" action="<?php echo base_url($this->cname. '/search/');?>" data-parsley-validate class="form-horizontal form-label-left">
                           
            
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Shift
                              
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control" name="shift">  
                                        <option value="">All</option>       
                                        <option value="Shift 1">Shift 1</option>    
                                        <option value="Shift 2">Shift 2</option>
                                        <option value="Shift 3">Shift 3</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" >Tanggal
                            </label>
                               <div class="control-group">
                                    <div class="controls">
                                        <div class="col-md-6 col-sm-6 col-xs-12 xdisplay_inputx form-group has-feedback">
                                         <input type="text" name="tanggal" class="form-control has-feedback-left" id="single_cal1" value="">
                                        <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>                        
                                        </div>
                                    </div>
                                 </div>
                        </div>

                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Kategori
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control" name="kategori">
                                   <option value="">All</option>
                                    <?php
                                    foreach ($kategori as $kategori) {
                                    ?>
                                    <option value="<?php echo $kategori->kategori_id;?>"><?php echo ucfirst($kategori->kategori_nama) ;?></option>
                                    <?php
                                    }
                                    ?>
                                   
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                
                                <button type="submit" class="btn btn-sm btn-primary" data-toggle='confirmation'><i class="fa fa-search"></i> Filter </button>
                                
                            </div>  
                                    
                        </div>
                        
                       
                    </form>
                    </div>
                </div>
                </br>

                <div class="row">
                <table id="datatable-buttons" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th >Tanggal</th>
                            <th>Shift</th>
                            <th>Issuer</th>
                            <th>Kategori</th>
                            <!-- <th>Status</th> -->
                           <!--  <th >Tgl Solusi</th> -->
                            <th>Shift</th>
                            <th>Responden</th>
                           <!--  <th>Koreksi</th> -->
                            <th>Permasalahan</th>
                            <th>Answer</th>
                            <th>Detail</th>
                           

                        </tr>
                    </thead>



                    <tbody>

                        <?php
                        $start = 0;
                        foreach ($issue as $issue) {

                           ?>
                            <tr>
                                <td><?php echo ++$start?></td>
                                <td><a class="bg red">Ticketing: <?php echo $issue->tgl_input?> <a></br>
                                <a class="bg green">Tindakan : <?php echo $issue->tgl_sol?><a>
                                </td>
                                <td><?php echo $issue->shift?></td>
                                <td><?php echo $issue->user_nama?></td>
                                <td><?php echo $issue->kategori_nama?></td>
                               <!--  <td><?php

                                if ($issue->correct == "tepat" ) {  ?>
                                        <i class='btn btn-xs bg-green'>tepat</i>
                                    <?php } else{ ?>
                                        <i class='btn btn-xs bg-red'>tidak tepat</i>
                                    <?php }

                                ?></td> -->
                                
                                <!--  <td width="240px"><?php echo $issue->tgl_sol?></td> -->
                                 <td><?php echo $issue->shift2?></td>
                                 <td><?php echo $issue->nama2?></td>
                                <!--   <td><?php
                                if ($issue->status == "belum selesai" ) {  ?>
                                        <i class='btn btn-xs bg-red'>belum selesai</i>
                                    <?php } elseif ($issue->status == "selesai") { ?>
                                        <i class='btn btn-xs bg-green'>selesai</i>
                                    <?php }

                                ?></td> -->
                                 <td><?php // echo $issue->issue_des;
                                $string = strip_tags($issue->isi);
                                    if (strlen($string) > 50) {
                                     // truncate string
                                $stringCut = substr($string, 0, 50);

                                 // make sure it ends in a word so assassinate doesn't become ass...
                                $string = substr($stringCut, 0, strrpos($stringCut, ' ')).'... '; 
                                }
                                echo $string;
                                ?></td>
                               
                                <td><?php //echo $issue->answer;

                                $string2 = strip_tags($issue->isi2);
                                 if (strlen($string) > 50) {
                                     // truncate string
                                $stringCut2 = substr($string2, 0, 50);

                                 // make sure it ends in a word so assassinate doesn't become ass...
                                $string2 = substr($stringCut2, 0, strrpos($stringCut2, ' ')).'... '; 
                                }
                                echo $string2;

                                ?></td>
                                <td>
                                     <a title='Detail'  href="<?php echo base_url($this->cname . '/action/view/' . $issue->id.'/'.$issue->id2);?>" class='btn btn-circle btn-sm bg-green' >
                                        <i class='fa fa-folder'> <strong>view</strong></i>
                                    </a>
                                </td>
     <?php                               
}
?>
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
</div>
<style>

/*.dataTables_filter {
display: none; 
}*/
</style>
<script>

</script>