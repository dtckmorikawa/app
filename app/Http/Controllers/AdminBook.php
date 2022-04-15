<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use WebDevEtc\BlogEtc\Middleware\UserCanManageBlogPosts;
use WebDevEtc\BlogEtc\Traits\UploadFileTrait;
use WebDevEtc\BlogEtc\Helpers;
use WebDevEtc\BlogEtc\Models\BlogEtcPost;
use WebDevEtc\BlogEtc\Models\BlogEtcCategory;

use App\Books;
use App\User;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\DeleteBookRequest;
use App\Http\Requests\UpdateBookRequest;

use App\Hierarchy;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;

use Log;

class AdminBook extends Controller
{
    /*
        If not logged in, redirect to 401 Unauthorized
    */
    use UploadFileTrait;

    public function __construct()
    {
        Log::debug('AdminBook>__construct is called');
        
        $this->middleware(UserCanManageBlogPosts::class);

        if (!is_array(config("blogetc"))) {
            throw new \RuntimeException('config/blogetc.phpが存在しません。「php artisan publish:vendor」を実行してください。');
        }
    }

    /*
        Show all books
    */
    public function index () 
    {

        //保存されているブックの一覧を表示
        Log::debug('AdminBook>index is called');

        $books = Books::query();
        $books = $books->orderBy("updated_at", "desc")
            ->paginate(config("blogetc.per_page", 10));

        return view("admin-book.index", [
            'books' => $books,
        ]);
    }

    public function create () 
    {
        //ブックの追加
        Log::debug('AdminBook>create is called');
        return view("admin-book.create");
    }

    public function createwbase (Request $request, $bookSlug) 
    {
        //ブックの追加(流用)
        Log::debug('AdminBook>createwbase is called');

        //ブックIDから流用元のブック情報を取得
        $oldbook = Books::where("slug", $bookSlug)->firstOrFail();
        
        //流用する情報(タイトル、ブックID、ブックの説明、Bookの構成)を古いブックから取得
        $base_name = $oldbook->book_name;
        $base_slug = $oldbook->slug;
        $base_description = $oldbook->book_description;
        $base_structure = $oldbook->book_structure;
        $base_id = $oldbook->id;
        $author = $request->my_id;

        //空のbookを作成
        $new_book = new Books;
        $new_book->book_name = '流用元：' . $base_name;
        $new_book->user_id = $author;

        $current_timestamp = Carbon::now()->timestamp;
        $new_book->slug='bookid_' . $current_timestamp;

        $new_book->book_description = '流用元：' . $base_description;
        $new_book->book_structure = $base_structure;
        $new_book->descending = $base_id;

        //保存
        $new_book->save();
        
        //hierarchiesテーブルにすでに自分のidが登録されているかチェック
        if(Hierarchy::where('title', $new_book->slug)->exists()){
            //既に登録があった場合はエラーメッセージを返す。
            Helpers::flash_message("このidは既に登録されています。");
        }else{
            //登録がなかったら子を追加する

            if(!Hierarchy::where('title', $oldbook->slug)->exists()){
                //親の登録がない場合、先に親を0で登録する
                $input['parent_id']=0;
                $input['title']=$oldbook->slug;
                Hierarchy::create($input);
            }
            
            //Hierarchyの登録
            $oldinfo=Hierarchy::where("title", $oldbook->slug)->firstOrFail();
            $input['parent_id']=$oldinfo->id;
            $input['title']=$new_book->slug;            
            Hierarchy::create($input);
        }

        //全ての投稿済みトピックを取得
        if(request()->has('catid')){
            //フィルター catidが合致するpostだけ表示
            $category = BlogEtcCategory::where("id", request('catid'))->firstOrFail();
            $posts = $category->posts()
                          ->where("blog_etc_post_categories.blog_etc_category_id", $category->id)
                          ->paginate(10)->appends('catid', request('catid'));
        }else{
            //全てのトピックを表示
            $posts = BlogEtcPost::paginate(10);
        }

        //全てのカテゴリを取得
        $categories=BlogEtcCategory::get();
    
        //ブックに登録されているトピックの情報を取得
        if($new_book->book_structure == ""){
            //登録がない場合
            $structured_posts = "";
            $map_html="";
            $book_map="";
        }else{
            //登録がある場合
            $book_map = $new_book->book_structure;
            $dom = new \DOMDocument();
            $dom->loadHTML($book_map);
            $xpath = new \DomXpath($dom);
            $liNodes = $xpath->query('//li');

            //登録されているトピックのidから使用されているトピックのid一覧を作成
            $posts_arr=[];
            foreach($liNodes as $liNode){
                $posts_arr[]=$liNode->getAttribute('post_id');
            }
            //idからトピックの情報を取得
            $i=0;
            foreach($posts_arr as $single_id){
                $structured_posts[$i]=BlogEtcPost::find($single_id);
                $i++;
            }
        }        
        
        Helpers::flash_message("流用して新しいブックを作成しました。タイトルとブックの説明を修正し、更新ボタンを押してください。");
        return redirect()->route("adminbook.index");
       
    }    

