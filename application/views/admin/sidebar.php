<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">INVENTARIS</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">INV</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard <?= ($this->dt_user->role_id == 1) ? 'Admin' : 'PJ'; ?></li>

            <!-- dashboard -->
            <li class="<?= ($this->uri->segment(2) == 'home') ? 'active' : ''; ?>"><a class="nav-link" href="<?= base_url('admin/home'); ?>"><i class="fas fa-fire"></i> <span>Dashboard</span></a></li>

            <!-- data barang -->
            <li class="menu-header">Master data</li>

            <li class="<?= ($this->uri->segment(2) == 'distribusi') ? 'active' : ''; ?>"><a class="nav-link" href="<?= base_url('admin/distribusi'); ?>"><i class="fas fa- fa-archive"></i> <span>Distribusi</span></a></li>

            <li class="nav-item dropdown" id="clickable">
                <a href="#" class="nav-link has-dropdown"><i class="far fa-file-alt"></i> <span>Data Barang</span></a>
                <ul class="dropdown-menu">
                    <li class="<?= ($this->uri->segment(2) == 'kategori') ? 'active' : ''; ?>"><a class="nav-link" href="<?= base_url('admin/kategori'); ?>"><i class="fas fa-users"></i> <span>Kategori</span></a></li>
                    <li class="<?= ($this->uri->segment(2) == 'barang_masuk') ? 'active' : ''; ?>"><a class="nav-link" href="<?= base_url('admin/barang_masuk'); ?>"><i class="fas fa-users"></i> <span>Barang Masuk</span></a></li>

                    <li class="<?= ($this->uri->segment(2) == 'barang_keluar') ? 'active' : ''; ?>"><a class="nav-link" href="<?= base_url('admin/barang_keluar'); ?>"><i class="fas fa-user"></i> <span>Barang Keluar</span></a></li>
                    <li class="<?= ($this->uri->segment(2) == 'barang_lima_tahun') ? 'active' : ''; ?>"><a class="nav-link" href="<?= base_url('admin/barang_lima_tahun'); ?>"><i class="fas fa-user"></i> <span>Barang > 5 Tahun</span></a></li>
                </ul>
            </li>

            <!-- complain -->
            <li class="menu-header">Complain</li>

            <li class="<?= ($this->uri->segment(2) == 'helpdesk') ? 'active' : ''; ?>"><a class="nav-link" href="<?= base_url('admin/helpdesk'); ?>"><i class="fas  fa-hourglass-start"></i> <span>Helpdesk</span></a></li>

            <li class="<?= ($this->uri->segment(2) == 'barang_rusak') ? 'active' : ''; ?>"><a class="nav-link" href="<?= base_url('admin/barang_rusak'); ?>"><i class="fas fa- fa-archive"></i> <span>Barang Rusak</span></a></li>

            <!-- setting user -->
            <li class="menu-header">Settings</li>
            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="far fa-file-alt"></i> <span>Management Users</span></a>
                <ul class="dropdown-menu">
                    <?php if ($this->dt_user->role_id == 1) : ?>
                        <li class="<?= ($this->uri->segment(2) == 'user') ? 'active' : ''; ?>"><a class="nav-link" href="<?= base_url('admin/user'); ?>"><i class="fas fa-users"></i> <span>List User</span></a></li>
                    <?php endif; ?>
                    <!-- admin -->
                    <li class="<?= ($this->uri->segment(2) == 'profile') ? 'active' : ''; ?>"><a class="nav-link" href="<?= base_url('admin/profile'); ?>"><i class="fas fa-user"></i> <span>Profile</span></a></li>
                </ul>
            </li>

            <li class=""><a class="nav-link" href="#" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-sign-out-alt"></i> <span>Logout</span></a></li>
        </ul>
    </aside>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Yakin untuk keluar dari halaman ini?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <a class="btn btn-danger" href="<?= base_url('auth/logout'); ?>">Logout</a>
            </div>
        </div>
    </div>
</div>

<script>
    var url = window.location.href
    var parts = url.split("/")
    var route = parts[parts.length - 1]

    if (route) {
        var link = $('a[href*="/' + route + '"]');
        link.closest('ul').closest('li').addClass('active');
        link.parent('li').addClass('active');
    }
</script>