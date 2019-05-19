#coding=utf-8
import pymysql
import traceback

#----------------数据库配置---------------------------------
host="127.0.0.1"          #数据库地址
user="root"                   #用户名
passwd="root"               #密码
charset="utf8"                #字符编码
database="engonline"             #数据库
urlTable="urlinfo"            #存题目链接的数据表表名
squesTable="squestion"    #存题目内容数据表表名
textTable="readtext"     #存放文本的数据表表名

#----------------Mysql操作---------------------------------
#存链接
def saveUrls(queslist):  # tagname在此默认与table名称相同
    try:
        conn = pymysql.connect(host=host, user=user, password=passwd, db=database, charset=charset)
        cur = conn.cursor()
        sql = "INSERT ignore INTO {} (typeid,quesurl,flag,gaintime) " \
              "VALUE(%s,%s,%s,%s)".format(urlTable)  # 用(%d,%s)会报错，pymysql的自身bug
        print(sql)

        for item in queslist:
            cur.execute(sql, item)
        conn.commit()
        print("URL存储成功！")
    except Exception as e:
        print("存储URL时出错！")
        print(e)
        conn.rollback()
    finally:
        conn.close()

#从链接数据表里读取指定数目的未爬取过的链接
def readUrls(count=1000):
    try:
        urllist = []
        conn = pymysql.connect(host=host, user=user, password=passwd, db=database, charset=charset)
        cur = conn.cursor()

        sql = "select id,typeid,quesurl from {} where flag=0 limit ".format(urlTable) + str(count)
        # print(sql)
        cur.execute(sql)
        results = cur.fetchall()
        #print(results) #元组类型
        #for item in results:
        #   urllist.append(list(item))
        #print(urllist)
        conn.close()
        print(len(results))
        return results
    except:
        print("读取URL时数据库错误!")
        # traceback.print_exc()
        conn.close()
        return 1

#存内容并更新爬取完成标志位
def saveSingleChoice(result):
    try:
        conn = pymysql.connect(host=host, user=user, password=passwd, db=database, charset=charset)
        cur = conn.cursor()

        sql1="INSERT ignore INTO {} (fromid,title,choiceA,choiceB,choiceC,choiceD,answer,analysis,typeid) " \
              "VALUE(%s,%s,%s,%s,%s,%s,%s,%s,%s)".format(squesTable)
        cur.execute(sql1, result)
        conn.commit()

        fromid=result[0]
        #更新标志位为已经爬取成功
        sql2="update {} set flag=1 where id=%s".format(urlTable)
        cur.execute(sql2,fromid)
        conn.commit()

        print("网页信息存储成功！")
    except Exception as e:
        print("存储网页信息时出错！")
        #print(e)
        traceback.print_exc()
        conn.rollback()
    finally:
        conn.close()

#更新标志位为信息格式错误
def updateErrorFlag(fromid):
    try:
        conn = pymysql.connect(host=host, user=user, password=passwd, db=database, charset=charset)
        cur = conn.cursor()
        sql = "update {} set flag=2 where id=%s".format(urlTable)
        cur.execute(sql, fromid)
        conn.commit()

        print("flag更新成功！")
    except Exception as e:
        print("flag更新时出错！")
        print(e)
        conn.rollback()
    finally:
        conn.close()

#读取文章表的最大textid
def readMaxTextid():
    try:
        conn = pymysql.connect(host=host, user=user, password=passwd, db=database, charset=charset)
        cur = conn.cursor()
        sql = "select max(textid) from {}".format(textTable)
        cur.execute(sql)
        num = cur.fetchone()

        if num[0]==None: #不存在textid
            return 0
        else:
            return int(num[0])
    except Exception as e:
        print("读取最大textid出错！")
        print(e)
        conn.rollback()
        return -1
    finally:
        conn.close()

