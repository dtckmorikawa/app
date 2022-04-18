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
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Books;
use App\User;
use Illuminate\Pagination\LengthAwarePaginator;
use WebDevEtc\BlogEtc\Helpers;

class Booklist extends Controller
{
    public function index ()
    {

        //保存されているトピックの一覧を表示
        Log::debug('Booklist>index is called');

        $books = Books::query();
        $books = $books->orderBy("updated_at", "desc")
            ->paginate(config("blogetc.per_page", 99));

        return view("book", [
            'books' => $books,
        ]);
    }

    //search for books
    public function search(Request $request){
        Log::debug('Booklist>search is called');
        
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

        return view("book", [
            'title' => $title,
            'user_name' => $user_name,
            'books' => $booksPaginate
        ]);

    }

    public function bookview ($bookSlug)
    {
        //ブックの情報を表示
        Log::debug('Booklist>bookview is called');

        //bookSlugをキーにブック情報を取得
        $book = Books::where("slug", $bookSlug)->firstOrFail();

        //ブックに登録されているトピックの情報を取得
        if($book->book_structure == ""){
            //登録がない場合
            Helpers::flash_message("ブックにトピックが登録されていません。");
            return redirect()->route("adminbook.index");
        }else{
            //登録がある場合
            $book_map = $book->book_structure;
            $dom = new \DOMDocument();
            $dom->loadHTML($book_map);
            $xpath = new \DomXpath($dom);
            $liNodes = $xpath->query('//li');

            //登録されているトピックのidから使用されているトピックのidと階層の一覧を作成
            $posts_arr=[];
            foreach($liNodes as $liNode){
                $postId = $liNode->getAttribute('post_id');
                $depth_check = explode('/',$liNode->getNodePath());
                $post_depth = count($depth_check);// /html/body/の３つを差し引く
                $posts_arr = $posts_arr + array($postId => $post_depth);
            }
            
            //idから各トピックのhtmlを引き出して結合
            $book_body="";
            foreach($posts_arr as $key => $depth){
                $html_depth = ($depth-2)/2+1;
                if(BlogEtcPost::find($key)->is_published==0){
                    //未公開
                    $book_body = $book_body . "<h" . $html_depth ." file_name=" . BlogEtcPost::find($key)->id ." id=" . BlogEtcPost::find($key)->slug . ">" . BlogEtcPost::find($key)->title . "</h" . $html_depth . ">" . "＠＠＠＠未公開のトピック＠＠＠＠";
                }else{
                    //公開
                    $book_body = $book_body . "<h" . $html_depth ." file_name=" . BlogEtcPost::find($key)->id ." id=" . BlogEtcPost::find($key)->slug . ">" . BlogEtcPost::find($key)->title . "</h" . $html_depth . ">" . BlogEtcPost::find($key)->post_body;
                }
            }
        }

        //印刷用リンク文字列作成
        $book_print_url = route('book.print_book', [$book->slug]);

        //編集用リンク文字列作成
        $book_edit_url = route('adminbook.edit', [$book->slug]);

        return view("book-view.book-view", [
            'book' => $book,
            'book_body' => $book_body,
            'book_print_url' => $book_print_url,
            'book_edit_url' => $book_edit_url,
        ]);

    }

    public function printbook (Request $request, $bookSlug) {
        //ブックの書き出し
        Log::debug('Booklist>printbook is called');
        
        //デフォルトは0（契約書様式）
        if (\Request::has('mapType')) {
            $mapType = \Request::input('mapType');
        }

        //デフォルトは0(HTML)
        if (\Request::has('docType')) {
            $docType = \Request::input('docType');
        }

        //Email
        if (\Request::has('user_email')) {
            $user_email = \Request::input('user_email');
        }

        //bookSlugをキーにブック情報を取得
        $book = Books::where("slug", $bookSlug)->firstOrFail();

        if($docType == 1){
            $outputpath = $this->printpdf($bookSlug, $mapType, $user_email);
            //PDFはDLあとに削除する
            $dl_headers = ['Content-Type' => 'application/pdf'];
            return response()->download($outputpath, $book['book_name'] . '.pdf', $dl_headers)->deleteFileAfterSend(true);
        }else{
            $save_path = $this->printhtml($bookSlug, $mapType, $user_email);
            //DL後はzipも削除
            return response()->download($save_path)->deleteFileAfterSend(true);
        }

    }

