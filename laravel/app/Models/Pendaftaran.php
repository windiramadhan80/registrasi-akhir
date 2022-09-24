<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function scopeFilter($query, array $filters)
    {
        if (isset($filters['search']) ? $filters['search'] : false) {
            $query->where('name', 'like', '%' . $filters['search'] . '%')
                ->orWhere('program_studi', 'like', '%' . $filters['search'] . '%');
        }
    }
}