    public function store(StoreBookRequest $request)
    {
        //新規ブックの保存
        Log::debug('AdminBook>store is called');
        
        //Timestampの取得
        $current_timestamp = Carbon::now()->timestamp;

        //Bookの保存処理
        $new_book = new Books($request->all());
        $new_book['slug']='bookid_' . $current_timestamp;
        $new_book->save();

        //Hierarchyの登録
        $input['parent_id']=0;
        $input['title']=$new_book->slug;
        Hierarchy::create($input);

        Helpers::flash_message("ブックを追加しました");

        return redirect()->route("adminbook.index");
    }

    public function edit(Request $request, $bookSlug){
        //ブックの編集
        Log::debug('AdminBook>edit is called');
        
        $user_id=$request->user_id;
        $catid = $request->catid;
        //投稿済みトピック取得
        /*if(isset($catid)){
            
            //フィルター catidが合致するpostだけ表示
            $category = BlogEtcCategory::where("id", $catid)->firstOrFail();
                            
            $posts = $category->posts()->where("blog_etc_post_categories.blog_etc_category_id", $category->id);
            $posts = $posts->orderBy("updated_at", "desc")
                              ->orderBy("updated_at", "desc")
                              ->appends('catid', $catid);
                              //->paginate(10)->appends('catid', $catid);
        }else{
            //全てのトピックを取得
            //$posts = BlogEtcPost::paginate(10);*/
            $posts = BlogEtcPost::get();
            $catid="";
        //}
        
        //全てのカテゴリを取得
        $categories=BlogEtcCategory::get();
        
        //bookSlugからブックの情報を取得
        $book = Books::where("slug", $bookSlug)->firstOrFail();
        
        //lock状態の確認
        $booklock = $book->is_locked;
        
        //ブックに登録されているトピックの情報を取得
        if($book->book_structure == ""){
            //登録がない場合
            $structured_posts = "";
            $map_html="";
            $book_map="";
            $newMap="";
        }else{
            //登録がある場合
            $book_map = $book->book_structure;
            $dom = new \DOMDocument();
            $dom->loadHTML(mb_convert_encoding($book_map, 'HTML-ENTITIES', 'UTF-8'),LIBXML_HTML_NODEFDTD);
            $xpath = new \DomXpath($dom);
            $liNodes = $xpath->query('//li');

            $lis = $dom->getElementsbyTagName('li');
            foreach ($lis as $li){
                //postから最新のタイトルを取得
                $post_id = $li->getAttribute('post_id');
                $testPost = BlogEtcPost::find($post_id);
                $postTitle = $testPost->title;
                    
                //mapのノードに記録されているタイトルを取得
                $ps = $li->getElementsbyTagName('p');   
                $nodeTitle = $ps[0]->textContent;
                
                if($postTitle != $nodeTitle){
                    $ps[0]->textContent=$postTitle;
                }
            }
            //MAPのDOMを保存
            $newMap = mb_convert_encoding($dom->saveHTML(),'UTF-8','HTML-ENTITIES' );
            $newMap = str_replace('<html><body>','',$newMap);
            $newMap = str_replace('</body></html>','',$newMap);
            
            $book->book_structure = $newMap;

            $posts_arr=[];
            foreach($liNodes as $liNode){
                $posts_arr[]=$liNode->getAttribute('post_id');
            }

            $i=0;
            foreach($posts_arr as $single_id){
                $structured_posts[$i]=BlogEtcPost::find($single_id);
                $i++;
            }
        }

        return view("admin-book.edit", [
            'book' => $book, 
            'posts'=> $posts,
            'structured_posts'=>$structured_posts,
            'categories'=>$categories,
            'book_map'=>$newMap,
            'booklock'=>$booklock,
            'cat_id'=>$catid,
            ]);
    }

    public function update(UpdateBookRequest $request, $bookSlug){
        
        Log::debug('AdminBook>update is called');
        $book = Books::where("slug", $bookSlug)->firstOrFail();
        $user_id = $request->is_locked;
        $is_allPublished = 1;
        
        //is_lockedにあるユーザーIDと一致するなら更新
        $lockstatus = $book->is_locked;        
        if($lockstatus == $user_id){

            //各トピックの公開状態を取得
            if($book->book_structure != ""){
                //マップ登録がある場合
                $book_map = $book->book_structure;
                $dom = new \DOMDocument();
                $dom->loadHTML(mb_convert_encoding($book_map, 'HTML-ENTITIES', 'UTF-8'),LIBXML_HTML_NODEFDTD);
                $xpath = new \DomXpath($dom);
                $liNodes = $xpath->query('//li');
    
                $lis = $dom->getElementsbyTagName('li');
                foreach ($lis as $li){
                    //postから各公開状態を取得
                    $post_id = $li->getAttribute('post_id');
                    $testPost = BlogEtcPost::find($post_id);

                    if($testPost->is_published == 0){
                        $is_allPublished = 0;
                    }
                }
            }
            
            //DB更新
            $book->fill($request->all());
            $book['is_published'] = $is_allPublished;
            $book->save();
            
            //ロック解除
            Books::where("slug", $bookSlug)->update(['is_locked' => 0 ]);

        }else{
            Helpers::flash_message("「" . $book->book_name . "」はロックされています");
            return redirect()->route("adminbook.index");
        }

        Helpers::flash_message("「" . $book->book_name . "」を更新しました");
        return redirect()->route("adminbook.index");
    }


