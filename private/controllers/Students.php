<?php

/**
 * Students controller
 */
class Students extends Controller
{
    function index()
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        // Setting pagination
        $limit = 20;
        $pager = new Pager($limit);
        $offset = $pager->offset;

        $data = [];
        $errors = array();
        $students = new Student();

        if (count($_POST) > 0 && Auth::access('administrator')) {

            if (isset($_POST['deactive'])) {
                $students->query("UPDATE `students` SET `activenes`='1' WHERE `studentid` =:deactive", $_POST);

                $_SESSION['messsage'] = "Student De-Activated Successfully";
                $_SESSION['status_code'] = "success";
                $_SESSION['status_headen'] = "Good job!";
            } else 
            if (isset($_POST['export'])) {
                $exportdata = $students->findAll();

                if ($exportdata) {
                    $fields = array('Student No#', 'First Name', 'Last Name', 'Gender', 'Date of Birth', 'NHIS', 'Address', 'Nationality', 'Mother Name', 'Mother Phone', 'Father Name', 'Father Phone', 'Emegency Name', 'Emegency Phone', 'Class', 'Status', 'Status', 'Term', 'Academic Year', 'Year Admited');
                    $excelData = implode("\t", array_values($fields)) . "\n";

                    if ($exportdata) {
                        foreach ($exportdata as $row) {
                            $status = $row->activenes == 0 ? 'Active' : 'In-Active';
                            $lineData = array(
                                $row->studentid,
                                $row->first_name,
                                $row->last_name,
                                $row->gender,
                                date('d/m/Y', strtotime($row->date_of_birth)),
                                $row->health_insurance,
                                $row->address,
                                $row->nationality,
                                $row->mother_name,
                                $row->mother_phone,
                                $row->father_name,
                                $row->father_phone,
                                $row->emegency_name,
                                $row->emegency_phone,
                                $row->class->classname,
                                $status,
                                $row->semester->semester,
                                $row->semester->academics->academicyear,
                                $row->semester->academics->year,
                            );
                            $excelData .= implode("\t", array_values($lineData)) . "\n";
                        }
                        export_data_to_excel($fields, $excelData, 'Students_List');
                    } else {
                        $excelData .= 'No records found...' . "\n";
                    }
                }

                $_SESSION['messsage'] = "Student Data Exported Successfully";
                $_SESSION['status_code'] = "success";
                $_SESSION['status_headen'] = "Good job!";
            } else {
                $students->query("UPDATE `students` SET `activenes`='0' WHERE `studentid` =:active", $_POST);

                $_SESSION['messsage'] = "Student Activated Successfully";
                $_SESSION['status_code'] = "success";
                $_SESSION['status_headen'] = "Good job!";
            }
            return $this->redirect("/students");
        }

        if (isset($_GET['search_list'])) {
            $query = "SELECT * FROM `students` WHERE `studentid` LIKE :search_list OR `first_name` LIKE :search_list OR `last_name` LIKE :search_list LIMIT $limit OFFSET $offset";
            $arr = [
                'search_list' => '%' . $_GET['search_list'] . '%',
            ];

            $data = $students->findSearch($query, $arr);
        } else {
            $data = $students->findAll($limit, $offset);
        }

