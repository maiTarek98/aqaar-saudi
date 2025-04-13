<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    // Override the setAttribute method to sanitize all string inputs
    public function setAttribute($key, $value)
    {
        if (is_string($value)) {
            $value = strip_tags($value); // Strip HTML tags from string
        }

        parent::setAttribute($key, $value);
    }
}
