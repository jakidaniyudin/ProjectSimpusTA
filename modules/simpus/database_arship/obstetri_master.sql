/*
SQLyog Community v13.3.0 (64 bit)
MySQL - 8.0.35 
*********************************************************************
*/
/*!40101 SET NAMES utf8 */;

create table `obstetri_master` (
	`pasienId` varchar (30),
	`gravida` int (11),
	`partus` int (11),
	`abortus` int (11),
	`tphtDate` timestamp ,
	`bbSebelumHamil` float ,
	`tinggiBadan` float ,
	`bb_target` varchar (60),
	`imt` float ,
	`status_imt` varchar (150),
	`jarak_hamil` float ,
	`imunisasiTtStatus` varchar (30),
	`imunisasi_doss_1` JSON ,
	`imunisasi_doss_2` JSON ,
	`imunisasi_doss_3` JSON ,
	`imunisasi_doss_4` JSON ,
	`imunisasi_doss_5` JSON ,
	`create_at` timestamp ,
	`update_at` timestamp ,
	`delete_at` timestamp 
); 
insert into `obstetri_master` (`pasienId`, `gravida`, `partus`, `abortus`, `tphtDate`, `bbSebelumHamil`, `tinggiBadan`, `bb_target`, `imt`, `status_imt`, `jarak_hamil`, `imunisasiTtStatus`, `imunisasi_doss_1`, `imunisasi_doss_2`, `imunisasi_doss_3`, `imunisasi_doss_4`, `imunisasi_doss_5`, `create_at`, `update_at`, `delete_at`) values('1320876','1','1','1','2024-12-10 00:00:00','80','170','110','27.68','Kelebihan Berat Badan','3','0',NULL,NULL,NULL,NULL,NULL,'2024-12-05 14:11:47','2025-03-04 13:04:34',NULL);
insert into `obstetri_master` (`pasienId`, `gravida`, `partus`, `abortus`, `tphtDate`, `bbSebelumHamil`, `tinggiBadan`, `bb_target`, `imt`, `status_imt`, `jarak_hamil`, `imunisasiTtStatus`, `imunisasi_doss_1`, `imunisasi_doss_2`, `imunisasi_doss_3`, `imunisasi_doss_4`, `imunisasi_doss_5`, `create_at`, `update_at`, `delete_at`) values('1320874','1','1','1','2025-03-29 00:00:00','50','140','5-9','25.51','Kelebihan Berat Badan','13','1','{\"doss\": 1, \"tanggal\": \"2025-04-21\", \"no_batch\": \"uashdiash\", \"nama_vaksin\": \"anjsdniasd\"}','{\"doss\": 2, \"tanggal\": \"2025-04-13\", \"no_batch\": \"ajsdhbasd\", \"nama_vaksin\": \"jabsdbad\"}','{\"doss\": 3, \"tanggal\": \"2025-04-13\", \"no_batch\": \"ahbsdjhabsd\", \"nama_vaksin\": \"bashdbahsd\"}','{\"doss\": 4, \"tanggal\": \"2025-04-23\", \"no_batch\": \"0889967\", \"nama_vaksin\": \"hgfghh\"}','{\"doss\": 5, \"tanggal\": \"2025-04-22\", \"no_batch\": \"ggfghbbb\", \"nama_vaksin\": \"Hhvhgh\"}','2025-03-22 11:54:37','2025-05-17 17:19:12',NULL);
insert into `obstetri_master` (`pasienId`, `gravida`, `partus`, `abortus`, `tphtDate`, `bbSebelumHamil`, `tinggiBadan`, `bb_target`, `imt`, `status_imt`, `jarak_hamil`, `imunisasiTtStatus`, `imunisasi_doss_1`, `imunisasi_doss_2`, `imunisasi_doss_3`, `imunisasi_doss_4`, `imunisasi_doss_5`, `create_at`, `update_at`, `delete_at`) values('1320867','1','1','0','2025-04-21 00:00:00','60','150','5-9','26.67','Kelebihan Berat Badan','12','1','{\"doss\": 1, \"tanggal\": \"2025-04-21\", \"no_batch\": \"12388374\", \"nama_vaksin\": \"tetanus\"}','{\"doss\": 2, \"tanggal\": \"2025-04-21\", \"no_batch\": \"12388374\", \"nama_vaksin\": \"tetanus\"}','{\"doss\": 3, \"tanggal\": \"2025-04-21\", \"no_batch\": \"12388374\", \"nama_vaksin\": \"tetanus\"}','{\"doss\": 4, \"tanggal\": \"2025-04-21\", \"no_batch\": \"12388374\", \"nama_vaksin\": \"tetanus\"}','{\"doss\": 5, \"tanggal\": \"2025-04-21\", \"no_batch\": \"12388374\", \"nama_vaksin\": \"tetanus\"}','2025-04-21 14:56:44','2025-06-04 11:31:19',NULL);
insert into `obstetri_master` (`pasienId`, `gravida`, `partus`, `abortus`, `tphtDate`, `bbSebelumHamil`, `tinggiBadan`, `bb_target`, `imt`, `status_imt`, `jarak_hamil`, `imunisasiTtStatus`, `imunisasi_doss_1`, `imunisasi_doss_2`, `imunisasi_doss_3`, `imunisasi_doss_4`, `imunisasi_doss_5`, `create_at`, `update_at`, `delete_at`) values('1320863','1','0','0','2025-05-28 00:00:00','65','170','11,5-16','22.49','Normal','5','1','{\"doss\": 1, \"tanggal\": \"2025-06-03\", \"no_batch\": \"IJJASDAJSD\", \"nama_vaksin\": \"tetanus\"}',NULL,NULL,NULL,NULL,'2025-05-28 10:31:42','2025-06-03 12:34:52',NULL);
insert into `obstetri_master` (`pasienId`, `gravida`, `partus`, `abortus`, `tphtDate`, `bbSebelumHamil`, `tinggiBadan`, `bb_target`, `imt`, `status_imt`, `jarak_hamil`, `imunisasiTtStatus`, `imunisasi_doss_1`, `imunisasi_doss_2`, `imunisasi_doss_3`, `imunisasi_doss_4`, `imunisasi_doss_5`, `create_at`, `update_at`, `delete_at`) values('1320877','1','0','0','2025-06-03 00:00:00','40','140','11,5-16','20.41','Normal','0','0',NULL,NULL,NULL,NULL,NULL,'2025-06-03 21:09:22','2025-06-03 21:09:22',NULL);
insert into `obstetri_master` (`pasienId`, `gravida`, `partus`, `abortus`, `tphtDate`, `bbSebelumHamil`, `tinggiBadan`, `bb_target`, `imt`, `status_imt`, `jarak_hamil`, `imunisasiTtStatus`, `imunisasi_doss_1`, `imunisasi_doss_2`, `imunisasi_doss_3`, `imunisasi_doss_4`, `imunisasi_doss_5`, `create_at`, `update_at`, `delete_at`) values('1320875','1','0','0','2025-06-03 00:00:00','40','160','12,5-18','15.62','Kekurangan Berat Badan','0','0',NULL,NULL,NULL,NULL,NULL,'2025-06-03 22:37:23','2025-06-03 22:37:23',NULL);
