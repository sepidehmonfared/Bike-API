<?php

namespace App\Api\V1\Controller;


use App\Api\ApiController;
use App\Handlers\CustomRequest;
use App\Validations\Police\CreatePoliceValidator;
use App\Validations\Police\SearchPoliceValidator;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class BikeController
 * @package App\Api\V1\Controller
 */
class PoliceController extends ApiController
{

    /**
     * @param CustomRequest $request
     * @param array $params
     * @return Response
     *
     * @author Sepideh Monfared <monfared.sepideh@gmail.com>
     */

    public function getPolice(CustomRequest $request, array $params) {

        $id = $params['id'];

        $bike = $this->service->oneBy(['id' => $id]);

        $jsonContent = $this->serialize($bike);

        return  new Response(
            $jsonContent,
            200,
            ['Content-Type' => 'application/json']
        );
    }


    /**
     * @param CustomRequest $request
     * @param array $params
     * @return Response
     *
     * @author Sepideh Monfared <monfared.sepideh@gmail.com>
     */
    public function findPolice(CustomRequest $request, array $params)
    {
        $request->validate(new SearchPoliceValidator());

        $input_data = $request->query->all();

        $data = $this->service->search($input_data);

        $jsonContent = $this->serialize($data);

        return  new Response(
            $jsonContent,
            200,
            ['Content-Type' => 'application/json']
        );
    }


    /**
     * @param CustomRequest $request
     * @param array $params
     * @return Response
     *
     * @author Sepideh Monfared <monfared.sepideh@gmail.com>
     */
    public function postPolice(CustomRequest $request, array $params) {

        $request->validate(new CreatePoliceValidator());

        $input_data = $request->request->all();

        $police = $this->service->create(
            $input_data['national_code'],
            $input_data['status']
        );

        $jsonContent = $this->serialize($police);

        return  new Response(
            $jsonContent,
            200,
            ['Content-Type' => 'application/json']
        );
    }


    /**
     * @param CustomRequest $request
     * @param array $params
     * @return Response
     *
     * @author Sepideh Monfared <monfared.sepideh@gmail.com>
     */
    public function deletePolice(CustomRequest $request, array $params) {

        $id   = $params['id'];

        $data = $this->service->delete($id);

        return new Response(
            $data,
            200,
            ['Content-Type' => 'application/json']
        );
    }

}
