<?php

namespace App\Controller\Api;

use Gemini;
use Gemini\Data\Content;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class APIGeminiController extends AbstractController
{
    #[Route('/gemini', name: 'api_gemini')]
    public function index(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $player = $data['player'];
        if (!$player || !is_array($player)) {
            return $this->json(['result' => json_encode($player)]);
        }
        // eviter array to string conversion
        $chat = Gemini::client(
            $this->getParameter('gemini_api_key'),
        )->chat()->startChat(
            history: [
                Content::parse('Tu vas répondre en français, tu seras le coach de mon club de foot et tu vas me donner des conseils pour améliorer mon équipe.'),
                Content::parse('Ton nom en tant que coach sera Mokhtar.'),
            ]
        );

        $chat->sendMessage('Il faut que répondes en comme un vrai coach de foot, en donnant des conseils pour améliorer le joueur.');
        $chat->sendMessage('tu dois tutoyer le joueur et lui donner des conseils pour qu\'il s\'améliore.');
        $chat->sendMessage('dont je vais te donner les statistiques.');
        $response = $chat->sendMessage('Donne uniquement en une phrase un conseil pour améliorer le joueur, player: ' . $player['name'] . 'poste: ' . $player["favoritePosition"] . ', ratingAve: ' . $player['ratingAve'] . ', gamesPlayed: ' . $player['gamesPlayed'] . ', winRate: ' . $player['winRate'] . ', goals: ' . $player['goals'] . ', assists: ' . $player['assists'] . ', passesMade: ' . $player['passesMade'] . ', passSuccessRate: ' . $player['passSuccessRate'] . ', tacklesMade: ' . $player['tacklesMade'] . ', tackleSuccessRate: ' . $player['tackleSuccessRate'] . ', manOfTheMatch: ' . $player['manOfTheMatch'] . ', redCards: ' . $player['redCards']);
        return $this->json([
            'result' => $response->text(),
        ]);
    }

    #[Route('/gemini/team', name: 'api_gemini_team')]
    public function adviceTeam(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $team = $data['team'];
        if (!$team || !is_array($team)) {
            return $this->json(['result' => json_encode($team)]);
        }
        $chat = Gemini::client(
            $this->getParameter('gemini_api_key'),
        )->chat()->startChat(
            history: [
                Content::parse('Tu vas répondre en français, tu seras le coach de mon club de foot et tu vas me donner des conseils pour améliorer mon équipe.'),
                Content::parse('Ton nom en tant que coach sera Mokhtar.'),
            ]
        );

        $chat->sendMessage("Il faut que répondes en comme un vrai coach de foot, en donnant des conseils pour améliorer l'équipe.");
        $chat->sendMessage("tu dois tutoyer l'équipe et lui donner des conseils pour qu\'il s\'améliore.");
        $chat->sendMessage('dont je vais te donner les statistiques.');
        $response = $chat->sendMessage('Donne uniquement en une phrase un conseil pour améliorer l\'équipe, team: ' . $team['name'] . ', wins: ' . $team['wins'] . ', ties: ' . $team['ties'] . ', losses: ' . $team['losses'] . ', gamesPlayed: ' . $team['gamesPlayed'] . ', gamesPlayedPlayoff: ' . $team['gamesPlayedPlayoff'] . ', wstreak: ' . $team['wstreak'] . ', unbeatenstreak: ' . $team['unbeatenstreak'] . ', goals: ' . $team['goals'] . ', goalsAgainst: ' . $team['goalsAgainst'] . ', skillRating: ' . $team['skillRating'] . ', bestDivision: ' . $team['bestDivision'] . ', lastMatchPlayoff: ' . $team['lastMatchPlayoff'] . ', lastMatchLeague: ' . $team['lastMatchLeague'] . ', promotions: ' . $team['promotions'] . ', relegations: ' . $team['relegations']);
        return $this->json([
            'result' => $response->text(),
        ]);
    }
}
