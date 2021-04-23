<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if($this->session->userdata('isLogIn') != true){
            redirect('auth/logout');
        }
        $this->load->model('Global_model');
    }

    function index()
    {
        $data['user'] = $this->Global_model->get_data('users', ['user_id' => $this->session->userdata('user_id')], false);
        $data['_view'] = 'profile';
        if ($data['user']['level'] == 'Super_Admin') {
            $this->load->view('super_admin/layouts/main', $data);
        } elseif ($data['user']['level'] == 'Administrator') {
            $this->load->view('administrator/layouts/main', $data);
        } elseif ($data['user']['level'] == 'Guest') {
            $this->load->view('guest/layouts/main', $data);
        }
    }

    function upFoto()
    {
        $config['upload_path']          = './assets/img/avatar/';
        $config['allowed_types']        = 'jpg|png';
        $config['encrypt_name']         = true;
        // $config['file_name']            = $jadwal_id . '/' . date('Y-m-d-H-i') . 'bp';
        $config['overwrite']            = true;
        $config['max_size']             = 10000;
        $this->load->library('upload');
        $this->upload->initialize($config);
        if (!empty($_FILES['foto']['name'])) {

            if ($this->upload->do_upload('foto')) {
                $gbr = $this->upload->data();
                //Compress Image
                $config['image_library'] = 'gd2';
                $config['source_image'] = './assets/img/avatar/' . $gbr['file_name'];
                $config['create_thumb'] = FALSE;
                $config['maintain_ratio'] = FALSE;
                $config['quality'] = '50%';
                $config['width'] = 400;
                $config['height'] = 400;
                $config['new_image'] = './assets/img/avatar/' . $gbr['file_name'];
                $this->load->library('image_lib', $config);
                $this->image_lib->resize();

                $gambar = $gbr['file_name'];
                $params = array(
                    'profile' => $gambar,
                );

                $upFoto = $this->Global_model->update('users', $params, ['user_id' => $this->session->userdata('user_id')]);
                if ($upFoto) {
                    $this->session->set_userdata($params);
                    $this->session->set_flashdata('message', "<script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil...',
                        text: 'Berhasil upload foto..',
                    })
                </script>");
                } else {
                    $this->session->set_flashdata('message', "<script>
                    Swal.fire({
                            icon: 'error',
                            title: 'Gagal...',
                            text: 'Gagal upload foto..',
                        })
                    </script>");
                }
                redirect('profile/index');
            }
        } else {
            $this->session->set_flashdata('message', "<script>
            Swal.fire({
                    icon: 'error',
                    title: 'Gagal...',
                    text: 'Foto kosong..',
                })
            </script>");
            redirect('profile/index');
        }
    }

    function edit()
    {
        $data['data_user'] = $this->Global_model->get_data('users', ['user_id' => $this->session->userdata('user_id')], false);

        if (isset($data['data_user']['user_id'])) {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            $this->form_validation->set_rules('first_name', 'First Name', 'required');
            $this->form_validation->set_rules('last_name', 'Last Name', 'required');

            if ($this->form_validation->run()) {
                if ($data['data_user']['email'] == $this->input->post('email')) {
                    $email = $data['data_user']['email'];
                } else {
                    $cek = $this->Global_model->get_data('users', ['email' => $this->input->post('email')], false);
                    if ($cek['email'] == null) {
                        $email = $this->input->post('email');
                    } else {
                        $this->session->set_flashdata('message', "<script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal...',
                            text: 'Email sudah digunakan user lain..',
                        })
                        </script>");
                        redirect('profile/index');
                        die;
                    }
                }
                $params = array(
                    'email' => $email,
                    'first_name' => $this->input->post('first_name'),
                    'last_name' => $this->input->post('last_name'),
                );
                $editUser = $this->Global_model->update('users', $params, ['user_id' => $this->session->userdata('user_id')]);

                if ($editUser) {
                    $this->session->set_flashdata('message', "<script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil...',
                        text: 'Berhasil ubah data..',
                    })
                </script>");
                } else {
                    $this->session->set_flashdata('message', "<script>
                    Swal.fire({
                            icon: 'error',
                            title: 'Gagal...',
                            text: 'Gagal ubah data..',
                        })
                    </script>");
                }
                redirect('profile/index');
            } else {
                redirect('profile/index');
            }
        } else
            show_error('The profile you are trying to edit does not exist.');
    }

    function ubahpass()
    {
        $data['data_user'] = $this->Global_model->get_data('users', ['user_id' => $this->session->userdata('user_id')], false);

        if (isset($data['data_user']['user_id'])) {
            if ($this->input->post('password') == '' || $this->input->post('password') == null || empty($this->input->post('password'))) {
                $this->session->set_flashdata('message', "<script>
                    Swal.fire({
                            icon: 'error',
                            title: 'Gagal...',
                            text: 'Password harus diisi',
                        })
                    </script>");
                redirect('profile/index');
                die;
            }

            if (strlen($this->input->post('password')) < 8) {
                $this->session->set_flashdata('message', "<script>
                    Swal.fire({
                            icon: 'error',
                            title: 'Gagal...',
                            text: 'Password min.8 karakter',
                        })
                    </script>");
                redirect('profile/index');
                die;
            }
            $params = array(
                'password' => md5($this->input->post('password')),
            );

            $edit = $this->Global_model->update('users', $params, ['user_id' => $this->session->userdata('user_id')]);
            if ($edit) {
                $this->session->set_flashdata('message', "<script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil...',
                        text: 'Berhasil ubah password..',
                    })
                </script>");
            } else {
                $this->session->set_flashdata('message', "<script>
                    Swal.fire({
                            icon: 'error',
                            title: 'Gagal...',
                            text: 'Gagal ubah password..',
                        })
                    </script>");
            }
            redirect('profile/index');
        } else
            show_error('The profile you are trying to edit does not exist.');
    }
}
