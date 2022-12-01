/*
 * @Author: fuutianyii
 * @Date: 2022-10-12 19:57:43
 * @LastEditors: fuutianyii
 * @LastEditTime: 2022-12-01 21:20:18
 * @github: https://github.com/fuutianyii
 * @mail: fuutianyii@gmail.com
 * @QQ: 1587873181
 */
function len(o) {
    var n=0;
    for (var i in o){
        n++;
    }
    return n;
  }


function display_intellective_search(word){
const Http = new XMLHttpRequest();
const url='https://'+window.location.host+'/search_dict.php?word='+word;
Http.open("GET", url);
Http.send(null);
Http.onreadystatechange=function()
{
    var response_data=undefined;
    if(Http.readyState==4)
        response_data=Http.responseText;
        if (response_data != undefined)
        {
        data=JSON.parse(response_data);
        console.log(data);
        
        if ((data["isWord"] == true) & (Object.keys(data).indexOf("basic") != -1))
        {
            // document.querySelector("#right > div > div.content_div > div:nth-child(1) > div > div > div:nth-child(1)").style.display="block";
            // document.querySelector("#right > div > div.content_div > div:nth-child(1) > div > div > div.error").style.display="none";
            // document.getElementById("uk").innerHTML="英["+data["basic"]["uk-phonetic"]+"]"+'<img class="audio_img" onclick="play(1)" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGwAAABgCAMAAADPemeEAAAAnFBMVEUAAABEq/88qf9Rrv88qv88q/88qf9WuP87qf89qv9f0/9Arf87qf87qP87qf87qf9Brv88qf87qf88qf88qf88qf88qf87qf8+qv87qf87qf88qv8/rf9BsP88qf89q/87qf88qf87qf88qf88qf88qf87qP87qf88qv88qv8+rP87qf87qf89q/87qf88qv88qf88qf87qP87qP93cczaAAAAM3RSTlMADvkJeED8Be47AiP26t/ZF8bBqZKKg30t8rJzHRJaMuXRbWXVrqGcVE4nu6RFzDa3mF9wVIiXAAAEUUlEQVRo3r2Z2YKiMBBFS1A2QUFxBcQNt9ZWJ///bzPTVEg6KosS7huleEzlpioE+EinoWHMp9CINjb5JzsG+WoNSaoBSNe1R1CaDpIVKCRTC6TKvSGnAdhlSZqC6WONNAULPWQ0ADsYpClYa4+ABmBmn2PYAkymM1ZT5TVMXZ/96yes6Ypw8lV4DWv9/6o2eX9YE4VDOUeAHFg7/WD8Jiv+NawvF3Jh1Eajt0w44mdLCQDyYX/I+7TDkvxyBhTBrDlBbar63eNR2kiHQhjolKZ1nnxoLtbt5/oivPomQC5MpBldsdztDVJKmq9CEUykbdXfRrULKWxYZWGgfj8xibUviVLGKlSAQehgOrhSMirJGpwAKsHAxC/01SyilUL1FgBFMHMRi4Uk1QRQXhmUE6hQBHM9LC1MFk7bDKNxCdT3GlG5sCRNWQicaGPw08txVu4WnecyI0DlwwzMN1tX7OeVNDjAG4YWVJQIo07vR3xRRUfuf65o1TvBp7AOvfT4pAfY1X/+AV3P+scwONLrHTCpOJqfRkFQ6ucwRjs8Dq1fIwxpGhZfzpIRfqtTNwwCajdgGqL7a4fBEEMmC11wSdQPixx0JDBhaFo7DBYY4xr0Dgtk3TBWJeYP/JsE2AWDXZba1KOOBBh4rK2gtmkklADDPePqwaIHCbDWTMxjG8cqAUYH8geojmngLgO2oV2FaooGlQHr4n4RqFycRRkwSCdNsQBl4UZGCsyjVkfhjsGQAjuLxdiRCPPT8FGAzaTAxriIhTTaMmEL5hiJaRwJI1NxGyJzzi7CwhtIgeFj4BVQHdyYSIFhS3GF7unLgOlp3BDncCMDdhX3PANMqwxYQLOGslLna6oMmCcUkCl1vgRYiI/tkdCo9zJgbfE9hpetcY3eUBdMX6L3hNaptQB6dAdbFww3V3YWXONIucfcpBYYe/jbi0t8zT/A+2otsAkmrSvUKiVKfYlybrvd+by7+5P18WS9CYsxdgaqBAsjt7xF2avzolUdpm7x9mxgU433RIxXj1J8txqMHftNxA7QZ1l+pV63EswaYmCrA8okQtfev6YllWA7OgcxULyHdIs56GUmjSqw++MhdPDkrMIcvID1K8DWBHUHqpONJ23COeRoNaO+cHq9fs/OViKckuV2rBbAWC3aWWIStRgepEdR5Loq9ew6+Qqs7O/dCmGOyAK/+puEBNtTEWwksjZ0LirUJix24yKYPlLIrI0s7pROM6G8VlhIi62vhwwFsYGfBlBBbb4AxfPl7VLm9PtKWWeoIv1/XZgduMPzr1MhzKTe/q7aTMz2JgT+aNYOrHxYl46rF8K7anFv63JhI1Zc35ZOMjmXPNj9IxbqxmjaJAd2qYEFpyVhmucYZGP8S3UIn8md9Mq9gVenLnyuVvIEJk/jJmGwUBqEgek0CINuv0EYRIMGYaCfm4GJptR0kK+Nxh6G5Ovy07RmMTSi7tAwkimU1V8yBRUSWK7iaQAAAABJRU5ErkJggg==" alt="" class="jsx-1500050861"></img>';
            // document.getElementById("us").innerHTML="美["+data["basic"]["us-phonetic"]+"]"+'<img class="audio_img" onclick="play(2);" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGwAAABgCAMAAADPemeEAAAAnFBMVEUAAABEq/88qf9Rrv88qv88q/88qf9WuP87qf89qv9f0/9Arf87qf87qP87qf87qf9Brv88qf87qf88qf88qf88qf88qf87qf8+qv87qf87qf88qv8/rf9BsP88qf89q/87qf88qf87qf88qf88qf88qf87qP87qf88qv88qv8+rP87qf87qf89q/87qf88qv88qf88qf87qP87qP93cczaAAAAM3RSTlMADvkJeED8Be47AiP26t/ZF8bBqZKKg30t8rJzHRJaMuXRbWXVrqGcVE4nu6RFzDa3mF9wVIiXAAAEUUlEQVRo3r2Z2YKiMBBFS1A2QUFxBcQNt9ZWJ///bzPTVEg6KosS7huleEzlpioE+EinoWHMp9CINjb5JzsG+WoNSaoBSNe1R1CaDpIVKCRTC6TKvSGnAdhlSZqC6WONNAULPWQ0ADsYpClYa4+ABmBmn2PYAkymM1ZT5TVMXZ/96yes6Ypw8lV4DWv9/6o2eX9YE4VDOUeAHFg7/WD8Jiv+NawvF3Jh1Eajt0w44mdLCQDyYX/I+7TDkvxyBhTBrDlBbar63eNR2kiHQhjolKZ1nnxoLtbt5/oivPomQC5MpBldsdztDVJKmq9CEUykbdXfRrULKWxYZWGgfj8xibUviVLGKlSAQehgOrhSMirJGpwAKsHAxC/01SyilUL1FgBFMHMRi4Uk1QRQXhmUE6hQBHM9LC1MFk7bDKNxCdT3GlG5sCRNWQicaGPw08txVu4WnecyI0DlwwzMN1tX7OeVNDjAG4YWVJQIo07vR3xRRUfuf65o1TvBp7AOvfT4pAfY1X/+AV3P+scwONLrHTCpOJqfRkFQ6ucwRjs8Dq1fIwxpGhZfzpIRfqtTNwwCajdgGqL7a4fBEEMmC11wSdQPixx0JDBhaFo7DBYY4xr0Dgtk3TBWJeYP/JsE2AWDXZba1KOOBBh4rK2gtmkklADDPePqwaIHCbDWTMxjG8cqAUYH8geojmngLgO2oV2FaooGlQHr4n4RqFycRRkwSCdNsQBl4UZGCsyjVkfhjsGQAjuLxdiRCPPT8FGAzaTAxriIhTTaMmEL5hiJaRwJI1NxGyJzzi7CwhtIgeFj4BVQHdyYSIFhS3GF7unLgOlp3BDncCMDdhX3PANMqwxYQLOGslLna6oMmCcUkCl1vgRYiI/tkdCo9zJgbfE9hpetcY3eUBdMX6L3hNaptQB6dAdbFww3V3YWXONIucfcpBYYe/jbi0t8zT/A+2otsAkmrSvUKiVKfYlybrvd+by7+5P18WS9CYsxdgaqBAsjt7xF2avzolUdpm7x9mxgU433RIxXj1J8txqMHftNxA7QZ1l+pV63EswaYmCrA8okQtfev6YllWA7OgcxULyHdIs56GUmjSqw++MhdPDkrMIcvID1K8DWBHUHqpONJ23COeRoNaO+cHq9fs/OViKckuV2rBbAWC3aWWIStRgepEdR5Loq9ew6+Qqs7O/dCmGOyAK/+puEBNtTEWwksjZ0LirUJix24yKYPlLIrI0s7pROM6G8VlhIi62vhwwFsYGfBlBBbb4AxfPl7VLm9PtKWWeoIv1/XZgduMPzr1MhzKTe/q7aTMz2JgT+aNYOrHxYl46rF8K7anFv63JhI1Zc35ZOMjmXPNj9IxbqxmjaJAd2qYEFpyVhmucYZGP8S3UIn8md9Mq9gVenLnyuVvIEJk/jJmGwUBqEgek0CINuv0EYRIMGYaCfm4GJptR0kK+Nxh6G5Ovy07RmMTSi7tAwkimU1V8yBRUSWK7iaQAAAABJRU5ErkJggg==" alt="" class="jsx-1500050861"></img>';

            // if (Object.keys(data["basic"]).indexOf("exam_type") != -1)
            // {
            //     var mean_tag=data["basic"]["exam_type"][0];
            //     for (i=1;i<data["basic"]["exam_type"].length;i++){
            //     mean_tag+="/"+data["basic"]["exam_type"][i];
            //     }
            // }
            // else{
            // var mean_tag=" ";
            // }
            var explains=data["basic"]["explains"];
            // document.getElementsByClassName("mean_tag")[0].innerText=mean_tag
            var mean_part="";
            for (i=0;i<len(explains);i++)
            {
                // console.log(mean_part);
                var str = explains[i];
                console.log(str)
                
                if (str.indexOf(".") == -1)
                {
                mean_part=mean_part+'<p class="means"><i></i>'+str+'</p>';
                }
                else if(str.indexOf(".") >=5){
                mean_part=mean_part+'<p class="means"><i></i>'+str+'</p>';
                }
                else{
                mean_part=mean_part+'<p class="means"><i>'+str.slice(0,str.indexOf("."))+'</i>'+str.slice(str.indexOf(".")+1)+'</p>'
                }
            }
            // console.log(mean_part);
            document.querySelector("#right > div > div > div.chinese_means > div.search_info_div.tip.top > div").innerHTML=mean_part
            window.data=data;
            
        }
        else{
            document.querySelector("#right > div > div > div.chinese_means > div.search_info_div.tip.top > div").innerHTML="None";
        }

        }
};



const Http_sentence = new XMLHttpRequest();
const url_sentence='https://'+window.location.host+'/api_sentence.php?word='+word;
Http_sentence.open("GET", url_sentence);
Http_sentence.send(null);
Http_sentence.onreadystatechange=function()
{
    var response_data=undefined;
    if(Http_sentence.readyState==4)
        response_data=Http_sentence.responseText;
};
// return data["basic"];
}

function search(event){
    word=event.value
    if (word != "")
    {
        window.search_on=true;
        document.querySelector("#right > div > div > div.chinese_means > div.search_info_div").style.display="block";
        document.querySelector("#right > div > div > div.chinese_means > div.search_info_div.tip.top > div").innerHTML="加载中。。。。";
        display_intellective_search(word)
    }
}