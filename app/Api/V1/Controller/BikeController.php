<?php

namespace App\Api\V1\Controller;

use App\Api\ApiController;
use App\Handlers\CustomRequest;
use App\Validations\CreateBikeValidator;
use App\Validations\SearchBikeValidator;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class BikeController
 * @package App\Api\V1\Controller
 */
class BikeController extends ApiController
{

    /**
     * @param CustomRequest $request
     * @param array $params
     * @return Response
     *
     * @author Sepideh Monfared <monfared.sepideh@gmail.com>
     */

    public function getBike(CustomRequest $request, array $params) {

        $id = $params['id'];

        $bike = $this->service->one($id);

        $jsonContent = $this->serialize($bike);

        return  new Response($jsonContent);
    }

    /**
     * @param CustomRequest $request
     * @param array $params
     * @return Response
     *
     * @author Sepideh Monfared <monfared.sepideh@gmail.com>
     */
    public function findBike(CustomRequest $request, array $params)
    {
        $request->validate(new SearchBikeValidator());

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
    public function postBike(CustomRequest $request, array $params) {

        $request->validate(new CreateBikeValidator());

        $request->request->get();
        $this->service->create(
        );

        return  new Response('postBike');
    }



}
