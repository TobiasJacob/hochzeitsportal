<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function getDetailPhotosPath()
    {
        $photoPaths = unserialize($this->detailPhotosPath);

        if (!is_array($photoPaths) or $photoPaths === NULL) {
            $photoPaths = array();
        }

        return $photoPaths;
    }
}
