<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IssueAssignDeveloper extends Model
{
    use HasFactory;

    public function developer(){
        return $this->belongsTo(Developer::class);
    }
}
