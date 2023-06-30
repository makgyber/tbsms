<?php

namespace App\Traits;

trait WritesSms
{
    public function writeToFile(array $info): array
    {
        $path = config('smsd.received') . '/';

        $fp = fopen($path . $info['file'], 'w');

        fwrite($fp, "To: {$info['to']}\n\n{$info['message']}\n");
        fclose($fp);
        return $info;
    }
}
