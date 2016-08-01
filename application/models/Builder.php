<?php

class Builder
{
    protected $model;

    public function __construct($model)
    {
        $this->model = $model;
        $this->ci =& get_instance();
    }

    public function __call($name, $arguments)
    {
        if (method_exists($this->model, $name)) {
            return call_user_func_array([$this->model, $name], $arguments);
        }

        if (method_exists($this->ci->db, $name)) {
            call_user_func_array([$this->ci->db, $name], $arguments);
            return $this;
        }
    }

    public function findOrFail($key)
    {
        return $this->ci->db->where('id', $key)->get($this->getTable())->row(0, get_class($this->model));
    }

    public function paginate($per_page = null)
    {
        $per_page = $per_page ?: $this->model->per_page;
        $page = $this->ci->input->get('page');
        $page = $page ?: 1;
        $table = $this->getTable();
        $class = get_class($this->model);

        $this->ci->db
            ->limit($per_page, $per_page * ($page - 1));

        $total = $this->ci->db->count_all_results($table, false);

        $data = $this->ci->db->get()->result($class);


        $pagination = $this->ci->pagination->initialize([
            'base_url' => site_url('contacts'),
            'per_page' => $per_page,
            'total_rows' => $total,
            'cur_page' => $page,
            'use_page_numbers' => true,
            'reuse_query_string' => true,
            'page_query_string' => true,
            'query_string_segment' => 'page'
        ]);
        return [
            'data' => $data,
            'meta' => [
                'count' => count($data),
                'total' => $total,
                'pages' => ceil($table / count($data)),
                'page' => $page,
                'links' => $pagination->create_links()
            ]
        ];
    }

    public function get()
    {
        $results = [];
        $table = $this->getTable();
        $class = get_class($this->model);

        foreach ($this->ci->db->get($table)->result($class) as $row) {
            $results[] = $row;
        }
        return $results;
    }

    public function create($fields)
    {
        $this->model->fill($fields);
        $this->model->save();
        return $this->model;
    }


}