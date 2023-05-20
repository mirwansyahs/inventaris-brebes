<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title><?= $title; ?></title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/node_modules/bootstrap-social/bootstrap-social.css">

    <!-- Template CSS -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/style.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/components.css">

    <link rel="stylesheet" href="<?= base_url(); ?>assets/modules/izitoast/css/iziToast.min.css">
</head>

<body>
    <div class="toastr-success" data-flashdata="<?= $this->session->flashdata('toastr-success'); ?>"></div>
    <div class="toastr-error" data-flashdata="<?= $this->session->flashdata('toastr-error'); ?>"></div>

    <div id="app">
        <section class="section">
            <div class="container mt-3">
                <div class="row">
                    <div class="col-md-12 col-lg-4 col-xl-4">

                        <div class="card">
                            <div class="card-header bg-primary">
                                <h4 class="text-white">Detail Barang</h4>
                            </div>

                            <?php if ($barang) : ?>
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
                            <?php else : ?>
                                <div class="alert alert-danger">Barang tidak ditemukan, silahkan scan Code QR yang valid</div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-8 col-xl-8">
                        <div class="card">
                            <div class="card-header bg-primary">
                                <h4 class="text-white">Riwayat Pemeliharaan</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped" id="table-1">
                                        <thead>
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th>Jumlah yang dilaporkan</th>
                                                <th>Tanggal</th>
                                                <th>Keluhan</th>
                                                <th>Tindakan</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($riwayat as $i => $help) : ?>
                                                <tr>
                                                    <td class="text-center"><?= $i + 1; ?></td>
                                                    <td><?= $help->jumlahBarang; ?></td>
                                                    <td><?= $help->tanggal; ?></td>
                                                    <td><?= $help->keterangan; ?></td>
                                                    <td><?= $help->tindakan; ?></td>
                                                    <td><?= $help->status; ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="simple-footer">
                        Copyright &copy; Stisla 2018
                    </div>
                </div>
            </div>
    </div>
    </section>
    </div>

    <!-- General JS Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/stisla.js"></script>

    <!-- JS Libraies -->
    <script src="<?= base_url(); ?>assets/modules/izitoast/js/iziToast.min.js"></script>

    <!-- Template JS File -->
    <script src="<?= base_url(); ?>assets/js/scripts.js"></script>
    <script src="<?= base_url(); ?>assets/js/custom.js"></script>

    <!-- Page Specific JS File -->
    <script src="<?= base_url(); ?>assets/js/page/modules-toastr.js"></script>

    <script>
        var success = $('.toastr-success').data('flashdata');
        var error = $('.toastr-error').data('flashdata');

        if (success) {
            iziToast.success({
                title: 'success',
                message: success,
                position: 'topRight'
            });
        }

        if (error) {
            iziToast.error({
                title: 'Error',
                message: error,
                position: 'topRight'
            });
        }
    </script>
</body>

</html>