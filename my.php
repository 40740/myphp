<?Php 
//         $loginUrl ="https://github.com/cxfksword/iptv/raw/master/daily_multi.m3u8";

//         $ch = curl_init();
//         curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
//         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//         curl_setopt($ch, CURLOPT_URL,$loginUrl);
//         $result=curl_exec($ch);
//         curl_close($ch); //关闭访问,释放资源 

        $result =file_get_contents("https://hub.nuaa.cf/cxfksword/iptv/raw/master/daily_multi.m3u8"); 

        file_put_contents("momo.json", $result."创建时间 ：" + $currenttime);  
        
        $v = explode('#EXTINF',$result); //拆 $ 符号为数组   
        
        unset($v[0]); //删掉第一项
        
        $data = [];
        
        foreach ($v as $value) {
            
            $t = explode("\n",$value); //把字符串以回车符号 分为数组
            
            //  //获取 台名称
             $isMatched = preg_match('/(?<= tvg-name=")(.+?)(?=" tvg-logo=)/', $t[0], $matches);  
             
             //台名称 
             
            //  $matches[0];
            
            // 
            
                 $json = 
                      [
                        "uniacid" =>3, 
                        "name"=> $matches[0],
                        "sort"=> "0", //分类 0 为电视台页 1 为连续剧  2  为手机视频
                      "pic"=> "0",
                      "playIndex"=>"0", 
                      "isCache"=> "0",
                      "playtype"=> "1",
                      "progress" =>"0",
                      "chaoshi"=>"5000",
                      "ScreenScaleType"=> 0,
                      "piantou"=> "0",
                      "pianwei"=> 0,
                      "sourceKey"=>"push_agent",
                      "model"=> "tv",
                      "vod_play_from"=>"直连",
                      "phoneshow" =>0,
                      "vod_play_url"=>$t[1]
                      ];  
            
             array_push($data,$json);
          
        }
        
        
        date_default_timezone_set(PRC);     //将date函数默认时间设置中国区时间
        $currenttime=date("Y-m-d H:i:s");   //给变量赋值，调用date函数，格式为 年-月-日 时:分:秒

        file_put_contents("README.md", $data."创建时间 ：" + $currenttime);  
        
     
