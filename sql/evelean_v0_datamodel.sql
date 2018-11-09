SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema Evelean
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS evelean ;

-- -----------------------------------------------------
-- Schema evelean
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS evelean DEFAULT CHARACTER SET utf8 ;
USE evelean ;

-- -----------------------------------------------------
-- Table evelean.customer
-- -----------------------------------------------------
DROP TABLE IF EXISTS evelean.customer ;

CREATE TABLE IF NOT EXISTS evelean.customer (
 customer_id BIGINT NOT NULL AUTO_INCREMENT,
 customer_email VARCHAR(255) NOT NULL,
 customer_company VARCHAR(255) NOT NULL,
 customer_fname VARCHAR(255) NOT NULL,
 customer_lname VARCHAR(255) NOT NULL,
 customer_country VARCHAR(255) NOT NULL,
 customer_receive_update BOOLEAN NOT NULL,
 customer_belong_to_group BOOLEAN NOT NULL,
 create_dt DATETIME DEFAULT CURRENT_TIMESTAMP,
 update_dt DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
 PRIMARY KEY (customer_id),
 UNIQUE KEY(customer_email));

-- -----------------------------------------------------
-- Table evelean.customer_info
-- -----------------------------------------------------
DROP TABLE IF EXISTS evelean.customer_info ;

CREATE TABLE IF NOT EXISTS evelean.customer_info (
 customer_info_id BIGINT NOT NULL AUTO_INCREMENT,
 customer_id BIGINT NOT NULL,
 customer_info_business_type INT(10) NOT NULL,
 customer_info_industry VARCHAR(255) NOT NULL,
 customer_info_has_domain BOOLEAN NOT NULL,
 customer_info_facebook_ads_expenditure VARCHAR(255) NOT NULL,
 customer_info_leadpages_target VARCHAR(255) NOT NULL,
 customer_info_domain VARCHAR(255) NOT NULL,
 create_dt DATETIME DEFAULT CURRENT_TIMESTAMP,
 update_dt DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
 PRIMARY KEY (customer_info_id),
 INDEX customer_info_customer_id_idx (customer_id ASC),
 CONSTRAINT customer_info_customer_id_fk FOREIGN KEY (customer_id)
 REFERENCES evelean.customer (customer_id)
);

-- -----------------------------------------------------
-- Table evelean.user
-- -----------------------------------------------------
DROP TABLE IF EXISTS evelean.user ;

CREATE TABLE IF NOT EXISTS evelean.user (
 user_id BIGINT NOT NULL AUTO_INCREMENT,
 user_login VARCHAR(255) NOT NULL,
 user_password VARCHAR(255) NOT NULL,
 customer_id BIGINT NOT NULL,
 create_dt DATETIME DEFAULT CURRENT_TIMESTAMP,
 update_dt DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
PRIMARY KEY (user_id),
UNIQUE KEY(user_login),
INDEX user_customer_id_idx (customer_id ASC),
CONSTRAINT user_customer_id_fk FOREIGN KEY (customer_id)
REFERENCES evelean.customer (customer_id)
);


-- -----------------------------------------------------
-- Table evelean.instance
-- -----------------------------------------------------
DROP TABLE IF EXISTS evelean.instance ;

CREATE TABLE IF NOT EXISTS evelean.instance (
 instance_id BIGINT NOT NULL AUTO_INCREMENT,
 instance_aws_id VARCHAR(255) NOT NULL,
 instance_aws_name VARCHAR(255) NOT NULL,
 customer_id BIGINT NOT NULL,
 create_dt DATETIME DEFAULT CURRENT_TIMESTAMP,
 update_dt DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
PRIMARY KEY (instance_id),
UNIQUE KEY(instance_aws_id),
INDEX instance_customer_id_idx (customer_id ASC),
CONSTRAINT instance_customer_id_fk FOREIGN KEY (customer_id)
REFERENCES evelean.customer (customer_id)
);

-- -----------------------------------------------------
-- Table evelean.credit_card
-- -----------------------------------------------------
DROP TABLE IF EXISTS evelean.credit_card ;

CREATE TABLE IF NOT EXISTS evelean.credit_card (
 credit_card_id INT NOT NULL AUTO_INCREMENT,
 credit_card_stripe_token VARCHAR(255) NOT NULL,
 customer_id BIGINT NOT NULL,
 create_dt DATETIME DEFAULT CURRENT_TIMESTAMP,
 update_dt DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
PRIMARY KEY (credit_card_id),
UNIQUE KEY(credit_card_stripe_token),
INDEX credit_card_customer_id_idx (customer_id ASC),
CONSTRAINT credit_card_customer_id_fk FOREIGN KEY (customer_id)
REFERENCES evelean.customer (customer_id)
);

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
