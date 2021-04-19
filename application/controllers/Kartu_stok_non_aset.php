<?php
class Kartu_stok_non_aset extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Kartu_stok_non_aset_model');
        $this->load->model('Barang_model');
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
        $this->form_validation->set_rules('nama', 'Nama produk', 'required|max_length[100]');
        $this->form_validation->set_rules('merek', 'Merek', 'required|max_length[100]');
        $this->form_validation->set_rules('satuan', 'Satuan', 'required|max_length[100]');
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required|max_length[100]');
        $this->form_validation->set_rules('kodeBarang', 'Kode Barang', 'required|max_length[100]');
        $this->form_validation->set_rules('lokasiGudang', 'Lokasi Gedung', 'required|max_length[100]');
        $this->form_validation->set_rules('lokasiRak', 'Lokasi Rak', 'required|max_length[100]');
        $this->form_validation->set_rules('jumlahStok', 'Jumlah Stok', 'required|max_length[100]');
        $this->form_validation->set_rules('hargaRerata', 'Harga Rerata', 'required|max_length[100]');
        $this->form_validation->set_rules('saldoMin', 'Minimal Saldo', 'required|max_length[100]');

        if ($this->form_validation->run()) {
            $params0 = array(
                'nama' => $this->input->post('nama'),
                'merek' => $this->input->post('merek'),
                'satuan' => $this->input->post('satuan'),
                'deskripsi' => $this->input->post('deskripsi'),
                'gambar' => '-',
                'createdAt' => date('Y-m-d H:i:s'),
                'updatedAt' => date('Y-m-d H:i:s'),
                'kodeBarang' => $this->input->post('kodeBarang'),
            );
            $produk_id = $this->Produk_model->add_produk($params0);
            $params = array(
                'lokasiGudang' => $this->input->post('lokasiGudang'),
                'lokasiRak' => $this->input->post('lokasiRak'),
                'satuan' => $this->input->post('satuan'),
                'jumlahStok' => $this->input->post('jumlahStok'),
                'hargaRerata' => $this->input->post('hargaRerata'),
                'saldoMin' => $this->input->post('saldoMin'),
                'createdAt' => date('Y-m-d H:i:s'),
                'updatedAt' => date('Y-m-d H:i:s'),
                'productId' => $produk_id,
            );
            $in = $this->Kartu_stok_non_aset_model->add_kartu_stok_non_aset($params);
            if ($in) {
                alert('success', 'Berhasil...', 'Berhasil menambahkan data');
            } else {
                alert('error', 'Gagal...', 'Gagal menambahkan data');
            }
            redirect('kartu_stok_non_aset/index');
        } else {
            $data['barang'] = $this->Barang_model->get_all_barang_();
            $data['_view'] = 'guest/kartu_stok_non_aset/add';
            $this->load->view('guest/layouts/main', $data);
        }
    }
    function edit($id)
    {
        $data['kartu_stok_non_aset'] = $this->Kartu_stok_non_aset_model->get_kartu_stok_non_aset($id);
        if (isset($data['produk_kendaraan']['id'])) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('nama', 'Nama produk', 'required|max_length[100]');
            $this->form_validation->set_rules('merek', 'Merek', 'required|max_length[100]');
            $this->form_validation->set_rules('satuan', 'Satuan', 'required|max_length[100]');
            $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required|max_length[100]');
            $this->form_validation->set_rules('kodeBarang', 'Kode Barang', 'required|max_length[100]');
            $this->form_validation->set_rules('tipe', 'Tipe kendaraan', 'required|max_length[100]');
            $this->form_validation->set_rules('bahanBakar', 'Bahan bakar', 'required|max_length[100]');
            $this->form_validation->set_rules('thPembuatan', 'Tahun Pembuatan', 'required|max_length[100]');
            $this->form_validation->set_rules('warna', 'Warna', 'required|max_length[100]');
            $this->form_validation->set_rules('hp', 'HP', 'required|max_length[100]');
            if ($this->form_validation->run()) {
                $params0 = array(
                    'nama' => $this->input->post('nama'),
                    'merek' => $this->input->post('merek'),
                    'satuan' => $this->input->post('satuan'),
                    'deskripsi' => $this->input->post('deskripsi'),
                    'gambar' => '-',
                    'updatedAt' => date('Y-m-d H:i:s'),
                    'kodeBarang' => $this->input->post('kodeBarang'),
                );
                $this->Produk_model->update_produk($data['produk_kendaraan']['productId'], $params0);
                $params = array(
                    'tipe' => $this->input->post('tipe'),
                    'bahanBakar' => $this->input->post('bahanBakar'),
                    'thPembuatan' => $this->input->post('thPembuatan'),
                    'warna' => $this->input->post('warna'),
                    'hp' => $this->input->post('hp'),
                    'updatedAt' => date('Y-m-d H:i:s'),
                );
                $this->Produk_kendaraan_model->update_produk_kendaraan($id, $params);
                redirect('kartu_stok_non_aset/index');
            } else {
                $data['barang'] = $this->Barang_model->get_all_barang_();
                $data['_view'] = 'administrator/produk_kendaraan/edit';
                $this->load->view('administrator/layouts/main', $data);
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
                $barang_id = $this->Kartu_stok_non_aset_model->delete_kartu_stok_non_aset($id);
                $product_id = $this->Produk_model->delete_produk($kartu_stok_non_aset['productId']);
                if ($barang_id && $product_id) {
                    alert('success', 'Berhasil...', 'Berhasil menghapus data');
                } else {
                    alert('error', 'Gagal...', 'Gagal menghapus data');
                }
                redirect('barang/index');
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
