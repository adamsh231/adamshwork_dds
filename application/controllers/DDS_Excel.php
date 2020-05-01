<?php
defined('BASEPATH') or exit('No direct script access allowed');

//load phpspreadsheet class using namespaces
use PhpOffice\PhpSpreadsheet\Spreadsheet;
//call iofactory instead of xlsx writer
use PhpOffice\PhpSpreadsheet\IOFactory;
//phpspreadsheet Date class
use PhpOffice\PhpSpreadsheet\Shared\Date;
//phpspreadsheet numberformat style class
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
//rich text class
use \PhpOffice\PhpSpreadsheet\RichText\RichText;
//phpspreadsheet style color
use \PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Cell\DataType;

class DDS_Excel extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
    }

    function index($tahun = "")
    {
        if (isset($_POST['submit'])) {
            $tahun = $_POST['tahun'];
        } else {
            $tahun = date('Y');
        }
        //styling arrays
        //table head style
        $tableHead = [
            'font' => [
                'color' => [
                    'rgb' => 'FFFFFF'
                ],
                'bold' => true,
                'size' => 11
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => [
                    'rgb' => '538ED5'
                ]
            ],
        ];
        //even row
        $evenRow = [
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => [
                    'rgb' => '00BDFF'
                ]
            ]
        ];
        //odd row
        $oddRow = [
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => [
                    'rgb' => '00EAFF'
                ]
            ]
        ];

        //styling arrays end

        //make a new spreadsheet object
        $spreadsheet = new Spreadsheet();
        //get current active sheet (first sheet)
        $sheet = $spreadsheet->getActiveSheet();

        //set default font
        $spreadsheet->getDefaultStyle()
            ->getFont()
            ->setName('Times New Roman')
            ->setSize(10);

        //heading
        $spreadsheet->getActiveSheet()
            ->setCellValue('A3', "HASIL PENGUKURAN ANTROPOMETRI BALITA");

        //merge heading
        $spreadsheet->getActiveSheet()->mergeCells("A3:AY3");

        // set font style
        $spreadsheet->getActiveSheet()->getStyle('A3')->getFont()->setSize(20);

        // set cell alignment
        $spreadsheet->getActiveSheet()->getStyle('A3')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        //setting column width
        // $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(1);
        // $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(1);

        for ($i = 'A'; $i !== 'AZ'; $i++) {
            $spreadsheet->getActiveSheet()->getColumnDimension($i)
                ->setAutoSize(true);
        }

        //header text
        $spreadsheet->getActiveSheet()
            ->setCellValue('A4', "No")
            ->setCellValue('B4', "Nama Anak")
            ->setCellValue('C4', "NIK Anak")
            ->setCellValue('D4', "L/P")
            ->setCellValue('E4', "Nama Orang Tua")
            ->setCellValue('F4', "NIK Orang Tua")
            ->setCellValue('G4', "BB Lahir")
            ->setCellValue('H4', "TB Lahir")
            ->setCellValue('I5', "TGL")
            ->setCellValue('J5', "BLN")
            ->setCellValue('K5', "THN")
            ->setCellValue('L5', "TGL")
            ->setCellValue('M5', "BLN")
            ->setCellValue('N5', "THN")
            ->setCellValue('O4', "Nama Posyandu");

        $cellcount = 1;
        $ubbtb = [1 => "Umur", "BB", 0 => "TB"];
        $bulan = [1 => "JANUARI", "FEBRUARI", "MARET", "APRIL", "MEI", "JUNI", "JULI", "AGUSTUS", "SEPTEMBER", "OKTOBER", "NOVEMBER", 0 => "DESEMBER"];
        $countBulan = 0;
        for ($i = 'P'; $i !== 'ZZ'; $i++) {
            $spreadsheet->getActiveSheet()->setCellValue($i . '5', $ubbtb[($cellcount % 3)]);

            if ($cellcount % 3 == 1) {
                $loopmerge = 1;
                $mergecell = "";
                for ($j = $i; $j !== 'ZZ'; $j++) {
                    if ($loopmerge == 3) {
                        $loopmerge = 0;
                        $mergecell = $j;
                        break;
                    }
                    $loopmerge++;
                }
                $countBulan++;
                $spreadsheet->getActiveSheet()->setCellValue($i . '4', $bulan[$countBulan % 12]);
                $spreadsheet->getActiveSheet()->mergeCells($i . "4" . ":" . $mergecell . "4");
                $spreadsheet->getActiveSheet()->getStyle($i . '4')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            }

            if ($cellcount == 36) {
                break;
            }
            $cellcount++;
        }

        foreach (range('A', 'H') as $columnID) {
            $spreadsheet->getActiveSheet()->mergeCells($columnID . "4:" . $columnID . "5");
            $spreadsheet->getActiveSheet()->getStyle($columnID . '4')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
            $spreadsheet->getActiveSheet()->getStyle($columnID . '4')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        }
        foreach (range('O', 'O') as $columnID) {
            $spreadsheet->getActiveSheet()->mergeCells($columnID . "4:" . $columnID . "5");
            $spreadsheet->getActiveSheet()->getStyle($columnID . '4')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
            $spreadsheet->getActiveSheet()->getStyle($columnID . '4')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        }

        for ($i = 'P'; $i !== 'AZ'; $i++) {
            $spreadsheet->getActiveSheet()->getStyle($i . '5')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        }

        $spreadsheet->getActiveSheet()->setCellValue('I4', "TGL. UKUR");
        $spreadsheet->getActiveSheet()->mergeCells("I4:K4");
        $spreadsheet->getActiveSheet()->getStyle('I4')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        $spreadsheet->getActiveSheet()->setCellValue('L4', "TGL LAHIR");
        $spreadsheet->getActiveSheet()->mergeCells("L4:N4");
        $spreadsheet->getActiveSheet()->getStyle('L4')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        //set font style and background color
        $spreadsheet->getActiveSheet()->getStyle('A4:AY5')->applyFromArray($tableHead);

        //the content
        //read the json file
        $file = file_get_contents(base_url() . 'student-data.json');
        $studentData = json_decode($file, true);

        $dataLapor = $this->M_DDS->getLaporan('where tgl_lahir <= "' . $tahun . '-12-31" order by anak.id asc');

        //loop through the data
        //current row
        $row = 6;
        $no = 0;
        foreach ($dataLapor as $data) {
            $date = date_create($data['tgl_lahir']);
            $no++;

            $spreadsheet->getActiveSheet()
                ->setCellValue('A' . $row, $no)
                ->setCellValue('B' . $row, ucwords($data['nama']))
                ->setCellValueExplicit('C' . $row, ucwords($data['nik']), DataType::TYPE_STRING)
                ->setCellValue('D' . $row, ucwords($data['jenis_kelamin']))
                ->setCellValue('E' . $row, ucwords($data['nama_ibu']))
                ->setCellValueExplicit('F' . $row, ucwords($data['nik_ibu']), DataType::TYPE_STRING)
                ->setCellValue('G' . $row, ucwords($data['bb_lahir']))
                ->setCellValue('H' . $row, ucwords($data['tb_lahir']))

                ->setCellValue('L' . $row, (int) date_format($date, "d"))
                ->setCellValue('M' . $row, (int) date_format($date, "m"))
                ->setCellValue('N' . $row, (int) date_format($date, "y"))

                ->setCellValue('O' . $row, ucwords($data['nama_pos']));
            $spreadsheet->getActiveSheet()->getStyle('A' . $row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $spreadsheet->getActiveSheet()->getStyle('C' . $row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $spreadsheet->getActiveSheet()->getStyle('D' . $row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $spreadsheet->getActiveSheet()->getStyle('F' . $row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $row++;
        }

        $dataUpdate = $this->M_DDS->getRecord('where usia = 0 and tahun <= "' . $tahun . '" order by usia asc');
        $row2 = 6;
        $bulan = [1 => "JANUARI", "FEBRUARI", "MARET", "APRIL", "MEI", "JUNI", "JULI", "AGUSTUS", "SEPTEMBER", "OKTOBER", "NOVEMBER", "DESEMBER"];
        foreach ($dataUpdate as $data) {
            $date = date_create($data['update']);
            $spreadsheet->getActiveSheet()
                ->setCellValue('I' . $row2, (int) date_format($date, "d"))
                ->setCellValue('J' . $row2, (int) date_format($date, "m"))
                ->setCellValue('K' . $row2, (int) date_format($date, "y"));
            $row2++;
        }

        $dataRecord = $this->M_DDS->getRecord('where tahun = "' . $tahun . '" order by id_anak,usia');
        $usia = [];
        $bb = [];
        $tb = [];
        $bulan = [];
        $jumlah = 0;
        foreach ($dataRecord as $data) {
            $usia[$jumlah] = $data['usia'];
            $bb[$jumlah] = $data['bb_skrg'];
            $tb[$jumlah] = $data['tb_skrg'];
            $bulan[$jumlah] = $data['bulan'];
            $jumlah++;
        }

        $id = [];
        $idcount = 0;
        foreach ($dataLapor as $data) {
            $id[$idcount] = $data['id'];
            $idcount++;
        }

        $column = [];

        $countColumn = 0;
        for ($i = 'P'; $i !== 'AZ'; $i++) {
            $column[$countColumn] = $i;
            $countColumn++;
        }

        $loop = 1;
        $loop2 = 0;
        for ($j = 6; $j < count($dataLapor) + 6; $j++) {
            $dataRecordCount = $this->M_DDS->getRecord('where tahun = "' . $tahun . '" and id_anak ="' . $id[$j - 6] . '"');
            $countColumn = 0;
            for ($i = 'P'; $i !== 'AZ'; $i++) {                  //SAKJANE RAGUNA DIGENTI NOMER YO GAKPOPO DENGAN BATAS 0 SAMPAI 12X3= 36
                if (count($dataRecordCount) == 0) {
                    $loop = 1;
                    break;
                }
                $countColumn = ($bulan[$loop2] - 1) * 3;
                $spreadsheet->getActiveSheet()
                    ->setCellValue($column[$countColumn] . '' . $j, $usia[$loop2])
                    ->setCellValue($column[$countColumn + 1] . '' . $j, $bb[$loop2])
                    ->setCellValue($column[$countColumn + 2] . '' . $j, $tb[$loop2]);
                $loop2++;
                if ($loop == count($dataRecordCount)) {
                    $loop = 1;
                    break;
                }
                $loop++;
            }
        }


        $border = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                ],
            ],
        ];

        $spreadsheet->getActiveSheet()->getStyle('A4:AY' . ($row - 1))->applyFromArray($border);

        //autofilter
        //define first row and last row
        $firstRow = 4;
        $lastRow = $row - 1;
        //set the autofilter
        //$spreadsheet->getActiveSheet()->setAutoFilter("A".$firstRow.":F".$lastRow);

        //set the header first, so the result will be treated as an xlsx file.
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

        //make it an attachment so we can define filename
        header('Content-Disposition: attachment;filename="Laporan Hasil Pengukuran ' . $tahun . '.xlsx"');

        //create IOFactory object
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        //save into php output
        $writer->save('php://output');
    }
}
