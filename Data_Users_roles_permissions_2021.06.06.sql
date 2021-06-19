INSERT INTO users (id,lastname,firstname,enabled,`language`,email,email_verified_at,password,remember_token,created_at,updated_at) VALUES
	 (1,'Moers','Serge',1,'fr','serge.moers@mo-consult.be',NULL,'$2y$10$DLA1UdpGAKmirU0b31ngVeao1fzwJZ.4id3Cm2TplcsJoaKtHSwGm',NULL,'2020-10-31 12:24:09.0','2020-10-31 12:24:09.0'),
	 (2,'De Haese','Hans',1,'nl','hans@fassibelgium.com',NULL,'$2y$10$1WfG8QfBDv3cNaGhl8tjT.Eeh4SOKMZBhCi5p9BUcFJtKuWEBPgBq',NULL,'2021-02-22 19:22:57.0','2021-02-22 19:22:57.0'),
	 (4,'Dodemont','Eric',1,'fr','eric@fassibelgium.com',NULL,'$2y$10$edmKa5is5tuu6S4wLpgdXexoBaFL7gY79aVSgF6E.qcrel4hj35g.',NULL,'2021-02-22 19:24:06.0','2021-02-22 19:24:06.0'),
	 (5,'Godechal','Amandine',1,'fr','administration@fassibelgium.com',NULL,'$2y$10$iZOsMGAxrjlc6xyeR4dRbOn1sXe6SmAM5IBfJaYwQjBEXYeoE.ioK',NULL,'2021-02-22 19:24:17.0','2021-02-22 19:24:17.0');
	 
INSERT INTO roles (id,name,guard_name,created_at,updated_at) VALUES
	 (1,'admin','web','2020-11-07 19:28:06.0','2020-11-07 19:28:06.0'),
	 (2,'manager','web','2021-02-22 19:42:37.0','2021-02-22 19:42:37.0'),
	 (3,'standard','web','2021-05-23 12:49:00.0','2021-05-23 12:49:00.0'),
	 (4,'reader','web','2021-05-23 12:49:00.0','2021-05-23 12:49:00.0'),
	 (5,'limited','web','2021-05-23 12:49:00.0','2021-05-23 12:49:00.0'),
	 (6,'storekeeper','web','2021-05-23 12:49:00.0','2021-05-23 12:49:00.0');
	 
INSERT INTO permissions (id,name,guard_name,created_at,updated_at) VALUES
	 (1,'list customer','web','2021-05-23 12:49:00.0','2021-05-23 12:49:00.0'),
	 (2,'create customer','web','2021-05-23 12:49:00.0','2021-05-23 12:49:00.0'),
	 (3,'edit customer','web','2021-05-23 12:49:00.0','2021-05-23 12:49:00.0'),
	 (4,'consult customer','web','2021-05-23 12:49:00.0','2021-05-23 12:49:00.0'),
	 (5,'list crane','web','2021-05-23 12:49:00.0','2021-05-23 12:49:00.0'),
	 (6,'create crane','web','2021-05-23 12:49:00.0','2021-05-23 12:49:00.0'),
	 (7,'edit crane','web','2021-05-23 12:49:00.0','2021-05-23 12:49:00.0'),
	 (8,'consult crane','web','2021-05-23 12:49:00.0','2021-05-23 12:49:00.0'),
	 (9,'expert crane','web','2021-05-23 12:49:00.0','2021-05-23 12:49:00.0'),
	 (10,'list technician','web','2021-05-23 12:49:00.0','2021-05-23 12:49:00.0');
