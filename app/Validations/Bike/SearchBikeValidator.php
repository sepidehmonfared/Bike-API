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


/**
 *
 * Class CreatePoliceValidator
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