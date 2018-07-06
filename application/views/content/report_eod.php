
                  <div class="x_title">
                   <div class="x_content">
                    <h2><?php echo "Report EOD";?><small> | <?php date_default_timezone_set("Asia/Jakarta"); echo date('l, d/m/Y H:i:s');?></small></h2>
                    <ul class="nav navbar-right panel_toolbox"></ul>
                    <div class="clearfix"></div>
                    <!-- <div class="row" style="border-bottom: 1px solid #E0E0E0; padding-bottom: 5px; margin-bottom: 5px;">
                      <div class="col-md-6" style="overflow:hidden; height: 15em;" id="show_pf">
                      </div>
                      <div class="col-md-6" style="overflow:hidden; height: 15em;" id="show_of">
                      </div>
                    </div> -->
                  </div>    

          <script type="text/javascript">
              function setJob(text){
                if(text == 'close'){
                  document.getElementById('seleksi_job').style.display = 'none';
                }
                else{
                  document.getElementById('seleksi_job').style.display = 'block';
                }
              }

          </script>
          <form action="<?php echo base_url('/report_eod');?>" method="post">
          </br></br>    <h2> 
                        <div>
                        <input type="radio" name="tipe" id="tipe" onclick="setJob('close')" value="Transaksi" required>Transaksi <span>&nbsp&nbsp&nbsp&nbsp&nbsp</span>
                        <input type="radio" name="tipe" id="tipe" onclick="setJob('open')" value="Start End EOD">Start End Job <span>&nbsp&nbsp&nbsp&nbsp&nbsp</span>
                        <input type="radio" name="tipe" onclick="setJob('open')" id="tipe" value="Elapsed Time">Elapsed Time</br>
                        </h2>
                        </div>
                        <div class="row">
                          <div class="col-md-4" id="seleksi_job">
                            Job :  
                         <select  name="job" style="height: 25px">
                                    <?php foreach($data_job as $row){?>
                                    <option value='<?php echo $row->job_nama; ?>'><?php echo $row->job_nama; ?></option>
                                    <?php } ?>                                  
                           </select>
                          </div>
                          <div class="col-md-8">
                          Dari : 
                            <input type="text" name="start_date" id="single_cal1" required="required" value="">
                            <span class="fa   left" aria-hidden="true">&nbsp&nbsp&nbsp&nbsp&nbsp</span>
                        Sampai :
                            <input type="text" name="end_date" id="single_cal2" required="required" value="">
                            <span class="fa   left" aria-hidden="true">&nbsp&nbsp&nbsp&nbsp&nbsp</span>
                           <input type="submit"  style="height: 25px" value="Filter">
                          </div>                          
                    </form>
                    </br></br>

          <div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                  
                    <?php cetak_flash_msg(); ?>
                  
                 
                    <h2><?php echo $title;?><small>month: <?php echo $month;?> year: <?php echo date('Y');?></small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                     
                    
                    
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <div class="row" style="border-bottom: 1px solid #E0E0E0; padding-bottom: 5px; margin-bottom: 5px;">
                      <div class="col-md-12" style="overflow:hidden; height: 33em;" id="show">
                        
                      
                        
                      
                      </div>
                     

                      
                    </div>

                  </div>
                </div>
              </div>
            </div>

            





           



