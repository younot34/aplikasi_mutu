<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NavigateeController extends Controller
{
    public function navigatee(Request $request) {
        $pages = [
            'farmasis.grafik_fornas',
            'ppis.grafik_ppi_tahunan',
            'apds.grafik_apd_tahunan',
            'nilai_kritiss.grafik_lab_tahunan',
            'oks.grafik_op',
            'oks.grafik_sc',
            'ris.grafik_kep',
            'jatuhs.grafik_j',
            'visites.grafik_v',
            'clinicals.grafik_c',
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
