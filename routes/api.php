<?php

$router->get('/', function () use ($router) {
    return view('welcome');
});


$router->group(['prefix' => 'v1/'], function () use ($router) {

    $router->group(['prefix' => 'public/'], function ($router) {

        $router->get('/home', 'Api\v1\_HomeController@index');
        $router->get('/search', 'Api\v1\_WebController@search');
        // $router->get('/post01', 'Api\v1\_HomeController@post01');

        $router->get('/all-posts-all-time', 'Api\v1\_WebController@allPostsAllTime');
        $router->get('/reactions', 'Api\v1\_WebController@reactions');
        $router->get('/categories', 'Api\v1\_WebController@categories');
        $router->get('/lasts-posts', 'Api\v1\_WebController@lastsPosts');
        $router->get('/fixed-posts', 'Api\v1\_WebController@fixedPosts');
        $router->get('/all-posts', 'Api\v1\_WebController@allPosts');
        $router->get('/posts-highlight', 'Api\v1\_WebController@postsHighlight');
        $router->get('/lasts-banners', 'Api\v1\_WebController@lastsBanners');
        $router->get('/most-accessed-day', 'Api\v1\_WebController@mostAccessedDay');
        $router->get('/most-accessed-week', 'Api\v1\_WebController@mostAccessedWeek');


        $router->get('/lasts-posts/{category}', 'Api\v1\_WebController@lastsPostsCategory');
        $router->get('/editais/{id}/{edital}', 'Api\v1\_WebController@editais');
        $router->get('/tag/{tag}', 'Api\v1\_WebController@tag');
        $router->get('/{category}/{post}', 'Api\v1\_WebController@post');
        $router->get('/{category}', 'Api\v1\_WebController@category');
        $router->get('/reaction/post/{id}', 'Api\v1\_WebController@reactionPost');
        $router->post('/post/{post}/reaction/{reaction}', 'Api\v1\_WebController@pollReactionPost');

        $router->get('/lasts-posts/{category}', 'Api\v1\_WebController@lastsPostsCategory');
    });

    /** route with midleware api */
    $router->group(['middleware' => ['api']], function () use ($router) {

        $router->group(['prefix' => 'auth'], function ($router) {
            $router->post('/register', 'AuthController@register');
            $router->post('/signin', 'AuthController@login');
            $router->post('/logout', 'AuthController@logout');
            $router->post('/refresh', 'AuthController@refresh');
            $router->get('/me', 'AuthController@me');
            $router->post('/validateToken', 'AuthController@validateToken');
        });


        /** routes admin */
        $router->group(['prefix' => 'admin/'], function () use ($router) {

            $router->get('/analytics', 'Api\v1\DashboardController@analytics');


            $router->group(['prefix' => '/permissions'], function () use ($router) {
                $router->get('/', 'Api\v1\PermissionController@index');
                $router->get('/cb', 'Api\v1\PermissionController@comboBox');
                $router->get('/trash', 'Api\v1\PermissionController@trash');
                $router->post('/trash/{id}', 'Api\v1\PermissionController@restore');
                $router->get('/{id}', 'Api\v1\PermissionController@show');
                $router->get('/{id}/details', 'Api\v1\PermissionController@details');
                $router->post('/', 'Api\v1\PermissionController@store');
                $router->put('/{id}', 'Api\v1\PermissionController@update');
                $router->delete('/{id}', 'Api\v1\PermissionController@delete');

                $router->post('/roles', 'Api\v1\PermissionController@permissionRole');
                $router->delete('/roles/{id}', 'Api\v1\PermissionController@permissionRoleDelete');
            });

            $router->group(['prefix' => '/roles'], function () use ($router) {
                $router->get('/', 'Api\v1\RoleController@index');
                $router->get('/cb', 'Api\v1\RoleController@comboBox');
                $router->get('/trash', 'Api\v1\RoleController@trash');
                $router->post('/trash/{id}', 'Api\v1\RoleController@restore');
                $router->get('/{id}', 'Api\v1\RoleController@show');
                $router->get('/{id}/details', 'Api\v1\RoleController@details');
                $router->post('/', 'Api\v1\RoleController@store');
                $router->put('/{id}', 'Api\v1\RoleController@update');
                $router->delete('/{id}', 'Api\v1\RoleController@delete');

                $router->post('/users', 'Api\v1\RoleController@roleUser');
                $router->delete('/users/{id}', 'Api\v1\RoleController@roleUserDelete');
            });



            $router->group(['prefix' => '/users'], function () use ($router) {
                $router->get('/', 'Api\v1\UserController@index');
                $router->get('/cb', 'Api\v1\UserController@comboBox');
                $router->get('/trash', 'Api\v1\UserController@trash');
                $router->post('/trash/{id}', 'Api\v1\UserController@restore');
                $router->get('/{id}', 'Api\v1\UserController@show');
                $router->get('/{id}/details', 'Api\v1\UserController@details');
                $router->post('/', 'Api\v1\UserController@store');
                $router->put('/{id}', 'Api\v1\UserController@update');
                $router->put('/{id}/image', 'Api\v1\UserController@image');
                $router->delete('/{id}', 'Api\v1\UserController@delete');
            });






            /** routes of accesses */
            $router->group(['prefix' => '/accesses'], function () use ($router) {
                $router->get('/', 'Api\v1\AccesseController@index');
                $router->post('/search', 'Api\v1\AccesseController@search');
                $router->get('/trash', 'Api\v1\AccesseController@trash');
                $router->post('/trash/{id}', 'Api\v1\AccesseController@restore');
                $router->get('/{id}', 'Api\v1\AccesseController@show');
                $router->get('/{id}/details', 'Api\v1\AccesseController@details');
                $router->post('/', 'Api\v1\AccesseController@store');
                $router->put('/{id}', 'Api\v1\AccesseController@update');
                $router->delete('/{id}', 'Api\v1\AccesseController@delete');
            });

            /** routes of articles */
            $router->group(['prefix' => '/articles'], function () use ($router) {
                $router->get('/', 'Api\v1\ArticleController@index');
                $router->post('/search', 'Api\v1\ArticleController@search');
                $router->get('/trash', 'Api\v1\ArticleController@trash');
                $router->post('/trash/{id}', 'Api\v1\ArticleController@restore');
                $router->get('/{id}', 'Api\v1\ArticleController@show');
                $router->get('/{id}/details', 'Api\v1\ArticleController@details');
                $router->post('/', 'Api\v1\ArticleController@store');
                $router->put('/{id}', 'Api\v1\ArticleController@update');
                $router->delete('/{id}', 'Api\v1\ArticleController@delete');
            });

            /** routes of banners */
            $router->group(['prefix' => '/banners'], function () use ($router) {
                $router->get('/', 'Api\v1\BannerController@index');
                $router->post('/search', 'Api\v1\BannerController@search');
                $router->get('/trash', 'Api\v1\BannerController@trash');
                $router->post('/trash/{id}', 'Api\v1\BannerController@restore');
                $router->get('/{id}', 'Api\v1\BannerController@show');
                $router->get('/{id}/details', 'Api\v1\BannerController@details');
                $router->post('/', 'Api\v1\BannerController@store');
                $router->put('/{id}', 'Api\v1\BannerController@update');
                $router->delete('/{id}', 'Api\v1\BannerController@delete');
            });

            /** routes of categories */
            $router->group(['prefix' => '/categories'], function () use ($router) {
                $router->get('/', 'Api\v1\CategoryController@index');
                $router->get('/cb', 'Api\v1\CategoryController@comboBox');
                $router->post('/search', 'Api\v1\CategoryController@search');
                $router->get('/trash', 'Api\v1\CategoryController@trash');
                $router->post('/trash/{id}', 'Api\v1\CategoryController@restore');
                $router->get('/{id}', 'Api\v1\CategoryController@show');
                $router->get('/{id}/details', 'Api\v1\CategoryController@details');
                $router->post('/', 'Api\v1\CategoryController@store');
                $router->put('/{id}', 'Api\v1\CategoryController@update');
                $router->delete('/{id}', 'Api\v1\CategoryController@delete');
            });

            /** routes of columners */
            $router->group(['prefix' => '/columners'], function () use ($router) {
                $router->get('/', 'Api\v1\ColumnerController@index');
                $router->post('/search', 'Api\v1\ColumnerController@search');
                $router->get('/trash', 'Api\v1\ColumnerController@trash');
                $router->post('/trash/{id}', 'Api\v1\ColumnerController@restore');
                $router->get('/{id}', 'Api\v1\ColumnerController@show');
                $router->get('/{id}/details', 'Api\v1\ColumnerController@details');
                $router->post('/', 'Api\v1\ColumnerController@store');
                $router->put('/{id}', 'Api\v1\ColumnerController@update');
                $router->delete('/{id}', 'Api\v1\ColumnerController@delete');
            });

            /** routes of companies */
            $router->group(['prefix' => '/companies'], function () use ($router) {
                $router->get('/', 'Api\v1\CompanyController@index');
                $router->post('/search', 'Api\v1\CompanyController@search');
                $router->get('/trash', 'Api\v1\CompanyController@trash');
                $router->post('/trash/{id}', 'Api\v1\CompanyController@restore');
                $router->get('/{id}', 'Api\v1\CompanyController@show');
                $router->get('/{id}/details', 'Api\v1\CompanyController@details');
                $router->post('/', 'Api\v1\CompanyController@store');
                $router->put('/{id}', 'Api\v1\CompanyController@update');
                $router->delete('/{id}', 'Api\v1\CompanyController@delete');
            });

            /** routes of config-behaviors */
            $router->group(['prefix' => '/config-behaviors'], function () use ($router) {
                $router->get('/', 'Api\v1\ConfigBehaviorController@index');
                $router->post('/search', 'Api\v1\ConfigBehaviorController@search');
                $router->get('/trash', 'Api\v1\ConfigBehaviorController@trash');
                $router->post('/trash/{id}', 'Api\v1\ConfigBehaviorController@restore');
                $router->get('/{id}', 'Api\v1\ConfigBehaviorController@show');
                $router->get('/{id}/details', 'Api\v1\ConfigBehaviorController@details');
                $router->post('/', 'Api\v1\ConfigBehaviorController@store');
                $router->put('/{id}', 'Api\v1\ConfigBehaviorController@update');
                $router->delete('/{id}', 'Api\v1\ConfigBehaviorController@delete');
            });

            /** routes of config-emails */
            $router->group(['prefix' => '/config-emails'], function () use ($router) {
                $router->get('/', 'Api\v1\ConfigEmailController@index');
                $router->post('/search', 'Api\v1\ConfigEmailController@search');
                $router->get('/trash', 'Api\v1\ConfigEmailController@trash');
                $router->post('/trash/{id}', 'Api\v1\ConfigEmailController@restore');
                $router->get('/{id}', 'Api\v1\ConfigEmailController@show');
                $router->get('/{id}/details', 'Api\v1\ConfigEmailController@details');
                $router->post('/', 'Api\v1\ConfigEmailController@store');
                $router->put('/{id}', 'Api\v1\ConfigEmailController@update');
                $router->delete('/{id}', 'Api\v1\ConfigEmailController@delete');
            });

            /** routes of events */
            $router->group(['prefix' => '/events'], function () use ($router) {
                $router->get('/', 'Api\v1\EventController@index');
                $router->get('/cb', 'Api\v1\EventController@comboBox');
                $router->post('/search', 'Api\v1\EventController@search');
                $router->get('/trash', 'Api\v1\EventController@trash');
                $router->post('/trash/{id}', 'Api\v1\EventController@restore');
                $router->get('/{id}', 'Api\v1\EventController@show');
                $router->get('/{id}/details', 'Api\v1\EventController@details');
                $router->post('/', 'Api\v1\EventController@store');
                $router->put('/{id}', 'Api\v1\EventController@update');
                $router->delete('/{id}', 'Api\v1\EventController@delete');
            });

            /** routes of events */
            $router->group(['prefix' => '/events'], function () use ($router) {
                $router->get('/', 'Api\v1\EventController@index');
                $router->post('/search', 'Api\v1\EventController@search');
                $router->get('/trash', 'Api\v1\EventController@trash');
                $router->post('/trash/{id}', 'Api\v1\EventController@restore');
                $router->get('/{id}', 'Api\v1\EventController@show');
                $router->get('/{id}/details', 'Api\v1\EventController@details');
                $router->post('/', 'Api\v1\EventController@store');
                $router->put('/{id}', 'Api\v1\EventController@update');
                $router->delete('/{id}', 'Api\v1\EventController@delete');
            });

            /** routes of feature-postings */
            $router->group(['prefix' => '/feature-postings'], function () use ($router) {
                $router->get('/', 'Api\v1\FeaturePostingController@index');
                $router->post('/search', 'Api\v1\FeaturePostingController@search');
                $router->get('/trash', 'Api\v1\FeaturePostingController@trash');
                $router->post('/trash/{id}', 'Api\v1\FeaturePostingController@restore');
                $router->get('/{id}', 'Api\v1\FeaturePostingController@show');
                $router->get('/{id}/details', 'Api\v1\FeaturePostingController@details');
                $router->post('/', 'Api\v1\FeaturePostingController@store');
                $router->put('/{id}', 'Api\v1\FeaturePostingController@update');
                $router->delete('/{id}', 'Api\v1\FeaturePostingController@delete');
            });

            /** routes of features */
            $router->group(['prefix' => '/features'], function () use ($router) {
                $router->get('/', 'Api\v1\FeatureController@index');
                $router->get('/cb', 'Api\v1\FeatureController@comboBox');
                $router->post('/search', 'Api\v1\FeatureController@search');
                $router->get('/trash', 'Api\v1\FeatureController@trash');
                $router->post('/trash/{id}', 'Api\v1\FeatureController@restore');
                $router->get('/{id}', 'Api\v1\FeatureController@show');
                $router->get('/{id}/details', 'Api\v1\FeatureController@details');
                $router->post('/', 'Api\v1\FeatureController@store');
                $router->put('/{id}', 'Api\v1\FeatureController@update');
                $router->delete('/{id}', 'Api\v1\FeatureController@delete');
            });

            /** routes of layouts */
            $router->group(['prefix' => '/layouts'], function () use ($router) {
                $router->get('/', 'Api\v1\LayoutController@index');
                $router->post('/search', 'Api\v1\LayoutController@search');
                $router->get('/trash', 'Api\v1\LayoutController@trash');
                $router->post('/trash/{id}', 'Api\v1\LayoutController@restore');
                $router->get('/{id}', 'Api\v1\LayoutController@show');
                $router->get('/{id}/details', 'Api\v1\LayoutController@details');
                $router->post('/', 'Api\v1\LayoutController@store');
                $router->put('/{id}', 'Api\v1\LayoutController@update');
                $router->delete('/{id}', 'Api\v1\LayoutController@delete');
            });

            /** routes of options */
            $router->group(['prefix' => '/options'], function () use ($router) {
                $router->get('/', 'Api\v1\OptionController@index');
                $router->get('/cb', 'Api\v1\OptionController@comboBox');
                $router->post('/search', 'Api\v1\OptionController@search');
                $router->get('/trash', 'Api\v1\OptionController@trash');
                $router->post('/trash/{id}', 'Api\v1\OptionController@restore');
                $router->get('/{id}', 'Api\v1\OptionController@show');
                $router->get('/{id}/details', 'Api\v1\OptionController@details');
                $router->post('/', 'Api\v1\OptionController@store');
                $router->put('/{id}', 'Api\v1\OptionController@update');
                $router->delete('/{id}', 'Api\v1\OptionController@delete');
            });

            /** routes of photos */
            $router->group(['prefix' => '/photos'], function () use ($router) {
                $router->get('/', 'Api\v1\PhotoController@index');
                $router->post('/search', 'Api\v1\PhotoController@search');
                $router->get('/trash', 'Api\v1\PhotoController@trash');
                $router->post('/trash/{id}', 'Api\v1\PhotoController@restore');
                $router->get('/{id}', 'Api\v1\PhotoController@show');
                $router->get('/{id}/details', 'Api\v1\PhotoController@details');
                $router->post('/', 'Api\v1\PhotoController@store');
                $router->put('/{id}', 'Api\v1\PhotoController@update');
                $router->delete('/{id}', 'Api\v1\PhotoController@delete');
            });

            /** routes of positions */
            $router->group(['prefix' => '/positions'], function () use ($router) {
                $router->get('/', 'Api\v1\PositionController@index');
                $router->get('/cb', 'Api\v1\PositionController@comboBox');
                $router->post('/search', 'Api\v1\PositionController@search');
                $router->get('/trash', 'Api\v1\PositionController@trash');
                $router->post('/trash/{id}', 'Api\v1\PositionController@restore');
                $router->get('/{id}', 'Api\v1\PositionController@show');
                $router->get('/{id}/details', 'Api\v1\PositionController@details');
                $router->post('/', 'Api\v1\PositionController@store');
                $router->put('/{id}', 'Api\v1\PositionController@update');
                $router->delete('/{id}', 'Api\v1\PositionController@delete');
            });

            /** routes of position-banners */
            $router->group(['prefix' => '/position-banners'], function () use ($router) {
                $router->get('/', 'Api\v1\PositionBannerController@index');
                $router->get('/cb', 'Api\v1\PositionBannerController@comboBox');
                $router->post('/search', 'Api\v1\PositionBannerController@search');
                $router->get('/trash', 'Api\v1\PositionBannerController@trash');
                $router->post('/trash/{id}', 'Api\v1\PositionBannerController@restore');
                $router->get('/{id}', 'Api\v1\PositionBannerController@show');
                $router->get('/{id}/details', 'Api\v1\PositionBannerController@details');
                $router->post('/', 'Api\v1\PositionBannerController@store');
                $router->put('/{id}', 'Api\v1\PositionBannerController@update');
                $router->delete('/{id}', 'Api\v1\PositionBannerController@delete');
            });

            /** routes of posts */
            $router->group(['prefix' => '/posts'], function () use ($router) {
                $router->get('/', 'Api\v1\PostController@index');
                $router->get('/cb', 'Api\v1\PostController@comboBox');
                $router->post('/search', 'Api\v1\PostController@search');
                $router->get('/trash', 'Api\v1\PostController@trash');
                $router->post('/trash/{id}', 'Api\v1\PostController@restore');
                $router->get('/{id}', 'Api\v1\PostController@show');
                $router->get('/{id}/details', 'Api\v1\PostController@details');
                $router->post('/', 'Api\v1\PostController@store');
                $router->put('/{id}', 'Api\v1\PostController@update');
                $router->put('/{id}/image', 'Api\v1\PostController@image');
                $router->delete('/{id}', 'Api\v1\PostController@delete');
            });

            /** routes of printed-versions */
            $router->group(['prefix' => '/printed-versions'], function () use ($router) {
                $router->get('/', 'Api\v1\PrintedVersionController@index');
                $router->post('/search', 'Api\v1\PrintedVersionController@search');
                $router->get('/trash', 'Api\v1\PrintedVersionController@trash');
                $router->post('/trash/{id}', 'Api\v1\PrintedVersionController@restore');
                $router->get('/{id}', 'Api\v1\PrintedVersionController@show');
                $router->get('/{id}/details', 'Api\v1\PrintedVersionController@details');
                $router->post('/', 'Api\v1\PrintedVersionController@store');
                $router->put('/{id}', 'Api\v1\PrintedVersionController@update');
                $router->delete('/{id}', 'Api\v1\PrintedVersionController@delete');
            });

            /** routes of reactions */
            $router->group(['prefix' => '/reactions'], function () use ($router) {
                $router->get('/', 'Api\v1\ReactionController@index');
                $router->post('/search', 'Api\v1\ReactionController@search');
                $router->get('/trash', 'Api\v1\ReactionController@trash');
                $router->post('/trash/{id}', 'Api\v1\ReactionController@restore');
                $router->get('/{id}', 'Api\v1\ReactionController@show');
                $router->get('/{id}/details', 'Api\v1\ReactionController@details');
                $router->post('/', 'Api\v1\ReactionController@store');
                $router->put('/{id}', 'Api\v1\ReactionController@update');
                $router->delete('/{id}', 'Api\v1\ReactionController@delete');
            });

            /** routes of reaction-posts */
            $router->group(['prefix' => '/reaction-posts'], function () use ($router) {
                $router->get('/', 'Api\v1\ReactionPostController@index');
                $router->post('/search', 'Api\v1\ReactionPostController@search');
                $router->get('/trash', 'Api\v1\ReactionPostController@trash');
                $router->post('/trash/{id}', 'Api\v1\ReactionPostController@restore');
                $router->get('/{id}', 'Api\v1\ReactionPostController@show');
                $router->get('/{id}/details', 'Api\v1\ReactionPostController@details');
                $router->post('/', 'Api\v1\ReactionPostController@store');
                $router->put('/{id}', 'Api\v1\ReactionPostController@update');
                $router->delete('/{id}', 'Api\v1\ReactionPostController@delete');
            });

            /** routes of settings */
            $router->group(['prefix' => '/settings'], function () use ($router) {
                $router->get('/', 'Api\v1\SettingController@index');
                $router->post('/search', 'Api\v1\SettingController@search');
                $router->get('/trash', 'Api\v1\SettingController@trash');
                $router->post('/trash/{id}', 'Api\v1\SettingController@restore');
                $router->get('/{id}', 'Api\v1\SettingController@show');
                $router->get('/{id}/details', 'Api\v1\SettingController@details');
                $router->post('/', 'Api\v1\SettingController@store');
                $router->put('/{id}', 'Api\v1\SettingController@update');
                $router->delete('/{id}', 'Api\v1\SettingController@delete');
            });

            /** routes of social-columns */
            $router->group(['prefix' => '/social-columners'], function () use ($router) {
                $router->get('/', 'Api\v1\SocialColumnController@index');
                $router->post('/search', 'Api\v1\SocialColumnController@search');
                $router->get('/trash', 'Api\v1\SocialColumnController@trash');
                $router->post('/trash/{id}', 'Api\v1\SocialColumnController@restore');
                $router->get('/{id}', 'Api\v1\SocialColumnController@show');
                $router->get('/{id}/details', 'Api\v1\SocialColumnController@details');
                $router->post('/', 'Api\v1\SocialColumnController@store');
                $router->put('/{id}', 'Api\v1\SocialColumnController@update');
                $router->delete('/{id}', 'Api\v1\SocialColumnController@delete');
            });

            /** routes of social-media */
            $router->group(['prefix' => '/social-media'], function () use ($router) {
                $router->get('/', 'Api\v1\SocialMediaController@index');
                $router->post('/search', 'Api\v1\SocialMediaController@search');
                $router->get('/trash', 'Api\v1\SocialMediaController@trash');
                $router->post('/trash/{id}', 'Api\v1\SocialMediaController@restore');
                $router->get('/{id}', 'Api\v1\SocialMediaController@show');
                $router->get('/{id}/details', 'Api\v1\SocialMediaController@details');
                $router->post('/', 'Api\v1\SocialMediaController@store');
                $router->put('/{id}', 'Api\v1\SocialMediaController@update');
                $router->delete('/{id}', 'Api\v1\SocialMediaController@delete');
            });

            /** routes of subcategories */
            $router->group(['prefix' => '/subcategories'], function () use ($router) {
                $router->get('/', 'Api\v1\SubCategoryController@index');
                $router->get('/cb', 'Api\v1\SubCategoryController@comboBox');
                $router->post('/search', 'Api\v1\SubCategoryController@search');
                $router->get('/trash', 'Api\v1\SubCategoryController@trash');
                $router->post('/trash/{id}', 'Api\v1\SubCategoryController@restore');
                $router->get('/{id}', 'Api\v1\SubCategoryController@show');
                $router->get('/{id}/details', 'Api\v1\SubCategoryController@details');
                $router->post('/', 'Api\v1\SubCategoryController@store');
                $router->put('/{id}', 'Api\v1\SubCategoryController@update');
                $router->delete('/{id}', 'Api\v1\SubCategoryController@delete');
            });

            /** routes of subcategories */
            $router->group(['prefix' => '/blogs'], function () use ($router) {
                $router->get('/', 'Api\v1\BlogController@index');
                $router->get('/cb', 'Api\v1\BlogController@comboBox');
                $router->post('/search', 'Api\v1\BlogController@search');
                $router->get('/trash', 'Api\v1\BlogController@trash');
                $router->post('/trash/{id}', 'Api\v1\BlogController@restore');
                $router->get('/{id}', 'Api\v1\BlogController@show');
                $router->get('/{id}/details', 'Api\v1\BlogController@details');
                $router->post('/', 'Api\v1\BlogController@store');
                $router->put('/{id}', 'Api\v1\BlogController@update');
                $router->delete('/{id}', 'Api\v1\BlogController@delete');
            });

            /** routes of videos */
            $router->group(['prefix' => '/videos'], function () use ($router) {
                $router->get('/', 'Api\v1\VideoController@index');
                $router->post('/search', 'Api\v1\VideoController@search');
                $router->get('/trash', 'Api\v1\VideoController@trash');
                $router->post('/trash/{id}', 'Api\v1\VideoController@restore');
                $router->get('/{id}', 'Api\v1\VideoController@show');
                $router->get('/{id}/details', 'Api\v1\VideoController@details');
                $router->post('/', 'Api\v1\VideoController@store');
                $router->put('/{id}', 'Api\v1\VideoController@update');
                $router->delete('/{id}', 'Api\v1\VideoController@delete');
            });

            /** routes of wishes */
            $router->group(['prefix' => '/wishes'], function () use ($router) {
                $router->get('/', 'Api\v1\WisheController@index');
                $router->post('/search', 'Api\v1\WisheController@search');
                $router->get('/trash', 'Api\v1\WisheController@trash');
                $router->post('/trash/{id}', 'Api\v1\WisheController@restore');
                $router->get('/{id}', 'Api\v1\WisheController@show');
                $router->get('/{id}/details', 'Api\v1\WisheController@details');
                $router->post('/', 'Api\v1\WisheController@store');
                $router->put('/{id}', 'Api\v1\WisheController@update');
                $router->delete('/{id}', 'Api\v1\WisheController@delete');
            });
        });
        /** routes admin */
    });
    /** route with midleware api */
});
