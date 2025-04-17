<?php
    $level = $this->session->userdata('level');
    $dept  = $this->session->userdata('dept_code');
?>
<div class="row align-items-center" style="margin-bottom: 20px;">
    <div class="col-sm-10">
        <h2 style="font-weight: normal;">Welcome to Departments Inventory Online</h2>
    </div>
    <?php if ($dept == 'PCS') {?>
        <div class="col-sm-2 d-flex justify-content-end align-items-center">
            <label for="deptMenu" class="mb-0 mr-2">Pilih Departemen:</label>
            <select id="deptMenu" class="form-control" style="width: auto;">
                <option value="dit" selected>DIT</option>
                <option value="fin">FIN</option>
                <option value="lab">LAB</option>
                <option value="qcf">QCF</option>
                <option value="mtc">MTC</option>
                <option value="ppc">PPC</option>
                <option value="brs">BRS</option>
                <option value="cqa">CQA</option>
            </select>
        </div>
    <?php }?>
</div>

<div class="push">
    <ol class="breadcrumb">
        <li><i class='fa fa-home'></i>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             <?php echo anchor('dashboard', "Dashboard"); ?></li>
    </ol>
</div>

<?php

if ($level == 1) {?>
    <div class="col-sm-3">
        <table class="table table-bordered">
            <tr class="success">
                <th>Users Manajemen</th>
            </tr>
            <tr>
                <th>Untuk menambah atau mengupdate data users</th>
            </tr>
            <tr>
                <th><?php echo anchor('users', 'Masuk', ['class' => 'btn btn-danger']); ?></th>
            </tr>
        </table>
    </div>
<?php } elseif ($level == 2) {?>
    <div class="col-sm-4">
        <table class="table table-bordered">
            <tr class="success">
                <th>Departments Device</th>
            </tr>
            <tr>
                <th>Daftar</th>
            </tr>
            <tr>
                <th><?php echo anchor('dimp', 'Masuk', ['class' => 'btn btn-danger']); ?></th>
            </tr>
        </table>
    </div>
    <div class="col-sm-4">
        <table class="table table-bordered">
            <tr class="success">
                <th>Kartu Riwayat Mesin</th>
            </tr>
            <tr>
                <th>Daftar Induk Mesin dan Prasarana</th>
            </tr>
            <tr>
                <th><?php echo anchor('dimp', 'Masuk', ['class' => 'btn btn-danger']); ?></th>
            </tr>
        </table>
    </div>
<?php } elseif ($dept == 'MTC') {?>
    <div class="col-sm-4">
        <table class="table table-bordered">
            <tr class="success">
                <th>Departments Device</th>
            </tr>
            <tr>
                <th>Daftar Kartu Riwayat Mesin MTC <br> &nbsp;</th>
            </tr>
            <tr>
                <th><a href="<?php echo base_url('kartu_riwayat/kartu_riwayat_mtc'); ?>" class="btn btn-primary">MASUK</a></th>
            </tr>
        </table>
    </div>
    <div class="col-sm-4">
        <table class="table table-bordered">
            <tr class="success">
                <th>Forms</th>
            </tr>
            <tr>
                <th>Kartu Stock MTC <br> &nbsp; </th>
            </tr>
            <tr>
                <th><a href="<?php echo base_url('kartu_riwayat/kartu_stock_mtc'); ?>" class="btn btn-success">MASUK</a></th>
            </tr>
        </table>
    </div>
<?php } elseif ($dept == 'PPC') {?>
    <div class="col-sm-4">
        <table class="table table-bordered">
            <tr class="success">
                <th>Departments Device</th>
            </tr>
            <tr>
                <th>Daftar Kartu Riwayat PPC Transport<br> &nbsp;</th>
            </tr>
            <tr>
                <th><a href="<?php echo base_url('kartu_riwayat/kartu_riwayat_transport'); ?>" class="btn btn-primary">MASUK</a></th>
            </tr>
        </table>
    </div>

    <div class="col-sm-4">
        <table class="table table-bordered">
            <tr class="success">
                <th>Forms</th>
            </tr>
            <tr>
                <th>Kartu Stock PPC Transport <br> &nbsp; </th>
            </tr>
            <tr>
                <th><a href="<?php echo base_url('kartu_riwayat/kartu_stock_transport'); ?>" class="btn btn-success">MASUK</a></th>
            </tr>
        </table>
    </div>
<?php } elseif ($dept == 'FIN') {?>
        <div class="col-sm-4">
            <table class="table table-bordered">
                <tr class="success">
                    <th>Forms</th>
                </tr>
                <tr>
                    <th>Kartu Stock Finishing <br> &nbsp; </th>
                </tr>
                <tr>
                    <th><a href="<?php echo base_url('kartu_riwayat/kartu_stock_fin'); ?>" class="btn btn-success">MASUK</a></th>
                </tr>
            </table>
        </div>
        <div class="col-sm-4">
            <table class="table table-bordered">
                <tr class="success">
                    <th>Forms</th>
                </tr>
                <tr>
                    <th>Kartu Stock ATK FIN<br> &nbsp; </th>
                </tr>
                <tr>
                    <th><a href="<?php echo base_url('kartu_riwayat/kartu_stock_atk_fin'); ?>" class="btn btn-success">MASUK</a></th>
                </tr>
            </table>
        </div>
<?php } elseif ($dept == 'LAB') {?>
        <div class="col-sm-4">
            <table class="table table-bordered">
                <tr class="success">
                    <th>Forms</th>
                </tr>
                <tr>
                    <th>Kartu Stock ATK LAB<br> &nbsp; </th>
                </tr>
                <tr>
                    <th><a href="<?php echo base_url('kartu_riwayat/kartu_stock_atk_lab'); ?>" class="btn btn-success">MASUK</a></th>
                </tr>
            </table>
        </div>
<?php } elseif ($dept == 'BRS') {?>
        <div class="col-sm-4">
            <table class="table table-bordered">
                <tr class="success">
                    <th>Forms</th>
                </tr>
                <tr>
                    <th>Kartu Stock ATK BRS<br> &nbsp; </th>
                </tr>
                <tr>
                    <th><a href="<?php echo base_url('kartu_riwayat/kartu_stock_atk_brs'); ?>" class="btn btn-success">MASUK</a></th>
                </tr>
            </table>
        </div>
<?php } elseif ($dept == 'CQA') {?>
        <div class="col-sm-4">
            <table class="table table-bordered">
                <tr class="success">
                    <th>Forms</th>
                </tr>
                <tr>
                    <th>Kartu Stock ATK CQA<br> &nbsp; </th>
                </tr>
                <tr>
                    <th><a href="<?php echo base_url('kartu_riwayat/kartu_stock_atk_cqa'); ?>" class="btn btn-success">MASUK</a></th>
                </tr>
            </table>
        </div>
<?php } elseif ($dept == 'PCS') {?>
    <div class="menu-block dit" style="display: none;">
        <div class="col-sm-4">
            <table class="table table-bordered">
                <tr class="success">
                    <th>Departments Device</th>
                </tr>
                <tr>
                    <th>Daftar Induk Mesin dan Prasarana</th>
                </tr>
                <tr>
                    <th><?php echo anchor('dimp', 'Masuk', ['class' => 'btn btn-danger']); ?></th>
                </tr>
            </table>
        </div>

        <div class="col-sm-4">
            <table class="table table-bordered">
                <tr class="success">
                    <th>Departments Device</th>
                </tr>
                <tr>
                    <th>Daftar Kartu Riwayat Mesin</th>
                </tr>
                <tr>
                    <th><a href="<?php echo base_url('kartu_riwayat'); ?>" class="btn btn-danger">MASUK</a></th>
                </tr>
            </table>
        </div>

        <div class="col-sm-4">
            <table class="table table-bordered">
                <tr class="success">
                    <th>Departments Device</th>
                </tr>
                <tr>
                    <th>Daftar Kartu Riwayat Mesin NOW</th>
                </tr>
                <tr>
                    <th><a href="<?php echo base_url('kartu_riwayat/index_NOW'); ?>" class="btn btn-primary">MASUK</a></th>
                </tr>
            </table>
        </div>

        <div class="col-sm-4">
            <table class="table table-bordered">
                <tr class="success">
                    <th>Forms</th>
                </tr>
                <tr>
                    <th>Forms Pemakaian Spare Parts Open Tiket <br> Form Pemakaian Spare Parts Internal Document</th>
                </tr>
                <tr>
                    <th><a href="<?php echo base_url('kartu_riwayat/pemakaian_spare_parts'); ?>" class="btn btn-success">MASUK</a></th>
                </tr>
            </table>
        </div>

        <div class="col-sm-4">
            <table class="table table-bordered">
                <tr class="success">
                    <th>Forms</th>
                </tr>
                <tr>
                    <th>Kartu Stock DIT <br> Laporan Stock All</th>
                </tr>
                <tr>
                    <th><a href="<?php echo base_url('kartu_riwayat/kartu_stock'); ?>" class="btn btn-success">MASUK</a></th>
                </tr>
            </table>

            <table class="table table-bordered">
                <tr class="success">
                    <th>Forms</th>
                </tr>
                <tr>
                    <th>Kartu Stock Supplies & ATK <br> &nbsp; </th>
                </tr>
                <tr>
                    <th><a href="<?php echo base_url('kartu_riwayat/kartu_stock_atk'); ?>" class="btn btn-success">MASUK</a></th>
                </tr>
            </table>
        </div>

        <div class="col-sm-4">
            <table class="table table-bordered">
                <tr class="success">
                    <th>Laporan Ticket</th>
                </tr>
                <tr>
                    <th>Laporan Ticket <br> &nbsp; </th>
                </tr>
                <tr>
                    <th><a href="<?php echo base_url('kartu_riwayat/laporan_open_tiket'); ?>" class="btn btn-success">MASUK</a></th>
                </tr>
            </table>
        </div>

        <div class="col-sm-4">
            <table class="table table-bordered">
                <tr class="success">
                    <th>Forms</th>
                </tr>
                <tr>
                    <th>Kartu Stock DIT By Date <br> Laporan Stock All</th>
                </tr>
                <tr>
                    <th><a href="<?php echo base_url('kartu_riwayat/kartu_stock_bydate'); ?>" class="btn btn-success">MASUK</a></th>
                </tr>
            </table>
        </div>
    </div>

    <div class="menu-block fin" style="display: none;">
        <div class="col-sm-4">
            <table class="table table-bordered">
                <tr class="success">
                    <th>Forms</th>
                </tr>
                <tr>
                    <th>Kartu Stock Finishing <br> &nbsp; </th>
                </tr>
                <tr>
                    <th><a href="<?php echo base_url('kartu_riwayat/kartu_stock_fin'); ?>" class="btn btn-success">MASUK</a></th>
                </tr>
            </table>
        </div>

        <div class="col-sm-4">
            <table class="table table-bordered">
                <tr class="success">
                    <th>Forms</th>
                </tr>
                <tr>
                    <th>Kartu Stock ATK FIN<br> &nbsp; </th>
                </tr>
                <tr>
                    <th><a href="<?php echo base_url('kartu_riwayat/kartu_stock_atk_fin'); ?>" class="btn btn-success">MASUK</a></th>
                </tr>
            </table>
        </div>
    </div>

    <div class="menu-block lab" style="display: none;">
        <div class="col-sm-4">
            <table class="table table-bordered">
                <tr class="success">
                    <th>Forms</th>
                </tr>
                <tr>
                    <th>Kartu Stock ATK LAB<br> &nbsp; </th>
                </tr>
                <tr>
                    <th><a href="<?php echo base_url('kartu_riwayat/kartu_stock_atk_lab'); ?>" class="btn btn-success">MASUK</a></th>
                </tr>
            </table>
        </div>
    </div>

    <div class="menu-block qcf" style="display: none;">
        <b>QCF Content</b>
    </div>

    <div class="menu-block mtc" style="display: none;">
        <div class="col-sm-4">
            <table class="table table-bordered">
                <tr class="success">
                    <th>Departments Device</th>
                </tr>
                <tr>
                    <th>Daftar Kartu Riwayat Mesin MTC <br> &nbsp;</th>
                </tr>
                <tr>
                    <th><a href="<?php echo base_url('kartu_riwayat/kartu_riwayat_mtc'); ?>" class="btn btn-primary">MASUK</a></th>
                </tr>
            </table>
        </div>

        <div class="col-sm-4">
            <table class="table table-bordered">
                <tr class="success">
                    <th>Forms</th>
                </tr>
                <tr>
                    <th>Kartu Stock MTC <br> &nbsp; </th>
                </tr>
                <tr>
                    <th><a href="<?php echo base_url('kartu_riwayat/kartu_stock_mtc'); ?>" class="btn btn-success">MASUK</a></th>
                </tr>
            </table>
        </div>
    </div>

    <div class="menu-block ppc" style="display: none;">
        <div class="col-sm-4">
            <table class="table table-bordered">
                <tr class="success">
                    <th>Departments Device</th>
                </tr>
                <tr>
                    <th>Daftar Kartu Riwayat PPC Transport<br> &nbsp;</th>
                </tr>
                <tr>
                    <th><a href="<?php echo base_url('kartu_riwayat/kartu_riwayat_transport'); ?>" class="btn btn-primary">MASUK</a></th>
                </tr>
            </table>
        </div>

        <div class="col-sm-4">
            <table class="table table-bordered">
                <tr class="success">
                    <th>Forms</th>
                </tr>
                <tr>
                    <th>Kartu Stock PPC Transport <br> &nbsp; </th>
                </tr>
                <tr>
                    <th><a href="<?php echo base_url('kartu_riwayat/kartu_stock_transport'); ?>" class="btn btn-success">MASUK</a></th>
                </tr>
            </table>
        </div>
    </div>

    <div class="menu-block brs" style="display: none;">
        <div class="col-sm-4">
            <table class="table table-bordered">
                <tr class="success">
                    <th>Forms</th>
                </tr>
                <tr>
                    <th>Kartu Stock ATK BRS<br> &nbsp; </th>
                </tr>
                <tr>
                    <th><a href="<?php echo base_url('kartu_riwayat/kartu_stock_atk_brs'); ?>" class="btn btn-success">MASUK</a></th>
                </tr>
            </table>
        </div>
    </div>

    <div class="menu-block cqa" style="display: none;">
        <div class="col-sm-4">
            <table class="table table-bordered">
                <tr class="success">
                    <th>Forms</th>
                </tr>
                <tr>
                    <th>Kartu Stock ATK CQA<br> &nbsp; </th>
                </tr>
                <tr>
                    <th><a href="<?php echo base_url('kartu_riwayat/kartu_stock_atk_cqa'); ?>" class="btn btn-success">MASUK</a></th>
                </tr>
            </table>
        </div>
    </div>
<?php } else {?>
    <div class="col-sm-4">
        <table class="table table-bordered">
            <tr class="success">
                <th>Departments Device</th>
            </tr>
            <tr>
                <th>Daftar Induk Mesin dan Prasarana</th>
            </tr>
            <tr>
                <th><?php echo anchor('dimp', 'Masuk', ['class' => 'btn btn-danger']); ?></th>
            </tr>
        </table>
    </div>
    <div class="col-sm-4">
        <table class="table table-bordered">
            <tr class="success">
                <th>Departments Device</th>
            </tr>
            <tr>
                <th>Daftar Kartu Riwayat Mesin</th>
            </tr>
            <tr>
                <th><a href="<?php echo base_url('kartu_riwayat'); ?>" class="btn btn-danger">MASUK</a></th>
            </tr>
        </table>
    </div>
    <div class="col-sm-4">
        <table class="table table-bordered">
            <tr class="success">
                <th>Departments Device</th>
            </tr>
            <tr>
                <th>Daftar Kartu Riwayat Mesin NOW</th>
            </tr>
            <tr>
                <th><a href="<?php echo base_url('kartu_riwayat/index_NOW'); ?>" class="btn btn-primary">MASUK</a></th>
            </tr>
        </table>
    </div>
    <div class="col-sm-4">
        <table class="table table-bordered">
            <tr class="success">
                <th>Forms</th>
            </tr>
            <tr>
                <th>Forms Pemakaian Spare Parts Open Tiket <br> Form Pemakaian Spare Parts Internal Document</th>
            </tr>
            <tr>
                <th><a href="<?php echo base_url('kartu_riwayat/pemakaian_spare_parts'); ?>" class="btn btn-success">MASUK</a></th>
            </tr>
        </table>
    </div>
    <div class="col-sm-4">
        <table class="table table-bordered">
            <tr class="success">
                <th>Forms</th>
            </tr>
            <tr>
                <th>Kartu Stock DIT <br> Laporan Stock All</th>
            </tr>
            <tr>
                <th><a href="<?php echo base_url('kartu_riwayat/kartu_stock'); ?>" class="btn btn-success">MASUK</a></th>
            </tr>
        </table>

        <table class="table table-bordered">
            <tr class="success">
                <th>Forms</th>
            </tr>
            <tr>
                <th>Kartu Stock Supplies & ATK <br> &nbsp; </th>
            </tr>
            <tr>
                <th><a href="<?php echo base_url('kartu_riwayat/kartu_stock_atk'); ?>" class="btn btn-success">MASUK</a></th>
            </tr>
        </table>
    </div>
    <div class="col-sm-4">
        <table class="table table-bordered">
            <tr class="success">
                <th>Laporan Ticket</th>
            </tr>
            <tr>
                <th>Laporan Ticket <br> &nbsp; </th>
            </tr>
            <tr>
                <th><a href="<?php echo base_url('kartu_riwayat/laporan_open_tiket'); ?>" class="btn btn-success">MASUK</a></th>
            </tr>
        </table>
    </div>
    <div class="col-sm-4">
        <table class="table table-bordered">
            <tr class="success">
                <th>Forms</th>
            </tr>
            <tr>
                <th>Kartu Stock DIT By Date <br> Laporan Stock All</th>
            </tr>
            <tr>
                <th><a href="<?php echo base_url('kartu_riwayat/kartu_stock_bydate'); ?>" class="btn btn-success">MASUK</a></th>
            </tr>
        </table>
    </div>
<?php }?>

<script>
    document.getElementById("deptMenu").addEventListener("change", function () {
        var selected = this.value;
        var blocks = document.querySelectorAll(".menu-block");

        blocks.forEach(function (block) {
            if (block.classList.contains(selected)) {
                block.style.display = "block";
            } else {
                block.style.display = "none";
            }
        });
    });

    window.addEventListener("DOMContentLoaded", function () {
        document.getElementById("deptMenu").dispatchEvent(new Event("change"));
    });
</script>
