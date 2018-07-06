<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Datatables extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_datatables','fdb');
		$this->active_user = get_session('user_nama');
        $this->active_privilege = get_session('user_akses');
        $this->active_user_id = get_session('user_id');
	}

	

	public function ajax_list_ticket()
	{
		$list = $this->fdb->get_datatables_ticket('data_record', array('id','tgl_input',  'user_nama', 'kategori_nama','nama_app','nama_fitur','type','isi','status'), array('id','tgl_input',  'user_nama', 'kategori_nama','nama_app','nama_fitur','type','isi','status'), array('id'=>'desc'));
		
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $list) {
			$no++;
			$row = array();
			$row[] = $list->id;
			$row[] = $list->tgl_input;
			$row[] = $list->user_nama;
			$row[] = $list->nama_app;
			$row[] = $list->nama_fitur;
			$row[] = $list->kategori_nama;
			$row[] = $list->type;
			$string = strip_tags($list->isi);
            // if (strlen($string) > 50) {
            //      // truncate string
            // $stringCut = substr($string, 0, 50);

            //  // make sure it ends in a word so assassinate doesn't become ass...
            // $string = substr($stringCut, 0, strrpos($stringCut, ' ')).'... '; 
            // }
            $row[] = $string;
            if ($list->status == "belum dikerjakan" ) {
              $row[] =    "<i class='btn btn-xs bg-red'>belum dikerjakan</i>";
            } elseif ($list->status == "selesai") {
              $row[] =    "<i class='btn btn-xs bg-green'>selesai</i>";
            }elseif($list->status == "belum dikoreksi"){
              $row[] =    "<i class='btn btn-xs bg-green'>belum dikoreksi</i>";
            }

            if ($this->active_privilege == "superadmin" ){
				if($list->status == "belum dikerjakan" || $list->status == "belum dikoreksi" ){

                $row[] = "<td style='text-align:center' width='140px'>
                        <a title='Lihat' href='".base_url().'data_issue/action/view/'.$list->id."' class='btn btn-circle btn-sm bg-green'>
                            <i class='fa fa-folder'></i>
                        </a>
                        <a title='Edit' href='".base_url().'data_issue/action/edit/'.$list->id."' class='btn btn-circle btn-sm bg-blue'>
		                    <i class='fa fa-edit'></i>
		                </a> 
		                <a title='Delete' data-href='".base_url().'data_issue/action/delete/'.$list->id."' class='btn btn-circle btn-sm bg-red' data-toggle='modal' data-target='.delete-modal'>
                            <i class='fa fa-trash'></i>
                        </a>

                    </td>";
                }else{

                	if($list->type=="Daily Activity"){
                		  $row[] = "<td style='text-align:center' width='140px'>
                        <a title='Lihat' href='".base_url().'data_issue/action/view/'.$list->id."' class='btn btn-circle btn-sm bg-green'>
                            <i class='fa fa-folder'></i>
                        </a>
                       
		                <a title='Delete' data-href='".base_url().'data_issue/action/delete/'.$list->id."' class='btn btn-circle btn-sm bg-red' data-toggle='modal' data-target='.delete-modal'>
                            <i class='fa fa-trash'></i>
                        </a>
                  

                    </td>";

                	}else{
					  $row[] = "<td style='text-align:center' width='140px'>
		                        <a title='Lihat' href='".base_url().'data_issue/action/view/'.$list->id."' class='btn btn-circle btn-sm bg-green'>
		                            <i class='fa fa-folder'></i>
		                        </a>
		                       
				                <a title='Delete' data-href='".base_url().'data_issue/action/delete/'.$list->id."' class='btn btn-circle btn-sm bg-red' data-toggle='modal' data-target='.delete-modal'>
		                            <i class='fa fa-trash'></i>
		                        </a>
		                          
		                    </td>";
                	}

              
                }

             }elseif( (($this->active_privilege == "signer") || ($this->active_privilege == "checker") || ($this->active_privilege== "maker") )) { 
                if($this->active_user == $list->user_nama){
		            	if($list->status == "belum dikerjakan" || $list->status == "belum dikoreksi" ){

		                $row[] = "<td style='text-align:center' width='140px'>
		                        <a title='Lihat' href='".base_url().'data_issue/action/view/'.$list->id."' class='btn btn-circle btn-sm bg-green'>
		                            <i class='fa fa-folder'></i>
		                        </a>
		                        <a title='Edit' href='".base_url().'data_issue/action/edit/'.$list->id."' class='btn btn-circle btn-sm bg-blue'>
				                    <i class='fa fa-edit'></i>
				                </a> 
				                <a title='Delete' data-href='".base_url().'data_issue/action/delete/'.$list->id."' class='btn btn-circle btn-sm bg-red' data-toggle='modal' data-target='.delete-modal'>
		                            <i class='fa fa-trash'></i>
		                        </a>

		                    </td>";
		                }else{

		                $row[] = "<td style='text-align:center' width='140px'>
		                        <a title='Lihat' href='".base_url().'data_issue/action/view/'.$list->id."' class='btn btn-circle btn-sm bg-green'>
		                            <i class='fa fa-folder'></i>
		                        </a>
		                       
				                <a title='Delete' data-href='".base_url().'data_issue/action/delete/'.$list->id."' class='btn btn-circle btn-sm bg-red' data-toggle='modal' data-target='.delete-modal'>
		                            <i class='fa fa-trash'></i>
		                        </a>


		                    </td>";
		                }

                    } else{

		            $row[] = "<td style='text-align:center' width='140px'>
                        <a title='Lihat' href='".base_url().'data_issue/action/view/'.$list->id."' class='btn btn-circle btn-sm bg-green'>
                            <i class='fa fa-folder'></i>
                        </a>
                        </td>";
               }
           }
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->fdb->count_all_ticket('data_record', array('id','tgl_input', 'user_nama', 'kategori_nama','nama_app','nama_fitur','type','isi','status'), array('tgl_input', 'user_nama', 'kategori_nama','nama_app','nama_fitur','type','isi','status'), array('id'=>'asc')),
						"recordsFiltered" => $this->fdb->count_filtered_ticket('data_record', array('id','tgl_input', 'user_nama', 'kategori_nama','nama_app','nama_fitur','type','isi','status'), array('tgl_input','data_record.shift', 'user_nama', 'kategori_nama','nama_app','nama_fitur','type','isi','status'), array('id'=>'asc')),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function ajax_list_reminis()
	{
		$list = $this->fdb->get_datatables_reminis('data_record', array(null,'id','tgl_input', 'shift', 'user_nama', 'kategori_nama','type','isi','status'), array('id','tgl_input', 'shift', 'user_nama', 'kategori_nama','type','isi','status'), array('id'=>'desc'));
		
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $list) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $list->id;
			$row[] = $list->tgl_input;
			$row[] = $list->shift;
			$row[] = $list->user_nama;
			$row[] = $list->kategori_nama;
			$row[] = $list->type;
			$string = strip_tags($list->isi);
            // if (strlen($string) > 50) {
            //      // truncate string
            // $stringCut = substr($string, 0, 50);

            //  // make sure it ends in a word so assassinate doesn't become ass...
            // $string = substr($stringCut, 0, strrpos($stringCut, ' ')).'... '; 
            // }
            $row[] = $string;
            if ($list->status == "belum dikerjakan" ) {
              $row[] =    "<i class='btn btn-xs bg-red'>belum dikerjakan</i>";
            } elseif ($list->status == "selesai") {
              $row[] =    "<i class='btn btn-xs bg-green'>selesai</i>";
            }elseif($list->status == "belum dikoreksi"){
              $row[] =    "<i class='btn btn-xs bg-orange'>belum dikoreksi</i>";
            }

            if ($this->active_privilege == "superadmin" || $this->active_privilege == "signer" ||  $this->active_privilege == "checker" ){
			

                $row[] = "

                <td style='text-align:center' width='140px'>
                		<a title='Koreksi' data-id='".$list->id."' data-href='".base_url(). 'reminder_issue/action/correct_answer/'.$list->id."' class='btn btn-circle btn-sm bg-orange' data-toggle='modal' data-target='.correct-modal'>
                                        <i class='fa fa-check'></i>
                          </a>
                        <a title='Jawab' href='".base_url().'Data_issue/action/view/'.$list->id."' class='btn btn-circle btn-sm bg-green'>
                            <i class='fa fa-plus'></i>
                         </a>

                    </td>";
          			                 
                                    
             }else { 
                   $row[] = "

                <td style='text-align:center' width='140px'>
                		
                        <a title='Jawab' href='".base_url().'Data_issue/action/view/' . $list->id."' class='btn btn-circle btn-sm bg-green'>
                            <i class='fa fa-plus'></i>
                         </a>

                    </td>";
              }
           
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->fdb->count_all_reminis('data_record', array('id','tgl_input', 'data_record.shift', 'user_nama', 'kategori_nama','type','isi','status'), array('tgl_input', 'data_record.shift', 'user_nama', 'kategori_nama','type','isi','status'), array('id'=>'asc')),
						"recordsFiltered" => $this->fdb->count_filtered_reminis('data_record', array('id','tgl_input', 'data_record.shift', 'user_nama', 'kategori_nama','type','isi','status'), array('tgl_input', 'data_record.shift', 'user_nama', 'kategori_nama','type','isi','status'), array('id'=>'asc')),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function ajax_list_prob()
	{

		$list = $this->fdb->get_datatables_prob('data_record', array(null,'tgl_input','tgl_sol', 'data_record.shift', 'user.user_nama', 'kategori_nama','data_tindakan.shift','u.user_nama','data_record.isi','data_tindakan.isi'), array('tgl_input','tgl_sol', 'data_record.shift', 'user.user_nama', 'kategori_nama','data_tindakan.shift','u.user_nama','data_record.isi','data_tindakan.isi'), array('data_record.id'=>'asc'));
		//var_dump($list); die;
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $list) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = "<a class='bg red'>Ticketing:</br>".$list->tgl_input."</a></br>
                                <a class='bg green'>Tindakan :</br>".$list->tgl_sol."<a/>";
			//$row[] = $list->shift;
			$row[] = $list->user_nama;
			$row[] = $list->kategori_nama;
			//$row[] = $list->shift2;
			$row[] = $list->nama2;
			$string = strip_tags($list->isi);
            // if (strlen($string) > 50) {
            //      // truncate string
            // $stringCut = substr($string, 0, 50);

            //  // make sure it ends in a word so assassinate doesn't become ass...
            // $string = substr($stringCut, 0, strrpos($stringCut, ' ')).'... '; 
            // }
            $row[] = $string;
            $string2 = strip_tags($list->isi2);
            // if (strlen($string2) > 50) {
            //      // truncate string
            // $stringCut2 = substr($string2, 0, 50);

            //  // make sure it ends in a word so assassinate doesn't become ass...
            // $string2 = substr($stringCut2, 0, strrpos($stringCut2, ' ')).'... '; 
            // }
            $row[] = $string2;
            $row[] = $list->type;
   
            $row[] = "<td style='text-align:center' width='140px'>
                    <a title='Lihat' href='".base_url().'bank_issue/action/view/'.$list->id."/".$list->id2."' class='btn btn-circle btn-sm bg-green'>
                        <i class='fa fa-folder'></i>
                    </a>
                    <a title='Create SOP' href='".base_url().'data_issue/createsop/'.$list->id."' class='btn btn-circle btn-sm bg-orange'>
				                            <i class='fa fa-print'></i>
				                        </a>

                   

                </td>";
                
       
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->fdb->count_all_prob('data_record', array(null,'tgl_input','tgl_sol', 'data_record.shift', 'user.user_nama', 'kategori_nama','data_tindakan.shift','u.user_nama','data_record.isi','data_tindakan.isi'), array('tgl_input','tgl_sol', 'data_record.shift', 'user.user_nama', 'kategori_nama','data_tindakan.shift','u.user_nama','data_record.isi','data_tindakan.isi'), array('data_record.id'=>'asc')),
						"recordsFiltered" => $this->fdb->count_filtered_prob('data_record', array(null,'tgl_input','tgl_sol', 'data_record.shift', 'user.user_nama', 'kategori_nama','data_tindakan.shift','u.user_nama','data_record.isi','data_tindakan.isi'), array('tgl_input','tgl_sol', 'data_record.shift', 'user.user_nama', 'kategori_nama','data_tindakan.shift','u.user_nama','data_record.isi','data_tindakan.isi'), array('data_record.id'=>'asc')),
						"data" => $data,
				);
		
		//output to json format
		echo json_encode($output);
	}


	

	public function ajax_list_dai()
	{
		$list = $this->fdb->get_datatables_dai('data_record', array('id','tgl_input', 'shift', 'user_nama', 'kategori_nama','type','isi','status'), array('tgl_input', 'shift', 'user_nama', 'kategori_nama','type','isi','status'), array('id'=>'desc'));
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $list) {
			$no++;
			$row = array();
			$row[] = $list->id;
			$row[] = $list->tgl_input;
			$row[] = $list->shift;
			$row[] = $list->user_nama;
			$row[] = $list->kategori_nama;
			$row[] = $list->type;
			$string = strip_tags($list->isi);
            // if (strlen($string) > 50) {
            //      // truncate string
            // $stringCut = substr($string, 0, 50);

            //  // make sure it ends in a word so assassinate doesn't become ass...
            // $string = substr($stringCut, 0, strrpos($stringCut, ' ')).'... '; 
            // }
            $row[] = $string;
            if ($list->status == "belum selesai" ) {
              $row[] =    "<i class='btn btn-xs bg-red'>belum selesai</i>";
            } elseif ($list->status == "selesai") {
              $row[] =    "<i class='btn btn-xs bg-green'>selesai</i>";
            }

            if ($this->active_privilege == "superadmin" ){
				if($list->status == "belum dikerjakan" || $list->status == "belum dikoreksi" ){

                $row[] = "<td style='text-align:center' width='140px'>
                        <a title='Lihat' href='".base_url().'daily_issue/action/view/'.$list->id."' class='btn btn-circle btn-sm bg-green'>
                            <i class='fa fa-folder'></i>
                        </a>
                        <a title='Edit' href='".base_url().'daily_issue/action/edit/'.$list->id."' class='btn btn-circle btn-sm bg-blue'>
		                    <i class='fa fa-edit'></i>
		                </a> 
		                <a title='Delete' data-href='".base_url().'daily_issue/action/delete/'.$list->id."' class='btn btn-circle btn-sm bg-red' data-toggle='modal' data-target='.delete-modal'>
                            <i class='fa fa-trash'></i>
                        </a>

                    </td>";
                }else{

                $row[] = "<td style='text-align:center' width='140px'>
                        <a title='Lihat' href='".base_url().'daily_issue/action/view/'.$list->id."' class='btn btn-circle btn-sm bg-green'>
                            <i class='fa fa-folder'></i>
                        </a>
                      
		                <a title='Delete' data-href='".base_url().'daily_issue/action/delete/'.$list->id."' class='btn btn-circle btn-sm bg-red' data-toggle='modal' data-target='.delete-modal'>
                            <i class='fa fa-trash'></i>
                        </a>

                    </td>";
                }

             }elseif( (($this->active_privilege == "signer") || ($this->active_privilege == "checker") || ($this->active_privilege== "maker") )) { 
                if($this->active_user == $list->user_nama){
		            	if($list->status == "belum dikerjakan" || $list->status == "belum dikoreksi" ){

		                $row[] = "<td style='text-align:center' width='140px'>
		                        <a title='Lihat' href='".base_url().'daily_issue/action/view/'.$list->id."' class='btn btn-circle btn-sm bg-green'>
		                            <i class='fa fa-folder'></i>
		                        </a>
		                        <a title='Edit' href='".base_url().'daily_issue/action/edit/'.$list->id."' class='btn btn-circle btn-sm bg-blue'>
				                    <i class='fa fa-edit'></i>
				                </a> 
				                <a title='Delete' data-href='".base_url().'daily_issue/action/delete/'.$list->id."' class='btn btn-circle btn-sm bg-red' data-toggle='modal' data-target='.delete-modal'>
		                            <i class='fa fa-trash'></i>
		                        </a>

		                    </td>";
		                }else{

		                $row[] = "<td style='text-align:center' width='140px'>
			                        <a title='Lihat' href='".base_url().'daily_issue/action/view/'.$list->id."' class='btn btn-circle btn-sm bg-green'>
			                            <i class='fa fa-folder'></i>
			                        </a>
			                    
					                <a title='Delete' data-href='".base_url().'daily_issue/action/delete/'.$list->id."' class='btn btn-circle btn-sm bg-red' data-toggle='modal' data-target='.delete-modal'>
			                            <i class='fa fa-trash'></i>
			                        </a>

			                    </td>";
		                }

                    } else{

		            $row[] = "<td style='text-align:center' width='140px'>
		                        <a title='Lihat' href='".base_url().'daily_issue/action/view/'.$list->id."' class='btn btn-circle btn-sm bg-green'>
		                            <i class='fa fa-folder'></i>
		                        </a>
		                       

		                    </td>";
               }
           }
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->fdb->count_all_dai('data_record', array(null,'tgl_input', 'shift', 'user_nama', 'kategori_nama','type','isi','status'), array('tgl_input', 'shift', 'user_nama', 'kategori_nama','type','isi','status'), array('id'=>'asc')),
						"recordsFiltered" => $this->fdb->count_filtered_dai('data_record', array(null,'tgl_input', 'shift', 'user_nama', 'kategori_nama','type','isi','status'), array('tgl_input', 'shift', 'user_nama', 'kategori_nama','type','isi','status'), array('id'=>'asc')),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}







	public function ajax_list_sop()
	{
		$list = $this->fdb->get_datatables_sop('sop_app', array(null,'nama_app','nama_fitur','sop_name', 'sop_tgl', 'sop_pic', 'sop_ket'), array('sop_name', 'sop_tgl', 'sop_pic', 'sop_ket'), array('sop_id'=>'asc'));
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $list) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = strtoupper($list->nama_app);
			$row[] = strtoupper($list->nama_fitur);
			$row[] = strtoupper($list->sop_name);
			$row[] = $list->sop_tgl;
			$row[] = $list->sop_pic;
			$row[] = $list->sop_ket;
			$row[] =" <a title='Dokumen' href='".$list->sop_pdf."' class='btn btn-circle btn-sm sbold bg-blue' target='_blank'>
                                    <i class='fa fa-file'></i> Lihat Dokumen
                                </a>";
            if ($this->active_privilege == "superadmin" || ($this->active_privilege == "signer") ){
				
                $row[] = "<td style='text-align:center' width='140px'>
                        <a title='Lihat' href='".base_url().'data_sop/action/view/'.$list->sop_id."' class='btn btn-circle btn-sm bg-green'>
                            <i class='fa fa-folder'></i>
                        </a>
                        <a title='Edit' href='".base_url().'data_sop/action/edit/'.$list->sop_id."' class='btn btn-circle btn-sm bg-blue'>
		                    <i class='fa fa-edit'></i>
		                </a> 
		                <a title='Delete' data-href='".base_url().'data_sop/action/delete/'.$list->sop_id."' class='btn btn-circle btn-sm bg-red' data-toggle='modal' data-target='.delete-modal'>
                            <i class='fa fa-trash'></i>
                        </a>

                    </td>";
               

             }elseif( ( ($this->active_privilege == "checker") || ($this->active_privilege== "maker") )) { 
                
		            

		              

		            $row[] = "<td style='text-align:center' width='140px'>
		                        <a title='Lihat' href='".base_url().'data_sop/action/view/'.$list->sop_id."' class='btn btn-circle btn-sm bg-green'>
		                            <i class='fa fa-folder'></i>
		                        </a>

		                    </td>";
               
           }
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->fdb->count_all_sop('sop_app', array(null,'nama_app','nama_fitur','sop_name', 'sop_tgl', 'sop_pic', 'sop_ket'), array('sop_name', 'sop_tgl', 'sop_pic', 'sop_ket'), array('sop_id'=>'asc')),
						"recordsFiltered" => $this->fdb->count_filtered_sop('sop_app', array(null,'nama_app','nama_fitur','sop_name', 'sop_tgl', 'sop_pic', 'sop_ket'), array('sop_name', 'sop_tgl', 'sop_pic', 'sop_ket'), array('sop_id'=>'asc')),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}


	public function ajax_list_vend()
	{
		$list = $this->fdb->get_datatables_vend('vendor', array(null,'spk_nmr', 'nama_projek', 'vendor_nama', 'vendor_begindate','status','nilai_kontrak',null), array('spk_nmr', 'nama_projek', 'vendor_nama', 'vendor_begindate','status','nilai_kontrak'), array('vendor_id'=>'asc'));
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $list) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $list->spk_nmr;
			$row[] = $list->nama_projek;
			$row[] = $list->vendor_nama;
			$row[] ="<a class='green'>Mulai:</br>".$list->vendor_begindate."</a>
                                </br><a class='red'>Berakhir:</br>".$list->vendor_enddate."</a>";

            if($list->status == 'selesai'){
            $row[] = "<i class='btn btn-circle btn-xs bg-red'>selesai</i>";
            } else{

            $row[] = "<i class='btn btn-circle btn-xs bg-green'>".$list->status."</i>";
             };
             $row[] = format_rupiah2($list->nilai_kontrak);
            $row[] =" <a title='Dokumen' href='".$list->vendor_dokumen."' class='btn btn-circle btn-sm bg-blue' target='_blank'>
                                    <i class='fa fa-file'> </i> Lihat Dokumen
                                </a>";
            if ($this->active_privilege == "superadmin" || ($this->active_privilege == "signer") ){
				
                $row[] = "<td style='text-align:center' width='140px'>
                        <a title='Lihat' href='".base_url().'data_vendor/action/view/'.$list->vendor_id."' class='btn btn-circle btn-sm bg-green'>
                            <i class='fa fa-folder'></i>
                        </a>
                        <a title='Edit' href='".base_url().'data_vendor/action/edit/'.$list->vendor_id."' class='btn btn-circle btn-sm bg-blue'>
		                    <i class='fa fa-edit'></i>
		                </a> 
		                <a title='Delete' data-href='".base_url().'data_vendor/action/delete/'.$list->vendor_id."' class='btn btn-circle btn-sm bg-red' data-toggle='modal' data-target='.delete-modal'>
                            <i class='fa fa-trash'></i>
                        </a>

                    </td>";
               

             }elseif( (($this->active_privilege == "signer") || ($this->active_privilege == "checker") || ($this->active_privilege== "maker") )) { 
                    

		              

		            $row[] = "<td style='text-align:center' width='140px'>
		                        <a title='Lihat' href='".base_url().'data_vendor/action/view/'.$list->vendor_id."' class='btn btn-circle btn-sm bg-green'>
		                            <i class='fa fa-folder'></i>
		                        </a>

		                    </td>";
               
           }
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->fdb->count_all_vend('vendor', array(null,'spk_nmr', 'nama_projek', 'vendor_nama', 'vendor_begindate','status','nilai_kontrak',null), array('spk_nmr', 'nama_projek', 'vendor_nama', 'vendor_begindate','status','nilai_kontrak'), array('vendor_id'=>'asc')),
						"recordsFiltered" => $this->fdb->count_filtered_vend('vendor', array(null,'spk_nmr', 'nama_projek', 'vendor_nama', 'vendor_begindate','status','nilai_kontrak',null), array('spk_nmr', 'nama_projek', 'vendor_nama', 'vendor_begindate','status','nilai_kontrak'), array('vendor_id'=>'asc')),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

}
