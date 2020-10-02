<?php
class genCode{
    private function getYr(){
        //"2019"=>"0","2020"=>"1","2021"=>"2"
        $dataset=explode("","ABCDEFGHIJKLMNOPQRSTUVWXYZ");
        $yrs=date("Y")-2019;
        //2020-1-1
        //2029-10-A
        if($yrs>=10){
            $yrs=$dataset[$yrs-10];
        }
        return $yrs;
    }
    private function getMo(){
        return date("m");
    }
    private function getDa(){
        return date("d");
    }
    private function getRandStr($length=1){
        srand(date("s"));
        $possible_charactors = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $string = "";
        while(strlen($string)<$length){
            $string.= substr($possible_charactors, (rand() % (strlen($possible_charactors))) , 1);
        }
        return($string);
    }
    public function gen(){
        $str="";
        $str=$str.$this->getYr().$this->getMo().$this->getDa()."-";
        $rs=$this->getRandStr(5);
        $str=$str.$rs."-";
        $rs=$rs.$this->getYr().$this->getMo().$this->getDa().time();
        $rs=hash("sha256",$rs.microtime());
        $rs=strtoupper(substr($rs,4,5));
        $str=$str.$rs."-";
        $str=$str.strtoupper(substr(hash("sha256",time().microtime()),4,5))."-";
        $r=rand(0,9);
        $bstr=strtoupper(substr(hash("sha256",$str.microtime()),$r,4));
        $str=$str.$r.$bstr;
        return $str;
    }
}
$the=new genCode();
echo $the->gen();