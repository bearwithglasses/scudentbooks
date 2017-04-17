DROP TABLE Message;
DROP TABLE Subject;
DROP TABLE Inbox;
DROP TABLE Sent;
DROP TABLE Trash;
DROP TABLE Conversation;

--Conversation
CREATE TABLE Conversation(
	conversationid varchar(5) NOT NULL,
	userid1 varchar(5) NOT NULL,
	userid2 varchar(5) NOT NULL,
	PRIMARY KEY(conversationid),
	FOREIGN KEY(userid1) REFERENCES UserInfo(userid),
	FOREIGN KEY(userid2) REFERENCES UserInfo(userid)
) TABLESPACE STUDENTBOOKS;

--Subject
CREATE TABLE Subject(
	subjectid varchar(5) NOT NULL,
	conversationid varchar(5) NOT NULL,
	subject clob,
	subjectDate date DEFAULT NULL,
	PRIMARY KEY(subjectid),
	FOREIGN KEY(conversationid) REFERENCES Conversation
) TABLESPACE STUDENTBOOKS;

--Message
CREATE TABLE Message(
	messageid varchar(5) NOT NULL,
	conversationid varchar(5) NOT NULL,
	subjectid varchar(5) NOT NULL,
	userid varchar(5) NOT NULL,
	messageDate date DEFAULT NULL,
	body clob,
	PRIMARY KEY(messageid),
	FOREIGN KEY(conversationid) REFERENCES Conversation,
	FOREIGN KEY(subjectid) REFERENCES Subject,
	FOREIGN KEY(userid) REFERENCES UserInfo
) TABLESPACE STUDENTBOOKS;

--Inbox
CREATE TABLE Inbox(
	subjectid varchar(5) NOT NULL,
	FOREIGN KEY(subjectid) REFERENCES Subject
) TABLESPACE STUDENTBOOKS;

--Sent
CREATE TABLE Sent(
	subjectid varchar(5) NOT NULL,
	FOREIGN KEY(subjectid) REFERENCES Subject
) TABLESPACE STUDENTBOOKS;

--Trash
CREATE TABLE Trash(
	subjectid varchar(5) NOT NULL,
	FOREIGN KEY(subjectid) REFERENCES Subject
) TABLESPACE STUDENTBOOKS;