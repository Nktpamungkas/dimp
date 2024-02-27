<?php
    $hostname="10.0.0.21";
    // $database = "NOWTEST"; // SERVER NOW 20
    $database = "NOWPRD"; // SERVER NOW 22
    $user = "db2admin";
    $passworddb2 = "Sunkam@24809";
    $port="25000";
    $conn_string = "DRIVER={IBM ODBC DB2 DRIVER}; HOSTNAME=$hostname; PORT=$port; PROTOCOL=TCPIP; UID=$user; PWD=$passworddb2; DATABASE=$database;";
    // $conn1 = db2_pconnect($conn_string,'', '');
    $conn1 = db2_connect($conn_string,'', '');
    ini_set("error_reporting", 0);
?>
<!DOCTYPE html>
<html>
<head>
    <title>::DIT - Laporan Stock Spare Part:</title>
    <link rel="shortcut icon" href="img/logo_ITTI.ico">
</head>
<style>
    body {
      background: white; 
    }
    page[size="A4"] {
      background: white;
      width: 21cm;
      height: 29.7cm;
      display: block;
      margin: 0 auto;
      margin-bottom: 0.5cm;
      box-shadow: 0 0 0.5cm rgba(0,0,0,0.5);
    }
  
    @media print {
      body, page[size="A4"] {
        margin: 0;
        box-shadow: 0;
      }
    }
    table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
        }
        th, td {
            padding: 0.1px;
            text-align: center;
            font-size: 12px;
        }
        table#t01 tr:nth-child(even) {
            background-color: white;
        }
        table#t01 tr:nth-child(odd) {
           background-color: white;
        }
        table#t01 th {
            background-color: black;
            color: white;
        }
