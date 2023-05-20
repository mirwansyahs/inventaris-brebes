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
                                <table class="table table-striped" id="table-1">
                                    <thead>
                                        <tr>
                                            <th class="text-center">
                                                #
                                            </th>
                                            <th>Name</th>
                                            <th>Username</th>
                                            <th>Image</th>
                                            <th>Role</th>
                                            <th>Distribusi</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1;
                                        foreach ($user as $data) : ?>
                                            <tr>
                                                <td><?= $i++; ?></td>
                                                <td><?= $data->name; ?></td>
                                                <td><?= $data->username; ?></td>
                                                <td>
                                                    <img src="<?= base_url('uploads/profile/' . $data->image); ?>" width="50" class="img-fluid rounded-circle" alt="image">
                                                </td>
                                                <td>
                                                    <?php if ($data->role_id == 1) : ?>
                                                        <div class="badge badge-danger">Superadmin</div>
                                                    <?php elseif ($data->role_id == 2) : ?>
                                                        <div class="badge badge-warning">Penanggung Jawab</div>
                                                    <?php else : ?>
                                                        <div class="badge badge-success">User</div>
                                                    <?php endif; ?>
                                                </td>
                                                <td><?= $data->distribusi; ?></td>
                                                <td>
                                                    <div class="dropdown">
                                                        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            Action
                                                        </button>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                            <a href="<?= base_url('admin/user/delete/' . $data->id); ?>" class="dropdown-item"><i class="fas fa-trash"></i> Delete</a>
                                                            <a href="javascript:void(0)" class="dropdown-item edit_btn" data-toggle="modal" data-target="#modalEdit" data-id="<?= $data->id; ?>" data-name="<?= $data->name; ?>" data-username="<?= $data->username; ?>" data-role_id="<?= $data->role_id; ?>" data-iddistribusi="<?= $data->idDistribusi; ?>"><i class="fas fa-arrow-left"></i> Edit</a>
                                                            <a href="<?= base_url('admin/user/resetPwd/' . $data->id); ?>" class="dropdown-item"><i class="fas fa-arrow-left"></i> Reset Password</a>
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
                <h5 class="modal-title">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('admin/user/add'); ?>" method="post">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" name="name">
                    </div>
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" class="form-control" name="username">
                    </div>
                    <div class="form-group">
                        <label>Role user</label>
                        <select class="form-control" name="role_id" id="role_id_add">
                            <option value="">-- Pilih role --</option>
                            <option value="1">Superadmin</option>
                            <option value="2">Penganggung Jawab</option>
                            <option value="3">User</option>
                        </select>
                    </div>
                    <div class="form-group d-none" id="div-distribusi-add">
                        <label>Distribusi</label>
                        <select name="distribusi" class="form-control" id="distribusiAdd">
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
                <h5 class="modal-title">Edit Kategori</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('admin/user/edit'); ?>" method="post">
                    <input type="hidden" name="id" id="idUser">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" name="name" id="name">
                    </div>
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" class="form-control" name="username" id="username">
                    </div>
                    <div class="form-group">
                        <label>Role user</label>
                        <select class="form-control" name="role_id" id="role_id_edit">
                            <option value="">-- Pilih role --</option>
                            <option value="1">Superadmin</option>
                            <option value="2">Penganggung Jawab</option>
                            <option value="3">User</option>
                        </select>
                    </div>
                    <div class="form-group" id="div-distribusi-edit">
                        <label>Distribusi</label>
                        <select name="distribusi" class="form-control" id="distribusiEdit">
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
    $('#role_id_add').change(function() {
        let role = $(this).val();

        if (role == 3) {
            $('#div-distribusi-add').removeClass("d-none");
        } else {
            $('#div-distribusi-add').addClass("d-none");
        }
    });

    let edit_btn = $('.edit_btn');

    $(edit_btn).each(function(i) {
        $(edit_btn[i]).click(function() {
            let id = $(this).data('id');
            let name = $(this).data('name');
            let username = $(this).data('username');
            let role_id = $(this).data('role_id');
            let idDistribusi = $(this).data('iddistribusi');

            if (role_id == 3) {
                $('#div-distribusi-edit').removeClass("d-none");
            } else {
                $('#div-distribusi-edit').addClass("d-none");
            }

            $('#idUser').val(id);
            $('#name').val(name);
            $('#username').val(username);
            $('#role_id_edit').val(role_id);
            $('#distribusiEdit').val(idDistribusi);
        });
    });

    $('#role_id_edit').change(function() {
        let role = $(this).val();

        if (role == 3) {
            $('#div-distribusi-edit').removeClass("d-none");
        } else {
            $('#div-distribusi-edit').addClass("d-none");
        }
    });
</script>