<?php

class NewsController extends BaseController {

    public function getDeleteitem(){
        $id = Input::get('id');
        Post::find($id)->delete();

        return Redirect::to('/admin/allnews');
    }
}
