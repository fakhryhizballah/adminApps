<?= $this->extend('layout/admin_template'); ?>
<?= $this->section('admcontent'); ?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <!-- <div class="card mb-3" style="max-width: 540px;">
        <div class="row no-gutters">
            <div class="col-md-4">
                <img class="card-img" src="">
            </div>

            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title">Fakhry</h5>
                    <p class="card-text">D1021181063</p>
                    <p class="card-text">gang</p>
                    <p class="card-text"><small class="text-muted">Member since </small></p>
                </div>
            </div>
        </div>
    </div> -->
    <div class="row">
        <?php $i = 0; ?>
        <?php foreach ($tuser as $t) : ?>

            <?php $i++;  ?>
        <?php endforeach; ?>
        <!-- Pending Requests Card Example -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total User</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $i; ?></div>
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
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Mitra</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">100</div>
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

        <?php $i = 0; ?>
        <?php foreach ($tstasiun as $s) : ?>

            <?php $i++;  ?>
        <?php endforeach; ?>
        <!-- Pending Requests Card Example -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Stasiun</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $i; ?></div>
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
    </div>

    <!-- Content Row -->

    <div class="row">

        <!-- Area Chart -->
        <div class="col-xl-12 col-lg-7">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Grafik Pengisian Air Galon</h6>
                    <div class="dropdown no-arrow">
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
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="myAreaChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Pending Requests Card Example -->
        <div class="col-xl-6 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Jumlah air yang sudah dibayar {Liter}</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">2000 Liter</div>
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
        </div>

        <!-- Pending Requests Card Example -->
        <div class="col-xl-6 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Jumlah air yang belum dibayar {Liter}</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">100 Liter</div>
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
        </div>
    </div>


    <!-- /.container-fluid -->
</div>
<!-- End of Main Content -->

<?= $this->endSection('admcontent'); ?>