<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Winner extends Model
{
    /**
     * Get the submission record associated with the winner.
     */
    public function submission()
    {
        return $this->belongsTo(Submission::class);
    }
}
