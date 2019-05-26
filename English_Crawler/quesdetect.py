from store import readUrls,readMaxReadTextid,readMaxClozeTextid
from quescrawl import get_all
import time

domain="https://tiku.21cnjy.com/"
nCount=5

startReadTextid=readMaxClozeTextid() #读取阅读文章表的最大textid作为起始readtextid
startClozeTextid=readMaxClozeTextid() #读取完型文章表的最大textid作为起始clozetextid

startIdDict={'readtextid':startReadTextid,'clozetextid':startClozeTextid}
while nCount > 0:
    # 实际上是Tuple类型
    hrefList = readUrls()  # 每次读一定数量的链接，默认1000

    # print(hrefList)
    if hrefList != 1:
        if (len(hrefList) > 0):
            startIdDict=get_all(domain, hrefList,startIdDict)
            nCount = nCount - 1
        else:
            #爬取完成，正常退出
            break
    else:
        #异常退出
        break
