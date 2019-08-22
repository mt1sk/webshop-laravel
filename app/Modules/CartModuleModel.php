<?php

namespace App\Modules;

use Illuminate\Database\Eloquent\Model;

abstract class CartModuleModel extends Model
{
    public function getSetting(string $settingField): string
    {
        return $this->settings[$settingField] ?? '';
    }
}