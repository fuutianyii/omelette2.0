/*
 * @Author: fuutianyii
 * @Date: 2022-10-15 19:00:08
 * @LastEditors: fuutianyii
 * @LastEditTime: 2022-10-15 19:12:09
 * @github: https://github.com/fuutianyii
 * @mail: fuutianyii@gmail.com
 * @QQ: 1587873181
 */
function spread(event){
    if (document.getElementsByClassName("basic_div")[1].classList.length == 2)
    {
        document.getElementsByClassName("clip_basic_div")[0].classList.remove("clip_basic_div")
        document.querySelector("#right > div > div.content_div > div:nth-child(2) > div.spread_div > p").textContent="收起"
    }
    else{
        document.getElementsByClassName("basic_div")[1].classList.add("clip_basic_div")
        document.querySelector("#right > div > div.content_div > div:nth-child(2) > div.spread_div > p").textContent="展开"
    }
    
}