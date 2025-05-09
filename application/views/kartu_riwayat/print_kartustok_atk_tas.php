<?php

    function formatNumber($number)
    {
        return rtrim(rtrim(number_format($number, 3, '.', ''), '0'), '.');
    }

    // Koneksi MYSQL
    date_default_timezone_set('Asia/Jakarta');
    $con = mysqli_connect("10.0.0.10", "dit", "4dm1n", "dimp");

    // Koneksi DB2
    $hostname = "10.0.0.21";
                             // $database = "NOWTEST"; // SERVER NOW 20
    $database    = "NOWPRD"; // SERVER NOW 22
    $user        = "db2admin";
    $passworddb2 = "Sunkam@24809";
    $port        = "25000";
    $conn_string = "DRIVER={IBM ODBC DB2 DRIVER}; HOSTNAME=$hostname; PORT=$port; PROTOCOL=TCPIP; UID=$user; PWD=$passworddb2; DATABASE=$database;";
    // $conn1 = db2_pconnect($conn_string,'', '');
    $conn1 = db2_connect($conn_string, '', '');
    ini_set("error_reporting", 1);

    // Data Dari POST
    $tglawal   = $date1;
    $tglakhir  = $date2;
    $id_barang = $kode_barang;

    // Ambil data barang stock awal
    $query_barang  = "SELECT * FROM tbl_master_barang_atk_tas where id='$id_barang' LIMIT 1";
    $result_barang = mysqli_query($con, $query_barang);
    $data_barang   = mysqli_fetch_assoc($result_barang);
    // print_r($data_barang);

    $DESCRIPTION   = $data_barang['DESCRIPTION'];
    $ITEMTYPECODE  = $data_barang['ITEMTYPECODE'];
    $DECOSUBCODE01 = $data_barang['DECOSUBCODE01'];
    $DECOSUBCODE02 = $data_barang['DECOSUBCODE02'];
    $DECOSUBCODE03 = $data_barang['DECOSUBCODE03'];
    $DECOSUBCODE04 = $data_barang['DECOSUBCODE04'];
    $DECOSUBCODE05 = $data_barang['DECOSUBCODE05'];
    $DECOSUBCODE06 = $data_barang['DECOSUBCODE06'];
    $UNIOFMEASURE  = $data_barang['UNITOFMEASURE'];

    // Deklarasi Awal
    $stock_awal    = 0;
    $stock_akhir   = 0;
    $stock_awal_db = 0;
    $total_masuk   = 0;
    $total_keluar  = 0;

    $data = [];

    if ($data_barang) {
        $stock_awal_db = $data_barang['STOCK'];
    }

    // Total Masuk
    $query_masuk = "SELECT SUM(USERPRIMARYQUANTITY) AS TOTAL
    FROM STOCKTRANSACTION
    WHERE (TEMPLATECODE ='OPN' OR TEMPLATECODE ='304' OR TEMPLATECODE ='101')
    AND LOGICALWAREHOUSECODE ='M413'
    AND ITEMTYPECODE ='$ITEMTYPECODE'
    AND DECOSUBCODE01 ='$DECOSUBCODE01'
    AND DECOSUBCODE02 ='$DECOSUBCODE02'
    AND DECOSUBCODE03 ='$DECOSUBCODE03'
    AND DECOSUBCODE04 ='$DECOSUBCODE04'
    AND DECOSUBCODE05 ='$DECOSUBCODE05'
    AND DECOSUBCODE06 ='$DECOSUBCODE06'
    AND TRANSACTIONDATE < '$tglawal'
    AND TRANSACTIONDATE > '2025-04-30'";

    $exec_query_masuk  = db2_exec($conn1, $query_masuk);
    $fetch_query_masuk = db2_fetch_assoc($exec_query_masuk);

    if ($fetch_query_masuk) {
        $total_masuk = (float) $fetch_query_masuk['TOTAL'];
    }

    // Total Keluar
    $query_keluar = "SELECT SUM(USERPRIMARYQUANTITY) AS TOTAL
    FROM STOCKTRANSACTION
    WHERE (TEMPLATECODE ='098' OR TEMPLATECODE ='303')
    AND LOGICALWAREHOUSECODE ='M413'
    AND ITEMTYPECODE ='$ITEMTYPECODE'
    AND DECOSUBCODE01 ='$DECOSUBCODE01'
    AND DECOSUBCODE02 ='$DECOSUBCODE02'
    AND DECOSUBCODE03 ='$DECOSUBCODE03'
    AND DECOSUBCODE04 ='$DECOSUBCODE04'
    AND DECOSUBCODE05 ='$DECOSUBCODE05'
    AND DECOSUBCODE06 ='$DECOSUBCODE06'
    AND TRANSACTIONDATE < '$tglawal'
    AND TRANSACTIONDATE > '2025-04-30'";

    $exec_query_keluar  = db2_exec($conn1, $query_keluar);
    $fetch_query_keluar = db2_fetch_assoc($exec_query_keluar);

    if ($fetch_query_keluar) {
        $total_keluar = (float) ($fetch_query_keluar['TOTAL']);
    }

    $stock_awal = ($stock_awal_db + $total_masuk) - $total_keluar;

    $informasi = 'Informasi akumulasi stock awal ' . $tglawal . ', stock awal db : ' . $stock_awal_db .
        ' total masuk: ' . $total_masuk .
        ' total keluar: ' . $total_keluar .
        ' stock awal: ' . $stock_awal;

    // Kalau mau makesure kalkulasi stock awal
    // echo $informasi;

    // List data
    $query_data = "SELECT t.*,a.VALUESTRING as KETERANGAN
        FROM STOCKTRANSACTION t
        LEFT JOIN ADSTORAGE a ON a.UNIQUEID = t.ABSUNIQUEID
        WHERE
        (t.TEMPLATECODE ='OPN'
        OR t.TEMPLATECODE ='304'
        OR t.TEMPLATECODE ='101'
        OR t.TEMPLATECODE ='098'
        OR t.TEMPLATECODE ='303')
        AND t.LOGICALWAREHOUSECODE ='M413'
        AND t.ITEMTYPECODE ='$ITEMTYPECODE'
        AND t.DECOSUBCODE01 ='$DECOSUBCODE01'
        AND t.DECOSUBCODE02 ='$DECOSUBCODE02'
        AND t.DECOSUBCODE03 ='$DECOSUBCODE03'
        AND t.DECOSUBCODE04 ='$DECOSUBCODE04'
        AND t.DECOSUBCODE05 ='$DECOSUBCODE05'
        AND t.DECOSUBCODE06 ='$DECOSUBCODE06'
        AND t.TRANSACTIONDATE BETWEEN '$tglawal' AND '$tglakhir'
        AND t.TRANSACTIONDATE > '2025-04-30'
        ORDER BY t.TRANSACTIONDATE ASC";

    // echo $query_data;

    $exec_query_data = db2_exec($conn1, $query_data);

    while ($row = db2_fetch_assoc($exec_query_data)) {

        $tanggal       = '';
        $jumlah_masuk  = '';
        $jumlah_keluar = '';
        $surat_jalan   = '';
        $nama          = '';
        $paraf         = '';
        $keterangan    = '';

        // Tanggal Masuk , Tanggal Keluar, Jumlah Masuk, Jumlah Keluar
        if ($row['TEMPLATECODE'] === 'OPN' || $row['TEMPLATECODE'] === '304' || $row['TEMPLATECODE'] === '101') {
            $jumlah_masuk = (float) $row['USERPRIMARYQUANTITY'];
            $stock_akhir  = $stock_awal + $jumlah_masuk;

        } else if ($row['TEMPLATECODE'] === '098' || $row['TEMPLATECODE'] === '303') {
            $jumlah_keluar = (float) $row['USERPRIMARYQUANTITY'];
            $stock_akhir   = $stock_awal - $jumlah_keluar;
        }

        $tanggal     = $row['TRANSACTIONDATE'];
        $surat_jalan = '';
        $keterangan  = $row['KETERANGAN'];

        // Array Data
        $data[] = [
            'tanggal'              => $tanggal,
            'stock_awal'           => $stock_awal,
            'quantity_penerimaan'  => $jumlah_masuk,
            'quantity_pengeluaran' => $jumlah_keluar,
            'stock_akhir'          => $stock_akhir,
            'surat_jalan'          => $surat_jalan,
            'nama'                 => $nama,
            'paraf'                => $paraf,
            'keterangan'           => $keterangan,
        ];

        $stock_awal = $stock_akhir;
    }

    if (empty($data)) {
        $data[] = [
            'tanggal'              => '2025-04-30',
            'stock_awal'           => $stock_awal,
            'quantity_penerimaan'  => '',
            'quantity_pengeluaran' => '',
            'stock_akhir'          => $stock_awal,
            'surat_jalan'          => '',
            'nama'                 => '',
            'paraf'                => '',
            'keterangan'           => 'Balance per 30 April 2025',
        ];
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kartu Stok ATK | DIT</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 10px;
        }

        tr {
            border-bottom: 1px solid black;
        }

        @page {
            size: auto;
            margin: 0.5cm;
        }

        @media print {
            thead {
                display: table-header-group;
            }

            body {
                font-size: 12px;
                -webkit-print-color-adjust: exact;
                margin: 1cm 1cm 1cm 1cm;
            }
        }

    </style>
