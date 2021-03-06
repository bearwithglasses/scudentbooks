DROP TABLE BookPicture;
DROP TABLE BookDescription;
DROP TABLE BookPost;
DROP TABLE UserInfo;

--User info
CREATE TABLE UserInfo(
	userid varchar(5) NOT NULL,
	username varchar(50) NOT NULL UNIQUE,
	password varchar(50) NOT NULL,
	firstName varchar(50) NOT NULL,
	middleName varchar(50),
	lastName varchar(50) NOT NULL,
	emailAddress varchar(254) NOT NULL,
	phoneNumber varchar(50),
	major1 varchar(100) NOT NULL,
	major2 varchar(100),
	major3 varchar(100),
	minor1 varchar(100),
	minor2 varchar(100),
	minor3 varchar(100),
	year varchar(10),
	location varchar(50),
	CHECK (year in ('Freshman','Sophomore','Junior','Senior','Graduate')),
	PRIMARY KEY(userid)
) TABLESPACE STUDENTBOOKS;

--Book posts
CREATE TABLE BookPost(
	bookid varchar(5) NOT NULL,
	userid varchar(5) NOT NULL,
	title nvarchar2(100) NOT NULL,
	author clob NOT NULL,
	edition int,
	purpose varchar(4) NOT NULL,
	price decimal(5,2),
	isbn int,
	major varchar(50),
	courseNumber varchar(20),
	professor clob,
	postDate date DEFAULT NULL,
	condition nvarchar2(20),
	status varchar(20) DEFAULT 'available' NOT NULL,
	CHECK (purpose in ('sell','swap')),
	CHECK (condition in ('new','used - good','used - acceptable')),
	CHECK (status in ('available','sale pending','unavailable')),
	PRIMARY KEY(bookid),
	FOREIGN KEY(userid) REFERENCES UserInfo
) TABLESPACE STUDENTBOOKS;

--Book post description
CREATE TABLE BookDescription(
	bookid varchar(5) NOT NULL,
	description clob,
	FOREIGN KEY(bookid) REFERENCES BookPost
) TABLESPACE STUDENTBOOKS;

--Book post photos
CREATE TABLE BookPicture(
	bookid varchar(5) NOT NULL,
	pic1 varchar(50) NOT NULL,
	pic2 varchar(50),
	pic3 varchar(50),
	FOREIGN KEY(bookid) REFERENCES BookPost
) TABLESPACE STUDENTBOOKS;