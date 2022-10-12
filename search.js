/*
 * @Author: fuutianyii
 * @Date: 2022-10-11 19:51:58
 * @LastEditors: fuutianyii
 * @LastEditTime: 2022-10-12 23:05:40
 * @github: https://github.com/fuutianyii
 * @mail: fuutianyii@gmail.com
 * @QQ: 1587873181
 */
var tetTimers=null;
var margin_d=3
function shrinks(dom,time,width_px,height_px) {
    var _this=this;
    wid=true
    hei=true

    height=dom.offsetHeight
    width=dom.offsetWidth
   if(width<=width_px){
       dom.style.width=(dom.offsetWidth)+"px";
       console.log(dom.style.width+'--')
       wid=false;
   }
   else{
    var width=dom.offsetWidth;
    console.log(width+"w")
    dom.style.width=dom.offsetWidth-3+"px";
   }
   console.log(height+" "+height_px)
   if(height<=height_px){
        dom.style.height=(dom.offsetHeight)+"px";
        console.log(dom.style.height+'--')
        hei=false;
    }
    else{
        var height=dom.offsetHeight;
        console.log(height+"h")
        dom.style.height=dom.offsetHeight-1+"px";
    }
    console.log(wid)
    console.log(hei)
    if ((wid ===false) && (hei ===false) && (mar ===false))
    {
        console.log("break")
        return false
    }
   

   tetTimers =setTimeout(function () {
        _this.shrinks(dom,time,width_px,height_px)
    },time);
 }


function enter(e)
{  var evt = window.event || e; 
    if (evt.keyCode == 13){
        var history=localStorage.history
        if (history==undefined)
        {
            console.log(111)
            value=document.getElementsByClassName("search-txt")[0].value
            console.log(value)
            array=Array(value)
            localStorage.setItem("history",JSON.stringify(array));
            console.log(localStorage);
        }
        else{
            value=localStorage.history;
            array=JSON.parse(value);
            array=[document.getElementsByClassName("search-txt")[0].value].concat(array);            
            if (array.length>25)
            {
                array.pop()
            }
            localStorage.history=JSON.stringify(array)
            inner="<span class=\"history_span\">"+document.getElementsByClassName("search-txt")[0].value+"</span>"+document.getElementsByClassName("search_history")[0].innerHTML
            console.log(inner)
            document.getElementsByClassName("search_history")[0].innerHTML=inner
            
            get_data(document.getElementsByClassName("search-txt")[0].value)//获取数据
            
            document.getElementsByClassName("no_search_div")[0].className = 'search_div'
            


            allspan=document.getElementsByClassName("history_span")
            var lengh=document.getElementsByClassName("history_span").length
            
            for (i=0;i<lengh;i++)
            {
                allspan[i].style.padding="5px";
                shrinks(allspan[i],30,10,10)
            }
            

        }
    }

}
