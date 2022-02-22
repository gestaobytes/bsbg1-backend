<?php

namespace App\Repositories\v1;

use App\Models\Post;
use App\Models\Category;
use App\Interfaces\v1\_HomeInterface;
use Illuminate\Http\Request;

class _HomeRepository implements _HomeInterface
{
    private $post, $category, $request;

    public function __construct(Post $post, Category $category, Request $request)
    {
        $this->post = $post;
        $this->category = $category;
        $this->request = $request;
    }

    public function index()
    {
        return $this->post
            ->orderBy('id', 'desc')
            ->paginate(10);
    }

    public function post01()
    {
        $date = date('Y-m-d');
        return $this->post
            ->orderBy('id', 'desc')
            ->select('id', 'subcategory_id', 'titleadapter', 'slug', 'image', 'subtitle', 'status', 'date_start')
            ->where([['status', 'ON']])
            ->limit(1)
            ->get();
    }
}
