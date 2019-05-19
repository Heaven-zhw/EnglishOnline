from bs4 import BeautifulSoup
import requests
import re
import traceback
from lxml import etree
from store import saveQuestions

#从链接页面爬取选择题内容

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
def getHTMLtext(url):
    try:
        r = requests.get(url, timeout=30,headers=headers)
        #s = requests.session()
        #s.keep_alive = False
        if r.encoding == 'ISO-8859-1':
            encodings = requests.utils.get_encodings_from_content(r.text)
            if encodings:
                encoding = encodings[0]
            else:
                encoding = r.apparent_encoding
            # encode_content = req.content.decode(encoding, 'replace').encode('utf-8', 'replace')
            global encode_content
            encode_content = r.content.decode(encoding, 'replace')  # 如果设置为replace，则会用?取代非法字符；
            return encode_content
        else:
            return r.content
    except:
        traceback.print_exc()
        return ""

#单选语法题
href="https://tiku.21cnjy.com/tiku.php?mod=quest&channel=4&cid=1581&xd=3&type=1"

html=getHTMLtext(href)


soup=BeautifulSoup(html,'lxml')
questions=soup.find('div',attrs={'class':'questions_col'}).ul
questions=questions.findAll('li')

print(len(questions))

for question in questions:
    print(len(question.findAll('td')))
queslist=[]
quespat=re.compile(r'li>(.*?)<table', re.S)
re_comment = re.compile('<!--.*?-->',re.S)
#环视
choiceA_pat=re.compile('(?<=>)A.*?(?=<)')
choiceB_pat=re.compile('(?<=>)B.*?(?=<)')
choiceC_pat=re.compile('(?<=>)C.*?(?=<)')
choiceD_pat=re.compile('(?<=>)D.*?(?=<)')
for ques in questions:
    qcontent=""
    choiceA=""
    choiceB = ""
    choiceC = ""
    choiceD = ""
    typeid=1 #单选
    answerhref=""
    answerflag=0

    # 题干内容
    try:
        qcontent=re_comment.sub('', str(ques))
        qcontent=quespat.findall(qcontent)[0].strip()
    except:
        qcontent=""
    #print(qcontent)

    #提取选项
    choicetag=ques.findAll('td')

    if choicetag!=None:
        if len(choicetag)==4:
            choiceA,choiceB,choiceC,choiceD=choicetag
    try:
        choiceA=choiceA_pat.findall(str(choiceA))[0]
        choiceB = choiceB_pat.findall(str(choiceB))[0]
        choiceC = choiceC_pat.findall(str(choiceC))[0]
        choiceD = choiceD_pat.findall(str(choiceD))[0]
    #选项提取错误
    except:
        choiceA=choiceB=choiceC=choiceD=""

    #提取解析的链接
    try:
        answertag=ques.find(attrs={'class':'view_all'})
        answerhref=domain+str(answertag.get('href'))
    except:
        answerhref=""
    print(answerhref)
    print(choiceA,choiceB,choiceC,choiceD)
    res=[qcontent,choiceA,choiceB,choiceC,choiceD,typeid,answerhref,answerflag]
    queslist.append(res)
    #title=qcontent[0].strip()
    #print(title)
print(queslist)


#saveQuestions(queslist)
print(11111)



'''
for item in questions:
    print(item.getText().strip())

'''

'''
results=[]
tagtree=etree.HTML(html)
questions=tagtree.xpath('//div[@class="questions_col"]/ul//li/text()') #<br>标签也作了分隔，不是预期结果的
choiceAs=tagtree.xpath('//div[@class="questions_col"]/ul//li//td[1]/text()')#每次都不一样
choiceAs2=tagtree.xpath('//div[@class="questions_col"]/ul//li//td')
choiceAs3=tagtree.xpath('//div[@class="questions_col"]/ul//li')
print(len(choiceAs),choiceAs)
print(len(choiceAs2))
for i in choiceAs3:
    print(etree.tostring(i,encoding='utf-8').decode())


for i,item in enumerate(questions):
    print(i,item.strip())
'''
href="https://tiku.21cnjy.com/tiku.php?mod=quest&channel=4&cid=1581&xd=3&type=1&page=2"



