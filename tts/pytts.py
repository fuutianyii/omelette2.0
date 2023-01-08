'''
Author: fuutianyii
Date: 2023-01-08 16:52:59
LastEditors: fuutianyii
LastEditTime: 2023-01-08 16:55:59
github: https://github.com/fuutianyii
mail: fuutianyii@gmail.com
QQ: 1587873181
'''

import pyttsx3
engine = pyttsx3.init() #创建对象


#如果在linux环境中运行，请确保已安装espeak与ffmpeg模块

engine.setProperty('rate',125)
engine.save_to_file('a','test.mp3')
engine.runAndWait()