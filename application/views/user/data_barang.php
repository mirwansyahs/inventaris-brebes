<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1><?= $title; ?></h1>
        </div>

        <div class="section-body">
            <!-- main -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="table-1">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th>Kode Barang</th>
                                            <th>Nama Barang</th>
                                            <th>Jumlah Barang</th>
                                            <th>Gambar</th>
                                            <th>Code QR</th>
                                            <th>Tanggal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($barang as $i => $b) : ?>
                                            <tr>
                                                <td class="text-center"><?= $i + 1; ?></td>
                                                <td><?= $b->kodeBarang; ?></td>
                                                <td><?= $b->namaBarang; ?></td>
                                                <td><?= $b->jumlahKeluar; ?></td>
                                                <td>
                                                    <a href="<?= base_url('uploads/gambar/' . $b
                                                                    ->gambar); ?>" target="_blank">
                                                        <img src="<?= base_url('uploads/gambar/' . $b
                                                                        ->gambar); ?>" alt="<?= $b->namaBarang; ?>" class="img-thumbnail" width="180">
                                                    </a>
                                                </td>
                                                <td>
                                                    <a href="<?= base_url('uploads/qr/' . $b
                                                                    ->codeQR); ?>" target="_blank">
                                                        <img src="<?= base_url('uploads/qr/' . $b
                                                                        ->codeQR); ?>" alt="<?= $b->namaBarang; ?>" class="img-thumbnail" width="180">
                                                    </a>
                                                </td>
                                                <td><?= $b->tanggalKeluar; ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end main -->
        </div>
    </section>
</div>