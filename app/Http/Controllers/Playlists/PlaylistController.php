<?php

namespace App\Http\Controllers\Playlists;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Models\User;
use App\Models\Playlists\PlaylistTrack;
use App\Models\Services\Service;

class PlaylistController extends Controller
{
    public function create(User $user, Service $service, PlaylistTrack ...$trackData)
    {
        
    }
}
