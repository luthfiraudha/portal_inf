                <div class="row">
                  <div class="col-xs-12 left">
                    <p>Berikut adalah list solusi dari Issue pada tanggal <?php echo $issue_detail->tgl_input;?></p>
                    <p>Nomor Ticket:  <a class="bg green"><?php echo $issue_detail->id;?></a></p>
                    <p>Jenis Ticket:  <a class="bg green"><?php echo $issue_detail->type;?></a></p>
                    <p>Dengan permasalahan: <?php echo $issue_detail->isi;?></p>
                   
                  </div>
                </div>
                <div class="ln_solid">
                        </div>
                <div class="row">

                <div class="col-xs-3">
                      <!-- required for floating -->
                      <!-- Nav tabs -->
                      
                       <?php 
                if($answer_detail == NULL){
                  echo "Belum ada data tindakan !!";
                }
                ?>
                      
                      <ul class="nav nav-tabs tabs-left">
                        <?php 
                        $i=0;
                        foreach ($answer_detail as $answer) {
                         ?>
                        <li class="<?php if($i==0) echo 'active';?>"><a href="<?php echo '#'.$answer->id;?>" data-toggle="tab"><input type="checkbox" name="id[]" id="answer" value="<?php echo $answer->id;?>" class="flat" /> <?php echo $answer->user_nama; ?></a>
                        </li>
                         <?php 
                         $i++;
                       } ?>
                      </ul>
                      
                    </div>

                    <div class="col-xs-6">
                      <!-- Tab panes -->
                      <div class="tab-content">
                        <?php 
                        $j=0;
                        foreach ($answer_detail as $answer2) { ?>
                        <div class="tab-pane <?php if($j==0) echo 'active';?>" id="<?php echo $answer2->id;?>">
                          <p class="lead"> DETAIL : </p>
                          <div id="content"></div>
                          <p>Nama : <?php echo $answer2->user_nama; ?></p>
                           </br>
                           <p>Tanggal : <?php echo $answer2->tgl_sol; ?></p>
                          </br>
                           <p>Shift : <?php echo $answer2->shift; ?></p>
                           </br>
                           <p>Answer : <?php echo $answer2->isi; ?></p>
                           </br>
                           </div>
                         <?php 
                         $j++;
                       } ?>
                      
                      </div>
                    </div>
                  </div>

                  
                   <script>
                                       // iCheck
                    $(document).ready(function() {
                        if ($("input.flat")[0]) {
                            $(document).ready(function () {
                                $('input.flat').iCheck({
                                    checkboxClass: 'icheckbox_flat-green',
                                    radioClass: 'iradio_flat-green'
                                });
                            });
                        }
                    });
                    // /iCheck

                   


                   </script>