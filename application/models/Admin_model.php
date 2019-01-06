<?php

class Admin_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
	
	function loginAdmin($email, $password, &$out_array)
	{
		$result = $this->db->get_where('tbl_admin', array('ikey' => 'email', 'ivalue' => $email))->result_array();
		if (count($result) == 0) {
			$out_array['reason'] = 'Email is incorrect!';
			return 400;
		}
		$result = $this->db->get_where('tbl_admin', array('ikey' => 'password', 'ivalue' => $password))->result_array();
		if (count($result) == 0) {
			$out_array['reason'] = 'Password is incorrect!';
			return 400;
		}
		$username = $this->db->get_where('tbl_admin', array('ikey' => 'username'))->result_array();
		$photo = $this->db->get_where('tbl_admin', array('ikey' => 'photo'))->result_array();

		$out_array['email'] = $email; 
		$out_array['password'] = $password;
		$out_array['username'] = $username[0]['ivalue']; 
		$out_array['photo'] = $photo[0]['ivalue'];
		return 200;
	}
	
	function update_admin($username, $password, $email)
	{
		$this->db->where('ikey', 'username');
		$this->db->update('tbl_admin', array('ivalue' => $username));
		$this->db->where('ikey', 'password');
		$this->db->update('tbl_admin', array('ivalue' => $password));
		$this->db->where('ikey', 'email');
		$this->db->update('tbl_admin', array('ivalue' => $email));
	}
	
	function get_date()
	{
		$query = $this->db->get_where('tbl_admin', array('ikey' => 'date'));
		$result = $query->result_array();
		return $result[0]['ivalue'];
		
	}
	function set_date($value)
	{
		$query = $this->db->get_where('tbl_admin', array('ikey' => 'date'));
		$result = $query->result_array();
		if (count($result) == 0) {
			$this->db->insert('tbl_admin', array('ikey' => 'date', 'ivalue' => $value));			
		}else {
			$this->db->where('ikey', 'date');
			$this->db->update('tbl_admin', array('ivalue' => $value));
		}
		return 200;
	}	
}