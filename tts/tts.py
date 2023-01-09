'''
Author: fuutianyii
Date: 2023-01-07 20:26:57
LastEditors: fuutianyii
LastEditTime: 2023-01-09 17:10:47
github: https://github.com/fuutianyii
mail: fuutianyii@gmail.com
QQ: 1587873181
'''
from paddlespeech.cli.tts.infer import TTSExecutor
import requests
import os

class produce_audio():
    def __init__(self):
        self.tts = TTSExecutor() 
        print("TTSExecutor inited")
    def complie(self,word,chinese):
        print("start")
        text="  ."
        text+=word+".   "+word+".   "
        for w in list(word):
            w=w.replace("a","air")
            w=w.replace("o","oh")
            w=w.replace("e","ee")
            text+=w+"  "
        text+="."
        print(text)
        self.tts(text=text,
            output=f"{word}.wav",
            am="fastspeech2_ljspeech",#Acoustic models
            voc="hifigan_vctk",
            lang="en")
        chinese=chinese.replace(" ","")
        data=requests.get(f"https://fanyi.sogou.com/reventondc/synthesis?text={chinese}&speed=1&lang=zh-CHS&from=translateweb&speaker=5")
        ##因为服务器没有gpu，算力不够，只能使用外部中文tts。但是paddlespeech特色是中文tts，可惜了
        f=open(f"{word}_c.wav","wb")
        f.write(data.content)
        f.close()
        os.system(f"ffmpeg  -y  -i {word}.wav -i {word}_c.wav -filter_complex \"[0:0][1:0]concat=n=2:v=0:a=1[out]\" -map \"[out]\" memorize_audio/{word}.wav")
        print("produce ok")
        os.system(f"rm -rf {word}.wav {word}_c.wav")
        return word+"_output.wav"
    



if __name__ == "__main__":
    p=produce_audio()
    p.complie("old","老的")
    # p.complie("young","年轻的")
    # p.complie("film","电影;（给.....）蒙上一层薄膜；把......拍成电影，摄制电影；变得朦胧")
    exit()
