/*
 * @Author: fuutianyii
 * @Date: 2022-10-12 19:57:43
 * @LastEditors: fuutianyii
 * @LastEditTime: 2022-10-13 21:54:04
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


function write_data(word){
  document.getElementsByClassName("mean_word")[0].innerText=word;
  const Http = new XMLHttpRequest();
  const url='http://'+window.location.host+'/search_dict.php?word='+word;
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
          var mean_part="";
          var explains=data["basic"]["explains"];
          document.getElementById("uk").innerText="英["+data["basic"]["uk-phonetic"]+"]";
          document.getElementById("us").innerText="美["+data["basic"]["us-phonetic"]+"]";
          for (i=0;i<len(explains);i++)
          {
              // console.log(mean_part);
              var str = explains[i];
              if (str.indexOf(".") == -1)
              {
                mean_part=mean_part+'<li><p class="means">'+str.slice(str.indexOf(".")+1)+'</p></li>';
              }
              else if(str.indexOf(".") >=5){
                mean_part=mean_part+'<li><p class="means">'+str.slice(str.indexOf(".")+1)+'</p></li>';
              }
              else{
                mean_part=mean_part+'<li><i>'+str.slice(0,str.indexOf("."))+'</i><p class="means">'+str.slice(str.indexOf(".")+1)+'</p></li>';
              }
          }
          // console.log(mean_part);
          document.getElementsByClassName("mean_part")[0].innerHTML=mean_part
        }
  };



  const Http_sentence = new XMLHttpRequest();
  const url_sentence='http://'+window.location.host+'/api_sentence.php?word='+word;
  Http_sentence.open("GET", url_sentence);
  Http_sentence.send(null);
  Http_sentence.onreadystatechange=function()
  {
      var response_data=undefined;
      if(Http_sentence.readyState==4)
        response_data=Http_sentence.responseText;
        if (response_data != undefined)
        {
          // console.log(response_data);
          document.getElementsByClassName("margin_div")[1].innerHTML=response_data;
        }
  };
  // return data["basic"];
}
  
function GetRequest() {
  var url = location.search; //获取url中"?"符后的字串
  var theRequest = new Object();
  if (url.indexOf("?") != -1) {
      var str = url.substr(1);
      strs = str.split("&");
      for(var i = 0; i < strs.length; i ++) {
          theRequest[strs[i].split("=")[0]]=decodeURI(strs[i].split("=")[1]);
      }
      return theRequest;
  }
  else{
    return 0;
  }
  
} 

function hlgt(e){$(e).addClass("highLight")}

function unhlgt(e){$(e).removeClass("highLight")}