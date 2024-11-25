<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    use HasFactory;

    protected $fillable = [
        'partner_name',
        'partner_firstname',
        'partner_contribution',
        'partner_signature',
        'partner_email',
    ];

    public function contract()
    {
        return $this->belongsToMany(Contract::class, 'contract_partner')->withPivot('partner_contribution', 'partner_signature');
    }
}
