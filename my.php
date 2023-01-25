<?Php 

        $arrlist =  ["https://nowtv-new.xiaoyoureliao.cn/module_rec/page_module?_exp=0&tagId=9","https://nowtv-new.xiaoyoureliao.cn/module_rec/page_module?_exp=0&tagId=10"];
        
        foreach ($arrlist as $value) {
            
            
            $headerArray =array("Content-type:application/json;","Accept:application/json");
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $value);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); 
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE); 
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch,CURLOPT_HTTPHEADER,$headerArray);
            $output = curl_exec($ch);
            curl_close($ch); 
            
            $response = json_decode($output,1);
     
            $contents = $response['data']['channelModule']['contents'];
             
            foreach ($contents as $content){
                $image = file_get_contents($content['coverUrl']);
                if($image){
                    file_put_contents($content['tvName'].'.png',$image);
                }
            }
            
            
        }
          
        
        
         
