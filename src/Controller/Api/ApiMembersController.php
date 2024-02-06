<?php

namespace App\Controller\Api;

use App\Service\MembersService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class ApiMembersController extends AbstractController
{
    public function __construct(private MembersService $membersService)
    {
    }

    #[Route('members/{clubId}', name: 'app_a_p_i_members')]
    public function getMembers($clubId): JsonResponse
    {
        $members = $this->membersService->getMembersStats($clubId);
        return $this->json($members);
    }

    #[Route('members/career/{clubId}', name: 'app_a_p_i_members_career')]
    public function getMembersCareer($clubId): JsonResponse
    {
        $membersCareer = $this->membersService->getMembersCareer($clubId);
        return $this->json($membersCareer);
    }
}
