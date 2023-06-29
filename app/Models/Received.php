<?php

namespace App\Models;

use App\Traits\ReadsSms;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Sushi\Sushi;

class Received extends Model
{
    use HasFactory, Sushi, ReadsSms;

    public function getRows(): array
    {
        $path = config('smsd.received');
        return $this->getMessages($path);
    }
}
