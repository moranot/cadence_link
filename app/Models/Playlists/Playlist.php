<?php

namespace App\Models\Playlists;

use App\Models\Model;
use App\Models\Playlists\PlaylistTrack;

class Playlist extends Model
{
    protected $fillable = [
        'title'
    ];

    /**
     * Return tracks of playlist
     * 
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function tracks()
    {
        return $this->hasMany(PlaylistTrack::class);
    }
}
