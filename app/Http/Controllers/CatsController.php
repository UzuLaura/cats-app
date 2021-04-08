<?php

namespace App\Http\Controllers;

use App\Models\VisitorsStatistic;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class CatsController extends Controller
{
    public function showCats($n)
    {
        $cats = Cache::get($n);

        // Get cats
        if (!$cats) {
            $cats = $this->getCats(explode("\n", file_get_contents(config('app.data_file'))));
            Cache::put($n, $cats, '60');
        }

        // Update visitors statistics
        $statistics = new VisitorsStatistic();
        $statistics->updateStatistics($n);

        // Save log
        Log::channel('cats')->info(json_encode([
            'datetime' => date('Y-m-d H:i:s'),
            'n' => $n,
            'cats' => $cats,
            'countAll' => $statistics->getAllStatistics()->count,
            'countN' => $statistics->getPageStatistics($n)->count
        ]));

        return view('cats')->with([
            'cats' => $cats,
        ]);
    }

    /**
     * Get three random cats from cats array.
     *
     * @param array $cats
     * @return string - formatted cats string
     */
    private function getCats(array $cats): string
    {
        $catsIds = array_rand($cats, 3);
        $selectedCats = [];

        foreach ($catsIds as $catId) {
            $selectedCats[] = $cats[$catId];
        }

        return implode(', ', $selectedCats);
    }
}
