<?php
class Account_Model extends CI_Model {
	public function getSimilar($search) {
		$this->db->select('username, firstname, lastname, email, nic, phone, address, created_at');
		$this->db->like('username', $search);
		$this->db->or_like('firstname', $search);
		$this->db->or_like('lastname', $search);
		$this->db->or_like('email', $search);
		$this->db->or_like('nic', $search);
		$this->db->or_like('phone', $search);
		$this->db->or_like('address', $search);
		$this->db->or_like('created_at', $search);
		$query = $this->db->get('users');
		return $query->result_array();
	}

	public function insertNewAccount($data) {
		return $this->db->insert('users', $data);
	}

	public function getAccountWhere($where = '', $select = '') {
		if($where !== '') {
			$this->db->where($where);
		}
		if ($select !== '')
		{
			$this->db->select($select);
		}
		$query = $this->db->get('users');
		return $query->result_array();
	}

	public function getAuthCode($where) {
		$this->db->select('auth');
		$this->db->where($where);
		$query = $this->db->get('users');
		return $query->row_array();
	}

	public function updateAccount($data, $where) {
		return $this->db->update('users', $data, $where);
	}
}
