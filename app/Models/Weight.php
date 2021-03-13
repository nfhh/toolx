<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class Weight extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public static function findOneBySn($sn)
    {
        return self::where('sn', $sn)->first();
    }

    public function findAllFields()
    {
        return Schema::getColumnListing($this->getTable());
    }
}
