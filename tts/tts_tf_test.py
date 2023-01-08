#本接口为方便您测试模型性能，免费，故后台资源紧张，请勿在生产环境中使用本接口。
import requests, json

url = "http://www.moneymeeting.club:50001/free/tts_tf"

#这里的user, password字符串，需关注微信公众号：智会无界，并回复tts_tf获取
#注意，您同时能看到过期时间，为防止资源被长期占用，password隔一周会更换，请注意重新获取。
payload = {'user': '您获取的用户名',
'password': '您获取的密码',
'text': '白日依山尽，黄河入海流。'
}
files=[]

headers= {}

response = requests.request("POST", url, headers=headers, data = payload, files = files)
'''
返回的是JSON格式，例如：
{
    "result": "http://www.moneymeeting.club:50001/free/download?type=tts_tf&fileName=1607960576541.wav",
    "task_take_time": "0.904秒",
    "error": 0
}
如果 error为0,说明调用正常
result是生成的语音文件下载地址，可用于后续处理。
注意，此文件在一段时间后可能会被删除。
'''
print(json.loads(response.text.encode('utf8')))