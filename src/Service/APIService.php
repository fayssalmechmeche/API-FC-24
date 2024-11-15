<?php

namespace App\Service;

class APIService
{
    const BASE_URL = 'https://proclubs.ea.com/api/fc';
    const CLUBIDS = "?clubIds=";
    const CLUBID = "?clubId=";
    const CLUBNAME = '?clubName=';
    const PLATFORM = '&platform=common-gen5';
    const MATCHTYPE_LEAGUE = '&matchType=leagueMatch';
    const MATCHTYPE_PLAYOFF = '&matchType=playoffMatch';
    const LAST = '&maxResultCount=1';
}
