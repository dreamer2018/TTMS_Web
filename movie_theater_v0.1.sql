/*==============================================================*/
/* DBMS name:      MySQL 5.x                                    */
/* Created on:     2016/6/13 15:40:40                           */
/*==============================================================*/
DROP DATABASE IF EXISTS ttms_web;
CREATE DATABASE ttms_web;
use ttms_web;

DROP TABLE IF EXISTS generalmanager;   /*总经理*/
DROP TABLE IF EXISTS manager;          /*经理*/
DROP TABLE IF EXISTS employee;         /*售票员*/
DROP TABLE IF EXISTS customer;         /*顾客*/
DROP TABLE IF EXISTS theater;          /*剧院*/
DROP TABLE IF EXISTS studio;           /*演出厅*/
DROP TABLE IF EXISTS seat;             /*座位*/
DROP TABLE IF EXISTS ticket;           /*票*/
DROP TABLE IF EXISTS bill;             /*账单*/
DROP TABLE IF EXISTS play;             /*剧目*/
DROP TABLE IF EXISTS schedule;         /*演出计划*/
DROP TABLE IF EXISTS type;             /*剧目类型*/
DROP TABLE IF EXISTS lang;             /*剧目语言*/
DROP TABLE IF EXISTS level;            /*剧目等级*/


/*==============================================================*/
/* Table: generalmanager                                        */
/*==============================================================*/
CREATE TABLE generalmanager(
  id                INT            AUTO_INCREMENT,
  emp_no            CHAR(8)        NOT NULL ,                #工号 总经理由1开头，经理2开头，售票员3开头
  name              VARCHAR(40),                             #总经理姓名
  passwd            VARCHAR(20)    DEFAULT '000000',         #总经理密码，初始密码000000
  PRIMARY KEY (id)
);

/*==============================================================*/
/* Table: manager     剧院经理                                   */
/*==============================================================*/
CREATE TABLE manager(
  id                INT            AUTO_INCREMENT,
  emp_no            CHAR(8)        NOT NULL,            #工号 总经理由1开头，经理2开头，售票员3开头
  theater_id        INT            NOT NULL,            #剧院id
  name              VARCHAR(40),                        #经理姓名，初始秘密000000
  passwd            VARCHAR(20)    DEFAULT '000000',    #经理密码
  PRIMARY KEY (id)
);

/*==============================================================*/
/* Table: employee     售票员                                   */
/*==============================================================*/
CREATE TABLE employee(
  id                INT           AUTO_INCREMENT,
  emp_no            CHAR(8)       NOT NULL,         #工号 总经理由1开头，经理2开头，售票员3开头
  theater_id        INT           NOT NULL,         #剧院id
  name              VARCHAR(40),                    #售票员姓名
  passwd            VARCHAR(20)   DEFAULT '000000', #售票员密码,初始密码000000
  tel               BIGINT(11),                        #售票员手机号码
  PRIMARY KEY (id)
);

/*==============================================================*/
/* Table: customer  顾客                                        */
/*==============================================================*/
CREATE TABLE customer(
  id                INT           AUTO_INCREMENT,
  name              VARCHAR(40),                    #顾客姓名
  tel               BIGINT(11)       NOT NULL,         #顾客电话号码
  PRIMARY KEY (id)
);

/*==============================================================*/
/* Table: theater   剧院                                         */
/*==============================================================*/
CREATE TABLE theater(
  id              INT            AUTO_INCREMENT,
  name            VARCHAR(40)    NOT NULL ,        #影院名
  studio_number   SMALLINT       NOT NULL ,        #影厅数量
  addr            VARCHAR(50)    NOT NULL ,        #剧院地址
  PRIMARY KEY (id)
);

/*==============================================================*/
/* Table: studio  演出厅                                         */
/*==============================================================*/
CREATE TABLE studio(
  id              INT          AUTO_INCREMENT,
  theater_id      INT          NOT NULL ,         #剧院id
  name            VARCHAR(40)  NOT NULL ,         #演出厅名称
  row             SMALLINT     NOT NULL ,         #演出厅列数
  col             SMALLINT     NOT NULL ,         #演出厅行数
  PRIMARY KEY (id)
);

