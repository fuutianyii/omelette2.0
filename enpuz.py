'''
Author: fuutianyii
Date: 2022-12-31 12:01:05
LastEditors: fuutianyii
LastEditTime: 2023-01-02 15:07:08
github: https://github.com/fuutianyii
mail: fuutianyii@gmail.com
QQ: 1587873181
'''
from email import header
from unicodedata import name
from wsgiref import headers
import requests


class my_requests():
    def __init__(self):
        self.requests=requests.session()
    def my_requests(self,url,data="",headers="",method="get",proxy=False,proxies="auto"):
        if headers=="":
            headers={
                "User-Agent":"Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.146 Safari/537.36"
            }
        else:
            headers=headers
        if (proxy ==True) and (proxies== "auto"):
            proxy="127.0.0.1:8080"
            proxies = {
                        'http': 'http://' + proxy,
                        'https': 'http://' + proxy 
                    }
        else:
            proxies = {}
        print(method)
        if method == "get":
            request=self.requests.get(url=url,headers=headers,data=data,proxies=proxies)
            return request.content
        elif method == "post":
            request=self.requests.post(url=url,headers=headers,data=data,proxies=proxies)
            return request.content
        

def encode_sentence(q):
    return q.replace(" ","-")+"="


if __name__ == "__main__":
    q="How long do you study english"
    eq=encode_sentence(q)
    data={"event":"puz",
          "uuid":"",
          "query":q,
          "need_notify":"true",
          "_pjax":"%23Result"
          }
    req=my_requests()
    recv=req.my_requests(url="http://enpuz.com/",method="get",proxy=False)
    cookie=req.requests.cookies.get_dict()
    print(str(data))
    headers={"Content-Length": "66",
        "Accept": "application/json, text/javascript, */*; q=0.01",
        "X-Requested-With": "XMLHttpRequest",
        "X-PJAX": "true",
        "X-PJAX-Container": "#Result",
        "X-CSRFToken": cookie["csrftoken"],
        "User-Agent": "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/107.0.5304.107 Safari/537.36",
        "Content-Type": "application/x-www-form-urlencoded; charset=UTF-8",
        "Origin": "http://enpuz.com",
        "Accept-Encoding": "gzip, deflate",
        "Accept-Language": "zh-CN,zh;q=0.9",
        "Connection": "close"
        }

    #在cookie中添加sessionid即可实现登录
    recv=req.my_requests(url="http://enpuz.com/s/",data=data,method="post",proxy=True,headers=headers)
    print(recv.decode())
    # recv=req.my_requests(url="http://enpuz.com/"+eq,method="get",proxy=True)
    print(recv.decode())