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
        // $data = [
        //     'title' => 'Halaman Masuk'
        // ];

        if (isset($_SESSION['user_id'])) {
            return redirect()->to('../home/index');           // users	no
        } else {
            require_once APPPATH . 'Libraries/vendor/autoload.php';
            $google_client = new \Google_Client();
            $google_client->setClientId('444339106683-03eb2us55l4ekd6fp4jdr4pcmck4iiik.apps.googleusercontent.com');
            $google_client->setClientSecret('p5jAz7DSm4skGbiEw0gXXpMG');
            $google_client->setRedirectUri(base_url() . '/login');
            $google_client->addScope('email');
            $google_client->addScope('profile');

            if ($this->request->getvar('code')) {
                $token = $google_client->fetchAccessTokenWithAuthCode($this->request->getvar('code'));
                if (!isset($token['error'])) {
                    $google_client->setAccessToken($token['access_token']);
                    $this->session->set('access_token', $token['access_token']);

                    // ambil data user dari akun google
                    $google_service = new \Google_Service_Oauth2($google_client);
                    $data_user = $google_service->userinfo->get();

                    $users = $this->usersModel->where('email', $data_user['email'])->findAll();
                    if ($users) {
                        $_SESSION['user_id'] = $users[0]['id'];
                        return redirect()->to(base_url() . '/home/index');
                    }

                    $user = [
                        'id' => $data['id'],
                        'name' => $data['given_name'] . $data['family_name'],
                        'email' => $data['email'],
                        'token' => $data['email'],
                        'verified' => 1,
                    ];

                    var_dump($user);
                }
            }

            if (!$this->session->get('access_token')) {
                $data['googleLogin'] = $google_client->createAuthUrl();
            }

            return view('guests/login');        // guests	yes
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
                if ($email == 'akuadmin@iya.com') {
                    return redirect()->to('/Admin/dashboard');
                } else {
                    if ($user[0]['verified'] == 1) {
                        $_SESSION['user_id'] = $user[0]['id'];
                        return redirect()->to('/home/index');
                    } else {
                        $_SESSION['verified'] = 'Email belum terverifikasi, silahkan verifikasi email kamu.';
                        $this->session->markAsTempdata('verified', 10);

                        return redirect()->to('/login')->withInput();
                    }
                }
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
                "Authorization: OAuth oauth_consumer_key=\"ysEX1Nm10TxBCnj03b2muQXm0\",oauth_token=\"4658987426-Xdg2VCyZ4DH7e649oyhm0nlfjDbsbQOmNg7qcOA\",oauth_signature_method=\"HMAC-SHA1\",oauth_timestamp=\"1602014792\",oauth_nonce=\"62V85lLz6aT\",oauth_version=\"1.0\",oauth_signature=\"rSxgBSgTgXrqTB8MD8CqacNMZRI%3D\"",
                "Cookie: personalization_id=\"v1_9nBKuf8pExBpNAYb7r2big==\"; guest_id=v1%3A160200759231788104; _twitter_sess=BAh7CSIKZmxhc2hJQzonQWN0aW9uQ29udHJvbGxlcjo6Rmxhc2g6OkZsYXNo%250ASGFzaHsABjoKQHVzZWR7ADoPY3JlYXRlZF9hdGwrCPhOg%252F90AToMY3NyZl9p%250AZCIlODE3YzIwOWVjNWM3NDcwYmU0MWE3N2UyN2IzZTE0N2M6B2lkIiVmYzRm%250AYzY4OGFjYzJmYjg5NWU5Y2U5Y2EzMjI0MDFmZg%253D%253D--7ee13c2df7b679dd5c422eea548658c96e312a1c; lang=en"
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        //echo $response;
        $ot = explode("&", $response);
        //var_dump($ot);

        return redirect()->to('https://api.twitter.com/oauth/authorize?' . $ot[0]);
    }

    public function twitter()
    {
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
                "Cookie: personalization_id=\"v1_9nBKuf8pExBpNAYb7r2big==\"; guest_id=v1%3A160200759231788104; _twitter_sess=BAh7CSIKZmxhc2hJQzonQWN0aW9uQ29udHJvbGxlcjo6Rmxhc2g6OkZsYXNo%250ASGFzaHsABjoKQHVzZWR7ADoPY3JlYXRlZF9hdGwrCPhOg%252F90AToMY3NyZl9p%250AZCIlODE3YzIwOWVjNWM3NDcwYmU0MWE3N2UyN2IzZTE0N2M6B2lkIiVmYzRm%250AYzY4OGFjYzJmYjg5NWU5Y2U5Y2EzMjI0MDFmZg%253D%253D--7ee13c2df7b679dd5c422eea548658c96e312a1c; lang=en"
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        //echo $response;
        $ot = explode("&", $response);
        var_dump($ot);
        $oauth_token = explode("=", $ot[0])[1];
        $oauth_token_secret = explode("=", $ot[1])[1];
        var_dump($oauth_token);
        var_dump($oauth_token_secret);
        //$username = explode('screen_name=', $ot[3]);

        // $user = $this->usersModel->where('id', $username[1])->findAll();

        // if ($user != null) {
        //     $_SESSION['user_id'] = $user[0]['id'];
        //     return redirect()->to('/home/index');
        // } else {
        //     $_SESSION['not_foun'] = 'Twitter belum terdaftar.';
        //     $this->session->markAsTempdata('not_foun', 10);

        //     return redirect()->to('/login');
        // }
        //var_dump($username[1]);

        $curl = curl_init();

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
                '"Authorization: OAuth oauth_consumer_key=\"ysEX1Nm10TxBCnj03b2muQXm0\",oauth_token=\"' . $oauth_token . '\",oauth_signature_method=\"HMAC-SHA1\",oauth_timestamp=\"1602076856\",oauth_nonce=\"RZNsnNZVQQd\",oauth_version=\"1.0\",oauth_signature=\"9YMk7IBoozL8Ad18hEYIPOQgKfw%3D\""',
                "Cookie: personalization_id=\"v1_9nBKuf8pExBpNAYb7r2big==\"; guest_id=v1%3A160200759231788104; _twitter_sess=BAh7CSIKZmxhc2hJQzonQWN0aW9uQ29udHJvbGxlcjo6Rmxhc2g6OkZsYXNo%250ASGFzaHsABjoKQHVzZWR7ADoPY3JlYXRlZF9hdGwrCPhOg%252F90AToMY3NyZl9p%250AZCIlODE3YzIwOWVjNWM3NDcwYmU0MWE3N2UyN2IzZTE0N2M6B2lkIiVmYzRm%250AYzY4OGFjYzJmYjg5NWU5Y2U5Y2EzMjI0MDFmZg%253D%253D--7ee13c2df7b679dd5c422eea548658c96e312a1c; lang=id"
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;
        echo "aasds\"dasdsda\"";

        // NAMA USER DI TWITTER
        // $curl = curl_init();

        // curl_setopt_array($curl, array(
        //     CURLOPT_URL => "https://api.twitter.com/2/users/by/username/" . $username[1] . "?user.fields=name",
        //     CURLOPT_RETURNTRANSFER => true,
        //     CURLOPT_ENCODING => "",
        //     CURLOPT_MAXREDIRS => 10,
        //     CURLOPT_TIMEOUT => 0,
        //     CURLOPT_FOLLOWLOCATION => true,
        //     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        //     CURLOPT_CUSTOMREQUEST => "GET",
        //     CURLOPT_HTTPHEADER => array(
        //         "Authorization: OAuth oauth_consumer_key=\"ysEX1Nm10TxBCnj03b2muQXm0\",oauth_token=\"4658987426-Xdg2VCyZ4DH7e649oyhm0nlfjDbsbQOmNg7qcOA\",oauth_signature_method=\"HMAC-SHA1\",oauth_timestamp=\"1602018597\",oauth_nonce=\"ZGIHEPUmpWd\",oauth_version=\"1.0\",oauth_signature=\"H2Wi5%2F3BOt2vLudShX%2BytchqhWI%3D\"",
        //         "Cookie: personalization_id=\"v1_9nBKuf8pExBpNAYb7r2big==\"; guest_id=v1%3A160200759231788104; _twitter_sess=BAh7CSIKZmxhc2hJQzonQWN0aW9uQ29udHJvbGxlcjo6Rmxhc2g6OkZsYXNo%250ASGFzaHsABjoKQHVzZWR7ADoPY3JlYXRlZF9hdGwrCPhOg%252F90AToMY3NyZl9p%250AZCIlODE3YzIwOWVjNWM3NDcwYmU0MWE3N2UyN2IzZTE0N2M6B2lkIiVmYzRm%250AYzY4OGFjYzJmYjg5NWU5Y2U5Y2EzMjI0MDFmZg%253D%253D--7ee13c2df7b679dd5c422eea548658c96e312a1c; lang=en"
        //     ),
        // ));

        // $response = curl_exec($curl);

        // curl_close($curl);
        // //echo $response;
        // $nama = json_decode($response, true);
        // $nama = $nama['data']['name'];
        // var_dump($nama);
    }

    //--------------------------------------------------------------------

}