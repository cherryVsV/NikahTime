<?php


namespace App\Virtual\Models;

/**
 *
 * @OA\Schema(
 * required={"firstName", "lastName", "gender", "birthDate", "country", "city", "contactPhoneNumber", "education", "maritalStatus", "haveChildren", "badHabits", "interests"},
 * @OA\Xml(name="User"),
 * @OA\Property(property="firstName", type="string"),
 * @OA\Property(property="lastName", type="string"),
 * @OA\Property(property="gender", type="string", description="Пол может принимать значения: male, female"),
 * @OA\Property(property="photos", type="array", description="Массив ссылок на фотограйии пользователя. Первая ссылка - основное фото пользователя.",
 *     @OA\Items(type="string", format="uri")),
 * @OA\Property(property="birthDate", type="string", format="date-time", example="24-09-2021"),
 * @OA\Property(property="country", type="string"),
 * @OA\Property(property="city", type="string"),
 * @OA\Property(property="contactPhoneNumber", type="string"),
 * @OA\Property(property="education", type="string", description="Уровень образования. Может принимать следущие значения: основное общее / basic general, среднее общее / secondary general, среднее профессиональное / secondary vocational, высшее (бакалавр, специалист) / higher (bachelor, specialist), высшее (магистр) / higher (мaster), учёная степень / academic degree"),
 * @OA\Property(property="placeOfStudy", type="string"),
 * @OA\Property(property="workPosition", type="string"),
 * @OA\Property(property="maritalStatus", type="string", description="Семейное положение может принимать значения: notMarried, married, divorced"),
 * @OA\Property(property="haveChildren", type="boolean"),
 * @OA\Property(property="interests", type="array",
 *     @OA\Items(type="string")),
 * @OA\Property(property="badHabits", type="array",
 *     @OA\Items(type="string", description="Может принимать значения: smoking, alcohol, gambling, other")),
 * @OA\Property(property="about", type="string"),
 * )
 *
 * @var object
 *
 */
class User
{


}
