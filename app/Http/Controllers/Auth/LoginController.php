<?php

namespace App\Http\Controllers\Auth;

use App\Exceptions\ProjectExceptions\PasswordIncorrectError;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Services\GenerateAccessTokenService;
use App\Http\Resources\ProfileResource;
use App\Models\Profile;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Exception;

class LoginController extends Controller
{
    /**
     * @OA\Post(
     * path="/api/login",
     * summary="Вход пользователя",
     * operationId="login",
     * tags={"Login"},
     * @OA\RequestBody(
     *    required=true,
     *    description="Данные для авторизации",
     *    @OA\JsonContent(
     *       required={"grantType"},
     *       @OA\Property(property="email", type="string", format="email", example="test@gmail.com"),
     *       @OA\Property(property="phone", type="string", example="+74951239999"),
     *       @OA\Property(property="idToken", type="string", example="eyJhbGciOiJSUzI1NiIsImtpZCI6IjFiZjhhODRkM2VjZDc3ZTlmMmFkNWYwNmZmZDI2MDcwMWRkMDZkOTAiLCJ0eXAiOiJKV1QifQ.eyJpc3MiOiJodHRwczovL2FjY291bnRzLmdvb2dsZS5jb20iLCJhenAiOiIzMjExNzk3NzU4MDctZWpmY2UzZDU5aWUwN2hnc2VnMzB2NWE3OGg4dGlrMTcuYXBwcy5nb29nbGV1c2VyY29udGVudC5jb20iLCJhdWQiOiIzMjExNzk3NzU4MDctaXYyaTVvZXEwZjRkanRlYmplNGZmbW5obXBmZmpzOWUuYXBwcy5nb29nbGV1c2VyY29udGVudC5jb20iLCJzdWIiOiIxMTEwNTk2ODk5NTc3MDgwNDg1MjMiLCJlbWFpbCI6ImRlaWdoZDA4QGdtYWlsLmNvbSIsImVtYWlsX3ZlcmlmaWVkIjp0cnVlLCJuYW1lIjoi0JTQvNC40YLRgNC40Lkg0JfQsNC50YbQtdCyIiwicGljdHVyZSI6Imh0dHBzOi8vbGgzLmdvb2dsZXVzZXJjb250ZW50LmNvbS9hL0FBVFhBSnhKcXNJaWVmYXdpZHFKQ3N1Sl9kSy1Pa2RZWTFPa3VybTFWNy1hPXM5Ni1jIiwiZ2l2ZW5fbmFtZSI6ItCU0LzQuNGC0YDQuNC5IiwiZmFtaWx5X25hbWUiOiLQl9Cw0LnRhtC10LIiLCJsb2NhbGUiOiJydSIsImlhdCI6MTYyNTY2Nzk5NCwiZXhwIjoxNjI1NjcxNTk0fQ.gbb5A30-Oqiu_o5bKrov4Sjm5I-7p0VCFxqMWaPfV-5wHBCVs3PR70pOxfLeyqqJHZkauE_KheKWxgOMo6CN4VhjPeOYWzmVH88fVB1ZWThfCkTD06rxWKsfY8I0__kNocP3K-iT5Az908lMtEfl9QQOJfCvgezxi-TKlBRP8R44s9s9bsMMvli08g_J2YEb5jZm6OH2W7KFTeoLzM3okcDEfnX5m--Qx52x6R9LqBPxD0AvzdenZwchQ3yNzpfLxG2tXpN8wehGijlJ-tG4vxSyC8IKy7x09k5whGWMTx_ssIDLQlnAjW91JibhKvgSZnWvyNmFnWey_D6gdSF8ig"),
     *       @OA\Property(property="password", type="string", format="password", example="PassWord12345"),
     *       @OA\Property(property="grantType", type="string", example="email"),
     *    ),
     * ),
     * @OA\Response(
     *     response=200,
     *     description="Данные аккаунта",
     *     @OA\JsonContent(
     *        @OA\Property(property="Account", type="object", ref="#/components/schemas/Account"),
     *     )
     *  ),
     * @OA\Response(
     *    response=422,
     *    description="unexpected error",
     *    @OA\JsonContent(
     *      @OA\Property(property="Error", type="object", ref="#/components/schemas/Error"),
     *        )
     *     )
     * )
     */
    public function login(Request $request)
    {
        $checkUserData = new CheckUserDataController();
        $user = $checkUserData->checkUserData($request);
        if ($request->grantType == 'email' || $request->grantType == 'phone') {
            if (!Hash::check($request->password, $user->password)) {
                throw new PasswordIncorrectError();
            }
        }
        $generateToken = new GenerateAccessTokenService();
        $token = $generateToken->generateToken($request, $user);
        $profile = Profile::where('user_id', $user->id)->first();
        return response()->json([
            'Account' => [
                'user'=> new ProfileResource($profile),
                'tokenData' =>$token
            ]
        ], 200);

    }

    public function logOut()
    {
        try {
            $accessToken = auth()->user()->token();

            $refreshToken = DB::table('oauth_refresh_tokens')
                ->where('access_token_id', $accessToken->id)
                ->update([
                    'revoked' => true
                ]);

            $accessToken->revoke();

            return response()->json(['code' => 200], 200);
        } catch (Exception $e) {
            return response()->json(['error' =>
                ['code' => 404,
                    'title' => 'error',
                    'details' => $e]],
                404);
        }
    }
}
