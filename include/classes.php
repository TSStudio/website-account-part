<?php
    namespace maintask;
   //职业对应的价格
    $cost=array("1"=>"100","2"=>"100","3"=>"100","4"=>"300","5"=>"300","6"=>"300","7"=>"300","8"=>"300","9"=>"300","10"=>"300","11"=>"300","12"=>"500","13"=>"500","14"=>"500","15"=>"500","16"=>"500","17"=>"500","18"=>"1000","19"=>"1000","20"=>"100","21"=>"100","22"=>"100","23"=>"100","24"=>"300","25"=>"300","26"=>"500","27"=>"500","28"=>"500","29"=>"1000","30"=>"500","31"=>"1000");
    
    //职业名
    $truename=array("1"=>"天使","2"=>"炸弹人","3"=>"荆棘战士","4"=>"烈焰法师","5"=>"黑暗法师","6"=>"冰霜法师","7"=>"圣骑士","8"=>"附魔师","9"=>"潜影大师","10"=>"忍者","11"=>"灵魂收割者","12"=>"量子步兵","13"=>"红石大师","14"=>"特种弓箭手","15"=>"龙骑兵","16"=>"堡垒大师","17"=>"不灭的安戴因","18"=>"伊斯耐尔·赛加(黑)","19"=>"八坂迪克雷","20"=>"灵魂渔夫", "21"=>"攻城师", "22"=>"加农炮手", "23"=>"甲冑骑兵", "24"=>"学者", "25"=>"精灵弓箭手", "26"=>"光子精灵", "27"=>"爆破MK 炸弹大师", "28"=>"卡恩将军", "29"=>"卢西奥", "30"=>"伊斯耐尔·赛加 (白)", "31"=>"末影刺客");
    
    //每个等级的职业对应的名字
    $common=array("1"=>"ebw-angel","2"=>"ebw-bombman","3"=>"ebw-thornman","20"=>"ebw-fisher","21"=>"ebw-sapper","22"=>"ebw-cannoneer","23"=>"ebw-cataphract");
    $rare=array("4"=>"ebw-firemage","5"=>"ebw-darkmage","6"=>"ebw-icemage","7"=>"ebw-paladin","8"=>"ebw-enchanter","9"=>"ebw-shulker","10"=>"ebw-ninja","11"=>"deathlord","24"=>"ebw-scholar","25"=>"ebw-sparcher");
    $epic=array("12"=>"ebw-quantum","13"=>"ebw-redstone","14"=>"ebw-Sarcher","15"=>"ebw-dragonraider","16"=>"ebw-builder","17"=>"ebw-undyne","26"=>"ebw-phontom","27"=>"ebw-explosive","28"=>"ebw-karn","30"=>"ebw-ethanel");
    $legend=array("18"=>"ebw-ethanel-d","19"=>"ebw-keepo","29"=>"ebw-lucio","31"=>"ebw-endera");
    
    //职业对应的级别(同步时所用)
    $level=array("1"=>"common","2"=>"common","3"=>"common","4"=>"rare","5"=>"rare","6"=>"rare","7"=>"rare","8"=>"rare","9"=>"rare","10"=>"rare","11"=>"rare","12"=>"epic","13"=>"epic","14"=>"epic","15"=>"epic","16"=>"epic","17"=>"epic","18"=>"legend","19"=>"legend","20"=>"common","21"=>"common","22"=>"common","23"=>"common","24"=>"rare","25"=>"rare","26"=>"epic","27"=>"epic","28"=>"epic","29"=>"legend","30"=>"epic","31"=>"legend");
    
    $classes="31";//总数
    
    $lvla=array("common"=>1,"rare"=>2,"epic"=>3,"legend"=>4);
?>