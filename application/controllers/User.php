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
		$data = array(); // optional parameter
		$this->template->set('title', 'Dashboard');
		$this->template->load('user_layout', 'contents' , 'user/checkout', $data);
	}

	public function cart() {
		$data = array(); // optional parameter
		$this->template->set('title', 'Dashboard');
		$this->template->load('user_layout', 'contents' , 'user/cart', $data);
	}

	public function updateCart() {
		$data = array();
		foreach ($_POST as $item):
			$data[] = array(
				'rowid'   => $item['rowid'],
				'qty'     => $item['qty'],
			);
		endforeach;
		$this->cart->update($data);
		redirect(base_url('cart'));
	}

	public function addItemsToCart() {
		$where = array(
			'id' => $this->input->post('pBuyId'),
		);
		if($product = $this->Product_Model->getResultOfProducts($where)) {
			if($this->input->post('pBuyQuantity') <= $product[0]['remaining']) {
				$data = array(
					'id'      => $this->input->post('pBuyId'),
					'qty'     => $this->input->post('pBuyQuantity'),
					'price'   => $this->input->post('pBuyPrice'),
					'name'    => $this->input->post('pBuyName'),
				);
				$this->cart->insert($data);
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
		$products = $this->Product_Model->getResultOfProducts($where);
		$data['products'] = $products;
		$data['num'] = $num;

		$this->load->library('pagination');

		$config['base_url'] = base_url('home');
		$config['total_rows'] = count($products);
		$config['per_page'] = 20;


		$this->pagination->initialize($config);

		$this->template->set('title', 'Dashboard');
		$this->template->load('user_layout', 'contents' , 'user/dashboard', $data);
	}
}
