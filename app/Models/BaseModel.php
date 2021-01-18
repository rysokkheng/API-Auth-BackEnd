<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Concerns\HasTimestamps;
use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    use HasTimestamps;

    const RECORD_STATUS_FIELD   = 'record_status_id';
    const RECORD_STATUS_ACTIVE  = 1;
    const RECORD_STATUS_DELETE  = 0;

    const CREATED_AT_FIELD      = 'created_at';
    const CREATED_BY_FIELD      = 'created_by';
    const UPDATED_AT_FIELD      = 'updated_at';
    const UPDATED_BY_FIELD      = 'updated_by';


}
