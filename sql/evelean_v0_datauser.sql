-- V8.X
-- DROP ROLE IF EXISTS 'evelean_admin', 'evelean_read', 'evelean_write';
-- DROP USER IF EXISTS 'evelean'@'%','dev'@'%','reader'@'%','writer'@'%';

-- CREATE ROLE 'evelean_admin', 'evelean_read', 'evelean_write';
-- GRANT ALL ON evelean.* TO 'evelean_admin';
-- GRANT SELECT ON evelean.* TO 'evelean_read';
-- GRANT INSERT, UPDATE, DELETE ON evelean.* TO 'evelean_write';

-- CREATE USER 'evelean'@'%' IDENTIFIED BY 'evelean2018';
-- CREATE USER 'dev'@'%' IDENTIFIED BY 'dev2018';
-- CREATE USER 'reader'@'%' IDENTIFIED BY 'reader2018';
-- CREATE USER 'writer'@'%' IDENTIFIED BY 'writer2018';

-- GRANT 'evelean_admin' TO 'evelean'@'%';
-- GRANT 'evelean_admin' TO 'dev'@'%';
-- GRANT 'evelean_read' TO 'reader'@'%';
-- GRANT 'evelean_write' TO 'writer'@'%';

-- FLUSH PRIVILEGES;

-- SET DEFAULT ROLE ALL to 'evelean'@'%';
-- SET DEFAULT ROLE ALL to 'dev'@'%';
-- SET DEFAULT ROLE ALL to 'reader'@'%';
-- SET DEFAULT ROLE ALL to 'writer'@'%';

-- V5.6
DROP USER IF EXISTS 'evelean'@'localhost','dev'@'localhost','reader'@'localhost','writer'@'localhost';

CREATE USER 'evelean'@'localhost' IDENTIFIED BY 'evelean2018';
CREATE USER 'dev'@'localhost' IDENTIFIED BY 'dev2018';
CREATE USER 'reader'@'localhost' IDENTIFIED BY 'reader2018';
CREATE USER 'writer'@'localhost' IDENTIFIED BY 'writer2018';

GRANT ALL ON evelean.* TO 'evelean'@'localhost';
GRANT ALL ON evelean.* TO 'dev'@'localhost';
GRANT SELECT ON evelean.* TO 'reader'@'localhost';
GRANT INSERT, UPDATE, DELETE ON evelean.* TO 'writer'@'localhost';

FLUSH PRIVILEGES;

