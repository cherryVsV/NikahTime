<?php

namespace App\Http\Controllers\Voyager;

use App\Models\User;
use Carbon\Carbon;
use TCG\Voyager\Http\Controllers\VoyagerUserController as BaseVoyagerUserController;

class VoyagerUserController extends BaseVoyagerUserController
{
    public function block(){
        $user = User::where('id', \request("id"))->first();
        $user->blocked_at =  $user->blocked_at==null?Carbon::now():null;
        $user->save();
        return redirect(route('voyager.users.index'));
    }

    public function admin(){
        $user = User::where('id', \request("id"))->first();
        if($user->role_id == 2) {
            $user->role_id = 1;
        }else{
            $user->role_id = 2;
        }
        $user->save();
        return redirect(route('voyager.users.index'));
    }

}
