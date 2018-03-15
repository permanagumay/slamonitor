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
                                             ,a.create_at
                                             ,d.document
                                             ,c.doc_lain
                                             ,c.tgl_pengurusan
                                             ,c.tgl_target
                                             ,k.status
                                             ,k.create_at as tgl_createSignPK
                                             ,k.keterangan
                                             ,k.tgl_pemenuhan
                                        from tb_inputcrm a
                                            left join master_marketing b on a.nik_marketing = b.nik_marketing
                                            left join cabang j on a.cabang = j.company_name
                                            left join tb_inputdoc c on a.id_crm = c.id_crm
                                            left join master_document d on c.id_doc = d.id_masterdoc
                                            left join tb_inputsignpk k on a.id_crm = k.id_crm 
                                        where
                                            j.id_cabang = '".$cabang."'
                                            and a.status != 4 
                                            and c.status != 1 
                                            and c.tgl_target between '".$startDate."' and '".$endDate."'");

        $filename = "Rekap Document TBO Periode $startDate-$endDate.xls";
        $obj = new PHPExcel();

        $obj->getProperties()->setCreator("Elly Permana")
            ->setLastModifiedBy("Elly Permana")
            ->setTitle("Laporan Monitoring")
            ->setSubject("Laporan Monitoring")
            ->setDescription("Laporan Monitoring .")
            ->setKeywords("Office 2007 openxml php")
            ->setCreator("Elly Permana");


        $obj->setActiveSheetIndex(0)
            ->mergeCells('A1:K1')
            ->setCellValue("A1", "REKAP DOCUMENT TBO")
            ->getStyle('A1')->getAlignment()->applyFromArray(
                array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,)
            );
        $obj->setActiveSheetIndex(0)->getStyle('A1')->getFont()->setBold(true);

        $obj->setActiveSheetIndex(0)
            ->mergeCells('A2:K2')
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
        $obj->setActiveSheetIndex(0)->getStyle('B4')->getAlignment()->setWrapText(true);
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
            ->mergeCells('G4:I4')
            ->setCellValue('G4', 'Document TBO')
            ->getStyle('G4')->getAlignment()->applyFromArray(
                array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,)
            );
        $obj->setActiveSheetIndex(0)->getStyle('G4')->getFont()->setBold(true);
        $obj->setActiveSheetIndex(0)
            ->setCellValue('G5', 'TBO')
            ->getStyle('G5')->getAlignment()->applyFromArray(
                array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,)
            );
        $obj->setActiveSheetIndex(0)->getStyle('G5')->getFont()->setBold(true);
        $obj->setActiveSheetIndex(0)
            ->setCellValue('H5', 'Tgl. Pengurusan')
            ->getStyle('H5')->getAlignment()->applyFromArray(
                array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,)
            );
        $obj->setActiveSheetIndex(0)->getStyle('H5')->getFont()->setBold(true);
        $obj->setActiveSheetIndex(0)->getStyle('H5')->getAlignment()->setWrapText(true);
        $obj->setActiveSheetIndex(0)
            ->setCellValue('I5', 'Target Date')
            ->getStyle('I5')->getAlignment()->applyFromArray(
                array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,)
            );
        $obj->setActiveSheetIndex(0)->getStyle('I5')->getFont()->setBold(true);
        $obj->setActiveSheetIndex(0)->getStyle('I5')->getAlignment()->setWrapText(true);
        $obj->setActiveSheetIndex(0)
            ->mergeCells('J4:J5')
            ->setCellValue('J4', 'SLA')
            ->getStyle('J4')->getAlignment()->applyFromArray(
                array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,)
            );
        $obj->setActiveSheetIndex(0)->getStyle('J4')->getFont()->setBold(true);
        $obj->setActiveSheetIndex(0)
            ->mergeCells('K4:K5')
            ->setCellValue('K4', 'Keterangan Aplikasi')
            ->getStyle('K4')->getAlignment()->applyFromArray(
                array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,)
            );
        $obj->setActiveSheetIndex(0)->getStyle('K4')->getFont()->setBold(true);
        $obj->setActiveSheetIndex(0)->getStyle('K4')->getAlignment()->setWrapText(true);
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


        $tebel = array();
        $tebel['borders']=array();
        $tebel['borders']['allborders']=array();
        $tebel['borders']['allborders']['style']=PHPExcel_Style_Border::BORDER_THIN;
        $obj->setActiveSheetIndex(0)
            ->getStyle('A4:K5')->applyFromArray($tebel);

        $baris = 6;
        $no = 0;

        while ($row = mysqli_fetch_array($sql)) {
            if($row[11] == 1){
                $tglCreate = date_create($row[6]);
                $dtCreate = strtotime(date_format($tglCreate, "Y-m-d"));
                $tglSignIn = date_create($row[14]);
                $dtSignin = strtotime(date_format($tglSignIn, "Y-m-d"));
                $selisih = abs($dtSignin-$dtCreate);
                $sla = $selisih/86400; // 86400 jumlah detik dalam sehari
            }else {
                $tglCreate = date_create($row[6]);
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
                ->setCellValue("G$baris", $row[7].'-'.$row['8'])
                ->setCellValue("H$baris", $row[9])
                ->setCellValue("I$baris", $row[10])
                ->setCellValue("J$baris", $sla)
                ->setCellValue("K$baris", $row[13]);
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