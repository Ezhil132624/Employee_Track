<?php
class Employee_model extends CI_Model
{

    private $redis_key = 'employees_data';

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('myredis');
    }

    public function add_employee($data)
    {
        // $final = [];
        // if($data['name']){
        //     $final['name'] = $data['name']; 
        // }
        // if($data['department']){
        //     $final['department'] = $data['department']??'IT'; 
        // }
        $this->db->insert('employees', $data);
        if ($this->db->affected_rows() > 0) {
            $this->update_cache();
            return true;
        }
        return false;
    }

    public function get_employees()
    {
        $cache = $this->myredis->get($this->redis_key);
        if ($cache) {
            return json_decode($cache, true);
        }
        return $this->update_cache();
    }

    private function update_cache()
    {
        $data = $this->db->get('employees')->result_array();
        $this->myredis->set($this->redis_key, json_encode($data), 60);
        return $data;
    }

    public function filter_employees($filter)
    {
        $employees = $this->get_employees();
        $result = [];

        foreach ($employees as $emp) {
            if (!empty($filter['department']) && $emp['department'] !== $filter['department']) continue;
            if (!empty($filter['salary_min']) && $emp['salary'] < $filter['salary_min']) continue;
            if (!empty($filter['salary_max']) && $emp['salary'] > $filter['salary_max']) continue;
            $result[] = $emp;
        }

        return $result;
    }
}
