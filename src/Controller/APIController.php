<?php

namespace App\Controller;

use App\Service\ClubService;
use App\Service\MembersService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class APIController extends AbstractController
{
    #[Route('/api', name: 'app_a_p_i')]
    public function index(ClubService $clubService): JsonResponse
    {
        $clubInfo = $clubService->getMatchesPlayoff(12437509);
        return $this->json($clubInfo);
    }
}
