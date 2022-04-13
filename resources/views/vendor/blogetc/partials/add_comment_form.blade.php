<div class='add_comment_area'>
    <form method='post' action='{{route("blogetc.comments.add_new_comment", $post->slug)}}'>
        @csrf


        <div class="form-group ">

            {{--<label id="comment_label" for="comment">コメントを書く</label>--}}
                    <textarea
                            class="form-control"
                            name='comment'
                            required
                            id="comment"
                            placeholder="コメントを記入してください。"
                            rows="7">{{old("comment")}}</textarea>


        </div>

        {{--<div class='container-fluid'>
            <div class='row'>

                @if(\Auth::check())

                    <div class='col'>
                        <div class="form-group ">
                            <label id="author_name_label" for="author_name">名前 </label>
                            <input
                                    type='text'
                                    class="form-control"
                                    name='author_name'
                                    id="author_name"
                                    placeholder="名前"
                                    required
                                    value="{{old("author_name")}}">
                        </div>
                    </div>

                    @if(config("blogetc.comments.ask_for_author_email"))
                        <div class='col'>
                            <div class="form-group">
                                <label id="author_email_label" for="author_email">Eメール
                                    <small>(公開されません)</small>
                                </label>
                                <input
                                        type='email'
                                        class="form-control"
                                        name='author_email'
                                        id="author_email"
                                        placeholder="Eメール"
                                        required
                                        value="{{old("author_email")}}">
                            </div>
                        </div>
                    @endif
                @endif--}}


                {{--@if(config("blogetc.comments.ask_for_author_website"))
                    <div class='col'>
                        <div class="form-group">
                            <label id="author_website_label" for="author_website">Webサイト
                                <small>(公開されます)</small>
                            </label>
                            <input
                                    type='url'
                                    class="form-control"
                                    name='author_website'
                                    id="author_website"
                                    placeholder="あなたのWebサイトのURL"
                                    value="{{old("author_website")}}">
                        </div>
                    </div>

                @endif
            </div>
        </div>--}}


        {{--@if($captcha)
            Captcha is enabled. Load the type class, and then include the view as defined in the captcha class 
            @include($captcha->view())
        @endif--}}

        <div class="form-group ">
            <input type='submit' class="form-control input-sm btn btn-primary "
                value='コメントをつける'>
        </div>
    </form>
</div>
