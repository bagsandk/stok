<?php
class Kartu_stok_non_aset extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('isLogIn') != true) {
            redirect('auth/logout');
        }
        $this->load->model('Kartu_stok_non_aset_model');
        $this->load->model('Barang_model');
        $this->load->model('Produk_model');
        $this->load->model('Global_model');
    }
    function index()
    {
        $data['kartu_stok_non_aset_'] = $this->Kartu_stok_non_aset_model->get_all_kartu_stok_non_aset_();
        $data['_view'] = 'guest/kartu_stok_non_aset/index';
        $this->load->view('guest/layouts/main', $data);
    }
    function add()
    {
        $this->load->library('form_validation');
        $this->load->library('ciqrcode');
        $this->form_validation->set_rules('productId', 'Produk', 'required|max_length[100]');

        $this->form_validation->set_rules('lokasiGudang', 'Lokasi Gedung', 'required|max_length[100]');
        $this->form_validation->set_rules('lokasiRak', 'Lokasi Rak', 'required|max_length[100]');
        $this->form_validation->set_rules('jumlahStok', 'Jumlah Stok', 'required|max_length[100]');
        $this->form_validation->set_rules('hargaRerata', 'Harga Rerata', 'required|max_length[100]');
        $this->form_validation->set_rules('saldoMin', 'Minimal Saldo', 'required|max_length[100]');

        if ($this->form_validation->run()) {
            $params = array(
                'lokasiGudang' => $this->input->post('lokasiGudang'),
                'lokasiRak' => $this->input->post('lokasiRak'),
                'satuan' => view('product', ['id' => $this->input->post('productId')], 'satuan'),
                'jumlahStok' => $this->input->post('jumlahStok'),
                'hargaRerata' => $this->input->post('hargaRerata'),
                'saldoMin' => $this->input->post('saldoMin'),
                'createdAt' => date('Y-m-d H:i:s'),
                'updatedAt' => date('Y-m-d H:i:s'),
                'productId' => $this->input->post('productId'),
            );
            $relation = [
                [
                    'table' => 'product',
                    'field' => ['nama'],
                    'pk' => 'id',
                    'valuePk' => view('product', ['id' => $this->input->post('productId')], 'kodeBarang'),
                ]
            ];
            $text = text('Insert', 'kartu_stok_non_aset', ['lokasiGudang', 'lokasiRak', 'satuan', 'jumlahStok', 'hargaRerata', 'saldoMin'], $relation, $_POST, []);
            // var_dump($_POST);
            // die;

            $in = $this->Kartu_stok_non_aset_model->add_kartu_stok_non_aset($params, $text);
            if ($in) {
                alert('success', 'Berhasil...', 'Berhasil menambahkan data');
            } else {
                alert('error', 'Gagal...', 'Gagal menambahkan data');
            }
            redirect('kartu_stok_non_aset/index');
        } else {
            $data['produk'] = $this->Produk_model->get_all_produk_non_asset();
            $data['_view'] = 'guest/kartu_stok_non_aset/add';
            $this->load->view('guest/layouts/main', $data);
        }
    }
    function edit($id)
    {
        $data['kartu_stok_non_aset'] = $this->Kartu_stok_non_aset_model->get_kartu_stok_non_aset($id);
        if (isset($data['kartu_stok_non_aset']['id'])) {
            $da = $this->db->join('product', 'product.id=kartu_stok_non_aset.productId')->get_where('kartu_stok_non_aset', ['kartu_stok_non_aset.id' => $id])->row_array();
            $this->load->library('form_validation');
            $this->form_validation->set_rules('productId', 'Produk', 'required|max_length[100]');

            $this->form_validation->set_rules('lokasiGudang', 'Lokasi Gedung', 'required|max_length[100]');
            $this->form_validation->set_rules('lokasiRak', 'Lokasi Rak', 'required|max_length[100]');
            $this->form_validation->set_rules('jumlahStok', 'Jumlah Stok', 'required|max_length[100]');
            $this->form_validation->set_rules('hargaRerata', 'Harga Rerata', 'required|max_length[100]');
            $this->form_validation->set_rules('saldoMin', 'Minimal Saldo', 'required|max_length[100]');
            if ($this->form_validation->run()) {

                $params = array(
                    'lokasiGudang' => $this->input->post('lokasiGudang'),
                    'lokasiRak' => $this->input->post('lokasiRak'),
                    'satuan' => view('product', ['id' => $this->input->post('productId')], 'satuan'),
                    'jumlahStok' => $this->input->post('jumlahStok'),
                    'hargaRerata' => $this->input->post('hargaRerata'),
                    'saldoMin' => $this->input->post('saldoMin'),
                    'createdAt' => date('Y-m-d H:i:s'),
                    'updatedAt' => date('Y-m-d H:i:s'),
                    'productId' => $this->input->post('productId'),
                );
                $relation = [
                    [
                        'table' => 'product',
                        'field' => ['nama'],
                        'pk' => 'id',
                        'valuePk' => view('product', ['id' => $this->input->post('productId')], 'kodeBarang'),
                    ]
                ];
                $text = text('Update', 'kartu_stok_non_aset', ['lokasiGudang', 'lokasiRak', 'satuan', 'jumlahStok', 'hargaRerata', 'saldoMin'], $relation, $da, $_POST);
                if ($text != '') {
                    $barang_id = $this->Kartu_stok_non_aset_model->update_kartu_stok_non_aset($id, $params, $text);
                    if ($barang_id) {
                        alert('success', 'Berhasil...', 'Berhasil mengubah data');
                    } else {
                        alert('error', 'Gagal...', 'Gagal mengubah data');
                    }
                } else {
                    alert('info', 'Ubah ?', 'Tidak ada data yang diubah');
                }
                redirect('kartu_stok_non_aset/index');
            } else {
                $data['produk'] = $this->Produk_model->get_all_produk_non_asset();

                $data['_view'] = 'guest/kartu_stok_non_aset/edit';
                $this->load->view('guest/layouts/main', $data);
            }
        } else {
            alert('error', 'Gagal...', 'Data yang ingin diubah tidak ditemukan');
            redirect('barang/index');
            die;
        }
    }
    function remove($id)
    {
        $kartu_stok_non_aset = $this->Kartu_stok_non_aset_model->get_kartu_stok_non_aset($id);
        if (isset($kartu_stok_non_aset['id'])) {
            $cek = $this->Global_model->get_data('product', ['id' => $kartu_stok_non_aset['productId']], false);
            if ($cek != null) {
                $da = $this->db->join('product', 'product.id=kartu_stok_non_aset.productId')->get_where('kartu_stok_non_aset', ['kartu_stok_non_aset.id' => $id])->row_array();

                $text = text('Delete', 'kartu_stok_non_aset', ['nama', 'gambar', 'merek', 'satuan', 'deskripsi', 'lokasiGudang', 'lokasiRak', 'satuan', 'jumlahStok', 'hargaRerata', 'saldoMin'], [], $da, []);
                $barang_id = $this->Kartu_stok_non_aset_model->delete_kartu_stok_non_aset($id, $text);
                $product_id = $this->Kartu_stok_non_aset_model->delete_produk($kartu_stok_non_aset['productId']);
                if ($barang_id && $product_id) {
                    alert('success', 'Berhasil...', 'Berhasil menghapus data');
                } else {
                    alert('error', 'Gagal...', 'Gagal menghapus data');
                }
                redirect('kartu_stok_non_aset/index');
                die;
            } else {
                alert('error', 'Gagal...', 'Data yamg ingin dihapus tidak ditemukan');
                redirect('kartu_stok_non_aset/index');
                die;
            }
            redirect('kartu_stok_non_aset/index');
        } else {
            alert('error', 'Gagal...', 'Data yang ingin dihapus tidak ditemukan');
            redirect('kartu_stok_non_aset/index');
            die;
        }
    }
}
