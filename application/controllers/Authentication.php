<?php

class Authentication extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		// test_login(3);
		$config['upload_path'] = 'assets/profileimages';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['encrypt_name'] = TRUE;
		$this->load->library('upload', $config);
		$this->load->library('image_lib');
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
	}

	public function resetPassword($username, $code) {
		$where = array	(
			'username' => $username,
		);
		$row = $this->Account_Model->getAuthCode($where);
		$data['status'] = 0;
		if($row) {
			if(empty($row['auth'])) {
				$data['message'] = '<div><p>'.$this->lang->line('link_not_exist_expired').'</p></div>';
			} else {
				if($row['auth'] == $code) {
					$data['status'] = 1;
					if(null !== $this->input->post('resetPassword')) {
						$this->form_validation->set_rules('resetPassword', 'Password', 'trim|max_length[100]|min_length[8]|required');
						$this->form_validation->set_rules('repeatResetPassword', 'Confirm Password', 'trim|max_length[100]|min_length[8]|matches[resetPassword]|required');
						if($this->form_validation->run() === TRUE) {
							$data2 = array(
								'password' => md5($this->input->post('resetPassword')),
								'auth' => '',
							);
							if($this->Account_Model->updateAccount($data2, $where)) {
								$this->session->set_flashdata('success', $this->lang->line('password').' '.$this->lang->line('successfully').' '.$this->lang->line('reset'));
							} else {
								$error = $this->db->error();
								$this->session->set_flashdata('error', 'Database Error<br>Error Code: '.$error["code"].'<br>Error Message: '.$error["message"]);
							}
						}
					}
				} else {
					$data['message'] = '<div><p>'.$this->lang->line('no').' '.$this->lang->line('record').' '.$this->lang->line('found').'</p></div>';
				}
			}
		} else {
			$data['message'] = '<div><p>'.$this->lang->line('no').' '.$this->lang->line('record').' '.$this->lang->line('found').'</p></div>';
		}

		$data['title'] = $this->lang->line('reset').' '.$this->lang->line('password');
		$this->load->view('auth/include/header', $data);
		$this->load->view('auth/reset-password');
		$this->load->view('auth/include/footer');
	}

	public function forgotPassword() {
		if(null !== $this->input->post('forgotPassEmail')) {

			$this->form_validation->set_rules('forgotPassEmail', 'Email', 'trim|max_length[100]|min_length[5]|valid_email');
			if($this->form_validation->run() === TRUE) {
				$email = $this->input->post('forgotPassEmail');
				$where = array	(
					'email' => $email,
				);
				$row = $this->Account_Model->getAccountWhere($where);
				if($row) {
					if($row['status'] === '0') {
						$this->session->set_flashdata('error', $this->lang->line('account_not_activated').'<br>'.$this->lang->line('activate_account_first'));
					} else {
						$code = md5(date('Y-m-d H:i:s'));
						$where = array(
							'username' => $row['username'],
						);
						$data = array(
							'auth' => $code,
						);
						if($this->Account_Model->updateAccount($data, $where)) {
							$message= /*-----------email body starts-----------*/
								'Click the link below to reset your password, !<br>					
					' . base_url() . 'reset_password/'.$row['username'].'/'.$code ;
							/*-----------email body ends-----------*/
							$this->email->set_newline("\r\n");
							$this->email->from('adil.islam@purelogics.net');
							$this->email->to($row['email']);
							$this->email->subject('Reset Password');
							$this->email->message($message);
							$this->email->send();
							$this->session->set_flashdata('success', $this->lang->line('reset_link_send').'<br>'.$this->lang->line('click_link_to_reset'));
						} else {
							$error = $this->db->error();
							$this->session->set_flashdata('error', 'Database Error<br>Error Code: '.$error["code"].'<br>Error Message: '.$error["message"]);
						}
					}
				} else {
					$this->session->set_flashdata('error', $this->lang->line('no').' '.$this->lang->line('record').' '.$this->lang->line('found').' '.$this->lang->line('for').' '.$this->input->post('forgotPassEmail'));
				}
			}
		}

		$data['title'] = $this->lang->line('forgot').' '.$this->lang->line('password');
		$this->load->view('auth/include/header', $data);
		$this->load->view('auth/forgot-password');
		$this->load->view('auth/include/footer');
	}
	
	public function verification($username, $emailCode) {
		$where = array	(
			'username' => $username,
		);
		$row = $this->Account_Model->getAccountWhere($where);
		if($row !== 0) {
			if(md5((string)$row['created_at']) === $emailCode) {
				if($row['status'] === '0') {
					$data = array(
						'status' => '1',
					);
					$where = array(
						'username' => $username
					);
					if($this->Account_Model->updateAccount($data, $where)) {
						$data['message'] = $this->lang->line('thanks_registering').". ".$this->lang->line('successfully_verified').".<br>".$this->lang->line('may_login')."<br>";
					}
				} else {
					$data['message'] = $this->lang->line('thanks_registering').". ".$this->lang->line('already_been_verified').".<br>".$this->lang->line('login_by_clicking_link')."<br>";
				}
				$data['title'] = $this->lang->line('verification');
				$this->load->view('auth/include/header', $data);
				$this->load->view('auth/verify', $data);
				$this->load->view('auth/include/footer');
			} else {
				$this->load->view('errors/404');
			}
		} else {
			$this->load->view('errors/404');
		}
	}

	public function logout($role) {
		//$this->session->sess_destroy();
		$this->session->unset_userdata('user');
		$this->cart->destroy();
		if($role == '1') {
			redirect('login');
		} else {
			redirect('home');
		}
	}

	public function login() {
		if(null !== $this->input->post('inputEmailOrUsername')) {

			$password = md5($this->input->post('inputPassword'));

			$this->form_validation->set_rules('inputEmailOrUsername', 'Email/Username', 'trim|max_length[100]|min_length[5]|valid_email');
			$where = array	(
				'password' => $password
			);
			if($this->form_validation->run() === TRUE) {
				$where['email'] = $this->input->post('inputEmailOrUsername');
			} else {
				$where['username'] = $this->input->post('inputEmailOrUsername');
			}
			$row = $this->Account_Model->getAccountWhere($where);
			if($row) {
				unset($row["password"]);
				$this->session->set_userdata('user', $row);
				if($row['status'] === '0') {
					$this->session->set_flashdata('error', $this->lang->line('account_not_activated').'<br>'.$this->lang->line('activate_account'));
				} else {
					if($row['role'] === '1') {
						redirect('admin');
					} else {
						redirect('home');
					}
				}
			} else {
				$this->session->set_flashdata('error', $this->lang->line('invalid').' '.$this->lang->line('login').' '.$this->lang->line('credentials'));
			}
		}
		$data['title'] = $this->lang->line('login');
		$this->load->view('auth/include/header', $data);
		$this->load->view('auth/login');
		$this->load->view('auth/include/footer');
	}

	public function registration() {

		$this->form_validation->set_rules('accRegFirstName', 'First Name', 'trim|max_length[50]|min_length[1]|required');
		$this->form_validation->set_rules('accRegLastName', 'Last Name', 'trim|max_length[50]|min_length[1]|required');
		$this->form_validation->set_rules('accRegUsername', 'User Name', 'trim|max_length[30]|min_length[4]|required|is_unique[users.username]',
			array(
				'is_unique'     => 'This %s already exists.'
			)
		);
		$this->form_validation->set_rules('accRegEmail', 'Email', 'trim|max_length[100]|min_length[5]|valid_email|required|is_unique[users.email]',
			array(
				'is_unique'     => 'This %s already exists.'
			)
		);
		$this->form_validation->set_rules('accRegPassword', 'Password', 'trim|max_length[100]|min_length[8]|required');
		$this->form_validation->set_rules('accRegConfirmPassword', 'Confirm Password', 'trim|max_length[100]|min_length[8]|matches[accRegPassword]|required');
		$this->form_validation->set_rules('accRegNic', 'NIC', 'trim|exact_length[13]|numeric|required|is_unique[users.nic]',
			array(
				'is_unique'     => 'This %s already exists.'
			)
		);
		$this->form_validation->set_rules('accRegPhone', 'Phone', 'trim|exact_length[11]|numeric|required');
		$this->form_validation->set_rules('accRegAddress', 'Address', 'trim|max_length[100]|min_length[5]|required');

		if($this->form_validation->run() == TRUE) {
			$data = array(
				'username' => $this->input->post('accRegUsername'),
				'firstname' => $this->input->post('accRegFirstName'),
				'lastname' => $this->input->post('accRegLastName'),
				'email' => $this->input->post('accRegEmail'),
				'password' => md5($this->input->post('accRegPassword')),
				'nic' => $this->input->post('accRegNic'),
				'phone' => $this->input->post('accRegPhone'),
				'address' => $this->input->post('accRegAddress'),
				'role' => '2',
			);
			if (isset($_FILES['accRegProfileImage']) && is_uploaded_file($_FILES['accRegProfileImage']['tmp_name'])) {
				if($this->upload->do_upload('accRegProfileImage')) {
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

					$data['profilepath'] = $image_data['file_name'];

				} else {
					$this->session->set_flashdata('error', $this->lang->line('image').' '.$this->lang->line('is').' '.$this->lang->line('not').' '.$this->lang->line('uploaded').' '.$this->lang->line('successfully'));
				}
			}
			$regTime = date('Y-m-d H:i:s');
			$data['created_at'] = $regTime;
			if($this->Account_Model->insertNewAccount($data)) {
				$emailCode = md5((string)$regTime);
				$message= /*-----------email body starts-----------*/
					'Thanks for signing up, '.$this->input->post('accRegFirstName')." ".$this->input->post('accRegLastName').'!<br>
      
        			Your account has been created.<br> 
        			Here are your login details.<br>
					-------------------------------------------------<br>
					User Name   : ' . $this->input->post('accRegUsername') . '<br>
					Email   : ' . $this->input->post('accRegEmail') . '<br>
					Password: ' . $this->input->post('accRegPassword') . '<br>
					-------------------------------------------------<br>
									
					Please click this link to activate your account:<br>
						
					' . base_url() . 'verify/'.$this->input->post('accRegUsername').'/'.$emailCode ;
				/*-----------email body ends-----------*/
				$this->email->set_newline("\r\n");
				$this->email->from('adil.islam@purelogics.net');
				$this->email->to($this->input->post('accRegEmail'));
				$this->email->subject('Account Verification');
				$this->email->message($message);
				$this->email->send();
				$this->session->set_flashdata('success', $this->lang->line('successfully').' '.$this->lang->line('registered').'<br>'.$this->lang->line('verification_link_send').'<br>'.$this->lang->line('verify_your_account'));
			} else {
				$error = $this->db->error();
				$this->session->set_flashdata('error', 'Database Error<br>Error Code: '.$error["code"].'<br>Error Message: '.$error["message"]);
			}
		}

		$data['title'] = $this->lang->line('registration');
		$this->load->view('auth/include/header', $data);
		$this->load->view('auth/registration');
		$this->load->view('auth/include/footer');
	}

}