    public function printpdf ($bookSlug, $mapType, $user_email)
    {
        //ブックをPDFに変換
        Log::debug('Booklist>printpdf is called');
        
        //bookSlugをキーにブック情報を取得
        $book = Books::where("slug", $bookSlug)->firstOrFail();

        //bookに所属するTopicのIDを使って各トピックのditaファイルを作成
        if($book->book_structure == ""){
            //登録がない場合
            return redirect()->back()->withInput()->withErrors('ブックにトピックが登録されていません。');
        }else{
            //登録がある場合
            $book_map = $book->book_structure;
            $dom = new \DOMDocument();
            $dom->loadHTML($book_map);
            $xpath = new \DomXpath($dom);
            $liNodes = $xpath->query('//li');

            //登録されているトピックのidから使用されているトピックのidを取得
            $posts_id_arr=[];
            foreach($liNodes as $liNode){
                //各トピックのditaファイルを作成
                $posts_id_arr[]=$liNode->getAttribute('post_id');
            }

            //配列内に重複が有れば削除
            $unique_post_ids=array_unique($posts_id_arr);

            //削除用のパスリスト
            $to_be_deleted=[];

            //各トピックのditaファイルを作成する
            foreach($unique_post_ids as $unique_post_id){
                //idからトピックの情報を取得
                $blog_post = BlogEtcPost::where("id", $unique_post_id)
                ->firstOrFail();

                //Bodyの内容　配列にしてから取得（文字コードのため）
                $blog_post_arr = $blog_post -> toArray();
                $blog_body = $blog_post_arr['post_body'];

                //Entity宣言ファイルの中身から文字列を取得
                $html_declaration_path = app_path('msxsl/html_declaration.xml');
                $html_declaration = file_get_contents($html_declaration_path);
                $html_declaration = mb_convert_encoding($html_declaration, 'utf8', 'auto');//文字コードをutf8に

                //Entity宣言ファイルの中身と各トピックを結合してhtmlファイル作成（PDFの時のみ必要）
                $blog_title_html = '<title>'. $blog_post['title'] .'</title>';
                $blog_body_html = '<body>'. $blog_body .'</body>';
                //$target_data = $html_declaration . '<html id="dtc_' . $blog_post['slug'] . '">' . $blog_title_html . $blog_body_html . '</html>';
                $target_data = $html_declaration . '<html id="' . $blog_post['slug'] . '">' . $blog_title_html . $blog_body_html . '</html>';

                //html用テンプレートをコピー
                $path_to_htmltemp = storage_path('dita/template.html');
                //$target_html_path = storage_path('dita/') . $blog_post['id'] . '.html';
                $target_html_path = storage_path('dita/') . $blog_post['slug'] . '.html';

                //htmlを書き出し
                if (!\File::copy($path_to_htmltemp, $target_html_path)) {
                    return redirect()->back()->withInput()->withErrors('HTMLの書き出しに失敗しました。');
                }

                //ファイル名をutf8に変更
                $target_html_path=mb_convert_encoding($target_html_path, "utf8", "auto");

                //コピーしたテンプレートにHTMLを出力
                file_put_contents($target_html_path, $target_data);

                //外部関数を使ってHTMLをDITAに変換(トピック名のみを渡す)(PDFのみ）
                //\Artisan::call('convert:xml ' . $blog_post['id']  . '.html');
                \Artisan::call('convert:xml ' . $blog_post['slug']  . '.html');
                //$dita_path = storage_path('dita/') . $blog_post['id']. '.html.dita';
                $dita_path = storage_path('dita/') . $blog_post['slug']. '.html.dita';

                if(!file_exists($dita_path)){
                    return redirect()->back()->withInput()->withErrors('DITAの書き出しに失敗しました。');
                }

                //作成したditaファイルのパス一覧
                $to_be_deleted[]=$dita_path;

                //作成したHTMLのパス一覧
                $to_be_deleted[]=$target_html_path;

            }

        }

        //bookの概要説明を取得
        $desc_buf=$book['book_description'];

        //book_descriptionの特殊文字置き換え(PDFの時のみ)
        $desc_buf=str_replace('&','&amp;',$desc_buf);

        //bookmapを作成するためのHTMLを準備
        $book_map = preg_replace('/<ul><\/ul>/', '', $book_map);
        $book_map = preg_replace('/^/', $html_declaration . '<book book_slug="' . $book['slug'] . '" book_name="' . $book['book_name'] . '" book_description="' . $desc_buf . '"><ul>', $book_map);
        $book_map = preg_replace('/$/', '</ul></book>', $book_map);

        //html用テンプレートをコピー
        $path_to_htmltemp = storage_path('dita/template.html');
        $target_html_path = storage_path('dita/') . $book['slug'] . '_map.html';

        if (!\File::copy($path_to_htmltemp, $target_html_path)) {
            return redirect()->back()->withInput()->withErrors('MAPの書き出しに失敗しました。');
        }

        //HTML状のMAPファイルを作成し、ファイル名をutf8に
        $target_html_path=mb_convert_encoding($target_html_path, "utf8", "auto");
        $to_be_deleted[]=$target_html_path;//後で削除するリストに追加

        //コピーしたテンプレートにHTMLを出力
        file_put_contents($target_html_path, $book_map);

        //PDF変換
        //外部関数を使ってHTMLをDITAmapに変換(ファイル名のみを渡す)
        if($mapType==0){
            //契約書
            Artisan::call('convert:ditamap ' . $book['slug'] . '_map.html ' . 'map');
        }else{
            //規約、取説
            Artisan::call('convert:ditamap ' . $book['slug'] . '_map.html ' . 'bookmap');
        }

        //ditamapファイルのパス
        $ditamap_path = storage_path('dita/') . $book['slug'] . '_map.html.ditamap';
        $to_be_deleted[]=$ditamap_path;//後で削除するリストに追加

        if(!file_exists($ditamap_path)){
            return redirect()->back()->withInput()->withErrors('DITAMAPの作成に失敗しました。');
        }
        
        //ditamapをpdfに変換
        switch($mapType){
            case 0://契約書
                Artisan::call('dita:print ' . $book['slug'] . '_map.html.ditamap ' . 'contract ' . $user_email);
                break;
            case 1://規約
                Artisan::call('dita:print ' . $book['slug'] . '_map.html.ditamap ' . 'rules '  . $user_email);
                break;
            case 2://取説
                Artisan::call('dita:print ' . $book['slug'] . '_map.html.ditamap ' . 'torisetu ' . $user_email);
                break;
        }

        $output_path = storage_path('dita/out/') . $book['slug'] . '_map.html.pdf';

        if(!file_exists($output_path)){

            //エラー時の対応
            Helpers::flash_message("PDFの作成に失敗しました");
            redirect()->route("book.view",['bookSlug'=>$book['slug']]);
        }

        //作成したhtmlとditaファイルは削除する
        foreach($to_be_deleted as $deleted){
            \File::delete($deleted);
        }

        return $output_path;
    }

