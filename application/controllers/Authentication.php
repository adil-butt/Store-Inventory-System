<?php

class Authentication extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		test_login(3);
		$config['upload_path'] = 'assets/profileimages';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['encrypt_name'] = TRUE;
		$this->load->library('upload', $config);
		$this->load->library('image_lib');
		$config = Array(
			'protocol' => 'smtp',
			'smtp_host' => 'ssl://smtp.googlemail.com',
			'smtp_port' => 465,
<<<<<<< HEAD
			'smtp_user' => 'adil.islam@purelogics.net', // change it to yours
			'smtp_pass' => 'purelogics7861', // change it to yours
=======
			'smtp_user' => $this->config->item('email_address'),
			'smtp_pass' => $this->config->item('email_password'),
>>>>>>> ac2811c4a7694c40a9a27213b4c91daf1673c7db
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
<<<<<<< HEAD
				$data['message'] = '<div<p>This link not exist or expired</p></div>';
=======
				$data['message'] = '<div><p>'.$this->lang->line('link_not_exist_expired').'</p></div>';
>>>>>>> ac2811c4a7694c40a9a27213b4c91daf1673c7db
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
<<<<<<< HEAD
								$this->session->set_flashdata('success', 'Password Successfully Reset');
=======
								$this->session->set_flashdata('success', $this->lang->line('password').' '.$this->lang->line('successfully').' '.$this->lang->line('reset'));
>>>>>>> ac2811c4a7694c40a9a27213b4c91daf1673c7db
							} else {
								$error = $this->db->error();
								$this->session->set_flashdata('error', 'Database Error<br>Error Code: '.$error["code"].'<br>Error Message: '.$error["message"]);
							}
						}
					}
				} else {
<<<<<<< HEAD
					$data['message'] = '<div<p>No Record Found</p></div>';
				}
			}
		} else {
			$data['message'] = '<div<p>No Record Found</p></div>';
		}

		$data['title'] = 'Reset Password';
=======
					$data['message'] = '<div><p>'.$this->lang->line('no').' '.$this->lang->line('record').' '.$this->lang->line('found').'</p></div>';
				}
			}
		} else {
			$data['message'] = '<div><p>'.$this->lang->line('no').' '.$this->lang->line('record').' '.$this->lang->line('found').'</p></div>';
		}

		$data['title'] = $this->lang->line('reset').' '.$this->lang->line('password');
>>>>>>> ac2811c4a7694c40a9a27213b4c91daf1673c7db
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
<<<<<<< HEAD
						$this->session->set_flashdata('error', 'Your Account is not activated yet<br>Please Activate your Account First');
=======
						$this->session->set_flashdata('error', $this->lang->line('account_not_activated').'<br>'.$this->lang->line('activate_account_first'));
>>>>>>> ac2811c4a7694c40a9a27213b4c91daf1673c7db
					} else {
						$code = md5(date('Y-m-d G:i:s'));
						$where = array(
							'username' => $row['username'],
						);
						$data = array(
							'auth' => $code,
						);
						if($this->Account_Model->updateAccount($data, $where)) {
							$message= /*-----------email body starts-----------*/
								'Click the link below to reset your password, !<br>					
<<<<<<< HEAD
					' . base_url() . 'reset_Password/'.$row['username'].'/'.$code ;
							/*-----------email body ends-----------*/
							$this->email->set_newline("\r\n");
							$this->email->from('adil.islam@purelogics.net'); // change it to yours
							$this->email->to($row['email']);// change it to yours
							$this->email->subject('Reset Password');
							$this->email->message($message);
							$this->email->send();
							$this->session->set_flashdata('success', 'A Reset Password link has been sent to your email<br>Click on that link to reset your password');
=======
					' . base_url() . 'reset_password/'.$row['username'].'/'.$code ;
							/*-----------email body ends-----------*/
							$this->email->set_newline("\r\n");
							$this->email->from('adil.islam@purelogics.net');
							$this->email->to($row['email']);
							$this->email->subject('Reset Password');
							$this->email->message($message);
							$this->email->send();
							$this->session->set_flashdata('success', $this->lang->line('reset_link_send').'<br>'.$this->lang->line('click_link_to_reset'));
>>>>>>> ac2811c4a7694c40a9a27213b4c91daf1673c7db
						} else {
							$error = $this->db->error();
							$this->session->set_flashdata('error', 'Database Error<br>Error Code: '.$error["code"].'<br>Error Message: '.$error["message"]);
						}
					}
				} else {
<<<<<<< HEAD
					$this->session->set_flashdata('error', 'No Record Found for '.$this->input->post('forgotPassEmail'));
=======
					$this->session->set_flashdata('error', $this->lang->line('no').' '.$this->lang->line('record').' '.$this->lang->line('found').' '.$this->lang->line('for').' '.$this->input->post('forgotPassEmail'));
>>>>>>> ac2811c4a7694c40a9a27213b4c91daf1673c7db
				}
			}
		}

<<<<<<< HEAD
		$data['title'] = 'Forgot Password';
=======
		$data['title'] = $this->lang->line('forgot').' '.$this->lang->line('password');
