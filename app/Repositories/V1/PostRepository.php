<?php

namespace App\Repositories\v1;

use App\Models\Post;
use App\Models\Accesse;
use App\Models\Reaction;
use Illuminate\Support\Str;
use App\Models\ReactionPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
// use GrahamCampbell\Flysystem\FlysystemManager;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use App\Interfaces\v1\PostInterface;
use Illuminate\Support\Facades\Storage;
/** cast */

class PostRepository implements PostInterface
{
    private $model, $reaction, $accesse, $reactionPost, $request;


    public function __construct(Post $model, Reaction $reaction, Accesse $accesse, ReactionPost $reactionPost, Request $request)
    {
        $this->model = $model;
        $this->reaction = $reaction;
        $this->accesse = $accesse;
        $this->reactionPost = $reactionPost;
        $this->request = $request;
    }

    public function index()
    {
        $dts = isset($_GET['dts']) ? $_GET['dts'] . ' 00:00:00' : '2010-01-01 00:00:00';
        $dtf = isset($_GET['dtf']) ? $_GET['dtf'] . ' 00:00:00' : date('Y-m-d') . ' 23:59:59';
        $keywordsSearch = isset($_GET['q']) ? $_GET['q'] : "";
        $keywords = $keywordsSearch;

        $pgLimit = isset($_GET['limit']) ? $_GET['limit'] : 50;
        $sortField = isset($_GET['sort']) ? $_GET['sort'] : '-posts.id,posts.titleadapter';
        $fieldsToSelect = isset($_GET['fields']) ? $_GET['fields'] : 'categories.slug as slugCategory,posts.id,posts.retracts,posts.titleadapter,posts.title,posts.slug,posts.subtitle,image';

        $sortField = explode(",", $sortField);
        $fieldsToSelect = explode(',', $fieldsToSelect);
        $qtdSort = count($sortField);

        $orderBy = "";
        for ($i = 0; $i < $qtdSort; $i++) {
            $sinal = substr($sortField[$i], 0, 1);
            $orderBy .= ($sinal == '-') ? substr($sortField[$i], 1) . " desc," : "$sortField[$i] asc,";
        }
        $orderBy = rtrim($orderBy, ',');

        $post = $this->model->select($fieldsToSelect)
            ->leftJoin('subcategories', 'subcategories.id', 'posts.subcategory_id')
            ->leftJoin('categories', 'categories.id', 'subcategories.category_id')
            ->whereBetween('posts.created_at', [$dts, $dtf]);




        if (isset($keywords) && $keywords != '') {

            if (isset($dataForm['e']) && ($dataForm['e'] == 'yes')) {
                $search = "(posts.text like '%$keywords%') and (posts.titleadapter like '%$keywords%') and (posts.title like '%$keywords%')";
                $post->whereRaw("($search)");
            } else {
                $keywords = explode(" ", $keywords);
                $qtd = count($keywords);
                $search = "";
                for ($i = 0; $i < $qtd; $i++) {
                    $search .= "((titleadapter like '%$keywords[$i]%') or (posts.title like '%$keywords[$i]%')) and ";
                }
                $search = rtrim($search, ' and ');
                $post->whereRaw("($search)");
            }

            if (isset($subcategories) && $subcategories != '') {
                $post->whereIn('subcategory_id', $subcategories);
            }

            return $post->orderByRaw($orderBy)->paginate($pgLimit);
        }

        return $post->orderBy('id', 'desc')->limit(1000)->paginate($pgLimit);
        // $post = $post->orderByRaw($orderBy)->offset(0)->limit(1000)->get();
        // return $post->orderByRaw($orderBy)->get();
        // return $post->orderByRaw($orderBy)->paginate($pgLimit);

    }

    public function comboBox()
    {
        return $this->model->select('id', 'title')->get();
    }

    public function show(int $id)
    {
        return $this->model->where('id', $id)->get();
    }

    public function details(int $id)
    {
        return $this->model->find($id);
    }

    public function store(Request $request)
    {
        $dataForm = $request->all();
        $user_id = array('user_id' => Auth::user()->id) ? array('user_id' => Auth::user()->id) : array('user_id' => 1);
        $dataForm = array_merge($dataForm, $user_id);

        /** texto */
        $text = $dataForm['text'];
        unset($dataForm['text']);
        $text = $this->replaceTextPost($text);
        $text = str_ireplace(
            array('<img src='),
            array("<img class='img-post-text' src="),
            $text
        );
        $text = array('text' => $text);
        $dataForm = array_merge($dataForm, $text);

        /** slug */
        $slug = array('slug' => Str::slug($dataForm['title'], '-'));
        $dataForm = array_merge($dataForm, $slug);
        /** status */
        if (!isset($dataForm['status']) || $dataForm['status'] == '') {
            $status = array('status' => 1);
            $dataForm = array_merge($dataForm, $status);
        }
        /** restrict */
        if (!isset($dataForm['will_restrict_users']) || $dataForm['will_restrict_users'] == '') {
            $restrict = array('will_restrict_users' => 0);
            $dataForm = array_merge($dataForm, $restrict);
        }
        /** dateStart */
        if (!isset($dataForm['date_start']) || $dataForm['date_start'] == '') {
            $start = array('date_start' => date('Y-m-d'));
            $dataForm = array_merge($dataForm, $start);
        }

        $create = $this->model->create($dataForm);
        $accesse = $this->accesse->insert(['post_id' => $create->id, 'qtd' => 1]);

        if ($create && $accesse) {
            return true;
        } else {
            return false;
        }

    }

