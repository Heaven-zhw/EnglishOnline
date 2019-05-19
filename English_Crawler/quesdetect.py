from store import readUrls,readMaxTextid
from quescrawl import get_all
import time

domain="https://tiku.21cnjy.com/"
nCount=5

startTextid=readMaxTextid() #读取文章表的最大textid作为起始textid
while nCount > 0:
    # 实际上是Tuple类型
    hreflist = readUrls()  # 每次读一定数量的链接，默认1000


    # print(hreflist)
    if hreflist != 1:
        if (len(hreflist) > 0):
            startTextid=get_all(domain, hreflist,startTextid)
            nCount = nCount - 1
        else:
            #爬取完成，正常退出
            break
    else:
        #异常退出
        break
