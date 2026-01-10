<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Album;
use Illuminate\Http\Request;

class AlbumController extends Controller
{
    public function index(Request $request)
    {
        $query = Album::query();

        // 検索条件
        if ($request->filled('title')) {
            $query->where('title', 'like', '%' . $request->title . '%');
        }

        if ($request->filled('catalog_number')) {
            $query->where('catalog_number', 'like', '%' . $request->catalog_number . '%');
        }

        // ソート
        $sort = $request->get('sort', 'release_date');
        $order = $request->get('order', 'desc');

        $query->orderBy($sort, $order);

        // ページネーション
        $albums = $query->paginate(5);

        return response()->json($albums);
    }
}
