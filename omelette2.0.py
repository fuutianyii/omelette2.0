 
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
        url = 'http://127.0.0.1'
        self.browser = QWebEngineView()
        self.browser.load(QUrl(url))
        self.setCentralWidget(self.browser)
 
if __name__=='__main__':
    print('程序已运行')
    app = QApplication(sys.argv)
    window = MainWindow()
    window.show()
    sys.exit(app.exec_())
