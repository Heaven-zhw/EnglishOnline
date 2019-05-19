
CREATE TABLE `alogin` (
  `id` int auto_increment,
  `username` varchar(20) unique,
  `pwd` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- 管理员登录帐号和密码
-- admin1     123456
-- admin2     test

INSERT INTO `alogin` (username,pwd) VALUES ('admin1', 'e10adc3949ba59abbe56e057f20f883e');
INSERT INTO `alogin` (username,pwd) VALUES ('admin2', '098f6bcd4621d373cade4e832627b4f6');


CREATE TABLE `ulogin` (
  `id` int auto_increment,
  `username` varchar(20) unique,
  `pwd` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- 用户帐号和密码
-- xiaoming    123456
INSERT INTO `ulogin` (username,pwd) VALUES ('xiaoming', 'e10adc3949ba59abbe56e057f20f883e');

create table `userinfo` (
  `uid` int not null,
  `phone` varchar(15) default null,
  `email` varchar(50) default null,
  `school` varchar(50) default null,
  PRIMARY KEY (`uid`)
)ENGINE=InnoDB  DEFAULT CHARSET=utf8;

INSERT INTO `userinfo` (uid,phone,email,school) VALUES ('1', '17863103650','17863103650@163.com','哈尔滨工业大学');

-- 爬虫用，题目链接表
create table `urlinfo`(
    `id` int auto_increment,
    `typeid` int default null,
    `quesurl` varchar(255) default null unique,
    `flag` char(2) default null,
    `gaintime` datetime,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;


-- 单项选择题
create table `squestion`(
    `id` int auto_increment,
    `fromid` int default null,
    `title` varchar(255) default null,
    `choiceA` varchar(100) default null,
    `choiceB` varchar(100) default null,
    `choiceC` varchar(100) default null,
    `choiceD` varchar(100) default null,
    `answer` char(2) default null,
    `analysis` varchar(255) default null,
    `typeid` tinyint default null,
    `pid` int default null,
    `textid` int default null,
    `remark` varchar(50) default null,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- 题目收藏表
create table `qcollection`(
    `id` int auto_increment,

    `uid` int not null,
    `qid` int not null,
    `typeid` int not null,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- 试题题型表
create table `qtype`(
    `typeid` tinyint,
    `tname` varchar(10) default null,
    PRIMARY KEY (`typeid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
INSERT INTO `qtype` (typeid,tname) VALUES (1, '单选题');
INSERT INTO `qtype` (typeid,tname) VALUES (4, '填空题');
INSERT INTO `qtype` (typeid,tname) VALUES (6, '完形填空');
INSERT INTO `qtype` (typeid,tname) VALUES (7, '阅读理解');
INSERT INTO `qtype` (typeid,tname) VALUES (8, '写作');
INSERT INTO `qtype` (typeid,tname) VALUES (10, '其他题型');
INSERT INTO `qtype` (typeid,tname) VALUES (22, '单词拼写');
INSERT INTO `qtype` (typeid,tname) VALUES (25, '改错');
INSERT INTO `qtype` (typeid,tname) VALUES (31, '信息分析题');




-- 阅读文本表
-- textid为实际使用的阅读文本的id
create table `readtext`(
    `id` int auto_increment,
    `textid` int default null unique,
    `text` text default null,
    `qnum` int default null,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- 试卷信息表
create table `papar`(
    `id` int auto_increment,
    `source` varchar(50) default null,
    `qnum` int default null,
    `pcontent` text default null,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
