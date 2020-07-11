<?php
class Bill_Model extends CI_Model {
	public function getSimilar($search) {
		$this->db->select('billnumber, comments, addeddate, lastupdated');
		$this->db->like('billnumber', $search);
		$this->db->or_like('comments', $search);
		$this->db->or_like('addeddate', $search);
		$this->db->or_like('lastupdated', $search);
		$query = $this->db->get('bills');
		return $query->result();
	}

	public function insertNewBill($data) {
		return $this->db->insert('bills', $data);
	}

	public function getResultOfBills($where = '') {
		if($where !== '') {
			$this->db->where($where);
		}
		return $query = $this->db->get('bills')->result_array();
	}

	public function updateBill($data, $where) {
		$this->db->where($where);
		return $this->db->update('bills', $data);
	}

	public function deleteBill($where = '') {
		return $this->db->delete('bills', $where);
	}
}
