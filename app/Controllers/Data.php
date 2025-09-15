<?php

namespace App\Controllers;

use App\Models\MahasiswaModel;

class Data extends BaseController
{
    public function index()
    {

        $model = new MahasiswaModel();
        $data = [
            'title' => 'Data',
            'content' => view('data', [ 'akademik_db' => $model->getMahasiswa() ]),
        ];

        return view('template', $data);
    }

    public function input() 
    {
        $data = [
            'title'   => 'Tambah Mahasiswa',
            'content' => view('input_data')
        ];
        return view('template', $data);
    }

    public function store()
    {
        $model = new MahasiswaModel();

        $data = [
            'id'            => $this->request->getPost('id'),
            'nim'           => $this->request->getPost('nim'),
            'nama'          => $this->request->getPost('nama'),
            'umur'          => $this->request->getPost('umur'),
            'nama_lengkap'  => $this->request->getPost('nama_lengkap')
        ];

        $model->insert($data);

        return redirect()->to(site_url('data'));
    }
}