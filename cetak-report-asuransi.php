<?php
error_reporting(E_ALL);
include "assets/koneksi.php";
include 'assets/Classes/PHPExcel.php';
if(isset($_POST['endDate']) && isset($_POST['startDate'])){
    $startDate = $_POST['startDate'];
    $endDate = $_POST['endDate'];
    $cabang = $_POST['cabang'];

    $sqlCabang = mysqli_query($Open, "select company_name from cabang where id_cabang = '".$cabang."'");
    $resultCabang = mysqli_fetch_array($sqlCabang);

    if(strtotime($startDate) > strtotime($endDate)){
        $resultError = "
                    <div class='tengah' style='width:400px; height:300px;'>
                        <div class='container'>
                            <p>Tanggal End Date Tidak Boleh Lebih Kecil Dari Start Date</p>
                            <button onclick='window.history.back()'>Kembali</button>
                        </div>
                    </div>
       ";

        echo $resultError;

    }else {
        $sql = mysqli_query($Open, "select DISTINCT 
							                 a.cabang
                                            ,a.nama_debitur
                                            ,a.cif
                                            ,a.ppk
                                            ,a.crm                                            
                                            ,b.nama_marketing
                                            ,d.jenis_agunan
                                            ,c.alamat
                                            ,c.no_certificate
                                            ,c.duedate_hgb
                                            ,c.nama_pemilik
                                            ,c.nilai_penjaminan
                                            ,k.status
                                            ,k.create_at as tgl_createSignPK
                                            ,k.keterangan
                                            ,k.tgl_pemenuhan
                                            ,a.create_at
                                            ,f.tipe_kredit
                                            ,e.fascode
                                            ,e.plafond
                                            ,l.polis
                                            ,l.end_date as polisduedateasuransijam
                                            ,l.nilai_pertanggungan
                                            ,l.nama_asuransi
                                            ,l.asuransi_lain
                                            ,m.polis
                                            ,m.end_date as polisduedateasuransifas
                                            ,m.nilai_pertanggungan
                                            ,m.nama_asuransi
                                            ,m.asuransi_lain
                                            from tb_inputcrm a
                                            left join master_marketing b on a.nik_marketing = b.nik_marketing
                                            left join tb_inputjaminan c on a.id_crm = c.id_crm
                                            left join master_jenisagunan d on c.jaminan = d.id_jenisagunan
                                            left join cabang j on a.cabang = j.company_name
                                            left join tb_inputsignpk k on a.id_crm = k.id_crm
                                            left join tb_inputfasilitas e on c.id_agunan = e.id_agunan
                                            left join master_tipekredit f on e.id_tipkredit = f.id_tipekredit
                                            left join tb_inputasuransi l on c.id_agunan = l.id_agunan
                                            left join tb_inputasuransifasilitas m on e.id_inputfasilitas = m.id_inputfasilitas
                                            where j.id_cabang = '".$cabang."' 
                                            and a.status != 4 
                                            and (l.end_date between '".$startDate."' and '".$endDate."' or m.end_date between '".$startDate."' and '".$endDate."') 
                                            order by l.end_date and m.end_date asc");

        $filename = "Rekap Document Jatuh Tempo Asuransi Periode $startDate-$endDate.xls";
        $obj = new PHPExcel();

        $obj->getProperties()->setCreator("Elly Permana")
            ->setLastModifiedBy("Elly Permana")
            ->setTitle("Laporan Monitoring")
            ->setSubject("Laporan Monitoring")
            ->setDescription("Laporan Monitoring .")
            ->setKeywords("Office 2007 openxml php")
            ->setCreator("Elly Permana");


        $obj->setActiveSheetIndex(0)
            ->mergeCells('A1:AA1')
            ->setCellValue("A1", "REKAP JATUH TEMPO ASURANSI")
            ->getStyle('A1')->getAlignment()->applyFromArray(
                array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,)
            );
        $obj->setActiveSheetIndex(0)->getStyle('A1')->getFont()->setBold(true);

        $obj->setActiveSheetIndex(0)
            ->mergeCells('A2:AA2')
            ->setCellValue("A2", "PERIODE $startDate-$endDate ")
            ->getStyle('A2')->getAlignment()->applyFromArray(
                array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,)
            );
        $obj->setActiveSheetIndex(0)->getStyle('A2')->getFont()->setBold(true);


        $obj->setActiveSheetIndex(0)
            ->mergeCells('A3:B3')
            ->setCellValue('A3', 'Cabang : '.$resultCabang[0])
            ->getStyle('A3')->getAlignment()->applyFromArray(
                array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,)

            );
        $obj->setActiveSheetIndex(0)->getStyle('A3')->getFont()->setBold(true);


        $obj->setActiveSheetIndex(0)
            ->mergeCells('A4:A5')
            ->setCellValue('A4', 'NO')
            ->getStyle('A4')->getAlignment()->applyFromArray(
                array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,)

            );
        $obj->setActiveSheetIndex(0)->getStyle('A4')->getFont()->setBold(true);

        $obj->setActiveSheetIndex(0)
            ->mergeCells('B4:B5')
            ->setCellValue('B4', 'Nama Debitur')
            ->getStyle('B4')->getAlignment()->applyFromArray(
                array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,)

            );
        $obj->setActiveSheetIndex(0)->getStyle('B4')->getFont()->setBold(true);


        $obj->setActiveSheetIndex(0)
            ->mergeCells('C4:C5')
            ->setCellValue('C4', 'CIF')
            ->getStyle('C4')->getAlignment()->applyFromArray(
                array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,)
            );
        $obj->setActiveSheetIndex(0)->getStyle('C4')->getFont()->setBold(true);

        $obj->setActiveSheetIndex(0)
            ->mergeCells('D4:D5')
            ->setCellValue('D4', 'Nama Marketing')
            ->getStyle('D4')->getAlignment()->applyFromArray(
                array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,)
            );
        $obj->setActiveSheetIndex(0)->getStyle('D4')->getFont()->setBold(true);
        $obj->setActiveSheetIndex(0)->getStyle('D4')->getAlignment()->setWrapText(true);

        $obj->setActiveSheetIndex(0)
            ->mergeCells('E4:E5')
            ->setCellValue('E4', 'No. PPK')
            ->getStyle('E4')->getAlignment()->applyFromArray(
                array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,)
            );
        $obj->setActiveSheetIndex(0)->getStyle('E4')->getFont()->setBold(true);

        $obj->setActiveSheetIndex(0)
            ->mergeCells('F4:F5')
            ->setCellValue('F4', 'No. CRM')
            ->getStyle('F4')->getAlignment()->applyFromArray(
                array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,)
            );
        $obj->setActiveSheetIndex(0)->getStyle('F4')->getFont()->setBold(true);

        $obj->setActiveSheetIndex(0)
            ->mergeCells('G4:L4')
            ->setCellValue('G4', 'Jaminan')
            ->getStyle('G4')->getAlignment()->applyFromArray(
                array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,)
            );
        $obj->setActiveSheetIndex(0)->getStyle('G4')->getFont()->setBold(true);

        $obj->setActiveSheetIndex(0)
            ->setCellValue('G5', 'No.Certificate')
            ->getStyle('G5')->getAlignment()->applyFromArray(
                array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,)
            );
        $obj->setActiveSheetIndex(0)->getStyle('G5')->getFont()->setBold(true);

        $obj->setActiveSheetIndex(0)
            ->setCellValue('H5', 'Jatuh Tempo HGB')
            ->getStyle('H5')->getAlignment()->applyFromArray(
                array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,)
            );
        $obj->setActiveSheetIndex(0)->getStyle('H5')->getFont()->setBold(true);

        $obj->setActiveSheetIndex(0)
            ->setCellValue('I5', 'Jenis Jaminan')
            ->getStyle('I5')->getAlignment()->applyFromArray(
                array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,)
            );
        $obj->setActiveSheetIndex(0)->getStyle('I5')->getFont()->setBold(true);

        $obj->setActiveSheetIndex(0)
            ->setCellValue('J5', 'Alamat')
            ->getStyle('J5')->getAlignment()->applyFromArray(
                array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,)
            );
        $obj->setActiveSheetIndex(0)->getStyle('J5')->getFont()->setBold(true);

        $obj->setActiveSheetIndex(0)
            ->setCellValue('K5', 'Nama Pemilik')
            ->getStyle('K5')->getAlignment()->applyFromArray(
                array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,)
            );
        $obj->setActiveSheetIndex(0)->getStyle('K5')->getFont()->setBold(true);

        $obj->setActiveSheetIndex(0)
            ->setCellValue('L5', 'Nilai Penjaminan')
            ->getStyle('L5')->getAlignment()->applyFromArray(
                array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,)
            );
        $obj->setActiveSheetIndex(0)->getStyle('L5')->getFont()->setBold(true);

        $obj->setActiveSheetIndex(0)
            ->mergeCells('M4:O4')
            ->setCellValue('M4', 'Fasilitas')
            ->getStyle('M4')->getAlignment()->applyFromArray(
                array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,)
            );
        $obj->setActiveSheetIndex(0)->getStyle('M4')->getFont()->setBold(true);

        $obj->setActiveSheetIndex(0)
            ->setCellValue('M5', 'Jenis Pengajuan')
            ->getStyle('M5')->getAlignment()->applyFromArray(
                array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,)
            );
        $obj->setActiveSheetIndex(0)->getStyle('M5')->getFont()->setBold(true);

        $obj->setActiveSheetIndex(0)
            ->setCellValue('N5', 'Jenis Fasilitas')
            ->getStyle('N5')->getAlignment()->applyFromArray(
                array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,)
            );
        $obj->setActiveSheetIndex(0)->getStyle('N5')->getFont()->setBold(true);

        $obj->setActiveSheetIndex(0)
            ->setCellValue('O5', 'Plafond')
            ->getStyle('O5')->getAlignment()->applyFromArray(
                array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,)
            );
        $obj->setActiveSheetIndex(0)->getStyle('O5')->getFont()->setBold(true);

        $obj->setActiveSheetIndex(0)
            ->mergeCells('P4:T4')
            ->setCellValue('P4', 'Asuransi Kerugian/Kebakaran')
            ->getStyle('P4')->getAlignment()->applyFromArray(
                array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,)
            );
        $obj->setActiveSheetIndex(0)->getStyle('P4')->getFont()->setBold(true);

        $obj->setActiveSheetIndex(0)
            ->setCellValue('P5', 'No. Polis')
            ->getStyle('P5')->getAlignment()->applyFromArray(
                array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,)
            );
        $obj->setActiveSheetIndex(0)->getStyle('P5')->getFont()->setBold(true);

        $obj->setActiveSheetIndex(0)
            ->setCellValue('Q5', 'Jatuh Tempo')
            ->getStyle('Q5')->getAlignment()->applyFromArray(
                array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,)
            );
        $obj->setActiveSheetIndex(0)->getStyle('Q5')->getFont()->setBold(true);

        $obj->setActiveSheetIndex(0)
            ->setCellValue('R5', 'Nilai Pertanggungan')
            ->getStyle('R5')->getAlignment()->applyFromArray(
                array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,)
            );
        $obj->setActiveSheetIndex(0)->getStyle('R5')->getFont()->setBold(true);

        $obj->setActiveSheetIndex(0)
            ->setCellValue('S5', 'Nama Asuransi')
            ->getStyle('S5')->getAlignment()->applyFromArray(
                array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,)
            );
        $obj->setActiveSheetIndex(0)->getStyle('S5')->getFont()->setBold(true);

        $obj->setActiveSheetIndex(0)
            ->setCellValue('T5', 'Keterangan')
            ->getStyle('T5')->getAlignment()->applyFromArray(
                array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,)
            );
        $obj->setActiveSheetIndex(0)->getStyle('T5')->getFont()->setBold(true);

        $obj->setActiveSheetIndex(0)
            ->mergeCells('U4:Y4')
            ->setCellValue('U4', 'Asuransi Jiwa Kredit')
            ->getStyle('U4')->getAlignment()->applyFromArray(
                array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,)
            );
        $obj->setActiveSheetIndex(0)->getStyle('U4')->getFont()->setBold(true);

        $obj->setActiveSheetIndex(0)
            ->setCellValue('U5', 'No. Polis')
            ->getStyle('U5')->getAlignment()->applyFromArray(
                array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,)
            );
        $obj->setActiveSheetIndex(0)->getStyle('U5')->getFont()->setBold(true);

        $obj->setActiveSheetIndex(0)
            ->setCellValue('V5', 'Jatuh Tempo')
            ->getStyle('V5')->getAlignment()->applyFromArray(
                array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,)
            );
        $obj->setActiveSheetIndex(0)->getStyle('V5')->getFont()->setBold(true);

        $obj->setActiveSheetIndex(0)
            ->setCellValue('W5', 'Nilai Pertanggungan')
            ->getStyle('W5')->getAlignment()->applyFromArray(
                array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,)
            );
        $obj->setActiveSheetIndex(0)->getStyle('W5')->getFont()->setBold(true);

        $obj->setActiveSheetIndex(0)
            ->setCellValue('X5', 'Nama Asuransi')
            ->getStyle('X5')->getAlignment()->applyFromArray(
                array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,)
            );
        $obj->setActiveSheetIndex(0)->getStyle('X5')->getFont()->setBold(true);

        $obj->setActiveSheetIndex(0)
            ->setCellValue('Y5', 'Keterangan')
            ->getStyle('Y5')->getAlignment()->applyFromArray(
                array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,)
            );
        $obj->setActiveSheetIndex(0)->getStyle('Y5')->getFont()->setBold(true);

        $obj->setActiveSheetIndex(0)
            ->mergeCells('Z4:Z5')
            ->setCellValue('Z4', 'SLA')
            ->getStyle('Z4')->getAlignment()->applyFromArray(
                array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,)
            );
        $obj->setActiveSheetIndex(0)->getStyle('Z4')->getFont()->setBold(true);

        $obj->setActiveSheetIndex(0)
            ->mergeCells('AA4:AA5')
            ->setCellValue('AA4', 'Keterangan Aplikasi')
            ->getStyle('AA4')->getAlignment()->applyFromArray(
                array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,)
            );
        $obj->setActiveSheetIndex(0)->getStyle('AA4')->getFont()->setBold(true);

        $obj->setActiveSheetIndex(0)
            ->getColumnDimension("A")->setWidth(5);
        $obj->setActiveSheetIndex(0)
            ->getColumnDimension("B")->setWidth(30);
        $obj->setActiveSheetIndex(0)
            ->getColumnDimension("C")->setWidth(10);
        $obj->setActiveSheetIndex(0)
            ->getColumnDimension("D")->setWidth(20);
        $obj->setActiveSheetIndex(0)
            ->getColumnDimension("E")->setAutoSize(true);
        $obj->setActiveSheetIndex(0)
            ->getColumnDimension("F")->setAutoSize(true);
        $obj->setActiveSheetIndex(0)
            ->getColumnDimension("G")->setAutoSize(true);
        $obj->setActiveSheetIndex(0)
            ->getColumnDimension("H")->setAutoSize(true);
        $obj->setActiveSheetIndex(0)
            ->getColumnDimension("I")->setAutoSize(true);
        $obj->setActiveSheetIndex(0)
            ->getColumnDimension("J")->setAutoSize(true);
        $obj->setActiveSheetIndex(0)
            ->getColumnDimension("K")->setAutoSize(true);
        $obj->setActiveSheetIndex(0)
            ->getColumnDimension("L")->setAutoSize(true);
        $obj->setActiveSheetIndex(0)
            ->getColumnDimension("M")->setWidth(15);
        $obj->setActiveSheetIndex(0)
            ->getColumnDimension("N")->setWidth(15);
        $obj->setActiveSheetIndex(0)
            ->getColumnDimension("O")->setAutoSize(true);
        $obj->setActiveSheetIndex(0)
            ->getColumnDimension("P")->setAutoSize(true);
        $obj->setActiveSheetIndex(0)
            ->getColumnDimension("Q")->setAutoSize(true);
        $obj->setActiveSheetIndex(0)
            ->getColumnDimension("R")->setAutoSize(true);
        $obj->setActiveSheetIndex(0)
            ->getColumnDimension("S")->setAutoSize(true);
        $obj->setActiveSheetIndex(0)
            ->getColumnDimension("T")->setAutoSize(true);
        $obj->setActiveSheetIndex(0)
            ->getColumnDimension("U")->setAutoSize(true);
        $obj->setActiveSheetIndex(0)
            ->getColumnDimension("V")->setAutoSize(true);
        $obj->setActiveSheetIndex(0)
            ->getColumnDimension("W")->setAutoSize(true);
        $obj->setActiveSheetIndex(0)
            ->getColumnDimension("X")->setAutoSize(true);
        $obj->setActiveSheetIndex(0)
            ->getColumnDimension("Y")->setAutoSize(true);
        $obj->setActiveSheetIndex(0)
            ->getColumnDimension("Z")->setAutoSize(true);
        $obj->setActiveSheetIndex(0)
            ->getColumnDimension("AA")->setAutoSize(true);


        $tebel = array();
        $tebel['borders']=array();
        $tebel['borders']['allborders']=array();
        $tebel['borders']['allborders']['style']=PHPExcel_Style_Border::BORDER_THIN;
        $obj->setActiveSheetIndex(0)
            ->getStyle('A4:AA5')->applyFromArray($tebel);

        $baris = 6;
        $no = 0;

        while ($row = mysqli_fetch_array($sql)) {
            if($row[12] == 1){
                $tglCreate = date_create($row[16]);
                $dtCreate = strtotime(date_format($tglCreate, "Y-m-d"));
                $tglSignIn = date_create($row[15]);
                $dtSignin = strtotime(date_format($tglSignIn, "Y-m-d"));
                $selisih = abs($dtSignin-$dtCreate);
                $sla = $selisih/86400; // 86400 jumlah detik dalam sehari
            }else {
                $tglCreate = date_create($row[16]);
                $dtCreate = strtotime(date_format($tglCreate, "Y-m-d"));
                $dtNow =  strtotime(date("Y-m-d"));
                $selisih = abs($dtNow-$dtCreate);
                $sla = $selisih/86400; // 86400 jumlah detik dalam sehari
            }

            $no++;
            $obj->setActiveSheetIndex(0)
                ->setCellValue("A$baris", $no)
                ->setCellValue("B$baris", $row[1])
                ->setCellValue("C$baris", $row[2])
                ->setCellValue("D$baris", $row[5])
                ->setCellValue("E$baris", $row[3])
                ->setCellValue("F$baris", $row[4])
                ->setCellValue("G$baris", $row[8])
                ->setCellValue("H$baris", $row[9])
                ->setCellValue("I$baris", $row[6])
                ->setCellValue("J$baris", $row[7])
                ->setCellValue("K$baris", $row[8])
                ->setCellValue("L$baris", $row[11])
                ->setCellValue("M$baris", $row[17])
                ->setCellValue("N$baris", $row[18])
                ->setCellValue("O$baris", $row[19])
                ->setCellValue("P$baris", $row[20])
                ->setCellValue("Q$baris", $row[21])
                ->setCellValue("R$baris", $row[22])
                ->setCellValue("S$baris", $row[23])
                ->setCellValue("T$baris", $row[24])
                ->setCellValue("U$baris", $row[25])
                ->setCellValue("V$baris", $row[26])
                ->setCellValue("W$baris", $row[27])
                ->setCellValue("X$baris", $row[28])
                ->setCellValue("Y$baris", $row[29])
                ->setCellValue("Z$baris", $sla)
                ->setCellValue("AA$baris", $row[14]);
            $baris = $baris + 1;
        }

        /*$obj->getActiveSheet()->setTitle('Laporan Monitoring');*/

        $obj->setActiveSheetIndex(0);
        header('Content-Type: application/vnd.ms-excel');
        header("Content-Disposition: attachment;filename='$filename'");
        header('Cache-Control: max-age=0');

        $objWriter = PHPExcel_IOFactory::createWriter($obj, 'Excel5');
        $objWriter->save('php://output');
        exit;

    }


}