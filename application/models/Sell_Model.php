<?php
class Sell_Model extends CI_Model {
	public function insertSalesAsBatch($data) {
		return $this->db->insert_batch('sale', $data);
	}

	public function getSimilar($search) {
		$this->db->select('productid, quantity, discount, comments, created_at, updated_at');
		$this->db->like('quantity', $search);
		$this->db->or_like('discount', $search);
		$this->db->or_like('comments', $search);
		$this->db->or_like('created_at', $search);
		$this->db->or_like('updated_at', $search);
		$query = $this->db->get('sale');
		return $query->result_array();
	}

	public function updateSell($data, $where) {
		$this->db->where($where);
		return $this->db->update('sale', $data);
	}

	public function deleteSell($where) {
		return $this->db->delete('sale', $where);
	}

	public function updateReturnSellQuantity($quantity, $where) {
		$this->db->set('quantity', 'quantity - ' . (int) $quantity, FALSE);
		$this->db->where($where);
		return $this->db->update('sale');
	}

	public function getResultOfSale($where = '') {
		if($where !== '') {
			$this->db->where($where);
		}
		$query = $this->db->get('sale');
		return $query->result_array();
	}

	public function insertSellProduct($data) {
		return $this->db->insert('sale', $data);
	}

	public function getSalesWithPPrice($where = '') {
		$this->db->select('sale.*, SUM((products.`price`*sale.`quantity`) * (100-sale.`discount`) / 100) as price, COUNT(sale.id) as numberOfSales');
		$this->db->from('sale');
		$this->db->join('products', 'products.id = sale.productid');
		$this->db->where($where);
		$this->db->group_by('DAY(sale.created_at)');
		$this->db->order_by('created_at', 'ASC');
		$query = $this->db->get();
		if($query !== FALSE && $query->num_rows() > 0) {
			return $query->result_array();
		} else {
			return false;
		}
	}

	public function getSalesWithPName() {
		$this->db->select('sale.*, products.`productname`');
		$this->db->from('sale');
		$this->db->join('products', 'products.id = sale.productid');
		$query = $this->db->get();
		return $query->result_array();
	}
}
