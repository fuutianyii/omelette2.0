/*
 * @Author: fuutianyii
 * @Date: 2022-10-12 19:57:43
 * @LastEditors: fuutianyii
 * @LastEditTime: 2022-10-12 20:35:59
 * @github: https://github.com/fuutianyii
 * @mail: fuutianyii@gmail.com
 * @QQ: 1587873181
 */

function get_data(word){
  const Http = new XMLHttpRequest();
  const url='http://127.0.0.1/search_dict.php?word='+word;
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