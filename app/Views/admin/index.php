<?= $this->extend('layout/admin_template'); ?>
<?= $this->section('admcontent'); ?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <!-- Pending Requests Card Total User -->
        <div class="col-xl-3 col-md-4 mb-3">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total User</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $tuser; ?></div>
                        </div>
                        <div class="col-auto">
                            <span class="fa-stack">
                                <i class="fa fa-square fa-stack-2x" style="color: lightsteelblue;"></i>
                                <i class="fa fa-user fa-stack-1x" style="color: blue;"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-4 mb-3">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Stasiun</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $tstasiun; ?></div>
                        </div>
                        <div class="col-auto">
                            <span class="fa-stack">
                                <i class="fa fa-square fa-stack-2x" style="color: orchid;"></i>
                                <i class="fa fa-tint fa-stack-1x" style="color: pink;"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-4 mb-3">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Mitra</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">2</div>
                        </div>
                        <div class="col-auto">
                            <span class="fa-stack">
                                <i class="fa fa-square fa-stack-2x" style="color: orange;"></i>
                                <i class="fa fa-handshake fa-stack-1x" style="color: yellow;"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Voucher yang belum digunakan</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= number_format($tvbaru, 0, ",", "."); ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-cart-plus fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Voucher yang telah digunakan</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Rp <?= number_format($tvlama, 0, ",", "."); ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-cart-arrow-down fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Transaksi User</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Rp <?= number_format($tambil, 0, ",", "."); ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-cart-arrow-down fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Pembelian langsug</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Rp <?= number_format($tbeli, 0, ",", "."); ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Row -->

    <div class="row">

        <!-- Area Chart -->
        <div class="col-xl-12 col-lg-7">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">user Akuisisi</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-bar">
                        <canvas id="myUserChart" style="width: 754px; height: 377px;"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <!-- Area Chart -->
        <div class=" col-xl-12 col-lg-7">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Status Stasiun Spairum</h6>
                    <!-- <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                            <div class="dropdown-header">Dropdown Header:</div>
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </div> -->
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <!-- <div class="chart-bar">
                        <canvas id="myBarChart"></canvas>
                    </div> -->
                    <div class="card-body">
                        <?php foreach ($stasiun as $ts) : ?>
                            <?php
                            $isi = ($ts['isi'] / 1020) * 100;
                            ?>
                            <h4 class="small font-weight-bold"><?= $ts['lokasi']; ?><span class="float-right"><?= $ts['isi']; ?></span></h4>
                            <div class="progress mb-4">
                                <div class="progress-bar" role="progressbar" style="width: <?= $isi; ?>%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Pending Requests Card Example -->
    <!-- <div class="col-xl-6 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Jumlah air yang telah di isi ulang User</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= number_format($tkerdit, 0, ",", "."); ?></div>
                    </div>
                    <div class="col-auto">
                        <span class="fa-stack">
                            <i class="fa fa-square fa-stack-2x" style="color: palegreen;"></i>
                            <i class="fa fa-check-circle fa-stack-1x" style="color: lime;"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div> -->

    <!-- Pending Requests Card Example -->
    <!-- <div class="col-xl-6 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Jumlah Air yang belum di isi ulang user</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= number_format($tdebit, 0, ",", "."); ?></div>
                    </div>
                    <div class="col-auto">
                        <span class="fa-stack">
                            <i class="fa fa-square fa-stack-2x" style="color: pink;"></i>
                            <i class="fa fa-times-circle fa-stack-1x" style="color: red;"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
</div>


<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->

<?= $this->endSection('admcontent'); ?>

<?= $this->section('script'); ?>
<script src="/js/userchart.js"></script>

<?= $this->endSection('script'); ?>