<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manajemen_tape extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_manajemen_tape','fdb');
		$this->load->model('M_data_tape', 'fdk');
		$this->load->model('M_request_tape', 'fdb_rt');
		$this->load->model('M_data_tape_of_available', 'fdb_of');
		$this->active_user = get_session('user_nama');
        $this->active_privilege = get_session('user_akses');
        $this->active_user_id = get_session('user_id');
	}

	
	public function ajax_list_tape_PF()
	{
		$library = str_replace(' ', '', strtoupper($this->input->post('library')));
		if($library != "")
		{
			$temp = $this->fdk->get_setTape($library);
			$set_tape = $temp;
			
		}
		else
		{
			$set_tape = "";
		}

		$list = $this->fdb->get_datatables_tape_PF($set_tape, 'data_tape', array('id_tape','vol_id', 'start_date', 'lokasi','rak_after', 'koordinat_after','set_tape', 'state', 'status', 'jenis'), array('vol_id', 'start_date', 'lokasi','rak_after', 'koordinat_after','set_tape', 'state', 'status', 'jenis'), array('id_tape'=>'asc'));
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $list) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $list->vol_id;
			$row[] = $list->start_date;
			$row[] = $list->lokasi;
			$row[] = $list->rak_after;
			$row[] = $list->koordinat_after;
			
            if ($list->set_tape == "New Tape" ) {
              $row[] =    "<i class='btn btn-xs bg-green'> New Tape </i>";
              $row[] = "New Tape";
              $row[] = "New Tape";
              $row[] = "New Tape";
            } else if ($list->set_tape == "Kosong" ){
              $row[] =    "<i class='btn btn-xs bg-orange'> Kosong </i>";
              $row[] = "Kosong";
              $row[] = "Kosong";
              $row[] = "Kosong";
            }else{
              $row[] =    "<b class='btn btn-xs bg-red'>" .$list->set_tape. "</b>";
              $row[] = $list->state;
              $row[] = $list->status;
              $row[] = $list->jenis;
              //$row[] = $list->status;
            }
            if($list->rak_after == "Request")
            {
            	$row[] = "<td style='text-align:center' width='140px'>
                        <a title='Lihat' href='".base_url().'data_tape_pf/action/view/'.$list->id_tape."' class='btn btn-circle btn-sm bg-green'>
                            <i class='fa fa-folder'></i>
                        </a></td>";
            } else {
            if ($this->active_privilege == "superadmin" || ($this->active_privilege == "signer") ){
				
                $row[] = "<td style='text-align:center' width='140px'>
                        <a title='Lihat' href='".base_url().'data_tape_pf/action/view/'.$list->id_tape."' class='btn btn-circle btn-sm bg-green'>
                            <i class='fa fa-folder'></i>
                        </a>
                        <a title='Edit' href='".base_url().'data_tape_pf/action/edit/'.$list->id_tape."' class='btn btn-circle btn-sm bg-blue'>
		                    <i class='fa fa-edit'></i>
		                </a> 
		                <a title='Recycle' href='".base_url().'data_tape_pf/action/recycle/'.$list->id_tape."' class='btn btn-circle btn-sm bg-orange' data-toggle='modal' data-target='.dismiss-modal'>
		                    <i class='fa fa-eraser'></i>
		                </a>
		                <a title='Request' href='".base_url().'data_tape_pf/action/request/'.$list->id_tape."' class='btn btn-circle btn-sm bg-purple'>
                            <i class='fa fa-send'></i>
                        </a>
		                <a title='Delete' data-href='".base_url().'data_tape_pf/action/delete/'.$list->id_tape."' class='btn btn-circle btn-sm bg-red' data-toggle='modal' data-target='.delete-modal'>
                            <i class='fa fa-trash'></i>
                        </a>

                    </td>";
               

             }elseif( (($this->active_privilege == "signer") || ($this->active_privilege == "checker") || ($this->active_privilege== "maker") )) { 
                    

		              

		            $row[] = "<td style='text-align:center' width='140px'>
		                        <a title='Lihat' href='".base_url().'data_tape_pf/action/view/'.$list->id_tape."' class='btn btn-circle btn-sm bg-green'>
		                            <i class='fa fa-folder'></i>
		                        </a>
					<a title='Edit' href='".base_url().'data_tape_pf/action/edit/'.$list->id_tape."' class='btn btn-circle btn-sm bg-blue'>
		              		    <i class='fa fa-edit'></i>
		               		</a>

		                    </td>";
               }
           }
            $data[] = $row;
		}
          
		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->fdb->count_all_tape_PF('data_tape', array('id_tape','vol_id', 'start_date', 'lokasi','rak_after', 'koordinat_after','set_tape', 'state', 'status', 'jenis'), array('vol_id', 'start_date', 'lokasi','rak_after', 'koordinat_after','set_tape', 'state', 'status', 'jenis'), array('id_tape'=>'asc')),
						"recordsFiltered" => $this->fdb->count_filtered_tape_PF('data_tape', array('id_tape','vol_id', 'start_date', 'lokasi','rak_after', 'koordinat_after','set_tape', 'state', 'status', 'jenis'), array('vol_id', 'start_date', 'lokasi','rak_after', 'koordinat_after','set_tape', 'state', 'status', 'jenis'), array('id_tape'=>'asc')),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}


	public function ajax_list_tape_OF()
	{
		$list = $this->fdb->get_datatables_tape_OF('data_tape_of', array('id_tape','vol_id', 'tanggal', 'lokasi','rak_after', 'koordinat_after', 'hostname', 'ip', 'size', 'jenis', 'id_content'), array('id_tape','vol_id', 'tanggal', 'lokasi','rak_after', 'koordinat_after', 'hostname', 'ip', 'size', 'jenis', 'id_content'), array('id_tape'=>'asc'));
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $list) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $list->vol_id;
			$row[] = $list->tanggal;
			$row[] = $list->hostname;
			$row[] = $list->ip;
			$row[] = $list->lokasi;
			$row[] = $list->rak_after;
			$row[] = $list->koordinat_after;
			$row[] = number_format(($list->size/1024), 2)." GB";
			$row[] = $list->jenis;
			if($list->rak_after == "Request")
            {
            	$row[] = "<td style='text-align:center' width='140px'>
                        <a title='Lihat' href='".base_url().'data_tape_of/action/view/'.$list->id_content."' class='btn btn-circle btn-sm bg-green'>
                            <i class='fa fa-folder'></i>
                        </a></td>";
            } else {
	            if ($this->active_privilege == "superadmin" || ($this->active_privilege == "signer") ){
					
	                $row[] = "<td style='text-align:center' width='140px'>
	                        <a title='Lihat' href='".base_url().'data_tape_of/action/view/'.$list->id_content."' class='btn btn-circle btn-sm bg-green'>
	                            <i class='fa fa-folder'></i>
			                </a> 
			                <a title='Request' href='".base_url().'data_tape_of/action/request/'.$list->id_content."' class='btn btn-circle btn-sm bg-orange'>
			                    <i class='fa fa-send'></i>
			                </a>
			                <a title='Edit' href='".base_url().'data_tape_of/action/edit/'.$list->id_content."' class='btn btn-circle btn-sm bg-blue'>
			                    <i class='fa fa-edit'></i>
			                </a>
	                    </td>";
	               

	             }elseif( (($this->active_privilege == "signer") || ($this->active_privilege == "checker") || ($this->active_privilege== "maker") )) { 
	                    

			              

			            $row[] = "<td style='text-align:center' width='140px'>
			                        <a title='Lihat' href='".base_url().'data_tape_of/action/view/'.$list->id_tape."' class='btn btn-circle btn-sm bg-green'>
			                            <i class='fa fa-folder'></i>
			                        </a>

			                    </td>";
		      }
               
           }
            $data[] = $row;
		}
          
		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->fdb->count_all_tape_OF('data_tape_of', array('id_tape','vol_id', 'tanggal', 'lokasi','rak_after', 'koordinat_after', 'hostname', 'ip', 'size', 'jenis'), array('id_tape','vol_id', 'tanggal', 'lokasi','rak_after', 'koordinat_after', 'hostname', 'ip', 'size', 'jenis'), array('id_tape'=>'asc')),
						"recordsFiltered" => $this->fdb->count_filtered_tape_OF('data_tape_of', array('id_tape','vol_id', 'tanggal', 'lokasi','rak_after', 'koordinat_after', 'hostname', 'ip', 'size', 'jenis'), array('id_tape','vol_id', 'tanggal', 'lokasi','rak_after', 'koordinat_after', 'hostname', 'ip', 'size', 'jenis'), array('id_tape'=>'asc')),
						"data" => $data,
				);
		//output to json format

		echo json_encode($output);
	}

	//AJAX TAPE OF AVAILABLE
	public function ajax_list_tape_OF_available()
	{
		$tempHostname = $this->input->post('hostname');
		$tempIP = $this->input->post('ip');
		if($tempHostname == "" && $tempIP == "")
		{
			$vol_id = "";
		}
		else{
			$vol_id = $this->fdb_of->getVolID($tempHostname, $tempIP);
		}
		$list = $this->fdb->get_datatables_tape_OF_available($vol_id, 'data_tape_of', array('id_tape','vol_id', 'tanggal_tape', 'lokasi','rak_after', 'koordinat_after', 'size_usage', 'size_total', 'status'), array('id_tape','vol_id', 'tanggal_tape', 'lokasi','rak_after', 'koordinat_after', 'size_usage', 'size_total', 'status'), array('id_tape'=>'asc'));
		$data = array();
		$no = $_POST['start'];
		$size = $_POST['size'];
		foreach ($list as $list) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $list->vol_id;
			$row[] = $list->tanggal_tape;
			$row[] = $list->lokasi;
			$row[] = $list->rak_after;
			$row[] = $list->koordinat_after;
			$row[] = number_format((($list->size_total-$list->size_usage)/1024), 2)." GB";
			$row[] = number_format(($list->size_total/1024), 2)." GB";
			$row[] = $list->jumlah." Host";
			if($list->rak_after == "Request")
            {
            	$row[] = "<td style='text-align:center' width='140px'>
                        <a title='Lihat' href='".base_url().'OF_available/action/view/'.$list->id_tape."' class='btn btn-circle btn-sm bg-green'>
                            <i class='fa fa-folder'></i>
                        </a></td>";
            } else {
	            if ($this->active_privilege == "superadmin" || ($this->active_privilege == "signer") ){
					
	                $row[] = "<td style='text-align:center' width='140px'>
	                        <a title='Lihat' href='".base_url().'of_available/action/view/'.$list->id_tape."' class='btn btn-circle btn-sm bg-green'>
	                            <i class='fa fa-folder'></i>
			                </a> 
			                 <a title='Add Host' href='".base_url().'of_available/action/add_host/'.$list->id_tape.'/'.$size."' class='btn btn-circle btn-sm bg-blue'>
	                            <i class='fa fa-plus-square'></i>
			                </a> 
			                <a title='Request' href='".base_url().'of_available/action/request/'.$list->id_tape."' class='btn btn-circle btn-sm bg-orange'>
			                    <i class='fa fa-send'></i>
			                </a>
			                <a title='Configuration' href='".base_url().'of_available/action/configuration/'.$list->id_tape."' class='btn btn-circle btn-sm bg-purple'>
			                    <i class='fa fa-wrench'></i>
			                </a>
	                    </td>";
	               

	             }elseif( (($this->active_privilege == "signer") || ($this->active_privilege == "checker") || ($this->active_privilege== "maker") )) { 
	                    

			              

			            $row[] = "<td style='text-align:center' width='140px'>
			                        <a title='Lihat' href='".base_url().'of_available/action/view/'.$list->id_tape."' class='btn btn-circle btn-sm bg-green'>
			                            <i class='fa fa-folder'></i>
			                        </a>

			                    </td>";
			    }
               
           }
            $data[] = $row;
		}
          
		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->fdb->count_all_tape_OF('data_tape_of', array('id_tape','vol_id', 'tanggal_tape', 'lokasi','rak_after', 'koordinat_after', 'size_usage', 'size_total', 'status'), array('id_tape','vol_id', 'tanggal_tape', 'lokasi','rak_after', 'koordinat_after', 'size_usage', 'size_total', 'status'), array('id_tape'=>'asc')),
						"recordsFiltered" => $this->fdb->count_filtered_tape_OF('data_tape_of', array('id_tape','vol_id', 'tanggal_tape', 'lokasi','rak_after', 'koordinat_after', 'size_usage', 'size_total', 'status'), array('id_tape','vol_id', 'tanggal_tape', 'lokasi','rak_after', 'koordinat_after', 'size_usage', 'size_total', 'status'), array('id_tape'=>'asc')),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}



	public function ajax_list_tape_ZF()
	{
		$library = str_replace(' ', '', strtoupper($this->input->post('library')));
		if($library != "")
		{
			$temp = $this->fdk->get_setTape($library);
			// foreach ($$temp as $row) {
			// 	$set_tape[] = $temp->set_tape;
			// }
			$set_tape = $temp;
			
		}
		else
		{
			$set_tape = "";
		}

		$list = $this->fdb->get_datatables_tape_ZF($set_tape, 'data_tape', array('id_tape','vol_id', 'start_date', 'lokasi','rak_after', 'koordinat_after','set_tape', 'state', 'status', 'jenis'), array('vol_id', 'start_date', 'lokasi','rak_after', 'koordinat_after','set_tape', 'state', 'status', 'jenis'), array('id_tape'=>'asc'));
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $list) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $list->vol_id;
			$row[] = $list->start_date;
			$row[] = $list->lokasi;
			$row[] = $list->rak_after;
			$row[] = $list->koordinat_after;
			
            if ($list->set_tape == "New Tape" ) {
              $row[] =    "<i class='btn btn-xs bg-green'> New Tape </i>";
              $row[] = "New Tape";
              $row[] = "New Tape";
              $row[] = "New Tape";
            } else if ($list->set_tape == "Kosong" ){
              $row[] =    "<i class='btn btn-xs bg-orange'> Kosong </i>";
              $row[] = "Kosong";
              $row[] = "Kosong";
              $row[] = "Kosong";
            }else{
              $row[] =    "<b class='btn btn-xs bg-red'>" .$list->set_tape. "</b>";
              $row[] = $list->state;
              $row[] = $list->status;
              $row[] = $list->jenis;
              //$row[] = $list->status;
            }
            if ($this->active_privilege == "superadmin" || ($this->active_privilege == "signer") ){
				
                $row[] = "<td style='text-align:center' width='140px'>
                        <a title='Lihat' href='".base_url().'data_tape/action/view/'.$list->id_tape."' class='btn btn-circle btn-sm bg-green'>
                            <i class='fa fa-folder'></i>
                        </a>
                        <a title='Edit' href='".base_url().'data_tape/action/edit/'.$list->id_tape."' class='btn btn-circle btn-sm bg-blue'>
		                    <i class='fa fa-edit'></i>
		                </a> 
		                <a title='Recycle' href='".base_url().'data_tape/action/recycle/'.$list->id_tape."' class='btn btn-circle btn-sm bg-orange' data-toggle='modal' data-target='.dismiss-modal'>
		                    <i class='fa fa-eraser'></i>
		                </a>
		                <a title='Delete' data-href='".base_url().'data_tape/action/delete/'.$list->id_tape."' class='btn btn-circle btn-sm bg-red' data-toggle='modal' data-target='.delete-modal'>
                            <i class='fa fa-trash'></i>
                        </a>

                    </td>";
               

             }elseif( (($this->active_privilege == "signer") || ($this->active_privilege == "checker") || ($this->active_privilege== "maker") )) { 
                    

		              

		            $row[] = "<td style='text-align:center' width='140px'>
		                        <a title='Lihat' href='".base_url().'data_tape/action/view/'.$list->id_tape."' class='btn btn-circle btn-sm bg-green'>
		                            <i class='fa fa-folder'></i>
		                        </a>

		                    </td>";
               
           }
            $data[] = $row;
		}
          
		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->fdb->count_all_tape_ZF('data_tape', array('id_tape','vol_id', 'start_date', 'lokasi','rak_after', 'koordinat_after','set_tape', 'state', 'status', 'jenis'), array('vol_id', 'start_date', 'lokasi','rak_after', 'koordinat_after','set_tape', 'state', 'status', 'jenis'), array('id_tape'=>'asc')),
						"recordsFiltered" => $this->fdb->count_filtered_tape_ZF('data_tape', array('id_tape','vol_id', 'start_date', 'lokasi','rak_after', 'koordinat_after','set_tape', 'state', 'status', 'jenis'), array('vol_id', 'start_date', 'lokasi','rak_after', 'koordinat_after','set_tape', 'state', 'status', 'jenis'), array('id_tape'=>'asc')),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}



	public function ajax_list_request_tape()
	{
		$list = $this->fdb->get_datatables_request_tape('request_tape', array('id_request','vol_id', 'no_surat', 'tujuan','perihal', 'lastupdated', 'user_pn', 'status'), array('id_request','vol_id', 'no_surat', 'tujuan','perihal', 'lastupdated', 'user_pn', 'status'), array('id_request'=>'asc'));
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $list) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $list->vol_id;
			$row[] = $list->no_surat;
			$row[] = $list->tujuan;
			$row[] = $list->perihal;
			$row[] = $list->lastupdated;
			$row[] = $list->user_pn;

			if ($list->status != "Keluar") {

				$tape = substr($list->vol_id,0,2);
				if($tape == "PF")
				{
					$result = $this->fdb_rt->getID_PF($list->vol_id);
					if(isset($result)){
						$row[] = "<td style='text-align:center' width='140px'>
                        <a title='Keluar' href='".base_url().'data_tape_pf/action/view/'.$result->id_tape."' class='btn btn-circle btn-sm bg-red'><i class='fa fa-sign-out'></i>
		                </a> </td>";
		            }
		            else{
		            	$row[] = "<td style='text-align:center' width='140px'></td>";
		            }
				}
				else if($tape == "OF")
				{
					$result = $this->fdb_rt->getID_OF($list->vol_id);
					if(isset($result)) {
						$row[] = "<td style='text-align:center' width='140px'>
	                        <a title='Keluar' href='".base_url().'data_tape_of/action/view/'.$result->id_tape."' class='btn btn-circle btn-sm bg-red'><i class='fa fa-sign-out'></i>
			                </a> </td>";
			        }
			        else {
			        	$row[] = "<td style='text-align:center' width='140px'></td>";
			        }
			    }

				
			}else {
				$row[] = "<td style='text-align:center' width='140px'>
                        <a title='Masuk' href='".base_url().'request_tape/action/masuk/'.$list->id_request."' class='btn btn-circle btn-sm bg-green'>
                            <i class='fa fa-sign-in'></i>
		                </a> </td>";
			}

            /*if ($this->active_privilege == "superadmin" || ($this->active_privilege == "signer") ){
				
                $row[] = "<td style='text-align:center' width='140px'>
                        <a title='Lihat' href='".base_url().'data_tape_of/action/view/'.$list->id_request."' class='btn btn-circle btn-sm bg-green'>
                            <i class='fa fa-folder'></i>
		                </a> 
		                <a title='Request' href='".base_url().'data_tape_of/action/request/'.$list->id_request."' class='btn btn-circle btn-sm bg-orange'>
		                    <i class='fa fa-send'></i>
		                </a>
		                <a title='Edit' href='".base_url().'data_tape_of/action/edit/'.$list->id_request."' class='btn btn-circle btn-sm bg-blue'>
		                    <i class='fa fa-edit'></i>
		                </a>
                    </td>";
               

             }elseif( (($this->active_privilege == "signer") || ($this->active_privilege == "checker") || ($this->active_privilege== "maker") )) { 
                    

		              

		            $row[] = "<td style='text-align:center' width='140px'>
		                        <a title='Lihat' href='".base_url().'data_vendor/action/view/'.$list->id_tape."' class='btn btn-circle btn-sm bg-green'>
		                            <i class='fa fa-folder'></i>
		                        </a>

		                    </td>";
               
           }*/
            $data[] = $row;
		}
          
		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->fdb->count_all_request_tape('request_tape', array('id_request','vol_id', 'no_surat', 'tujuan','perihal', 'lastupdated', 'user_pn', 'status'), array('id_request','vol_id', 'no_surat', 'tujuan','perihal', 'lastupdated', 'user_pn', 'status'), array('id_request'=>'asc')),
						"recordsFiltered" => $this->fdb->count_filtered_request_tape('request_tape', array('id_request','vol_id', 'no_surat', 'tujuan','perihal', 'lastupdated', 'user_pn', 'status'), array('id_request','vol_id', 'no_surat', 'tujuan','perihal', 'lastupdated', 'user_pn', 'status'), array('id_request'=>'asc')),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

}