INSERT INTO permissions (id,name,guard_name,created_at,updated_at) VALUES
	 (11,'create technician','web','2021-05-23 12:49:00.0','2021-05-23 12:49:00.0'),
	 (12,'edit technician','web','2021-05-23 12:49:00.0','2021-05-23 12:49:00.0'),
	 (13,'consult technician','web','2021-05-23 12:49:00.0','2021-05-23 12:49:00.0'),
	 (14,'clocking technician','web','2021-05-23 12:49:00.0','2021-05-23 12:49:00.0'),
	 (15,'list worksheet','web','2021-05-23 12:49:00.0','2021-05-23 12:49:00.0'),
	 (16,'create worksheet','web','2021-05-23 12:49:00.0','2021-05-23 12:49:00.0'),
	 (17,'edit worksheet','web','2021-05-23 12:49:00.0','2021-05-23 12:49:00.0'),
	 (18,'consult worksheet','web','2021-05-23 12:49:00.0','2021-05-23 12:49:00.0'),
	 (19,'clocking worksheet','web','2021-05-23 12:49:00.0','2021-05-23 12:49:00.0'),
	 (20,'part worksheet','web','2021-05-23 12:49:00.0','2021-05-23 12:49:00.0');
INSERT INTO permissions (id,name,guard_name,created_at,updated_at) VALUES
	 (21,'list catalog','web','2021-05-23 12:49:00.0','2021-05-23 12:49:00.0'),
	 (22,'create catalog','web','2021-05-23 12:49:00.0','2021-05-23 12:49:00.0'),
	 (23,'edit catalog','web','2021-05-23 12:49:00.0','2021-05-23 12:49:00.0'),
	 (24,'consult catalog','web','2021-05-23 12:49:00.0','2021-05-23 12:49:00.0'),
	 (25,'price catalog','web','2021-05-23 12:49:00.0','2021-05-23 12:49:00.0'),
	 (26,'print catalog','web','2021-05-23 12:49:00.0','2021-05-23 12:49:00.0'),
	 (27,'list stock','web','2021-05-23 12:49:00.0','2021-05-23 12:49:00.0'),
	 (28,'print stock','web','2021-05-23 12:49:00.0','2021-05-23 12:49:00.0'),
	 (29,'reassort stock','web','2021-05-23 12:49:00.0','2021-05-23 12:49:00.0'),
	 (30,'out stock','web','2021-05-23 12:49:00.0','2021-05-23 12:49:00.0');
INSERT INTO permissions (id,name,guard_name,created_at,updated_at) VALUES
	 (31,'reassort worksheet stock','web','2021-05-23 12:49:00.0','2021-05-23 12:49:00.0'),
	 (32,'out worksheet stock','web','2021-05-23 12:49:00.0','2021-05-23 12:49:00.0'),
	 (33,'admin','web','2021-05-23 12:49:00.0','2021-05-23 12:49:00.0'),
	 (34,'password change','web','2021-05-23 12:49:00.0','2021-05-23 12:49:00.0'),
	 (35,'print worksheet','web','2021-05-23 12:49:00.0','2021-05-23 12:49:00.0'),
	 (36,'consult customer extended','web','2021-06-02 21:50:00.0','2021-06-02 21:50:00.0'),
	 (37,'consult crane extended','web','2021-06-02 21:50:00.0','2021-06-02 21:50:00.0'),
	 (38,'consult technician extended','web','2021-06-02 21:50:00.0','2021-06-02 21:50:00.0'),
	 (39,'consult worksheet extended','web','2021-06-02 21:50:00.0','2021-06-02 21:50:00.0'),
	 (40,'consult catalog extended','web','2021-06-02 21:50:00.0','2021-06-02 21:50:00.0');
INSERT INTO permissions (id,name,guard_name,created_at,updated_at) VALUES
	 (41,'show reassort list','web','2021-06-05 17:28:00.0','2021-06-05 17:28:00.0');
	 
INSERT INTO role_has_permissions (permission_id,role_id) VALUES
	 (1,1),
	 (1,2),
	 (1,3),
	 (1,4),
	 (2,1),
	 (2,2),
	 (2,3),
	 (3,1),
	 (3,2),
	 (3,3);
INSERT INTO role_has_permissions (permission_id,role_id) VALUES
	 (4,1),
	 (4,2),
	 (4,3),
	 (4,4),
	 (5,1),
	 (5,2),
	 (5,3),
	 (5,4),
	 (5,5),
	 (6,1);
