<div class="categories">
    <h3>Categories</h3>
    <div class="list-group">
        @foreach($categories as $category)
            <a href="" class="list-group-item">{{ $category->title }}</a>
        @endforeach
    </div>
</div>

<div class="recent-articles">
    <h3>Recent articles</h3>
    <div class="list-group">
        @foreach($recent_articles as $article)
            <a href="{{ route('articles.show', $article->slug) }}" class="list-group-item">{{ $article->title }}</a>
        @endforeach
    </div>
</div>

<div class="tags">
    <h3>Tags</h3>
</div>
