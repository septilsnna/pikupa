<?php

namespace App\Controllers;

use App\Models\UsersModel;

class register extends BaseController
{
    protected $usersModel;

    public function __construct()
    {
        $this->usersModel = new UsersModel();
        $this->email = \Config\Services::email();
        $this->session = \Config\Services::session();
    }

    public function index()
    {
        if (isset($_SESSION['user_id'])) {
            return redirect()->to('../home/index');    // users	no
        } else {
            // twitter regist
            if ($this->request->getVar('oauth_token')) {
                $curl = curl_init();

                curl_setopt_array($curl, array(
                    CURLOPT_URL => "https://api.twitter.com/oauth/access_token?oauth_token=" . $_GET['oauth_token'] . "&oauth_verifier=" . $_GET['oauth_verifier'],
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "POST",
                    CURLOPT_HTTPHEADER => array(
                        "Authorization: Basic aTlhSFpHTWpsNkU2enBwcXRxUkZ4TTB2bzpIbTFEOWpQTE5ldURCdWw0MlkxSnE3RTNIemxKUkxtUHluU1dOZDFISklDM0h5SXNjUQ==",
                        "Cookie: personalization_id=\"v1_9nBKuf8pExBpNAYb7r2big==\"; guest_id=v1%3A160200759231788104; lang=en"
                    ),
                ));

                $response = curl_exec($curl);
                $satu = explode('&', $response);
                $oat = explode('=', $satu[0]);
                // var_dump($satu);

                curl_setopt_array($curl, array(
                    CURLOPT_URL => "https://api.twitter.com/1.1/account/verify_credentials.json?include_email=true&include_entities=false&skip_status=true",
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "GET",
                    CURLOPT_HTTPHEADER => array(
                        "Authorization: OAuth oauth_consumer_key=\"i9aHZGMjl6E6zppqtqRFxM0vo\",oauth_token=\"" . $oat[1] . "\",oauth_signature_method=\"HMAC-SHA1\",oauth_timestamp=\"1602494434\",oauth_nonce=\"KidyiSpXQh2\",oauth_version=\"1.0\",oauth_callback=\"http%3A%2F%2F127.0.0.1%3A8080%2Fregister%2Findex\",oauth_signature=\"zBfx6Rxz%2FmnrBdzNPoze5X0iep8%3D\"",
                        "Cookie: personalization_id=\"v1_9nBKuf8pExBpNAYb7r2big==\"; guest_id=v1%3A160200759231788104; lang=en"
                    ),
                ));

                $response2 = curl_exec($curl);

                curl_close($curl);
                $dua = json_decode($response2, true);
                var_dump($dua['screen_name']);
                var_dump($dua['email']);

                $user_lama = $this->usersModel->where('id', $dua['screen_name'])->findAll();

                if ($user_lama == null) {
                    if ($dua['email'] == null) {
                        $email = '';
                        $verified = false;
                    } else {
                        $email = $dua['email'];
                        $verified = true;
                    }
                    $new_user = [
                        'id' => $dua['screen_name'],
                        'name' => $dua['screen_name'],
                        'email' => $email,
                        'verified' => $verified,
                        'regist_via' => 'twitter'
                    ];

                    $this->usersModel->insert($new_user);
                }
                $_SESSION['user_id'] = $dua['screen_name'];
                return redirect()->to(base_url() . '/home/index');
            }

            // google regist
            require_once APPPATH . 'Libraries/vendor/autoload.php';
            $google_client = new \Google_Client();
            $google_client->setClientId('444339106683-9n10h1ec88b2hmq5s1mqqct0n7uuvc05.apps.googleusercontent.com');
            $google_client->setClientSecret('2u4vDmBA09GlnlhtXAApOzt_');
            $google_client->setRedirectUri(base_url() . '/register/index');
            $google_client->addScope('email');
            $google_client->addScope('profile');
            $google_client->createAuthUrl();

            if ($this->request->getvar('code')) {
                $token = $google_client->fetchAccessTokenWithAuthCode($this->request->getvar('code'));
                if (!isset($token['error'])) {
                    $google_client->setAccessToken($token);
                    $this->session->set('access_token', $token['access_token']);

                    // ambil data user dari akun google
                    $google_service = new \Google_Service_Oauth2($google_client);
                    $data_user = $google_service->userinfo->get();
                    $data_user = (array) $data_user;
                    $uid = explode('@', $data_user['email']);

                    $users = $this->usersModel->where('email', $data_user['email'])->findAll();
                    if ($users) {
                        $_SESSION['user_id'] = $users[0]['id'];
                        return redirect()->to(base_url() . '/home/index');
                    } else {
                        $newuser = [
                            'id' => $uid[0],
                            'name' => $data_user['name'],
                            'email' => $data_user['email'],
                            'token' => $data_user['email'],
                            'verified' => $data_user['verifiedEmail'],
                            'regist_via' => 'google'
                        ];
                        $this->usersModel->insert($newuser);
                        $_SESSION['user_id'] = $uid[0];
                        return redirect()->to(base_url() . '/home/index');
                    }
                }
            }

            $data['googleRegist'] = $google_client->createAuthUrl();
            $data['validation'] = \Config\Services::validation();
            return view('guests/register', $data);    // guests	yes
        }
    }

