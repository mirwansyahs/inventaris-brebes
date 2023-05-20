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
                                <table class="table table-striped" id="examples">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th>Distribusi</th>
                                            <th>Kode Barang</th>
                                            <th>Nama Barang</th>
                                            <th>Jumlah</th>
                                            <th>Keterangan</th>
                                            <th>Tanggal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($barang as $i => $b) : ?>
                                            <tr>
                                                <td><?= $i + 1; ?></td>
                                                <td><?= $b->distribusi; ?></td>
                                                <td><?= $b->kodeBarang; ?></td>
                                                <td><?= $b->namaBarang; ?></td>
                                                <td><?= $b->jumlahBarang; ?></td>
                                                <td><?= $b->keterangan; ?></td>
                                                <td><?= date('d M Y', strtotime($b->createdAt)); ?></td>
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

    </section>
</div>