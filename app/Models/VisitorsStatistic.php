<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisitorsStatistic extends Model
{
    use HasFactory;

    protected $fillable = ['page'];

    /**
     * Update statistics for selected page and general statistics.
     *
     * @param $page
     */
    public function updateStatistics($page)
    {
        $this->updateAllStatistics();

        $this->updateOrCreate(
            ['page' => $page],
        )->increment('count');
    }

    /**
     * Update general statistics.
     */
    public function updateAllStatistics()
    {
        $this->updateOrCreate(
            ['page' => 'all'],
        )->increment('count');
    }

    /**
     * Get general statistics.
     *
     * @return mixed
     */
    public function getAllStatistics()
    {
        return $this->select('count')->where('page', 'all')->first();
    }

    /**
     * Get statistics for selected page.
     *
     * @param $page
     * @return mixed
     */
    public function getPageStatistics($page)
    {
        return $this->select('count')->where('page', $page)->first();
    }
}
