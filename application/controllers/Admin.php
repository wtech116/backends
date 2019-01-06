<?php
include 'session.inc';
class Admin extends CI_Controller
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
    }
	
	function go_account($error = '')
	{
		$this->load->model('admin_model');
		$result = $this->admin_model->get_admin($_SESSION['username'], $array);
		if ($result != 200) {
			$data = array('error' => 'Invalid user', 'username' => $username, 'password' => $password);
        	$this->load->view('login', $data);
		} else {
			$this->load->model('user_model');
			$result = $this->user_model->getAllCountries($country_array);
			$data = array('error' => '', 'data' => $array, 'active' => '', 'table' => 'tbl_subadmin', 'type' => 'edit', 'country_array' => $country_array);
			$this->load->view('header', $data);
			$this->load->view('user_profile', $data);
		}   
	}
	
	function go_edit($error = '')
	{
		$this->load->view('header', array('active' => ''));
        $this->load->view('user_profile', array('error' => $error));   
	}

	function update_admin()
	{
		if(strpos($_REQUEST['photo'], '001') !== false) {
			$photo = FCPATH.'uploadImages/admin/'.$_REQUEST['photo'];
			if (!copy($photo, FCPATH.'uploadImages/admin/000.png')) {
			    $error = 'Photo update failed!';
				$this->go_edit($error);		
				return;
			}
		}
		$error = 'Admin has been changed successfully!';
		$username = $_REQUEST['username'];
		$password = $_REQUEST['password'];
		$email = $_REQUEST['email'];
		$this->load->model('admin_model');
		$this->admin_model->update_admin($username, $password, $email);
		$_SESSION['biper']['username'] = $username;
		$_SESSION['biper']['email'] = $email;
		$_SESSION['biper']['password'] = $password;
		$this->go_edit($error);		
	}
	function update_date()
	{
		$this->load->model('admin_model');
    	if (isset($_REQUEST['new'])) {
	    	$result = 400;
			$new_limit = strtotime($_REQUEST['new']);
			if($new_limit == true)
				$result = $this->admin_model->set_date($new_limit);
			if ($result == 200) {
				echo 'Information has been updated as '.$_REQUEST['new'];
			} else {
				echo 'Unfortunately information has not been updated. Please confirm your date format!';
			}
    	} else {			
			$result = date("m/d/Y", (int)$this->admin_model->get_date());
			echo "Month/Day/Year. <br />";
			echo $result;
		}		
	}
	
    function image_upload()
    {	    	//FCPATH
		$config['upload_path']          =  FCPATH.'uploadImages/admin/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 5000;
        $config['max_width']            = 4000;
        $config['max_height']           = 3000;
		$config['file_name'] 			= '001';
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
            $url = base_url()."uploadImages/admin/";
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