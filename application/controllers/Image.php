<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Image extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('ssp');
        $this->load->model('Model_Image');
        check_session();
    }

    public function index() {
        //$this->load->view('template');
        $this->template->load('template', 'Image/list');
    }
	
	function show($id){
		$detail=$this->Model_Image->get_by_id($id);
		header("Content-type: image/png");
		//display the image data
		echo $detail->Data;
	}

    function data() {
        //nama table
        $table = 'view_image';
        // nama pk
        $primaryKey = 'SeqNum';
        //list table
        $columns = array(
            array('db' => 'DeviceId', 'dt' => 'DeviceId'),
            array('db' => 'Tenant', 'dt' => 'Tenant'),
            array(
                'db' => 'SeqNum',
                'dt' => 'Image',
                'formatter' => function($d) {
                    return '<img src="'.base_url('index.php/Image/show/'.$d).'" style="width:500px;"/>';
                }
            ),
			 array('db' => 'teks', 'dt' => 'teks'),
			 array(
				'db'=>'RefSN',
				'dt'=>'aksi',
				'formatter'=>function ($d){
					return '<a class="btn btn-xs btn-primary tooltips" id="'.$d.'" href="javascript:void(0)" title="Edit" onclick="edit_note(this)"><i class="glyphicon glyphicon-pencil"></i></a>';		
				}

			)
			
		);

        $sql_details = array(
            'user'=> $this->db->username,
            'pass'=> $this->db->password,
            'db'=> $this->db->database,
            'host'=> $this->db->hostname
        );
		$where=' where DeviceId='.$this->db->escape($_GET['wp']).' and year(InsertTimeStamp)='.(int)$_GET['thn'].' and month(InsertTimeStamp)='.(int)$_GET['bln'];
		$results=SSP::simpleCustom($_GET, $sql_details, $table, $primaryKey, $columns,$where);
		$new_result=$results;
		$new_result['data']=[];
		foreach($results['data'] as $result){
			$result['teks']=base64_encode($result['teks']);
			$new_result['data'][]=$result;
		}
		echo json_encode(
           $new_result
        );
		
    }
	
	public function ajax_update()
    {
      
     	$data = array(
				'Data'	=> $this->input->post('data',TRUE),
		);
   
        $this->Model_Image->updateTeks(array('RefSN' => $this->input->post('id')), $data);
        echo json_encode(array("status" => TRUE));
    }


}