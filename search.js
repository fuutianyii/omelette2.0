/*
 * @Author: fuutianyii
 * @Date: 2022-10-11 19:51:58
 * @LastEditors: fuutianyii
 * @LastEditTime: 2022-12-01 14:34:50
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
    //    console.log(dom.style.width+'--')
       wid=false;
   }
   else{
    var width=dom.offsetWidth;
    // console.log(width+"w")
    dom.style.width=dom.offsetWidth-3+"px";
   }
//    console.log(height+" "+height_px)
   if(height<=height_px){
        dom.style.height=(dom.offsetHeight)+"px";
        // console.log(dom.style.height+'--')
        hei=false;
    }
    else{
        var height=dom.offsetHeight;
        // console.log(height+"h")
        dom.style.height=dom.offsetHeight-1+"px";
    }
    // console.log(wid)
    // console.log(hei)
    if ((wid ===false) && (hei ===false))
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
    if ((evt.keyCode == 13)  |  (evt.type == "click")){
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
            write_data(document.getElementsByClassName("search-txt")[0].value)
            console.log("running write_data")
            value=localStorage.history;
            array=JSON.parse(value);
            array=[document.getElementsByClassName("search-txt")[0].value].concat(array);            
            if (array.length>25)
            {
                array.pop()
            }
            localStorage.history=JSON.stringify(array)
            
    
            // console.log(document.getElementByClassName("search_history").innerHTML);
            console.log(array)
            document.getElementsByClassName("search_history")[0].innerHTML="<span class=\"history_span\">"+array[0]+"</span>"+document.getElementsByClassName("search_history")[0].innerHTML



            
            allspan=document.getElementsByClassName("history_span")
            var lengh=document.getElementsByClassName("history_span").length
            
            for (i=0;i<lengh;i++)
            {
                allspan[i].style.padding="5px";
                shrinks(allspan[i],30,10,10)
            }
            if (document.getElementsByClassName("content_div_hidden")[0] != undefined)
            {
                document.getElementsByClassName("content_div_hidden")[0].className = "content_div";
            }
            // console.log(data)
            document.querySelector("#right > div > div.search-bar > input").value="";
        }
    }
}
