<?php
/**
 * Created by PhpStorm.
 * User: sepideh
 * Date: 2020-03-07
 * Time: 16:59
 */

namespace App\Validations\Police;

use App\Validations\RequestValidatorInterface;
use PHPUnit\Util\Type;
use Symfony\Component\Validator\Constraints\Length;


/**
 *
 * Class CreatePoliceValidator
 * @package App\Validations
 *
 * @author Sepideh Monfared <monfared.sepideh@gmail.com>
 */
class SearchPoliceValidator implements RequestValidatorInterface
{
    public static function rules(): array
    {
        // TODO: Implement rules() method.
        return [
            'nationalCode' => [
                new Length(['min' => 5,'max' => 10]),
                new Type(['type' => 'integer'])
            ],
            'status' => [
                new Choice(['free','busy'])
            ],
        ];
    }
}