<?php

namespace App\Api\V1\Controller;


use App\Api\ApiController;
use App\Handlers\CustomRequest;
use App\Validations\CreateBikeValidator;
use App\Validations\Police\CreatePoliceValidator;
use App\Validations\SearchBikeValidator;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class BikeController
 * @package App\Api\V1\Controller
 */
class BikeController extends ApiController
{

    /**
     * @param CustomRequest $request
     * @param array $params
     * @return JsonResponse
     * @throws \Symfony\Component\Serializer\Exception\ExceptionInterface
     *
     * @author Sepideh Monfared <monfared.sepideh@gmail.com>
     */
    public function getAction(CustomRequest $request, array $params) {

        $id = $params['id'];

        $bike = $this->service->oneBy(['id' => $id]);

        $jsonContent = $this->serialize($bike);

        return  new JsonResponse(
            $jsonContent,
            200
        );
    }


    /**
     * @param CustomRequest $request
     * @param array $params
     * @return JsonResponse
     * @throws \Symfony\Component\Serializer\Exception\ExceptionInterface
     *
     * @author Sepideh Monfared <monfared.sepideh@gmail.com>
     */
    public function findAction(CustomRequest $request, array $params)
    {
        $request->validate(new SearchBikeValidator());

        $input_data = $request->query->all();

        $data = $this->service->search($input_data);

        $jsonContent = $this->serialize($data);

        return  new JsonResponse(
            $jsonContent,
            200
        );
    }


    /**
     * @param CustomRequest $request
     * @param array $params
     * @return JsonResponse
     * @throws \Symfony\Component\Serializer\Exception\ExceptionInterface
     *
     * @author Sepideh Monfared <monfared.sepideh@gmail.com>
     */
    public function postAction(CustomRequest $request, array $params) {

        $request->validate(new CreatePoliceValidator());

        $input_data = $request->request->all();

        $bike = $this->service->create(
            $input_data['license_number'],
            $input_data['color']
        );

        $jsonContent = $this->serialize($bike);

        return  new JsonResponse(
            $jsonContent,
            200
        );
    }

}
