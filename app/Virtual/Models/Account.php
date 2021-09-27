<?php


namespace App\Virtual\Models;

/**
 *
 * @OA\Schema(
 * @OA\Xml(name="Account"),
 * @OA\Property(property="user", ref="#/components/schemas/User"),
 * @OA\Property(property="tokenData", ref="#/components/schemas/TokenData")
 * )
 *
 * @var object
 *
 */
class Account
{

}
