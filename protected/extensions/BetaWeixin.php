<?php
class BetaWeixin extends BetaWeixin
{
    public function processRequest()
    {
        if ($this->isTextMsg())
            $this->textMsgRequest();
        elseif ($this->isEventMsg()) {
            if ($this->isSubscribeEvent())
                $this->subscribe();
            elseif ($this->isUnsubscribeEvent())
                $this->unsubscribe();
            elseif ($this->isMenuClickEvent())
                $this->menuClick();
            else
                $this->unSupportEvent();
        }
        else
            $this->unSupportMsgType();
    
        exit(0);
    }
    
    private function textMsgRequest()
    {
        $subscribeMessage = 'subscribe';
        $input = strtolower(trim($this->_data->Content));
    
        if ($input == $subscribeMessage) {
            $this->welcome();
            exit(0);
        }
        
        if (is_numeric($input)) {
            $method = 'method_' . $input[0]; // 取第一个数字
            $result = false;
            if (method_exists($this, $method)) {
                if (false === call_user_func(array($this, $method)))
                    self::error();
            }
            else
                $this->method_0();
        
            exit(0);
        }
    
        $method = 'method_' . strtolower($input);
        if (method_exists($this, $method)) {
            if (call_user_func(array($this, $method)) === false)
                $this->error();
        }
        elseif (mb_strlen($input, app()->charset) > self::POST_JOKE_CONTENT_MIN_LEN)
            $this->postJoke();
        else
            $this->method_0();
    }
    
    public function errorException(Exception $e)
    {
//         $log = sprintf('%s - %s - %s - %s', $e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
//         file_put_contents(app()->runtimePath . '/wx2.txt', $log);
    }
    
    /**
     * 用户关注时消息处理
     */
    private function welcome()
    {
        $text = "没错！这里就是要啥有啥，想啥有啥的挖段子微信大本营！\n\n您有推荐的冷笑话或、搞笑图片或有意思的视频欢迎直接微信投稿，也可以发送给我们与大家一起分享哟～" . self::helpInfo();
        $xml = $this->outputText($text);
        header('Content-Type: application/xml');
        echo $xml;
    }
    
    /**
     * 用户订阅时消息处理，目前官方未启用
     */
    private function subscribe()
    {
        $text = "没错！这里就是要啥有啥，想啥有啥的挖段子微信大本营！\n\n您有推荐的冷笑话或、搞笑图片或有意思的视频欢迎直接微信投稿，也可以发送给我们与大家一起分享哟～" . self::helpInfo();
        $xml = $this->outputText($text);
        header('Content-Type: application/xml');
        echo $xml;
    }
    
    /**
     * 用户取消订阅时消息处理，目前官方未启用
     */
    private function unsubscribe()
    {
        $text = "Sorry，我们的服务留住了您的过去，却没能留住您的将来，请给我们提些建议吧，让我们做的更好！\n";
        $xml = $this->outputText($text);
        header('Content-Type: application/xml');
        echo $xml;
    }
    
    /**
     * 接收到业务程序不能处理的消息时的事件处理
     */
    private function unSupportMsgType()
    {
        $text = "Sorry，我们现在还不支持关键字搜索、图片上传和地理位置消息查询。" . self::helpInfo();
        $xml = $this->outputText($text);
        header('Content-Type: application/xml');
        echo $xml;
    }
    
    /**
     * 接收到业务程序不能处理的事件时事件处理
     */
    private function unSupportEvent()
    {
        $text = "Sorry，我们收到了一个无法识别的事件请求，请您关闭微信进程，重新启动微信试试。" . self::helpInfo();
        $xml = $this->outputText($text);
        header('Content-Type: application/xml');
        echo $xml;
    }
    
    private function method_1()
    {
    }
    
    private function method_2()
    {
    }
    
    private function method_0()
    {
        $text = '这里的帮助文字';
        $xml = $this->outputText($text);
        header('Content-Type: application/xml');
        echo $xml;
    }
    
    private static function helpInfo($classic = false)
    {
        $text = "\n\n-------------------------\n";
        if ($classic)
            $text .= "回复 0 查看帮助\n";
        else {
            $text .= "①回复 1 查看笑话\n";
            $text .= "②回复 2 查看趣图\n";
            $text .= "③回复 0 查看帮助\n";
            $text .= "\n喜欢我们就召唤好友添加'挖段子'或'waduanzi'为好友关注我们吧！";
        }
        
        return $text;
    }
    
    private static function error()
    {
        $text = '系统接口整在升级中，请稍候再试。。。' . self::helpInfo();
        $xml = $this->outputText($text);
        header('Content-Type: application/xml');
        echo $xml;
    }
}

// ①②③④⑤⑥⑦⑧⑨⑩


