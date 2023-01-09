'''
Author: fuutianyii
Date: 2023-01-09 14:00:18
LastEditors: fuutianyii
LastEditTime: 2023-01-09 17:34:21
github: https://github.com/fuutianyii
mail: fuutianyii@gmail.com
QQ: 1587873181
'''
from fastapi import FastAPI,BackgroundTasks,FastAPI
import tts


producttts=tts.produce_audio()
cp=producttts.complie
app = FastAPI()
@app.get("/product/")
async def product(english:str,chinese:str,background_tasks:BackgroundTasks):
    background_tasks.add_task(cp,english,chinese)
    return  "start OK"