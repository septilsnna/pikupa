<?php

namespace App\Controllers;

use App\Models\UsersModel;

class verification extends BaseController
{
  protected $usersModel;

  public function __construct()
  {
    $this->usersModel = new UsersModel();
  }

  public function token($token)
  {
    $user = $this->usersModel->where('token', $token)->findAll();
    // kalo token tidak valid
    if (!$user) {
      echo '<div style="font-family: Montserrat; text-align: center; padding-top: 50px">
            <h4>Link verifikasi tidak valid!</h4>
          </div>';
    } else {
      // kalo udah di verif
      if ($user[0]['verified'] == 1) {
        echo '<div style="font-family: Montserrat; text-align: center; padding-top: 50px">
                <h4>Email sudah diverifikasi</h4>
              </div>';
      } else {
        // kalo belom di verif
        $this->usersModel
          ->where('token', $token)
          ->set(['verified' => 1])
          ->update();
        echo '<div style="font-family: Montserrat; text-align: center; padding-top: 50px">
                <h4>Email berhasil diverifikasi</h4>
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
                href="' . base_url() . '/login">
               Login Sekarang
              </a>
            </p>
              </div>';
      }
    }
  }

  public function forget_pass($token)
  {
    $user = $this->usersModel->where('token', $token)->findAll();
    // kalo token tidak valid
    if (!$user) {
      echo '<div style="font-family: Montserrat; text-align: center; padding-top: 50px">
            <h4>Link verifikasi tidak valid!</h4>
          </div>';
    } else {
      // kalo udah di verif
      if ($user[0]['verified'] == 1) {
        echo '<div style="font-family: Montserrat; text-align: center; padding-top: 50px">
                <h4>Email sudah diverifikasi</h4>
              </div>';
      } else {
        // kalo belom di verif
        return redirect()->to('/forget/index/' . $token);
      }
    }
  }

  //--------------------------------------------------------------------

}