<?php


namespace App\Virtual\Models;

/**
 *
 * @OA\Schema(
 * @OA\Xml(name="TokenData"),
 * @OA\Property(property="accessToken", type="string"),
 * @OA\Property(property="expiresIn", type="integer", format="int64"),
 * @OA\Property(property="refreshToken", type="string"),
 * )
 *
 * @var object
 *
 */
class TokenData
{
}
