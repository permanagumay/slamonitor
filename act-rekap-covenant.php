<?php
error_reporting(E_ALL);
include "assets/koneksi.php";
include 'assets/Classes/PHPExcel.php';
/*include_once 'assets/bootstrap/css/tengah.css';*/
if(isset($_POST['endDate']) && isset($_POST['startDate'])){
    $startDate = $_POST['startDate'];
    $endDate = $_POST['endDate'];

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
                                            ,d.syarat
                                            ,c.syarat_lainnya
                                            ,c.tgl_mulai
                                            ,c.tgl_target
                                            ,k.status
                                            ,k.create_at as tgl_createSignPK
                                            ,k.keterangan
                                            ,k.tgl_pemenuhan
                                        from tb_inputcrm a
                                           left join master_marketing b on a.nik_marketing = b.nik_marketing
                                           left join cabang j on a.cabang = j.company_name
                                           left join tb_inputcovenant c on a.id_crm = c.id_crm
                                           left join master_syaratcovenant d on c.id_syarat = d.id_syarat
                                           left join tb_inputsignpk k on a.id_crm = k.id_crm
                                        where
											a.status != 4 
                                            and c.status_progress != 1 
                                            and c.tgl_target between '".$startDate."' and '".$endDate."'
                                            order by j.id_cabang asc");

        $filename = "Rekap Document Covenant Periode $startDate-$endDate.xls";
        $obj = new PHPExcel();

        $obj->getProperties()->setCreator("Elly Permana")
            ->setLastModifiedBy("Elly Permana")
            ->setTitle("Laporan Monitoring")
            ->setSubject("Laporan Monitoring")
            ->setDescription("Laporan Monitoring .")
            ->setKeywords("Office 2007 openxml php")
            ->setCreator("Elly Permana");


        $obj->setActiveSheetIndex(0)
            ->mergeCells('A1:L1')
            ->setCellValue("A1", "REKAP DOCUMENT COVENANT")
            ->getStyle('A1')->getAlignment()->applyFromArray(
                array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,)
            );
        $obj->setActiveSheetIndex(0)->getStyle('A1')->getFont()->setBold(true);
        $obj->setActiveSheetIndex(0)
            ->mergeCells('A2:L2')
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
            ->setCellValue('E3', 'Nama Debitur')
            ->getStyle('E3')->getAlignment()->applyFromArray(
                array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,)

            );
        $obj->setActiveSheetIndex(0)->getStyle('E3')->getFont()->setBold(true);
        $obj->setActiveSheetIndex(0)
            ->mergeCells('F3:F4')
            ->setCellValue('F3', 'No. PPK')
            ->getStyle('F3')->getAlignment()->applyFromArray(
                array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,)

            );
        $obj->setActiveSheetIndex(0)->getStyle('F3')->getFont()->setBold(true);
        $obj->setActiveSheetIndex(0)
            ->mergeCells('G3:G4')
            ->setCellValue('G3', 'No. CRM')
            ->getStyle('G3')->getAlignment()->applyFromArray(
                array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,)

            );
        $obj->setActiveSheetIndex(0)->getStyle('G3')->getFont()->setBold(true);
        $obj->setActiveSheetIndex(0)
            ->mergeCells('H3:J3')
            ->setCellValue('H3', 'Covenant')
            ->getStyle('H3')->getAlignment()->applyFromArray(
                array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,)
            );
        $obj->setActiveSheetIndex(0)->getStyle('H3')->getFont()->setBold(true);
        $obj->setActiveSheetIndex(0)
            ->setCellValue('H4', 'Covenant')
            ->getStyle('H4')->getAlignment()->applyFromArray(
                array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,)
            );
        $obj->setActiveSheetIndex(0)->getStyle('H4')->getFont()->setBold(true);
        $obj->setActiveSheetIndex(0)
            ->setCellValue('I4', 'Tgl. Pengurusan')
            ->getStyle('I4')->getAlignment()->applyFromArray(
                array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,)
            );
        $obj->setActiveSheetIndex(0)->getStyle('I4')->getFont()->setBold(true);
        $obj->setActiveSheetIndex(0)->getStyle('I4')->getAlignment()->setWrapText(true);
        $obj->setActiveSheetIndex(0)
            ->setCellValue('J4', 'Target Date')
            ->getStyle('J4')->getAlignment()->applyFromArray(
                array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,)
            );
        $obj->setActiveSheetIndex(0)->getStyle('J4')->getFont()->setBold(true);
        $obj->setActiveSheetIndex(0)->getStyle('J4')->getAlignment()->setWrapText(true);
        $obj->setActiveSheetIndex(0)
            ->mergeCells('K3:K4')
            ->setCellValue('K3', 'SLA')
            ->getStyle('K3')->getAlignment()->applyFromArray(
                array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,)
            );
        $obj->setActiveSheetIndex(0)->getStyle('K3')->getFont()->setBold(true);
        $obj->setActiveSheetIndex(0)
            ->mergeCells('L3:L4')
            ->setCellValue('L3', 'Keterangan Aplikasi')
            ->getStyle('L3')->getAlignment()->applyFromArray(
                array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,)
            );
        $obj->setActiveSheetIndex(0)->getStyle('L3')->getFont()->setBold(true);
        $obj->setActiveSheetIndex(0)->getStyle('L3')->getAlignment()->setWrapText(true);

        $obj->setActiveSheetIndex(0)
            ->getColumnDimension("A")->setAutoSize(true);
        $obj->setActiveSheetIndex(0)
            ->getColumnDimension("B")->setAutoSize(true);
        $obj->setActiveSheetIndex(0)
            ->getColumnDimension("C")->setWidth(30);
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

        $tebel = array();
        $tebel['borders']=array();
        $tebel['borders']['allborders']=array();
        $tebel['borders']['allborders']['style']=PHPExcel_Style_Border::BORDER_THIN;
        $obj->setActiveSheetIndex(0)
            ->getStyle('A3:L4')->applyFromArray($tebel);

        $baris = 5;
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
                ->setCellValue("B$baris", $row[0])
                ->setCellValue("C$baris", $row[1])
                ->setCellValue("D$baris", $row[2])
                ->setCellValue("E$baris", $row[5])
                ->setCellValue("F$baris", $row[3])
                ->setCellValue("G$baris", $row[4])
                ->setCellValue("H$baris", $row[7].'-'.$row['8'])
                ->setCellValue("I$baris", $row[9])
                ->setCellValue("J$baris", $row[10])
                ->setCellValue("K$baris", $sla)
                ->setCellValue("L$baris", $row[13]);
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