<?php

namespace App\Traits;

use App\Models\Team;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * Class UsedByTeams.
 */
trait UsedByTeams
{
    /**
     * Boot the global scope.
     */
    protected static function bootUsedByTeams()
    {
        static::addGlobalScope('team', function (Builder $builder) {
            static::teamGuard();

            $builder->where($builder->getQuery()->from.'.team_id', auth()->user()->currentTeam->getKey());
        });

        static::saving(function (Model $model) {
            if (! isset($model->team_id)) {
                static::teamGuard();

                $model->team_id = auth()->user()->currentTeam->getKey();
            }
        });
    }

    /**
     * @param Builder $query
     * @return mixed
     */
    public function scopeAllTeams(Builder $query)
    {
        return $query->withoutGlobalScope('team');
    }

    /**
     * @return mixed
     */
    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    /**
     * @throws Exception
     */
    protected static function teamGuard()
    {
        if (auth()->guest() || ! auth()->user()->currentTeam) {
            throw new Exception('No authenticated user with selected team present.');
        }
    }
}
