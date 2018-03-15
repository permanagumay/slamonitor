<?php
error_reporting(E_ALL);
include "assets/koneksi.php";
include 'assets/Classes/PHPExcel.php';
if(isset($_POST['endDate']) && isset($_POST['startDate'])){
    $startDate = $_POST['startDate'];
    $endDate = $_POST['endDate'];
    $cabang = $_POST['cabang'];

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
            ->mergeCells('A1:N1')
            ->setCellValue("A1", "REKAP JATUH TEMPO ASURANSI")
            ->getStyle('A1')->getAlignment()->applyFromArray(
                array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,)
            );
        $obj->setActiveSheetIndex(0)->getStyle('A1')->getFont()->setBold(true);

        $obj->setActiveSheetIndex(0)
            ->mergeCells('A2:N2')
            ->setCellValue("A2", "PERIODE $startDate-$endDate ")
            ->getStyle('A2')->getAlignment()->applyFromArray(
                array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,)
            );
        $obj->setActiveSheetIndex(0)->getStyle('A2')->getFont()->setBold(true);
        $obj->setActiveSheetIndex(0)
            ->mergeCells('A3:A4')
            ->setCellValue('A3', 'NO')
            ->getStyle('A3')->getAlignment()->applyFromArray(
                array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,)

            );
        $obj->setActiveSheetIndex(0)->getStyle('A3')->getFont()->setBold(true);
        $obj->setActiveSheetIndex(0)
            ->mergeCells('B3:B4')
            ->setCellValue('B3', 'Cabang')
            ->getStyle('B3')->getAlignment()->applyFromArray(
                array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,)

            );
        $obj->setActiveSheetIndex(0)->getStyle('B3')->getFont()->setBold(true);
        $obj->setActiveSheetIndex(0)
            ->mergeCells('C3:C4')
            ->setCellValue('C3', 'Nama Debitur')
            ->getStyle('C3')->getAlignment()->applyFromArray(
                array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,)

            );
        $obj->setActiveSheetIndex(0)->getStyle('C3')->getFont()->setBold(true);
        $obj->setActiveSheetIndex(0)
            ->mergeCells('D3:D4')
            ->setCellValue('D3', 'CIF')
            ->getStyle('D3')->getAlignment()->applyFromArray(
                array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,)
            );
        $obj->setActiveSheetIndex(0)->getStyle('D3')->getFont()->setBold(true);
        $obj->setActiveSheetIndex(0)
            ->mergeCells('E3:E4')
            ->setCellValue('E3', 'Nama Marketing')
            ->getStyle('E3')->getAlignment()->applyFromArray(
                array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,)
            );
        $obj->setActiveSheetIndex(0)->getStyle('E3')->getFont()->setBold(true);
        $obj->setActiveSheetIndex(0)->getStyle('E3')->getAlignment()->setWrapText(true);
        $obj->setActiveSheetIndex(0)
            ->mergeCells('F3:F4')
            ->setCellValue('F3', 'No. PPK')
            ->getStyle('F3')->getAlignment()->applyFromArray(
                array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,)
            );
        $obj->setActiveSheetIndex(0)->getStyle('F3')->getFont()->setBold(true);
        $obj->setActiveSheetIndex(0)
            ->mergeCells('G3:G4')
            ->setCellValue('G3', 'No. CRM')
            ->getStyle('G3')->getAlignment()->applyFromArray(
                array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,)
            );
        $obj->setActiveSheetIndex(0)->getStyle('G3')->getFont()->setBold(true);
        $obj->setActiveSheetIndex(0)
            ->mergeCells('H3:M3')
            ->setCellValue('H3', 'Jaminan')
            ->getStyle('H3')->getAlignment()->applyFromArray(
                array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,)
            );
        $obj->setActiveSheetIndex(0)->getStyle('H3')->getFont()->setBold(true);
        $obj->setActiveSheetIndex(0)
            ->setCellValue('H4', 'No.Certificate')
            ->getStyle('H4')->getAlignment()->applyFromArray(
                array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,)
            );
        $obj->setActiveSheetIndex(0)->getStyle('H4')->getFont()->setBold(true);
        $obj->setActiveSheetIndex(0)
            ->setCellValue('I4', 'Jatuh Tempo HGB')
            ->getStyle('I4')->getAlignment()->applyFromArray(
                array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,)
            );
        $obj->setActiveSheetIndex(0)->getStyle('I4')->getFont()->setBold(true);
        $obj->setActiveSheetIndex(0)
            ->setCellValue('J4', 'Jenis Jaminan')
            ->getStyle('J4')->getAlignment()->applyFromArray(
                array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,)
            );
        $obj->setActiveSheetIndex(0)->getStyle('J4')->getFont()->setBold(true);
        $obj->setActiveSheetIndex(0)
            ->setCellValue('K4', 'Alamat')
            ->getStyle('K4')->getAlignment()->applyFromArray(
                array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,)
            );
        $obj->setActiveSheetIndex(0)->getStyle('K4')->getFont()->setBold(true);
        $obj->setActiveSheetIndex(0)
            ->setCellValue('L4', 'Nama Pemilik')
            ->getStyle('L4')->getAlignment()->applyFromArray(
                array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,)
            );
        $obj->setActiveSheetIndex(0)->getStyle('L4')->getFont()->setBold(true);
        $obj->setActiveSheetIndex(0)
            ->setCellValue('M4', 'Nilai Penjaminan')
            ->getStyle('M4')->getAlignment()->applyFromArray(
                array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,)
            );
        $obj->setActiveSheetIndex(0)->getStyle('M4')->getFont()->setBold(true);
        $obj->setActiveSheetIndex(0)
            ->mergeCells('N3:P3')
            ->setCellValue('N3', 'Fasilitas')
            ->getStyle('N3')->getAlignment()->applyFromArray(
                array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,)
            );
        $obj->setActiveSheetIndex(0)->getStyle('N3')->getFont()->setBold(true);
        $obj->setActiveSheetIndex(0)
            ->setCellValue('N4', 'Jenis Pengajuan')
            ->getStyle('N4')->getAlignment()->applyFromArray(
                array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,)
            );
        $obj->setActiveSheetIndex(0)->getStyle('N4')->getFont()->setBold(true);
        $obj->setActiveSheetIndex(0)
            ->setCellValue('O4', 'Jenis Fasilitas')
            ->getStyle('O4')->getAlignment()->applyFromArray(
                array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,)
            );
        $obj->setActiveSheetIndex(0)->getStyle('O4')->getFont()->setBold(true);
        $obj->setActiveSheetIndex(0)
            ->setCellValue('P4', 'Plafond')
            ->getStyle('P4')->getAlignment()->applyFromArray(
                array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,)
            );
        $obj->setActiveSheetIndex(0)->getStyle('P4')->getFont()->setBold(true);
        $obj->setActiveSheetIndex(0)
            ->mergeCells('Q3:U3')
            ->setCellValue('Q3', 'Asuransi Kerugian/Kebakaran')
            ->getStyle('Q3')->getAlignment()->applyFromArray(
                array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,)
            );
        $obj->setActiveSheetIndex(0)->getStyle('Q3')->getFont()->setBold(true);
        $obj->setActiveSheetIndex(0)
            ->setCellValue('Q4', 'No. Polis')
            ->getStyle('Q4')->getAlignment()->applyFromArray(
                array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,)
            );
        $obj->setActiveSheetIndex(0)->getStyle('Q4')->getFont()->setBold(true);
        $obj->setActiveSheetIndex(0)
            ->setCellValue('R4', 'Jatuh Tempo')
            ->getStyle('R4')->getAlignment()->applyFromArray(
                array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,)
            );
        $obj->setActiveSheetIndex(0)->getStyle('R4')->getFont()->setBold(true);
        $obj->setActiveSheetIndex(0)
            ->setCellValue('S4', 'Nilai Pertanggungan')
            ->getStyle('S4')->getAlignment()->applyFromArray(
                array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,)
            );
        $obj->setActiveSheetIndex(0)->getStyle('S4')->getFont()->setBold(true);
        $obj->setActiveSheetIndex(0)
            ->setCellValue('T4', 'Nama Asuransi')
            ->getStyle('T4')->getAlignment()->applyFromArray(
                array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,)
            );
        $obj->setActiveSheetIndex(0)->getStyle('T4')->getFont()->setBold(true);
        $obj->setActiveSheetIndex(0)
            ->setCellValue('U4', 'Keterangan')
            ->getStyle('U4')->getAlignment()->applyFromArray(
                array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,)
            );
        $obj->setActiveSheetIndex(0)->getStyle('U4')->getFont()->setBold(true);
        $obj->setActiveSheetIndex(0)
            ->mergeCells('V3:Z3')
            ->setCellValue('V3', 'Asuransi Jiwa Kredit')
            ->getStyle('V3')->getAlignment()->applyFromArray(
                array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,)
            );
        $obj->setActiveSheetIndex(0)->getStyle('V3')->getFont()->setBold(true);
        $obj->setActiveSheetIndex(0)
            ->setCellValue('V4', 'No. Polis')
            ->getStyle('V4')->getAlignment()->applyFromArray(
                array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,)
            );
        $obj->setActiveSheetIndex(0)->getStyle('V4')->getFont()->setBold(true);
        $obj->setActiveSheetIndex(0)
            ->setCellValue('W4', 'Jatuh Tempo')
            ->getStyle('W4')->getAlignment()->applyFromArray(
                array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,)
            );
        $obj->setActiveSheetIndex(0)->getStyle('W4')->getFont()->setBold(true);
        $obj->setActiveSheetIndex(0)
            ->setCellValue('X4', 'Nilai Pertanggungan')
            ->getStyle('X4')->getAlignment()->applyFromArray(
                array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,)
            );
        $obj->setActiveSheetIndex(0)->getStyle('X4')->getFont()->setBold(true);
        $obj->setActiveSheetIndex(0)
            ->setCellValue('Y4', 'Nama Asuransi')
            ->getStyle('Y4')->getAlignment()->applyFromArray(
                array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,)
            );
        $obj->setActiveSheetIndex(0)->getStyle('Y4')->getFont()->setBold(true);
        $obj->setActiveSheetIndex(0)
            ->setCellValue('Z4', 'Keterangan')
            ->getStyle('Z4')->getAlignment()->applyFromArray(
                array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,)
            );
        $obj->setActiveSheetIndex(0)->getStyle('Z4')->getFont()->setBold(true);
        $obj->setActiveSheetIndex(0)
            ->mergeCells('AA3:AA4')
            ->setCellValue('AA3', 'SLA')
            ->getStyle('AA3')->getAlignment()->applyFromArray(
                array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,)
            );
        $obj->setActiveSheetIndex(0)->getStyle('AA3')->getFont()->setBold(true);

        $obj->setActiveSheetIndex(0)
            ->mergeCells('AB3:AB4')
            ->setCellValue('AB3', 'Keterangan Aplikasi')
            ->getStyle('AB3')->getAlignment()->applyFromArray(
                array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,)
            );
        $obj->setActiveSheetIndex(0)->getStyle('AB3')->getFont()->setBold(true);

        $obj->setActiveSheetIndex(0)
            ->getColumnDimension("A")->setWidth(5);
        $obj->setActiveSheetIndex(0)
            ->getColumnDimension("B")->setWidth(10);
        $obj->setActiveSheetIndex(0)
            ->getColumnDimension("C")->setWidth(30);
        $obj->setActiveSheetIndex(0)
            ->getColumnDimension("D")->setWidth(10);
        $obj->setActiveSheetIndex(0)
            ->getColumnDimension("E")->setWidth(30);
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
        $obj->setActiveSheetIndex(0)
            ->getColumnDimension("AB")->setAutoSize(true);


        $tebel = array();
        $tebel['borders']=array();
        $tebel['borders']['allborders']=array();
        $tebel['borders']['allborders']['style']=PHPExcel_Style_Border::BORDER_THIN;
        $obj->setActiveSheetIndex(0)
            ->getStyle('A3:AB4')->applyFromArray($tebel);

        $baris = 5;
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
                ->setCellValue("B$baris", $row[0])
                ->setCellValue("C$baris", $row[1])
                ->setCellValue("D$baris", $row[2])
                ->setCellValue("E$baris", $row[5])
                ->setCellValue("F$baris", $row[3])
                ->setCellValue("G$baris", $row[4])
                ->setCellValue("H$baris", $row[8])
                ->setCellValue("I$baris", $row[9])
                ->setCellValue("J$baris", $row[6])
                ->setCellValue("K$baris", $row[7])
                ->setCellValue("L$baris", $row[8])
                ->setCellValue("M$baris", $row[11])
                ->setCellValue("N$baris", $row[17])
                ->setCellValue("O$baris", $row[18])
                ->setCellValue("P$baris", $row[19])
                ->setCellValue("Q$baris", $row[20])
                ->setCellValue("R$baris", $row[21])
                ->setCellValue("S$baris", $row[22])
                ->setCellValue("T$baris", $row[23])
                ->setCellValue("U$baris", $row[24])
                ->setCellValue("V$baris", $row[25])
                ->setCellValue("W$baris", $row[26])
                ->setCellValue("X$baris", $row[27])
                ->setCellValue("Y$baris", $row[28])
                ->setCellValue("Z$baris", $row[29])
                ->setCellValue("AA$baris", $sla)
                ->setCellValue("AB$baris", $row[14]);
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