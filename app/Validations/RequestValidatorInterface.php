<?php
/**
 * Created by PhpStorm.
 * User: sepideh
 * Date: 2020-03-07
 * Time: 17:00
 */

namespace App\Validations;

/**
 * Interface RequestValidatorInterface
 * @package App\Validations
 *
 * @author Sepideh Monfared <monfared.sepideh@gmail.com>
 */
interface RequestValidatorInterface
{
    public static function rules() : array;
}