</head>
<body>
<table border="1" width="100%" style="border-collapse: collapse;">
    <thead>
        <tr>
            <td width="10%" align="center">
                <img src="<?php echo base_url(); ?>assets\images\ITTI_Logo Option_Logogram ITTI.png" width="70">
            </td>
            <td width="50%" align="center" colspan="5" >
                <strong style="font-size:large">KARTU STOK</strong>
            </td>
            <td width="40%" colspan="3">
                <table>
                    <tr>
                        <td>No. Form</td>
                        <td>:</td>
                        <td>19-08B</td>
                    </tr>
                    <tr>
                        <td>No. Revisi</td>
                        <td>:</td>
                        <td>01</td>
                    </tr>
                    <tr>
                        <td>Tgl. Terbit</td>
                        <td>:</td>
                        <td>29-12-18</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td colspan="9">
                <table>
                    <tr>
                        <td>Nama Barang</td>
                        <td>:</td>
                        <td>
                            <?php echo $DESCRIPTION ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Satuan</td>
                        <td>:</td>
                        <td>
                            <?php echo $UNIOFMEASURE ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Stock Minimum</td>
                        <td>:</td>
                        <td>
                            ...
                        </td>
                    </tr>
                    <tr>
                        <td>Kelompok</td>
                        <td>:</td>
                        <td>
                            ...
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td align="center" style="width: 10%; font-weight: bold;">Tgl</td>
            <td align="center" style="width: 10%; font-weight: bold;">Stock Awal</td>
            <td align="center" style="width: 10%; font-weight: bold;">Quantity Penerimaan</td>
            <td align="center" style="width: 10%; font-weight: bold;">Quantity Pengeluaran</td>
            <td align="center" style="width: 10%; font-weight: bold;">Stock Akhir</td>
            <td align="center" style="width: 15%; font-weight: bold;">Surat Jalan/Bon Pengambilan Barang</td>
            <td align="center" style="width: 10%; font-weight: bold;">Nama</td>
            <td align="center" style="width: 10%; font-weight: bold;">Paraf</td>
            <td align="center" style="width: 15%; font-weight: bold;">Keterangan</td>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data as $row): ?>
            <tr>
                <td align="center"><?php echo $row['tanggal']; ?></td>
                <td align="center"><?php echo $row['stock_awal'] != '' ? formatNumber($row['stock_awal']) : ''; ?></td>
                <td align="center"><?php echo $row['quantity_penerimaan'] != '' ? formatNumber($row['quantity_penerimaan']) : ''; ?></td>
                <td align="center"><?php echo $row['quantity_pengeluaran'] != '' ? formatNumber($row['quantity_pengeluaran']) : ''; ?></td>
                <td align="center"><?php echo $row['stock_akhir'] != '' ? formatNumber($row['stock_akhir']) : ''; ?></td>
                <td align="center"><?php echo $row['surat_jalan']; ?></td>
                <td align="center"><?php echo $row['nama']; ?></td>
                <td align="center"><?php echo $row['paraf']; ?></td>
                <td align="center"><?php echo $row['keterangan']; ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</body>
</html>