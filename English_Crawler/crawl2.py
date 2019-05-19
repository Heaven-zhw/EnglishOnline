from basic import getHTMLText
from bs4 import BeautifulSoup
import requests
import re
import traceback
from lxml import etree

#爬阅读和完型

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

'''
#提取单选题
hreflist=readUrls(50)
for item in hreflist:
    #time.sleep(1)
    fromid=item[0]
    typeid=item[1]
    viewHref=domain+str(item[2])

    print(viewHref)
    html=getHTMLText(viewHref,headers)
    soup=BeautifulSoup(html,'lxml')
    try:
        answertag=soup.find('div',attrs={'class':'answer_detail'})

        title=str(answertag.dl.dt.p)

        answer_and_parsing=answertag.dl.dd.findAll('p')
        answer=answer_and_parsing[0].i.getText()
        analysis=str(answer_and_parsing[1].i)

        #print(title)
        #print(answer)
        #print(analysis)

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
        # 选项提取错误
    except:
        print(fromid)
        continue

    #print(options)
    #print(choiceA)
    #print(choiceB)
    #print(choiceC)
    #print(choiceD)

    result=[fromid,title,choiceA,choiceB,choiceC,choiceD,answer,analysis,typeid]

    print(result)
'''

#以下是几种抓不到的情况
#https://tiku.21cnjy.com/quest/3MTNzxUM.html #阅读文本有边框抓不到
#https://tiku.21cnjy.com/quest/1MTMzyQA.html #阅读选项是图片
#https://tiku.21cnjy.com/quest/5MzMzyQM.html #完型选项有div标签抓不到

#https://tiku.21cnjy.com/quest/0NjNzxUc.html #有解析

#阅读
href="https://tiku.21cnjy.com/tiku.php?mod=quest&channel=4&cid=1637&xd=3&type=7"
href="https://tiku.21cnjy.com/quest/AzNyE__AMT5N.html" #最常规的结构
href="https://tiku.21cnjy.com/quest/0NjNzxUc.html" #有解析
href="https://tiku.21cnjy.com/quest/1OTMz0AM.html"
href="https://tiku.21cnjy.com/quest/0MDMz0AM.html"

href="https://tiku.21cnjy.com/quest/wNjNz1ck.html" #文本有table，用边框围起来
href="https://tiku.21cnjy.com/quest/1NTNzxUQ.html" #题干是组合选择题，组合选项没有爬到



html=getHTMLText(href,headers)
soup=BeautifulSoup(html,'lxml')

answertag=soup.find('div',attrs={'class':'answer_detail'})

#获取阅读文本
readingTag=answertag.dl.dt.p
quesTitlepat=re.compile('(?<=>)【小题\d+】.*?(?=<)')
#print(readingtext)
#print(firstQues.findall(str(readingText)))
readingText=quesTitlepat.sub('',str(readingTag))
#print(readingText)

textList=[]

fromid=1111
typeid=7
textid=1

#获取所有题目
allQuesTag=answertag.dl.dt
print(allQuesTag)
allQuesTitles=quesTitlepat.findall(str(allQuesTag))
#print(allQuesTitles)

#
quesNum=len(allQuesTitles)
print(quesNum)
quesList=[{'fromid':fromid,'typeid':typeid,'textid':textid} for _ in range(quesNum)]





# for quesTitle in allQuesTitles:
#     quesTitle='<p>{}</p>'.format(quesTitle)
#     #print(quesTitle)
for i in range(0,len(allQuesTitles)):
    #allQuesTitles[i]="<p>{}</p>".format(allQuesTitles[i]) #加上p标签
    quesList[i].update(title=allQuesTitles[i])
    #quesList.append()

#print(allQuesTitles)
#获取选项
choiceA_pat=re.compile('(?<=>A.).*?(?=<)')
choiceB_pat=re.compile('(?<=>B.).*?(?=<)')
choiceC_pat=re.compile('(?<=>C.).*?(?=<)')
choiceD_pat=re.compile('(?<=>D.).*?(?=<)')

optionsTags=answertag.findAll('table',attrs={'name':'optionsTable'})

for i,tag in enumerate(optionsTags):
    options=tag.findAll('td')
    #默认有四个选项
    choiceA, choiceB, choiceC, choiceD = options
    choiceA = choiceA_pat.findall(str(options))[0]
    choiceB = choiceB_pat.findall(str(options))[0]
    choiceC = choiceC_pat.findall(str(options))[0]
    choiceD = choiceD_pat.findall(str(options))[0]
    #print('A.{} B.{} C.{} D.{}'.format(choiceA,choiceB,choiceC,choiceD))
    quesList[i].update(choiceA=choiceA,choiceB=choiceB,choiceC=choiceC,choiceD=choiceD)

#答案
answer_and_parsing=answertag.dl.dd.findAll('p')
answers=answer_and_parsing[0].i.getText()
answerpat=re.compile('(?<=】)[ABCD]')
answersList=answerpat.findall(str(answers))
for i in range(0,len(answersList)):
    quesList[i].update(answer=answersList[i])

#解析
try:
    analyses=answer_and_parsing[1].i
    analysispat=re.compile('(?<=>)【小题\d+】.*?(?=<)')
    analysesList=analysispat.findall(str(analyses))
    #print(analysesList)
    #无解析
    if analysesList==[]:
        raise Exception("no analysis")

    for i in range(0,len(analysesList)):
        quesList[i].update(analysis=analysesList[i])

except: #无解析添加空值
    for i in range(0,len(quesList)):
        quesList[i].update(analysis='')

textList=[textid,readingText,quesNum]
result=[textList,quesList]
#print(quesList)
#print(textList)
print(result)

#下午的工作
#1137之后的元素没有小题【】
#有【】的只能存小题1
# 重新建库，爬URL，爬链接，想对策
