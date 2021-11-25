<?php


namespace App\Services;
use LRedis;


class RealTimeService
{

    public function publishData($userId, $data,$type, $channelName){
        $redis = LRedis::connection();
       $res = $redis->publish($channelName, json_encode(['channel'=>$type,'data' => json_encode($data),'user_id' => $userId]));
    }
}
