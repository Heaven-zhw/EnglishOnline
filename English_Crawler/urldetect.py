
from urlcrawl import get_all
#单选语法题
href="https://tiku.21cnjy.com/tiku.php?mod=quest&channel=4&cid=1581&xd=3&type=1"
#单选词汇题
href2="https://tiku.21cnjy.com/tiku.php?mod=quest&channel=4&cid=1571&xd=3&type=1"
#阅读理解题
href3="https://tiku.21cnjy.com/tiku.php?mod=quest&channel=4&cid=1637&type=7&xd=3"
#完型填空题
href4="https://tiku.21cnjy.com/tiku.php?mod=quest&channel=4&cid=1625&type=6&xd=3"

href_need_page=href+"&page="
href_need_page3=href3+"&page="
href_need_page4=href4+"&page="

#get_all(href_need_page,1,100)
get_all(href_need_page3,1,20)
get_all(href_need_page4,1,10)
