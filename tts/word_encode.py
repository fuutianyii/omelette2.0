'''
Author: fuutianyii
Date: 2023-01-08 18:04:21
LastEditors: fuutianyii
LastEditTime: 2023-01-08 18:13:06
github: https://github.com/fuutianyii
mail: fuutianyii@gmail.com
QQ: 1587873181
'''
word_list=["old","aboard","toward","tremendously","furthermore","forenenst","last","glitter","useful","repose","sandal","repeatedly","into","neutralise","yuck","for","ha","anodise","atop","mid","quarrelsomely","however","adventurous","meh","which","toward","unblinking","if","hefty","huzzah","gleeful","sweet","minus","once","briskly","afore","toward","instead","emotional","parole","hockey","anenst","prostanoid","whoa","geez"]
print(len(word_list))
str_data=""
for word in word_list:
    spell_word=""
    for w in word:
        spell_word+=w+"/"
    str_data+=word+"   "+word+"   "+spell_word+"       "

print(str_data)