<?php
class Account_Model extends CI_Model {
	public function getSimilar($search) {
		$this->db->select('username, firstname, lastname, email, nic, phone, address, regtime');
		$this->db->like('username', $search);
		$this->db->or_like('firstname', $search);
		$this->db->or_like('lastname', $search);
		$this->db->or_like('email', $search);
		$this->db->or_like('nic', $search);
		$this->db->or_like('phone', $search);
		$this->db->or_like('address', $search);
		$this->db->or_like('regtime', $search);
		$query = $this->db->get('accounts');
		return $query->result();
	}

	public function insertNewAccount($data) {
		return $this->db->insert('accounts', $data);
	}

	public function getAccountWhere($where) {
		$this->db->where($where);
		$query = $this->db->get('accounts', $where);
		return $query->row_array();
	}

	public function getAuthCode($where) {
		$this->db->select('auth');
		$this->db->where($where);
		$query = $this->db->get('accounts');
		return $query->row_array();
	}

	public function updateAccount($data, $where) {
		return $this->db->update('accounts', $data, $where);
	}
}
