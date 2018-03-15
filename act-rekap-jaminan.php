<?php
error_reporting(E_ALL);
include "assets/koneksi.php";
include 'assets/Classes/PHPExcel.php';
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
                                            from tb_inputcrm a
                                            left join master_marketing b on a.nik_marketing = b.nik_marketing
                                            left join tb_inputjaminan c on a.id_crm = c.id_crm
                                            left join master_jenisagunan d on c.jaminan = d.id_jenisagunan
                                            left join cabang j on a.cabang = j.company_name
                                            left join tb_inputsignpk k on a.id_crm = k.id_crm                                 
                                            where 
                                            a.status != 4 and c.duedate_hgb between '".$startDate."' and '".$endDate."'                                          
                                            order by c.duedate_hgb asc");

        $filename = "Rekap Document Jaminan Periode $startDate-$endDate.xls";
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
            ->setCellValue("A1", "REKAP JAMINAN JATUH TEMPO HGB")
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
            ->mergeCells('N3:N4')
            ->setCellValue('N3', 'SLA')
            ->getStyle('N3')->getAlignment()->applyFromArray(
                array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,)
            );
        $obj->setActiveSheetIndex(0)->getStyle('N3')->getFont()->setBold(true);

        $obj->setActiveSheetIndex(0)
            ->mergeCells('O3:O4')
            ->setCellValue('O3', 'Keterangan')
            ->getStyle('O3')->getAlignment()->applyFromArray(
                array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,)
            );
        $obj->setActiveSheetIndex(0)->getStyle('O3')->getFont()->setBold(true);

        $obj->setActiveSheetIndex(0)
            ->getColumnDimension("A")->setWidth(5);
        $obj->setActiveSheetIndex(0)
            ->getColumnDimension("B")->setWidth(20);
        $obj->setActiveSheetIndex(0)
            ->getColumnDimension("C")->setWidth(20);
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
            ->getColumnDimension("M")->setAutoSize(true);
        $obj->setActiveSheetIndex(0)
            ->getColumnDimension("N")->setAutoSize(true);
        $obj->setActiveSheetIndex(0)
            ->getColumnDimension("O")->setAutoSize(true);


        $tebel = array();
        $tebel['borders']=array();
        $tebel['borders']['allborders']=array();
        $tebel['borders']['allborders']['style']=PHPExcel_Style_Border::BORDER_THIN;
        $obj->setActiveSheetIndex(0)
            ->getStyle('A3:O4')->applyFromArray($tebel);

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
                ->setCellValue("N$baris", $sla)
                ->setCellValue("O$baris", $row[14]);
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