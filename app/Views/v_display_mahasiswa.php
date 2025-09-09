<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mahasiswa</title>
</head>
<body>
    <h1>Daftar Mahasiswa</h1>
    <table border="1" cellpadding="5">
        <tr>
            <th>Nim</th>
            <th>Nama</th>
            <th>Umur</th>
        </tr>
        <?php if(!empty($mahasiswa)) : ?>
            <?php foreach ($mahasiswa as $m) : ?>
                <tr>
                    <td><?= esc($m['NIM'])?></td>
                    <td><?= esc($m['Nama'])?></td>
                    <td><?= esc($m['Umur'])?></td>
                </tr>
            <?php endforeach;?>
        <?php else: ?>
            <tr>
                <td colspan="3">Belum ada data mahasiswa</td>
            </tr>
        <?php endif;?>
    </table>
</body>
</html>