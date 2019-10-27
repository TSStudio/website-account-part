<?php
class get_system_hwinfo{
    private function get_system_load(){
        if(strtolower(PHP_OS) != 'linux'){
            return '';
        }
        $output = '';
        $result_status = '';
        $command = 'uptime';
        exec($command, $output, $result_status);
        if($result_status == 0){
            $arr = [];
            preg_match("/load average:\s+(.*)$/", reset($output), $arr);
            if(is_array($arr)){
                $loadStr = end($arr);
                $loadArr = explode(',', $loadStr);
                $load = [
                    '1min' => trim($loadArr[0]),
                    '5min' => trim($loadArr[1]),
                    '15min' => trim($loadArr[2]),
                ];
                return $load;
            }
        }
    }
    private function get_cpu_percent(){
        $mode = "/(cpu)[\s]+([0-9]+)[\s]+([0-9]+)[\s]+([0-9]+)[\s]+([0-9]+)[\s]+([0-9]+)[\s]+([0-9]+)[\s]+([0-9]+)[\s]+([0-9]+)/";
        $string=shell_exec("more /proc/stat");
        preg_match_all($mode,$string,$arr);
        $total1=$arr[2][0]+$arr[3][0]+$arr[4][0]+$arr[5][0]+$arr[6][0]+$arr[7][0]+$arr[8][0]+$arr[9][0];
        $time1=$arr[2][0]+$arr[3][0]+$arr[4][0]+$arr[6][0]+$arr[7][0]+$arr[8][0]+$arr[9][0];
        sleep(1);
        $string=shell_exec("more /proc/stat");
        preg_match_all($mode,$string,$arr);
        $total2=$arr[2][0]+$arr[3][0]+$arr[4][0]+$arr[5][0]+$arr[6][0]+$arr[7][0]+$arr[8][0]+$arr[9][0];
        $time2=$arr[2][0]+$arr[3][0]+$arr[4][0]+$arr[6][0]+$arr[7][0]+$arr[8][0]+$arr[9][0];
        $time=$time2-$time1;
        $total=$total2-$total1;
        $cpupercent=bcdiv($time,$total,3);
        $cpupercent*=100;
        return $cpupercent;
    }
    private function get_memory_percent(){
        $str=shell_exec("more /proc/meminfo");
        $mode="/(.+):\s*([0-9]+)/";
        preg_match_all($mode,$str,$arr);
        $meminfo=$arr;
        $pr=bcdiv($arr[2][2],$arr[2][0],3);
        $pr=1-$pr;
        $rampercent=$pr*100;
        return $rampercent;
    }
    public function get_all_info(){
        $res=array();
        $res["cpu"]=$this->get_cpu_percent();
        $res["load"]=$this->get_system_load();
        $res["mem"]=$this->get_memory_percent();
        $res["gentime"]=time();
        return $res;
    }
}
$shm_key = 0x00000000;//现代操作系统的内存地址都是假的，随便写就行
//首先进行检查，是否为开机后首次运行此程序
$shm_id = @shmop_open($shm_key, 'c', 0777, 16384);
if(shmop_size($shm_id)<5){
    $svrinfo=new get_system_hwinfo();
    $data=$svrinfo->get_all_info();
    shmop_write($shm_id, json_encode($data), 0);
    goto proc;
    $extra="这是开机后第一次执行";
    //首次运行，不需要考虑超时问题
}
$data = shmop_read($shm_id, 0, shmop_size($shm_id));
$data = json_decode($data);
if(time()-$data["gentime"]>20){//超时时间：20秒
    $l=$data["gentime"];
    $svrinfo=new get_system_hwinfo();
    $data=$svrinfo->get_all_info();
    shmop_write($shm_id, json_encode($data), 0);
    $extra="这是上次超时后的执行,上次执行：".date("Y-m-d H:i:s",$l);
}
proc:
//处理负载问题
if($data["mem"]>70||$data["load"]["1min"]>100||$data["cpu"]>100){
    //内存70 负载1 cpu 100以上属于高负载
    $load="高/High";
    $clr="r";
}else if($data["mem"]>60||$data["load"]["1min"]>60||$data["cpu"]>50){
    //内存60 负载0.6 cpu 50以上属于中负载
    $load="中/Mid";
    $clr="o";
}else if($data["mem"]>20||$data["load"]["1min"]>10||$data["cpu"]>10){
    //内存20 负载0.1 cpu 10以上属于低负载
    $load="低/Low";
    $clr="g";
}else{
    //内存60 负载0.6 cpu 50以上属于空载
    $load="空/Idle";
    $clr="idle";
}
$loaddetail="CPU使用:".$data["cpu"]."% 内存使用:".$data["mem"]."% 1min负载:".($data["load"]["1min"]/100)." 生成时间".date("Y-m-d H:i:s",$data["gentime"]).$extra;
?>