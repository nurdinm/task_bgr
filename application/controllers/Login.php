<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_login');
		$this->load->helper("url_helper");
		$this->load->library("form_validation");
		$this->load->library("LoginValidation");
	}

	public function rules()
	{
		return [
			[
				'field' => 'email',
				'label'  => 'Email',
				'rules'  => 'required'
			],
			[
				'field' => 'password',
				'label'  => 'Password',
				'rules'  => 'trim|required|min_length[8]|max_length[25]'
			],
		];
	}


	public function rulesResetPassword()
	{
		return [
			[
				'field' => 'email',
				'label'  => 'Email',
				'rules'  => 'required'
			]
		];
	}

	public function index()
	{
		$this->load->view('login');
	}

	public function Login()
	{
		$mLogin = $this->M_login;
		$validation = $this->form_validation;
		$validation->set_rules($this->rules());

		if ($validation->run()) {
			$post = $this->input->post();
			$data['email'] = $post['email'];
			$data['password'] = $post['password'];

			if ($this->checkPassword($data['password']) != "") {
				$this->flashmsg($this->checkPassword($data['password']), 'danger');
				redirect('', 'refresh');
			} else {
				$result = $mLogin->login($data['email']);

				if (!isset($result)) {
					$this->flashmsg('Data yang anda masukkan salah', 'danger');
				} elseif ($result && $result->lock_user != "1") {
					if (password_verify($data['password'], $result->password)) {
						$session_data = array(
							'email' 		=> $result->email,
							'id'   			=> $result->id,
							'login'   		=> TRUE
						);

						$this->session->set_userdata($session_data);

						$this->flashmsg('Login Sukses', 'success');
						redirect(base_url('	dashboard'));
					} else {
						$attempt = $this->session->userdata('attempt');
						$attempt++;
						$this->session->set_userdata('attempt', $attempt);
						if ($attempt >= 3) {
							$z = $result->id;
							$a['lock_user'] = 1;
							$mLogin->setLocked($z, $a);

							$this->flashmsg('Your account is locked, Contact Administrato', 'danger');
							redirect(base_url());
						}
					}
				} else if ($result->lock_user == "1") {
					$this->flashmsg('Your account is locked, Contact Administrato', 'danger');
					redirect(base_url());
				}
			}
		} else {
			$err =  validation_errors('<span>', '</span>');
			$this->flashmsg($err, 'danger');
			redirect('', 'refresh');
		}

		$this->flashmsg("Login Gagal, Akun tidak terdaftar", 'danger');
		redirect('', 'refresh');
	}

	public function ResetPassword()
	{
		$mLogin = $this->M_login;
		$validation = $this->form_validation;
		$validation->set_rules($this->rulesResetPassword());
		$output = "";
		if ($validation->run()) {
			$post = $this->input->post();
			$data['email'] = $post['email'];

			$result = $mLogin->checkData($data['email']);

			if ($result) {
				$output['generate_password'] = substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789`-=~!@#$%^&*()_+,./<>?;:[]{}\|'), 0, 10);
				$datas['password'] = password_hash($output['generate_password'], PASSWORD_BCRYPT);
				$mLogin->resetPassword($data['email'], $datas);
				$this->flashmsg('Password Berhasil di reset', 'success');
			} else {
				$this->flashmsg('Gagal Mengubah Password, Data Yang Anda Masukkan Salah', 'danger');
			}

			// redirect('lupa-password','refresh');
		}

		$this->load->view('reset', $output);
	}

	public function checkPassword($pwd)
	{
		$errors = "";
		if (!preg_match("#[0-9]+#", $pwd)) {
			$errors = "Password must include at least one number!";
		}

		if (!preg_match("#[a-zA-Z]+#", $pwd)) {
			$errors = "Password must include at least one letter!";
		}

		return $errors;
	}
}
