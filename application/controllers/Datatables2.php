<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Datatables2 extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_datatables2','fdb');
		$this->active_user = get_session('user_nama');
        $this->active_privilege = get_session('user_akses');
        $this->active_user_id = get_session('user_id');
	}

	
	

	public function ajax_list_inven()
	{
		$list = $this->fdb->get_datatables2_inven('datainven', array(null,'spk_inven','qty_inven','tersedia','dipakai', 'rusak','nama_inven','merk','kapasitas', 'sumber_inven', 'tgl_datang', null), array('spk_inven','qty_inven','tersedia','dipakai', 'rusak','nama_inven','merk','kapasitas', 'sumber_inven', 'tgl_datang'), array('tgl_input'=>'desc'));
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $list) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $list->spk_inven;
			$row[] = $list->nama_inven . " " . $list->merk ." " . $list->kapasitas . " GB" ;
			$row[] = $list->qty_inven;
			$row[] = $list->tersedia;
			$row[] = $list->dipakai;
			$row[] = $list->rusak;
			$row[] = $list->sumber_inven;
			$row[] = $list->tgl_datang;
            
            $row[] ="<a title='Lihat' href='".base_url().'data_inven/action/view/'.$list->id_inven."' class='btn btn-circle btn-sm sbold bg-blue'>
                            <i class='fa fa-folder'>  Detail</i>
                        </a>"; 

            
				
            /*$row[] = ?> "<a data-href= "<?php echo .base_url().'data_inven/action/pakai/'. $list->id_inven.?>" class="btn btn-circle btn-sm sbold bg-blue" data-id="<?php echo $list->id; ?>" data-fitur="Pakai Inventori" data-toggle="modal" data-target=".pakai-modal">
                <i class='fa fa-check'>  Pakai</i>
                </a>";

                <?php*/
            if ($list->tersedia != 0 ){
            $row[] ="<a title='Use' href='".base_url().'data_inven/action/pakai/'.$list->id_inven."' class='btn btn-circle btn-sm sbold bg-blue'>
                            <i class='fa fa-check'>  Pakai</i>
                        </a>";
            }
            else
            {
            	$row[] ="<a class='btn btn-circle btn-sm sbold bg-blue'>
                            <i class='fa fa-check'>  Pakai</i>
                        </a>";	
            }
                        /*<a data-href="<?php echo base_url() . 'data_inven/action/pakai/' . $issue_detail->id) ?>" class="btn btn-sm sbold bg-green" data-id="<?php echo $issue_detail->id; ?>" data-fitur="Tambah Jawaban" data-toggle="modal" data-target=".add-answer-modal">
                        <i class="fa fa-plus"></i> Input Tindakan
                        </a>;*/
            if ($this->active_privilege == "superadmin" ){

                $row[] = "<td style='text-align:center' width='140px'>
                        <a title='Edit' href='".base_url().'data_inven/action/edit/'.$list->id_inven."' class='btn btn-circle btn-sm bg-orange'>
		                    <i class='fa fa-edit'></i>
		                </a> 
		                <a title='Delete' data-href='".base_url().'data_inven/action/delete/'.$list->id_inven."' class='btn btn-circle btn-sm bg-red' data-toggle='modal' data-target='.delete-modal'>
                            <i class='fa fa-trash'></i>
                        </a>

                    </td>";
               

            }
            elseif( (($this->active_privilege == "signer") || ($this->active_privilege == "checker") || ($this->active_privilege== "maker") )) { 
                
                $row[] ="<a title='Lihat' href='".base_url().'data_inven/action/use/'.$list->id_inven."' class='btn btn-circle btn-sm sbold bg-blue'>
                            <i class='fa fa-folder'>  Pakai Inventori</i>
                        </a>";
           	}
			
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->fdb->count_all_inven('datainven', array(null,'spk_inven','qty_inven','tersedia','dipakai', 'rusak','nama_inven','merk','kapasitas', 'sumber_inven', 'tgl_datang', null), array('spk_inven','qty_inven','tersedia','dipakai', 'rusak','nama_inven','merk','kapasitas', 'sumber_inven', 'tgl_datang'), array('tgl_input'=>'desc')),
						"recordsFiltered" => $this->fdb->count_filtered_inven('datainven', array(null,'spk_inven','qty_inven','tersedia','dipakai', 'rusak','nama_inven','merk','kapasitas', 'sumber_inven', 'tgl_datang', null), array('spk_inven','qty_inven','tersedia','dipakai', 'rusak','nama_inven','merk','kapasitas', 'sumber_inven', 'tgl_datang'), array('tgl_input'=>'desc')),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function ajax_list_trans()
	{
		$list = $this->fdb->get_datatables2_trans('datatransaksi', array(null,'spk_inven','nama_inven','qty_transaksi', 'ket_inven','status', 'tgl_transaksi', 'tgl_input',null), array('spk_inven','nama_inven','qty_transaksi', 'ket_inven','status', 'tgl_transaksi', 'tgl_input'), array('tgl_input'=>'desc'));
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $list) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $list->spk_inven;
			$row[] = $list->nama_inven;
			$row[] = $list->qty_transaksi;
			$row[] = $list->ket_inven;
			if ($list->status == "Masuk" ) {
              $row[] =    "<i class='btn btn-xs bg-green'>Masuk</i>";
            } elseif ($list->status == "Keluar") {
              $row[] =    "<i class='btn btn-xs bg-blue'>Keluar</i>";
            }
			$row[] = $list->tgl_transaksi;
			$row[] = $list->tgl_input;
            

            if ($this->active_privilege == "superadmin" ){

                $row[] = "<td style='text-align:center' width='140px'>
                         
		                <a title='Delete' data-href='".base_url().'data_transaksi/action/delete/'.$list->id_transaksi."' class='btn btn-circle btn-sm bg-red' data-toggle='modal' data-target='.delete-modal'>
                            <i class='fa fa-trash'></i>
                        </a>

                    </td>";
               

            }
			
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->fdb->count_all_trans('datatransaksi', array(null,'spk_inven','nama_inven','qty_transaksi', 'ket_inven','status', 'tgl_transaksi', 'tgl_input',null), array('spk_inven','nama_inven','qty_transaksi', 'ket_inven','status', 'tgl_transaksi', 'tgl_input'), array('nama_inven'=>'asc')),
						"recordsFiltered" => $this->fdb->count_filtered_trans('datatransaksi', array(null,'spk_inven','nama_inven','qty_transaksi', 'ket_inven','status', 'tgl_transaksi', 'tgl_input',null), array('spk_inven','nama_inven','qty_transaksi', 'ket_inven','status', 'tgl_transaksi', 'tgl_input'), array('nama_inven'=>'asc')),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}


	public function ajax_list_app()
	{
		$list = $this->fdb->get_datatables2_app('dataaplikasi', array(null,'nama_app', 'des_app','jenis_app', 'tgl_input', null), array('nama_app', 'des_app','jenis_app', 'tgl_input'), array('id_app'=>'asc'));
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $list) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $list->nama_app;
			$string = strip_tags($list->des_app);
	            if (strlen($string) > 80) {
		            $stringCut = substr($string, 0, 80);
		            $string = substr($stringCut, 0, strrpos($stringCut, ' ')).'... '; 
            	}
			$row[] = $string;
			$row[] = $list->jenis_app;
			$row[] = $list->tgl_input;
            $row[] ="<a title='Lihat' href='".base_url().'data_aplikasi/action/view/'.$list->id_app."' class='btn btn-circle btn-sm sbold bg-blue'>
                            <i class='fa fa-folder'>  Lihat Detail</i>
                        </a>";

            
            if (($this->active_privilege == "superadmin" )||($this->active_privilege == "signer" )||($this->active_privilege == "checker" )){

                $row[] = "<td style='text-align:center' width='140px'>
                        <a title='Edit' href='".base_url().'data_aplikasi/action/edit/'.$list->id_app."' class='btn btn-circle btn-sm bg-orange'>
		                    <i class='fa fa-edit'></i>
		                </a> 
		                <a title='Delete' data-href='".base_url().'data_aplikasi/action/delete/'.$list->id_app."' class='btn btn-circle btn-sm bg-red' data-toggle='modal' data-target='.delete-modal'>
                            <i class='fa fa-trash'></i>
                        </a>

                    </td>";
            }
            
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->fdb->count_all_app('dataaplikasi', array(null,'nama_app', 'des_app','jenis_app', 'tgl_input',null), array('nama_app', 'des_app','jenis_app', 'tgl_input'), array('id_app'=>'asc')),
						"recordsFiltered" => $this->fdb->count_filtered_app('dataaplikasi', array(null,'nama_app', 'des_app', 'jenis_app','tgl_input',null), array('nama_app', 'des_app','jenis_app', 'tgl_input'), array('id_app'=>'asc')),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function ajax_list_dok()
	{
		$list = $this->fdb->get_datatables2_dok('data_dok', array(null,'versi_app', 'jenis_upload', 'des_versi', 'tgl_deploy', 'programmer','tester_app', null), array('versi_app', 'jenis_upload', 'des_versi', 'tgl_deploy', 'programmer','tester_app'), array('id_doc'=>'asc'));
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $list) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $list->versi_app;
			$row[] = $list->jenis_upload;
			$row[] = $list->des_versi;
			$row[] = $list->tgl_deploy;
			$row[] = $list->programmer;
			$row[] = $list->tester;
            $row[] ="<a title='Lihat' href='".base_url().'data_projek/action/view/'.$list->id_doc."' class='btn btn-circle btn-sm sbold bg-blue'>
                            <i class='fa fa-folder'>  Lihat Detail</i>
                        </a>";
            $row[] = "<td style='text-align:center' width='140px'>
                        <a title='Edit' href='".base_url().'data_projek/action/edit2/'.$list->id_doc."' class='btn btn-circle btn-sm bg-blue'>
		                    <i class='fa fa-edit'></i>
		                </a> 
		                <a title='Delete' data-href='".base_url().'data_projek/action/delete2/'.$list->id_doc."' class='btn btn-circle btn-sm bg-red' data-toggle='modal' data-target='.delete-modal'>
                            <i class='fa fa-trash'></i>
                        </a>

                    </td>";
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->fdb->count_all_dok('data_dok', array(null,'versi_app', 'jenis_upload', 'des_versi', 'tgl_deploy', 'programmer','tester_app',null), array('versi_app', 'jenis_upload', 'des_versi', 'tgl_deploy', 'programmer','tester_app'), array('id_doc'=>'asc')),
						"recordsFiltered" => $this->fdb->count_filtered_dok('data_dok', array(null,'versi_app', 'jenis_upload', 'des_versi', 'tgl_deploy', 'programmer','tester_app',null), array('versi_app', 'jenis_upload', 'des_versi', 'tgl_deploy', 'programmer','tester_app'), array('id_doc'=>'asc')),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function ajax_list_dipakai()
	{
		$list = $this->fdb->get_datatables2_inven('datadipakai', array(null,'spk_inven','qty_inven','nama_inven', 'sumber_inven','ket_inven', 'tgl_datang', null), array('spk_inven','qty_inven','nama_inven', 'sumber_inven','ket_inven', 'tgl_datang'), array('nama_inven'=>'asc'));
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $list) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $list->spk_inven;
			$row[] = $list->nama_inven;
			$row[] = $list->qty_inven;
			$row[] = $list->sumber_inven;
			$row[] = $list->ket_inven;
			$row[] = $list->tgl_datang;
            
            $row[] ="<a title='Lihat' href='".base_url().'data_inven/action/view/'.$list->id_inven."' class='btn btn-circle btn-sm sbold bg-blue'>
                            <i class='fa fa-folder'>  Detail</i>
                        </a>"; 

            if ($this->active_privilege == "superadmin" ){
				
                 $row[] ="<a title='Use' href='".base_url().'data_inven/action/pakai/'.$list->id_inven."' class='btn btn-circle btn-sm sbold bg-blue'>
                            <i class='fa fa-check'>  Pakai</i>
                        </a>";

                $row[] = "<td style='text-align:center' width='140px'>
                        <a title='Edit' href='".base_url().'data_inven/action/edit/'.$list->id_inven."' class='btn btn-circle btn-sm bg-blue'>
		                    <i class='fa fa-edit'></i>
		                </a> 
		                <a title='Delete' data-href='".base_url().'data_inven/action/delete/'.$list->id_inven."' class='btn btn-circle btn-sm bg-red' data-toggle='modal' data-target='.delete-modal'>
                            <i class='fa fa-trash'></i>
                        </a>

                    </td>";
               

            }
            elseif( (($this->active_privilege == "signer") || ($this->active_privilege == "checker") || ($this->active_privilege== "maker") )) { 
                
                $row[] ="<a title='Lihat' href='".base_url().'data_inven/action/use/'.$list->id_inven."' class='btn btn-circle btn-sm sbold bg-blue'>
                            <i class='fa fa-folder'>  Pakai Inventori</i>
                        </a>";
           	}
			
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->fdb->count_all_inven('datadipakai', array(null,'spk_inven','qty_inven','nama_inven', 'sumber_inven','ket_inven', 'tgl_datang',null), array('spk_inven','qty_inven','nama_inven', 'sumber_inven','ket_inven', 'tgl_datang'), array('nama_inven'=>'asc')),
						"recordsFiltered" => $this->fdb->count_filtered_inven('datadipakai', array(null,'spk_inven','qty_inven','nama_inven', 'sumber_inven','ket_inven', 'tgl_datang',null), array('spk_inven','qty_inven','nama_inven', 'sumber_inven','ket_inven', 'tgl_datang'), array('nama_inven'=>'asc')),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function ajax_list_konfirm()
	{
		$list = $this->fdb->get_datatables2_konfirm('dataaplikasi', array('nama_app','nama_fitur','no_surat', 'versi_a', 'versi_b', 'versi_c', 'programmer','tgl_input', 'status'), array('nama_app','nama_fitur', 'no_surat', 'versi_a', 'versi_b', 'versi_c', 'programmer','tgl_input', 'status'), array('tgl_input'=>'desc'));
		$data = array();
		
		$no = $_POST['start'];
		foreach ($list as $list) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $list->nama_app;
			$row[] = $list->nama_fitur;
			$row[] = $list->no_surat;
			$row[] = $list->versi_a . "." . $list->versi_b . "." . $list->versi_c;
			$row[] = $list->programmer;
			$row[] = $list->tgl_input;
			
			if ($list->status == "belum dikonfirmasi" ) {
              $row[] =    "<i class='btn btn-xs bg-orange'>Belum dikonfirmasi</i>";
            } 
            

            if (($this->active_privilege == "superadmin" )||($this->active_privilege == "signer" )||($this->active_privilege == "checker" )){

                $row[] = "<td style='text-align:center' width='140px'>
                        <a title='Cek' href='".base_url().'konfirmasi/action/cek/'.$list->id_doc."' class='btn btn-circle btn-sm bg-blue'>
                            <i'> Cek</i>
                        </a>
                        <a title='Lihat' href='".base_url().'konfirmasi/action/view/'.$list->id_doc."' class='btn btn-circle btn-sm bg-green'>
                            <i'> Lihat</i>
                        </a>

                    </td>";
             }
             else{

		            $row[] = "<td style='text-align:center' width='140px'>
                        <a title='Lihat' href='".base_url().'konfirmasi/action/view/'.$list->id."' class='btn btn-circle btn-sm bg-green'>
                            <i class='fa fa-folder'></i>
                        </a>
                        </td>";
               }
           
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->fdb->count_all_konfirm('dataaplikasi', array('nama_app','nama_fitur', 'no_surat', 'versi_a', 'versi_b', 'versi_c', 'programmer','tgl_input', 'status'), array('nama_app','nama_fitur', 'no_surat', 'versi_a', 'versi_b', 'versi_c', 'programmer','tgl_input', 'status'), array('tgl_input'=>'desc')),
						"recordsFiltered" => $this->fdb->count_filtered_konfirm('dataaplikasi', array('nama_app','nama_fitur', 'no_surat', 'versi_a', 'versi_b', 'versi_c', 'programmer','tgl_input', 'status'), array('nama_app','nama_fitur','no_surat', 'versi_a', 'versi_b', 'versi_c', 'programmer','tgl_input', 'status'), array('tgl_input'=>'desc')),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}


	/*public function ajax_list_proj()
	{
		$list = $this->fdb->get_datatables2_proj('projek', array(null,'pjk_nmr', 'nama_projek', 'projek_nama', 'projek_enddate','status','nilai_kontrak',null), array('pjk_nmr', 'nama_projek', 'projek_nama', 'projek_enddate','status','nilai_kontrak'), array('projek_id'=>'asc'));
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $list) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $list->pjk_nmr;
			$row[] = $list->nama_projek;
			$row[] = $list->projek_nama;
			$row[] ="<a class='green'>Mulai:</br>".$list->projek_begindate."</a>
                                </br><a class='red'>Berakhir:</br>".$list->projek_enddate."</a>";

            if($list->status == 'kadaluarsa'){
            $row[] = "<i class='btn btn-circle btn-xs bg-red'>kadaluarsa</i>";
            } else{

            $row[] = "<i class='btn btn-circle btn-xs bg-green'>".$list->status."</i>";
             };
             $row[] = format_rupiah2($list->nilai_kontrak);
            $row[] =" <a title='Dokumen' href='".$list->projek_dokumen."' class='btn btn-circle btn-sm sbold bg-blue' target='_blank'>
                                    <i class='fa fa-file'> Lihat Dokumen</i>
                                </a>";
            if ($this->active_privilege == "superadmin" ){
				
                $row[] = "<td style='text-align:center' width='140px'>
                        <a title='Lihat' href='".base_url().'data_projek/action/view/'.$list->projek_id."' class='btn btn-circle btn-sm bg-green'>
                            <i class='fa fa-folder'></i>
                        </a>
                        <a title='Edit' href='".base_url().'data_projek/action/edit/'.$list->projek_id."' class='btn btn-circle btn-sm bg-blue'>
		                    <i class='fa fa-edit'></i>
		                </a> 
		                <a title='Delete' data-href='".base_url().'data_projek/action/delete/'.$list->projek_id."' class='btn btn-circle btn-sm bg-red' data-toggle='modal' data-target='.delete-modal'>
                            <i class='fa fa-trash'></i>
                        </a>

                    </td>";
               

             }elseif( (($this->active_privilege == "signer") || ($this->active_privilege == "checker") || ($this->active_privilege== "maker") )) { 
                if($this->active_user == $list->user_nama){
		            

		                $row[] = "<td style='text-align:center' width='140px'>
			                        <a title='Lihat' href='".base_url().'data_projek/action/view/'.$list->projek_id."' class='btn btn-circle btn-sm bg-green'>
			                            <i class='fa fa-folder'></i>
			                        </a>
			                       

			                    </td>";
		                

                    } else{

		            $row[] = "<td style='text-align:center' width='140px'>
		                        <a title='Lihat' href='".base_url().'data_projek/action/view/'.$list->projek_id."' class='btn btn-circle btn-sm bg-green'>
		                            <i class='fa fa-folder'></i>
		                        </a>

		                    </td>";
               }
           }
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->fdb->count_all_proj('projek', array(null,'pjk_nmr', 'nama_projek', 'projek_nama', 'projek_enddate','status','nilai_kontrak',null), array('pjk_nmr', 'nama_projek', 'projek_nama', 'projek_enddate','status','nilai_kontrak'), array('projek_id'=>'asc')),
						"recordsFiltered" => $this->fdb->count_filtered_proj('projek', array(null,'pjk_nmr', 'nama_projek', 'projek_nama', 'projek_enddate','status','nilai_kontrak',null), array('pjk_nmr', 'nama_projek', 'projek_nama', 'projek_enddate','status','nilai_kontrak'), array('projek_id'=>'asc')),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}*/

}
