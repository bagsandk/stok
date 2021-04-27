<?php
class Kartu_stok_aset extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('isLogIn') != true) {
            redirect('auth/logout');
        }
        $this->load->model('Kartu_stok_aset_model');
        $this->load->model('Produk_model');
        $this->load->model('Global_model');
    }
    function index()
    {
        $data['kartu_stok_aset_'] = $this->Kartu_stok_aset_model->get_all_kartu_stok_aset_();
        $data['_view'] = 'guest/kartu_stok_aset/index';
        $this->load->view('guest/layouts/main', $data);
    }
    function add()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('productId', 'Produk', 'required|max_length[100]');
        $this->form_validation->set_rules('departement', 'Departement', 'required|max_length[100]');
        $this->form_validation->set_rules('ruang', 'Ruang', 'required|max_length[100]');
        $this->form_validation->set_rules('hargaPerolehan', 'Harga perlolehan', 'max_length[100]');
        $this->form_validation->set_rules('masaManfaat', 'Masa manfaat', 'required|max_length[100]');
        $this->form_validation->set_rules('supplier', 'Supplier', 'required|max_length[100]');
        $this->form_validation->set_rules('pengguna', 'Pengunaa', 'required|max_length[100]');
        $this->form_validation->set_rules('noPo', 'No PO', 'max_length[100]');
        $this->form_validation->set_rules('statusPerolehan', 'Status perolehan', 'required|max_length[100]');
        $this->form_validation->set_rules('lokasi', 'Lokasi', 'required|max_length[100]');
        $this->form_validation->set_rules('kondisi', 'Kondisi', 'required|max_length[100]');

        if ($this->input->post('isWaranty') == "true") {
            $this->form_validation->set_rules('noKartuGaransi', 'No kartu Garansi', 'required|max_length[100]|is_unique[kartu_garansi.noKartuGaransi]');
            $this->form_validation->set_rules('jenisGaransi', 'Jenis Garansi', 'required|max_length[100]');
            $this->form_validation->set_rules('masaGaransi', 'Masa Garansi', 'required|max_length[100]');
        }
        if ($this->input->post('isKendaraan') == "true") {
            $this->form_validation->set_rules('namaStnk', 'Nama Stnk', 'required|max_length[100]');
            $this->form_validation->set_rules('alamatStnk', 'Alamat Stnk', 'required|max_length[100]');
            $this->form_validation->set_rules('peruntukan', 'Peruntukan', 'required|max_length[100]');
        }

        if ($this->form_validation->run()) {
            // var_dump($_POST);
            // die;
            $newInv = getInventaris($this->input->post('departement'));
            $asset = array(
                'productId' => $this->input->post('productId'),
                'noInventaris' => $newInv,
                'ruang' => $this->input->post('ruang'),
                'hargaPerolehan' => str_replace(',', '', $this->input->post('hargaPerolehan')),
                'masaManfaat' => $this->input->post('masaManfaat'),
                'supplier' => $this->input->post('supplier'),
                'pengguna' => $this->input->post('pengguna'),
                'noPo' => $this->input->post('noPo'),
                'statusPerolehan' => $this->input->post('statusPerolehan'),
                'lokasi' => $this->input->post('lokasi'),
                'kondisi' => $this->input->post('kondisi'),
                'isWaranty' => $this->input->post('isWaranty'),
                'createdAt' => date('Y-m-d H:i:s'),
            );
            $relation = [
                [
                    'table' => 'barang',
                    'field' => ['namaBarang'],
                    'pk' => 'id',
                    'valuePk' => view('product', ['id' => $this->input->post('productId')], 'kodeBarang'),
                ]
            ];
            $this->load->library('ciqrcode');
            $config['cacheable']    = true; //boolean, the default is true
            $config['cachedir']     = './assets/'; //string, the default is application/cache/
            $config['errorlog']     = './assets/'; //string, the default is application/logs/
            $config['imagedir']     = './assets/img/'; //direktori penyimpanan qr code
            $config['quality']      = true; //boolean, the default is true
            $config['size']         = '1024'; //interger, the default is 1024
            $config['black']        = array(224, 255, 255); // array, default is array(255,255,255)
            $config['white']        = array(70, 130, 180); // array, default is array(0,0,0)
            $this->ciqrcode->initialize($config);

            $image_name = $newInv . '.png';

            $params['data'] = $newInv;
            $params['level'] = 'H';
            $params['size'] = 10;
            $params['savename'] = FCPATH . $config['imagedir'] . $image_name;
            $this->ciqrcode->generate($params); // fungsi untuk generate QR CODE
            $text = text('Insert', 'kartu_stok_aset', ['namaStnk', 'alamatStnk', 'peruntukan', 'noKartuGaransi', 'jenisGaransi', 'noInventaris', 'masaGaransi', 'ruang', 'hargaPerolehan', 'masaManfaat', 'supplier', 'pengguna', 'noPo', 'statusPerolehan', 'lokasi', 'kondisi', 'isWaranty'], $relation, $_POST, []);
            $noInventaris = $this->Kartu_stok_aset_model->add_kartu_stok_aset($asset, $text);
            if ($this->input->post('isWaranty') == "true" && $this->input->post('noKartuGaransi') != '') {
                $garansi = [
                    'noInventaris' => $newInv,
                    'noKartuGaransi' => $this->input->post('noKartuGaransi'),
                    'jenisGaransi' => $this->input->post('jenisGaransi'),
                    'masaGaransi' => $this->input->post('masaGaransi'),
                    'createdAt' => date('Y-m-d H:i:s'),
                ];
                $this->Kartu_stok_aset_model->add_kartu_garansi($garansi);
            }
            if ($this->input->post('isKendaraan') == "true" && $this->input->post('namaStnk') != '') {
                $kendaraan = [
                    'namaStnk' => $this->input->post('namaStnk'),
                    'alamatStnk' => $this->input->post('alamatStnk'),
                    'peruntukan' => $this->input->post('peruntukan'),
                    'createdAt' => date('Y-m-d H:i:s'),
                    'ksa' => $newInv,
                ];
                $this->Kartu_stok_aset_model->add_ksa_kendaraan($kendaraan);
            }
            if ($this->input->post('isNomor') == "true" && $this->input->post('nama') != '') {
                foreach ($this->input->post('nama') as $i => $n) {
                    $nomor = [
                        'kode' => str_replace(' ', '-', $this->input->post('nama[' . $i . ']')) . str_replace(' ', '-', $this->input->post('nomor[' . $i . ']')),
                        'nama' => $this->input->post('nama[' . $i . ']'),
                        'nomor' => $this->input->post('nomor[' . $i . ']'),
                        'createdAt' => date('Y-m-d H:i:s'),
                        'ksa' => $newInv,
                    ];
                    $this->Kartu_stok_aset_model->add_ksa_nomor($nomor);
                }
            }
            if ($noInventaris) {
                alert('success', 'Berhasil...', 'Berhasil menambahkan data');
            } else {
                alert('error', 'Gagal...', 'Gagal menambahkan data');
            }
            redirect('kartu_stok_aset/index');
        } else {
            $data['produk'] = $this->Produk_model->get_all_produk_asset();
            $data['_view'] = 'guest/kartu_stok_aset/add';
            $this->load->view('guest/layouts/main', $data);
        }
    }
    function edit($id)
    {
        $data['kartu_stok_aset'] = $this->Kartu_stok_aset_model->get_kartu_stok_aset($id);
        $data['kartu_garansi'] = $this->Kartu_stok_aset_model->get_kartu_garansi($id);
        $data['ksa_nomor'] = $this->Kartu_stok_aset_model->get_ksa_nomor($id);
        $data['ksa_kendaraan'] = $this->Kartu_stok_aset_model->get_ksa_kendaraan($id);
        if (isset($data['kartu_stok_aset']['noInventaris'])) {
            $this->load->library('form_validation');
            $da = array_merge((isset($data['kartu_stok_aset'])) ? $data['kartu_stok_aset'] : [], (isset($data['kartu_garansi'])) ? $data['kartu_garansi'] : [], (isset($data['ksa_kendaraan'])) ? $data['ksa_kendaraan'] : []);
            $this->form_validation->set_rules('productId', 'Produk', 'required|max_length[100]');
            $this->form_validation->set_rules('noInventaris', 'No Inventaris', 'required|max_length[100]');
            $this->form_validation->set_rules('ruang', 'Ruang', 'required|max_length[100]');
            $this->form_validation->set_rules('hargaPerolehan', 'Harga perlolehan', 'required|max_length[100]');
            $this->form_validation->set_rules('masaManfaat', 'Masa manfaat', 'required|max_length[100]');
            $this->form_validation->set_rules('supplier', 'Supplier', 'required|max_length[100]');
            $this->form_validation->set_rules('pengguna', 'Pengunaa', 'required|max_length[100]');
            $this->form_validation->set_rules('noPo', 'No PO', 'required|max_length[100]');
            $this->form_validation->set_rules('statusPerolehan', 'Status perolehan', 'required|max_length[100]');
            $this->form_validation->set_rules('lokasi', 'Lokasi', 'required|max_length[100]');
            $this->form_validation->set_rules('kondisi', 'Kondisi', 'required|max_length[100]');

            if ($this->input->post('isWaranty') == "true") {
                $this->form_validation->set_rules('noKartuGaransi', 'No kartu Garansi', 'required|max_length[100]');
                $this->form_validation->set_rules('jenisGaransi', 'Jenis Garansi', 'required|max_length[100]');
                $this->form_validation->set_rules('masaGaransi', 'Masa Garansi', 'required|max_length[100]');
            }
            if ($this->input->post('isKendaraan') == "true") {
                $this->form_validation->set_rules('namaStnk', 'Nama Stnk', 'required|max_length[100]');
                $this->form_validation->set_rules('alamatStnk', 'Alamat Stnk', 'required|max_length[100]');
                $this->form_validation->set_rules('peruntukan', 'Peruntukan', 'required|max_length[100]');
            }

            if ($this->form_validation->run()) {
                // var_dump($_POST);
                // die;
                $asset = array(
                    'productId' => $this->input->post('productId'),
                    'noInventaris' => $this->input->post('noInventaris'),
                    'ruang' => $this->input->post('ruang'),
                    'hargaPerolehan' => str_replace(',', '', $this->input->post('hargaPerolehan')),
                    'masaManfaat' => $this->input->post('masaManfaat'),
                    'supplier' => $this->input->post('supplier'),
                    'pengguna' => $this->input->post('pengguna'),
                    'noPo' => $this->input->post('noPo'),
                    'statusPerolehan' => $this->input->post('statusPerolehan'),
                    'lokasi' => $this->input->post('lokasi'),
                    'kondisi' => $this->input->post('kondisi'),
                    'isWaranty' => $this->input->post('isWaranty'),
                    'updatedAt' => date('Y-m-d H:i:s'),
                );
                $relation = [
                    [
                        'table' => 'barang',
                        'field' => ['namaBarang'],
                        'pk' => 'id',
                        'valuePk' => view('product', ['id' => $this->input->post('productId')], 'kodeBarang'),
                    ]
                ];
                $text = text('Update', 'kartu_stok_aset', ['namaStnk', 'alamatStnk', 'peruntukan', 'noKartuGaransi', 'jenisGaransi', 'noInventaris', 'masaGaransi', 'ruang', 'hargaPerolehan', 'masaManfaat', 'supplier', 'pengguna', 'noPo', 'statusPerolehan', 'lokasi', 'kondisi', 'isWaranty'], $relation, $da, $_POST);
                $noInventaris = $this->Kartu_stok_aset_model->update_kartu_stok_aset($id, $asset, $text);
                if ($data['kartu_garansi'] != null) {
                    if ($this->input->post('isWaranty') == "true" && $this->input->post('noKartuGaransi') != '') {
                        $garansi = [
                            'noInventaris' => $this->input->post('noInventaris'),
                            'noKartuGaransi' => $this->input->post('noKartuGaransi'),
                            'jenisGaransi' => $this->input->post('jenisGaransi'),
                            'masaGaransi' => $this->input->post('masaGaransi'),
                            'updatedAt' => date('Y-m-d H:i:s'),
                        ];
                        $this->Kartu_stok_aset_model->update_kartu_garansi($id, $garansi);
                    } else {
                        $this->db->where(['noInventaris' => $this->input->post('noInventaris')]);
                        $this->db->delete('kartu_garansi');
                    }
                } else {
                    if ($this->input->post('isWaranty') == "true" && $this->input->post('noKartuGaransi') != '') {
                        $garansi = [
                            'noInventaris' => $this->input->post('noInventaris'),
                            'noKartuGaransi' => $this->input->post('noKartuGaransi'),
                            'jenisGaransi' => $this->input->post('jenisGaransi'),
                            'masaGaransi' => $this->input->post('masaGaransi'),
                            'createdAt' => date('Y-m-d H:i:s'),
                        ];
                        $this->Kartu_stok_aset_model->add_kartu_garansi($garansi);
                    }
                }
                if ($data['ksa_kendaraan'] != null) {
                    if ($this->input->post('isKendaraan') == "true" && $this->input->post('namaStnk') != '') {
                        $kendaraan = [
                            'namaStnk' => $this->input->post('namaStnk'),
                            'alamatStnk' => $this->input->post('alamatStnk'),
                            'peruntukan' => $this->input->post('peruntukan'),
                            'updatedAt' => date('Y-m-d H:i:s'),
                            'ksa' => $this->input->post('noInventaris'),
                        ];
                        $this->Kartu_stok_aset_model->update_ksa_kendaraan($id, $kendaraan);
                    } else {
                        $this->db->where(['ksa' => $this->input->post('noInventaris')]);
                        $this->db->delete('ksa_kendaraan');
                    }
                } else {
                    if ($this->input->post('isKendaraan') == "true" && $this->input->post('namaStnk') != '') {
                        $kendaraan = [
                            'namaStnk' => $this->input->post('namaStnk'),
                            'alamatStnk' => $this->input->post('alamatStnk'),
                            'peruntukan' => $this->input->post('peruntukan'),
                            'createdAt' => date('Y-m-d H:i:s'),
                            'ksa' => $this->input->post('noInventaris'),
                        ];
                        $this->Kartu_stok_aset_model->add_ksa_kendaraan($kendaraan);
                    }
                }
                if ($data['ksa_nomor'] != null) {
                    if ($this->input->post('isNomor') == "true" && $this->input->post('nama') != '') {
                        foreach ($this->input->post('nama') as $i => $n) {
                            if ($this->input->post('kode[' . $i . ']') != null) {
                                $nomor = [
                                    'kode' => $this->input->post('kode[' . $i . ']'),
                                    'nama' => $this->input->post('nama[' . $i . ']'),
                                    'nomor' => $this->input->post('nomor[' . $i . ']'),
                                    'updatedAt' => date('Y-m-d H:i:s'),
                                    'ksa' => $this->input->post('noInventaris'),
                                ];
                                $this->Kartu_stok_aset_model->update_ksa_nomor($this->input->post('kode[' . $i . ']'), $nomor);
                            } else {
                                $nomor = [
                                    'kode' => str_replace(' ', '-', $this->input->post('nama[' . $i . ']')) . str_replace(' ', '-', $this->input->post('nomor[' . $i . ']')),
                                    'nama' => $this->input->post('nama[' . $i . ']'),
                                    'nomor' => $this->input->post('nomor[' . $i . ']'),
                                    'createdAt' => date('Y-m-d H:i:s'),
                                    'ksa' => $this->input->post('noInventaris'),
                                ];
                                $this->Kartu_stok_aset_model->add_ksa_nomor($nomor);
                            }
                        }
                    } else {
                        $this->db->where(['ksa' => $this->input->post('noInventaris')]);
                        $this->db->delete('ksa_nomor');
                    }
                } else {
                    if ($this->input->post('isNomor') == "true" && $this->input->post('nama') != '') {
                        foreach ($this->input->post('nama') as $i => $n) {
                            $nomor = [
                                'kode' => str_replace(' ', '-', $this->input->post('nama[' . $i . ']')) . str_replace(' ', '-', $this->input->post('nomor[' . $i . ']')),
                                'nama' => $this->input->post('nama[' . $i . ']'),
                                'nomor' => $this->input->post('nomor[' . $i . ']'),
                                'createdAt' => date('Y-m-d H:i:s'),
                                'ksa' => $this->input->post('noInventaris'),
                            ];
                            $this->Kartu_stok_aset_model->add_ksa_nomor($nomor);
                        }
                    }
                }
                if ($noInventaris) {
                    alert('success', 'Berhasil...', 'Berhasil merubah data');
                } else {
                    alert('error', 'Gagal...', 'Gagal merubah data');
                }
                redirect('kartu_stok_aset/index');
            } else {
                $data['produk'] = $this->Produk_model->get_all_produk_();
                $data['_view'] = 'guest/kartu_stok_aset/edit';
                $this->load->view('guest/layouts/main', $data);
            }
        } else
            show_error('The kartu_stok_aset you are trying to edit does not exist.');
    }
    function remove($id)
    {
        $kartu_stok_aset = $this->Kartu_stok_aset_model->get_kartu_stok_aset($id);
        if (isset($kartu_stok_aset['noInventaris'])) {
            $cekGaransi = $this->Global_model->get_data('kartu_garansi', ['noInventaris' => $kartu_stok_aset['noInventaris']], false);
            $cekKendaraan = $this->Global_model->get_data('ksa_kendaraan', ['ksa' => $kartu_stok_aset['noInventaris']], false);
            $cekNomor = $this->Global_model->get_data('ksa_nomor', ['ksa' => $kartu_stok_aset['noInventaris']], false);
            $da = array_merge($kartu_stok_aset, $cekGaransi, $cekKendaraan);

            if ($cekGaransi != null) {
                $this->db->where(['noInventaris' => $id]);
                $delGaransi = $this->db->delete('kartu_garansi');
            }
            if ($cekKendaraan != null) {
                $this->db->where(['ksa' => $id]);
                $delKendaraan = $this->db->delete('ksa_kendaraan');
            }
            if ($cekNomor != null) {
                $this->db->where(['ksa' => $id]);
                $delNomor = $this->db->delete('ksa_nomor');
            }
            $text = text('Insert', 'kartu_stok_aset', ['namaStnk', 'alamatStnk', 'peruntukan', 'noKartuGaransi', 'jenisGaransi', 'noInventaris', 'masaGaransi', 'ruang', 'hargaPerolehan', 'masaManfaat', 'supplier', 'pengguna', 'noPo', 'statusPerolehan', 'lokasi', 'kondisi', 'isWaranty'], [], $da, []);

            $del = $this->Kartu_stok_aset_model->delete_kartu_stok_aset($id, $text);

            if ($del) {
                alert('success', 'Berhasil...', 'Berhasil menghapus data');
            } else {
                alert('error', 'Gagal...', 'Gagal menghapus data');
            }
            redirect('kartu_stok_aset/index');
            die;
        } else {
            alert('error', 'Gagal...', 'Data yang ingin dihapus tidak ditemukan');
            redirect('kartu_stok_aset/index');
            die;
        }
    }
    function hapusnomor($noInv, $kode)
    {
        $cek = $this->db->get_where('ksa_nomor', ['ksa' => $noInv, 'kode' => $kode])->row_array();
        if ($cek) {
            $this->db->where(['ksa' => $noInv, 'kode' => $kode]);
            $this->db->delete('ksa_nomor');
            alert('success', 'Berhasil...', 'Berhasil menghapus data');
            redirect('kartu_stok_aset/edit/' . $noInv);
        } else {
            alert('error', 'Gagal...', 'Data yang ingin dihapus tidak ditemukan');
            redirect('kartu_stok_aset/edit/' . $noInv);
        }
    }
}