        $crumbs[] = ['Dashboard', ''];
        $actives = 'stude';
        $hiddenSearch = "yeap";
        return $this->view('students', [
            'errors' => $errors,
            'rows' => $data,
            'pager' => $pager,
            'crumbs' => $crumbs,
            'hiddenSearch' => $hiddenSearch,
            'actives' => $actives,
        ]);
    }

    function add()
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }
        $data = [];
        $errors = array();
        $students = new Student();
        $classes = new Classe();

        if (count($_POST) > 0 && Auth::access('headmaster')) {
            if ($students->validate($_POST)) {

                if (count($_FILES) > 0) {
                    $allowed[] = "image/jpeg";
                    $allowed[] = "image/jpg";
                    $allowed[] = "image/png";
                    //Uploading certificate
                    if ($_FILES['image']['error'] == 0 && in_array($_FILES['image']['type'], $allowed)) {
                        $certificateFolder = "public/studentImages/";
                        if (!file_exists($certificateFolder)) {
                            mkdir($certificateFolder, 0777, true);
                        }
                        $certificateFolder = "studentImages/";
                        // Generate a new file name using user ID and "_certificate"
                        $newFileName = random_string(25) . "_pic";

                        // Extract the original file extension
                        $originalExtension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);

                        // Construct the full destination path with the new name and extension
                        $destination = $certificateFolder . $newFileName . "." . $originalExtension;

                        $_POST['image'] = $destination;
                        $destination = "public/" . $destination;
                        // Move uploaded file to the new destination
                        move_uploaded_file($_FILES['image']['tmp_name'], $destination);
                    }
                }

                $_POST['semesterid'] = $_SESSION['semester']->id;
                $students->insert($_POST);

                $_SESSION['messsage'] = "Student Added Successfully";
                $_SESSION['status_code'] = "success";
                $_SESSION['status_headen'] = "Good job!";
                return $this->redirect("/students/add");
            } else {
                $errors = $students->errors;
            }
        }

        $data = $classes->findAll();

        $crumbs[] = ['Dashboard', ''];
        $actives = 'stude';
        $hiddenSearch = "no";
        return $this->view('students.add', [
            'errors' => $errors,
            'rows' => $data,
            'crumbs' => $crumbs,
            'hiddenSearch' => $hiddenSearch,
            'actives' => $actives,
        ]);
    }

    function promotion()
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }
        $data = [];
        $errors = array();
        $students = new Student();
        $classes = new Classe();

        if (count($_POST) > 0 && Auth::access('headmaster')) {
            $query = "UPDATE `students` SET `classid`=:newclass WHERE `classid`=:oldclass AND `activenes` = 0";
            $students->query($query, $_POST);

            $_SESSION['messsage'] = "Student Promoted Successfully";
            $_SESSION['status_code'] = "success";
            $_SESSION['status_headen'] = "Good job!";
            return $this->redirect("/students/promotion");
        }

        $data = $classes->findAll();

        $crumbs[] = ['Dashboard', ''];
        $actives = 'setup';
        $hiddenSearch = "no";
        return $this->view('students.promotion', [
            'errors' => $errors,
            'rows' => $data,
            'crumbs' => $crumbs,
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
        $students = new Student();
        $classes = new Classe();

        if (count($_POST) > 0 && Auth::access('headmaster')) {

            if ($students->validate($_POST)) {

                // unset($_POST['capturedImage']);
                // unset($_POST['capturedImage']);
                if (count($_FILES) > 0) {
                    $allowed[] = "image/jpeg";
                    $allowed[] = "image/jpg";
                    $allowed[] = "image/png";
                    //Uploading certificate
                    if ($_FILES['image']['error'] == 0 && in_array($_FILES['image']['type'], $allowed)) {
                        $certificateFolder = "public/studentImages/";
                        if (!file_exists($certificateFolder)) {
                            mkdir($certificateFolder, 0777, true);
                        }
                        $certificateFolder = "studentImages/";
                        // Generate a new file name using user ID and "_certificate"
                        $newFileName = random_string(25) . "_pic";

                        // Extract the original file extension
                        $originalExtension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);

                        // Construct the full destination path with the new name and extension
                        $destination = $certificateFolder . $newFileName . "." . $originalExtension;

                        $_POST['image'] = $destination;
                        $destination = "public/" . $destination;
                        // Move uploaded file to the new destination
                        move_uploaded_file($_FILES['image']['tmp_name'], $destination);
                    }
                }

                $students->update($id, $_POST);

                $_SESSION['messsage'] = "Student Updated Successfully";
                $_SESSION['status_code'] = "success";
                $_SESSION['status_headen'] = "Good job!";

                return $this->redirect("students");
            } else {
                $errors = $students->errors;
            }
        }

        $data = $students->where('id', $id)[0];
        $rowclass = $classes->findAll();

        $crumbs[] = ['Dashboard', ''];
        $actives = 'stude';
        $hiddenSearch = "no";
        return $this->view('students.edit', [
            'errors' => $errors,
            'row' => $data,
            'rowclass' => $rowclass,
            'crumbs' => $crumbs,
            'hiddenSearch' => $hiddenSearch,
            'actives' => $actives,
        ]);
    }
    
}
