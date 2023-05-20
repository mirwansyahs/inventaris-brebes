<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1><?= $title; ?></h1>
        </div>

        <div class="section-body">
            <div class="alert alert-danger">Berisi data ketika ada barang rusak dan complain ke admin ea coy, ada deskripsi kerusakan status kerusakan, gausah dikasih tindakan. ribet! eben tindakane manual bae</div>

            <!-- main -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <button class="btn btn-primary" data-toggle="modal" data-target="#modalAdd"><i class="fas fa-plus"></i></button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="table-1">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th>Kode Barang</th>
                                            <th>Nama Barang</th>
                                            <th>Jumlah Barang Dilaporkan</th>
                                            <th>Tanggal</th>
                                            <th>Keterangan</th>
                                            <th>Tindakan</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($helpdesk as $i => $help) : ?>
                                            <tr>
                                                <td class="text-center"><?= $i + 1; ?></td>
                                                <td><?= $help->kodeBarang; ?></td>
                                                <td><?= $help->namaBarang; ?></td>
                                                <td><?= $help->jumlahBarang; ?></td>
                                                <td><?= $help->tanggal; ?></td>
                                                <td><?= $help->keterangan; ?></td>
                                                <td><?= $help->tindakan; ?></td>
                                                <td><?= $help->status; ?></td>
                                                <td>
                                                    <div class="dropdown">
                                                        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            Action
                                                        </button>
                                                        <?php if ($help->status == 'Menunggu') : ?>
                                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                                <a href="<?= base_url('user/helpdesk/delete/' . $help->id); ?>" class="dropdown-item"><i class="fas fa-trash"></i> Delete</a>
                                                                <a href="javascript:void(0)" class="dropdown-item edit_btn" data-toggle="modal" data-target="#modalEdit" data-id="<?= $help->id; ?>" data-idbarangkeluar="<?= $help->idBarangKeluar; ?>" data-namabarang="<?= $help->kodeBarang . ' - ' . $help->namaBarang . ' | ' . $help->jumlahKeluar . ' barang'; ?>" data-keterangan="<?= $help->keterangan; ?>" data-jumlahbarang="<?= $help->jumlahBarang; ?>" data-tanggal="<?= $help->tanggal; ?>"><i class="fas fa-arrow-left"></i> Edit</a>
                                                            </div>
                                                        <?php endif; ?>
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
                <h5 class="modal-title">Tambah Helpdesk</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('user/helpdesk/add'); ?>" method="post">
                    <div class="form-group">
                        <label>Nama Barang</label>
                        <select name="idBarangKeluar" class="form-control">
                            <option value="">-- Pilih Barang --</option>
                            <?php foreach ($barang as $b) : ?>
                                <option value="<?= $b->id; ?>"><?= $b->kodeBarang . ' - ' . $b->namaBarang . ' | ' . $b->jumlahKeluar . ' barang'; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Jumlah Yang Dilaporkan</label>
                        <input type="number" class="form-control" name="jumlahBarang">
                    </div>
                    <div class="form-group">
                        <label>Keterangan</label>
                        <textarea class="form-control" name="keterangan" cols="30" rows="10"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Tanggal</label>
                        <input type="date" class="form-control" name="tanggal">
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
                <h5 class="modal-title">Edit Helpdesk</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('user/helpdesk/edit'); ?>" method="post">
                    <input type="hidden" name="id" id="idHelpdesk">
                    <input type="hidden" name="idBarangKeluar" id="idBarangKeluar">
                    <div class="form-group">
                        <label>Nama Barang</label>
                        <input type="text" class="form-control" name="namaBarang" id="namaBarang" disabled>
                    </div>
                    <div class="form-group">
                        <label>Jumlah Yang Dilaporkan</label>
                        <input type="number" class="form-control" name="jumlahBarang" id="jumlahBarang">
                    </div>
                    <div class="form-group">
                        <label>Keterangan</label>
                        <textarea class="form-control" name="keterangan" cols="30" rows="10" id="keterangan"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Tanggal</label>
                        <input type="date" class="form-control" name="tanggal" id="tanggal">
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
            let idBarangKeluar = $(this).data('idbarangkeluar');
            let namaBarang = $(this).data('namabarang');
            let jumlahBarang = $(this).data('jumlahbarang');
            let keterangan = $(this).data('keterangan');
            let tanggal = $(this).data('tanggal');

            $('#idHelpdesk').val(id);
            $('#idBarangKeluar').val(idBarangKeluar);
            $('#namaBarang').val(namaBarang);
            $('#jumlahBarang').val(jumlahBarang);
            $('#tanggal').val(tanggal);
            $('#keterangan').text(keterangan);
        });
    });
</script>