
<div class="categories">
    <h3>{{ trans('sidebar.categories') }}</h3>
    <div class="list-group">
        @foreach($categories as $category)
            <a href="" class="list-group-item">{{ $category->title }}</a>
        @endforeach
    </div>
</div>

<div class="recent-articles">
    <h3>{{ trans('sidebar.recent_articles') }}</h3>
    <div class="list-group">
        @foreach($recent_articles as $article)
            <a href="{{ route('articles.show', $article->slug) }}" class="list-group-item">{{ $article->title }}</a>
        @endforeach
    </div>
</div>

<div class="tags">
    <h3>{{ trans('sidebar.tags') }}</h3>

    <div id="jqcloud" class="jqcloud"></div>
</div>


@section('scripts')
    <script src="{{ asset('js/jqcloud.min.js') }}"></script>

    <script type="text/javascript">
        /*var words = [
            {text: "Lorem", weight: 13},
            {text: "Ipsum", weight: 10.5},
            {text: "Dolor", weight: 9.4},
            {text: "Sit", weight: 8},
            {text: "Amet", weight: 6.2},
            {text: "Consectetur", weight: 5},
            {text: "Adipiscing", weight: 5}
        ];*/

        var words = JSON.parse('{!! json_encode($tags) !!} ');

        var data = [];
        var interval = 15 / words.length;

        for(var i = 0; i < words.length; i++) {
            data.push({
                text: words[i]['title'],
                weight: 15 - (interval + i),
                link: '/tags/' + words[i]['slug']
            });
        }
        $(document).ready(function($) {
            $('#jqcloud').jQCloud(data, {
                width: 350,
                height: 280
            });
        });

    </script>
@endsection

