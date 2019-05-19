# 爬虫说明

本爬虫爬取21时间教育的高中英语在线题库,其中爬取题目url的入口是urldetect，爬取题目内容的入口是quesdetect

urldetect需要在代码中指定爬取的链接，quescrawl爬取数据库还没有爬取过的题目URL

sql文件是数据库的内容，里面没有题目的信息，需要先爬取URL再爬内容

crawl.py、crawl2.py、crawl3.py在爬虫中没有使用，为测试爬取规则的文件
