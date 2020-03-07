<?php

namespace App\Api\V1\Controller;

use App\Api\ApiController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class BikeController
 * @package App\Api\V1\Controller
 */
class BikeController extends ApiController
{

    /**
     * @param Request $request
     * @param array $params
     * @return Response
     *
     * @author Sepideh Monfared <monfared.sepideh@gmail.com>
     */
    public function getBike(Request $request, array $params) {

        $id = $params['id'];

        $bike = $this->service->one($id);

        $jsonContent = $this->serialize($bike);

        return  new Response($jsonContent);
    }

    public function postBike(Request $request, array $params) {


        return  new Response('postBike ');

    }

    public function findBike(Request $request, array $params)
    {
        $this->service->search();
        return  new Response('findBike ');
    }


}
