#coding=utf-8
from bs4 import BeautifulSoup
import requests
import re
import time
import traceback
import queue
import threading
from basic import getHTMLText
from store import readUrls,updateErrorFlag
from store import saveSingleChoice,saveReading,saveCloze
from mylog import logContentConnectError,logContentFormError

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

domain="https://tiku.21cnjy.com/"


#题型定义

SINGLE_CHOICE_TYPE=1
CLOZE_TYPE=6
READING_TYPE=7

class LookUp(threading.Thread):
    def __init__(self):
        threading.Thread.__init__(self)

    def run(self):
        global queue_href, mutex_href_get, mutex_href_put
        mutex_href_get.acquire()

        while queue_href.qsize() > 0:
            # 在线程池中取得链接
            ids_and_viewHref=queue_href.get()
            hrefInfoList=ids_and_viewHref.split(" ")

            fromid=int(hrefInfoList[0])
            typeid=int(hrefInfoList[1])
            viewHref=str(hrefInfoList[2])
            textid=int(hrefInfoList[3])

            mutex_href_get.release()

            # 调用get...函数
            if typeid==SINGLE_CHOICE_TYPE:
                result = getSingleChoice(fromid,typeid,viewHref)
            elif typeid in [READING_TYPE,CLOZE_TYPE]:
                result = getReadingOrCloze(fromid,typeid,viewHref,textid)

            print('1111111111111111111111111111111111111122222222222222')
            print(result)
            print('111' * 10)
            try:
                mutex_href_put.acquire()
                print(str(type(result)))
                if str(type(result)) == "<class 'list'>":
                    # 存储
                    print(len(result))

                    #按题型存储数据库
                    if typeid==SINGLE_CHOICE_TYPE:
                        saveSingleChoice(result)
                    elif typeid ==READING_TYPE:
                        saveReading(result)
                    elif typeid ==CLOZE_TYPE:
                        saveCloze(result)

                elif result == 1: #连接错误
                    logContentConnectError(viewHref)
                elif result == 2: #格式错误
                    logContentFormError(viewHref)
                    updateErrorFlag(fromid)

                mutex_href_put.release()
            except:
                traceback.print_exc()
                print('shittttttttttttttttttt')
                mutex_href_put.release()
                mutex_href_get.acquire()
                continue
            mutex_href_get.acquire()
        mutex_href_get.release()

#爬取hrefList中的链接，传递的数量取决于detect模块
#由于url存储的是相对路径，需要传递domain补全
def get_all(domain,hreflist,textidDict):
    # 定义链接队列/得到链接的锁/给予链接的锁为全局变量
    global queue_href, mutex_href_get, mutex_href_put
    queue_href = queue.Queue()
    threads = []
    # 线程数量
    num = 6
    mutex_href_get = threading.Lock()
    mutex_href_put = threading.Lock()
    readtextid = textidDict['readtextid']
    clozetextid = textidDict['clozetextid']

    #URL加入线程队列
    for item in hreflist:

        fromid=item[0]
        typeid=item[1]
        viewHref=domain+str(item[2])

        #如果是非阅读或完型，readtextid和clozetextid不会使用到
        if typeid==READING_TYPE:
            readtextid+=1
            # 用空格分隔开放入队列
            queue_href.put(" ".join((str(fromid), str(typeid), viewHref, str(readtextid))))

        elif typeid == CLOZE_TYPE:
            clozetextid+=1
            # 用空格分隔开放入队列
            queue_href.put(" ".join((str(fromid), str(typeid), viewHref, str(clozetextid))))

        #其他题型（单选题）,textid用0填充
        else:
            queue_href.put(" ".join((str(fromid), str(typeid), viewHref, str(0))))

    for i in range(0, num):
        threads.append(LookUp())

    for thread in threads:
        thread.start()

    for thread in threads:
        thread.join()

    textidDict.update(readtextid=readtextid)
    textidDict.update(clozetextid=clozetextid)
    #返回文章当前最大序号
    return textidDict



