<?php

/**
 * Created by PhpStorm.
 * User: sepideh
 * Date: 2020-02-28
 */

$app->map(
    'api/{entity}/{id}',
    function (\Symfony\Component\HttpFoundation\Request $request,
              array $attributes,
              \Doctrine\ORM\EntityManager $em) {

        $method = strtolower($request->getMethod());

        if(!$attributes['id'] && $method == 'get') {
            $method = 'find';
        }
        if($method == 'put') {
            $method = 'update';
        }

        $entityName = ucfirst($attributes["entity"]);
        $serviceName = '\App\Service\\'.$entityName.'Service';
        $controllerName = '\App\Api\V1\Controller\\'.$entityName.'Controller';

        $service    = new $serviceName($em);
        $controller = new $controllerName($em, $service);

        return call_user_func_array(
            [$controller, $method.'Action'],
            ['request' => $request,'params'=>$attributes]
        );

    },
    ['id' => 0],
    ['id'=>'\d+']
);