    public function update(int $id, Request $request)
    {
        $dataForm = $request->all();
        $text = $dataForm['text'];
        unset($dataForm['text']);
        $text = $this->replaceTextPost($text);
        // return $text;
        $text = array('text' => $text);
        $slug = array('slug' => Str::slug($dataForm['title'], '-'));
        $dataForm = array_merge($dataForm, $slug);
        $dataForm = array_merge($dataForm, $text);
        unset($dataForm['created_at'], $dataForm['updated_at'], $dataForm['deleted_at']);

        return $this->model->where('id', $id)->update($dataForm);
    }

    public function image(int $id, Request $request)
    {
        $post = $this->model->select('slug')->first($id);
        $dataForm = array('image_credit' => $request['image_credit']);
        // $legendForm = array('image_subtitle' => $request['image_subtitle']);
        // $credit =  Str::slug($request['image_credit'], '-');
        // $legend =  Str::slug($request['image_subtitle'], '-');

        // $nameImage = $post . "-foto:" . $credit . "_" . date('YmdHis');
        $nameImage = $post->slug . "_" . date('YmdHis');
        // $dataForm = array_merge($dataForm, $legendForm);

        if (isset($request['image']) && $request['image'] != "") {
            $img = $request['image'];
            unset($request['image']);

            $imageInfo = explode(";base64,", $img);
            $extension = str_replace('data:image/', '', $imageInfo[0]);
            $img = str_replace("data:image/$extension;base64,", '', $img);
            $img = str_replace(' ', '+', $img);
            $data = base64_decode($img);
            $image = Image::make($data)->encode('jpg');

            $image->resize(1200, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $image->fit('1200', '630');
            $thumb = $image->resize(400, 210, function ($constraint) {
                $constraint->aspectRatio();
            });

            $image->save(Storage::disk('gcs')->put("photos/$nameImage.jpg", "$image"));
            $thumb->save(Storage::disk('gcs')->put("thumbs/$nameImage.jpg", "$thumb"));

            $image = array('image' => "$nameImage.jpg");
            $dataForm = array_merge($dataForm, $image);
        } else {
            $image = array('image' => "$post->image");
            $dataForm = array_merge($dataForm, $image);
        }

        return $this->model->where('id', $id)->update($dataForm);
    }

    public function delete(int $id)
    {
        $model = $this->model->find($id);
        return $model->delete();
    }

    public function trash()
    {
        return $this->model->onlyTrashed()->get();
    }

    public function restore(int $id)
    {
        return $this->model->withTrashed()
            ->where('id', $id)
            ->restore();
    }

    public function replaceTextPost($content)
    {
        /** ***********************************************************
         * ATENÇÃO PARA O "\s" (espaço)"  e o "." (espaço ou caracter)
         **************************************************************/
        /** clear tags */
        // $content = preg_replace('"', "'", $content);

        $content = preg_replace('#<div.*?>(.*?)</div>#i', '\1', $content);
        $content = preg_replace('#<span.*?>(.*?)</span>#i', '\1', $content);
        $content = preg_replace('#<aside.*?>(.*?)</aside>#i', '\1', $content);
        $content = preg_replace('#<script.*?>(.*?)</script>#i', '', $content);
        /** alter tags */
        $content = preg_replace('#<h1.*?>(.*?)</h1>#i', '<h3>\1</h3>', $content);
        $content = preg_replace('#<h2.*?>(.*?)</h2>#i', '<h3>\1</h3>', $content);
        $content = preg_replace('#<h3.*?>(.*?)</h3>#i', '<h3>\1</h3>', $content);
        $content = preg_replace('#<h4.*?>(.*?)</h4>#i', '<h3>\1</h3>', $content);
        $content = preg_replace('#<h5.*?>(.*?)</h5>#i', '<h3>\1</h3>', $content);
        $content = preg_replace('#<h6.*?>(.*?)</h6>#i', '<h3>\1</h3>', $content);
        /** clear styles */
        $content = preg_replace('#<p\s*?>(.*?)</p>#i', '<p>\1</p>', $content);
        $content = preg_replace('#<b\s*?>(.*?)</b>#i', '<b>\1</b>', $content);
        $content = preg_replace('#<i\s*?>(.*?)</i>#i', '<i>\1</i>', $content);
        $content = preg_replace('#<u\s*?>(.*?)</u>#i', '<u>\1</u>', $content);
        $content = preg_replace('#<s\s*?>(.*?)</s>#i', '<s>\1</s>', $content);
        $content = preg_replace('#<em.*?>(.*?)</em>#i', '<em>\1</em>', $content);
        $content = preg_replace('#<ol\s*?>(.*?)</ol>#i', '<ol>\1</ol>', $content);
        $content = preg_replace('#<ul\s*?>(.*?)</ul>#i', '<ul>\1</ul>', $content);
        $content = preg_replace('#<li\s*?>(.*?)</li>#i', '<li>\1</li>', $content);
        $content = preg_replace('#<strong.*?>(.*?)</strong>#i', '<b>\1</b>', $content);
        $content = preg_replace('#<blockquote.*?>(.*?)</blockquote>#i', '<blockquote>\1</blockquote>', $content);


        $content = preg_replace('#<iframe.*?(src=)(.*?)></iframe>#i', '<div class="video-responsive"><iframe class="ql-video" frameborder="0" allowfullscreen="true" width="560" height="349" \1\2></iframe>', $content);

        return $content;
    }
}
