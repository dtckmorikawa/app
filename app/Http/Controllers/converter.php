<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Swis\LaravelFulltext\Search;
use WebDevEtc\BlogEtc\Models\BlogEtcPost;
use WebDevEtc\BlogEtc\Models\BlogEtcCategory;
use WebDevEtc\BlogEtc\Captcha\UsesCaptcha;
use Illuminate\Support\Facades\Artisan;

class converter extends Controller
{
    public function index () 
    {

        //保存されているトピックの一覧を表示
        Log::debug('converter>index is called');

        $title = 'トピックの一覧'; // default title...
        $posts = BlogEtcPost::query();
        $posts = $posts->orderBy("posted_at", "desc")
            ->paginate(config("blogetc.per_page", 10));

        return view("print", [
            'posts' => $posts,
            'title' => $title,
        ]);
    }

    //トピックの検索
    public function search(Request $request){
        Log::debug('converter>search is called');
        $query = $request->get('s');
        
        //検索ワードがある場合
        if(strpos($query,'catid')){
            //フィルタあり
            $queryarr = explode('?catid=', $query);
            $searchterm = $queryarr[0];
            $catid = $queryarr[1];
            
            //catidが合致するpostだけ表示
            $category = BlogEtcCategory::where("id", $catid)->firstOrFail();
            $posts = $category->posts()
                    ->where("blog_etc_post_categories.blog_etc_category_id", $category->id)
                    ->search($searchterm)->paginate()->appends('catid', request('catid'));

            //検索窓に入る文言からカテゴリ部分を削除
            $query=$searchterm;

        }else{
            //フィルタなし
            $searchterm = $query;
            $posts = BlogEtcPost::search($query)->paginate();
        }
        
        //全てのカテゴリを取得
        $categories=BlogEtcCategory::get();
        \View::share("title",  e($query) . "の検索結果");

        return view("topic-searchresult", ['query' => $query, 'posts' => $posts, 'categories' => $categories]);

    }    

    public function print (Request $request, $blogPostSlug)
    {

        Log::debug('converter>print is called');
        
        //データベースからid、ユーザーid、タイトル、カテゴリ、トピックの内容を入手する
        $blog_post = BlogEtcPost::where("slug", $blogPostSlug)
            ->firstOrFail();

        //user_email
        if (\Request::has('user_email')) {
            $user_email = \Request::input('user_email');
        }

        //タイトルの取得
        $blog_title = $blog_post['title'];

        //slugの取得            
        $blog_slug = $blog_post['slug'];

        //Bodyの内容　配列にしてから取得（文字コードのため）
        $blog_post_arr = $blog_post -> toArray();
        $blog_body = $blog_post_arr['post_body'];

        //Entity宣言ファイルの中身から文字列を取得
        $html_declaration_path = app_path('msxsl/html_declaration.xml');
        $html_declaration = file_get_contents($html_declaration_path);
        $html_declaration = mb_convert_encoding($html_declaration, 'utf8', 'auto');//文字コードをutf8に

        //結合してhtmlファイル作成
        $blog_title_html = '<title>'. $blog_title .'</title>';
        $blog_body_html = '<body>'. $blog_body .'</body>';
        $target_data = $html_declaration . '<html id="dtc_' . $blog_slug . '">' . $blog_title_html . $blog_body_html . '</html>';

        //html用テンプレートをコピー
        $path_to_htmltemp = storage_path('dita/template.html');
        $target_html = storage_path('dita') .'/' . $blog_post['id'] . '.html';
        
        if (!\File::copy($path_to_htmltemp, $target_html)) {
            die("ファイルをコピーできませんでした");
        }
       
        //ファイル名をutf8に変更
        $target_html=mb_convert_encoding($target_html, "utf8", "auto");
       
        //コピーしたテンプレートにHTMLを出力
        file_put_contents($target_html, $target_data);

        //外部関数を使ってHTMLをDITAに変換(トピック名のみを渡す)
        \Artisan::call('convert:xml ' . $blog_post['id']  . '.html');
        $dita_path = storage_path() . '\dita/' . $blog_post['id']. '.html.dita';

        if(!file_exists($dita_path)){
            \Session::flash('DITA変換に失敗しました。');
        }

       //外部関数を使ってDITAをPDFに変換
        Artisan::call('dita:print ' . $blog_post['id'] . '.html.dita ' . 'rules ' . $user_email);
        $output_path = storage_path() . '/dita/out/' . $blog_post['id'] . '.html.pdf';

        if(!file_exists($output_path)){
            //エラー時の対応
            Log::debug('ファイルが変換できません。');
        }
        
        //htmlとditaファイルを削除
        \File::delete($target_html);
        \File::delete($dita_path);

        //PDFをDLした後は削除する
        Log::debug('PDFファイルの存在を確かめてから、PDFをDL');
        $dl_headers = ['Content-Type' => 'application/pdf'];
        return response()->download($output_path, $blog_title . '.pdf', $dl_headers)->deleteFileAfterSend(true);

        //コメント表示時に必要
        /*if ($captcha = $this->getCaptchaObject()) {
            $captcha->runCaptchaBeforeShowingPosts($request, $blog_post);
        }
        
        //今のビューを再度表示
        return view("blogetc::single_post", [
            'post' => $blog_post,
            // the default scope only selects approved comments, ordered by id
            'comments' => $blog_post->comments()
                ->with("user")
                ->get(),
            'captcha' => $captcha,
        ]);*/

    }



    
}
