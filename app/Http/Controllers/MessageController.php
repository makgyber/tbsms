<?php

namespace App\Http\Controllers;

use App\Traits\WritesSms;

class MessageController extends Controller
{
    use WritesSms;

    public function create()
    {
        $messages = request('messages');
        $ctr = 0;
        $data = [];

        foreach ($messages as $message) {
            array_push($data, $this->writeToFile([
                'file' => 'gsm-' . now()->format("YmdHis") . '-' . $ctr++,
                'to' => $message['to'],
                'message' => $message['message']
            ]));
        }

        return $data;
    }
}
