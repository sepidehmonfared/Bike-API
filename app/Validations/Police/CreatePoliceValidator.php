<?php
/**
 * Created by PhpStorm.
 * User: sepideh
 * Date: 2020-03-07
 * Time: 16:59
 */

namespace App\Validations\Police;

use App\Validations\RequestValidatorInterface;
use Symfony\Component\Validator\Constraints\Choice;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Type;

/**
 *
 * Class CreatePoliceValidator
 * @package App\Validations
 *
 * @author Sepideh Monfared <monfared.sepideh@gmail.com>
 */
class CreatePoliceValidator implements RequestValidatorInterface
{
    public static function rules(): array
    {
        // TODO: Implement rules() method.
        return [
            'status' => [
                new Choice(['free','busy'])
            ],
            'national_code' => [
                new NotBlank(),
                new Length(['min' => 5,'max' => 10]),
                new Type(['type' => 'integer'])
            ]
        ];
    }
}