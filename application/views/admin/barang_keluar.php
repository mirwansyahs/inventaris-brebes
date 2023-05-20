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
                                            <th>Kode Barang</th>
                                            <th>Nama Barang</th>
                                            <th>Jumlah Keluar</th>
                                            <th>Tanggal Keluar</th>
                                            <th>Distribusi</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($barangKeluar as $i => $b) : ?>
                                            <tr>
                                                <td><?= $i + 1; ?></td>
                                                <td><?= $b->kodeBarang; ?></td>
                                                <td><?= $b->namaBarang; ?></td>
                                                <td><?= $b->jumlahKeluar; ?></td>
                                                <td><?= $b->tanggalKeluar; ?></td>
                                                <td><?= $b->distribusi; ?></td>
                                                <td>
                                                    <div class="dropdown">
                                                        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            Action
                                                        </button>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                            <a href="<?= base_url('admin/barang_keluar/delete/' . $b->id); ?>" class="dropdown-item"><i class="fas fa-trash"></i> Delete</a>
                                                            <a href="javascript:void(0)" class="dropdown-item edit_btn" data-toggle="modal" data-target="#modalEdit" data-id="<?= $b->id; ?>" data-kodebarang="<?= ($b->kodeBarang . ' - ' . $b->namaBarang . ' | ' . ($b->stok + $b->jumlahKeluar)); ?>" data-jumlahkeluar="<?= $b->jumlahKeluar; ?>" data-tanggalkeluar="<?= $b->tanggalKeluar; ?>" data-iddistribusi="<?= $b->idDistribusi; ?>"><i class="fas fa-arrow-left"></i> Edit</a>
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
                <h5 class="modal-title">Tambah Barang Keluar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('admin/barang_keluar/add'); ?>" method="post">
                    <div class="form-group">
                        <label>Nama Barang</label>
                        <select name="kodeBarang" class="form-control">
                            <option value="">-- Pilih Barang --</option>
                            <?php foreach ($barangMasuk as $b) : ?>
                                <option value="<?= $b->kodeBarang; ?>"><?= $b->kodeBarang . ' - ' . $b->namaBarang . ' | Stok : ' . $b->stok; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Jumlah Keluar</label>
                        <input type="number" class="form-control" name="jumlahKeluar">
                    </div>
                    <div class="form-group">
                        <label>Tanggal Keluar</label>
                        <input type="date" class="form-control" name="tanggalKeluar">
                    </div>
                    <div class="form-group">
                        <label>Distribusi</label>
                        <select name="distribusi" class="form-control">
                            <option value="">-- Pilih Distribusi --</option>
                            <?php foreach ($distribusi as $dis) : ?>
                                <option value="<?= $dis->id; ?>"><?= $dis->distribusi; ?></option>
                            <?php endforeach; ?>
                        </select>
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
                <h5 class="modal-title">Edit Barang Keluar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('admin/barang_keluar/edit'); ?>" method="post">
                    <input type="hidden" name="id" id="idBarangKeluar">
                    <input type="hidden" name="kodeBarangSebelumnya" id="kodeBarangSebelumnya">
                    <div class="form-group">
                        <label>Nama Barang</label>
                        <input type="text" class="form-control" name="kodeBarang" id="kodeBarang" disabled>
                    </div>
                    <div class="form-group">
                        <label>Jumlah Keluar</label>
                        <input type="number" class="form-control" name="jumlahKeluar" id="jumlahKeluar">
                    </div>
                    <div class="form-group">
                        <label>Tanggal Keluar</label>
                        <input type="date" class="form-control" name="tanggalKeluar" id="tanggalKeluar">
                    </div>
                    <div class="form-group">
                        <label>Distribusi</label>
                        <select name="distribusi" class="form-control" id="distribusi">
                            <option value="">-- Pilih Distribusi --</option>
                            <?php foreach ($distribusi as $dis) : ?>
                                <option value="<?= $dis->id; ?>"><?= $dis->distribusi; ?></option>
                            <?php endforeach; ?>
                        </select>
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
            let kodeBarang = $(this).data('kodebarang');
            let jumlahKeluar = $(this).data('jumlahkeluar');
            let tanggalKeluar = $(this).data('tanggalkeluar');
            let distribusi = $(this).data('iddistribusi');

            $('#idBarangKeluar').val(id);
            $('#kodeBarangSebelumnya').val(kodeBarang);
            $('#kodeBarang').val(kodeBarang);
            $('#jumlahKeluar').val(jumlahKeluar);
            $('#tanggalKeluar').val(tanggalKeluar);
            $('#distribusi').val(distribusi);
        });
    });
</script>