<?php
class Product_Model extends CI_Model {
	public function getSimilar($search, $where = '', $limit = '', $offset = '') {
		$this->db->select('id, productname, quantity, remaining, price, unit, comments, description, addeddate, lastupdated');
		if($where !== '') {
			$this->db->where($where);
		}
		if($limit !== '' && $offset !== '') {
			$this->db->limit($limit, $offset);
		}
		$this->db->like('productname', $search);
		$this->db->or_like('quantity', $search);
		$this->db->or_like('remaining', $search);
		$this->db->or_like('price', $search);
		$this->db->or_like('unit', $search);
		$this->db->or_like('comments', $search);
		$this->db->or_like('addeddate', $search);
		$this->db->or_like('lastupdated', $search);
		$query = $this->db->get('products');
		return $query->result_array();
	}

	public function updateReturnProductQuantity($quantity, $where) {
		$this->db->set('remaining', 'remaining + ' . (int) $quantity, FALSE);
		$this->db->where($where);
		return $this->db->update('products');
	}

	public function insertNewProduct($data) {
		return $this->db->insert_batch('products', $data);
    }

    public function getUpdatedDate($where) {
		$this->db->select('lastupdated');
		$this->db->where($where);
		$query = $this->db->get('products');
		$row = $query->row_array();
		return $row;
	}

	public function updateProduct($data, $where) {
		$this->db->where($where);
		return $this->db->update('products', $data);
	}
    
    public function countProducts($where) {
        $query = $this->db->get_where('products', $where);
        return $query->num_rows();
    }

	public function getResultOfProducts($where = '', $limit = '', $offset = '') {
		if($where !== '') {
			$this->db->where($where);
		}
		if($limit !== '' && $offset !== '') {
			$this->db->limit($limit, $offset);
		}
		$query = $this->db->get('products');
		if($query !== FALSE && $query->num_rows() > 0) {
			return $query->result_array();
		} else {
			return false;
		}
	}

	public function deleteProduct($where = '') {
		return $this->db->delete('products', $where);
	}

    public function sumProducts($where) {
        $this->db->where($where);
        $this->db->select('SUM(price*quantity)');
        $query = $this->db->get('products');
        return $query->result_array();
    }

    public function getRemainingProducts($where) {
		$this->db->select('remaining');
		$this->db->where($where);
		$query = $this->db->get('products');
		$row = $query->row_array();
		return $row;
	}
}