INSERT INTO role_has_permissions (permission_id,role_id) VALUES
	 (6,2),
	 (6,3),
	 (7,1),
	 (7,2),
	 (7,3),
	 (8,1),
	 (8,2),
	 (8,3),
	 (8,4),
	 (8,5);
INSERT INTO role_has_permissions (permission_id,role_id) VALUES
	 (9,1),
	 (9,2),
	 (9,3),
	 (10,1),
	 (10,2),
	 (10,3),
	 (11,1),
	 (11,2),
	 (11,3),
	 (12,1);
INSERT INTO role_has_permissions (permission_id,role_id) VALUES
	 (12,2),
	 (12,3),
	 (13,1),
	 (13,2),
	 (13,3),
	 (13,4),
	 (14,1),
	 (14,2),
	 (14,3),
	 (15,1);
INSERT INTO role_has_permissions (permission_id,role_id) VALUES
	 (15,2),
	 (15,3),
	 (15,4),
	 (15,5),
	 (16,1),
	 (16,2),
	 (16,3),
	 (17,1),
	 (17,2),
	 (17,3);
INSERT INTO role_has_permissions (permission_id,role_id) VALUES
	 (18,1),
	 (18,2),
	 (18,3),
	 (18,4),
	 (18,5),
	 (19,1),
	 (19,2),
	 (19,3),
	 (20,1),
	 (20,2);
INSERT INTO role_has_permissions (permission_id,role_id) VALUES
	 (20,3),
	 (20,4),
	 (21,1),
	 (21,2),
	 (21,3),
	 (21,4),
	 (21,5),
	 (22,1),
	 (22,2),
	 (22,3);
INSERT INTO role_has_permissions (permission_id,role_id) VALUES
	 (23,1),
	 (23,2),
	 (23,3),
	 (24,1),
	 (24,2),
	 (24,3),
	 (24,4),
	 (24,5),
	 (25,1),
	 (25,2);
INSERT INTO role_has_permissions (permission_id,role_id) VALUES
	 (25,3),
	 (25,4),
	 (26,1),
	 (26,2),
	 (26,3),
	 (27,1),
	 (27,2),
	 (27,3),
	 (27,4),
	 (27,5);
INSERT INTO role_has_permissions (permission_id,role_id) VALUES
	 (27,6),
	 (28,1),
	 (28,2),
	 (28,3),
	 (28,6),
	 (29,1),
	 (29,2),
	 (29,3),
	 (29,6),
	 (30,1);
INSERT INTO role_has_permissions (permission_id,role_id) VALUES
	 (30,2),
	 (30,3),
	 (30,6),
	 (31,1),
	 (31,2),
	 (31,3),
	 (31,6),
	 (32,1),
	 (32,2),
	 (32,3);
INSERT INTO role_has_permissions (permission_id,role_id) VALUES
	 (32,6),
	 (33,1),
	 (33,2),
	 (34,1),
	 (34,2),
	 (34,3),
	 (35,1),
	 (35,2),
	 (35,3),
	 (36,1);
INSERT INTO role_has_permissions (permission_id,role_id) VALUES
	 (36,2),
	 (36,3),
	 (36,4),
	 (37,1),
	 (37,2),
	 (37,3),
	 (37,4),
	 (38,1),
	 (38,2),
	 (38,3);
INSERT INTO role_has_permissions (permission_id,role_id) VALUES
	 (38,4),
	 (39,1),
	 (39,2),
	 (39,3),
	 (39,4),
	 (40,1),
	 (40,2),
	 (40,3),
	 (40,4),
	 (41,1);
INSERT INTO role_has_permissions (permission_id,role_id) VALUES
	 (41,2);
	 
INSERT INTO model_has_roles (role_id,model_type,model_id) VALUES
	 (1,'App\\Models\\User',1),
	 (2,'App\\Models\\User',2),
	 (2,'App\\Models\\User',4),
	 (5,'App\\Models\\User',5);