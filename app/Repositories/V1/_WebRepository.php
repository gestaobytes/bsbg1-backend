<?php

namespace App\Repositories\v1;

use App\Models\Post;
use App\Models\Accesse;
use App\Models\Reaction;
use App\Models\PositionBanner;
use App\Models\Banner;
use App\Models\ReactionPost;
use App\Models\Category;
use App\Interfaces\v1\_WebInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class _WebRepository implements _WebInterface
{
    private $post, $category, $accesse, $reactionPost, $reaction, $request, $banner, $positionBanner;

    public function __construct(
        Post $post,
        Category $category,
        Accesse $accesse,
        Reaction $reaction,
        PositionBanner $positionBanner,
        Banner $banner,
        ReactionPost $reactionPost,
        Request $request
    ) {
        $this->post = $post;
        $this->accesse = $accesse;
        $this->banner = $banner;
        $this->positionBanner = $positionBanner;
        $this->reaction = $reaction;
        $this->reactionPost = $reactionPost;
        $this->category = $category;
        $this->request = $request;
    }

    public function post($category, $post)
    {
        $article = $this->post
            ->leftJoin('subcategories', 'subcategories.id', 'posts.subcategory_id')
            ->leftJoin('categories', 'categories.id', 'subcategories.category_id')
            ->select(
                'categories.title as category',
                'categories.slug as slugCategory',
                'posts.id',
                'posts.retracts',
                'posts.title',
                'posts.titleadapter',
                'posts.slug',
                'posts.subtitle',
                'posts.text',
                'posts.image',
                'posts.image_credit',
                'posts.image_subtitle',
                'posts.tags',
                'posts.created_at',
                'posts.date_start'
            )
            ->where([['categories.slug', $category], ['posts.slug', $post]])
            ->first();

        $accesse = DB::table('accesses')->where('post_id', $article->id)->first();

        if (isset($accesse) && $accesse != null) {
            $qtd = DB::table('accesses')->select('qtd')->where('post_id', $article->id)->first();
            DB::table('accesses')->where('post_id', $accesse->post_id)->update(['qtd' => ($qtd->qtd) + 1, 'updated_at' => date('Y-m-d H:i:s')]);
        } else {
            DB::table('accesses')->insert(['post_id' => $article->id, 'qtd' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]);
        }


        $tags = $article->tags;
        $tags = str_replace("  ", " ", $tags);
        $tags = str_replace(" ,", ",", $tags);
        $tags = str_replace(", ", ",", $tags);
        $tagsArray = explode(',', $tags);

        $qtdTags = count($tagsArray);

        $search = "";
        for ($i = 0; $i < $qtdTags; $i++) {
            $search .= "(tags like '%$tagsArray[$i]%') or ";
        }
        $search = rtrim($search, ' or ');

        $relatedNews = $this->post
            ->leftJoin('subcategories', 'subcategories.id', 'posts.subcategory_id')
            ->leftJoin('categories', 'categories.id', 'subcategories.category_id')
            ->select(
                'categories.title as category',
                'categories.slug as slugCategory',
                'posts.retracts',
                'posts.titleadapter',
                'posts.slug',
                'posts.image',
                'posts.id',
            )
            ->where('posts.id', '<>', $article->id)
            ->whereRaw("($search)")->limit(5)->get();

        $data = [
            'article' => $article,
            'relatedNews' => $relatedNews,
            'tags' => $tags
        ];
        return $data;
    }

    public function reactions()
    {
        return $this->reaction
            ->select('id', 'slug', 'emoction', 'status')
            ->where('status', 'ON')
            ->get();
    }

    public function categories()
    {
        return $this->category
            ->select('id', 'title', 'slug')
            ->where('slug', '<>', 'home')
            ->where('slug', '<>', 'todas-as-paginas')
            ->where('slug', '<>', 'blogs')
            ->where('slug', '<>', 'colunas')
            ->where('slug', '<>', 'ultimas')
            ->where('slug', '<>', 'releases')
            ->orderBy('title')->get();
    }

    public function reactionPost($id)
    {
        return $this->reactionPost
            ->select('reaction_id', 'votes')
            ->where('post_id', $id)
            ->get();
    }

    public function pollReactionPost($post, $reaction)
    {
        $qtd = $this->reactionPost->select('votes')->where([['post_id', $post], ['reaction_id', $reaction]])->first();
        if (isset($qtd) && $qtd != null) {
            $qtd = ($qtd->votes) + 1;
            return $this->reactionPost->where([['post_id', $post], ['reaction_id', $reaction]])->update(['votes' => $qtd]);
        } else {
            return $this->reactionPost->insert(['post_id' => $post, 'reaction_id' => $reaction, 'votes' => 1]);
        }
    }

    public function category($category)
    {
        return $this->post
            ->leftJoin('subcategories', 'subcategories.id', 'posts.subcategory_id')
            ->leftJoin('categories', 'categories.id', 'subcategories.category_id')
            ->select(
                'categories.title as category',
                'categories.slug as slugCategory',
                'posts.id',
                'posts.retracts',
                'posts.titleadapter',
                'posts.slug',
                'posts.subtitle',
                'posts.image',
                'posts.tags',
                'posts.created_at',
                'posts.date_start'
            )
            ->where('categories.slug', $category)
            ->orderBy('posts.id', 'desc')
            ->paginate(10);
    }

    public function tag($tag)
    {
        $tag = ucfirst(rtrim($tag));

        return $this->post
            ->leftJoin('subcategories', 'subcategories.id', 'posts.subcategory_id')
            ->leftJoin('categories', 'categories.id', 'subcategories.category_id')
            ->select(
                'categories.title as category',
                'categories.slug as slugCategory',
                'posts.id',
                'posts.retracts',
                'posts.titleadapter',
                'posts.slug',
                'posts.subtitle',
                'posts.image',
                'posts.tags',
                'posts.created_at'
            )
            ->where('posts.tags', 'like', "%$tag%")
            ->orderBy('posts.id', 'desc')
            ->paginate(10);
    }

    public function editais(int $id, $edital)
    {
        return $this->post
            ->leftJoin('subcategories', 'subcategories.id', 'posts.subcategory_id')
            ->leftJoin('categories', 'categories.id', 'subcategories.category_id')
            ->select(
                'categories.title as category',
                'categories.slug as slugCategory',
                'posts.id',
                'posts.retracts',
                'posts.titleadapter',
                'posts.slug',
                'posts.subtitle',
                'posts.image',
                'posts.tags',
                'posts.created_at'
            )
            ->where([['categories.slug', 'editais'], ['posts.slug', $edital], ['posts.id', $id]])
            ->orderBy('posts.id', 'desc')
            ->first();
    }


    public function lastsPosts()
    {
        return $this->post
            ->leftJoin('subcategories', 'subcategories.id', 'posts.subcategory_id')
            ->leftJoin('categories', 'categories.id', 'subcategories.category_id')
            ->select(
                'categories.slug as slugCategory',
                'posts.id',
                'posts.retracts',
                'posts.titleadapter',
                'posts.slug',
                'posts.subtitle',
                'posts.image',
                'posts.created_at'
            )
            ->orderBy('posts.id', 'desc')
            ->limit(5)
            ->get();
    }

    public function mostAccessedDay()
    {
        $dts = date('Y-m-d') . 'T00:00:01.000000Z';

        return $this->post
            ->leftJoin('subcategories', 'subcategories.id', 'posts.subcategory_id')
            ->leftJoin('categories', 'categories.id', 'subcategories.category_id')
            ->leftJoin('accesses', 'posts.id', 'accesses.post_id')
            ->select(
                'categories.slug as slugCategory',
                'posts.retracts',
                'posts.titleadapter',
                'posts.slug',
                'accesses.qtd',
                'posts.created_at'
            )
            // ->whereBetween('accesses.updated_at', [$dts, $dtf])
            ->where('posts.created_at', '>', "$dts")
            ->orderBy('accesses.qtd', 'desc')
            ->limit(5)
            ->get();
    }

    public function mostAccessedWeek()
    {
        $dts = date('Y-m-d') . 'T00:00:01.000000Z';
        $dts = date('Y-m-d', strtotime('-7 days', strtotime($dts))) . 'T00:00:01.000000Z';
        $dtf = date('Y-m-d') . 'T23:59:59.000000Z';

        return $this->post
            ->leftJoin('subcategories', 'subcategories.id', 'posts.subcategory_id')
            ->leftJoin('categories', 'categories.id', 'subcategories.category_id')
            ->leftJoin('accesses', 'posts.id', 'accesses.post_id')
            ->select(
                'categories.slug as slugCategory',
                'posts.retracts',
                'posts.titleadapter',
                'posts.slug',
                'accesses.qtd',
                'posts.created_at'
            )
            ->whereBetween('posts.created_at', [$dts, $dtf])
            ->orderBy('accesses.qtd', 'desc')
            ->limit(5)
            ->get();
    }

    public function fixedPosts()
    {
        return $this->post
            ->leftJoin('subcategories', 'subcategories.id', 'posts.subcategory_id')
            ->leftJoin('categories', 'categories.id', 'subcategories.category_id')
            ->select(
                'categories.slug as slugCategory',
                'posts.id',
                'posts.position_id',
                'posts.retracts',
                'posts.titleadapter',
                'posts.slug',
                'posts.subtitle',
                'posts.image',
                'posts.created_at'
            )
            ->where('posts.image', '<>', null)
            ->where('posts.image', '<>', '')
            ->where('posts.position_id', 3)
            ->orderBy('posts.id', 'desc')
            ->limit(1)
            ->get();
    }

    public function allPosts()
    {
        $destak =  $this->post
            ->where('posts.image', '<>', null)
            ->where('posts.image', '<>', '')
            ->where('posts.position_id', 3)
            ->orderBy('posts.id', 'desc')
            ->first();

        return $this->post
            ->leftJoin('subcategories', 'subcategories.id', 'posts.subcategory_id')
            ->leftJoin('categories', 'categories.id', 'subcategories.category_id')
            ->select(
                'categories.slug as slugCategory',
                'posts.id',
                'posts.position_id',
                'posts.retracts',
                'posts.titleadapter',
                'posts.slug',
                'posts.subtitle',
                'posts.image',
                'posts.created_at'
            )
            ->where('posts.image', '<>', null)
            ->where('posts.image', '<>', '')
            ->where('posts.position_id', '<>', 2)
            ->where('posts.id', '<>', $destak->id)
            ->orderBy('posts.id', 'desc')
            ->limit(40)
            ->get();
    }

    public function allPostsAllTime()
    {
        return $this->post
            ->leftJoin('subcategories', 'subcategories.id', 'posts.subcategory_id')
            ->leftJoin('categories', 'categories.id', 'subcategories.category_id')
            ->select(
                'categories.slug as category',
                'posts.slug'
            )
            ->orderBy('posts.id', 'desc')
            ->get();
    }

    public function lastsPostsCategory($category)
    {
        $category = ucfirst(rtrim($category));
        return $this->post
            ->leftJoin('subcategories', 'subcategories.id', 'posts.subcategory_id')
            ->leftJoin('categories', 'categories.id', 'subcategories.category_id')
            ->select(
                'categories.title as category',
                'categories.slug as slugCategory',
                'posts.id',
                'posts.retracts',
                'posts.titleadapter',
                'posts.slug',
                'posts.subtitle',
                'posts.image',
                'posts.created_at'
            )
            ->where('categories.slug', 'like', "%$category%")
            ->orderBy('posts.id', 'desc')
            ->paginate(10);
    }

    public function lastsBanners()
    {
        $banners = $this->banner
            ->select('image', 'url')
            ->orderBy('order', 'asc')
            ->get();
        $qtd = $this->banner
            ->select('image', 'url')
            ->orderBy('order', 'asc')
            ->count();
        $data = [
            'banners' => $banners,
            'countBanners' => $qtd
        ];

        return $data;
    }

    public function search(Request $request)
    {
        $dataForm = $request->all();

        $dts = isset($dataForm['dts']) ? $dataForm['dts'] : '2010-01-01';
        $dtf = isset($dataForm['dtf']) ? $dataForm['dtf'] : date('Y-m-d');
        $keywordsSearch = $dataForm['q'];
        $keywords = $keywordsSearch;

        $pgLimit = isset($_GET['limit']) ? $_GET['limit'] : 10;
        $fieldsToSelect = isset($_GET['fields']) ? $_GET['fields'] : 'categories.slug as slugCategory,posts.id,posts.retracts,posts.titleadapter,posts.title,posts.slug,posts.subtitle,posts.tags,posts.image';


        $fieldsToSelect = explode(',', $fieldsToSelect);

        $sortField = isset($_GET['sort']) ? $_GET['sort'] : '-posts.id,posts.titleadapter';
        $sortField = explode(",", $sortField);
        $qtdSort = count($sortField);
        $orderBy = "";
        for ($i = 0; $i < $qtdSort; $i++) {
            $final = substr($sortField[$i], 0, 1);
            $orderBy .= ($final == '-') ? substr($sortField[$i], 1) . " - " : "$sortField[$i] - ";
            $descTrue = ($final == '-') ? 1 : 0;
        }
        $orderBy = rtrim($orderBy, ' - ');
        $orderBy .= ($descTrue == 1) ? " desc" : '';

        if (isset($dataForm['c']) && $dataForm['c'] != '') {
            $categories = $dataForm['c'];
            $categories = explode(',', $categories);
            $categories = $this->category->select('id')->whereIn('title', $categories)->get();
            $subcategories =  Arr::pluck($categories, 'id');
        }

        $post = $this->post->select($fieldsToSelect)
            ->leftJoin('subcategories', 'subcategories.id', 'posts.subcategory_id')
            ->leftJoin('categories', 'categories.id', 'subcategories.category_id')
            ->whereBetween('posts.created_at', [$dts, $dtf]);

        if (isset($keywords) && $keywords != '') {

            if (isset($dataForm['e']) && ($dataForm['e'] == 'yes')) {
                $search = "(posts.text like '%$keywords%') or (posts.titleadapter like '%$keywords%') or (posts.title like '%$keywords%')";
                $post->whereRaw("($search)");
            } else {
                $keywords = explode(" ", $keywords);
                $qtd = count($keywords);
                $search = "";
                for ($i = 0; $i < $qtd; $i++) {
                    $search .= "((text like '%$keywords[$i]%') or (titleadapter like '%$keywords[$i]%') or (posts.title like '%$keywords[$i]%')) or ";
                }
                $search = rtrim($search, ' or ');
                $post->whereRaw("($search)");
            }

            if (isset($subcategories) && $subcategories != '') {
                $post->whereIn('subcategory_id', $subcategories);
            }
        }

        return $post->orderByRaw($orderBy)->paginate($pgLimit);
    }
}
