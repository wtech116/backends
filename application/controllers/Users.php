<?php
include 'session.inc';

class Users extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
		$this->load->helper(array('form', 'url'));
    	$this->load->helper('url');
		$this->load->database();
    }
    
    function index()
    {
    	$this->go_dashboard();
    }

    function go_dashboard()
    {
		$this->load->view('header', array('active' => 'dashboard'));
		$this->load->model('user_model');
		$result = $this->user_model->get_statistics($array);
		$result = $this->user_model->get_chartData('tbl_video', $chart_video);
		$result = $this->user_model->get_chartData('tbl_purchase', $chart_purchase);

		$data = array('error' => '', 'data' => $array, 'chart_video' => $chart_video, 'chart_purchase' => $chart_purchase);
		$this->load->view('dashboard', $data);
    }
	// function change_status($id, $status, $day)
	// {
	// 	$this->load->model('user_model');
	// 	$result = $this->user_model->change_status('tbl_user', $id, $status);
	// 	if ($result != 200) {
	// 		$error = 'Invalid User';
	// 	} else {
	// 		$error = "Successfully changed.";
	// 	}
	// 	$this->go_users($day, $error);
	// }
	function delete_user($id, $day)
	{
		$this->load->model('user_model');
		$result = $this->user_model->delete_item('tbl_user', $id);
		if ($result != 200) {
			$error = 'Invalid User';
		} else {
			$error = "Successfully deleted.";
		}
		$this->go_users($day, $error);
	}






	function edit_profile($page_type, $id, $user_type, $error = '')
	{
		$active = $user_type;
		if ($_SESSION['id'] == $id) {
			$active = '';
		}
		$this->load->model('message_model');
		$result = $this->message_model->getUnreadMessages($_SESSION['id'], $array);
		$data = array('msg_badge' => $array['count'], 'active' => $active);
		$this->load->view('header', $data);
		$array = array('id' => '', 'country_code' => '', 'username' => '', 'email' => '', 'number' => '', 'password' => '', 'photo' => '');
		if ($id != '0') {
			$this->load->model('user_model');
			$result = $this->user_model->get_userById($id, $array);
		}
		$this->load->model('user_model');
		$result = $this->user_model->getAllCountries($country_array);
		$data = array('data' => $array, 'error' => $error, 'user_type' => $user_type, 'page_type' => $page_type, 'country_array' => $country_array);
		$this->load->view('user_profile', $data);
	}
	
	function update_profile()
	{
		$user_type = $_REQUEST['user_type'];
		$page_type = $_REQUEST['page_type'];
		$id = $_REQUEST['id'];
		$username = trim($_REQUEST['username']);
		$number = trim($_REQUEST['number']);
		$password = trim($_REQUEST['password']);
		$email = trim($_REQUEST['email']);
		$photo = trim($_REQUEST['photo']);
		$code = trim($_REQUEST['code']);

		if ($username == '' || $email == '' || $password == '' || $code == '') {
			$error = 'Please fill in empty fields.';			
		} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		    $error = 'Invalid email format';
		} else {
			$error = '';
			$this->load->model('user_model');
			$result = $this->user_model->update_profile($id, $username, $email, $password, $code, $number,$photo, $user_type, $page_type, $error);
		}

		$this->edit_profile($page_type, $id, $user_type, $error);
	}

	function image_upload()
    {	    	//FCPATH
		$config['upload_path']          =  FCPATH.'uploadImages/user/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 5000;
        $config['max_width']            = 4000;
        $config['max_height']           = 3000;
		$config['file_name'] 			= time();
		$config['overwrite']			= TRUE;
		
        $this->load->library('upload', $config);
        if ( ! $this->upload->do_upload('file'))
        {
            $error = array('error' => $this->upload->display_errors());
			// var_dump($config['upload_path']);
			echo 400;
        }
        else
        {
			$img_info = $this->upload->data();
            $image_info = array('full_path' => $img_info['full_path']);
            $url = base_url()."uploadImages/user/";
            $info = pathinfo($img_info['full_path']);
            $filename = $info['filename'];
            $extension = $info['extension'];
            $real_url = $url.$filename.'.'.$extension;
            $image_info = array('full_path' => $real_url);
			echo $filename.'.'.$extension;
        }    
	} 
}
?>