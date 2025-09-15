<?php

namespace App\Models;

use CodeIgniter\Model;

class MahasiswaModel extends Model
{
    protected $table = 'mahasiswa'; // Nama tabel di database
    protected $primaryKey = 'ID';
    protected $allowedFields = ['ID', 'NIM', 'Nama', 'Umur'];
    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    // Timestamps
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    // Validation rules
    protected $validationRules = [
        'ID' => 'required|numeric|is_unique[mahasiswa.ID,ID,{ID}]',
        'NIM' => 'required|is_unique[mahasiswa.NIM,NIM,{NIM}]',
        'Nama' => 'required|min_length[2]|max_length[100]',
        'Umur' => 'required|numeric|greater_than[0]|less_than[100]'
    ];

    protected $validationMessages = [
        'ID' => [
            'required' => 'ID harus diisi',
            'numeric' => 'ID harus berupa angka',
            'is_unique' => 'ID sudah digunakan'
        ],
        'NIM' => [
            'required' => 'NIM harus diisi',
            'is_unique' => 'NIM sudah digunakan'
        ],
        'Nama' => [
            'required' => 'Nama harus diisi',
            'min_length' => 'Nama minimal 2 karakter',
            'max_length' => 'Nama maksimal 100 karakter'
        ],
        'Umur' => [
            'required' => 'Umur harus diisi',
            'numeric' => 'Umur harus berupa angka',
            'greater_than' => 'Umur harus lebih dari 0',
            'less_than' => 'Umur harus kurang dari 100'
        ]
    ];

    // Method untuk mengambil semua data mahasiswa
    public function getMahasiswa()
    {
        return $this->orderBy('ID', 'ASC')->findAll();
    }

    // Method untuk mengambil data mahasiswa berdasarkan NIM
    public function getMahasiswaByNIM($nim)
    {
        return $this->where('NIM', $nim)->first();
    }

    // Method untuk mengambil data mahasiswa berdasarkan ID
    public function getMahasiswaByID($id)
    {
        return $this->where('ID', $id)->first();
    }

    // Method untuk mengupdate data mahasiswa berdasarkan NIM
    public function updateMahasiswa($nim, $data)
    {
        return $this->where('NIM', $nim)->set($data)->update();
    }

    // Method untuk mengupdate data mahasiswa berdasarkan ID
    public function updateMahasiswaByID($id, $data)
    {
        return $this->where('ID', $id)->set($data)->update();
    }

    // Method untuk menghapus data mahasiswa berdasarkan NIM
    public function deleteMahasiswa($nim)
    {
        return $this->where('NIM', $nim)->delete();
    }

    // Method untuk menghapus data mahasiswa berdasarkan ID
    public function deleteMahasiswaByID($id)
    {
        return $this->where('ID', $id)->delete();
    }

    // Method untuk mencari mahasiswa berdasarkan nama
    public function searchMahasiswaByNama($nama)
    {
        return $this->like('Nama', $nama)->findAll();
    }

    // Method untuk mendapatkan total jumlah mahasiswa
    public function getTotalMahasiswa()
    {
        return $this->countAll();
    }

    // Method untuk mendapatkan mahasiswa dengan pagination
    public function getMahasiswaPaginated($limit = 10, $offset = 0)
    {
        return $this->orderBy('ID', 'ASC')
                    ->limit($limit, $offset)
                    ->findAll();
    }

    // Method untuk mendapatkan mahasiswa berdasarkan range umur
    public function getMahasiswaByUmurRange($minUmur, $maxUmur)
    {
        return $this->where('Umur >=', $minUmur)
                    ->where('Umur <=', $maxUmur)
                    ->orderBy('Umur', 'ASC')
                    ->findAll();
    }

    // Method untuk validasi NIM unik (untuk edit)
    public function isNIMUniqueForUpdate($nim, $originalNIM)
    {
        if ($nim === $originalNIM) {
            return true; // NIM tidak berubah, tetap valid
        }
        
        $existing = $this->where('NIM', $nim)->first();
        return $existing === null;
    }

    // Method untuk validasi ID unik (untuk edit)
    public function isIDUniqueForUpdate($id, $originalID)
    {
        if ($id == $originalID) {
            return true; // ID tidak berubah, tetap valid
        }
        
        $existing = $this->where('ID', $id)->first();
        return $existing === null;
    }

    // Method untuk insert data dengan validasi ekstra
    public function insertMahasiswa($data)
    {
        // Cek duplikasi NIM
        if ($this->getMahasiswaByNIM($data['NIM'])) {
            return [
                'success' => false,
                'message' => 'NIM sudah digunakan'
            ];
        }

        // Cek duplikasi ID
        if ($this->getMahasiswaByID($data['ID'])) {
            return [
                'success' => false,
                'message' => 'ID sudah digunakan'
            ];
        }

        if ($this->insert($data)) {
            return [
                'success' => true,
                'message' => 'Data mahasiswa berhasil ditambahkan'
            ];
        }

        return [
            'success' => false,
            'message' => 'Gagal menambahkan data mahasiswa'
        ];
    }

    // Method untuk mendapatkan statistik
    public function getStatistik()
    {
        return [
            'total_mahasiswa' => $this->countAll(),
            'rata_rata_umur' => $this->selectAvg('Umur')->first()['Umur'] ?? 0,
            'umur_tertinggi' => $this->selectMax('Umur')->first()['Umur'] ?? 0,
            'umur_terendah' => $this->selectMin('Umur')->first()['Umur'] ?? 0
        ];
    }

    // Method untuk backup data (export)
    public function exportAllData()
    {
        return $this->orderBy('ID', 'ASC')->findAll();
    }

    // Method untuk mengecek apakah data mahasiswa ada
    public function mahasiswaExists($nim)
    {
        return $this->where('NIM', $nim)->first() !== null;
    }

    // Method untuk soft delete (jika diperlukan di masa depan)
    public function softDeleteMahasiswa($nim)
    {
        return $this->where('NIM', $nim)
                    ->set(['deleted_at' => date('Y-m-d H:i:s')])
                    ->update();
    }

    // Method untuk restore soft deleted data
    public function restoreMahasiswa($nim)
    {
        return $this->where('NIM', $nim)
                    ->set(['deleted_at' => null])
                    ->update();
    }
}