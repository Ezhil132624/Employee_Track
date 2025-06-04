<?php

/** 
 * @property CI_Employee_model $Employee_model
 * @property CI_Session $session
 * @property CI_Input $input
 **/


class Employee extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Employee_model');
        $this->load->library('session');
        $this->load->helper('url');
    }

    public function index()
    {
        $filter = [
            'department' => $this->input->get('department'),
            'salary_min' => $this->input->get('salary_min'),
            'salary_max' => $this->input->get('salary_max')
        ];

        $data['employees'] = $this->Employee_model->filter_employees($filter);
        $this->load->view('employee_view', $data);
    }

    public function add()
    {
        $input = $this->input->post();
        $data = [
            'name' => $input['name'],
            'email' => $input['email'],
            'phone' => $input['phone'],
            'department' => $input['department'],
            'salary' => $input['salary']
        ];

        if ($this->Employee_model->add_employee($data)) {
            $this->session->set_flashdata('msg', 'Employee added successfully!');
        } else {
            $this->session->set_flashdata('msg', 'Failed to add employee.');
        }
        redirect('employee');
    }
}
