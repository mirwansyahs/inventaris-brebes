<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">INVENTARIS</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">INV</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>

            <!-- dashboard -->
            <li class="<?= ($this->uri->segment(2) == 'home') ? 'active' : ''; ?>"><a class="nav-link" href="<?= base_url('user/home'); ?>"><i class="fas fa-fire"></i> <span>Dashboard</span></a></li>

            <!-- data barang -->
            <li class="menu-header">Master data</li>
            <li class="nav-item dropdown" id="clickable">
                <a href="#" class="nav-link has-dropdown"><i class="far fa-file-alt"></i> <span>Data Barang</span></a>
                <ul class="dropdown-menu">
                    <li class="<?= ($this->uri->segment(2) == 'data_barang') ? 'active' : ''; ?>"><a class="nav-link" href="<?= base_url('user/data_barang'); ?>"><i class="fas fa-list"></i> <span>Barang Inventaris</span></a></li>

                    <li class="<?= ($this->uri->segment(2) == 'barang_rusak') ? 'active' : ''; ?>"><a class="nav-link" href="<?= base_url('user/barang_rusak'); ?>"><i class="fas fa-list"></i> <span>Barang Rusak</span></a></li>


                </ul>
            </li>

            <!-- complain -->
            <li class="menu-header">Complain</li>

            <li class="<?= ($this->uri->segment(2) == 'helpdesk') ? 'active' : ''; ?>"><a class="nav-link" href="<?= base_url('user/helpdesk'); ?>"><i class="fas  fa-hourglass-start"></i> <span>Lapor kerusakan</span></a></li>

            <li class="menu-header">Settings</li>

            <li class=""><a class="nav-link" href="<?= base_url('user/profile'); ?>"><i class="fas fa-user"></i> <span>Profile</span></a></li>
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