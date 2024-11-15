<?php

namespace App\Controller\Api;

use App\Service\ClubService;
use App\Service\MembersService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class ApiClubController extends AbstractController
{
    public function __construct(private ClubService $clubService,) {}

    #[Route('club/info/{clubId}', name: 'a_p_i_club')]
    public function getInfoClub($clubId): JsonResponse
    {
        $clubInfo = $this->clubService->getClubInfo($clubId);
        $clubsStats = $this->clubService->getStats($clubId);
        $clubInfo['stats'] = $clubsStats;
        $clubInfo['stats']['lastMatchPlayoff'] = $this->clubService->getLastMatchPlayoff($clubId);
        $clubInfo['stats']['lastMatchLeague'] = $this->clubService->getLastMatchLeague($clubId);
        return $this->json($clubInfo);
    }

    #[Route('club/stats/{clubId}', name: 'a_p_i_club_stats')]
    public function getStats($clubId): JsonResponse
    {
        $stats = $this->clubService->getStats($clubId);
        return $this->json($stats);
    }

    #[Route('club/matches/league/{clubId}', name: 'a_p_i_club_matches_league')]
    public function getMatchesLeague($clubId): JsonResponse
    {
        $matches = $this->clubService->getMatchesLeague($clubId);
        return $this->json($matches);
    }

    #[Route('club/matches/playoff/{clubId}', name: 'a_p_i_club_matches_playoff')]
    public function getMatchesCup($clubId): JsonResponse
    {
        $matches = $this->clubService->getMatchesPlayoff($clubId);
        return $this->json($matches);
    }

    #[Route('club/search/{clubName}', name: 'a_p_i_club_search')]
    public function search($clubName): JsonResponse
    {
        $clubs = $this->clubService->search($clubName);
        $clubsData = [];
        foreach ($clubs as $club) {
            // Extraire le nom et le clubId de chaque élément
            $clubId = $club['clubId'];
            $clubName = $club['clubName'];

            // Ajouter le nom et le clubId au tableau des données des clubs
            $clubsData[] = ['clubId' => $clubId, 'clubName' => $clubName];
        }
        return $this->json($clubsData);
    }
}
