<?php

namespace App\Controllers;

class Home extends BaseController
{
    private $modelMahasiswa;

    public function __construct()
    {
        $this->modelMahasiswa = new \App\Models\MahasiswaModel();
    }
    public function index()
    {
        return view('generatepw');
    }

    public function generatepassword()
    {
        $allMhs = $this->modelMahasiswa->getAllMahasiswa();
        foreach ($allMhs as $am) {
            $password = $this->grs();
            $this->modelMahasiswa->insertPassword($am['id'], [
                'password' => $password,
                'password_hash' => password_hash($password, PASSWORD_DEFAULT)
            ]);
        }

        return redirect()->to('/home/berhasilgenerate');
    }

    public function berhasilgenerate()
    {
        echo "Berhasil";
    }

    private function grs()
    {
        $charactersUpper = 'ABCDEFGHJKLMNOPQRSTUVWXYZ';
        $charactersLower = 'abcdefghijklmnopqrstuvwxyz';
        $numbers = '0123456789';
        $symbols = '#$&*';
        $randomString = '';
        $lengthCharUpper = strlen($charactersUpper);
        $lengthCharLower = strlen($charactersLower);
        $lengthCharNumber = strlen($numbers);
        $lengthCharSymbol = strlen($symbols);

        $randomString .= $charactersUpper[rand(0, $lengthCharUpper - 1)];
        for ($i = 0; $i < 3; $i++)
            $randomString .= $charactersLower[rand(0, $lengthCharLower - 1)];

        $randomString .= $symbols[rand(0, $lengthCharSymbol - 1)];

        for ($j = 0; $j < 3; $j++)
            $randomString .= $numbers[rand(0, $lengthCharNumber - 1)];

        return $randomString;
    }
}