{{--Used on the index page (so shows a small summary--}}
{{--See the guide on webdevetc.com for how to copy these files to your /resources/views/ directory--}}
{{--https://webdevetc.com/laravel/packages/blogetc-blog-system-for-your-laravel-app/help-documentation/laravel-blog-package-blogetc#guide_to_views--}}

<div class="" style='max-width:700px; margin: 10px auto; background: #fffbea;border-radius:3px;padding:0;' >
    
    <div style='padding:10px;'>
        <h3 class=''><a href='{{route('book.view',['bookID'=>$post->id])}}'>{{$post->title}}</a></h3>
        <h5 class=''>{{$post->sub_title}}</h5>
    </div>
    
    <div class='text-center'>
            <a href="{{$post->url()}}" class="btn btn-primary">表示</a>
    </div>
</div>
