<div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#penjualan" data-toggle="tab">Penjualan</a></li>
        <li><a href="#kutipan" data-toggle="tab">Kutipan</a></li>
        <li><a href="#pembelian" data-toggle="tab">Pembelian</a></li>
        <li><a href="#transfer" data-toggle="tab">Transfer</a></li>
        <li><a href="#pelanggan" data-toggle="tab">Pelanggan</a></li>
        <li><a href="#pemasok" data-toggle="tab">Pemasok</a></li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="penjualan">
        <div class="row">
            <div class="col-lg-8">
                <table id="datatable" class="table table-bordered table-striped">
                    <thead>
                    <tr class="bg-gray" role="row">
                        <th class="text-center">Invoice ID</th>
                        <th class="text-center">Tgl. Pembuatan</th>
                        <th class="text-center">Nama Pelanggan</th>
                        <th class="text-center">Amount</th>
                        <th class="text-center">Status Pembayaran</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr class="text-center">
                            <td>52023/00035880</td>
                            <td>2023-01-04 10:14:02</td>
                            <td>DEWI SEPTIA</td>
                            <td>55,000</td>
                            <td><span class="badge btn-success">Lunas</span></td>
                        </tr>
                        <tr class="text-center">
                            <td>52023/00035880</td>
                            <td>2023-01-04 10:14:02</td>
                            <td>DEWI SEPTIA</td>
                            <td>55,000</td>
                            <td><span class="badge btn-success">Lunas</span></td>
                        </tr>
                        <tr class="text-center">
                            <td>52023/00035880</td>
                            <td>2023-01-04 10:14:02</td>
                            <td>DEWI SEPTIA</td>
                            <td>55,000</td>
                            <td><span class="badge btn-success">Lunas</span></td>
                        </tr>
                        <tr class="text-center">
                            <td>52023/00035880</td>
                            <td>2023-01-04 10:14:02</td>
                            <td>DEWI SEPTIA</td>
                            <td>55,000</td>
                            <td><span class="badge btn-success">Lunas</span></td>
                        </tr>
                        <tr class="text-center">
                            <td>52023/00035880</td>
                            <td>2023-01-04 10:14:02</td>
                            <td>DEWI SEPTIA</td>
                            <td>55,000</td>
                            <td><span class="badge btn-success">Lunas</span></td>
                        </tr>
                    </tbody>
                </table>
                <button class="btn btn-info btn-sm"> <i class="fa fa-plus"></i> Tambah Penjualan </button>
                <button class="btn btn-success btn-sm"> <i class="fa fa-list"></i> Daftar Penjualan </button>
            </div>
            <div class="col-lg-4">
                <div class="progress-group-container">
                    <div class="progress-group">
                        <span class="progress-text"><b>Nilai Penjualan</b></span>
                        <span class="progress-number pull-right">1500</span>
                        <div class="progress progress-sm">
                            <div class="progress-bar progress-bar-aqua" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                <span class="sr-only">100% Complete (success)</span>
                            </div>
                        </div>
                    </div>
                    <div class="progress-group">
                        <span class="progress-text"><b>Pemberian Discount</b></span>
                        <span class="progress-number pull-right">1500</span>
                        <div class="progress progress-sm">
                            <div class="progress-bar progress-bar-aqua" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                                <span class="sr-only">40% Complete (success)</span>
                            </div>
                        </div>
                    </div>
                    <div class="progress-group">
                        <span class="progress-text"><b>Jatuh Tempo</b></span>
                        <span class="progress-number pull-right">1500</span>
                        <div class="progress progress-sm">
                            <div class="progress-bar progress-bar-aqua" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                                <span class="sr-only">0% Complete (success)</span>
                            </div>
                        </div>
                    </div>
                    <div class="progress-group">
                        <span class="progress-text"><b>Nilai Penerimaan</b></span>
                        <span class="progress-number pull-right">1500</span>
                        <div class="progress progress-sm">
                            <div class="progress-bar progress-bar-green" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                <span class="sr-only">100% Complete (success)</span>
                            </div>
                        </div>
                    </div>

                    <button class="btn btn-warning btn-sm btn-block"> Laporan Ikhtisar → </button>
                </div>
            </div>
        </div>
        </div>
        <!-- /.tab-pane -->
        <div class="tab-pane" id="kutipan">
            <table id="datatable" class="table table-bordered table-striped">
                <thead>
                <tr class="bg-gray" role="row">
                    <th class="text-center">Tanggal</th>
                    <th class="text-center">No Referensi</th>
                    <th class="text-center">Pelanggan</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Amount</th>
                </tr>
                </thead>
                <tbody>
                    <tr class="text-center">
                        <td>52023/00035880</td>
                        <td>2023-01-04 10:14:02</td>
                        <td>DEWI SEPTIA</td>
                        <td>55,000</td>
                        <td><span class="badge btn-success">Lunas</span></td>
                    </tr>
                </tbody>
            </table>
            <button class="btn btn-info btn-sm"> <i class="fa fa-plus"></i> Tambah Quotations </button>
            <button class="btn btn-success btn-sm"> <i class="fa fa-list"></i> Daftar Quotations </button>
        </div>
        <!-- /.tab-pane -->
        <div class="tab-pane" id="pembelian">
            <table id="datatable" class="table table-bordered table-striped">
                <thead>
                <tr class="bg-gray" role="row">
                    <th class="text-center">Invoice ID</th>
                    <th class="text-center">Tgl. Pembuatan</th>
                    <th class="text-center">Nama Pemasok</th>
                    <th class="text-center">Amount</th>
                    <th class="text-center">Status Pembayaran</th>
                </tr>
                </thead>
                <tbody>
                    <tr class="text-center">
                        <td>52023/00035880</td>
                        <td>2023-01-04 10:14:02</td>
                        <td>DEWI SEPTIA</td>
                        <td>55,000</td>
                        <td><span class="badge btn-success">Lunas</span></td>
                    </tr>
                    <tr class="text-center">
                        <td>52023/00035880</td>
                        <td>2023-01-04 10:14:02</td>
                        <td>DEWI SEPTIA</td>
                        <td>55,000</td>
                        <td><span class="badge btn-success">Lunas</span></td>
                    </tr>
                    <tr class="text-center">
                        <td>52023/00035880</td>
                        <td>2023-01-04 10:14:02</td>
                        <td>DEWI SEPTIA</td>
                        <td>55,000</td>
                        <td><span class="badge btn-success">Lunas</span></td>
                    </tr>
                    <tr class="text-center">
                        <td>52023/00035880</td>
                        <td>2023-01-04 10:14:02</td>
                        <td>DEWI SEPTIA</td>
                        <td>55,000</td>
                        <td><span class="badge btn-success">Lunas</span></td>
                    </tr>
                    <tr class="text-center">
                        <td>52023/00035880</td>
                        <td>2023-01-04 10:14:02</td>
                        <td>DEWI SEPTIA</td>
                        <td>55,000</td>
                        <td><span class="badge btn-success">Lunas</span></td>
                    </tr>
                </tbody>
            </table>
            <button class="btn btn-info btn-sm"> <i class="fa fa-plus"></i> Tambah Pembelian </button>
            <button class="btn btn-success btn-sm"> <i class="fa fa-list"></i> Daftar Pembelian </button>
        </div>
        <!-- /.tab-pane -->
        <div class="tab-pane" id="transfer">
            <table id="datatable" class="table table-bordered table-striped">
                <thead>
                <tr class="bg-gray" role="row">
                    <th class="text-center">Tanggal</th>
                    <th class="text-center">Invoice ID</th>
                    <th class="text-center">From</th>
                    <th class="text-center">To</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Kuantitas</th>
                </tr>
                </thead>
                <tbody>
                    <tr class="text-center">
                        <td>2023-01-04 10:14:02</td>
                        <td>52023/00035880</td>
                        <td>Pondo Market 001</td>
                        <td>Pondo Market 002</td>
                        <td>Pending</td>
                        <td>55.000</td>
                    </tr>
                    <tr class="text-center">
                        <td>2023-01-04 10:14:02</td>
                        <td>52023/00035880</td>
                        <td>Pondo Market 001</td>
                        <td>Pondo Market 002</td>
                        <td>Pending</td>
                        <td>55.000</td>
                    </tr>
                    <tr class="text-center">
                        <td>2023-01-04 10:14:02</td>
                        <td>52023/00035880</td>
                        <td>Pondo Market 001</td>
                        <td>Pondo Market 002</td>
                        <td>Pending</td>
                        <td>55.000</td>
                    </tr>
                    <tr class="text-center">
                        <td>2023-01-04 10:14:02</td>
                        <td>52023/00035880</td>
                        <td>Pondo Market 001</td>
                        <td>Pondo Market 002</td>
                        <td>Pending</td>
                        <td>55.000</td>
                    </tr>
                    <tr class="text-center">
                        <td>2023-01-04 10:14:02</td>
                        <td>52023/00035880</td>
                        <td>Pondo Market 001</td>
                        <td>Pondo Market 002</td>
                        <td>Pending</td>
                        <td>55.000</td>
                    </tr>
                </tbody>
            </table>
            <button class="btn btn-info btn-sm"> <i class="fa fa-plus"></i> Tambah Transfer </button>
            <button class="btn btn-success btn-sm"> <i class="fa fa-list"></i> Daftar Transfer </button>
        </div>
        <!-- /.tab-pane -->
        <div class="tab-pane" id="pelanggan">
            <table id="datatable" class="table table-bordered table-striped">
                <thead>
                <tr class="bg-gray" role="row">
                    <th>Nama Pelanggan</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Alamat</th>
                    <th>City</th>
                    <th>Sponsor</th>
                    <th>Tgl. Pembuatan</th>
                </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Zulfan</td>
                        <td>085260017800</td>
                        <td>5a9454@gmail.com</td>
                        <td></td>
                        <td>KOTA BANDA ACEH</td>
                        <td>YAYASAN PONDO ISLAMIC CENTER</td>
                        <td>2023-01-04 10:16:39</td>
                    </tr>
                    <tr>
                        <td>Zulfan</td>
                        <td>085260017800</td>
                        <td>5a9454@gmail.com</td>
                        <td></td>
                        <td>KOTA BANDA ACEH</td>
                        <td>YAYASAN PONDO ISLAMIC CENTER</td>
                        <td>2023-01-04 10:16:39</td>
                    </tr>
                    <tr>
                        <td>Zulfan</td>
                        <td>085260017800</td>
                        <td>5a9454@gmail.com</td>
                        <td></td>
                        <td>KOTA BANDA ACEH</td>
                        <td>YAYASAN PONDO ISLAMIC CENTER</td>
                        <td>2023-01-04 10:16:39</td>
                    </tr>
                    <tr>
                        <td>Zulfan</td>
                        <td>085260017800</td>
                        <td>5a9454@gmail.com</td>
                        <td></td>
                        <td>KOTA BANDA ACEH</td>
                        <td>YAYASAN PONDO ISLAMIC CENTER</td>
                        <td>2023-01-04 10:16:39</td>
                    </tr>
                    <tr>
                        <td>Zulfan</td>
                        <td>085260017800</td>
                        <td>5a9454@gmail.com</td>
                        <td></td>
                        <td>KOTA BANDA ACEH</td>
                        <td>YAYASAN PONDO ISLAMIC CENTER</td>
                        <td>2023-01-04 10:16:39</td>
                    </tr>
                </tbody>
            </table>
            <button class="btn btn-info btn-sm"> <i class="fa fa-plus"></i> Tambah Pelanggan </button>
            <button class="btn btn-success btn-sm"> <i class="fa fa-list"></i> Daftar Pelanggan </button>
        </div>
        <!-- /.tab-pane -->
        <div class="tab-pane" id="pemasok">
            <table id="datatable" class="table table-bordered table-striped">
                <thead>
                <tr class="bg-gray" role="row">
                    <th>Nama Pemasok</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Alamat</th>
                    <th>Tgl. Pembuatan</th>
                </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><a href="">UD . MANCOS</a></td>
                        <td>082272375905</td>
                        <td>ud_._mancos@GMAIL.COM</td>
                        <td>krueng mane</td>
                        <td>2023-01-04 10:14:02</td>
                    </tr>
                    <tr>
                        <td><a href="">UD . MANCOS</a></td>
                        <td>082272375905</td>
                        <td>ud_._mancos@GMAIL.COM</td>
                        <td>krueng mane</td>
                        <td>2023-01-04 10:14:02</td>
                    </tr>
                    <tr>
                        <td><a href="">UD . MANCOS</a></td>
                        <td>082272375905</td>
                        <td>ud_._mancos@GMAIL.COM</td>
                        <td>krueng mane</td>
                        <td>2023-01-04 10:14:02</td>
                    </tr>
                    <tr>
                        <td><a href="">UD . MANCOS</a></td>
                        <td>082272375905</td>
                        <td>ud_._mancos@GMAIL.COM</td>
                        <td>krueng mane</td>
                        <td>2023-01-04 10:14:02</td>
                    </tr>
                    <tr>
                        <td><a href="">UD . MANCOS</a></td>
                        <td>082272375905</td>
                        <td>ud_._mancos@GMAIL.COM</td>
                        <td>krueng mane</td>
                        <td>2023-01-04 10:14:02</td>
                    </tr>
                </tbody>
            </table>
            <button class="btn btn-info btn-sm"> <i class="fa fa-plus"></i> Tambah Pemasok </button>
            <button class="btn btn-success btn-sm"> <i class="fa fa-list"></i> Daftar Pemasok </button>
        </div>
        <!-- /.tab-pane -->
    </div>
    <!-- /.tab-content -->
</div>