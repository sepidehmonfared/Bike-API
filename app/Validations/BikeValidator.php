<?php
/**
 * Created by PhpStorm.
 * User: sepideh
 * Date: 2020-03-07
 * Time: 16:59
 */

namespace App\Validations;

/**
 *
 * Class BikeValidator
 * @package App\Validations
 *
 * @author Sepideh Monfared <monfared.sepideh@gmail.com>
 */
class BikeValidator implements RequestValidatorInterface
{
    public static function rules(): array
    {
        // TODO: Implement rules() method.
        return [
            'color' => '',
            'licenseNumber' => ''
        ];
    }
}