<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    /**
     * メーカー一覧取得
     */
    public static function getCompanyList()
    {
        return self::all();
    }
}