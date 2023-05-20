<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1><?= $title; ?></h1>
        </div>
        <div class="section-body">
            <!-- <div class="alert alert-danger">1. User : Tiap user memiliki idDistribusi, jadi barang yang di distribusikan ke tempat tersebut hanya bisa diliat oleh idDistribusi tersebut. (Revisi: jika menambahkan user baru, user harus jelas memiliki tempat distribusi atau idDistribusi)</div>
            <div class="alert alert-danger">2. barang rusak : barang rusak berisi hanya data barang yang rusak saja yang hanya bisa diisi oleh user, detail termasuk barcode dan tempat barang itu berasal.</div>
            <div class="alert alert-danger">3. Helpdesk: berisi data barang complain dari user, misal TV samsul rusak dengan keterangan LCD tidak tampil. dan tindakan dari penanggung jawab untuk mengecek barang serta memfonis barang apakah barang ini rusak atau bisa diperbaiki. jika bisa diperbaiki maka edit status selesai jika rusak maka edit status rusak. arahkan user untuk menginput barang itu rusak pada menu barang rusak di user</div>
            <div class="alert alert-danger">4. Add Ons : Jika barang yang keluar lebih dari lima tahun maka munculkan alert di dashboard berupa detail barang lengkap.</div> -->

            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="far fa-user"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Admin & User</h4>
                            </div>
                            <div class="card-body">
                                <?= $user; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-success">
                            <i class="far fa-newspaper"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Distribusi</h4>
                            </div>
                            <div class="card-body">
                                <?= $distribusi; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-secondary">
                            <i class="far fa-file"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Kategori Barang</h4>
                            </div>
                            <div class="card-body">
                                <?= $kategori; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-warning">
                            <i class="far fa-file"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Barang</h4>
                            </div>
                            <div class="card-body">
                                <?= $barangMasuk; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-info">
                            <i class="fas fa-circle"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Helpdesk</h4>
                            </div>
                            <div class="card-body">
                                <?= $helpdesk; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-danger">
                            <i class="fas fa-circle"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Barang Rusak</h4>
                            </div>
                            <div class="card-body">
                                <?= $barangRusak; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php if ($barangLimaTahun) : ?>
                <?php foreach ($barangLimaTahun as $barang) : ?>
                    <div class="alert alert-info">Daftar barang keluar lebih dari 5 tahun</div>
                    <div class="row">
                        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                            <div class="card">
                                <img class="card-img-top" src="<?= base_url('uploads/gambar/' . $barang->gambar); ?>" alt="<?= $barang->namaBarang; ?>">
                                <div class="card-body">
                                    <h5 class="card-title"><?= $barang->kodeBarang; ?></h5>
                                </div>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item"><?= $barang->namaBarang; ?></li>
                                    <li class="list-group-item"><?= 'Jumlah : ' . $barang->stok; ?></li>
                                    <li class="list-group-item"><?= date('d M Y', strtotime($barang->tanggalMasuk)); ?></li>
                                </ul>
                                <div class="card-body text-center">
                                    <p>Code QR</p>
                                    <a href="<?= base_url('uploads/qr/' . $barang
                                                    ->codeQR); ?>" target="_blank">
                                        <img src="<?= base_url('uploads/qr/' . $barang
                                                        ->codeQR); ?>" alt="<?= $barang->namaBarang; ?>" class="img-thumbnail" width="180">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </section>
</div>