</style>
<body>
<!-- <body onload="print();"> -->
<!-- <page size="A4">  -->
    <table width="100%" border="1">
        <label style="font-weight: bold; font-size: 12px;">LAPORAN STOCK </label><br>
        <label style="font-size: 12px;"><u>DEPARTEMEN DIT</u></label><br>
        <label style="font-weight: bold; font-size: 12px;">Periode : <?= $date1; ?> s/d <?= $date2; ?><br>
        <tr>
            <td width="30">NO</td>
            <td width="180">KODE BARANG</td>
            <td width="400">JENIS BARANG</td>
            <td width="75">STOK AWAL</td>
            <td width="75">UNIT</td>
            <td width="75">MASUK</td>
            <td width="75">KELUAR</td>
            <td width="75">UNIT</td>
            <td width="75">STOK AKHIR</td>
            <td width="100">CATATAN</td>
        </tr>
        <?php
            $query_barang   = db2_exec($conn1, "SELECT
                                                    DISTINCT
                                                    TRIM(s.DECOSUBCODE01) || '-' ||
                                                    TRIM(s.DECOSUBCODE02) || '-' ||
                                                    TRIM(s.DECOSUBCODE03) || '-' ||
                                                    TRIM(s.DECOSUBCODE04) || '-' ||
                                                    TRIM(s.DECOSUBCODE05) || '-' ||
                                                    TRIM(s.DECOSUBCODE06) AS KODE_BARANG,
                                                    p.LONGDESCRIPTION AS NAMA_BARANG,   
                                                    CASE
                                                        WHEN s.USERPRIMARYUOMCODE = 'Rol' THEN s.BASEPRIMARYUOMCODE 
                                                        ELSE s.USERPRIMARYUOMCODE
                                                    END AS UNIT
                                                FROM
                                                    STOCKTRANSACTION s
                                                LEFT JOIN PRODUCT p ON p.ITEMTYPECODE = s.ITEMTYPECODE 
                                                                    AND p.SUBCODE01 = s.DECOSUBCODE01 
                                                                    AND p.SUBCODE02 = s.DECOSUBCODE02 
                                                                    AND p.SUBCODE03 = s.DECOSUBCODE03 
                                                                    AND p.SUBCODE04 = s.DECOSUBCODE04 
                                                                    AND p.SUBCODE05 = s.DECOSUBCODE05 
                                                                    AND p.SUBCODE06 = s.DECOSUBCODE06
                                                RIGHT JOIN BALANCE b ON b.ITEMTYPECODE = p.ITEMTYPECODE
                                                                    AND b.DECOSUBCODE01 = p.SUBCODE01 
                                                                    AND b.DECOSUBCODE02 = p.SUBCODE02 
                                                                    AND b.DECOSUBCODE03 = p.SUBCODE03 
                                                                    AND b.DECOSUBCODE04 = p.SUBCODE04 
                                                                    AND b.DECOSUBCODE05 = p.SUBCODE05 
                                                                    AND b.DECOSUBCODE06 = p.SUBCODE06 
                                                WHERE
                                                    s.ITEMTYPECODE ='SPR'
                                                    AND s.DECOSUBCODE01 = 'DIT' 
                                                    AND (s.TEMPLATECODE = '101' OR s.TEMPLATECODE = 'OPN' OR s.TEMPLATECODE = 'QCT' OR s.TEMPLATECODE = '201' OR s.TEMPLATECODE = '098')
                                                    AND (s.TRANSACTIONDATE) BETWEEN '$date1' AND '$date2'
                                                GROUP BY
                                                    s.DECOSUBCODE01,
                                                    s.DECOSUBCODE02,
                                                    s.DECOSUBCODE03,
                                                    s.DECOSUBCODE04,
                                                    s.DECOSUBCODE05,
                                                    s.DECOSUBCODE06,
                                                    p.LONGDESCRIPTION,
                                                    s.USERPRIMARYUOMCODE,
                                                    s.BASEPRIMARYUOMCODE");
        ?>
        <?php $no = 1; while ($row_barang = db2_fetch_assoc($query_barang)) : ?>
        <tr>
            <td style="text-align: center;"><?= $no++; ?></td>
            <td style="text-align: left; font-size: 10px;"><?= $row_barang['KODE_BARANG']; ?></td>
            <td style="text-align: left;"><?= $row_barang['NAMA_BARANG']; ?></td>

            <td style="text-align: center;">
                <?php
                    if($date1 == '2024-01-10'){
                        $where_date = "AND (s.TRANSACTIONDATE) = '$date1'";
                    }else{
                        $where_date = "AND (s.TRANSACTIONDATE) BETWEEN '2024-01-10' AND '$date1'";
                    }
                    $q_stok_awal    = db2_exec($conn1, "SELECT 
                                                            floor(SUM(s.USERPRIMARYQUANTITY)) AS STOK_AWAL
                                                        FROM 
                                                            STOCKTRANSACTION s
                                                        WHERE
                                                            s.ITEMTYPECODE ='SPR'
                                                            AND s.DECOSUBCODE01 = 'DIT' 
                                                            AND TRIM(s.DECOSUBCODE01) || '-' ||
                                                                TRIM(s.DECOSUBCODE02) || '-' ||
                                                                TRIM(s.DECOSUBCODE03) || '-' ||
                                                                TRIM(s.DECOSUBCODE04) || '-' ||
                                                                TRIM(s.DECOSUBCODE05) || '-' ||
                                                                TRIM(s.DECOSUBCODE06)  = '$row_barang[KODE_BARANG]'
                                                            AND (s.TEMPLATECODE = '101' OR s.TEMPLATECODE = 'OPN' OR s.TEMPLATECODE = 'QCT')
                                                            $where_date");
                    $row_stok_awal  = db2_fetch_assoc($q_stok_awal);
                    if($row_stok_awal['STOK_AWAL']){
                        $stok_awal = $row_stok_awal['STOK_AWAL'];
                    }
                    else{
                        $stok_awal = 0;
                    }
                    echo $stok_awal;
                ?>
            </td><!-- STOK AWAL -->

            <td style="text-align: center;"><?= $row_barang['UNIT']; ?></td>

            <td style="text-align: center;">
                <?php
                    $q_stok_masuk    = db2_exec($conn1, "SELECT 
                                                                CASE
                                                                    WHEN s.USERPRIMARYUOMCODE = 'Rol' THEN floor(SUM(s.BASEPRIMARYQUANTITY))
                                                                    ELSE floor(SUM(s.USERPRIMARYQUANTITY))
                                                                END	AS MASUK
                                                            FROM 
                                                                STOCKTRANSACTION s
                                                            WHERE
                                                                s.ITEMTYPECODE ='SPR'
                                                                AND s.DECOSUBCODE01 = 'DIT' 
                                                                AND TRIM(s.DECOSUBCODE01) || '-' ||
                                                                    TRIM(s.DECOSUBCODE02) || '-' ||
                                                                    TRIM(s.DECOSUBCODE03) || '-' ||
                                                                    TRIM(s.DECOSUBCODE04) || '-' ||
                                                                    TRIM(s.DECOSUBCODE05) || '-' ||
                                                                    TRIM(s.DECOSUBCODE06)  = '$row_barang[KODE_BARANG]'
                                                                AND (s.TEMPLATECODE = '101' OR s.TEMPLATECODE = 'OPN' OR s.TEMPLATECODE = 'QCT')
                                                                AND (s.TRANSACTIONDATE) > '$date1' AND (s.TRANSACTIONDATE) <= '$date2'
                                                            GROUP BY
                                                                s.USERPRIMARYUOMCODE");
                    $row_stok_masuk  = db2_fetch_assoc($q_stok_masuk);
                    if($row_stok_masuk['MASUK']){
                        $stok_masuk = $row_stok_masuk['MASUK'];
                    }
                    else{
                        $stok_masuk = 0;
                    }
                    echo $stok_masuk;
                ?>
            </td><!-- STOK MASUK -->

            <td style="text-align: center;">
                <?php
                    $q_stok_keluar    = db2_exec($conn1, "SELECT 
                                                                floor(SUM(s.USERPRIMARYQUANTITY)) AS KELUAR
                                                            FROM 
                                                                STOCKTRANSACTION s
                                                            WHERE
                                                                s.ITEMTYPECODE ='SPR'
                                                                AND s.DECOSUBCODE01 = 'DIT' 
                                                                AND TRIM(s.DECOSUBCODE01) || '-' ||
                                                                    TRIM(s.DECOSUBCODE02) || '-' ||
                                                                    TRIM(s.DECOSUBCODE03) || '-' ||
                                                                    TRIM(s.DECOSUBCODE04) || '-' ||
                                                                    TRIM(s.DECOSUBCODE05) || '-' ||
                                                                    TRIM(s.DECOSUBCODE06)  = '$row_barang[KODE_BARANG]'
                                                                AND (s.TEMPLATECODE = '201' OR s.TEMPLATECODE = '098')
                                                                AND (s.TRANSACTIONDATE) >= '$date1' AND (s.TRANSACTIONDATE) <= '$date2'");
                    $row_stok_keluar  = db2_fetch_assoc($q_stok_keluar);
                    if($row_stok_keluar['KELUAR']){
                        $stok_keluar = $row_stok_keluar['KELUAR'];
                    }
                    else{
                        $stok_keluar = 0;
                    }
                    echo $stok_keluar;
                ?>
            </td><!-- STOK KELUAR -->

            <td style="text-align: center;"><?= $row_barang['UNIT']; ?></td>

            <td style="text-align: center;"><?= $stok_awal + $stok_masuk - $stok_keluar; ?></td>

            <td style="text-align: center;"></td>
        </tr>
        <?php endwhile; ?>
    </table>
    <br>
    <table width="100%" border="1">
        <tr>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td>DIBUAT OLEH</td>
            <td>DIPERIKSA OLEH</td>
            <td>DISETUJUI OLEH</td>
        </tr>
        <tr>
            <td style="text-align: left;">NAMA</td>
            <td><input style="border:0;outline:0; font-size: 11px;" type=text placeholder="Ketik disini" size="20" maxlength="30"></td>
            <td><input style="border:0;outline:0; font-size: 11px;" type=text placeholder="Ketik disini" size="20" maxlength="30"></td>
            <td><input style="border:0;outline:0; font-size: 11px;" type=text placeholder="Ketik disini" size="20" maxlength="30"></td>
        </tr>
        <tr>
            <td style="text-align: left;">JABATAN</td>
            <td><input style="border:0;outline:0; font-size: 11px;" type=text placeholder="Ketik disini" size="20" maxlength="30"></td>
            <td><input style="border:0;outline:0; font-size: 11px;" type=text placeholder="Ketik disini" size="20" maxlength="30"></td>
            <td><input style="border:0;outline:0; font-size: 11px;" type=text placeholder="Ketik disini" size="20" maxlength="30"></td>
        </tr>
        <tr>
            <td style="text-align: left;">TANGGAL</td>
            <td><input style="border:0;outline:0;" type=date size="20"></td>
            <td><input style="border:0;outline:0;" type=date size="20"></td>
            <td><input style="border:0;outline:0;" type=date size="20"></td>
        </tr>
        <tr>
            <td style="text-align: left;" valign="top">TANDA TANGAN</td>
            <td></td>
            <td></td>
            <td height="50"></td>
        </tr>
    </table>
<!-- </page> -->
</body>
</html>