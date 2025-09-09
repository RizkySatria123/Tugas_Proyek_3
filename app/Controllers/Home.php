<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $data = [
        'title' => 'Home Page',
        'content' => 'Selamat datang di halaman utama website kami. Di sini Anda dapat menemukan berita terbaru dan informasi penting lainnya.'
        ];
        
        return view('View_Template/view_home');
    }
}
 