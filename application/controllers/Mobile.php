<?php

    class Mobile extends CI_Controller
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
        	$status = 400;
        	$in_array = array();
			$out_array = array('reason' => '');
			
			$type = $_REQUEST['type'];
			switch ($type) {
				case 'get_videos':
					$this->load->model('user_model');
					$out_array = $this->user_model->get_statisticsByDay('tbl_video', 'all');
					$status = 200;
					break;
				case 'get_my_videos':
					$this->load->model('service_model');
					$status = $this->service_model->get_myVideosByDeviceId($_REQUEST['device_id'], $out_array);
					break;
				case 'purchase_report':
					$this->load->model('service_model');
					$status = $this->service_model->purchase_report($_REQUEST['video_id'], $_REQUEST['device_id'],$_REQUEST['price']);
					break;



				default:
					break;
			}
			echo json_encode(array('status' => $status, 'data' => $out_array));
        }

        function trim_array(&$array) 
        {
        	if (count($array) == 1 && $array[0] == '') {
        		$array = array();
        	}
        }
		function send_email($email, $user_id)
		{
			$site_email = SERVER_EMAIL;	//who does this mail get sent from (must be in the same domain as this site)
			$recipient = $email; 	//who does this mail get sent to?
			$body = "Please click the following url to reset your password. \n".base_url().'index.php/verify/forgot_password/'.$user_id;
			$subject = "Reset password";
			$headers = "From: ". $site_email . "\r\n";
			
			if (!mail ($recipient, $subject, $body, $headers))
				echo "Couldn't send mail";
		
		}

		function push_android($type, $token, $message, $badge, $data = '')
		{
			$this->load->library('ci_pusher');
			$pusher = $this->ci_pusher->get_pusher();
			$result = $pusher->notify(
			  array($token),
			  array(
			    'gcm' => array(
			      'notification' => array(
			        'title' => 'OYOO',
			        'body' => $message,
			        'icon' => 'androidlogo',
			        'sound' => 'default',
			      ),
			      'data' => array(
			      	'data' => array('info' => $data,
			      		'badge' => intval($badge),
				      	'title' => $message,
			      		'type' => $type),
			      ),
			    ),
			    'webhook_url' => 'http://requestb.in/y0xssw70',
			    'webhook_level' => 'INFO',
			  )
			);
		}

   }
?>