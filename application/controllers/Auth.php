<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Global_model');
	}

	public function index()
	{
		// $params = [
		// 	'first_name' => 'Super Admin',
		// 	'last_name' => ' Sandi',
		// 	'email' => 'su@outlook.com',
		// 	'password' => md5('123'),
		// 	'isActive' => 'Yes',
		// 	'level' => 'Super_Admin',
		// 	'publish' => 'Yes',
		// ];
		// $this->Global_model->insert('users', $params);
		// $params = [
		// 	'first_name' => 'Administrator',
		// 	'last_name' => '.',
		// 	'email' => 'administrator@outlook.com',
		// 	'password' => md5('123'),
		// 	'isActive' => 'Yes',
		// 	'level' => 'Administrator',
		// 	'publish' => 'Yes',
		// ];
		// $this->Global_model->insert('users', $params);
		// $params = [
		// 	'first_name' => 'Guest',
		// 	'last_name' => '.',
		// 	'email' => 'guest@outlook.com',
		// 	'password' => md5('123'),
		// 	'isActive' => 'Yes',
		// 	'level' => 'Guest',
		// 	'publish' => 'Yes',
		// ];
		// $this->Global_model->insert('users', $params);
		$this->load->view('auth/login');
	}

	public function login()
	{
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		$cek = $this->Global_model->get_data('users', ['email' => $email, 'password' => md5($password)], false);
		if (!empty($cek)) {
			if ($cek['isActive'] == 'Yes') {
				$data_session = array(
					'email' => $email,
					'user_id' => $cek['user_id'],
					'first_name' => $cek['first_name'],
					'last_name' => $cek['last_name'],
					'level' => $cek['level'],
					'profile' => $cek['profile']
				);
				$this->session->set_userdata($data_session);
				if ($cek['level'] == 'Super_Admin') {
					redirect(base_url("super_admin"));
				} elseif ($cek['level'] == 'Administrator') {
					redirect(base_url("administrator"));
				} elseif ($cek['level'] == 'Guest') {
					redirect(base_url("guest"));
				}
			} else {
				$this->session->set_flashdata('message', "<script>
				Swal.fire({
						icon: 'error',
						title: 'Gagal...',
						text: 'Gagal login, akun anda belum aktif..',
					})
				</script>");
				redirect('auth');
			}
		} else {
			$this->session->set_flashdata('message', "<script>
				Swal.fire({
						icon: 'error',
						title: 'Gagal...',
						text: 'Gagal login, username atau password salah..',
					})
				</script>");
			redirect('auth');
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('auth/index');
	}

	function forgot()
	{
		$this->load->library('form_validation');

		$this->form_validation->set_rules('email', 'Email', 'required');

		if ($this->form_validation->run()) {
			$cek = $this->db->get_where('tbl_user', array('email' => $this->input->post('email')))->row_array();
			if ($cek != null) {
				$getEmail = file_get_contents(base_url() . 'email.json');
				$gE = json_decode($getEmail, true);
				$config = [
					'mailtype'  => 'html',
					'charset'   => 'utf-8',
					'protocol'  => 'smtp',
					'smtp_host' => 'smtp.gmail.com',
					'smtp_user' => $gE['email'],  // Email gmail
					'smtp_pass'   => $gE['pass'],  // Password gmail
					'smtp_crypto' => 'ssl',
					'smtp_port'   => 465,
					'crlf'    => "\r\n",
					'newline' => "\r\n"
				];

				// Load library email dan konfigurasinya
				$this->load->library('email', $config);

				$this->email->from($gE['email'], 'Sales');

				$this->email->to($this->input->post('email'));

				$this->email->subject('Atur ulang kata sandi');

				$this->email->message("Klik disini untuk mereset password anda. <a href='" . base_url('auth/reset/') . $cek['user_id'] . '/' . $cek['password'] . "'>Reset Password</a>");
				if ($this->email->send()) {
					$this->session->set_flashdata('message', "<script>
						Swal.fire({
							icon: 'success',
							title: 'Berhasil...',
							text: 'Silahkan cek email anda..',
						})
					</script>");
				} else {
					$this->session->set_flashdata('message', "<script>
							Swal.fire({
								icon: 'error',
								title: 'Gagal...',
								text: 'Gagal mengirim link reset password..',
							})
						</script>");
				}
				redirect('auth/forgot');
			} else {
				$this->session->set_flashdata('message', "<script>
						Swal.fire({
							icon: 'error',
							title: 'Gagal...',
							text: 'Email tidak terdaftar..',
						})
					</script>");
				redirect('auth/forgot');
			}
		} else {
			$this->load->view('auth/lupa');
		}
	}

	function reset($user_id = null, $pass = null)
	{
		if ($pass != null && $user_id != null) {
			$cek = $this->db->get_where('tbl_user', array('password' => $pass, 'user_id' => $user_id))->row_array();
			if ($cek == null) {
				$this->session->set_flashdata('message', "<script>
							Swal.fire({
								icon: 'error',
								title: 'Gagal...',
								text: 'Data tidak ada..',
							})
						</script>");
				redirect('auth');
			} else {
				$this->load->library('form_validation');

				$this->form_validation->set_rules('password', 'Password', 'required|min_length[8]');

				if ($this->form_validation->run()) {
					$paramss = [
						'password' => md5($this->input->post('password'))
					];
					$in =  $this->db->where('user_id', $cek['user_id'])->update('tbl_user', $paramss);
					if ($in) {
						$this->session->set_flashdata('message', "<script>
						Swal.fire({
							icon: 'success',
							title: 'Berhasil...',
							text: 'Berhasil reset password..',
						})
					</script>");
					} else {
						$this->session->set_flashdata('message', "<script>
							Swal.fire({
								icon: 'error',
								title: 'Gagal...',
								text: 'Gagal reset password..',
							})
						</script>");
					}
					redirect('auth/index');
				} else {
					$this->load->view('auth/reset');
				}
			}
		} else {
			redirect('auth');
		}
	}

}
