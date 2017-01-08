## 数据库初始化
CREATE DATABASE iblog;
use iblog

## 用户
CREATE TABLE users (
    id INT NOT NULL AUTO_INCREMENT,
    username VARCHAR(20) NOT NULL UNIQUE,
    password VARCHAR(20) NOT NULL,
    createtime INT,
    PRIMARY KEY ( id )
)DEFAULT CHARSET=utf8;
INSERT INTO users (username, password, createtime) VALUES('root', '1234qwer!', 1483804445);

## 课程
CREATE TABLE lessons (
    teachername VARCHAR(20) NOT NULL,
    lessonname VARCHAR(20) NOT NULL,
    day INT NOT NULL,
    section INT NOT NULL,
    PRIMARY KEY (lessonname, teachername)
)DEFAULT CHARSET=utf8;

## 用户-课程
CREATE TABLE u2l (
    username VARCHAR(20) NOT NULL,
    lessonname VARCHAR(20) NOT NULL,
    score INT,
    PRIMARY KEY ( username, lessonname ),
    FOREIGN KEY ( username ) REFERENCES users ( username ),
    FOREIGN KEY ( lessonname ) REFERENCES lessons ( lessonname )
)DEFAULT CHARSET=utf8; 
