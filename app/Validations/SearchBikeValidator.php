<?php
/**
 * Created by PhpStorm.
 * User: sepideh
 * Date: 2020-03-07
 * Time: 16:59
 */

namespace App\Validations;

use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\Validator\Constraints\Type;

/**
 *
 * Class CreateBikeValidator
 * @package App\Validations
 *
 * @author Sepideh Monfared <monfared.sepideh@gmail.com>
 */
class SearchBikeValidator implements RequestValidatorInterface
{
    public static function rules(): array
    {
        // TODO: Implement rules() method.
        return [
            'licenseNumber' => [
                new Length(['min' => 5])
            ],
            'color' => [
                new Length(['max' => 10]),
            ]
        ];
    }
}