    public function printHtml ($bookSlug, $mapType, $user_email) {
        //ブックの情報を表示
        Log::debug('Booklist>downloadHtml is called');

        //bookSlugをキーにブック情報を取得
        $book = Books::where("slug", $bookSlug)->firstOrFail();

        //デフォルトは0（契約書様式）
        if (\Request::has('mapType')) {
                $mapType = \Request::input('mapType');
        }

        //ブックに登録されているトピックの情報を取得
        if($book->book_structure == ""){
            //登録がない場合
            $structured_posts = "";
            $map_html="";
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

            //idから各トピックのhtmlを引き出して結合
            $book_body="";
            foreach($posts_arr as $single_id){
                $book_body=$book_body . "<h2 file_name=" . BlogEtcPost::find($single_id)->id ." id=" . BlogEtcPost::find($single_id)->slug . ">" . BlogEtcPost::find($single_id)->title . "</h2>" . BlogEtcPost::find($single_id)->post_body;
            }
        }

        //maptype別CSSの定義
        switch($mapType){
            case 0:
                $cssname = '<link href="css/blogBodyContentContract.css" rel="stylesheet">';
                break;

            case 1:
                $cssname = '<link href="css/blogBodyContentRule.css" rel="stylesheet">';
                break;

            case 2:
                $cssname = '<link href="css/blogBodyContentManual.css" rel="stylesheet">';
                break;
        }

        //HTMLのヘッダー
        $header = '<!DOCTYPE html>
                    <html lang="ja">
                        <head>
                            <meta charset="utf-8">
                            <meta name="viewport" content="width=device-width, initial-scale=1">
                            <title>R&amp;D</title>
                            <link rel="dns-prefetch" href="//fonts.gstatic.com">
                            <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
                            <link href="css/app.css" rel="stylesheet">' . $cssname .
                            '
                            <style>
                                .b_frame{
                                    border: 1;
                                    width: 400px;
                                    height: 530px;
                                    display: block;
                                    position: fixed;
                                    bottom: 60px;
                                    right: 10px;
                                }
                                .button_for_chat{
                                    position: fixed;
                                    bottom: 10px;
                                    right: 10px;
                                    padding: 6px 6px;
                                }
                            </style>
                        </head><body><div class="blog_body_content">';

        $booktitile = '<h1 class="blog_title">' . $book->book_name . '</h1>';
        $booksubtitle = '<h2 class="blog_subtitle">' . $book->book_description . '</h2>';

        $target_data = $header . $booktitile . $booksubtitle . $book_body . '</div></body></html>';

        //htmlフォルダを作成
        $dt = Carbon::now();
        $timestamp = $dt->timestamp;
        $target_path = storage_path('dita/html_' . $timestamp);
        \File::makeDirectory($target_path);

        //html用テンプレートをコピー
        $path_to_htmltemp = storage_path('dita/template.html');
        $target_html_path = $target_path . '/' . $book->book_name . '.html';
        if (!\File::copy($path_to_htmltemp, $target_html_path)) {
            return redirect()->back()->withInput()->withErrors('HTMLの書き出しに失敗しました。');
        }

        //ファイル名をutf8に変更
        $target_html_path = mb_convert_encoding($target_html_path, "utf8", "auto");

        //コピーしたテンプレートにHTMLを出力
        file_put_contents($target_html_path, $target_data);

        //zip作成
        $save_path = storage_path('dita/' . $book->book_name . '-' . $timestamp .  '.zip');
        $zip = new \ZipArchive();
        $zip->open($save_path, \ZipArchive::CREATE);

        // htmlファイルを追加
        $zip->addFile($target_html_path, 'html/' . $book->book_name . '.html');

        // cssファイルを追加
        $zip->addFile(public_path('css/app.css'), 'html/css/app.css');

        //ドメインでCSSを分ける
        if(strpos($user_email,'@daitecjp.com')!==false){
            //daitecjp
            //maptype別のCSSを追加
            switch($mapType){
            case 0:
                $zip->addFile(public_path('css/blogBodyContentContract.css'), 'html/css/blogBodyContentContract.css');
                break;

            case 1:
                $zip->addFile(public_path('css/blogBodyContentRule.css'), 'html/css/blogBodyContentRule.css');

                break;

            case 2:
                $zip->addFile(public_path('css/blogBodyContentManual.css'), 'html/css/blogBodyContentManual.css');
                break;
        }
        }else{
            //それ以外
            //maptype別のCSSを追加
            $zip->addFile(public_path('css/Sample.png'), 'html/css/Sample.png');
            switch($mapType){
                case 0:
                    $zip->addFile(public_path('css/blogBodyContentContractw.css'), 'html/css/blogBodyContentContract.css');
                    break;
    
                case 1:
                    $zip->addFile(public_path('css/blogBodyContentRulew.css'), 'html/css/blogBodyContentRule.css');
    
                    break;
    
                case 2:
                    $zip->addFile(public_path('css/blogBodyContentManualw.css'), 'html/css/blogBodyContentManual.css');
                    break;
            }
        }

        $zip->close();

        //htmlフォルダを削除
        \File::deleteDirectory($target_path);

        //ZIPのパスをリターンする
        return $save_path;

    }

    

}
