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

/**
 *
 * Class CreateBikeValidator
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
                new Length(['min' => 10]),
                new NotBlank(),
            ],
            'licenseNumber' => []
        ];
    }
}