/*==============================================================*/
/* Table:  seat 座位                                            */
/*==============================================================*/
CREATE TABLE seat(
  id             INT          AUTO_INCREMENT,
  studio_id      INT          NOT NULL ,              #演出厅id
  row            SMALLINT     NOT NULL ,              #座位所在行
  col            SMALLINT     NOT NULL ,              #座位所在列
  status         TINYINT      DEFAULT 1,              #座位状态 -1：不存在 0：损坏 1：可用
  PRIMARY KEY (id)
);

/*==============================================================*/
/* Table:  ticket 票                                            */
/*==============================================================*/

CREATE TABLE ticket(
  id           INT           AUTO_INCREMENT,
  seat_id      INT           NOT NULL ,               #座位id
  schedule_id  INT           NOT NULL ,               #演出计划id
  price        NUMERIC(10,2) NOT NULL ,               #票价
  status       TINYINT       DEFAULT 0,               #票的状态 0：待售 1：锁定 2：卖出
  locktime     CHAR(14)   DEFAULT '19700101000000',  #锁票时间2016年6月13号18点23分4秒 保存为：20160613182304
  PRIMARY KEY (id)
);

/*==============================================================*/
/* Table:  bill 账单                                            */
/*==============================================================*/
CREATE TABLE bill(
  id          INT           AUTO_INCREMENT,
  customer_id INT           NOT NULL ,                #顾客id
  ticket_id   INT           NOT NULL ,                #票id
  emp_id      INT           NOT NULL ,                #售票员id
  sale_time   CHAR(14)   DEFAULT '19700101000000',   #售票时间2016年6月13号18点23分4秒 保存为：20160613182304
  PRIMARY KEY (id)
);

/*==============================================================*/
/* Table:  play 剧目                                            */
/*==============================================================*/
CREATE TABLE play(
  id            INT           AUTO_INCREMENT,
  name          VARCHAR(40)   NOT NULL ,      #剧名
  type_id       INT           NOT NULL ,      #剧目类型id
  lang_id       INT           NOT NULL ,      #剧目语言id
  level_id      INT           NOT NULL ,      #剧目等级id
  score         TINYINT       NOT NULL ,      #评分
  Introduction  VARCHAR(1000) NOT NULL ,      #剧目简介
  image_url     VARCHAR(100)  NOT NULL ,      #剧目图片url
  length        SMALLINT      NOT NULL ,      #剧目长度
  price         NUMERIC(10,2) NOT NULL ,      #票价
  status        TINYINT       DEFAULT 0,      #状态 0:待安排 1：已安排 -1：下线
  PRIMARY KEY (id)
 );

/*==============================================================*/
/* Table:  schedule 演出计划                                     */
/*==============================================================*/

CREATE TABLE schedule(
  id            INT           AUTO_INCREMENT,
  studio_id     INT           NOT NULL ,      #演出厅id
  play_id       INT           NOT NULL ,      #剧目id
  time          char(12)       NOT NULL ,      #放映时间
  discount      NUMERIC(2,1) ,                #折扣
  price         NUMERIC(10,2) NOT NULL ,      #票价
  status        tinyint       not null ,      #演出计划状态,1 未过期 0 过期
  PRIMARY KEY (id)
);

/*==============================================================*/
/* Table:  type 剧目类型                                         */
/*==============================================================*/
CREATE TABLE type(
  id           INT           AUTO_INCREMENT,
  type         VARCHAR(20)   NOT NULL ,         # 爱情，动作，剧情等
  PRIMARY KEY (id)
);


/*==============================================================*/
/* Table:  lang 剧目语言                                         */
/*==============================================================*/
CREATE TABLE lang(
  id           INT          AUTO_INCREMENT,
  type         VARCHAR(20)  NOT NULL ,         # 英语，法语，粤语，汉语，日语，韩语等
  PRIMARY KEY (id)
);

/*==============================================================*/
/* Table:  level 剧目等级                                        */
/*==============================================================*/
CREATE TABLE level(
  id           INT         AUTO_INCREMENT,
  type         VARCHAR(20) NOT NULL ,         # 2D 3D IMAX
  PRIMARY KEY (id)
);

/*==============================================================*/
/* Table:  online 在线列表                                        */
/*==============================================================*/



INSERT into generalmanager VALUES (1,'10000001','Boss','123456');

INSERT into manager VALUES (1,'20000001',1,'Manage','123456');


