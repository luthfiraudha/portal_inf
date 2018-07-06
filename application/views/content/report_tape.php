
                  <div class="x_title">
                   <div class="x_content">
                    <h2><?php echo "Status Tape";?><small> | <?php date_default_timezone_set("Asia/Jakarta"); echo date('l, d/m/Y H:i:s');?></small></h2>
                    <ul class="nav navbar-right panel_toolbox"></ul>
                    <div class="clearfix"></div>
                    <div class="row" style="border-bottom: 1px solid #E0E0E0; padding-bottom: 5px; margin-bottom: 5px;">
                      <div class="col-md-6" style="overflow:hidden; height: 15em;" id="show_pf">
                      </div>
                      <div class="col-md-6" style="overflow:hidden; height: 15em;" id="show_of">
                      </div>
                    </div>
                  </div>    

          <form action="<?php echo base_url('/report_tape');?>" method="post">
          </br></br>
                         Tape:  
                         <select  name="tape" style="height: 25px">
                              <option value="empty">select tape</option>
                                    <option value="pf">iSeries</option>
                                    <option value="of">Open System</option>                                   
                           </select>
                            <span>&nbsp&nbsp&nbsp&nbsp&nbsp</span>
                        Dari : 
                            <input type="text" name="start_date" id="single_cal1" required="required" value="">
                            <span class="left" aria-hidden="true">&nbsp&nbsp&nbsp&nbsp&nbsp</span>
                        Sampai :
                            <input type="text" name="end_date" id="single_cal2" required="required" value="">
                            <span class="left" aria-hidden="true">&nbsp&nbsp&nbsp&nbsp&nbsp</span>
                           <input type="submit"  style="height: 25px" value="Filter">                          
                    </form>
                    </br>

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
                      <div class="col-md-12" style="overflow:hidden; height: 20em;" id="show">
                        
                      
                      </div>
                     

                      
                    </div>
                  </div>
                </div>
              </div>
            </div>

            





           



