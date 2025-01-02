<?php

/**
 * Reports controller
 */
class Reports extends Controller
{
    function index()
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }
        $data = [];
        $errors = array();

        $class = new Classe();

        $data = $class->findAll();

        $crumbs[] = ['Dashboard', ''];
        $actives = 'reports';
        $hiddenSearch = "NOP";
        return $this->view('reports', [
            'errors' => $errors,
            'rows' => $data,
            'crumbs' => $crumbs,
            'hiddenSearch' => $hiddenSearch,
            'actives' => $actives,
        ]);
    }
    function classlist($id)
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }
        $data = [];
        $errors = array();

        $class = new Classe();
        $students = new Student();

        $datatit = $class->where('id', $id)[0];
        if (isset($_GET['search_list'])) {
            $query = "SELECT * FROM `students` WHERE `studentid` LIKE :search_list OR `first_name` LIKE :search_list OR `last_name` LIKE :search_list AND `classid` =:classid";
            $arr = [
                'search_list' => '%' . $_GET['search_list'] . '%',
                'classid' => $id,
            ];

            $data = $students->findSearch($query, $arr);
        } else {
            $data = $students->where('classid', $id);
        }

        $crumbs[] = ['Dashboard', ''];
        $actives = 'reports';
        $hiddenSearch = "yeap";
        return $this->view('reports.classlist', [
            'errors' => $errors,
            'rows' => $data,
            'row' => $datatit,
            'crumbs' => $crumbs,
            'hiddenSearch' => $hiddenSearch,
            'actives' => $actives,
        ]);
    }

    function reportview($id)
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }
        $data = [];
        $errors = array();
        $students = new Student();
        $asses = new Assessment();

        $arr = [
            'studid' => $id,
            'semid' => $_SESSION['semester']->id,
        ];

        $data = $students->where('studentid', $id)[0];
        $rowreport = $asses->where_query("SELECT * FROM `assessments` WHERE `studentid` =:studid AND `semesterid` =:semid", $arr);

        $crumbs[] = ['Dashboard', ''];
        $actives = 'reports';
        $hiddenSearch = "yeap";
        return $this->view('students.report', [
            'errors' => $errors,
            'row' => $data,
            'rowreport' => $rowreport,
            'crumbs' => $crumbs,
            'hiddenSearch' => $hiddenSearch,
            'actives' => $actives,
        ]);
    }

    function download($id)
    {
        if (!Auth::logged_in()) {
            return $this->redirect('login');
        }

        $data = [];
        $students = new Student();
        $asses = new Assessment();
        $arr = [
            'studid' => $id,
            'semid' => $_SESSION['semester']->id,
        ];

        $data = $students->where('studentid', $id)[0];
        $rowreport = $asses->where_query("SELECT * FROM `assessments` WHERE `studentid` =:studid AND `semesterid` =:semid", $arr);


        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetTitle('EMS-SMS');

        // set default header data
        $pdf->SetHeaderData(PDF_HEADER_LOGO, 60);

        // set header and footer fonts
        $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);

        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set font
        $pdf->SetFont('helvetica', 'B', 20);

        // add a page
        $pdf->AddPage();

        $pdf->SetFont('helvetica', '', 12);
        
        $tbl = <<<EOD
            <table cellspacing="0" cellpadding="5" border="1" style="width: 100%; font-size: 12px; text-align: center;">
                <tr>
                    <td colspan="2" style="font-weight: bold;">Date:</td>
                    <td colspan="3"> {$data->semester->reportdate}</td>
                    <td colspan="2" style="font-weight: bold;">Next Term Begins:</td>
                    <td colspan="3"> {$data->semester->nextdate}</td>
                </tr>
                <tr>
                    <td colspan="2" style="font-weight: bold;">Name of Pupil:</td>
                    <td colspan="4"> {$data->first_name} {$data->last_name}</td>
                    <td colspan="2" style="font-weight: bold;">Class:</td>
                    <td colspan="2"> {$data->class->classname} </td>
                </tr>
                <tr>
                    <td colspan="2" style="font-weight: bold;">No. on Roll:</td>
                    <td colspan="3">{$data->class->classnum->numbers}</td>
                    <td colspan="2" style="font-weight: bold;">Term:</td>
                    <td colspan="3"> {$data->semester->semester} </td>
                </tr>
                <tr>
                    <td colspan="5" style="font-weight: bold;">SUBJECT</td>
                    <td colspan="1" style="font-weight: bold;">Class score (50%)</td>
                    <td colspan="1" style="font-weight: bold;">Exam score (50%)</td>
                    <td colspan="1" style="font-weight: bold;">Total score (100%)</td>
                    <td colspan="2" style="font-weight: bold;">Remarks</td>
                </tr>
            EOD;

            if ($rowreport) {
                foreach ($rowreport as $row) {
                    $totalmarks = $row->contasses + $row->exammark;
                    $remarks = get_Stud_Remarks($totalmarks);
                    $tbl .= <<<EOD
                    <tr>
                        <td colspan="5"> {$row->subject->title}</td>
                        <td colspan="1"> {$row->contasses}</td>
                        <td colspan="1"> {$row->exammark}</td>
                        <td colspan="1"> {$totalmarks}</td>
                        <td colspan="2"> {$remarks}</td>
                    </tr>
                    EOD;
                }
            }

            $tbl .= <<<EOD
                <tr>
                    <td colspan="2" style="font-weight: bold;">Attendance</td>
                    <td colspan="3"> <b>{$data->attends->attended}</b> out of <b>{$data->semester->numofdays}</b></td>
                    <td colspan="2" style="font-weight: bold;">Promoted to:</td>
                    <td colspan="3"> </td>
                </tr>
                <tr>
                    <td colspan="2" style="font-weight: bold;">Teacher's Remarks:</td>
                    <td colspan="8"> </td>
                </tr>
                <tr>
                    <td colspan="2" style="font-weight: bold;">Head Master's Remarks:</td>
                    <td colspan="8"> </td>
                </tr>
            </table>
            EOD;



        $pdf->writeHTML($tbl, true, false, false, false, '');
        //Close and output PDF document
        $pdf->Output($data->first_name . '_' . $data->last_name . '_report', 'I');
        return $this->redirect("/students/report/$id");
    }
}
