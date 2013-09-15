<?php
class SystemController extends Controller
{
    public function actionError()
    {
        $error = app()->errorHandler->error;
        if ($error) {
            if (request()->getIsAjaxRequest()) {
                $data['code'] = $error['code'];
                $data['message'] = $error['message'];
                echo CJSON::encode($data);
                exit(0);
            }
            else {
                $this->layout = 'error';
                $this->pageTitle = '错误 ' . $error['code'] . ' - ' . app()->name;
                $this->render('/system/error', $error);
            }
        }
    }
}