    public function delete(DeleteBookRequest $request, $bookSlug){
        Log::debug('AdminBook>delete is called');

        $book = Books::where("slug", $bookSlug)->firstOrFail();
        $target_slug = $book->slug;
        $book->delete();

        //Update Hierarchy info
        Hierarchy::where("title", $target_slug)
                ->update([
                    'deleted' => 1
                ]);

        Helpers::flash_message("削除しました");
        return redirect()->route("adminbook.index");
    }

        //search for books
    public function search(Request $request){
        Log::debug('AdminBook>search is called');
        $query = $request->get("s");
        $books=Books::search($query)->paginate();

        \View::share("title",  e($query) . "の検索結果");
        return view("admin-book.search", ['query' => $query, 'books' => $books]);

    }

    public function booklock(Request $request, $bookSlug){
        Log::debug('AdminBook>booklock is called');

        $book = Books::where("slug", $bookSlug)->firstOrFail();
        $bookCurrentStatus = $book->is_locked;

        //Lock
        if($bookCurrentStatus==0){
            Books::where("slug", $bookSlug)->update(['is_locked'=> $request->user_id]); //lock the book
        }
        
        //to display book detail
        $user_id=$request->user_id;
        $catid = $request->catid;

        //投稿済みトピック取得
        /*if(isset($catid)){
            
            //フィルター catidが合致するpostだけ表示
            $category = BlogEtcCategory::where("id", $catid)->firstOrFail();

            $posts = $category->posts()
                              ->where("blog_etc_post_categories.blog_etc_category_id", $category->id)
                              ->orderBy("updated_at", "desc")
                              ->paginate(10)->appends('catid', request('catid'));
            
        }else{*/
            //全てのトピックを取得
            $posts = BlogEtcPost::get();
            $catid="";
              
        //}
        
        //全てのカテゴリを取得
        $categories=BlogEtcCategory::get();
       
        //bookSlugからブックの情報を取得
        $book = Books::where("slug", $bookSlug)->firstOrFail();

        //lock状態の確認
        $booklock = $book->is_locked;
        
        //ブックに登録されているトピックの情報を取得
        if($book->book_structure == ""){
            //登録がない場合
            $structured_posts = "";
            $map_html="";
            $book_map="";
        }else{
            //登録がある場合
            $book_map = $book->book_structure;
            $dom = new \DOMDocument();
            $dom->loadHTML($book_map);
            $xpath = new \DomXpath($dom);
            $liNodes = $xpath->query('//li');

            //登録されているトピックのidから使用されているトピックのid一覧を作成
            $posts_arr=[];
            foreach($liNodes as $liNode){
                $posts_arr[]=$liNode->getAttribute('post_id');
            }

            //idからトピックの情報を取得
            $i=0;
            foreach($posts_arr as $single_id){
                $structured_posts[$i]=BlogEtcPost::find($single_id);
                $i++;
            }
        }
        
        return view("admin-book.edit", [
            'book' => $book, 
            'posts'=> $posts,
            'structured_posts'=>$structured_posts,
            'categories'=>$categories,
            'book_map'=>$book_map,
            'booklock'=>$booklock,
            'cat_id'=>$catid,
            ]);
    }

    
        //new search for books
    public function searchnew(Request $request){
            
            //フォームから送られてきた値を取得
            $title = $request->input('title');
            $user_name = $request->input('user_name');
    
            //DBからすべてのカテゴリ取得のクエリーを作成
            $query = Books::query();

            //filter with title
            if(!empty($title)){
                $query->where('book_name','LIKE','%'.$title.'%'); 
            }

            //filter with author
            if(!empty($user_name)){
                $users = User::where('name','LIKE','%'.$user_name.'%')->get();
                foreach($users as $user){
                    $user_id[] = $user->id;
                }
                $query->where('user_id', $user_id);
            }

        $query->orderBy('updated_at', 'desc');
        $books = $query->get();
        
        $booksPaginate= new LengthAwarePaginator(
            $books->forPage($request->page, 10), // 現在のページのsliceした情報(現在のページ, 1ページあたりの件数)
            $books->count(),
            10,
            null,
            ['path' => $request->url()]
        );
        return view("admin-book.index", [
                'title' => $title,
                'user_name' => $user_name,
                'books' => $booksPaginate
        ]);
    }

}
