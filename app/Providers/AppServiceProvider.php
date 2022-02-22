<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{



    public function register()
    {
        // $this->app->register(\Tymon\JWTAuth\Providers\LumenServiceProvider::class);
        // $this->app->register(\GrahamCampbell\Flysystem\FlysystemServiceProvider::class);

        $this->app->bind(
            'App\Interfaces\v1\UserInterface',
            'App\Repositories\v1\UserRepository'
        );
        $this->app->bind(
            'App\Interfaces\v1\RoleInterface',
            'App\Repositories\v1\RoleRepository'
        );
        $this->app->bind(
            'App\Interfaces\v1\PermissionInterface',
            'App\Repositories\v1\PermissionRepository'
        );
        $this->app->bind(
            'App\Interfaces\v1\AccesseInterface',
            'App\Repositories\v1\AccesseRepository'
        );
        $this->app->bind(
            'App\Interfaces\v1\ArticleInterface',
            'App\Repositories\v1\ArticleRepository'
        );
        $this->app->bind(
            'App\Interfaces\v1\BannerInterface',
            'App\Repositories\v1\BannerRepository'
        );
        $this->app->bind(
            'App\Interfaces\v1\CategoryInterface',
            'App\Repositories\v1\CategoryRepository'
        );
        $this->app->bind(
            'App\Interfaces\v1\ColumnerInterface',
            'App\Repositories\v1\ColumnerRepository'
        );
        $this->app->bind(
            'App\Interfaces\v1\CompanyInterface',
            'App\Repositories\v1\CompanyRepository'
        );
        $this->app->bind(
            'App\Interfaces\v1\ConfigBehaviorInterface',
            'App\Repositories\v1\ConfigBehaviorRepository'
        );
        $this->app->bind(
            'App\Interfaces\v1\ConfigEmailInterface',
            'App\Repositories\v1\ConfigEmailRepository'
        );
        $this->app->bind(
            'App\Interfaces\v1\EventInterface',
            'App\Repositories\v1\EventRepository'
        );
        $this->app->bind(
            'App\Interfaces\v1\FeatureInterface',
            'App\Repositories\v1\FeatureRepository'
        );
        $this->app->bind(
            'App\Interfaces\v1\FeaturePostingInterface',
            'App\Repositories\v1\FeaturePostingRepository'
        );
        $this->app->bind(
            'App\Interfaces\v1\LayoutInterface',
            'App\Repositories\v1\LayoutRepository'
        );
        $this->app->bind(
            'App\Interfaces\v1\OptionInterface',
            'App\Repositories\v1\OptionRepository'
        );
        $this->app->bind(
            'App\Interfaces\v1\PhotoInterface',
            'App\Repositories\v1\PhotoRepository'
        );
        $this->app->bind(
            'App\Interfaces\v1\PositionBannerInterface',
            'App\Repositories\v1\PositionBannerRepository'
        );
        $this->app->bind(
            'App\Interfaces\v1\PositionInterface',
            'App\Repositories\v1\PositionRepository'
        );
        $this->app->bind(
            'App\Interfaces\v1\PostInterface',
            'App\Repositories\v1\PostRepository'
        );
     
        $this->app->bind(
            'App\Interfaces\v1\PrintedVersionInterface',
            'App\Repositories\v1\PrintedVersionRepository'
        );
        $this->app->bind(
            'App\Interfaces\v1\ReactionInterface',
            'App\Repositories\v1\ReactionRepository'
        );
        $this->app->bind(
            'App\Interfaces\v1\ReactionPostInterface',
            'App\Repositories\v1\ReactionPostRepository'
        );
        $this->app->bind(
            'App\Interfaces\v1\SettingInterface',
            'App\Repositories\v1\SettingRepository'
        );
        $this->app->bind(
            'App\Interfaces\v1\SocialColumnInterface',
            'App\Repositories\v1\SocialColumnRepository'
        );
        $this->app->bind(
            'App\Interfaces\v1\SocialMediaInterface',
            'App\Repositories\v1\SocialMediaRepository'
        );
        $this->app->bind(
            'App\Interfaces\v1\SubCategoryInterface',
            'App\Repositories\v1\SubCategoryRepository'
        );
        $this->app->bind(
            'App\Interfaces\v1\BlogInterface',
            'App\Repositories\v1\BlogRepository'
        );
        $this->app->bind(
            'App\Interfaces\v1\VideoInterface',
            'App\Repositories\v1\VideoRepository'
        );
        $this->app->bind(
            'App\Interfaces\v1\WisheInterface',
            'App\Repositories\v1\WisheRepository'
        );
        $this->app->bind(
            'App\Interfaces\v1\_HomeInterface',
            'App\Repositories\v1\_HomeRepository'
        );
        $this->app->bind(
            'App\Interfaces\v1\_WebInterface',
            'App\Repositories\v1\_WebRepository'
        );
        $this->app->bind(
            'Illuminate\Contracts\Filesystem\Factory',
            'Illuminate\Contracts\Filesystem\Factory'
        );
    }

    public function boot()
    {
        Schema::defaultStringLength(191);
    }
}