<?php

class CleanupController extends BaseController {

    public function __construct()
    {
        $this->beforeFilter('csrf', array('on' => 'post'));
        $this->beforeFilter('auth', array('on' => 'get'));
        $this->beforeFilter('auth', array('only' => 'post'));
    }

    public function getCleanup()
    {
        if (Auth::user()->access_level == 3) {
            return View::make('users.dashboard.cleanup-choose');
        } else {
            return View::make('users.dashboard.dashboard');
        }
    }

    public function getMarsh()
    {
        $page = Cleanup::find(1);

        return View::make('users.dashboard.edit-cleanup')
            ->with('page', $page);
    }


    public function postMarsh()
    {
        $page = Cleanup::find(1);
        $page = Cleanup::find(Input::get('id'));
        $page->title = Input::get('title');
        $page->above = Input::get('above');
        $page->below = Input::get('below');
        if (Input::hasFile('image')) {
            // get the file
            $file = Input::file('image');
            $destinationPath = base_path() . '/public/img/';
            $filename = str_random(10) . "_" . $file->getClientOriginalName();

            $upload_success = Input::file('image')->move($destinationPath, $filename);
            $page->image = $filename;
        }
        $page->save();
        return Redirect::to('/admin/cleanup/cleanup');
    }

    public function getRedhead()
    {
        $page = Cleanup::find(2);

        return View::make('users.dashboard.edit-cleanup')
            ->with('page', $page);
    }

    public function postReadhead()
    {
        $page = Cleanup::find(Input::get('id'));
        $page->title = Input::get('title');
        $page->above = Input::get('above');
        $page->below = Input::get('below');
        if (Input::hasFile('image')) {
            // get the file
            $file = Input::file('image');
            $destinationPath = base_path() . '/public/img/';
            $filename = str_random(10) . "_" . $file->getClientOriginalName();

            $upload_success = Input::file('image')->move($destinationPath, $filename);
            $page->image = $filename;
        }
        $page->save();
        return Redirect::to('/admin/cleanup/cleanup');
    }

}
