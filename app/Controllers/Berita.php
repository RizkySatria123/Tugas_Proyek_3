<?php
namespace App\Controllers;

class Berita extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Berita',
            'content' => 'Ini adalah halaman berita. Berita terbaru akan ditampilkan di sini.'
        ];

        return view('View_Template/view_berita', $data);
    }
}
 