    public function config()
    {
        // validasi input
        if (!$this->validate([
            'name' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama harus diisi'
                ]
            ],
            'id' => [
                'rules' => 'required|is_unique[users.id]',
                'errors' => [
                    'required' => 'Username harus diisi',
                    'is_unique' => 'Username sudah terdaftar'
                ]
            ],
            'email' => [
                'rules' => 'required|is_unique[users.email]|valid_email',
                'errors' => [
                    'required' => 'Email harus diisi',
                    'is_unique' => 'Email sudah terdaftar',
                    'valid_email' => 'Email tidak valid'
                ]
            ],
            'password' => [
                'rules' => 'required|min_length[8]',
                'errors' => [
                    'required' => 'Password harus diisi',
                    'min_length' => 'Password minimal terdiri dari 8 karakter'
                ]
            ],
            'password2' => [
                'rules' => 'required|matches[password]',
                'errors' => [
                    'required' => 'Password konfirmasi harus diisi',
                    'matches' => 'Password konfirmasi tidak sesuai'
                ]
            ],
        ])) {

            return redirect()->to('/register')->withInput();
        }

        // enkripsi password
        $password = password_hash($this->request->getVar('password'), PASSWORD_DEFAULT);
        $token = substr(sha1(time()), 0, 100);

        $nama = htmlspecialchars($this->request->getVar('name'));
        $email = htmlspecialchars($this->request->getVar('email'));

        $newuser = [
            'id' => htmlspecialchars($this->request->getVar('id')),
            'name' => $nama,
            'email' => $email,
            'token' => $token,
            'password' => $password,
            'regist_via' => 'email'
        ];

        $this->usersModel->insert($newuser);

        $this->email->setFrom('pikuupa@gmail.com', 'Pikupa.id');
        $this->email->setTo($email);
        $this->email->setSubject('Verifikasi Alamat Email Kamu di Pikupa.id');
        $this->email->setMessage('<div style="font-family: Montserrat; text-align: center; padding-top: 50px; padding-bottom: 50px; font-size: 18px; color: #424242;">
        <h3>Verifikasi Email Kamu Sekarang!</h3>
        <p>Hai Kak ' . $nama . ',</p>
        <p>
          Kakak telah mendaftarkan email ' . $email . ' sebagai alamat email kakak
          di Pikupa.id
        </p>
        <p>
          Silahkan klik link berikut ini untuk melakukan verifikasi akun Kakak
          agar bisa segera masuk ke website kami.
        </p>
          <a style="
              background-color: #ffce67;
              color: #424242;
              border-radius: 15px;
              border: none;
              padding: 15px 32px;
              text-decoration: none;
              display: inline-block;
              margin: 4px 2px;
              cursor: pointer;
            "
            href="' . base_url() . '/verification/token/' . $token . '">
            Aktivasi Akun Saya
          </a>
        </p>
        <h4>Piku tunggu pesanan kakak di Pikupa.id!</h4>
      </div>');
        $this->email->send();

        $_SESSION['message'] = 'Kami baru saja mengirimkan email untuk memverifikasikan akun sebelum mulai order.';
        $this->session->markAsTempdata('message', 20);

        return redirect()->to('/register');
    }

    public function SignUpWithTwitter()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.twitter.com/oauth/request_token",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_HTTPHEADER => array(
                "Authorization: OAuth oauth_consumer_key=\"i9aHZGMjl6E6zppqtqRFxM0vo\",oauth_token=\"4658987426-l8WRmko5lntBr2juTYvybVCxZeGwJ71kkbDqMej\",oauth_signature_method=\"HMAC-SHA1\",oauth_timestamp=\"1602493735\",oauth_nonce=\"ZL7eSzpZ1RC\",oauth_version=\"1.0\",oauth_callback=\"http%3A%2F%2Flocalhost%3A8080%2Fregister%2Findex\",oauth_signature=\"%2FrlGFIGvc%2FauntC5RWaQ%2F18a4z8%3D\"",
                "Cookie: personalization_id=\"v1_9nBKuf8pExBpNAYb7r2big==\"; guest_id=v1%3A160200759231788104; lang=en"
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        //echo $response;
        $ot = explode("&", $response);
        //var_dump($ot[0]);

        return redirect()->to('https://api.twitter.com/oauth/authorize?' . $ot[0]);
    }

    //--------------------------------------------------------------------

}