<?php

namespace Sukohi\LaravelJpPostalCode\App;

use Illuminate\Database\Eloquent\Model;

class JpPostalCode extends Model
{
    public $timestamps = false;
    protected $guarded = ['id'];
    protected $appends = ['full_address', 'full_code'];

    // Scope
    public function scopeWhereSearch($query, $first_code, $last_code) {

        $query->where('first_code', intval($first_code))
            ->where('last_code', intval($last_code));

    }

    // Accessor
    public function getFirstCodeAttribute($value) {

        return str_pad($value, 3, '0', STR_PAD_LEFT);

    }

    public function getLastCodeAttribute($value) {

        return str_pad($value, 4, '0', STR_PAD_LEFT);

    }

    public function getFullAddressAttribute($value) {

        $targets = [
            '{first_code}',
            '{last_code}',
            '{prefecture}',
            '{city}',
            '{address}'
        ];
        $replacements = [
            $this->first_code,
            $this->last_code,
            $this->prefecture,
            $this->city,
            $this->address
        ];
        $format = config('jp_postal_code.address_format');
        return str_replace($targets, $replacements, $format);

    }

    public function getFullCodeAttribute($value) {

        $targets = ['{first_code}', '{last_code}'];
        $replacements = [$this->first_code, $this->last_code];
        $format = config('jp_postal_code.postal_code_format');
        return str_replace($targets, $replacements, $format);

    }
}
