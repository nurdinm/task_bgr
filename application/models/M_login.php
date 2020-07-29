<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_login extends CI_Model
{

	private $_table = 'tb_login';
	public $id = 'id';

	public function __construct()
	{
		parent::__construct();
	}

	public function login($email)
	{
		$cond = array('email' => $email);
		$this->db->where($cond);

		$user = $this->db->get($this->_table);
		$query = $user->row();

		return $query;
	}

	public function setLocked($id, $data)
	{
		$this->db->where($this->id, $id);
		$this->db->update($this->_table, $data);
	}

	public function checkData($email)
	{
		$cond = array('email' => $email);
		$this->db->where($cond);
		$user = $this->db->get($this->_table);
		$query = $user->row();

		return $query;
	}



	public function resetPassword($email, $data)
	{
		$cond = array('email' => $email);
		$this->db->where($cond);
		$user = $this->db->update($this->_table, $data);
		return $user;
	}
}
