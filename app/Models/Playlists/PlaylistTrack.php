<?php

namespace App\Models\Playlists;

use Illuminate\Database\Eloquent\Model;
use App\Models\Playlists\Playlist;

class PlaylistTrack extends Model
{
    protected $fillable = [
        'track_id'
    ];

    /**
     * Return parent playlist
     * 
     * @return Playlist
     */
    public function playlist()
    {
        return $this->belongsTo(Playlist::class);
    }
}
