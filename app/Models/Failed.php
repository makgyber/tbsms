<?php

namespace App\Models;

use App\Traits\ReadsSms;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Sushi\Sushi;

class Failed extends Model
{
    use HasFactory, Sushi, ReadsSms;

    public function getRows(): array
    {
        $path = config('smsd.failed');
        return $this->getMessages($path);
    }
}
