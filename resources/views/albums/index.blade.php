<!-- resources/views/albums/index.blade.php -->
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>CD検索</title>
</head>
<body>

<h1>CD検索</h1>

<form method="GET" action="/albums">
    <div>
        タイトル：
        <input type="text" name="title" value="{{ request('title') }}">
    </div>

    <div>
        商品番号：
        <input type="text" name="catalog_number" value="{{ request('catalog_number') }}">
    </div>

    <div>
        並び順：
        <select name="sort">
            <option value="release_date_desc"
                {{ $sort === 'release_date_desc' ? 'selected' : '' }}>
                発売日（新しい順）
            </option>
            <option value="release_date_asc"
                {{ $sort === 'release_date_asc' ? 'selected' : '' }}>
                発売日（古い順）
            </option>
        </select>
    </div>

    <button type="submit">検索</button>
</form>

<hr>

<ul>
@foreach ($albums as $album)
    <li>
        {{ $album->title }}
        （{{ $album->catalog_number }}）
        - {{ $album->release_date }}
    </li>
@endforeach
</ul>

{{ $albums->links() }}

</body>
</html>
