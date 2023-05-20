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
                        <div class="card-header">
                            <button class="btn btn-primary" data-toggle="modal" data-target="#modalAdd"><i class="fas fa-plus"></i></button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="examples">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th>Kategori</th>
                                            <th>Kode Barang</th>
                                            <th>Nama Barang</th>
                                            <th>Tanggal Masuk</th>
                                            <th>Stok</th>
                                            <th>Gambar</th>
                                            <th>Code QR</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($barang as $i => $b) : ?>
                                            <tr>
                                                <td><?= $i + 1; ?></td>
                                                <td><?= $b->namaKategori; ?></td>
                                                <td><?= $b->kodeBarang; ?></td>
                                                <td><?= $b->namaBarang; ?></td>
                                                <td><?= $b->tanggalMasuk; ?></td>
                                                <td><?= $b->stok; ?></td>
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
                                                <td>
                                                    <div class="dropdown">
                                                        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            Action
                                                        </button>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                            <a href="<?= base_url('admin/barang_masuk/delete/' . $b->id); ?>" class="dropdown-item"><i class="fas fa-trash"></i> Delete</a>
                                                            <a href="javascript:void(0)" class="dropdown-item edit_btn" data-toggle="modal" data-target="#modalEdit" data-id="<?= $b->id; ?>" data-kategoribarang="<?= $b->kategoriBarang; ?>" data-namabarang="<?= $b->namaBarang; ?>" data-tanggalmasuk="<?= $b->tanggalMasuk; ?>" data-stok="<?= $b->stok; ?>"><i class="fas fa-arrow-left"></i> Edit</a>
                                                        </div>
                                                    </div>
                                                </td>
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

<!-- modal add -->
<div class="modal fade" tabindex="-1" role="dialog" id="modalAdd">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Barang Masuk</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('admin/barang_masuk/add'); ?>" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Kategori Barang</label>
                        <select name="kategoriBarang" class="form-control">
                            <option value="">-- Pilih Kategori --</option>
                            <?php foreach ($kategori as $kat) : ?>
                                <option value="<?= $kat->id; ?>"><?= $kat->namaKategori; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Nama Barang</label>
                        <input type="text" class="form-control" name="namaBarang">
                    </div>
                    <div class="form-group">
                        <label>Tanggal Masuk</label>
                        <input type="date" class="form-control" name="tanggalMasuk">
                    </div>
                    <div class="form-group">
                        <label>Stok</label>
                        <input type="number" class="form-control" name="stok">
                    </div>
                    <div class="form-group">
                        <label>Gambar</label>
                        <input type="file" class="form-control" name="gambar">
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- modal edit -->
<div class="modal fade" tabindex="-1" role="dialog" id="modalEdit">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Barang Masuk</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('admin/barang_masuk/edit'); ?>" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id" id="idBarangMasuk">
                    <input type="hidden" name="kategoriBarangSebelumnya" id="kategoriBarangSebelumnya">
                    <div class="form-group">
                        <label>Kategori Barang</label>
                        <select name="kategoriBarang" class="form-control" id="kategoriBarang">
                            <option value="">-- Pilih Kategori --</option>
                            <?php foreach ($kategori as $kat) : ?>
                                <option value="<?= $kat->id; ?>"><?= $kat->namaKategori; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Nama Barang</label>
                        <input type="text" class="form-control" name="namaBarang" id="namaBarang">
                    </div>
                    <div class="form-group">
                        <label>Tanggal Masuk</label>
                        <input type="date" class="form-control" name="tanggalMasuk" id="tanggalMasuk">
                    </div>
                    <div class="form-group">
                        <label>Stok</label>
                        <input type="number" class="form-control" name="stok" id="stok">
                    </div>
                    <div class="form-group">
                        <label>Gambar</label>
                        <input type="file" class="form-control" name="gambar">
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    let edit_btn = $('.edit_btn');

    $(edit_btn).each(function(i) {
        $(edit_btn[i]).click(function() {
            let id = $(this).data('id');
            let kategoriBarang = $(this).data('kategoribarang');
            let namaBarang = $(this).data('namabarang');
            let tanggalMasuk = $(this).data('tanggalmasuk');
            let stok = $(this).data('stok');

            $('#idBarangMasuk').val(id);
            $('#kategoriBarangSebelumnya').val(kategoriBarang);
            $('#kategoriBarang').val(kategoriBarang);
            $('#namaBarang').val(namaBarang);
            $('#tanggalMasuk').val(tanggalMasuk);
            $('#stok').val(stok);
        });
    });
</script>