<?php
/**
 * Created by PhpStorm.
 * User: sepideh
 * Date: 2020-03-07
 * Time: 16:59
 */

namespace App\Validations\Bike;

use App\Validations\RequestValidatorInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

/**
 *
 * Class CreatePoliceValidator
 * @package App\Validations
 *
 * @author Sepideh Monfared <monfared.sepideh@gmail.com>
 */
class CreateBikeValidator implements RequestValidatorInterface
{
    public static function rules(): array
    {
        // TODO: Implement rules() method.
        return [
            'color' => [
                new Length(['max' => 10]),
                new NotBlank(),
            ],
            'license_number' => [
                new Length(['min' => 12]),
                new NotBlank()
            ]
        ];
    }
}