<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Services\v1\_WebService;
use Illuminate\Http\Request;

class _WebController extends Controller
{
    private $service;

    public function __construct(_WebService $service)
    {
        $this->service = $service;
    }

    public function post($category, $post)
    {
        return $this->service->post($category, $post);
    }

    public function reactions()
    {
        return $this->service->reactions();
    }

    public function reactionPost($id)
    {
        return $this->service->reactionPost($id);
    }

    public function pollReactionPost($post, $reaction)
    {
        return $this->service->pollReactionPost($post, $reaction);
    }

    public function category($category)
    {
        return $this->service->category($category);
    }
    public function categories()
    {
        return $this->service->categories();
    }

    public function tag($tag)
    {
        return $this->service->tag($tag);
    }


    public function editais($id, $edital)
    {
        return $this->service->tag($id, $edital);
    }

    public function lastsPosts()
    {
        return $this->service->lastsPosts();
    }

    public function mostAccessedDay()
    {
        return $this->service->mostAccessedDay();
    }
    public function mostAccessedWeek()
    {
        return $this->service->mostAccessedWeek(); 
    }

    public function allPosts()
    {
        return $this->service->allPosts();
    }

    public function allPostsAllTime()
    {
        return $this->service->allPostsAllTime();
    }

    public function fixedPosts()
    {
        return $this->service->fixedPosts();
    }

    public function lastsPostsCategory($category)
    {
        return $this->service->lastsPostsCategory($category);
    }

    public function lastsBanners()
    {
        return $this->service->lastsBanners();
    }

    public function search(Request $request) {
        // return $request;
        return $this->service->search($request);
    }


}
