<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		test_login(2);

		//echo $this->pagination->create_links();
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
	 * @param $pId
	 */

	public function checkout() {

		$this->form_validation->set_rules('address', 'Address', 'trim|required');
		$this->form_validation->set_rules('phone', 'Phone', 'trim|exact_length[11]|numeric|required');
		$this->form_validation->set_rules('state', 'State', 'trim|required|callback_state_check');
		$this->form_validation->set_rules('zip', 'Zip', 'trim|exact_length[5]|numeric|required');
		$data2 = array();
		if($this->form_validation->run() == TRUE) {
			if($this->cart->total_items() > 0) {
				foreach ($this->cart->contents() as $item) {
					$data2[] = array(
						'productid' => $item['id'],
						'accountid' => $_SESSION['user']['id'],
						'quantity' => $item['qty'],
						'addeddate' => date('Y-m-d G:i:s'),
					);
				}
				if($this->Sell_Model->insertSalesAsBatch($data2)) {
					$this->cart->destroy();
					$this->session->set_flashdata('success', 'Successfully checkout');
				} else {
					$this->session->set_flashdata('error', 'Something Went Wrong');
				}
			} else {
				$this->session->set_flashdata('error', 'Your cart is empty. Pleas add items in cart in order to make checkout');
			}
		}

		$data = array(); // optional parameter
		$this->template->set('title', 'Checkout');
		$this->template->load('user_layout', 'contents' , 'user/checkout', $data);
	}

	public function state_check($str)
	{
		if ($str == 'Punjab' || $str == 'Islamabad' || $str == 'Sindh' || $str == 'KPK' || $str == 'Northern Areas' || $str == 'Balochistan')
		{
			return TRUE;
		}
		else
		{
			$this->form_validation->set_message('state_check', 'The {field} field can not be a valid field');
			return FALSE;
		}
	}

	public function cart() {
		$data = array(); // optional parameter
		$this->template->set('title', 'Cart');
		$this->template->load('user_layout', 'contents' , 'user/cart', $data);
	}

	public function updateCart() {
		$data = array();
		$error = false;
		foreach ($_POST as $item):
			$check = $this->cart->get_item($item['rowid']);
			$where = array(
				'id' => $check['id'],
			);
			$product = $this->Product_Model->getResultOfProducts($where);
			if($product) {
				if($item['qty'] <= $product[0]['remaining']) {
					$data[] = array(
						'rowid'   => $item['rowid'],
						'qty'     => $item['qty'],
					);
				} else {
					$this->session->set_flashdata('error', 'Something Went Wrong');
					$error = true;
					break;
				}
			} else {
				$this->session->set_flashdata('error', 'Something Went Wrong');
				$error = true;
				break;
			}
		endforeach;
		if($error == false) {
			$this->cart->update($data);
			$this->session->set_flashdata('success', 'Cart Updated Successfully');
		}
		redirect(base_url('cart'));
	}

	public function addItemsToCart() {
		$error = false;
		$where = array(
			'id' => $this->input->post('pBuyId'),
		);
		if($product = $this->Product_Model->getResultOfProducts($where)) {
			if($this->input->post('pBuyQuantity') <= $product[0]['remaining']) {
				foreach ($this->cart->contents() as $item) {
					if($item['id'] == $this->input->post('pBuyId')) {
						if($this->input->post('pBuyQuantity') > ($product[0]['remaining'] - $item['qty'])) {
							if($product[0]['remaining'] - $item['qty'] == 0) {
								$this->session->set_flashdata('error', 'You are already selected '.$item['qty'].' item');
							} else {
								$this->session->set_flashdata('error', 'You are already selected '.$item['qty'].' item. Please select quantity less than or equal to '.($product[0]['remaining'] - $item['qty']));
							}
							$error = true;
							break;
						}
					}
				}
				if($error == false) {
					$data = array(
						'id'      => $this->input->post('pBuyId'),
						'qty'     => $this->input->post('pBuyQuantity'),
						'price'   => $this->input->post('pBuyPrice'),
						'name'    => $this->input->post('pBuyName'),
					);
					$this->cart->insert($data);
					$this->session->set_flashdata('success', 'Added Successfully');
				}
			} else {
				$this->session->set_flashdata('error', 'Something Went Wrong');
			}
		} else {
			$this->session->set_flashdata('error', 'Something Went Wrong');
		}
		redirect(base_url('display_product/').$this->input->post('pBuyId'));
	}

	public function productDisplay($pId) {
		$data = array(); // optional parameter
		$where = array(
			'id' => $pId,
		);
		$product = $this->Product_Model->getResultOfProducts($where);
		$data['product'] = $product;

		$this->template->set('title', 'Product Information');
		$this->template->load('user_layout', 'contents' , 'user/product_view', $data);
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
		$this->template->load('admin_layout', 'contents' , 'admin/profile', $data);

	}

	public function index($num = 0)
	{
		$data = array(); // optional parameter
		$where = array(
			'remaining >' => '0',
		);
		$limit = 12;
		$offset = $num;
		$totalProducts = $this->Product_Model->getResultOfProducts($where);
		$products = $this->Product_Model->getResultOfProducts($where, $limit, $offset);
		$data['products'] = $products;
		$data['num'] = $num;

		$this->load->library('pagination');

		$config['base_url'] = base_url('home');
		$config['total_rows'] = count ($totalProducts);
		$config['per_page'] = $limit;

		$config['full_tag_open'] = '<nav class="d-flex justify-content-center wow fadeIn"><ul class="pagination pg-blue">';
		$config['full_tag_close'] = '</ul></nav>';

		$config['num_tag_open'] = '<li class="page-item page-link">';
		$config['num_tag_close'] = '</li>';

		$config['cur_tag_open'] = '<li class="page-item page-link" style="background-color: dodgerblue; color: white">';
		$config['cur_tag_close'] = '</li>';

		$config['next_link'] = '&raquo;';
		$config['next_tag_open'] = '<li class="page-item page-link">';
		$config['next_tag_close'] = '</li>';

		$config['prev_link'] = '&laquo;';
		$config['prev_tag_open'] = '<li class="page-item page-link">';
		$config['prev_tag_close'] = '</li>';

		$config['first_tag_open'] = '<li class="page-item page-link">';
		$config['first_tag_close'] = '</li>';

		$config['last_tag_open'] = '<li class="page-item page-link">';
		$config['last_tag_close'] = '</li>';


		$this->pagination->initialize($config);

		$this->template->set('title', 'Dashboard');
		$this->template->load('user_layout', 'contents' , 'user/dashboard', $data);
	}
}
