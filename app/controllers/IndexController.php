<?php

class IndexController extends BaseController {

	public function news($id)
	{
                                   return View::make('index.news', array(
                                       'newsContent' => '这里是带HTML标签的正文内容'
                                   ));
	}

}
