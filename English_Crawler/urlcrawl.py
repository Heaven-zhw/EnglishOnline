#coding=utf-8
from bs4 import BeautifulSoup
import requests
import re
import time
import traceback
import queue
from queue import Queue
import threading
from basic import getHTMLText
from store import saveUrls
from mylog import logUrlConnectError,logUrlFormError

headers = {
            'User-Agent': 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/57.0.2987.133 Safari/537.36',
            'Accept':'text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
            'Accept-Language':'zh-CN,zh;q=0.8,en-US;q=0.5,en;q=0.3',
            'Accept-Encoding':'gzip, deflate',
            'Connection':'keep-alive',
            'Upgrade-Insecure-Requests':'1',
            'Pragma':'no-cache',
            'Cache-Control':'no-cache',
        }



class LookUp(threading.Thread):
    def __init__(self):
        threading.Thread.__init__(self)

    def run(self):
        global queue_href, mutex_href_get, mutex_href_put
        mutex_href_get.acquire()

        while queue_href.qsize() > 0:
            # 在线程池中取得链接和序号
            viewHref = str(queue_href.get())
            mutex_href_get.release()

            # 调用get_page函数
            result = get_page(viewHref)
            print('1111111111111111111111111111111111111122222222222222')
            print(result)
            print('111' * 10)
            try:
                mutex_href_put.acquire()
                print(str(type(result)))
                if str(type(result)) == "<class 'list'>":
                    # 存储
                    print(len(result))
                    saveUrls(result)
                elif result == 1: #网络连接错误
                    logUrlConnectError(viewHref)
                elif result==2: #页面格式错误
                    logUrlFormError(viewHref)
                mutex_href_put.release()
            except:
                traceback.print_exc()
                print('shittttttttttttttttttt')
                mutex_href_put.release()
                mutex_href_get.acquire()
                continue
            mutex_href_get.acquire()
        mutex_href_get.release()


def get_all(href_need_page,startpage,endpage):
    # 定义链接队列/得到链接的锁/给予链接的锁为全局变量
    global queue_href, mutex_href_get, mutex_href_put
    queue_href = Queue()
    threads = []
    # 线程数量
    num = 4
    mutex_href_get = threading.Lock()
    mutex_href_put = threading.Lock()
    # 拼接好页码的链接放入队列

    for k in range(startpage,endpage+1):
        queue_href.put(href_need_page+str(k))

    for i in range(0, num):
        threads.append(LookUp())

    for thread in threads:
        thread.start()

    for thread in threads:
        thread.join()


def get_page(viewHref):
    time.sleep(1.5)
    html=getHTMLText(viewHref,headers)

    if html==-1:
        return 1 #网络连接错误
    try:
        soup=BeautifulSoup(html,'lxml')
        questions=soup.find('div',attrs={'class':'questions_col'})
        questions=questions.ul.findAll('li')
    except:
        return 2 #页面内容错误

    # 题型
    typeid = int(re.findall('type=(\d+)', viewHref)[0])
    result = []
    for ques in questions:
        answerhref=""
        flag=0
        nowtime = time.strftime('%Y-%m-%d %H:%M:%S', time.localtime(time.time()))

        #提取题目的链接
        try:
            answertag=ques.find(attrs={'class':'view_all'})
            answerhref=str(answertag.get('href'))

            print(answerhref)
            urllist=[typeid,answerhref,flag,nowtime]
            result.append(urllist)
        except:
            continue
    print(len(result))
    #print(result)
    return result


if __name__ =='__main__':
    # 单选语法题
    href = "https://tiku.21cnjy.com/tiku.php?mod=quest&channel=4&cid=1581&xd=3&type=1"
    get_page(href)
