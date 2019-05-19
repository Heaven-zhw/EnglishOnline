from basic import getHTMLText
from bs4 import BeautifulSoup
import requests
import re
import traceback
from lxml import etree

#爬阅读和完型,针对没有【】的情况，只能用\d+.判断

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


#阅读

href="https://tiku.21cnjy.com/quest/xOTMz0AY.html" #有的题干没有题号的阅读，希望通过题目和选项数目不匹配舍去
href="https://tiku.21cnjy.com/quest/1OTMz0AM.html" #文章题目选项纯<br>标签的阅读，有的题干和选项没有题号的阅读，要舍去
href="https://tiku.21cnjy.com/quest/0MDMz0AM.html" #文章题目选项纯<br>标签的阅读
href="https://tiku.21cnjy.com/quest/zNDMz0AQ.html" #题号数字后跟全角点号的阅读
href="https://tiku.21cnjy.com/quest/yMjMzzAE.html" #既有4个选项同在一行，也有每两个在一行且存在图片的阅读。如何提取 or 舍去?
href="https://tiku.21cnjy.com/quest/yODMj5cQ.html" #文章题目选项纯<br>标签的完型

html=getHTMLText(href,headers)
soup=BeautifulSoup(html,'lxml')

answertag=soup.find('div',attrs={'class':'answer_detail'})

#获取阅读文本
readingTag=answertag.dl.dt.p
textpat=re.compile('(<p>.*?>)\s*\d+[\.．]')
readingText=textpat.findall(str(readingTag))[0]
readingText=readingText+'</p>'
print(readingText)

textList=[]

fromid=1111
typeid=7
textid=1

#获取所有题目题干
allQuesTag=answertag.dl.dt
quesTitlepat=re.compile('>\s*(\d+[\.．].*?)\s*<br/?>\s*A[\.．]') #适用于阅读
allQuesTitles=quesTitlepat.findall(str(allQuesTag))
print(allQuesTitles)
quesNum=len(allQuesTitles)

#最终可以改成typeid=CLOZE_TYPE
if quesNum==0:
    quesTitlepat2=re.compile('>(\d+[\.．])\s*A[\.．].*?B[\.．].*?C[\.．].*?D[\.．].*?\s*<') #适用于完型
    allQuesTitles = quesTitlepat2.findall(str(allQuesTag))
    print(allQuesTitles)
    quesNum = len(allQuesTitles)


print(quesNum)
if quesNum == 0:
    exit(-1)
    #raise Exception("question num error!")

quesList=[{'fromid':fromid,'typeid':typeid,'textid':textid} for _ in range(quesNum)]


# for quesTitle in allQuesTitles:
#     quesTitle='<p>{}</p>'.format(quesTitle)
#     #print(quesTitle)
for i in range(0,len(allQuesTitles)):
    #allQuesTitles[i]="<p>{}</p>".format(allQuesTitles[i]) #加上p标签
    quesList[i].update(title=allQuesTitles[i])
    #quesList.append()

#print(allQuesTitles)


#注意：完型通常ABCD选项在同一行，阅读ABCD通常在多行(也不一定)，默认每个选项只占一行

#适用于完型
choiceABCD_pat=re.compile('>\d+[\.．]\s*(A[\.．].*?B[\.．].*?C[\.．].*?D[\.．].*?)\s*<')
choicesList=choiceABCD_pat.findall(str(allQuesTag))

print(choicesList)

#最终可以改成tyeid为READING_TYPE
if choicesList==[]:

    #阅读，获取选项待完成
    #分一行一个选项，一行两个选项和一行四个选项
    choiceA_pat=re.compile('(?<=>A.).*?(?=<)')
    choiceB_pat=re.compile('(?<=>B.).*?(?=<)')
    choiceC_pat=re.compile('(?<=>C.).*?(?=<)')
    choiceD_pat=re.compile('(?<=>D.).*?(?=<)')
else:
    #完型
    choiceA_pat = re.compile('(A[\.．]).*?(B[\.．])')
    choiceB_pat = re.compile('(B[\.．]).*?(C[\.．])')
    choiceC_pat = re.compile('(C[\.．]).*?(D[\.．])')
    choiceD_pat = re.compile('(D[\.．]).*?')



#要加上每个选项的个数等于题目数的判断
for i in range(quesNum):
    pass
    #quesList[i].update(choiceA=choiceA,choiceB=choiceB,choiceC=choiceC,choiceD=choiceD)

#答案
answer_and_parsing=answertag.dl.dd.findAll('p')
answers=answer_and_parsing[0].i.getText()
answerpat=re.compile('[ABCD]')
answersList=answerpat.findall(str(answers))

print(answersList)

#判断答案个数
if quesNum!=len(answersList):
    print(111)
    exit(-1)

for i in range(0,len(answersList)):
    quesList[i].update(answer=answersList[i])

#解析
try:
    analyses=answer_and_parsing[1].i
    analysispat=re.compile('(?<=>)\d+\s*[\.．].*?(?=<)')
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
#print(result)
