use `comp440`;

--
-- Drop all tables
--
DROP TABLE IF EXISTS `blog_tags`;
DROP TABLE IF EXISTS `blog_comments`;
DROP TABLE IF EXISTS `comments`;
DROP TABLE IF EXISTS `blogs`;
DROP TABLE IF EXISTS `tags`;

SET FOREIGN_KEY_CHECKS=0;

--
-- Table structure for table `blogs`
--
CREATE TABLE blogs (
	blogId int NOT NULL AUTO_INCREMENT,
	blogTitle varchar(100) NOT NULL,
	content varchar(2500) NOT NULL,
	ownerUsername varchar(20), 		        -- will be username
	datePosted DATE NOT NULL,
	PRIMARY KEY(blogId),
FOREIGN KEY (ownerUsername) REFERENCES user(username)
);

--
-- Populate initial data for table blogs
--
INSERT INTO `blogs` (blogTitle, content, ownerUsername, datePosted) VALUES ('My Lasagna Recipe', 'My lasagna recipe is good. Lots of cheese, lots of sauce, some spices, bake at 350 etc etc', 'cheese467', '2022-05-01');
INSERT INTO `blogs` (blogTitle, content, ownerUsername, datePosted) VALUES ('Imagine becoming lactose…', 'One day I made myself a bowl of cereal after not having milk in 2 whole years… The next day I found out I became lactose intolerant. Guess what? I cant tolerate it…', 'cheese467', '2022-05-01');
INSERT INTO `blogs` (blogTitle, content, ownerUsername, datePosted) VALUES ('Day in the Life of a Cat', 'imagine literally doing nothing but sleeping and eating what a dream', 'mrcat20', '2022-05-01');
INSERT INTO `blogs` (blogTitle, content, ownerUsername, datePosted) VALUES ('My favorite cat breeds', 'american shorthair, maine coon, siamese, ragdoll, scottish fold', 'mrcat20', '2022-05-01');
INSERT INTO `blogs` (blogTitle, content, ownerUsername, datePosted) VALUES ('Juiceheadz - The Chroniclez', 'Ju-zzzzzzzzzzzz', 'bigjuicy96', '2022-05-01');

--
-- Table structure for table `tags`
--
CREATE TABLE tags (
	tagId int NOT NULL AUTO_INCREMENT,
	tagTitle varchar(20) NOT NULL,
	PRIMARY KEY(tagId)
);

--
-- Populate data into tags table
--
INSERT INTO `tags` (tagTitle) VALUES ('lasagna');
INSERT INTO `tags` (tagTitle) VALUES ('milk');
INSERT INTO `tags` (tagTitle) VALUES ('cats');
INSERT INTO `tags` (tagTitle) VALUES ('juice');
INSERT INTO `tags` (tagTitle) VALUES ('cheese');


-- connects our blog and tags, both are foreign keys
--
-- Table structure for table `blog_tags`
--
CREATE TABLE blog_tags (
	id int AUTO_INCREMENT,
	blogId int,
	tagId int,
	PRIMARY KEY(id),
	FOREIGN KEY (blogId) REFERENCES blogs(blogId),
	FOREIGN KEY (tagId) REFERENCES tags(tagId)
);


--
-- Populate data into blog_tags table
--
INSERT INTO `blog_tags` (blogId, tagId) VALUES (1, 1);
INSERT INTO `blog_tags` (blogId, tagId) VALUES (1, 5);
INSERT INTO `blog_tags` (blogId, tagId) VALUES (2, 2);
INSERT INTO `blog_tags` (blogId, tagId) VALUES (3, 3);
INSERT INTO `blog_tags` (blogId, tagId) VALUES (4, 3);
INSERT INTO `blog_tags` (blogId, tagId) VALUES (5, 4);

--
-- Table structure for table `comments`
CREATE TABLE comments (
	commentId int AUTO_INCREMENT,
	ownerUsername varchar(20), 			    -- will be username
	content varchar(250) NOT NULL,
	sentiment tinyint(1) NOT NULL,
	datePosted DATE NOT NULL,
	PRIMARY KEY(commentID),
	FOREIGN KEY (ownerUsername) REFERENCES user(username)
);

--
-- Populate data into comments table
--
INSERT INTO `comments` (ownerUsername, content, sentiment, datePosted) VALUES ('mrcat20', 'sounds good!', 1, '2022-05-01');
INSERT INTO `comments` (ownerUsername, content, sentiment, datePosted) VALUES ('bigjuicy96', 'lmaoooo', 1, '2022-05-02');
INSERT INTO `comments` (ownerUsername, content, sentiment, datePosted) VALUES ('cheese467', 'i think my cat does more than eat and sleep but pop off i guess', 1, '2022-05-02');
INSERT INTO `comments` (ownerUsername, content, sentiment, datePosted) VALUES ('bigjuicy96', 'cats dont lift couldnt be me', 0, '2022-05-02');
INSERT INTO `comments` (ownerUsername, content, sentiment, datePosted) VALUES ('cheese467', 'maine coons are definitely the cutest!!', 1, '2022-05-03');

-- connects our blogs and comments, both are foreign keys
--
-- Table structure for table `blog_comments`
--
CREATE TABLE blog_comments (
	id int AUTO_INCREMENT,
	blogId int,
	commentId int,
	PRIMARY KEY(id),
	FOREIGN KEY (blogId) REFERENCES blogs(blogId),
	FOREIGN KEY (commentId) REFERENCES comments(commentId)
);

--
-- Populate data into blog_comments table
--
INSERT INTO `blog_comments` (blogId, commentId) VALUES (1, 1);
INSERT INTO `blog_comments` (blogId, commentId) VALUES (2, 2);
INSERT INTO `blog_comments` (blogId, commentId) VALUES (3, 3);
INSERT INTO `blog_comments` (blogId, commentId) VALUES (3, 4);
INSERT INTO `blog_comments` (blogId, commentId) VALUES (4, 5);

SET FOREIGN_KEY_CHECKS=1;
