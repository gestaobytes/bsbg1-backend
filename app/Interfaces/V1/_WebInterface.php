<?php

namespace App\Interfaces\v1;

use Illuminate\Http\Request;

interface _WebInterface {
    public function post($category, $post);
    public function reactions();
    public function reactionPost(int $id);
    public function pollReactionPost(int $post, int $reaction);
    
    public function category($category);
    public function categories();
    public function tag($tag);
    public function editais(int $id, $edital);
    public function lastsPosts();
    public function mostAccessedDay();
    public function mostAccessedWeek();
    public function allPosts();
    public function allPostsAllTime();
    public function fixedPosts();
    public function lastsPostsCategory($category);

    public function lastsBanners();
    public function search(Request $request);
}
