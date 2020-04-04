<?php

namespace App\Api\V1\Controller;


use App\Api\ApiController;
use App\Handlers\CustomRequest;
use App\Validations\Police\CreatePoliceValidator;
use App\Validations\Police\SearchPoliceValidator;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class BikeController
 * @package App\Api\V1\Controller
 */
class PoliceController extends ApiController
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
        $request->validate(new SearchPoliceValidator());

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

        $police = $this->service->create(
            $input_data['national_code'],
            $input_data['status']
        );

        $jsonContent = $this->serialize($police);

        return  new JsonResponse(
            $jsonContent,
            200
        );
    }


    /**
     * @param CustomRequest $request
     * @param array $params
     * @return JsonResponse
     *
     * @author Sepideh Monfared <monfared.sepideh@gmail.com>
     */
    public function deleteAction(CustomRequest $request, array $params) {

        $id   = $params['id'];

        $data = $this->service->delete($id);

        return new JsonResponse(
            $data,
            200
        );
    }

}
