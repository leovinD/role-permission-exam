<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Models\Sale;
use App\Models\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Posts data
        $totalPosts = Post::count();
        $publishedPosts = Post::where('is_published', true)->count();
        $unpublishedPosts = Post::where('is_published', false)->count();

        $categories = Category::withCount('posts')->get();
        $categoryNames = $categories->pluck('cat_name');
        $categoryCounts = $categories->pluck('posts_count');

        $postsPerMonth = Post::selectRaw('DATE_FORMAT(published_at, "%b %Y") as month, COUNT(*) as count')
            ->groupBy('month')
            ->orderByRaw('MIN(published_at) DESC')
            ->get();

        $postMonths = $postsPerMonth->pluck('month');
        $postCountsPerMonth = $postsPerMonth->pluck('count');

        // Sales totals
        $totalSalesUnits = Sale::sum('units_sold');
        $totalSalesValue = Sale::sum(DB::raw('units_sold * unit_price'));
        $numberOfSales   = Sale::count();

        // Sales data - total units sold per month
        $salesPerMonth = Sale::selectRaw('DATE_FORMAT(sale_date, "%b %Y") as month, SUM(units_sold) as units_sold')
            ->groupBy('month')
            ->orderByRaw('MIN(sale_date) ASC')
            ->get();

        return view('dashboard', compact(
            'totalPosts',
            'publishedPosts',
            'unpublishedPosts',
            'categoryNames',
            'categoryCounts',
            'postMonths',
            'postCountsPerMonth',
            'totalSalesUnits',
            'totalSalesValue',
            'numberOfSales',
            'salesPerMonth',
        ));
    }
}
