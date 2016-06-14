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
DROP TABLE IF EXISTS online;           /*在线列表*/

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
  locktime     VARCHAR(14)   DEFAULT '19700101000000',  #锁票时间2016年6月13号18点23分4秒 保存为：20160613182304
  PRIMARY KEY (id)
);

/*==============================================================*/
/* Table:  bill 账单                                            */
/*==============================================================*/
CREATE TABLE bill(
  id          INT           AUTO_INCREMENT,
  customer_id INT           NOT NULL ,                #顾客id
  ticket_id   INT           NOT NULL ,                #票id
  emp_id      INT           NOT NULL ,                #售票id
  sale_time   VARCHAR(14)   DEFAULT '19700101000000',   #售票时间2016年6月13号18点23分4秒 保存为：20160613182304
  PRIMARY KEY (id)
);

/*==============================================================*/
/* Table:  play 剧目                                            */
/*==============================================================*/
CREATE TABLE play(
  id            INT           AUTO_INCREMENT,
  type_id       INT           NOT NULL ,      #剧目类型id
  lang_id       INT           NOT NULL ,      #剧目语言id
  level_id      INT           NOT NULL ,      #剧目等级id
  name          VARCHAR(40)   NOT NULL ,      #剧名
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
  time          INT(12)       NOT NULL ,      #放映时间
  discount      NUMERIC(2,1) ,                #折扣
  price         NUMERIC(10,2) NOT NULL ,      #票价
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
CREATE TABLE online(
  id          INT          AUTO_INCREMENT,
  emp_no      CHAR(8)      NOT NULL ,
  login_time  VARCHAR(14)  DEFAULT '19700101000000',
  PRIMARY KEY (id)
);

INSERT into generalmanager VALUES (1,'10000001','Boss','123456');

