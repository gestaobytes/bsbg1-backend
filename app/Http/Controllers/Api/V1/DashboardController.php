<?php

namespace App\Http\Controllers\Api\v1;

use Analytics;
use Carbon\Carbon;
use App\Models\Post;
use Spatie\Analytics\Period;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;

class DashboardController extends Controller
{

    public function analytics(Request $request)
    {
        $consultDays = 30;

        $postTotal = Post::select('id')->count();

        $postMonth = Post::select('id')
            ->whereDate('created_at', '>', Carbon::now()->subDays($consultDays)->format('Y-m-d'))
            ->whereDate('created_at', '<', Carbon::now()->addDay()->format('Y-m-d'))
            ->count();

        $postWeak = Post::select('id')
            ->whereDate('created_at', '>', Carbon::now()->subDays(7)->format('Y-m-d'))
            ->whereDate('created_at', '<', Carbon::now()->addDay()->format('Y-m-d'))
            ->count();

        $postDay = Post::select('id')
            ->whereDate('created_at', Carbon::now()->format('Y-m-d'))
            ->count();



        $topPages = Analytics::fetchMostVisitedPages(Period::days($consultDays), 12);
        $topPages = $topPages->whereNotIn('url', ['/']);

        /** páginas mais visitadas*/

        $howGetHere = Analytics::fetchTopReferrers(Period::days($consultDays), 100);
        $google = $howGetHere->whereIn('url', ['google', 'news.google.com/'])->sum('pageViews');
        $facebook = $howGetHere->whereIn('url', ['m.facebook.com/', 'facebook.com/', 'l.facebook.com/'])->sum('pageViews');
        $instagram = $howGetHere->whereIn('url', ['m.instagram.com/', 'instagram.com/', 'l.instagram.com/'])->sum('pageViews');
        $linkedin = $howGetHere->whereIn('url', ['m.linkedin.com/', 'linkedin.com/', 'l.linkedin.com/'])->sum('pageViews');
        $direct = $howGetHere->whereIn('url', ['(direct)', ''])->sum('pageViews');

        $sumHowGetHere = $facebook + $instagram + $linkedin + $direct + $google;
        $percentDirect = number_format((($direct / $sumHowGetHere) * 100), 2, '.', '');
        $percentGoogle = number_format((($google / $sumHowGetHere) * 100), 2, '.', '');
        $percentFacebook = number_format((($facebook / $sumHowGetHere) * 100), 2, '.', '');
        $percentInstagram = number_format((($instagram / $sumHowGetHere) * 100), 2, '.', '');
        $percentLinkedin = number_format((($linkedin / $sumHowGetHere) * 100), 2, '.', '');

        $visitors = Analytics::fetchUserTypes(Period::days($consultDays));
        $newVisitor = $visitors->whereIn('type', ['New Visitor'])->sum('sessions');
        $returnVisitor = $visitors->whereIn('type', ['Returning Visitor'])->sum('sessions');

        $sumVisitors = $newVisitor + $returnVisitor;
        $percentNewVisitor = number_format((($newVisitor / $sumVisitors) * 100), 1, '.', '');
        $percentReturnVisitor = number_format((($returnVisitor / $sumVisitors) * 100), 1, '.', '');

        $data = [
            'google' => $google,
            'facebook' => $facebook,
            'instagram' => $instagram,
            'linkedin' => $linkedin,
            'direct' => $direct,
            'news' => $newVisitor,
            'return' => $returnVisitor,
            'percentDirect' => $percentDirect,
            'percentGoogle' => $percentGoogle,
            'percentFacebook' => $percentFacebook,
            'percentInstagram' => $percentInstagram,
            'percentLinkedin' => $percentLinkedin,
            'percentNewVisitor' => $percentNewVisitor,
            'percentReturnVisitor' => $percentReturnVisitor,
            'postDay' => $postDay,
            'postWeak' => $postWeak,
            'postMonth' => $postMonth,
            'postTotal' => $postTotal,
            'topPages' => $topPages,
        ];

        return $data;
    }
}
