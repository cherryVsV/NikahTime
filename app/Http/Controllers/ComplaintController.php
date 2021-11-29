<?php

namespace App\Http\Controllers;

use App\Models\Complain;
use Illuminate\Http\Request;

class ComplaintController extends Controller
{
    public function makeComplain(Request $request)
    {
        $this->validate($request, [
            'userId' => ['required', 'exists:users,id'],
            'title' => ['required', 'string'],
            'message' => ['required', 'string'],
        ]);
        $auth_id = auth()->user()->getAuthIdentifier();
        Complain::create([
            'user_id' => $auth_id,
            'user_complain_id' => $request->userId,
            'title' => $request->title,
            'message' => $request->message,
        ]);
        return response(null, 200);

    }
}
