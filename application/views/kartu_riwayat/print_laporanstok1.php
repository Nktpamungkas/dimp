<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
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
?>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Laporan Troubleshouting ::DIT Inventory System</title>
    <style type="text/css">
        body {
            margin-left: 10px;
            margin-top: 10px;
        }

        a:link {
            font-family: Verdana, Arial, Helvetica, sans-serif;
            font-size: 9pt;
            color: #CD6205;
            text-decoration: none;
        }

        a:visited {
            font-family: Verdana, Arial, Helvetica, sans-serif;
            font-size: 9pt;
            color: #CD6200;
            text-decoration: none;
        }

        a:hover {
            font-family: Verdana, Arial, Helvetica, sans-serif;
            font-size: 9pt;
            color: #0E1148;

            border-bottom: 1pt dotted #0E1148;
        }

        a:active {
            font-family: Verdana, Arial, Helvetica, sans-serif;
            font-size: 9pt;
            color: #000000;
            text-decoration: none;
        }

        .boldcen10putih {
            font-family: Verdana, Arial, Helvetica, sans-serif;
            font-size: 10pt;
            font-weight: bold;
            color: #FFFFFF;
            text-align: center;
        }

        .tombol {
            font-family: Verdana, Arial, Helvetica, sans-serif;
            font-size: 9pt;
            color: black;
            font-weight: bold;
            background-color: #6582AA;
            border: 1px solid #006666;
            text-decoration: none;
        }

        .bold333 {
            font-family: Verdana, Arial, Helvetica, sans-serif;
            font-size: 9pt;
            font-weight: bold;
            color: #333333;
        }

        .normal333 {
            font-family: Verdana, Arial, Helvetica, sans-serif;
            font-size: 9pt;
            font-weight: normal;
            color: #333333;
        }

        .boldCD6 {
            font-family: Verdana, Arial, Helvetica, sans-serif;
            font-size: 9pt;
            font-weight: bold;
            color: #CD6200;
        }

        .normalCD6 {
            font-family: Verdana, Arial, Helvetica, sans-serif;
            font-size: 9pt;
            font-weight: normal;
            color: #CD6200;
        }

        .blod9black {
            font-family: Verdana, Arial, Helvetica, sans-serif;
            font-size: 9pt;
            font-weight: bold;
            color: #000000;
        }

        .blod9blackunder {
            font-family: Verdana, Arial, Helvetica, sans-serif;
            font-size: 9pt;
            font-weight: bold;
            color: #000000;
            text-decoration: underline;
        }

        .normal9black {
            font-family: Verdana, Arial, Helvetica, sans-serif;
            font-size: 9pt;
            font-weight: normal;
            color: #000000;
        }

        .txttengah9black {
            font-family: Verdana, Arial, Helvetica, sans-serif;
            font-size: 9pt;
            font-weight: normal;
            color: #000000;
            background-image: url("../images/bgtxt.jpg");
            background-color: #FFFFFF;
            background-repeat: repeat-x;
        }

        .txttengah9frame {
            font-family: Verdana, Arial, Helvetica, sans-serif;
            font-size: 9pt;
            font-weight: normal;
            color: #000000;
            background-image: url("../images/bgtxt.jpg");
            background-color: #FFFFFF;
            background-repeat: repeat-x;
            background-attachment: fixed;
        }

        .normal7black {
            font-family: Verdana, Arial, Helvetica, sans-serif;
            font-size: 8pt;
            font-weight: normal;
            color: #000000;
            text-align: justify;
        }

        .normal7blackasli {
            font-family: Verdana, Arial, Helvetica, sans-serif;
            font-size: 7pt;
            font-weight: normal;
            color: #000000;
            text-align: left;
        }

        .normal7kuning {
            font-family: Verdana, Arial, Helvetica, sans-serif;
            font-size: 8pt;
            font-weight: normal;
            color: #FCE80F;
            text-align: justify;
        }

        .blod9white {
            font-family: Verdana, Arial, Helvetica, sans-serif;
            font-size: 9pt;
            font-weight: bold;
            color: #FFFFFF;
            text-align: left;
        }

        .blodwhite {
            font-family: Verdana, Arial, Helvetica, sans-serif;
            font-size: 7.12pt;
            font-weight: bold;
            color: #FFFFFF;
        }

        .blod9whiterg {
            font-family: Verdana, Arial, Helvetica, sans-serif;
            font-size: 9pt;
            font-weight: bold;
            color: #FFFFFF;
            text-align: right;
        }

        .normal9white {
            font-family: Verdana, Arial, Helvetica, sans-serif;
            font-size: 9pt;
            font-weight: normal;
            color: #FFFFFF;
        }

        .normal8white {
            font-family: Verdana, Arial, Helvetica, sans-serif;
            font-size: 8pt;
            font-weight: normal;
            color: #FFFFFF;
        }

        .bgweb {
            background: #FFFFFF url(../images/bg-kiri.gif) repeat-y;
        }

        /*** ABOUT MENU ***/
        .menubawah {
            margin: 0;
            padding-bottom: 2px;
        }

        .menubawah a,
        .menubawah a:visited {
            font-family: Verdana, Arial, Helvetica, sans-serif;
            font-size: 9pt;
            color: #ff6600;
            font-weight: bold;

        }

        .menubawah a:link {
            font-family: Verdana, Arial, Helvetica, sans-serif;
            font-size: 9pt;
            color: #ff6600;
            font-weight: bold;
        }

        .menubawah a:hover {
            font-family: Verdana, Arial, Helvetica, sans-serif;
            font-size: 9pt;
            color: #ffffff;

            border-bottom: 1pt dotted #ffffff;

        }

        .menubawah a:active {
            font-family: Verdana, Arial, Helvetica, sans-serif;
            font-size: 9pt;
            color: #ffffff;
            font-weight: bold;
        }

        -->-->

        /*** ABOUT MENU STATISTIK ***/
        .menustat {
            margin: 0;
            padding-bottom: 2px;
        }

        .menustat a,
        .menustat a:visited {
            font-family: Verdana, Arial, Helvetica, sans-serif;
            font-size: 9pt;
            color: #000000;
            text-decoration: none;
            font-weight: normal;

        }

        .menustat a:hover {
            font-family: Verdana, Arial, Helvetica, sans-serif;
            font-size: 9pt;
            color: #6682AA;
            text-decoration: none;
            border-bottom: 1pt dotted #0E1148;
        }

        .bodigar {
            margin-top: 0px;
            margin-bottom: 0px;
            background-image: url("../images/bg-kiri.gif");
            background-color: #666666;
            background-repeat: repeat-y;
        }
    </style>
    <link href="home.css" rel="stylesheet" type="text/css" />
