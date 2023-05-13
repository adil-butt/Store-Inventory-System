<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
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
	 */
	// public function index()
	// {
	// 	$data = array(); // optional parameter
	// 	$this->template->set('title', 'Home');
	// 	$this->template->load('default_layout_2', 'contents' , 'home/home_2', $data);
	// }

	public function index($num = 0, $is_login = 0)
	{
		$data = array(); // optional parameter

		$data['is_login'] = $is_login;

		$where = array(
			'remaining >' => '0',
		);

		if(isset($_POST['userSearch'])) {
			if($_POST['userSearch'] != '') {
				$products = $this->Product_Model->getSimilar($this->input->post('userSearch'), $where);
				$data['products'] = $products;
			} else {
				$data['products'] = array();
			}
		} else {
			$limit = 12;
			$offset = $num;
			$totalProducts = $this->Product_Model->countProducts($where);
			$products = $this->Product_Model->getResultOfProducts($where, $limit, $offset);
			$data['products'] = array();
			if (is_array($products) && count($products) > 0)
			{
				$data['products'] = $products;
			}
			$this->load->library('pagination');

			$config['base_url'] = base_url('home');
			$config['total_rows'] = $totalProducts;
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
		}

		$this->template->set('title', $this->lang->line('home'));
		$this->template->load('default_layout', 'contents' , 'home/dashboard', $data);
	}

	public function about() {
		$data = array(); // optional parameter

		$this->template->set('title', $this->lang->line('about').' '.$this->lang->line('us'));
		$this->template->load('default_layout', 'contents' , 'home/about', $data);
	}

	public function contact() {
		$data = array(); // optional parameter
		$this->form_validation->set_rules('txtName', 'Name', 'trim|max_length[50]|min_length[1]|required');
		$this->form_validation->set_rules('txtEmail', 'Email', 'trim|max_length[100]|min_length[5]|valid_email|required');
		$this->form_validation->set_rules('txtPhone', 'Phone Number', 'trim|exact_length[11]|numeric|required');
		$this->form_validation->set_rules('txtMsg', 'Message', 'trim|max_length[500]|min_length[20]|required');

		if($this->form_validation->run() == TRUE) {
			$config = Array(
				'protocol' => 'smtp',
				'smtp_host' => 'ssl://smtp.googlemail.com',
				'smtp_port' => 465,
				'smtp_user' => $this->config->item('email_address'),
				'smtp_pass' => $this->config->item('email_password'),
				'mailtype' => 'html',
				'charset' => 'iso-8859-1',
				'wordwrap' => TRUE
			);
			$this->load->library('email', $config);

			$message= /*-----------email body starts-----------*/
				'New Message for '.$this->config->item('site_name').'<br>
        			Here are the message details.<br>
        			Name of Sender: '.$this->input->post('txtName').'<br>
        			Phone Number of Sender: '.$this->input->post('txtPhone').'<br>
        			Email of Sender: '.$this->input->post('txtEmail').'<br>
        			Message:<br>
					-------------------------------------------------<br>'
					.$this->input->post('txtMsg').'<br>
					-------------------------------------------------<br>';
			/*-----------email body ends-----------*/
			$this->email->set_newline("\r\n");
			$this->email->from($this->input->post('txtEmail'));
			$this->email->to('adil.islam@purelogics.net');
			$this->email->subject('New Message for '.$this->config->item('site_name'));
			$this->email->message($message);
			if($this->email->send()) {
				$this->session->set_flashdata('success', $this->lang->line('your').' '.$this->lang->line('message').' '.$this->lang->line('is').' '.$this->lang->line('send').' '.$this->lang->line('successfully'));
			} else {
				$this->session->set_flashdata('error', $this->lang->line('something').' '.$this->lang->line('went').' '.$this->lang->line('wrong'));
			}

		}
		$this->template->set('title', $this->lang->line('contact_us'));
		$this->template->load('default_layout', 'contents' , 'home/contact_us', $data);
	}

	public function productDisplay($pId) {
		$data = array(); // optional parameter
		$where = array(
			'id' => $pId,
		);
		$product = $this->Product_Model->getResultOfProducts($where);
		$data['product'] = $product;

		$this->template->set('title', $this->lang->line('product').' '.$this->lang->line('information'));
		$this->template->load('default_layout', 'contents' , 'home/product_view', $data);
	}

	public function cart() {
		$data = array(); // optional parameter
		$this->template->set('title', $this->lang->line('cart'));
		$this->template->load('default_layout', 'contents' , 'home/cart', $data);
	}

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
						'userid' => $_SESSION['admin']['id'],
						'quantity' => $item['qty'],
						'created_at' => date('Y-m-d H:i:s'),
					);
				}
				if($this->Sell_Model->insertSalesAsBatch($data2)) {
					foreach ($this->cart->contents() as $item) {
						$where = array(
							'id' => $item['id'],
						);
						$row = $this->Product_Model->getResultOfProducts($where);
						$remaining = $row[0]['remaining'] - $item['qty'];
						$data = array(
							'remaining' => $remaining,
						);
						$this->Product_Model->updateProduct($data, $where);
					}
					$this->cart->destroy();
					$this->session->set_flashdata('success', $this->lang->line('successfully').' '.$this->lang->line('checkout'));
				} else {
					$this->session->set_flashdata('error', $this->lang->line('something').' '.$this->lang->line('went').' '.$this->lang->line('wrong'));
				}
			} else {
				$this->session->set_flashdata('error', $this->lang->line('your').' '.$this->lang->line('cart').' '.$this->lang->line('is_empty').'. '.$this->lang->line('add_items_to_checkout'));
			}
		}

		$data = array(); // optional parameter
		$this->template->set('title', $this->lang->line('checkout'));
		$this->template->load('default_layout', 'contents' , 'home/checkout', $data);
	}
}