INSERT into employee VALUES (1,'30000001',1,'employ1','123456',12345678901);
INSERT into employee VALUES (2,'30000002',1,'employ2','123456',12345678902);
INSERT into employee VALUES (3,'30000003',1,'employ3','123456',12345678903);
INSERT into employee VALUES (4,'30000004',1,'employ4','123456',12345678904);
INSERT into employee VALUES (5,'30000005',1,'employ5','123456',12345678905);

INSERT into customer VALUES (1,'Cust1',13912345678);
INSERT into customer VALUES (2,'Cust2',13913912345);
INSERT into customer VALUES (3,'Cust3',13913913912);
INSERT into customer VALUES (4,'Cust4',13913913913);
INSERT into customer VALUES (5,'Cust5',12345678912);

INSERT into theater VALUES (1,'NO.1Theater',3,'Street1');
INSERT into theater VALUES (2,'NO.2Theater',4,'Street2');
INSERT into theater VALUES (3,'NO.3Theater',5,'Street3');

INSERT into studio VALUES (1,1,'NO.1Theater.NO.1Studio',10,10);
INSERT into studio VALUES (2,1,'NO.1Theater.NO.2Studio',15,10);
INSERT into studio VALUES (3,1,'NO.1Theater.NO.3Studio',10,15);
INSERT into studio VALUES (4,2,'NO.2Theater.NO.1Studio',20,10);
INSERT into studio VALUES (5,2,'NO.2Theater.NO.2Studio',10,20);
INSERT into studio VALUES (6,2,'NO.2Theater.NO.3Studio',30,10);
INSERT into studio VALUES (7,3,'NO.3Theater.NO.1Studio',10,30);
INSERT into studio VALUES (8,3,'NO.3Theater.NO.1Studio',20,30);
INSERT into studio VALUES (9,3,'NO.3Theater.NO.1Studio',30,20);




INSERT into ticket VALUES (1,1,1,2,5,2);
INSERT into ticket VALUES (2,2,1,2,5,2);
INSERT into ticket VALUES (3,3,1,2,5,2);
INSERT into ticket VALUES (4,1,2,3,5,1);
INSERT into ticket VALUES (5,2,2,3,5,1);
INSERT into ticket VALUES (6,3,2,3,5,1);
INSERT into ticket VALUES (7,1,3,4,5,0);
INSERT into ticket VALUES (8,2,3,4,5,0);
INSERT into ticket VALUES (9,3,3,4,5,0);

INSERT into bill VALUES (1,1,1,1,'20160614182553');

INSERT into play VALUES (1,3,1,1,'X-man',7.3,'***omit:X-man***','C:\Users\Public\Pictures\Sample Pictures\17656011_1358928951505.jpg',90,2.5,-1);
INSERT into play VALUES (2,3,1,2,'Super-man',8.3,'***omit:Super-man***','C:\Users\Public\Pictures\Sample Pictures\17656011_1358928951505.jpg',90,3.5,0);
INSERT into play VALUES (3,3,1,2,'Bat-man',9.3,'***omit:Bat-man***','C:\Users\Public\Pictures\Sample Pictures\17656011_1358928951505.jpg',90,4.5,1);
INSERT into play VALUES (4,1,1,2,'The Conjuring 2',9.0,'***omit:The Conjuring 2***','C:\Users\Public\Pictures\Sample Pictures\17656011_1358928951505.jpg',120,5.5,0);
INSERT into play VALUES (5,3,1,1,'Warcraft: The Beginning',8.0,'***omit:Warcraft: The Beginning***','C:\Users\Public\Pictures\Sample Pictures\17656011_1358928951505.jpg',80,6.5,1);
INSERT into play VALUES (6,2,2,2,'My Wife is a Superstar',4.6,'***omitMy Wife is a Superstar***','C:\Users\Public\Pictures\Sample Pictures\17656011_1358928951505.jpg',95,7.5,0);


INSERT into schedule VALUES (1,1,1,'201606140900',0.9,2.5,1);
INSERT into schedule VALUES (2,2,2,'201606150900',0.8,3.5,1);
INSERT into schedule VALUES (3,3,3,'201606160900',0.7,10.5,1);

INSERT into type VALUES (1,'恐怖');
INSERT into type VALUES (2,'动作');
INSERT into type VALUES (3,'科幻');

INSERT into lang VALUES (1,'英语');
INSERT into lang VALUES (2,'汉语');

INSERT into level VALUES (1,'3D');
INSERT into level VALUES (2,'2D');

INSERT into online VALUES (1,'1','20160614182553');

