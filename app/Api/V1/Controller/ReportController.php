<?php
/**
 * Created by PhpStorm.
 * User: sepideh
 * Date: 2020-04-02
 * Time: 16:42
 */

namespace App\Api\V1\Controller;


use App\Api\ApiController;
use App\Handlers\CustomRequest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;

class ReportController extends ApiController
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

        $report = $this->service->oneBy(['id' => $id]);

        $jsonContent = $this->serialize(
            $report,
            [AbstractNormalizer::ATTRIBUTES => [
                'id',
                'vehicle' => ['licenseNumber','color'],
                'police'  => ['id','name','status','nationalCode'],
                'status'
            ]]);

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
    public function updateAction(CustomRequest $request, array $params)
    {
        $id = (int)$params['id'];
        $status = $request->query->get('status');

        $report = $this->service->done($id, ['status' => $status]);

        $jsonContent = $this->serialize(
            $report,
            [AbstractNormalizer::ATTRIBUTES => [
                'id',
                'vehicle' => ['licenseNumber','color'],
                'police'  => ['id','name','status','nationalCode'],
                'status'
            ]]);

        return new JsonResponse(
            $jsonContent,
            200
        );
    }
}