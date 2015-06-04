<?php

class BioController extends BaseController {

    public function getBioPage()
    {
        $slug = Request::segment(1);
        $page_title = "Not active";
        $page_content = "Either the page you have requested is not active, or it does not exist.";
        $meta = "";
        $meta_tags = "";
        $active = 0;
        $page_id = 0;

        //$results = DB::select('select * from pages where slug = ?', array($slug));
        $results = DB::table('pages')->where('slug', '=', $slug)->remember(525949)->get();
        $page_title = urldecode($page_title);

        foreach ($results as $result) {
            $active = $result->active;
            if (($active > 0) ||
                ((Auth::check()) && (Auth::user()->access_level == 3))
            ) {
                $page_title = $result->page_title;
                $page_content = $result->page_content;
                $meta = $result->meta;
                $page_id = $result->id;
                $meta_keywords = $result->meta_tags;
            }
        }

        $bios = Bios::orderBy('id')->get();

        return View::make('bios')
            ->with('page_title', $page_title)
            ->with('page_content', $page_content)
            ->with('meta', $meta)
            ->with('meta_tags', $meta_tags)
            ->with('active', $active)
            ->with('page_id', $page_id)
            ->with('bios', $bios);
    }


    public function getBios()
    {
        $bios = Bios::orderBy('bio_name')->get();

        return View::make('users.dashboard.bios')
            ->with('allbios', $bios);
    }

    public function getEditBio()
    {
        $bio = Bios::find(Request::segment(3));

        return View::make('users.dashboard.editbio')
            ->with('bio', $bio);
    }

    public function postEditBio()
    {
        $id = Input::get('id');
        $bio = Bios::find($id);
        $bio->bio_name = Input::get('bio_name');
        $bio->bio_text = Input::get('bio_text');
        $bio->save();

        Cache::flush();

        return Redirect::to('/admin/bios');

    }
}
