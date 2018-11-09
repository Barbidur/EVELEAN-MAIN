USE evelean;

INSERT INTO customer (customer_email,customer_name) VALUES ('contact1@customer1.com','customer1');
SET @cust1_id = LAST_INSERT_ID();
INSERT INTO customer (customer_email,customer_name) VALUES ('contact2@customer1.com','customer2');
SET @cust2_id = LAST_INSERT_ID();

INSERT INTO user (user_login,user_password,customer_id) VALUES ('user1_1',md5('pwd1_1'),@cust1_id);
INSERT INTO user (user_login,user_password,customer_id) VALUES ('user2_1',md5('pwd2_1'),@cust1_id);
INSERT INTO user (user_login,user_password,customer_id) VALUES ('user1_2',md5('pwd1_2'),@cust2_id);

INSERT INTO instance (instance_aws_id,instance_aws_name,customer_id) VALUES ('aws_inst_id_1','ec2_1',@cust1_id);
INSERT INTO instance (instance_aws_id,instance_aws_name,customer_id) VALUES ('aws_inst_id_2','ec2_2',@cust2_id);

INSERT INTO credit_card (credit_card_stripe_token,customer_id) VALUES ('stripe_token_1',@cust1_id);
INSERT INTO credit_card (credit_card_stripe_token,customer_id) VALUES ('stripe_token_2',@cust2_id);
