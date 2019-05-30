<?php

namespace App;

use App\Traits\ModelImage;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Manager extends Authenticatable
{
    use ModelImage;

    protected $perPage = 20;

    protected function originalDir()
    {
        return 'images/managers';
    }

    protected function fieldName()
    {
        return 'photo';
    }

    protected function getId()
    {
        return $this->id;
    }
}
