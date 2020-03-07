<?php

/**
 * Created by PhpStorm.
 * User: sepideh
 * Date: 2020-02-28
 */

$app->map(
    'api/bike/{id}',
    function (\Symfony\Component\HttpFoundation\Request $request,
              array $attributes,
              \Doctrine\ORM\EntityManager $em) {

        $method = strtolower($request->getMethod());

        if(!$attributes['id'] && $method == 'get') {
            $method = 'find';
        }

        $service    = new \App\Service\BikeService($em);
        $controller = new \App\Api\V1\Controller\BikeController($em, $service);

        return call_user_func_array(
            [$controller, $method.'Bike'],
            ['request' => $request,'params'=>$attributes]
        );

    },
    ['id' => 0],
    ['id'=>'\d+'])
;