</head>

<body>
    <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <?php
            if($type == 'Semua'){
                $where_kategori = "(p.BREAKDOWNTYPE = 'HD' OR p.BREAKDOWNTYPE = 'NW' OR p.BREAKDOWNTYPE = 'EM')";
            }else{
                $where_kategori = "p.BREAKDOWNTYPE = '$type'";
            }
            $q_opentiket = db2_exec($conn1, "SELECT
                                                p.CODE AS NOMOR_TIKET,
                                                d.SHORTDESCRIPTION,
                                                p.CREATIONDATETIME AS TGL_OPEN,
                                                p3.STARTDATE AS TGL_FOLLOWUP,
                                                p3.ENDDATE AS TGL_CLOSE,
                                                CASE
                                                    WHEN a1.VALUESTRING = 1 THEN 'BERAT'
                                                    WHEN a1.VALUESTRING = 2 THEN 'RINGAN'
                                                    ELSE ''
                                                END AS JENIS_KERUSAKAN,
                                                p3.REMARKS AS KETERANGAN
                                            FROM
                                                PMBREAKDOWNENTRY p
                                            LEFT JOIN PMWORKORDER p3 ON p3.PMBREAKDOWNENTRYCODE = p.CODE 
                                            LEFT JOIN ADSTORAGE a1 ON a1.UNIQUEID = p3.ABSUNIQUEID AND a1.FIELDNAME = 'JenisKerusakan'
                                            LEFT JOIN DEPARTMENT d ON d.CODE = p.DEPARTMENTCODE 
                                            WHERE
                                                $where_kategori
                                                AND SUBSTR(p.CREATIONDATETIME, 1, 10) BETWEEN '$date1' AND '$date2'
                                            ORDER BY
                                                p.CREATIONDATETIME ASC");
        ?> 
        <tr>
            <td>
                <table width="100%" border="1" cellpadding="0" cellspacing="0">
                    <tr>
                        <td width="150" align="center" valign="middle"><img src="<?= base_url(); ?>assets\images\ITTI_Logo Option_Logogram ITTI.png" width="68" height="68" /></td>
                        <td align="center" valign="middle" class="blod9blackunder">LAPORAN OPEN TICKET</td>
                        <td width="250" align="center" valign="middle">&nbsp;</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>
                <table width="100%" border="1" cellpadding="0" cellspacing="0">
                    <tr>
                        <td width="180" align="left" valign="middle" class="normal9black">&nbsp;&nbsp;<span class="blod9black">Departemen</span></td>
                        <td width="150" align="left" valign="middle" class="normal9black">&nbsp;&nbsp;<?php echo ''; ?></td>
                        <td width="130" align="left" valign="middle" class="normal9black">&nbsp;&nbsp;<span class="blod9black">Periode</span></td>
                        <td align="left" valign="middle" class="normal9black">&nbsp;&nbsp;<?= $date1; ?> s/d <?= $date2; ?></td>
                    </tr>
                    <tr>
                        <td width="180" align="left" valign="middle" class="normal9black">&nbsp;&nbsp;<span class="blod9black">Admin</span></td>
                        <td align="left" valign="middle" class="normal9black">&nbsp;&nbsp;<?php echo ''; ?></td>
                        <td width="130" align="left" valign="middle" class="normal9black">&nbsp;&nbsp;<span class="blod9black">Status</span></td>
                        <td align="left" valign="middle" class="normal9black">&nbsp;&nbsp;<?php echo ''; ?></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>
                <table width="100%" border="1" cellpadding="0" cellspacing="0">
                    <tr>
                        <td height="100" align="left" valign="top" class="normal9black">
                            <br>
                            Kategori : <?= $type; ?>
                            <hr><br>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <STRONG>PENCAPAIAN SASARAN MUTU TROBLESHOUTING DEPARTEMEN DATA & INFORMATIKA</STRONG>
                            <br><br>
                            <table width="95%" style="border:1px solid black; border-collapse:collapse;">
                                <thead>
                                    <tr class="tombol">
                                        <th width="2%" style="border:1px solid black;">No.</th>
                                        <th width="15%" style="border:1px solid black;">Nomor Ticket</th>
                                        <th width="15%" style="border:1px solid black;">Dept</th>
                                        <th width="12%" style="border:1px solid black;">Tgl Open</th>
                                        <th width="12%" style="border:1px solid black;">Tgl Follow Up</th>
                                        <th width="12%" style="border:1px solid black;">Tgl Close</th>
                                        <th width="15%" style="border:1px solid black;">Waktu Follow Up</th>
                                        <th width="15%" style="border:1px solid black;">Waktu Close</th>
                                        <th width="5%" style="border:1px solid black;">Jenis</th>
                                        <th width="18%" style="border:1px solid black;">Keterangan</th>
                                    </tr>
                                </thead> 
                                <?php $no = 1; while ($row_opentiket = db2_fetch_assoc($q_opentiket)) : ?>
                                    <?php
                                        $mulai_waktu_followup      = date_create($row_opentiket['TGL_OPEN']);
                                        $selesai_waktu_followup    = date_create($row_opentiket['TGL_FOLLOWUP']);
                    
                                        $total_waktu_followup      = date_diff($mulai_waktu_followup, $selesai_waktu_followup);

                                        $mulai_waktu_close      = date_create($row_opentiket['TGL_FOLLOWUP']);
                                        $selesai_waktu_close    = date_create($row_opentiket['TGL_CLOSE']);
                    
                                        $total_waktu_close      = date_diff($mulai_waktu_close, $selesai_waktu_close);


                                        if($row_opentiket['TGL_FOLLOWUP']){
                                            $waktu_follow_up    = $total_waktu_followup->d . ' Hari ' . $total_waktu_followup->h . ' Jam ' . $total_waktu_followup->i . ' Menit ';
                                            $waktu_close        = $total_waktu_close->d . ' Hari ' . $total_waktu_close->h . ' Jam ' . $total_waktu_close->i . ' Menit ';
                                        }else{
                                            $waktu_follow_up    = '';
                                            $waktu_close        = '';
                                        }
                                    ?>
                                    <tbody>                                     
                                        <tr >
                                            <td style="border:1px solid black;"><?= $no++; ?></td>
                                            <td style="border:1px solid black;"><?= $row_opentiket['NOMOR_TIKET'] ?></td>
                                            <td style="border:1px solid black;"><?= $row_opentiket['SHORTDESCRIPTION'] ?></td>
                                            <td style="border:1px solid black;"><?= substr($row_opentiket['TGL_OPEN'], 0,10) ?> <?= substr($row_opentiket['TGL_OPEN'], 11,8) ?></td>
                                            <td style="border:1px solid black;"><?= substr($row_opentiket['TGL_FOLLOWUP'], 0,10) ?> <?= substr($row_opentiket['TGL_FOLLOWUP'], 11,8) ?></td>
                                            <td style="border:1px solid black;"><?= substr($row_opentiket['TGL_CLOSE'], 0,10) ?> <?= substr($row_opentiket['TGL_CLOSE'], 11,8) ?></td>
                                            <td <?php if($total_waktu_followup->h > 0 || $total_waktu_followup->d > 0 || $total_waktu_followup->h > 0 && $total_waktu_followup->h > 0){
                                                    echo 'style="border:1px solid black; background-color: #92C7CF;"';
                                                } else{
                                                    echo 'style="border:1px solid black;"';
                                                }?>><?= $waktu_follow_up; ?></td>
                                            <td <?php if($row_opentiket['JENIS_KERUSAKAN'] == 'RINGAN' && $total_waktu_close->h > 2 || $row_opentiket['JENIS_KERUSAKAN'] == 'RINGAN' && $total_waktu_close->d > 0 || $row_opentiket['JENIS_KERUSAKAN'] == 'RINGAN' && $total_waktu_close->d > 0 && $row_opentiket['JENIS_KERUSAKAN'] == 'RINGAN' && $total_waktu_close->h > 2 ){
                                                    echo 'style="border:1px solid black; background-color: #FFF455;"';
                                                }else if($row_opentiket['JENIS_KERUSAKAN'] == 'BERAT' && $total_waktu_close->h > 4 || $row_opentiket['JENIS_KERUSAKAN'] == 'BERAT' && $total_waktu_close->d > 0 ){
                                                    echo 'style="border:1px solid black; background-color: red;"';
                                                }else{
                                                    echo ' style="border:1px solid black;"';
                                                }?> ><?= $waktu_close; ?></td>
                                            
                                            <td style="border:1px solid black;"><?= $row_opentiket['JENIS_KERUSAKAN'] ?></td>
                                            <td style="border:1px solid black;"><?= $row_opentiket['KETERANGAN'] ?></td>
                                        </tr>
                                    </tbody>
                                <?php endwhile; ?>
                            </table>

                            


                            <br><hr>
                            <?php
                                $q_jumlah_masalah = db2_exec($conn1, "SELECT
                                                                        COUNT(*) AS JUMLAH_MASALAH
                                                                    FROM
                                                                        PMBREAKDOWNENTRY p
                                                                    -- LEFT JOIN PMWORKORDER p3 ON p3.PMBREAKDOWNENTRYCODE = p.CODE 
                                                                    -- LEFT JOIN ADSTORAGE a1 ON a1.UNIQUEID = p3.ABSUNIQUEID AND a1.FIELDNAME = 'JenisKerusakan'
                                                                    WHERE
                                                                        $where_kategori
                                                                        AND SUBSTR(p.CREATIONDATETIME, 1, 10) BETWEEN '$date1' AND '$date2'");
                                $row_jumlah_masalah = db2_fetch_assoc($q_jumlah_masalah);
                         
                                $query_jumlah_follow = db2_exec($conn1, "SELECT 
                                                                    COUNT(*) AS TOTAL_FOLLOW
                                                                FROM
                                                                    PMBREAKDOWNENTRY p
                                                                    LEFT JOIN PMWORKORDER p3 ON p3.PMBREAKDOWNENTRYCODE = p.CODE 
                                                                WHERE
                                                                    $where_kategori
                                                                    AND DATE(p.CREATIONDATETIME) BETWEEN DATE('$date1') AND DATE('$date2')
                                                                    AND (EXTRACT(DAY FROM p3.STARTDATE - p.CREATIONDATETIME) > 0 OR HOUR(TIMESTAMP(p3.STARTDATE) - TIMESTAMP(p.CREATIONDATETIME)) > 0
                                                                    OR EXTRACT(DAY FROM p3.STARTDATE - p.CREATIONDATETIME) > 0 AND HOUR(TIMESTAMP(p3.STARTDATE) - TIMESTAMP(p.CREATIONDATETIME)) > 0)");
                                                                // $var_dump($query_jumlah_follow);
                                $row_jumlah_follow = db2_fetch_assoc($query_jumlah_follow);

                               
                        
                                $query_jumlah_close_3_jam = db2_exec($conn1, "SELECT 
                                                                                    COUNT(*) AS Total_CLOSE_3_JAM
                                                                                    
                                                                                FROM
                                                                                    PMBREAKDOWNENTRY p
                                                                                    LEFT JOIN PMWORKORDER p3 ON p3.PMBREAKDOWNENTRYCODE = p.CODE 
                                                                                    LEFT JOIN ADSTORAGE a1 ON a1.UNIQUEID = p3.ABSUNIQUEID AND a1.FIELDNAME = 'JenisKerusakan'
                                                                                WHERE
                                                                                $where_kategori
                                                                                AND a1.VALUESTRING = '2' /* JENIS_KERUSAKAN = 'Ringan' */
                                                                                AND DATE(p.CREATIONDATETIME) BETWEEN DATE('$date1') AND DATE('$date2')
                                                                                AND ((EXTRACT(DAY FROM p3.ENDDATE - p3.STARTDATE)) > 0
	                                                                            OR HOUR(TIMESTAMP(p3.ENDDATE) - TIMESTAMP(p3.STARTDATE)) > 2
	                                                                            	OR (EXTRACT(DAY FROM p3.ENDDATE - p3.STARTDATE)) > 0
	                                                                            	AND HOUR(TIMESTAMP(p3.ENDDATE) - TIMESTAMP(p3.STARTDATE)) > 2)");
                                                                                // -- AND HOUR(TIMESTAMP(p3.ENDDATE) - TIMESTAMP(p3.STARTDATE)) > 2");
                                                                                    

                                $row_jumlah_close_3_jam = db2_fetch_assoc($query_jumlah_close_3_jam);
 
                         
                                $query_jumlah_close_5_jam = db2_exec($conn1, "SELECT 
                                                                                    COUNT(*) AS Total_CLOSE_5_JAM
                                                                                FROM
                                                                                    PMBREAKDOWNENTRY p
                                                                                    LEFT JOIN PMWORKORDER p3 ON p3.PMBREAKDOWNENTRYCODE = p.CODE 
                                                                                    LEFT JOIN ADSTORAGE a1 ON a1.UNIQUEID = p3.ABSUNIQUEID AND a1.FIELDNAME = 'JenisKerusakan'
                                                                                WHERE
                                                                                $where_kategori
                                                                                AND a1.VALUESTRING = '1' /* JENIS_KERUSAKAN = 'Berat' */
                                                                                AND DATE(p.CREATIONDATETIME) BETWEEN DATE('$date1') AND DATE('$date2')
                                                                                AND ((EXTRACT(DAY FROM p3.ENDDATE - p3.STARTDATE)) > 0
	                                                                            OR HOUR(TIMESTAMP(p3.ENDDATE) - TIMESTAMP(p3.STARTDATE)) > 4
	                                                                            	OR (EXTRACT(DAY FROM p3.ENDDATE - p3.STARTDATE)) > 0
	                                                                            	AND HOUR(TIMESTAMP(p3.ENDDATE) - TIMESTAMP(p3.STARTDATE)) > 4)");

                                $row_jumlah_close_5_jam = db2_fetch_assoc($query_jumlah_close_5_jam);


                                $q_jumlah_masalah_ringan = db2_exec($conn1, "SELECT
                                                                        COUNT(*) AS JUMLAH_MASALAH
                                                                    FROM
                                                                        PMBREAKDOWNENTRY p
                                                                    LEFT JOIN PMWORKORDER p3 ON p3.PMBREAKDOWNENTRYCODE = p.CODE 
                                                                    LEFT JOIN ADSTORAGE a1 ON a1.UNIQUEID = p3.ABSUNIQUEID AND a1.FIELDNAME = 'JenisKerusakan'
                                                                    WHERE
                                                                        $where_kategori
                                                                        AND a1.VALUESTRING = '2' /* JENIS_KERUSAKAN = 'Ringan' */
                                                                        AND SUBSTR(p.CREATIONDATETIME, 1, 10) BETWEEN '$date1' AND '$date2'");
                                $row_jumlah_masalah_ringan = db2_fetch_assoc($q_jumlah_masalah_ringan);

                                $q_jumlah_masalah_berat = db2_exec($conn1, "SELECT
                                                                        COUNT(*) AS JUMLAH_MASALAH
                                                                    FROM
                                                                        PMBREAKDOWNENTRY p
                                                                    LEFT JOIN PMWORKORDER p3 ON p3.PMBREAKDOWNENTRYCODE = p.CODE 
                                                                    LEFT JOIN ADSTORAGE a1 ON a1.UNIQUEID = p3.ABSUNIQUEID AND a1.FIELDNAME = 'JenisKerusakan'
                                                                    WHERE
                                                                        $where_kategori
                                                                        AND a1.VALUESTRING = '1' /* JENIS_KERUSAKAN = 'Berat' */
                                                                        AND SUBSTR(p.CREATIONDATETIME, 1, 10) BETWEEN '$date1' AND '$date2'");
                                $row_jumlah_masalah_berat = db2_fetch_assoc($q_jumlah_masalah_berat);
                              


                                $jumlah_masalah = $row_jumlah_masalah['JUMLAH_MASALAH'];
                                $jumlah_masalah_ringan = $row_jumlah_masalah_ringan['JUMLAH_MASALAH'];
                                $jumlah_masalah_berat = $row_jumlah_masalah_berat['JUMLAH_MASALAH'];
                                
                                
                                $jumlah_follow = $row_jumlah_follow['TOTAL_FOLLOW'];
                                $jumlah_close_3 = $row_jumlah_close_3_jam['TOTAL_CLOSE_3_JAM'];
                                $jumlah_close_5 = $row_jumlah_close_5_jam['TOTAL_CLOSE_5_JAM'];

                                
                                // Hitung total sasaran follow-up
                                $total_sasaran_follow = $jumlah_masalah - $jumlah_follow;
                                $total_sasaran_3_jam = $jumlah_masalah_ringan - $jumlah_close_3;
                                $total_sasaran_5_jam = $jumlah_masalah_berat - $jumlah_close_5;

                               // Menghitung persentase jumlah_follow dari jumlah_masalah
                                if ($jumlah_masalah != 0) {
                                    $persentase_follow = min(($jumlah_follow / $jumlah_masalah) * 100, 100); 
                                } else {
                                    $persentase_follow = 0; 
                                }

                                $persentase_follow_sasaran = 100 - $persentase_follow;
                                if ($persentase_follow_sasaran < 0) {
                                    $persentase_follow_sasaran = 0;
                                }

                                $format_follow = number_format($persentase_follow, 2);
                                $format_follow_sasaran = number_format($persentase_follow_sasaran, 2); 


                                // Menghitung persentase jumlah_close_3_jam dari jumlah masalah
                                if ($jumlah_masalah_ringan != 0) {
                                    $persentase_close_3_jam = min(($jumlah_close_3 / $jumlah_masalah_ringan) * 100, 100); 
                                } else {
                                    $persentase_close_3_jam = 0; 
                                }

                                $persentase_close_3_sasaran = 100 - $persentase_close_3_jam;
                                if ($persentase_close_3_sasaran < 0) {
                                    $persentase_close_3_sasaran = 0;
                                }

                                $format_close_3= number_format($persentase_close_3_jam, 2);
                                $format_close_3_sasaran = number_format($persentase_close_3_sasaran, 2); 


                                 // Menghitung persentase jumlah_close_5_jam dari jumlah masalah
                                 if ($jumlah_masalah_berat != 0) {
                                    $persentase_close_5_jam = min(($jumlah_close_5 / $jumlah_masalah_berat) * 100, 100); 
                                } else {
                                    $persentase_close_5_jam = 0; 
                                }

                                $persentase_close_5_sasaran = 100 - $persentase_close_5_jam;
                                if ($persentase_close_5_sasaran < 0) {
                                    $persentase_close_5_sasaran = 0;
                                }

                                $format_close_5= number_format($persentase_close_5_jam, 2);
                                $format_close_5_sasaran = number_format($persentase_close_5_sasaran, 2); 


                            ?>



                           
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <strong>Jumlah Masalah = <?= $row_jumlah_masalah['JUMLAH_MASALAH']; ?></strong><br><br>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  Follow Up Lebih dari 1 Jam = <?= $row_jumlah_follow['TOTAL_FOLLOW']; ?> ( <?= $format_follow?> % )<br>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <strong>Capaian Sasaran Mutu =  <?=   $total_sasaran_follow ?> ( <?= $format_follow_sasaran?> % )</strong><br><br>

                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Close Kerusakan Ringan > 3 jam = <?=  $row_jumlah_close_3_jam['TOTAL_CLOSE_3_JAM']; ?> dari <?= $row_jumlah_masalah_ringan['JUMLAH_MASALAH']; ?> ( <?= $format_close_3?> % )<br>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <strong>Capaian Sasaran Mutu = <?= $total_sasaran_3_jam ?> ( <?= $format_close_3_sasaran ?> % ) </strong><br><br>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Close Kerusakan Berat > 5 jam = <?=  $row_jumlah_close_5_jam['TOTAL_CLOSE_5_JAM']; ?> dari <?= $row_jumlah_masalah_berat['JUMLAH_MASALAH']; ?> ( <?= $format_close_5?> % )<br>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <strong>Capaian Sasaran Mutu = <?= $total_sasaran_5_jam ?> ( <?= $format_close_5_sasaran?> % ) </strong><br><br><br><br>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>
                <table width="100%" border="1" cellpadding="0" cellspacing="0" class="normal9black">
                    <tfoot>
                    <tr>
                        <td width="170" align="left" valign="top">&nbsp;</td>
                        <td width="200" align="center" valign="middle">Dibuat oleh</td>
                        <td width="220" align="center" valign="middle">Diketahui oleh</td>
                        <td align="center" valign="middle">&nbsp;</td>
                    </tr>
                    <tr>
                        <td width="170" align="left" valign="top">&nbsp;Nama</td>
                        <td width="200" align="center" valign="middle"><?php echo ''; ?></td>
                        <td width="220" align="center"></td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td width="170" align="left" valign="top">&nbsp;Jabatan</td>
                        <td width="200">&nbsp;</td>
                        <td width="220" align="center">Manager DIT</td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td width="170" align="left" valign="top">&nbsp;Tanggal</td>
                        <td width="200" align="center" valign="middle">&nbsp;</td>
                        <td width="220">&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td width="170" height="70" align="left" valign="top">&nbsp;Tanda Tangan</td>
                        <td width="200">&nbsp;</td>
                        <td width="220">&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    </tfoot>
                </table>
            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
    </table>
</body>

</html>