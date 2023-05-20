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
                                            <th>User Pelapor</th>
                                            <th>Distribusi</th>
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
                                                <td><?= $help->name; ?></td>
                                                <td><?= $help->distribusi; ?></td>
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
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                            <a href="<?= base_url('admin/helpdesk/delete/' . $help->id); ?>" class="dropdown-item"><i class="fas fa-trash"></i> Delete</a>
                                                            <a href="javascript:void(0)" class="dropdown-item edit_btn" data-toggle="modal" data-target="#modalEdit" data-id="<?= $help->id; ?>" data-tindakan="<?= $help->tindakan; ?>" data-status="<?= $help->status; ?>"><i class="fas fa-arrow-left"></i> TIndakan</a>
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


<!-- modal edit -->
<div class="modal fade" tabindex="-1" role="dialog" id="modalEdit">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tindakan Helpdesk</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('admin/helpdesk/tindakan'); ?>" method="post">
                    <input type="hidden" name="id" id="idHelpdesk">
                    <div class="form-group">
                        <label>Tindakan</label>
                        <textarea class="form-control" name="tindakan" cols="30" rows="10" id="tindakan"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select class="form-control" name="status" id="status">
                            <option value="">-- Pilih Status --</option>
                            <option value="Menunggu">Menunggu</option>
                            <option value="Sudah Diperbaiki">Sudah Diperbaiki</option>
                            <option value="Rusak">Rusak</option>
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
            let tindakan = $(this).data('tindakan');
            let status = $(this).data('status');

            $('#idHelpdesk').val(id);
            $('#tindakan').val(tindakan);
            $('#status').val(status);
        });
    });
</script>