<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{

    public function scopeWithWhereHas($query, $relation, $constraint)
    {
        return $query->whereHas($relation, $constraint)
            ->with([$relation => $constraint]);
    }

    protected  $fillable =
    [
        "address", "category", "city", "code", "country_code", "creation_date", "disabled", "email",
        "encoding_characters", "id", "logo", "name", "pbx", "send_email", "settings", "slogan", "state", "telephone",
        "tin", "type", "email_contact", "phone", "short_name", "agreements", "interface_id", "parent_id", "regional_id", "social_reason", "document_type",
        "api_key"
    ];

    public function locations()
    {
        return   $this->hasMany(Location::class);
    }

    public function arl()
    {
        return $this->belongsTo(Arl::class);
    }

    public function bank()
    {
        return $this->belongsTo(Bank::class);
    }

    public function payConfiguration()
    {
        return $this->hasOne(PayConfigurationCompany::class);
    }
    public function Configuration()
    {
        return $this->hasOne(Configuration::class);
    }
}
