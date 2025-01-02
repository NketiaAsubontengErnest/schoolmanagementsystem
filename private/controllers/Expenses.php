<?php

/**
 * Expenses controller
 */
class Expenses extends Controller
{
    function index()
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }
        $limit = 10;
        $pager = new Pager($limit);
        $offset = $pager->offset;

        $data = [];
        $errors = array();
        $expenses = new Expense();
        $rowtype = new Expentype();

        if (count($_POST) > 0 && Auth::access('administrator')) {

            if ($expenses->validate($_POST)) {
                $expenses->insert($_POST);

                $_SESSION['messsage'] = "Expenses Successfully";
                $_SESSION['status_code'] = "success";
                $_SESSION['status_headen'] = "Good job!";
                return $this->redirect("expenses");
            } else {
                $errors = $expenses->errors;
            }
        }

        $rowstype = $rowtype->findAll();

        if (isset($_GET['search_list'])) {
            $query = "SELECT * FROM `expenses` WHERE `semid` =:semid AND `date` =:search_list LIMIT $limit OFFSET $offset";
            $arr = [
                'search_list' => $_GET['search_list'],
                'semid' => $_SESSION['semester']->id,
            ];

            $data = $expenses->findSearch($query, $arr);
        } else {
            $data = $expenses->where('semid', $_SESSION['semester']->id, $limit, $offset);
        }

        $crumbs[] = ['Dashboard', ''];
        $actives = 'expend';
        $hiddenSearch = "date";
        return $this->view('expenses', [
            'errors' => $errors,
            'rows' => $data,
            'rowstype' => $rowstype,
            'crumbs' => $crumbs,
            'pager' => $pager,
            'hiddenSearch' => $hiddenSearch,
            'actives' => $actives,
        ]);
    }

    function edit($id)
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }
        $data = [];
        $errors = array();
        $expenses = new Expense();
        $rowtype = new Expentype();

        if (count($_POST) > 0 && Auth::access('administrator')) {

            if ($expenses->validate($_POST)) {
                $expenses->update($id, $_POST);

                $_SESSION['messsage'] = "Expenses Updated Successfully";
                $_SESSION['status_code'] = "success";
                $_SESSION['status_headen'] = "Good job!";

                return $this->redirect("expenses");
            } else {
                $errors = $expenses->errors;
            }
        }

        $data = $expenses->where('id', $id)[0];
        $rowstype = $rowtype->findAll();

        $crumbs[] = ['Dashboard', ''];
        $actives = 'expend';
        $hiddenSearch = "no";
        return $this->view('expenses.edit', [
            'errors' => $errors,
            'row' => $data,
            'rowstype' => $rowstype,
            'crumbs' => $crumbs,
            'hiddenSearch' => $hiddenSearch,
            'actives' => $actives,
        ]);
    }

    function salary()
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }
        // Setting pagination
        $limit = 20;
        $pager = new Pager($limit);
        $offset = $pager->offset;

        $data = [];
        $arr = [];
        $errors = array();
        $employees = new Employee();
        $salarys = new Salary();

        $datause = $employees->findAll();

        if (isset($_POST['export'])) {
            $exportdata = $employees->findAll();

            if ($exportdata) {
                $fields = array('Staff No#', 'First Name', 'Last Name', 'Titile', 'Basic Salary', 'Weekly Allowance', 'Mountly Allowance', 'SSNIT', 'FOOD STIPEND', 'NET PAY', 'TOTAL');
                $excelData = implode("\t", array_values($fields)) . "\n";

                if ($exportdata) {
                    foreach ($exportdata as $row) {
                        if ($row->activenes == 0) {
                            $lineData = array(
                                $row->staffid,
                                $row->first_name,
                                $row->last_name,
                                $row->job_titil,
                                $row->basic_salary,
                                $row->weeklyallowance,
                                number_format($row->weeklyallowance * 4.00, 2),
                                $row->ssnitamount,
                                $row->foodalloance,
                                number_format($row->weeklyallowance + $row->basic_salary, 2),
                                number_format(($row->weeklyallowance * 4) + ($row->basic_salary + $row->foodalloance), 2)
                            );
                        }
                        $excelData .= implode("\t", array_values($lineData)) . "\n";
                    }
                    export_data_to_excel($fields, $excelData, 'Eployees_Salary_Sheet');
                } else {
                    $excelData .= 'No records found...' . "\n";
                }
            }

            $_SESSION['messsage'] = "Employees Data Exported Successfully";
            $_SESSION['status_code'] = "success";
            $_SESSION['status_headen'] = "Good job!";
        }


        if (count($_POST) > 0 && Auth::access('administrator')) {
            foreach ($datause as $row) {
                $arr = [
                    'staffid' => $row->staffid,
                    'basicsalary' => $row->basic_salary,
                    'weeklyalowance' => $row->weeklyallowance,
                    'ssnitamount' => $row->ssnitamount,
                    'foodstipen' => $row->foodalloance,
                    'semesterid' =>  $_SESSION['semester']->id
                ];

                $salarys->insert($arr);
            }

            $_SESSION['messsage'] = "Salary Paid Successfully";
            $_SESSION['status_code'] = "success";
            $_SESSION['status_headen'] = "Good job!";
        }

        if (isset($_GET['search_list'])) {
            $query = "SELECT * FROM `employees` WHERE `first_name` LIKE :search_list OR `last_name` LIKE :search_list OR `staffid` LIKE :search_list OR `phone` LIKE :search_list LIMIT $limit OFFSET $offset";
            $arr = [
                'search_list' => '%' . $_GET['search_list'] . '%',
            ];

            $data = $employees->findSearch($query, $arr);
        } else {
            $data = $employees->findAll($limit, $offset);
        }

        $crumbs[] = ['Dashboard', ''];
        $actives = 'expend';
        $hiddenSearch = "yeap";
        return $this->view('expenses.salary', [
            'errors' => $errors,
            'rows' => $data,
            'pager' => $pager,
            'crumbs' => $crumbs,
            'hiddenSearch' => $hiddenSearch,
            'actives' => $actives,
        ]);
    }

    function mountlysalary($id)
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }
        $data = [];
        $errors = array();
        $salarys = new Salary();

        $data = $salarys->where('paymentdate', $id);

        $crumbs[] = ['Dashboard', ''];
        $actives = 'expend';
        $hiddenSearch = "nop";
        return $this->view('expenses.mountlysalary', [
            'errors' => $errors,
            'rows' => $data,
            'crumbs' => $crumbs,
            'hiddenSearch' => $hiddenSearch,
            'actives' => $actives,
        ]);
    }

    function paymenthistoory()
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }
        // Setting pagination
        $limit = 20;
        $pager = new Pager($limit);
        $offset = $pager->offset;

        $data = [];
        $salarys = new Salary();

        if (isset($_GET['search_list'])) {
            $query = "SELECT DISTINCT paymentdate, SUM(basicsalary) AS total_basicsalary, SUM(weeklyalowance) AS total_weeklyalowance, SUM(ssnitamount) AS total_ssnitamount, SUM(foodstipen) AS total_foodstipen FROM salarys WHERE paymentdate =:search_list GROUP BY paymentdate ORDER BY paymentdate DESC  LIMIT $limit OFFSET $offset";
            $arr = [
                'search_list' => $_GET['search_list'],
            ];
            $data = $salarys->query($query, $arr);
        } else {
            $data = $salarys->query("SELECT DISTINCT paymentdate, SUM(basicsalary) AS total_basicsalary, SUM(weeklyalowance) AS total_weeklyalowance, SUM(ssnitamount) AS total_ssnitamount, SUM(foodstipen) AS total_foodstipen FROM salarys GROUP BY paymentdate ORDER BY paymentdate DESC  LIMIT $limit OFFSET $offset");
        }

        if (isset($_POST['export'])) {
            $exportdata = $salarys->query("SELECT DISTINCT paymentdate, SUM(basicsalary) AS total_basicsalary, SUM(weeklyalowance) AS total_weeklyalowance, SUM(ssnitamount) AS total_ssnitamount, SUM(foodstipen) AS total_foodstipen FROM salarys GROUP BY paymentdate ORDER BY paymentdate DESC  LIMIT $limit OFFSET $offset");

            if ($exportdata) {
                $fields = array('Date', 'Total Basic sal.', 'Total Weekly Allow.', 'Total Mountly Allow.', 'Total SSNIT', 'FOOD STIPEND', 'TOTAL NET', 'TOTAL');
                $excelData = implode("\t", array_values($fields)) . "\n";

                if ($exportdata) {
                    foreach ($exportdata as $row) {
                        $lineData = array(
                            date('d/m/Y', strtotime($row->paymentdate)),
                            $row->total_basicsalary,
                            $row->total_weeklyalowance,
                            number_format(($row->total_weeklyalowance * 4), 2),
                            $row->total_ssnitamount,
                            $row->total_foodstipen,
                            esc(number_format($row->total_basicsalary + $row->total_weeklyalowance, 2)),
                            esc(number_format($row->total_basicsalary + ($row->total_weeklyalowance * 4) + $row->total_foodstipen + $row->total_ssnitamount, 2)),
                        );
                        $excelData .= implode("\t", array_values($lineData)) . "\n";
                    }
                    export_data_to_excel($fields, $excelData, 'Histoty_Salary_Sheet');
                } else {
                    $excelData .= 'No records found...' . "\n";
                }
            }

            $_SESSION['messsage'] = "Employees Data Exported Successfully";
            $_SESSION['status_code'] = "success";
            $_SESSION['status_headen'] = "Good job!";
        }

        $crumbs[] = ['Dashboard', ''];
        $actives = 'expend';
        $hiddenSearch = "date";
        return $this->view('expenses.paymenthistoory', [
            'rows' => $data,
            'crumbs' => $crumbs,
            'pager' => $pager,
            'hiddenSearch' => $hiddenSearch,
            'actives' => $actives,
        ]);
    }

    function Report()
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }
        $data = [];
        $errors = array();
        $expenses = new Expense();

        if (count($_POST) > 0 && Auth::access('administrator')) {

            if ($expenses->validate($_POST)) {
                $expenses->insert($_POST);

                $_SESSION['messsage'] = "Expenses Successfully";
                $_SESSION['status_code'] = "success";
                $_SESSION['status_headen'] = "Good job!";
                return $this->redirect("expenses");
            } else {
                $errors = $expenses->errors;
            }
        }

        $arr['semid'] = $_SESSION['semester']->id;

        $data = $expenses->query('SELECT 
                date,
                SUM(total_income) + SUM(pta_income) AS total_income,  -- Add pta_income to total_income
                SUM(total_expense) AS total_expense,
                (SUM(total_income) + SUM(pta_income) - SUM(total_expense)) AS daily_balance,  -- Update daily_balance calculation
                SUM(SUM(total_income) + SUM(pta_income) - SUM(total_expense)) OVER (ORDER BY date) AS cumulative_balance,
                SUM(pta_income) AS pta_income  -- Total PTA fees income
            FROM (
                SELECT 
                    i.date AS date,
                    SUM(i.amount) AS total_income,
                    0 AS total_expense,
                    0 AS pta_income                  -- Placeholder for PTA fees income
                FROM 
                    incomes i
                WHERE 
                    i.semid = :semid
                GROUP BY 
                    i.date

                UNION ALL

                SELECT 
                    e.date AS date,
                    0 AS total_income,
                    SUM(e.amount) AS total_expense,
                    0 AS pta_income                  -- Placeholder for PTA fees income
                FROM 
                    expenses e
                WHERE 
                    e.semid = :semid
                GROUP BY 
                    e.date

                UNION ALL

                SELECT 
                    f.date AS date,
                    SUM(f.schoolfeeghc + f.classfeeghc) AS total_income,
                    0 AS total_expense,
                    0 AS pta_income                  -- Placeholder for PTA fees income
                FROM 
                    fees f
                WHERE 
                    f.semesterid = :semid
                GROUP BY 
                    f.date

                UNION ALL

                SELECT 
                    p.date AS date,
                    SUM(p.amount) AS total_income,  -- Sum of PTA fees
                    0 AS total_expense,
                    SUM(p.amount) AS pta_income      -- Total PTA fees income
                FROM 
                    ptafees p
                WHERE 
                    p.semesterid = :semid -- Ensure filtering based on semesterid
                GROUP BY 
                    p.date
            ) AS income_expense
            GROUP BY 
                date
            ORDER BY 
                date ASC;
            ', $arr);
        //$rowstype = $rowtype->findAll();

        $crumbs[] = ['Dashboard', ''];
        $actives = 'expend';
        $hiddenSearch = "nop";
        return $this->view('expenses.report', [
            'errors' => $errors,
            'rows' => $data,
            'crumbs' => $crumbs,
            'hiddenSearch' => $hiddenSearch,
            'actives' => $actives,
        ]);
    }

    function Reportgenerate()
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }
        $data = [];
        $errors = array();
        $expenses = new Expense();

        $arr['semid'] = $_SESSION['semester']->id;

        $data = $expenses->query('SELECT it.incomtypename, SUM(i.amount) AS total_amount FROM incomes i JOIN incomtypes it ON i.typeid = it.id WHERE semid =:semid GROUP BY it.incomtypename; ', $arr);
        $datapta = $expenses->query('SELECT SUM(`amount`) total_pta FROM `ptafees` WHERE `semesterid` =:semid ', $arr)[0];
        $dataexamf = $expenses->query('SELECT SUM(`amount`) total_examf FROM `examfees` WHERE `semesterid` =:semid ', $arr)[0];
        $datatution = $expenses->query('SELECT SUM(`schoolfeeghc`) AS total_schoolfees, SUM(`classfeeghc`) AS total_classfee FROM `fees` WHERE `semesterid` =:semid', $arr)[0];

        $dataexp = $expenses->query('SELECT it.expntype, SUM(e.amount) AS total_amount FROM expenses e JOIN expentypes it ON e.typeid = it.id WHERE semid =:semid GROUP BY it.expntype; ', $arr);
        //$rowstype = $rowtype->findAll();

        if (isset($_POST['export'])) {
            $data = $expenses->query('SELECT it.incomtypename, SUM(i.amount) AS total_amount FROM incomes i JOIN incomtypes it ON i.typeid = it.id WHERE semid =:semid GROUP BY it.incomtypename; ', $arr);
            $datapta = $expenses->query('SELECT SUM(`amount`) total_pta FROM `ptafees` WHERE `semesterid` =:semid ', $arr)[0];
            $dataexamf = $expenses->query('SELECT SUM(`amount`) total_examf FROM `examfees` WHERE `semesterid` =:semid ', $arr)[0];
            $datatution = $expenses->query('SELECT SUM(`schoolfeeghc`) AS total_schoolfees, SUM(`classfeeghc`) AS total_classfee FROM `fees` WHERE `semesterid` =:semid', $arr)[0];
    
            $dataexp = $expenses->query('SELECT it.expntype, SUM(e.amount) AS total_amount FROM expenses e JOIN expentypes it ON e.typeid = it.id WHERE semid =:semid GROUP BY it.expntype; ', $arr);

            if ($data) {
                $fields = array('Revenue', 'Amount (GHC)');
                $excelData = implode("\t", array_values($fields)) . "\n";

                if ($data) {
                    foreach ($data as $row) {
                        $lineData = array(
                            $row->incomtypename,
                            esc(number_format($row->total_amount, 2))
                        );
                        $excelData .= implode("\t", array_values($lineData)) . "\n";
                    }

                    if ($datapta->total_pta) {
                        $lineData = array(
                            'PTA Fees',
                            esc(number_format($datapta->total_pta, 2))
                        );
                        $excelData .= implode("\t", array_values($lineData)) . "\n";
                    }

                    if ($datatution->total_schoolfees) {
                        $lineData = array(
                            'School Fees',
                            esc(number_format($datatution->total_schoolfees, 2))
                        );
                        $excelData .= implode("\t", array_values($lineData)) . "\n";
                    }

                    if ($datatution->total_classfee) {
                        $lineData = array(
                            'Classes Fees',
                            esc(number_format($datatution->total_classfee, 2))
                        );
                        $excelData .= implode("\t", array_values($lineData)) . "\n";
                    }

                    if ($dataexamf->total_examf) {
                        $lineData = array(
                            'Examination Fees',
                            esc(number_format($dataexamf->total_examf, 2))
                        );
                        $excelData .= implode("\t", array_values($lineData)) . "\n";
                    }

                    $lineData = array('','');
                    $excelData .= implode("\t", array_values($lineData)) . "\n";
                    
                    $lineData = array('Expenditure','Amount (GHC)');
                    $excelData .= implode("\t", array_values($lineData)) . "\n";

                    foreach ($dataexp as $row) {
                        $lineData = array(
                            $row->expntype,
                            esc(number_format($row->total_amount, 2))
                        );
                        $excelData .= implode("\t", array_values($lineData)) . "\n";
                    }

                    export_data_to_excel($fields, $excelData, 'Income_Expenditure_Report');
                } else {
                    $excelData .= 'No records found...' . "\n";
                }
            }

            $_SESSION['messsage'] = "Student Data Exported Successfully";
            $_SESSION['status_code'] = "success";
            $_SESSION['status_headen'] = "Good job!";
        }

        $crumbs[] = ['Dashboard', ''];
        $actives = 'expend';
        $hiddenSearch = "nop";
        return $this->view('expenses.reportgenerate', [
            'errors' => $errors,
            'rowpta' => $datapta,
            'rowtution' => $datatution,
            'rowsrev' => $data,
            'rowsexp' => $dataexp,
            'rowsexamf' => $dataexamf,
            'crumbs' => $crumbs,
            'hiddenSearch' => $hiddenSearch,
            'actives' => $actives,
        ]);
    }
}
