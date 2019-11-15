<?php

class SaleProduct extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		test_login(1);
	}

	public function validateUpdateSale() {	// ajax
		$this->form_validation->set_rules('saleId', 'Sale Id', 'trim|required');
		$this->form_validation->set_rules('productId', 'Product Id', 'trim|required');
		if($this->form_validation->run() == TRUE) {
			$where = array(
				'id' => $this->input->post('saleId'),
			);
			$row = $this->Sell_Model->getResultOfSale($where);
			if($row) {
				$response = array(
					'status' => 1,
					'saleResult' => $row,
				);
				$where['id'] = $this->input->post('productId');
				$row2 = $this->Product_Model->getResultOfProducts($where);
				if($row2) {
					$response['productResult'] = $row2;
				} else {
					$response = array(
						'status' => 0,
						'message' => $this->db->error(),
					);
				}
			} else {
				$response = array(
					'status' => 0,
					'message' => $this->db->error(),
				);
			}
		} else {
			$response = array(
				'status' => 0,
				'message' => validation_errors(),
			);
		}
		echo json_encode($response);
	}

	public function deleteSale() {
		$this->form_validation->set_rules('deleteSaleProductId', 'Return Product Id', 'trim|required');
		$this->form_validation->set_rules('deleteSaleId', 'Return Product Id', 'trim|required');
		if($this->form_validation->run() == TRUE) {
			$where = array(
				'id' => $this->input->post('deleteSaleId'),
			);
			$row = $this->Sell_Model->getResultOfSale($where);
			if($row) {
				$quantity = $row[0]['quantity'];
				$where['id'] = $this->input->post('deleteSaleProductId');
				if($this->Product_Model->updateReturnProductQuantity($quantity, $where)) {
					$where['id'] = $this->input->post('deleteSaleId');
					if($this->Sell_Model->deleteSell($where)) {
						$this->session->set_flashdata('success', $this->lang->line('sale')." ".$this->lang->line('is')." ".$this->lang->line('deleted')." ".$this->lang->line('successfully'));
					} else {
						$error = $this->db->error();
						$this->session->set_flashdata('error', 'Database Error<br>Error Code: '.$error["code"].'<br>Error Message: '.$error["message"]);
					}
				} else {
					$error = $this->db->error();
					$this->session->set_flashdata('error', 'Database Error<br>Error Code: '.$error["code"].'<br>Error Message: '.$error["message"]);
				}
			} else {
				$error = $this->db->error();
				$this->session->set_flashdata('error', 'Database Error<br>Error Code: '.$error["code"].'<br>Error Message: '.$error["message"]);
			}
		} else {
			$this->session->set_flashdata('error', validation_errors());
		}
		redirect(base_url('admin/sales'));
	}

	public function returnProduct() {
		$this->form_validation->set_rules('returnPId', 'Return Product Id', 'trim|required');
		$this->form_validation->set_rules('returnSalePId', 'Return Product Id', 'trim|required');
		$this->form_validation->set_rules('returnSalePQuantity', 'Return Product Quantity', 'trim|min_length[1]|numeric|required|callback_validateReturnMaxQuantity');

		if($this->form_validation->run() == TRUE) {
			$quantity = $this->input->post('returnSalePQuantity');
			$where = array(
				'id' => $this->input->post('returnSalePId'),
			);
			if($this->Sell_Model->updateReturnSellQuantity($quantity, $where)) {
				$where = array(
					'id' => $this->input->post('returnPId'),
				);
				if($this->Product_Model->updateReturnProductQuantity($quantity, $where)) {
					$this->session->set_flashdata('success', $this->lang->line('product')." ".$this->lang->line('is')." ".$this->lang->line('returned')." ".$this->lang->line('successfully'));
				} else {
					$error = $this->db->error();
					$this->session->set_flashdata('error', 'Database Error<br>Error Code: '.$error["code"].'<br>Error Message: '.$error["message"]);
				}
			} else {
				$error = $this->db->error();
				$this->session->set_flashdata('error', 'Database Error<br>Error Code: '.$error["code"].'<br>Error Message: '.$error["message"]);
			}
		} else {
			$this->session->set_flashdata('error', validation_errors());
		}
		redirect(base_url('admin/sales'));
	}

	function validateReturnMaxQuantity($quantity)
	{
		$where = array(
			'id' => $this->input->post('returnSalePId'),
		);
		$row = $this->Sell_Model->getResultOfSale($where);
		if ($quantity <= $row[0]['quantity']) {
			return TRUE;
		} else {
			$this->form_validation->set_message('validateReturnMaxQuantity', 'The {field} field is not greater than '.$row[0]['quantity']);
			return FALSE;
		}
	}

	public function salesTable() {
		$row = $this->Sell_Model->getSalesWithPName();
		$data['row'] = $row;

		$this->template->set('title', 'Sales Table');
		$this->template->load('default_layout', 'contents' , 'admin/salesdetails', $data);
	}

	public function checkUpdateQuantity() {	//ajax JSON
		if($this->input->post("checkUpdateQuantity")) {
			$pId = $this->input->post("productId");
			$pQuantity = $this->input->post("checkUpdateQuantity");
			$where = array(
				'id' => $pId,
			);
			$productRow = $this->Product_Model->getResultOfProducts($where);
			$totalQuantity = $productRow[0]['quantity'];
			$sold = $productRow[0]['quantity'] - $productRow[0]['remaining'];
			if($pQuantity < $totalQuantity) {
				if($pQuantity < $sold) {
					$response = array(
						'status' => 0,
						'statusMessage' => $this->lang->line('update_quantity_error_message'),
					);
				} else {
					$response = array(
						'status' => 1,
					);
				}
			} else {
				$response = array(
					'status' => 1,
				);
			}
			echo json_encode($response);
		}
	}

	public function saleProduct() {
		$this->form_validation->set_rules('salePId', 'Product Id', 'trim|required');
		if($this->input->post('saleId') != '') {
			$where = array(
				'id' => $this->input->post('saleId'),
			);
			$row = $this->Sell_Model->getResultOfSale($where);
			if($row) {
				$where['id'] = $this->input->post('salePId');
				if(!$this->Product_Model->updateReturnProductQuantity($row[0]['quantity'], $where)) {
					$error = $this->db->error();
					$this->session->set_flashdata('error', 'Database Error<br>Error Code: '.$error["code"].'<br>Error Message: '.$error["message"]);
				}
			} else {
				$error = $this->db->error();
				$this->session->set_flashdata('error', 'Database Error<br>Error Code: '.$error["code"].'<br>Error Message: '.$error["message"]);
			}
		}
		$this->form_validation->set_rules('salePQuantity', 'Product Quantity', 'trim|min_length[1]|numeric|required|callback_validateMaxQuantity');
		$this->form_validation->set_rules('salePDiscount', 'Product Discount', 'trim|numeric|greater_than[-1]|less_than[101]');
		if($this->form_validation->run() == TRUE) {
			$data = array(
				'quantity' => $this->input->post('salePQuantity'),
				'discount' => $this->input->post('salePDiscount'),
				'comments' => $this->input->post('salePComment'),
			);
			if($this->input->post('saleId') != '') {
				$where = array(
					'id' => $this->input->post('saleId'),
				);
				if($this->Sell_Model->updateSell($data, $where)) {
					$where['id'] = $this->input->post('salePId');
					$row = $this->Product_Model->getResultOfProducts($where);
					$remaining = $row[0]['remaining'] - $this->input->post('salePQuantity');
					$data = array(
						'remaining' => $remaining,
					);
					if($this->Product_Model->updateProduct($data, $where)) {
						$this->session->set_flashdata('success', $this->lang->line('sale')." ".$this->lang->line('is')." ".$this->lang->line('updated')." ".$this->lang->line('successfully'));
					} else {
						$error = $this->db->error();
						$this->session->set_flashdata('error', 'Database Error<br>Error Code: '.$error["code"].'<br>Error Message: '.$error["message"]);
					}
				} else {
					$error = $this->db->error();
					$this->session->set_flashdata('error', 'Database Error<br>Error Code: '.$error["code"].'<br>Error Message: '.$error["message"]);
				}
			} else {
				$data['accountid'] = $_SESSION['user']['id'];
				$data['productid'] = $this->input->post('salePId');
				$data['addeddate'] = date('Y-m-d G:i:s');
				if($this->Sell_Model->insertSellProduct($data)) {
					$where = array(
						'id' => $this->input->post('salePId'),
					);
					$row = $this->Product_Model->getResultOfProducts($where);
					$remaining = $row[0]['remaining'] - $this->input->post('salePQuantity');
					$data = array(
						'remaining' => $remaining,
					);
					if($this->Product_Model->updateProduct($data, $where)) {
						$this->session->set_flashdata('success', $this->lang->line('product')." ".$this->lang->line('is')." ".$this->lang->line('sold')." ".$this->lang->line('successfully'));
					} else {
						$error = $this->db->error();
						$this->session->set_flashdata('error', 'Database Error<br>Error Code: '.$error["code"].'<br>Error Message: '.$error["message"]);
					}
				} else {
					$error = $this->db->error();
					$this->session->set_flashdata('error', 'Database Error<br>Error Code: '.$error["code"].'<br>Error Message: '.$error["message"]);
				}
			}
		} else {
			$this->session->set_flashdata('error', validation_errors());
		}
		if(null != $this->input->post('salePBillId')) {
			redirect(base_url('admin/bill_detail/'.$this->input->post('salePBillId')));
		} elseif($this->input->post('saleId') != '') {
			redirect(base_url('admin/sales'));
		} else {
			redirect(base_url('admin/all_products'));
		}
	}

	function validateMaxQuantity($quantity)
	{
		$where = array(
			'id' => $this->input->post('salePId'),
		);
		$row = $this->Product_Model->getResultOfProducts($where);
		if ($quantity <= $row[0]['remaining']) {
			return TRUE;
		} else {
			$this->form_validation->set_message('validateMaxQuantity', 'The {field} field is not greater than '.$row[0]['remaining']);
			return FALSE;
		}
	}

}
