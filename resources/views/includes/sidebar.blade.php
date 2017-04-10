
<div class="sidebar">
    <div class="categories">
        <h4>{{ trans('sidebar.categories') }}</h4>
        <div class="list-group">
            @foreach($categories as $category)
                <a href="" class="list-group-item">{{ $category->title }}</a>
            @endforeach
        </div>
    </div>

    <div class="recent-articles">
        <h4>{{ trans('sidebar.recent_articles') }}</h4>
        {{--<ul>
            @foreach($recent_articles as $article)
                <li><a href="{{ route('articles.show', $article->slug) }}">{{ $article->title }}</a></li>
            @endforeach
        </ul>--}}
        @foreach($recent_articles as $article)
            <div class="clearfix item">
                <div class="row">
                    <div class="col-md-2">
                        @if(!empty($article->image))
                            <img src="/images/articles/{{ $article->image }}" class="sm-img">
                        @endif
                    </div>
                    <div class="col-md-10">
                        <a href="{{ route('articles.show', $article->slug) }}">
                            {{ $article->title }}
                        </a>
                    </div>
                </div>
                {{--<div class="pull-left">
                    <img src="/images/articles/{{ $article->image }}" class="sm-img">
                </div>
                <div class="pull-left">
                    <a href="{{ route('articles.show', $article->slug) }}">
                        {{ $article->title }}
                    </a>
                </div>--}}
            </div>
        @endforeach

    </div>

    <div class="tags">
        <h4>{{ trans('sidebar.tags') }}</h4>

        <div id="jqcloud" class="jqcloud"></div>
    </div>
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
                classPattern: null,
                colors: ["#04B486", "#009795", "#0B3B39", "#0A2A12", "#04B45F", "#A4A4A4", "#01DFA5", "#31B404", "#58FAAC"],
                fontSize: {
                    from: 0.1,
                    to: 0.02
                },
                width: 350,
                height: 250
            });
        });

    </script>
@endsection

