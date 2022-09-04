<?Php 
        date_default_timezone_set('PRC');  

        $result =file_get_contents("./daily_multi.m3u8"); 
   
        $txt = "读取方式：file_get_contents </br> 更新时间 ：" .date('Y-m-d H:i:s');
        
  //         $ch = curl_init();
  //         $timeout = 30;
  //         curl_setopt($ch, CURLOPT_URL, "https://raw.iqiq.io/cxfksword/iptv/master/daily_multi.m3u8");
  //         curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  //         curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
  //         $result = curl_exec($ch);
  //         curl_close($ch);  
  //         $txt = "我是访问写";

      
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
         

        file_put_contents("my.json",json_encode($data,JSON_UNESCAPED_UNICODE));  
        file_put_contents("README.md",$txt);
        
     
