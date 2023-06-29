<?php

namespace App\Traits;

trait ReadsSms
{
    public function getMessages(string $path): array
    {
        return $this->readSmsDirectory($path);
    }

    protected function readSmsDirectory(string $path): array
    {
        $data = [];
        if (is_dir($path)) {
            if ($dh = opendir($path)) {
                while (($file = readdir($dh)) !== false) {
                    if ($file != '.' && $file != '..') {
                        $sms = $this->readSms($path . '/' . $file);
                        array_push(
                            $data,
                            [
                                'file' => $file,
                                'mobile' => $sms['mobile'],
                                'message' => $sms['message']
                            ]
                        );
                    }
                }
                closedir($dh);
            }
        }
        return $data;
    }


    protected function readSms(string $filepath): array
    {
        $lines = explode("\n", file_get_contents($filepath));

        $mobile = array_shift($lines);

        return ['mobile' => str_replace('To: ', '', $mobile), 'message' => implode($lines)];
    }
}
