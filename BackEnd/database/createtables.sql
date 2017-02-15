--User info
CREATE TABLE UserInfo(
	userid int NOT NULL AUTO_INCREMENT,
	username varchar(50) NOT NULL UNIQUE,
	password varchar(50) NOT NULL,
	firstName varchar(50) NOT NULL,
	middleName varchar(50),
	lastName varchar(50) NOT NULL,
	emailAddress varchar(254) NOT NULL,
	phoneNumber int,
	major1 varchar(50) NOT NULL,
	major2 varchar(50),
	major3 varchar(50),
	minor1 varchar(50),
	minor2 varchar(50),
	minor3 varchar(50),
	year varchar(10),
	location varchar(50),
	CHECK (year in ('freshman','sophomore','junior','senior','graduate')),
	PRIMARY KEY(userid)
);

--Book posts
CREATE TABLE BookPost(
	bookid int NOT NULL AUTO_INCREMENT,
	userid int NOT NULL,
	title varchar(100) NOT NULL,
	author text NOT NULL,
	edition smallint,
	purpose varchar(4) NOT NULL,
	price decimal(5,2),
	isbn int,
	major varchar(50),
	courseNumber smallint,
	professor varchar(50),
	postDate date DEFAULT GETDATE(),
	condition varchar(5),
	status varchar(20) DEFAULT 'available' NOT NULL,
	CHECK (purpose in ('buy','swap')),
	CHECK (condition in ('new','good','bad')),
	CHECK (status in ('available','sale pending','unavailable')),
	PRIMARY KEY(bookid),
	FOREIGN KEY(userid) REFERENCES UserInfo
);

--Book post description
CREATE TABLE BookDescription(
	bookid int NOT NULL AUTO_INCREMENT,
	description text,
	FOREIGN KEY(bookid) REFERENCES BookPost
);

--Book post photos
CREATE TABLE BookPhoto(
	bookid int NOT NULL AUTO_INCREMENT,
	photo1 image NOT NULL,
	photo2 image,
	photo3 image,
	FOREIGN KEY(bookid) REFERENCES BookPost
);

--Email message
CREATE TABLE Message(
	messageid int NOT NULL AUTO_INCREMENT,
	creator int NOT NULL,
	recipient int NOT NULL,
	subject varchar(100),
	body text,
	messageDate date DEFAULT NULL,
	PRIMARY KEY(messageid),
	FOREIGN KEY(creator) REFERENCES UserInfo(userid),
	FOREIGN KEY(recipient) REFERENCES UserInfo(userid)
);

--Email message reply
CREATE TABLE MessageReply(
	replyid int NOT NULL AUTO_INCREMENT,
	replyUserid int NOT NULL,
	replyMessageid int NOT NULL,
	reply text,
	replyDate date DEFAULT NULL,
	PRIMARY KEY(replyid),
	FOREIGN KEY(replyUserid) REFERENCES UserInfo(userid),
	FOREIGN KEY(replyMessageid) REFERENCES Message(messageid)
);