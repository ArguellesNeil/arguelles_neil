<?php 
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class StudentsController extends Controller 
{
    public function __construct() 
    {
        parent::__construct();
        $this->call->model('StudentsModel');
        $this->call->library('pagination');

        
        $this->pagination->set_theme('custom');
        $this->pagination->set_custom_classes([
            'nav'    => 'pagination-nav',
            'ul'     => 'pagination-list',
            'li'     => 'pagination-item',
            'a'      => 'pagination-link',
            'active' => 'active'
        ]);
    }

    
    private function paginate_students($page = 1, $per_page = 10, $search = null) 
    {
        $allowed_per_page = [10, 25, 50, 100];
        if (!in_array($per_page, $allowed_per_page)) {
            $per_page = 10;
        }

        
      $search = isset($_GET['search']) ? trim($_GET['search']) : null;


      $show_deleted = (isset($_GET['show']) && $_GET['show'] === 'deleted');


        // Count with search filter
        $total_rows = $this->StudentsModel->count_all_records($search);

        // Init pagination
        $pagination_data = $this->pagination->initialize(
            $total_rows['total'],          // Total records
            $per_page,            // Records per page
            $page,                // Current page
            'students/get_all',   // Base route for links
            5                     // Number of page links to show
        );

        // Fetch records with pagination + search
        $records = $this->StudentsModel->get_records_with_pagination(
            $pagination_data['limit'],
            $search
        );

        $data['records'] = $records;
        $data['total_record'] = $total_rows;
        $data['pagination_data'] = $pagination_data;
        $data['pagination_links'] = $this->pagination->paginate();
        $data['search'] = $search;
        return $data;
        
        
    }

    /**
     * List students with pagination + search
     */
    public function get_all($page = 1) 
    {
        $per_page = isset($_GET['per_page']) ? (int) $_GET['per_page'] : 10;
        $search   = isset($_GET['search']) ? trim($_GET['search']) : null;

        $data = $this->paginate_students($page, $per_page, $search);

        $this->call->view('students/get_all', $data);
    }

    /**
     * Add new student
     */
    public function add() 
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'lname' => $_POST['lname'],
                'fname' => $_POST['fname'],
                'email' => $_POST['email']
            ];
            $this->StudentsModel->insert($data);
            redirect('students/get_all');
        }

        $this->call->view('students/add');
    }

    /**
     * Update student
     */
    public function update($id) 
    {
        $student = $this->StudentsModel->find($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'lname' => $_POST['lname'],
                'fname' => $_POST['fname'],
                'email' => $_POST['email']
            ];
            $this->StudentsModel->update($id, $data);
            redirect('students/get_all');
        }

        $this->call->view('students/update', ['student' => $student]);
    }

    /**
     * Soft delete student
     */
    public function delete($id) 
    {
        $this->StudentsModel->soft_delete($id);
        redirect('students/get_all');
    }
}
