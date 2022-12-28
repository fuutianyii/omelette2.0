#!python3.8
#-*- coding: utf-8 -*-
'''
Author: fuutianyii
Date: 2022-11-05 15:58:22
LastEditors: fuutianyii
LastEditTime: 2022-12-28 18:36:00
github: https://github.com/fuutianyii
mail: fuutianyii@gmail.com
QQ: 1587873181
'''
 
import sys,os
os.chdir(os.path.dirname(os.path.abspath(__file__)))
from PyQt5.QtGui import *
from PyQt5.QtCore import *
from PyQt5.QtWidgets import *
from PyQt5.QtWebEngineWidgets import *
 
class MainWindow(QMainWindow):
    def __init__(self, *args, **kwargs):
        super().__init__(*args, **kwargs)
        self.setWindowTitle('omelette2.0')
        self.setWindowIcon(QIcon('icons/favicon.ico'))
        self.resize(1200, 800)
        self.show()
        file_path = os.path.abspath(__file__)
        url = 'https://fuutianyii.c1.sidoc.cn/'
        self.browser = QWebEngineView()
        self.browser.load(QUrl(url))
        self.setCentralWidget(self.browser)

if __name__=='__main__':
    app = QApplication(sys.argv)
    window = MainWindow()
    window.show()
    sys.exit(app.exec_())