def saveReadingOrCloze(result):
    '''
    sql1 = "INSERT ignore INTO {} (textid,text,qnum) " \
           "VALUE(%s,%s,%s)".format(textTable)
    print(sql1)

    sql2 = "INSERT ignore INTO {} (%s) VALUE (%s)".format(squesTable)
    for qusDict in result[1]:
        key_cols = ", ".join('{}'.format(k) for k in qusDict.keys())
        val_cols = ", ".join('`{}`'.format(k) for k in qusDict.values())

        realsql2 = sql2 % (key_cols, val_cols)
        print(realsql2)
    '''
    try:
        conn = pymysql.connect(host=host, user=user, password=passwd, db=database, charset=charset)
        cur = conn.cursor()

        sql1="INSERT ignore INTO {} (textid,text,qnum) " \
              "VALUE(%s,%s,%s)".format(textTable)
        cur.execute(sql1, result[0])
        conn.commit()

        sql2 = "INSERT ignore INTO {} (%s) VALUE (%s)".format(squesTable)
        for qusDict in result[1]:
            fie_cols = ", ".join('`{}`'.format(k) for k in qusDict.keys())
            val_cols = ", ".join('%({})s'.format(k) for k in qusDict.keys())

            realsql2 = sql2 % (fie_cols, val_cols)

            #print(realsql2)
            cur.execute(realsql2,qusDict)
            conn.commit()


        fromid=int(result[1][0]['fromid'])
        #更新标志位为已经爬取成功
        sql3="update {} set flag=1 where id=%s".format(urlTable)
        cur.execute(sql3,fromid)
        conn.commit()

        print("网页信息存储成功！")
    except Exception as e:
        print("存储网页信息时出错！")
        #print(e)
        traceback.print_exc()
        conn.rollback()
    finally:
        conn.close()


