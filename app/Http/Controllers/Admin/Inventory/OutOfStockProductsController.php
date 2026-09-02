<?php

namespace App\Http\Controllers\Admin\Inventory;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OutOfStockProductsController extends Controller
{
    public function index(Request $request)
    {
        $view = $request->query('view') === 'category' ? 'category' : 'general';
        $selectedCategory = $request->query('category_id');
        $perPage = in_array((int) $request->query('per_page', 50), [25, 50, 100], true)
            ? (int) $request->query('per_page', 50)
            : 50;

        $baseQuery = Product::query()->whereNull('deleted_at')->where('in_stock', 0);

        $totalOutOfStock = (clone $baseQuery)->count();
        $activeOutOfStock = (clone $baseQuery)->where('allow', true)->count();
        $uncategorizedCount = (clone $baseQuery)->whereDoesntHave('categories')->count();

        $categoryCounts = DB::table('categories')
            ->join('category_product', 'categories.id', '=', 'category_product.category_id')
            ->join('products', 'products.id', '=', 'category_product.product_id')
            ->where('products.in_stock', 0)
            ->whereNull('products.deleted_at')
            ->select(
                'categories.id',
                'categories.name',
                DB::raw('COUNT(DISTINCT products.id) as out_of_stock_count')
            )
            ->groupBy('categories.id', 'categories.name')
            ->orderByDesc('out_of_stock_count')
            ->orderBy('categories.name')
            ->get();

        $affectedCategories = $categoryCounts->count();
        $categories = Category::query()->orderBy('name')->get(['id', 'name']);

        $products = null;
        $shouldLoadProducts = $view === 'general' || $request->filled('category_id') || $request->filled('q');

        if ($shouldLoadProducts) {
            $productsQuery = Product::query()
                ->with([
                    'brand:id,name',
                    'categories:id,name',
                ])
                ->whereNull('deleted_at')
                ->where('in_stock', 0);

            if ($request->filled('q')) {
                $search = trim($request->query('q'));
                $productsQuery->where(function ($query) use ($search) {
                    $query->where('name', 'like', '%' . $search . '%')
                        ->orWhere('product_name', 'like', '%' . $search . '%')
                        ->orWhere('generic_name', 'like', '%' . $search . '%')
                        ->orWhere('sku', 'like', '%' . $search . '%')
                        ->orWhere('barcode', 'like', '%' . $search . '%');
                });
            }

            if ($selectedCategory === 'uncategorized') {
                $productsQuery->whereDoesntHave('categories');
            } elseif (is_numeric($selectedCategory)) {
                $productsQuery->whereHas('categories', function ($query) use ($selectedCategory) {
                    $query->where('categories.id', (int) $selectedCategory);
                });
            }

            $products = $productsQuery
                ->orderBy('name')
                ->orderBy('id')
                ->paginate($perPage)
                ->withQueryString();
        }

        $selectedCategoryName = null;
        if ($selectedCategory === 'uncategorized') {
            $selectedCategoryName = 'Uncategorized';
        } elseif (is_numeric($selectedCategory)) {
            $selectedCategoryName = optional($categories->firstWhere('id', (int) $selectedCategory))->name;
        }

        return view('admin.out_of_stock.index', compact(
            'view',
            'products',
            'categories',
            'categoryCounts',
            'totalOutOfStock',
            'activeOutOfStock',
            'uncategorizedCount',
            'affectedCategories',
            'selectedCategory',
            'selectedCategoryName',
            'perPage'
        ));
    }
}
