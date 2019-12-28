var timeele=document.getElementById("time");
function gtime(){
    time=new Date();
    string=time.getHours()+":"+time.getMinutes()+":"+time.getSeconds();
    return string;
}
function stime(ele){
    ele.innerText=gtime();
    return true;
}
timeele.innerText=gtime();
setInterval("stime(timeele)",100);