<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $table = "employee";

    protected $fillable = ['first_name','last_name','email','phone','company'];

    public function company_data()
    {
        // code...
        return $this->belongsTo(Company::class,'company','id');
    }

}
