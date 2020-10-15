<?php

namespace App\Controllers;

use App\Models\UsersModel;

class login extends BaseController
{
    protected $usersModel;

    public function __construct()
    {
        $this->usersModel = new UsersModel();
        $this->session = \Config\Services::session();
    }

    public function index()
    {
        if (isset($_SESSION['user_id'])) {
            return redirect()->to('../home/index');           // users	no
        } else {
            // twitter login
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
                $satu = explode('screen_name=', $response);
                //var_dump($satu[1]);

                $user_lama = $this->usersModel->where('id', $satu[1])->findAll();

                if ($user_lama) {
                    $_SESSION['user_id'] = $user_lama[0]['id'];
                    return redirect()->to(base_url() . '/home/index');
                } else {
                    $_SESSION['not_found'] = 'Akun belum terdaftar, silahkan lakukan registrasi';
                    $this->session->markAsTempdata('not_found', 10);
                    return redirect()->to('/register');
                }
            }

            // google login
            require_once APPPATH . 'Libraries/vendor/autoload.php';
            $google_client = new \Google_Client();
            $google_client->setClientId('444339106683-9n10h1ec88b2hmq5s1mqqct0n7uuvc05.apps.googleusercontent.com');
            $google_client->setClientSecret('2u4vDmBA09GlnlhtXAApOzt_');
            $google_client->setRedirectUri(base_url() . '/login/index');
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

                    $users = $this->usersModel->where('email', $data_user['email'])->findAll();
                    if ($users) {
                        if ($data_user['email'] == 'pikuupa@gmail.com') {
                            return redirect()->to('/Admin/dashboard');
                        } else {
                            $_SESSION['user_id'] = $users[0]['id'];
                            return redirect()->to(base_url() . '/home/index');
                        }
                    } else {
                        $_SESSION['not_found'] = 'Akun belum terdaftar, silahkan lakukan registrasi';
                        $this->session->markAsTempdata('not_found', 10);
                        return redirect()->to('/register');
                    }
                }
            }

            $data['googleLogin'] = $google_client->createAuthUrl();

            return view('guests/login', $data);        // guests	yes
        }
    }

    public function config()
    {
        // dapatkan username and password dari input
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');

        $user = $this->usersModel->where('email', $email)->findAll();

        if ($user != null) {
            $password_hash = $user[0]['password'];
            if (password_verify($password, $password_hash)) {
                // if ($email == 'akuadmin@iya.com') {
                //     return redirect()->to('/Admin/dashboard');
                // } else {
                if ($user[0]['verified'] == 1) {
                    $_SESSION['user_id'] = $user[0]['id'];
                    return redirect()->to('/home/index');
                } else {
                    $_SESSION['verified'] = 'Email belum terverifikasi, silahkan verifikasi email kamu.';
                    $this->session->markAsTempdata('verified', 10);

                    return redirect()->to('/login')->withInput();
                }
                // }
            } else {
                $_SESSION['wrong_password'] = 'Password tidak sesuai, cek kembali password kamu.';
                $this->session->markAsTempdata('wrong_password', 10);

                return redirect()->to('/login')->withInput();
            }
        } else {
            $_SESSION['not_found'] = 'Email belum terdaftar, cek kembali email kamu.';
            $this->session->markAsTempdata('not_found', 10);

            return redirect()->to('/login')->withInput();
        }
    }

    public function LoginWithTwitter()
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
                "Authorization: OAuth oauth_consumer_key=\"i9aHZGMjl6E6zppqtqRFxM0vo\",oauth_token=\"4658987426-l8WRmko5lntBr2juTYvybVCxZeGwJ71kkbDqMej\",oauth_signature_method=\"HMAC-SHA1\",oauth_timestamp=\"1602493688\",oauth_nonce=\"5THE1rnITsy\",oauth_version=\"1.0\",oauth_callback=\"http%3A%2F%2Flocalhost%3A8080%2Flogin%2Findex\",oauth_signature=\"e9tG7j9y9lsgGRlMabk03RdSpx8%3D\"",
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