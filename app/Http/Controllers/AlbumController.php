<?php

namespace App\Http\Controllers;

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

        // ソート（デフォルト：発売日 降順）
        $sort = $request->get('sort', 'release_date_desc');

        switch ($sort) {
            case 'release_date_asc':
                $query->orderBy('release_date', 'asc');
                break;
            default:
                $query->orderBy('release_date', 'desc');
                break;
        }

        // ページネーション
        $albums = $query->paginate(5)->withQueryString();

        return view('albums.index', compact('albums', 'sort'));
    }
}
