CREATE TABLE users (
    userID INT AUTO_INCREMENT,
    username VARCHAR(50),
    password VARCHAR(50),
    location VARCHAR(20),
    phoneNum VARCHAR(20),
    email VARCHAR(50),
    CreatedDate DATETIME DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY(userID)
);

CREATE TABLE posts (
    postID INT AUTO_INCREMENT,
    userID INT,
    bookTitle VARCHAR(50),
    CreatedDate DATETIME DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY(postID),
    FOREIGN KEY(userID) REFERENCES users(userID) 
);