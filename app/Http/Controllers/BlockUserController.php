<?php

namespace App\Http\Controllers;

use App\Exceptions\ProjectExceptions\ValidationDataError;
use App\Models\Chat;
use App\Models\Like;
use App\Models\User;
use App\Models\UserBlock;
use Exception;


class BlockUserController extends Controller
{
    public function blockUserById($userId)
    {
        if(!User::where('id', $userId)->exists() || !is_null(User::where('id', $userId)->value('blocked_at'))){
            throw new ValidationDataError('ERR_USER_NOT_FOUND', 422, 'Selected user do not exists or is blocked');
        }
        $auth_id = auth()->user()->getAuthIdentifier();
        if(UserBlock::where(['user_id'=>$auth_id, 'block_user_id'=>$userId])->exists()) {
            throw new ValidationDataError('ERR_USER_ALREADY_BLOCKED', 422, 'Selected user is already blocked by auth user');
        }
        UserBlock::create([
            'user_id'=>$auth_id,
            'block_user_id'=>$userId
        ]);
        try {
            if (Like::where(['user_id' => $auth_id, 'favourite_user_id' => $userId])->exists()) {
                Like::where(['user_id' => $auth_id, 'favourite_user_id' => $userId])->delete();
            }
            $chat = Chat::where(['user1_id' => $auth_id, 'user2_id' => $userId])->first();
            if (is_null($chat)) {
                $chat = Chat::where(['user2_id' => $auth_id, 'user1_id' => $userId])->first();
            }
            if (!is_null($chat)) {
                if($chat->is_blocked == false) {
                    $chat->user_block = $auth_id;
                    $chat->is_blocked = true;
                    $chat->save();
                }
            }
            return response(null, 200);
        } catch (Exception $e) {
            return response()->json([
                'code' => $e->getCode(),
                'title' => 'ERR_BLOCK_USER_FAILED',
                'details' => $e->getMessage()],
                422);
        }
    }

    public function unblockUserById($userId)
    {
        if(!User::where('id', $userId)->exists() || !is_null(User::where('id', $userId)->value('blocked_at'))){
            throw new ValidationDataError('ERR_USER_NOT_FOUND', 422, 'Selected user do not exists or is blocked');
        }
        $auth_id = auth()->user()->getAuthIdentifier();
        if(!UserBlock::where(['user_id'=>$auth_id, 'block_user_id'=>$userId])->exists()){
            throw new ValidationDataError('ERR_USER_NOT_BLOCK', 422, 'Selected user is not blocked by auth user');
        }
        UserBlock::where(['user_id'=>$auth_id, 'block_user_id'=>$userId])->delete();
        $chat = Chat::where(['user1_id' => $auth_id, 'user2_id' => $userId])->first();
        if (is_null($chat)) {
            $chat = Chat::where(['user2_id' => $auth_id, 'user1_id' => $userId])->first();
        }
        if (!is_null($chat)) {
            if($chat->user_block == $auth_id) {
                $chat->user_block = null;
                $chat->is_blocked = false;
                $chat->save();
            }
        }
        return response(null, 200);

    }
}
