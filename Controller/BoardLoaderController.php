<?php

namespace Kanboard\Plugin\BoardLoader\Controller;

use Kanboard\Controller\BaseController;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class BoardLoaderController extends BaseController
{
    public function loadExcel()
    {
        $project_id = $this->request->getStringParam('project_id');
        $tasklist = $this->taskFinderModel->getAll($project_id);

        $columnNames[] = array_keys($tasklist[0]);

        $spreadsheet = new Spreadsheet();
        $spreadsheet->getActiveSheet()->fromArray($columnNames, NULL, 'A1');
        $spreadsheet->getActiveSheet()->fromArray($tasklist, NULL, 'A2');

        $writer = new Xlsx($spreadsheet);
        $writer->save('tasklist.xlsx');

        $file = "tasklist.xlsx";
        header('Content-Description: File Transfer');
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename='.basename($file));
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file));
        readfile($file); // Downloading file
        unlink($file);   // Deleting file
        exit();
    }
}
?>