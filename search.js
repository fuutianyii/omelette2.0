/*
 * @Author: fuutianyii
 * @Date: 2022-10-11 19:51:58
 * @LastEditors: fuutianyii
 * @LastEditTime: 2022-10-11 21:41:12
 * @github: https://github.com/fuutianyii
 * @mail: fuutianyii@gmail.com
 * @QQ: 1587873181
 */
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

            // console.log(document.getElementByClassName("search_history").innerHTML);
            inner="<span class=\"history_span\">"+document.getElementsByClassName("search-txt")[0].value+"</span>"+document.getElementsByClassName("search_history")[0].innerHTML
            console.log(inner)
            document.getElementsByClassName("search_history")[0].innerHTML=inner

        }
    // document.getElementsByClassName("no_search_div")[0].style("display","none")


    
    }

}