>>>>>>> ac2811c4a7694c40a9a27213b4c91daf1673c7db
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
			if(md5((string)$row['regtime']) === $emailCode) {
				if($row['status'] === '0') {
					$data = array(
						'status' => '1',
					);
					$where = array(
						'username' => $username
					);
					if($this->Account_Model->updateAccount($data, $where)) {
<<<<<<< HEAD
						$data['message'] = "Thanks for registering. Your account is successfully verified.<br>You may login now<br>";
					}
				} else {
					$data['message'] = "Thanks for registering. Your account have already been verified.<br>You can login from by clicking the link below<br>";
				}
				$data['title'] = 'Verification';
=======
						$data['message'] = $this->lang->line('thanks_registering').". ".$this->lang->line('successfully_verified').".<br>".$this->lang->line('may_login')."<br>";
					}
				} else {
					$data['message'] = $this->lang->line('thanks_registering').". ".$this->lang->line('already_been_verified').".<br>".$this->lang->line('login_by_clicking_link')."<br>";
				}
				$data['title'] = $this->lang->line('verification');
>>>>>>> ac2811c4a7694c40a9a27213b4c91daf1673c7db
				$this->load->view('auth/include/header', $data);
				$this->load->view('auth/verify', $data);
				$this->load->view('auth/include/footer');
			} else {
<<<<<<< HEAD
				show_404();
			}
		} else {
			show_404();
		}
	}

	public function logout() {
		$this->session->unset_userdata('user');
		redirect('login');
=======
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
>>>>>>> ac2811c4a7694c40a9a27213b4c91daf1673c7db
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
<<<<<<< HEAD
					$this->session->set_flashdata('error', 'Your Account is not activated yet<br>Please Activate your account in order to login');
=======
					$this->session->set_flashdata('error', $this->lang->line('account_not_activated').'<br>'.$this->lang->line('activate_account'));
>>>>>>> ac2811c4a7694c40a9a27213b4c91daf1673c7db
				} else {
					if($row['role'] === '1') {
						redirect('admin');
					} else {
<<<<<<< HEAD
						redirect('user');
					}
				}
			} else {
				$this->session->set_flashdata('error', 'Invalid Login Credentials');
			}
		}
		$data['title'] = 'Login';
=======
						redirect('home');
					}
				}
			} else {
				$this->session->set_flashdata('error', $this->lang->line('invalid').' '.$this->lang->line('login').' '.$this->lang->line('credentials'));
			}
		}
		$data['title'] = $this->lang->line('login');
>>>>>>> ac2811c4a7694c40a9a27213b4c91daf1673c7db
		$this->load->view('auth/include/header', $data);
		$this->load->view('auth/login');
		$this->load->view('auth/include/footer');
	}

	public function registration() {

		$this->form_validation->set_rules('accRegFirstName', 'First Name', 'trim|max_length[50]|min_length[1]|required');
		$this->form_validation->set_rules('accRegLastName', 'Last Name', 'trim|max_length[50]|min_length[1]|required');
		$this->form_validation->set_rules('accRegUsername', 'User Name', 'trim|max_length[30]|min_length[4]|required|is_unique[accounts.username]',
			array(
				'is_unique'     => 'This %s already exists.'
			)
		);
		$this->form_validation->set_rules('accRegEmail', 'Email', 'trim|max_length[100]|min_length[5]|valid_email|required|is_unique[accounts.email]',
			array(
				'is_unique'     => 'This %s already exists.'
			)
		);
		$this->form_validation->set_rules('accRegPassword', 'Password', 'trim|max_length[100]|min_length[8]|required');
		$this->form_validation->set_rules('accRegConfirmPassword', 'Confirm Password', 'trim|max_length[100]|min_length[8]|matches[accRegPassword]|required');
		$this->form_validation->set_rules('accRegNic', 'NIC', 'trim|exact_length[13]|numeric|required|is_unique[accounts.nic]',
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
<<<<<<< HEAD
					$this->session->set_flashdata('error', 'Image is not uploaded successfully');
=======
					$this->session->set_flashdata('error', $this->lang->line('image').' '.$this->lang->line('is').' '.$this->lang->line('not').' '.$this->lang->line('uploaded').' '.$this->lang->line('successfully'));
>>>>>>> ac2811c4a7694c40a9a27213b4c91daf1673c7db
				}
			}
			$regTime = date('Y-m-d G:i:s');
			$data['regtime'] = $regTime;
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
<<<<<<< HEAD
				$this->email->from('adil.islam@purelogics.net'); // change it to yours
				$this->email->to($this->input->post('accRegEmail'));// change it to yours
				$this->email->subject('Account Verification');
				$this->email->message($message);
				$this->email->send();
				$this->session->set_flashdata('success', 'Successfully Registered<br>A verification link has been sent to your email<br>Please verify your account by click on that link');
=======
				$this->email->from('adil.islam@purelogics.net');
				$this->email->to($this->input->post('accRegEmail'));
				$this->email->subject('Account Verification');
				$this->email->message($message);
				$this->email->send();
				$this->session->set_flashdata('success', $this->lang->line('successfully').' '.$this->lang->line('registered').'<br>'.$this->lang->line('verification_link_send').'<br>'.$this->lang->line('verify_your_account'));
>>>>>>> ac2811c4a7694c40a9a27213b4c91daf1673c7db
			} else {
				$error = $this->db->error();
				$this->session->set_flashdata('error', 'Database Error<br>Error Code: '.$error["code"].'<br>Error Message: '.$error["message"]);
			}
		}

<<<<<<< HEAD
		$data['title'] = 'Registration';
=======
		$data['title'] = $this->lang->line('registration');
>>>>>>> ac2811c4a7694c40a9a27213b4c91daf1673c7db
		$this->load->view('auth/include/header', $data);
		$this->load->view('auth/registration');
		$this->load->view('auth/include/footer');
	}

}
