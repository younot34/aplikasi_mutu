<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NavigateController extends Controller
{
    public function navigate(Request $request) {
        $pages = [
            'imprs.grafik_doublecheck',
            'obat_racikans.grafik_or',
            'asess.grafik_ases',
            'rajals.grafik_rajal',
            'rmris.grafik_rmri',
            'rmrs.grafik_rmr',
            'oks.grafik_ssc',
            'ewss.grafik_e',
            'inters.grafik_in',
            'dpjps.grafik_dp',
            'monitorings.grafik_moni',
        ];

        $currentPageIndex = $request->session()->get('current_page_index', 0);

        if ($request->has('next') && isset($pages[$currentPageIndex + 1])) {
            $currentPageIndex++;
        }

        if ($request->has('back') && $currentPageIndex > 0) {
            $currentPageIndex--;
        }

        $request->session()->put('current_page_index', $currentPageIndex);

        return redirect()->route($pages[$currentPageIndex]);
    }

}
