<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use HasFactory;

    protected $fillable = [
        'contract_nature',
        'contract_name',
        'contract_adress',
        'contract_date',
        'contract_repartition',
        'contract_min_sign',
        'contract_clause_duration',
        'contract_state',
        'contract_location',
        'contract_avocate_name',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function partners()
    {
        return $this->hasMany(Partner::class);
    }
}
