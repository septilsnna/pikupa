<?php

namespace App\Controllers;

date_default_timezone_set("Asia/Bangkok");

use App\Models\OrdersModel;
use App\Models\ProductsModel;
use App\Models\PortofoliosModel;
use App\Models\PromotionsModel;
use App\Models\UsersModel;

class ConfigAdmin extends BaseController
{
    protected $ordersModel;
    protected $productsModel;
    protected $portofoliosModel;
    protected $promotionsModel;
    protected $usersModel;

    public function __construct()
    {
        $this->ordersModel = new OrdersModel();
        $this->productsModel = new ProductsModel();
        $this->portofoliosModel = new PortofoliosModel();
        $this->promotionsModel = new PromotionsModel();
        $this->usersModel = new UsersModel();
        $this->email = \Config\Services::email();
    }

    public function reject($id)
    {
        $param = $this->ordersModel->where('id', $id)->findAll();

        $this->ordersModel
            ->where('id', $id)
            ->set(['status' => 'Rejected'])
            ->update();

        $this->email->setFrom('pikuupa@gmail.com', 'Pikupa.id');
        $this->email->setTo($param[0]['email_user']);
        $this->email->setSubject('Pesanan Ditolak :(');
        $this->email->setMessage('<div style="font-family: Montserrat; text-align: center; padding-top: 50px; padding-bottom: 50px; font-size: 18px; color: #424242;">
            <h3>Mohon Maaf, Pesanan Kamu Ditolak :(</h3>
            <p>Hai Kak ' . $param[0]['nama_user'] . ',</p>
            <p>
              Pesanan kakak berupa ' . $param[0]['product_name'] . ' dengan kode pemesanan ' . $id . ' ditolak. Piku memohon maaf atas ketidaknyamanan ini, setelah dilakukan pengecekan, pemesanan kakak belum memenuhi persyaratan kami. Tetapi tenang saja, kakak dapat memesan kembali di website Pikupa.id.
            </p>
            <h5>Terimakasih telah mempercayai Pikupa.id, Piku tunggu pesanan kakak selanjutnya!</h5>
          </div>');
        $this->email->send();

        return redirect()->to('../Admin/orders');
    }

    public function process($id)
    {
        $param = $this->ordersModel->where('id', $id)->findAll();

        $this->ordersModel
            ->where('id', $id)
            ->set(['status' => 'Process'])
            ->update();

        $this->email->setFrom('pikuupa@gmail.com', 'Pikupa.id');
        $this->email->setTo($param[0]['email_user']);
        $this->email->setSubject('Pesanan Diproses!');
        $this->email->setMessage('<div style="font-family: Montserrat; text-align: center; padding-top: 50px; padding-bottom: 50px; font-size: 18px; color: #424242;">
        <h3>Pesanan Kamu Sedang Diproses!</h3>
        <p>Hai Kak ' . $param[0]['nama_user'] . ',</p>
        <p>
          Pesanan kakak berupa ' . $param[0]['product_name'] . ' dengan kode pemesanan ' . $id . ' sedang diproses, dalam beberapa waktu kedepan pantau terus ' . $param[0]['contact_method'] . ' kakak ya, editor kami akan menghubungi kakak secepatnya.
        </p>
        <h5>Terimakasih telah mempercayai Pikupa.id, Piku tunggu pesanan kakak selanjutnya!</h5>
      </div>');
        $this->email->send();

        return redirect()->to('../Admin/orders');
    }

    public function finish($id)
    {
        $param = $this->ordersModel->where('id', $id)->findAll();

        $this->ordersModel
            ->where('id', $id)
            ->set(['status' => 'Finish'])
            ->update();

        $sold = $this->productsModel->where('id', $param[0]['product_id'])->findAll();

        $this->productsModel
            ->where('id', $param[0]['product_id'])
            ->set(['sold' => (int)$sold[0]['sold'] + 1])
            ->update();

        $order_freq = $this->usersModel->where('id', $param[0]['user_id'])->findAll();

        $this->usersModel
            ->where('id', $param[0]['user_id'])
            ->set(['order_freq' => (int)$order_freq[0]['order_freq'] + 1])
            ->update();

        $this->email->setFrom('pikuupa@gmail.com', 'Pikupa.id');
        $this->email->setTo($param[0]['email_user']);
        $this->email->setSubject('Pesanan Selesai!');
        $this->email->setMessage('<div style="font-family: Montserrat; text-align: center; padding-top: 50px; padding-bottom: 50px; font-size: 18px; color: #424242;">
        <h3>Pesanan Kamu Telah Selesai!</h3>
        <p>Hai Kak ' . $param[0]['nama_user'] . ',</p>
        <p>
          Pesanan kakak berupa ' . $param[0]['product_name'] . ' dengan kode pemesanan ' . $id . ' telah selesai.
        </p>
        <h5>Terimakasih telah mempercayai Pikupa.id, Piku tunggu pesanan kakak selanjutnya!</h5>
      </div>');
        $this->email->send();

        return redirect()->to('../Admin/orders');
    }

    public function edit_product($param)
    {
        $data = [
            'stock' => $this->request->getVar('stock'),
            'price' => $this->request->getVar('price'),
            'discount' => $this->request->getVar('discount')
        ];

        $this->productsModel
            ->where('id', $param)
            ->set($data)
            ->update();

        return redirect()->to('../Admin/manage_product');
    }

    public function add_portofolios()
    {
        $file = $this->request->getFile('file');            // ambil file bukti bayar
        $nama = $file->getRandomName();                     // generate nama random
        $note = $this->request->getVar('note');
        $file->move($note, $nama);                          // pindahkan ke folder note

        $data = [
            'category' => $this->request->getVar('category'),
            'file' => $nama,
            'note' => $note
        ];

        $this->portofoliosModel->insert($data);

        return redirect()->to('../Admin/manage_portofolios');
    }

    public function inactivated($id)
    {
        $this->promotionsModel
            ->where('id', $id)
            ->set(['status' => 'inactive'])
            ->update();

        return redirect()->to('../Admin/promotions');
    }

    public function add_promotions()
    {
        $file = $this->request->getFile('promotion');     // ambil file bukti bayar
        $nama = $file->getRandomName();                   // generate nama random
        $file->move('promotions', $nama);                 // pindahkan ke folder promotions

        $data = [
            'title' => $this->request->getVar('title'),
            'file' => $nama,
            'price' => $this->request->getVar('price'),
            'status' => 'active'
        ];

        $this->promotionsModel->insert($data);

        return redirect()->to('../Admin/promotions');
    }

    //--------------------------------------------------------------------

}