def getSingleChoice(fromid,typeid,viewHref):
    print(fromid,typeid,viewHref)
    time.sleep(1)
    html=getHTMLText(viewHref,headers)
    if html==-1:
        return 1 #网络连接错误

    soup=BeautifulSoup(html,'lxml')
    try:
        answertag=soup.find('div',attrs={'class':'answer_detail'})

        title=str(answertag.dl.dt.p)

        answer_and_parsing=answertag.dl.dd.findAll('p')
        answer=answer_and_parsing[0].i.getText()
        analysis=str(answer_and_parsing[1].i)

        options=answertag.find('table',attrs={'name':'optionsTable'}).findAll('td')
        choiceA_pat=re.compile('(?<=>A.).*?(?=<)')
        choiceB_pat=re.compile('(?<=>B.).*?(?=<)')
        choiceC_pat=re.compile('(?<=>C.).*?(?=<)')
        choiceD_pat=re.compile('(?<=>D.).*?(?=<)')

        if options != None:
            if len(options) == 4:
                choiceA, choiceB, choiceC, choiceD = options
            choiceA = choiceA_pat.findall(str(options))[0]
            choiceB = choiceB_pat.findall(str(options))[0]
            choiceC = choiceC_pat.findall(str(options))[0]
            choiceD = choiceD_pat.findall(str(options))[0]

    except:
        return 2 # 题目内容提取错误

    result=[fromid,title,choiceA,choiceB,choiceC,choiceD,answer,analysis,typeid]
    return result


def getReadingOrCloze(fromid,typeid,viewHref,textid):
    print(fromid, typeid, viewHref,textid)
    time.sleep(1)

    html = getHTMLText(viewHref, headers)
    if html==-1:
        return 1 #连接错误

    try:
        soup = BeautifulSoup(html, 'lxml')
        answertag = soup.find('div', attrs={'class': 'answer_detail'})

        textList = [] #文本信息的结果

        # 获取阅读文本
        readingTag = answertag.dl.dt.p
        quesTitlepat = re.compile('(?<=>)【小题\d+】.*?(?=<)')
        readingText = quesTitlepat.sub('', str(readingTag))
        # print(readingText)

        # 获取所有题目
        allQuesTag = answertag.dl.dt
        allQuesTitles = quesTitlepat.findall(str(allQuesTag))
        # print(allQuesTitles)

        #题目数量
        quesNum = len(allQuesTitles)
        if quesNum == 0:
            raise Exception("question num error!")
        #保存题目的列表，元素类型为字典
        quesList = [{'fromid': fromid, 'typeid': typeid,'textid':textid} for _ in range(quesNum)]

        #添加题干字段
        for i in range(0, len(allQuesTitles)):
            # allQuesTitles[i]="<p>{}</p>".format(allQuesTitles[i]) #加上p标签
            quesList[i].update(title=allQuesTitles[i])

        # print(allQuesTitles)
        # 获取选项
        choiceA_pat = re.compile('(?<=>A.).*?(?=<)')
        choiceB_pat = re.compile('(?<=>B.).*?(?=<)')
        choiceC_pat = re.compile('(?<=>C.).*?(?=<)')
        choiceD_pat = re.compile('(?<=>D.).*?(?=<)')

        optionsTags = answertag.findAll('table', attrs={'name': 'optionsTable'})

        #检查题目和选项个数是否匹配
        #print(len(optionsTags),quesNum)
        if quesNum!=len(optionsTags):
            raise Exception("option num error!")
        #添加各个选项字段
        for i, tag in enumerate(optionsTags):
            options = tag.findAll('td')
            # 默认有四个选项
            choiceA, choiceB, choiceC, choiceD = options
            choiceA = choiceA_pat.findall(str(options))[0]
            choiceB = choiceB_pat.findall(str(options))[0]
            choiceC = choiceC_pat.findall(str(options))[0]
            choiceD = choiceD_pat.findall(str(options))[0]
            # print('A.{} B.{} C.{} D.{}'.format(choiceA,choiceB,choiceC,choiceD))
            quesList[i].update(choiceA=choiceA, choiceB=choiceB, choiceC=choiceC, choiceD=choiceD)

        # 答案
        answer_and_parsing = answertag.dl.dd.findAll('p')
        answers = answer_and_parsing[0].i.getText()
        answerpat = re.compile('(?<=】)[ABCD]')
        answersList = answerpat.findall(str(answers))

        # 检查题目和答案个数是否匹配
        if quesNum != len(answersList):
            raise Exception("answer num error!")
        #添加答案字段
        for i in range(0, len(answersList)):
            quesList[i].update(answer=answersList[i])


        # 解析
        try:
            analyses = answer_and_parsing[1].i
            analysispat = re.compile('(?<=>)【小题\d+】.*?(?=<)')
            analysesList = analysispat.findall(str(analyses))
            # print(analysesList)
            # 无解析
            if analysesList == []:
                raise Exception("no analysis")
            # 添加解析字段
            for i in range(0, len(analysesList)):
                quesList[i].update(analysis=analysesList[i])

        except:  # 无解析添加空值
            for i in range(0, len(quesList)):
                quesList[i].update(analysis='')
    except:
        traceback.print_exc()
        print(viewHref)
        return 2

    textList = [textid, readingText, quesNum,typeid]
    result=[textList,quesList]
    return result