'''
if __name__=='__main__':
    readUrls()



# 获取总条数
def readUrlNum(tagname):
    try:
        urllist = []
        conn = pymysql.connect(host=host, user=user, password=passwd, db=database, charset=charset)
        cur = conn.cursor()
        sql = "select count(1) from " + tagname
        cur.execute(sql)
        num = cur.fetchone()
        conn.close()
        return int(num[0])

    except:
        print("读取URL数量时数据库错误!")
        traceback.print_exc()
        conn.close()
        return []

'''
if __name__ =='__main__':
    #result=['2019年山东省文化和旅游厅 所属事业单位公开招聘工作人员考察体检公示', '山东省文化和旅游厅', '文化、广电、新闻出版', '全部', '2019-03-26 00:00:00', '2019-03-26 18:47:58', '根据省人社厅《关于2019年省属事业单位公开招聘工作人员有关问题的通知》要求，2019年省文化和旅游厅所属省文化艺术学校、省艺术研究院等2个事业单位公开招聘工作人员考试工作已经结束。根据省人社厅规定：“面试结束后，按笔试成绩和面试成绩各占50％的比例，百分制计算应聘人员考试总成绩。同一招聘岗位应聘人员出现总成绩并列的，按笔试成绩由高分到低分确定进入考察范围人选”，“按照招聘岗位，根据应聘人员考试总成绩，由高分到低分不高于1:1.5的比例，确定进入考察范围人选，组织考察。对考察合格人员，按照招聘人数1:1的比例确定进入体检范围人选。”现将参加等额考察体检人员及进入递补考察体检范围人员情况公示如下：\n\n\n参加等额考察体检人员名单\n序号\n招聘单位\n名称\n岗位名称\n姓名\n准考证号\n笔试成绩\n面试成绩\n总成绩\n1\n山东省文化艺术学校\n英语教师\n张莹\n201902002\n81.50\n90.00\n85.75\n2\n工艺美术教师\n崔爽\n201902007\n90.50\n89.00\n89.75\n3\n山东省艺术研究院\n影视制作与剪辑\n孟傲\n201901033\n92.50\n91.60\n92.05\n4\n会计\n王辉\n201901028\n79.00\n79.60\n79.30\n\n\n\n\n\n进入递补考察体检范围人员名单\n序号\n招聘单位\n名称\n岗位名称\n姓名\n考生编号\n笔试成绩\n面试成绩\n总成绩\n1\n山东省文化艺术学校\n英语教师\n徐朋焕\n201902006\n79.00\n79.00\n79.00\n2\n工艺美术教师\n刘瑞新\n201902008\n87.50\n75.00\n81.25\n3\n山东省艺术研究院\n影视制作与剪辑\n高菲\n201901036\n87.00\n64.00\n75.50\n4\n会计\n张孝爽\n201901012\n72.00\n69.60\n70.80\n\n\n公示期：2019年3月26日-4月1日\n联系电话：0531-86568852 86568826\n\n山东省文化和旅游厅\n2019年3月26日\n', '[]', '[]', '2019-03-26 21:33:52']
    #saveContent(1,result)
    print(readUrls())
    print(readMaxTextid())
    result=[[1, '<p>We are warned by our teachers not to waste time because time<u> 21 </u>will never return. I think it quite<u> 22. </u>What does time look<u> 23?</u> Nobody knows, and we can’t see it or touch it and no<u> 24 </u>of money can buy it. Time is abstract(抽象的), so we have to <u>\xa025</u>about it.<br/> Time passes very quickly. Some students say they don’t have<u> 26</u>time to review their lessons. It is<u> 27 </u>they don’t know how to make use of their time. They waste it in going to theatres or playing, and <u>28 </u>other useless things. Why do we study everyday? Why do we work? Why do most people <u>29 </u>take buses instead of walking? The answer is very <u>30 </u>.We wish to save time because time is<u>31.</u><br/> Today we are living in the 21<sup>st</sup> century. We <u>32 </u>time as life. When a person dies, his life ends. Since life is short, we must <u>33 </u>our time and energy to our study so that we <u>34 </u>be able to work and live well in the future. Laziness is the <u>35 </u>of time, for it not only brings us <u>36,</u> but also does other <u>37 </u>to us. If it is necessary for us to do our work today, <u>38 </u>we do it today and not <u>39 </u>it until tomorrow. Remember that time is much more<u> 40.</u><br/></p>', 20], [{'fromid': 1111, 'typeid': 7, 'textid': 1, 'title': '【小题1】', 'choiceA': 'lost', 'choiceB': 'passed', 'choiceC': 'missed', 'choiceD': 'used', 'answer': 'A', 'analysis': '【小题1】A 形容词辨析。Lost失去的；句意：失去的时间再也不会回来。'}, {'fromid': 1111, 'typeid': 7, 'textid': 1, 'title': '【小题2】', 'choiceA': 'important', 'choiceB': 'true', 'choiceC': 'interesting', 'choiceD': 'usual', 'answer': 'B', 'analysis': '【小题2】B 形容词辨析。A重要；B对的；C有趣的；D通常的；我认为失去的时间在也不回来是正确的。'}, {'fromid': 1111, 'typeid': 7, 'textid': 1, 'title': '【小题3】', 'choiceA': 'for ', 'choiceB': 'like ', 'choiceC': 'after', 'choiceD': 'over', 'answer': 'B', 'analysis': '【小题3】B 固定词组。Look like…看起来想…；没有人知道时间看起来像…'}, {'fromid': 1111, 'typeid': 7, 'textid': 1, 'title': '【小题4】', 'choiceA': 'amount', 'choiceB': 'quality', 'choiceC': 'quantity', 'choiceD': 'price', 'answer': 'A', 'analysis': '【小题4】A 名词辨析。No amount of指没有什么钱可以购买时间。'}, {'fromid': 1111, 'typeid': 7, 'textid': 1, 'title': '【小题5】', 'choiceA': 'think ', 'choiceB': 'imagine', 'choiceC': 'examine', 'choiceD': 'check', 'answer': 'B', 'analysis': '【小题5】B 动词辨析。A思考；B想象；C检查；D核对；时间很抽象，我们不得不去想象它样子。'}, {'fromid': 1111, 'typeid': 7, 'textid': 1, 'title': '【小题6】', 'choiceA': 'spare ', 'choiceB': 'free', 'choiceC': 'enough', 'choiceD': 'much', 'answer': 'C', 'analysis': '【小题6】C 形容词辨析。A多余的；B空闲的；C足够的；D多的；一些学生说他们没有足够的时间来复习功课。'}, {'fromid': 1111, 'typeid': 7, 'textid': 1, 'title': '【小题7】', 'choiceA': 'that', 'choiceB': 'why', 'choiceC': 'because', 'choiceD': 'certain', 'answer': 'C', 'analysis': '【小题7】C 连词辨析。句意：那时因为他们不知道如何利用时间。'}, {'fromid': 1111, 'typeid': 7, 'textid': 1, 'title': '【小题8】', 'choiceA': 'doing', 'choiceB': 'making', 'choiceC': 'taking', 'choiceD': 'getting', 'answer': 'A', 'analysis': '【小题8】A 上下文结构。And是并列连词，这里的doing与上文的doing是对应关系。'}, {'fromid': 1111, 'typeid': 7, 'textid': 1, 'title': '【小题9】', 'choiceA': 'needn’t', 'choiceB': 'have to', 'choiceC': 'had better', 'choiceD': 'would rather', 'answer': 'B', 'analysis': '【小题9】B 词义辨析。A不需要；B不得不；C最好；D宁愿；很多人不得不坐公交车而不是步行。'}, {'fromid': 1111, 'typeid': 7, 'textid': 1, 'title': '【小题10】', 'choiceA': 'easy', 'choiceB': 'simple', 'choiceC': 'stupid', 'choiceD': 'interesting', 'answer': 'B', 'analysis': '【小题10】B 形容词辨析。A容易；B简单；C愚蠢；D有趣；答案很简单，我们要节省时间。'}, {'fromid': 1111, 'typeid': 7, 'textid': 1, 'title': '【小题11】', 'choiceA': 'worthless', 'choiceB': 'priceless', 'choiceC': 'ready', 'choiceD': 'little', 'answer': 'B', 'analysis': '【小题11】B 形容词辨析。A不值钱；B无价的；C准备好的，愿意的；D少的；句意：我们要节省时间，因为时间是无价的。'}, {'fromid': 1111, 'typeid': 7, 'textid': 1, 'title': '【小题12】', 'choiceA': 'look upon', 'choiceB': 'agree ', 'choiceC': 'think', 'choiceD': 'believe', 'answer': 'A', 'analysis': '【小题12】A 固定词组。Look on…as…把…看做…'}, {'fromid': 1111, 'typeid': 7, 'textid': 1, 'title': '【小题13】', 'choiceA': 'spend', 'choiceB': 'give', 'choiceC': 'set', 'choiceD': 'devote', 'answer': 'D', 'analysis': '【小题13】D 固定词组;devote…to…把…用于…我们要把时间和精力放在学习上，以便未来我们也许可生活学习的更好。'}, {'fromid': 1111, 'typeid': 7, 'textid': 1, 'title': '【小题14】', 'choiceA': 'must', 'choiceB': 'should', 'choiceC': 'may', 'choiceD': 'would', 'answer': 'C', 'analysis': '【小题14】C情态动词辨析.A 必须；B应该；C也许；D会；句意同38解释。'}, {'fromid': 1111, 'typeid': 7, 'textid': 1, 'title': '【小题15】', 'choiceA': 'helper', 'choiceB': 'thief', 'choiceC': 'friend', 'choiceD': 'teacher', 'answer': 'B', 'analysis': '【小题15】B 名词辨析。A帮助者；B小偷；C朋友；D老师；懒惰是时间的小偷。'}, {'fromid': 1111, 'typeid': 7, 'textid': 1, 'title': '【小题16】', 'choiceA': 'wealth', 'choiceB': 'health', 'choiceC': 'failure', 'choiceD': 'illness', 'answer': 'C', 'analysis': '【小题16】C 名词辨析。A财富；B健康；C失败；D疾病；它不仅给我们带来失败而且还会对我们有其它方面的伤害。'}, {'fromid': 1111, 'typeid': 7, 'textid': 1, 'title': '【小题17】', 'choiceA': 'danger', 'choiceB': 'harm', 'choiceC': 'trouble', 'choiceD': 'difficulty', 'answer': 'B', 'analysis': '【小题17】B 固定词组。对…有害do harm to…'}, {'fromid': 1111, 'typeid': 7, 'textid': 1, 'title': '【小题18】', 'choiceA': 'help', 'choiceB': 'make', 'choiceC': 'have', 'choiceD': 'let', 'answer': 'D', 'analysis': '【小题18】D 语法分析。Let引导祈使句。让我们从今天开始做起，不要留到明天。'}, {'fromid': 1111, 'typeid': 7, 'textid': 1, 'title': '【小题19】', 'choiceA': 'keep', 'choiceB': 'remain', 'choiceC': 'manage', 'choiceD': 'leave', 'answer': 'D', 'analysis': '【小题19】D 动词辨析。A保持；B任然；C设法；D留下；指我们不能把工作留到明天。'}, {'fromid': 1111, 'typeid': 7, 'textid': 1, 'title': '【小题20】', 'choiceA': 'valuable', 'choiceB': 'expensive', 'choiceC': 'worth', 'choiceD': 'rich', 'answer': 'A', 'analysis': '【小题20】A 形容词辨析。A贵重；B昂贵；B值得的；D富有的；句意：记得时间更为贵重。'}]]

    saveReadingOrCloze(result)

