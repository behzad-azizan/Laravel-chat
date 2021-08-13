<?php
namespace App\Models;

use App\Traits\FormattedTimestamps;
use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    use FormattedTimestamps;
}
