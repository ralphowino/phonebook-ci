<?php

require_once __DIR__ . '/Model.php';

class Contact extends Model
{

    protected $fillable = ['first_name', 'last_name', 'email', 'user_id', 'phone', 'notes'];

    protected $perPage = 10;


    public function getNameAttribute($value)
    {
        return trim($this->first_name . ' ' . $this->last_name);
    }

    public function getProfileImageAttribute($value)
    {
        if (!$value) {
            $value = '//www.gravatar.com/avatar/' . md5(strtolower(trim($this->email)));
        }
        return $value;
    }


    public function search($term)
    {
        if ($term) {
            $this->db
                ->group_start()
                ->like('first_name', $term)
                ->or_like('last_name', $term)
                ->or_like('email', $term)
                ->or_like('phone', $term)
                ->or_like('notes', $term)
                ->group_end();
        }

        return $this->query;
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}