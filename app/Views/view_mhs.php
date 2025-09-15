<!DOCTYPE html>
<html lang="en">
<body>
    <h1>Daftar Mahasiswa</h1>
    <h3><a href="<?= site_url('input_data'); ?>">Input Data Mahasiswa</a></h3>
    <table border="1" cellpadding="5">
        <tr>
            <th>ID</th>
            <th>NIM</th>
            <th>Aksi</th>
        </tr>
        <?php if (!empty($akademik_db)): ?>
            <?php foreach($akademik_db as $b): ?>
                <tr>
                    <td><?= esc($b['id']) ?></td>
                    <td><?= esc($b['nim']) ?></td>
                    <td><a href="<?= site_url('display_detail_mhs/'.$b['nim']); ?>">Details</a> || <a href="<?= site_url('edit_mhs/' .$b['nim']); ?>">Update</a> || <a href="<?= site_url('delete_mhs/' .$b['nim']); ?>" onclick="return confirm('Bener hapus kah lekku?')">Delete</a></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="4">Belum ada data mahasiswa</td>
            </tr>
        <?php endif; ?>
    </table>
</body>
</html>
