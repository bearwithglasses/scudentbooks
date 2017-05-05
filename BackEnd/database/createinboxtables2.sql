DROP TABLE Message;
DROP TABLE Subject;
DROP TABLE Inbox;
DROP TABLE Sent;
DROP TABLE Trash;

--Subject
CREATE TABLE Subject(
	subjectid varchar(5) NOT NULL,
	subject clob,
	subjectDate date DEFAULT NULL,
	userid1 varchar(5) NOT NULL,
	userid2 varchar(5) NOT NULL,
	PRIMARY KEY(subjectid),
	FOREIGN KEY(userid1) REFERENCES UserInfo(userid),
	FOREIGN KEY(userid2) REFERENCES UserInfo(userid)
) TABLESPACE STUDENTBOOKS;

--Message
CREATE TABLE Message(
	messageid varchar(5) NOT NULL,
	subjectid varchar(5) NOT NULL,
	userid varchar(5) NOT NULL,
	messageDate date DEFAULT NULL,
	body clob,
	PRIMARY KEY(messageid),
	FOREIGN KEY(subjectid) REFERENCES Subject,
	FOREIGN KEY(userid) REFERENCES UserInfo
) TABLESPACE STUDENTBOOKS;

--Inbox
CREATE TABLE Inbox(
	subjectid varchar(5) NOT NULL,
	subjectDate date DEFAULT NULL,
	userid varchar(5) NOT NULL,
	subject clob,
	FOREIGN KEY(subjectid) REFERENCES Subject,
	FOREIGN KEY(subjectDate) REFERENCES Subject,
	FOREIGN KEY(userid) REFERENCES UserInfo,
	FOREIGN KEY(subject) REFERENCES Subject
) TABLESPACE STUDENTBOOKS;