<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class Test extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'result' => 'array',
    ];

    public function findAllFields()
    {
        return Schema::getColumnListing($this->getTable());
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
