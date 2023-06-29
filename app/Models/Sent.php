<?php

namespace App\Models;

use App\Traits\ReadsSms;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Sushi\Sushi;

class Sent extends Model
{
    use HasFactory, Sushi, ReadsSms;

    public function getRows(): array
    {
        $path = config('smsd.sent');
        return $this->getMessages($path);
    }
}
