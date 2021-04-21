<?php
class Kartu_stok_aset extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
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
        $this->form_validation->set_rules('noInventaris', 'No Inventaris', 'required|max_length[100]|is_unique[kartu_stok_aset.noInventaris]');
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
            $asset = array(
                'productId' => $this->input->post('productId'),
                'noInventaris' => $this->input->post('noInventaris'),
                'ruang' => $this->input->post('ruang'),
                'hargaPerolehan' => $this->input->post('hargaPerolehan'),
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
            $noInventaris = $this->Kartu_stok_aset_model->add_kartu_stok_aset($asset);
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
            if ($noInventaris) {
                alert('success', 'Berhasil...', 'Berhasil menambahkan data');
            } else {
                alert('error', 'Gagal...', 'Gagal menambahkan data');
            }
            redirect('kartu_stok_aset/index');
        } else {
            $data['produk'] = $this->Produk_model->get_all_produk_();
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
                    'hargaPerolehan' => $this->input->post('hargaPerolehan'),
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
                $noInventaris = $this->Kartu_stok_aset_model->update_kartu_stok_aset($id, $asset);
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
            $del = $this->Kartu_stok_aset_model->delete_kartu_stok_aset($id);

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
