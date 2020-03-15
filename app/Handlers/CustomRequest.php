<?php
/**
 * Created by PhpStorm.
 * User: sepideh
 * Date: 2020-03-12
 * Time: 20:12
 */

namespace App\Handlers;


use App\Validations\RequestValidatorInterface;
use Symfony\Component\Validator\Validation;

/**
 * Class CustomRequest
 * @package App\Handlers
 *
 * @author Sepideh Monfared <monfared.sepideh@gmail.com>
 */
class CustomRequest extends \Symfony\Component\HttpFoundation\Request
{

    /**
     * @param RequestValidatorInterface $requestRules
     *
     * @author Sepideh Monfared <monfared.sepideh@gmail.com>
     */
    public function validate(RequestValidatorInterface $requestRules) {

        $rules     = $requestRules::rules();
        $method    = strtolower($this->getMethod());
        $validator = Validation::createValidator();

        $request_params = [];

        if ($method == 'get') {
            $request_params = $this->query->all();
        } elseif ($method == 'post') {
            $request_params = $this->request->all();

        }

        foreach ($rules as $param => $options) {

            $value      = ($request_params[$param]) ?? null;
            $violations = $validator->validate($value, $options);

            if ( 0 !== count($violations) ) {
                // there are errors, now you can show them
                foreach ($violations as $violation) {
                    //TODO generate exception error
                    echo $param.' error: '.$violation->getMessage().'</br>';
                }
            }
        }


    }

}