<?php
require_once __DIR__.'/Model.php';

class User extends Model
{
    public function fromUser($user)
    {
        $user = json_decode(json_encode($user),true);
        return $this->fill($user);
    }

    public function contacts()
    {
        return $this->hasMany('contact');
    }
}