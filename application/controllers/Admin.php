<?php
//eeeeeeeeeeeeeeee
// done 
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		test_login(1);
		$config['upload_path'] = 'assets/profileimages';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['encrypt_name'] = TRUE;
		$this->load->library('upload', $config);
		$this->load->library('image_lib');
	}

	/**
	 * Index Pages for this controller.
	 *
	 * Maps to the following URL
	 *        http://example.com/index.php/welcome
	 *    - or -
	 *        http://example.com/index.php/welcome/index
	 *    - or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 * @param $billId
	 */

	public function search() {
		$data = array();
		if($this->input->post('searchItem')!='') {
			$accounts = $this->Account_Model->getSimilar($this->input->post('searchItem'));
			$bills = $this->Bill_Model->getSimilar($this->input->post('searchItem'));
			$products = $this->Product_Model->getSimilar($this->input->post('searchItem'));
			$sales = $this->Sell_Model->getSimilar($this->input->post('searchItem'));
		} else {
			$accounts = array();
			$bills = array();
			$products = array();
			$sales = array();
		}
		$data['accounts'] = $accounts;
		$data['bills'] = $bills;
		$data['products'] = $products;
		$data['sales'] = $sales;
		$this->template->set('title', 'Search');
		$this->template->load('default_layout', 'contents' , 'admin/search', $data);
	}

	public function getAllProduct() {	//ajax JSON
		$billId = $this->input->post("billId");
		$where = array(
			'id' => $billId,
		);
		$billRow = $this->Bill_Model->getResultOfBills($where);
		$where = array(
			'billid' => $billId,
		);
		$productRow = $this->Product_Model->getResultOfProducts($where);
		$response = array(
			'status' => 1,
			'billRow' => $billRow,
			'productRow' => $productRow,
		);
		echo json_encode($response);
	}

	public function editProduct() {
		$billId = $this->input->post("billId");		// for update date of bill
		$productId = $this->input->post("productId");
		$this->form_validation->set_rules('productName', 'Product Name', 'trim|max_length[50]|min_length[1]|required');
		$this->form_validation->set_rules('productQuantity', 'Product Quantity', 'trim|max_length[50]|min_length[1]|required|numeric');
		$this->form_validation->set_rules('productPrice', 'Product Price', 'trim|max_length[50]|min_length[1]|required|numeric');
		$this->form_validation->set_rules('productUnit', 'Product Unit', 'trim|required');

		if($this->form_validation->run() == TRUE) {
			$where = array(
				'id' => $productId,
			);
			$productRow = $this->Product_Model->getResultOfProducts($where);
			$totalQuantity = $productRow[0]['quantity'];
			$sold = $productRow[0]['quantity'] - $productRow[0]['remaining'];
			if($this->input->post('productQuantity') > $totalQuantity) {
				if($sold == 0) {
					$remaining = $this->input->post('productQuantity');
				} else {
					$remaining = $this->input->post('productQuantity') - $sold;
				}
			} elseif($this->input->post('productQuantity') < $totalQuantity) {
				if($this->input->post('productQuantity') >= $sold) {
					$remaining = $this->input->post('productQuantity') - $sold;
				} else {
					$remaining = 'FALSE';
				}
			} else {
				$remaining = $productRow[0]['remaining'];
			}

			if($remaining !== 'FALSE') {
				$data = array(
					'productname' => $this->input->post("productName"),
					'quantity' => $this->input->post('productQuantity'),
					'remaining' => $remaining,
					'price' => $this->input->post("productPrice"),
					'unit' => $this->input->post("productUnit"),
					'comments' => $this->input->post("productComments"),
				);
				$where = array(
					'id' => $productId,
				);
				if($this->Product_Model->updateProduct($data, $where)) {
					$updatedAt = $this->Product_Model->getUpdatedDate($where);
					$where = array(
						'id' => $billId,
					);
					$this->Bill_Model->updateBill($updatedAt, $where);

					$response = array(
						'status' => 1,
						'totalPrice' => $this->input->post('productQuantity') * $this->input->post("productPrice"),
						'remaining' => $remaining,
						'updatedAt' => $updatedAt['lastupdated'],
						'statusMessage' => $this->lang->line('product').' '.$this->lang->line('updated').' '.$this->lang->line('successfully'),
					);
				} else {
					$error = $this->db->error();
					$response = array(
						'status' => 0,
						'statusMessage' => 'Database Error<br>Error Code: '.$error["code"].'<br>Error Message: '.$error["message"],
					);
				}
			} else {
				$response = array(
					'status' => 0,
					'statusMessage' => $this->lang->line('update_quantity_error_message'),
				);
			}
		} else {
			$response = array(
				'status' => 0,
				'statusMessage' => validation_errors(),
			);
		}
		echo json_encode($response);
	}		//ajax JSON

	public function billDetail($billId='') {
		if($billId != '') {
			$this->template->set('title', 'Bill Details');
			$where = array(
				'id' => $billId
			);
			$row = $this->Bill_Model->getResultOfBills($where);

			$where = array	(
				'billid' => $billId,
			);
			$row[0]['totalProducts'] = $this->Product_Model->countProducts($where);
			$sum = $this->Product_Model->sumProducts($where);
			$row[0]['totalPrice'] = $sum['0']['SUM(price*quantity)'];

			$data['billRow'] = $row;
		} else {
			$this->template->set('title', 'All Products');;
			$where = '';
		}

		$row = $this->Product_Model->getResultOfProducts($where);

			for($i = 0; $i < count($row); $i++) {
			$where = array	(
				'id' => $row[$i]['id'],
			);
			$sum = $this->Product_Model->sumProducts($where);
			$row[$i]['totalPrice'] = $sum['0']['SUM(price*quantity)'];
		}

		$data['productRow'] = $row;
		$data['billId'] = $billId;
		$this->template->load('default_layout', 'contents' , 'admin/billdetail', $data);

	}

	public function deleteProduct() {
		if($this->input->post('deleteProductId')) {
			$where = array(
				'id' => $this->input->post('deleteProductId'),
			);
			if($this->Product_Model->deleteProduct($where)) {
				$response = array(
					'status' => 1,
					'statusMessage' => $this->lang->line('product').' '.$this->lang->line('deleted').' '.$this->lang->line('successfully'),
				);
			} else {
				$error = $this->db->error();
				$response = array(
					'status' => 0,
					'statusMessage' => 'Database Error<br>Error Code: '.$error["code"].'<br>Error Message: '.$error["message"],
				);
			}

			echo json_encode($response);
		}
	}	//ajax JSON

	public function deleteBill() {
		if($this->input->post('deleteBillId')) {
			$where = array(
				'id' => $this->input->post('deleteBillId'),
			);
			if($this->Bill_Model->deleteBill($where)) {
				$response = array(
				'status' => 1,
				'statusMessage' => $this->lang->line('bill').' '.$this->lang->line('deleted').' '.$this->lang->line('successfully'),
				);
			} else {
				$error = $this->db->error();
					$response = array(
					'status' => 0,
					'statusMessage' => 'Database Error<br>Error Code: '.$error["code"].'<br>Error Message: '.$error["message"],
				);
			}
			
			echo json_encode($response);
		}
	}		//ajax JSON

	public function updateBill() {		// ajax JSON

		if($this->input->post('originalBillNumber') == $this->input->post('billNumber')) {
			$this->form_validation->set_rules('billNumber', 'Bill Number', 'trim|max_length[50]|min_length[1]|required');
		} else {
			$this->form_validation->set_rules('billNumber', 'Bill Number', 'trim|max_length[50]|min_length[1]|required|is_unique[bills.billnumber]',
				array(
					'is_unique'     => 'This %s already exists.'
				)
			);
		}

		$this->form_validation->set_rules('productName[]', 'Product Name', 'trim|max_length[50]|min_length[1]|required');
		$this->form_validation->set_rules('productQuantity[]', 'Product Quantity', 'trim|max_length[50]|min_length[1]|required|numeric');
		$this->form_validation->set_rules('productPrice[]', 'Product Price', 'trim|max_length[50]|min_length[1]|required|numeric');
		$this->form_validation->set_rules('productUnit[]', 'Product Unit', 'trim|required');
		if($this->form_validation->run() == TRUE) {
			$data = array(
				'billnumber' => $this->input->post('billNumber'),
				'comments' => $this->input->post('billComment'),
			);
			$where = array(
				'id' => $this->input->post('addProductBillId'),
			);
			if ($this->Bill_Model->updateBill($data, $where)) {
				$number = count($this->input->post('productName'));
				$totalPrice = 0;
				$productId = $this->input->post("productId");
				$productName = $this->input->post("productName");
				$quantity = $this->input->post("productQuantity");
				$price = $this->input->post("productPrice");
				$unit = $this->input->post("productUnit");
				$comments = $this->input->post("productComment");

				$check = 1;
				for($i = 0; $i < $number; $i++) {
					$totalPrice = $totalPrice + ($quantity[$i]*$price[$i]);
					$data = array(
						'productname' => $productName[$i],
						'quantity' => $quantity[$i],
						'price' => $price[$i],
						'unit' => $unit[$i],
						'comments' => $comments[$i],
					);
					$where = array(
						'id' => $productId[$i],
					);

					$productRow = $this->Product_Model->getResultOfProducts($where);
					$totalQuantity = $productRow[0]['quantity'];
					$sold = $productRow[0]['quantity'] - $productRow[0]['remaining'];
					if($quantity[$i] > $totalQuantity) {
						if($sold == 0) {
							$remaining = $quantity[$i];
						} else {
							$remaining = $quantity[$i] - $sold;
						}
					} elseif($quantity[$i] < $totalQuantity) {
						if($quantity[$i] >= $sold) {
							$remaining = $quantity[$i] - $sold;
						}
					} else {
						$remaining = $productRow[0]['remaining'];
					}

					$data['remaining'] = $remaining;

					if(!$this->Product_Model->updateProduct($data, $where)) {
						$check = 0;
					}
				}
				if($check) {
					$response = array(
						'status' => 1,
						'billId' => $this->input->post('addProductBillId'),
						'billNumber' => $this->input->post('billNumber'),
						'totalPrice' => $totalPrice,
						'statusMessage' => $this->lang->line('bill').' '.$this->lang->line('updated').' '.$this->lang->line('successfully'),
					);
				} else {
					$error = $this->db->error();
					$response = array(
						'status' => 0,
						'statusMessage' => 'Database Error<br>Error Code: ' . $error["code"] . '<br>Error Message: ' . $error["message"],
					);
				}

			} else {
				$error = $this->db->error();
				$response = array(
					'status' => 0,
					'statusMessage' => 'Database Error<br>Error Code: ' . $error["code"] . '<br>Error Message: ' . $error["message"],
				);
			}

		} else {
			$response = array(
				'status' => 0,
				'billNumberError' => form_error('billNumber'),
				'productNameError' => form_error('productName[]'),
				'productQuantityError' => form_error('productQuantity[]'),
				'productPriceError' => form_error('productPrice[]'),
				'productUnitError' => form_error('productUnit[]'),
			);
		}
		echo json_encode($response);
	}

	public function addNewBill() {
		if($this->input->post('addProductBillId') == '') {
			$this->form_validation->set_rules('billNumber', 'Bill Number', 'trim|max_length[50]|min_length[1]|required|is_unique[bills.billnumber]',
				array(
					'is_unique'     => 'This %s already exists.'
				)
			);
		} else {
			$this->form_validation->set_rules('billNumber', 'Bill Number', 'trim|max_length[50]|min_length[1]|required');
		}
		$this->form_validation->set_rules('productName[]', 'Product Name', 'trim|max_length[50]|min_length[1]|required');
		$this->form_validation->set_rules('productQuantity[]', 'Product Quantity', 'trim|max_length[50]|min_length[1]|required|numeric');
		$this->form_validation->set_rules('productPrice[]', 'Product Price', 'trim|max_length[50]|min_length[1]|required|numeric');
		$this->form_validation->set_rules('productUnit[]', 'Product Unit', 'trim|required');

		if($this->form_validation->run() == TRUE) {
			$addedDate = date('Y-m-d G:i:s');
			if($this->input->post('addProductBillId') == '') {
				$data = array(
					'billnumber' => $this->input->post('billNumber'),
					'comments' => $this->input->post('billComment'),
					'addeddate' => $addedDate,
				);
				if ($this->Bill_Model->insertNewBill($data)) {
					$insert_id = $this->db->insert_id();
				} else {
					$error = $this->db->error();
					$response = array(
						'status' => 0,
						'statusMessage' => 'Database Error<br>Error Code: ' . $error["code"] . '<br>Error Message: ' . $error["message"],
					);
				}
			} else {
				$insert_id = $this->input->post('addProductBillId');
			}
			$number = count($this->input->post('productName'));
			$totalPrice = 0;

			$productName = $this->input->post("productName");
			$quantity = $this->input->post("productQuantity");
			$price = $this->input->post("productPrice");
			$unit = $this->input->post("productUnit");
			$comments = $this->input->post("productComment");

			for($i = 0; $i < $number; $i++) {
				$totalPrice = $totalPrice + ($quantity[$i]*$price[$i]);
				$data2[$i] = array(
					'billid' => $insert_id,
					'productname' => $productName[$i],
					'quantity' => $quantity[$i],
					'remaining' => $quantity[$i],
					'price' => $price[$i],
					'unit' => $unit[$i],
					'comments' => $comments[$i],
					'addeddate' => $addedDate,
				);
				if($this->input->post('addProductBillId') !== '') {
					$data2[$i]['lastupdated'] = $addedDate;
				}
			}
			if($this->Product_Model->insertNewProduct($data2)) {
				$response = array(
					'status' => 1,
					'billNumber' => $this->input->post('billNumber'),
					'totalPrice' => $totalPrice,
					'numberOfProducts' => $number,
					'addedAt' => $addedDate,
				);
				if($this->input->post('addProductBillId') == '') {
					$response['id'] = $insert_id;
					$response['statusMessage'] = $this->lang->line('bill').' '.$this->lang->line('added').' '.$this->lang->line('successfully');
				} else {
					$first_id = $this->db->insert_id();
					$last_id = $first_id + ($number-1);
					$where = array(
						'id' => $insert_id,
					);
					$data = array(
						'lastupdated' => $addedDate,
					);
					$this->Bill_Model->updateBill($data, $where);
					$response['statusMessage'] = $this->lang->line('product').'(s) '.$this->lang->line('added').' '.$this->lang->line('successfully');
					$response['firstId'] = $first_id;
					$response['lastId'] = $last_id;
					$response['productName'] = $productName;
					$response['quantity'] = $quantity;
					$response['total'] = $price;
					$response['unit'] = $unit;
					$response['comments'] = $comments;
					$response['updatedAt'] = $addedDate;
				}
			} else {
				$error = $this->db->error();
				$response = array(
					'status' => 0,
					'statusMessage' => 'Database Error<br>Error Code: '.$error["code"].'<br>Error Message: '.$error["message"],
				);
			}
		} else {
			$response = array(
				'status' => 0,
				'billNumberError' => form_error('billNumber'),
				'productNameError' => form_error('productName[]'),
				'productQuantityError' => form_error('productQuantity[]'),
				'productPriceError' => form_error('productPrice[]'),
				'productUnitError' => form_error('productUnit[]'),
			);
		}
		
		echo json_encode($response);
	}		//ajax JSON

	public function bills() {
		$row = $this->Bill_Model->getResultOfBills();
		for($i = 0; $i < count($row); $i++) {
			$where = array	(
				'billid' => $row[$i]['id'],
			);
			$row[$i]['totalProducts'] = $this->Product_Model->countProducts($where);
			$sum = $this->Product_Model->sumProducts($where);
			$row[$i]['totalPrice'] = $sum['0']['SUM(price*quantity)'];
		}
		$data['billRow'] = $row;

		$this->template->set('title', 'Bills');
		$this->template->load('default_layout', 'contents' , 'admin/bills', $data);

	}

	public function profile() {

		$this->form_validation->set_rules('updateFirstName', 'First Name', 'trim|max_length[50]|min_length[1]|required');
		$this->form_validation->set_rules('updateLastName', 'Last Name', 'trim|max_length[50]|min_length[1]|required');
		$this->form_validation->set_rules('updatePassword', 'Password', 'trim|max_length[100]|min_length[8]');
		$this->form_validation->set_rules('updateRepeatPassword', 'Confirm Password', 'trim|max_length[100]|min_length[8]|matches[updatePassword]');
		$this->form_validation->set_rules('updateNic', 'NIC', 'trim|exact_length[13]|numeric|required',
			array(
				'is_unique'     => 'This %s already exists.'
			)
		);
		$this->form_validation->set_rules('updatePhone', 'Phone', 'trim|exact_length[11]|numeric|required');
		$this->form_validation->set_rules('updateAddress', 'Address', 'trim|max_length[100]|min_length[5]|required');

		if($this->form_validation->run() == TRUE) {
			$sessionData = $this->session->userdata('user');
			$data = array(
				'firstname' => $this->input->post('updateFirstName'),
				'lastname' => $this->input->post('updateLastName'),
				'nic' => $this->input->post('updateNic'),
				'phone' => $this->input->post('updatePhone'),
				'address' => $this->input->post('updateAddress'),
			);
			if($this->input->post('updatePassword') !== '') {
				$data['password'] = md5($this->input->post('updatePassword'));
			}
			$where = array(
				'id' => $sessionData['id'],
			);

			if (isset($_FILES['updateProfileImage']) && is_uploaded_file($_FILES['updateProfileImage']['tmp_name'])) {
				if($this->upload->do_upload('updateProfileImage')) {
					$image_data =   $this->upload->data();

					$configer =  array(
						'image_library'   => 'gd2',
						'source_image'    =>  $image_data['full_path'],
						'maintain_ratio'  =>  TRUE,
						'width'           =>  500,
						'height'          =>  500,
					);
					$this->image_lib->clear();
					$this->image_lib->initialize($configer);
					$this->image_lib->resize();

					unlink('assets/profileimages/'.$_SESSION['user']['profilepath']);		// delete the old image

					$data['profilepath'] = $image_data['file_name'];

				} else {
					$this->session->set_flashdata('error', $this->lang->line('image').' '.$this->lang->line('is').' '.$this->lang->line('not').' '.$this->lang->line('updated').' '.$this->lang->line('successfully'));
				}
			}

			if($this->Account_Model->updateAccount($data, $where)) {
				$row = array(
					'id' => $sessionData['id'],
					'username' => $sessionData['username'],
					'firstname' => $this->input->post('updateFirstName'),
					'lastname' => $this->input->post('updateLastName'),
					'email' => $sessionData['email'],
					'nic' => $this->input->post('updateNic'),
					'phone' => $this->input->post('updatePhone'),
					'address' => $this->input->post('updateAddress'),
					'regtime' =>  $sessionData['regtime'],
					'role' => $sessionData['role'],
					'status' => $sessionData['status'],
				);
				if(isset($data['profilepath'])) {
					$row['profilepath'] = $image_data['file_name'];
				} else {
					$row['profilepath'] = $sessionData['profilepath'];
				}
				$this->session->set_userdata('user', $row);
				$this->session->set_flashdata('success', $this->lang->line('account').' '.$this->lang->line('updated').' '.$this->lang->line('successfully'));
			} else {
				$error = $this->db->error();
				$this->session->set_flashdata('error', 'Database Error<br>Error Code: '.$error["code"].'<br>Error Message: '.$error["message"]);
			}
		}
		$data = array(); // optional parameter
		$this->template->set('title', 'Profile');
		$this->template->load('default_layout', 'contents' , 'admin/profile', $data);

	}

	public function index()
	{
		$where = "sale.`addeddate` > (NOW() - INTERVAL 1 MONTH)";
		$where2 = "products.`addeddate` > (NOW() - INTERVAL 1 MONTH)";
		$row = $this->Sell_Model->getSalesWithPPrice($where);
		$row2 = $this->Product_Model->getResultOfProducts($where2);
		$chartLabels = array();
		$chartData = array();
		if ($row && $row2) {
			$data['monthPurchases'] = count($row2);
			$todaySales = 0;
			$monthSales = 0;
			$todayPurchases = 0;
			for($i = 0; $i < count($row); $i++) {
				$monthSales = $monthSales + $row[$i]['numberOfSales'];
				$date = $row[$i]['addeddate'];
				$createDate = new DateTime($date);
				$strip = $createDate->format('Y-m-d');
				if($strip == date('Y-m-d')) {
					$todaySales = $row[$i]['numberOfSales'];
				}
				$strip = $createDate->format('M-d');
				$chartLabels[$i] = $strip;
				$chartData[$i] = $row[$i]['price'];
			}
			$data['todaySales'] = $todaySales;
			$data['monthSales'] = $monthSales;

			foreach ($row2 as $row) {
				$date = $row['addeddate'];
				$createDate = new DateTime($date);
				$strip = $createDate->format('Y-m-d');
				if($strip == date('Y-m-d')) {
					$todayPurchases++;
				}
			}
			$data['todayPurchases'] = $todayPurchases;
			$data['chartLabels'] = json_encode($chartLabels);
			$data['chartData'] = json_encode($chartData);
		} else {
			$data = array(); // optional parameter
			$error = $this->db->error();
			$this->session->set_flashdata('error', 'Database Error<br>Error Code: '.$error["code"].'<br>Error Message: '.$error["message"]);
		}
		$this->template->set('title', 'Admin Dashboard');
		$this->template->load('default_layout', 'contents' , 'admin/dashboard', $data);
	}

}
