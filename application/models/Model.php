<?php

require_once __DIR__ . '/Builder.php';

class Model extends CI_Model
{
    protected $attributes = [];

    protected $per_page = 10;

    protected $query;

    public function hasMany($model)
    {
        $this->load->model($model);
        return $this->{$model}->newQuery()->where(strtolower(get_class($this)) . '_id', $this->id);
    }

    public function fill($attributes)
    {
        foreach ($attributes as $attribute => $value) {
            $this->attributes[$attribute] = $value;
        }
        return $this;
    }

    public function update($fields)
    {
        $this->fill($fields);
        $this->save();
    }

    public function save()
    {
        $this->attributes['updated_at'] = date('Y-m-d H:i:s');
        $this->db->set($this->attributes);
        if (isset($this->id)) {

            return $this->db->where('id', $this->id)
                ->update($this->getTable());
        }

        $this->attributes['created_at'] = $this->attributes['updated_at'];
        $this->db->set('created_at', $this->attributes['updated_at']);

        $this->db->insert($this->getTable());
        $this->attributes['id'] = $this->db->insert_id();
        return $this;
    }

    public function newQuery()
    {
        $this->query = new Builder($this);
        return $this->query;
    }

    public function __get($key)
    {
        if (property_exists($this, $key)) {
            return $this->{$key};
        }

        $value = array_key_exists($key, $this->attributes) ? $this->attributes[$key] : null;

        $method = 'get' . ucfirst(camelize($key)) . 'Attribute';
        if (method_exists($this, $method)) {
            return call_user_func([$this, $method], $value);
        }

        if ($value) {
            return $value;
        }

        return parent::__get($key);
    }

    /**
     * @return string
     */
    public function getTable()
    {
        return plural(strtolower(get_class($this)));
    }
}