DROP TABLE IF EXISTS ab_person, ab_personaddress, ab_personphone;

CREATE TABLE ab_person (
	PersonID INT(11) PRIMARY KEY AUTO_INCREMENT, 
    PersonFirstName VARCHAR(255) NULL,
    PersonLastName VARCHAR(255) NULL, 
    PersonEmail VARCHAR(255) NULL, 
    PersonBirthDate DATE NULL, 
    PersonIsActive INT(11) NULL,
    GenderID INT(11),
    UserIDInserted INT(11) NULL, 
    UserIDUpdated INT(11) NULL, 
    UserIDLocked INT(11) NULL, 
    TimeInserted DATETIME NULL, 
    TimeUpdated DATETIME NULL, 
    TimeLocked DATETIME NULL,
    INDEX(PersonFirstName),
    INDEX(PersonEmail),
    INDEX(GenderID)
) ENGINE = MyISAM;

CREATE TABLE ab_personaddress (
	PersonAddressID INT(11) PRIMARY KEY AUTO_INCREMENT, 
    PersonAddressType VARCHAR(255) NULL, 
    PersonAddressName VARCHAR(255) NULL, 
    PersonAddressStreet VARCHAR(255) NULL,
    PersonAddressCity VARCHAR(255) NULL,
    PersonAddressState VARCHAR(255) NULL,
    PersonAddressZip VARCHAR(255) NULL,
    PersonAddressIsActive INT(255) NULL,
    CountryID INT(11),
    PersonID INT(11), 
    UserIDInserted INT(11) NULL, 
    UserIDUpdated INT(11) NULL, 
    UserIDLocked INT(11) NULL, 
    TimeInserted DATETIME NULL, 
    TimeUpdated DATETIME NULL, 
    TimeLocked DATETIME NULL,
    INDEX(PersonAddressName),
    INDEX(PersonID),
    INDEX(CountryID)
) ENGINE = MyISAM;

CREATE TABLE ab_personphone (
	PersonPhoneID INT(11) PRIMARY KEY AUTO_INCREMENT, 
    PersonPhoneType VARCHAR(255) NULL, 
    PersonPhoneNumber VARCHAR(255) NULL, 
    PersonPhoneIsActive INT(11) NULL,
    PersonID INT(11), 
    UserIDInserted INT(11) NULL, 
    UserIDUpdated INT(11) NULL, 
    UserIDLocked INT(11) NULL, 
    TimeInserted DATETIME NULL, 
    TimeUpdated DATETIME NULL, 
    TimeLocked DATETIME NULL,
    INDEX(PersonPhoneNumber),
    INDEX(PersonID)
) ENGINE = MyISAM;