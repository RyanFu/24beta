<?php
class SiteController extends Controller
{
    public function filters()
    {
        return array(
            array(
                'COutputCache + index',
                'duration' => 120,
                'varyByParam' => array('page'),
                'varyByExpression' => array(user(), 'getIsGuest'),
                'requestTypes' => array('GET'),
            ),
        );
    }
    
    public function actionIndex($page = 1)
    {
        var_dump(app()->redis);
    }

}
