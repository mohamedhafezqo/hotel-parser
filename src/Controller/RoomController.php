<?php

namespace App\Controller;

use App\Service\Contract\RoomFacadeInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class RoomController
 *
 * @Rest\Route("/api")
 * @package App\Controller
 */
class RoomController extends AbstractController
{
    /**
     * @Rest\Get("/rooms")
     *
     * @Rest\QueryParam(name="sordByPrice", requirements="ASC|DESC", description="Sort Rooms By Price.")
     * @Rest\QueryParam(name="maxPrice", requirements="\d+", description="Rooms Price Maximum.")
     * @Rest\QueryParam(name="minPrice", requirements="\d+", description="Rooms Price Maximum.")
     * @Rest\QueryParam(name="code", requirements="[a-z]+", description="Filter Room By Code.")
     *
     * @param Request $request
     * @param RoomFacadeInterface $roomFacade
     *
     * @return JsonResponse
     */
    public function index(Request $request, RoomFacadeInterface $roomFacade)
    {
        $results = $roomFacade->findBy($request->query->all());

        return $this->json(['rooms' => $results->getValues()], Response::HTTP_OK, []);
    }
}
