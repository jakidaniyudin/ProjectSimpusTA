/*
SQLyog Community v13.3.0 (64 bit)
MySQL - 8.0.35 
*********************************************************************
*/
/*!40101 SET NAMES utf8 */;

create table `pemeriksaan_record` (
	`id` varchar (108),
	`id_pasien` varchar (108),
	`id_layanan` varchar (108),
	`start` timestamp ,
	`end` timestamp ,
	`reason` varchar (450),
	`create_at` timestamp ,
	`update_at` timestamp ,
	`delete_at` timestamp 
); 
insert into `pemeriksaan_record` (`id`, `id_pasien`, `id_layanan`, `start`, `end`, `reason`, `create_at`, `update_at`, `delete_at`) values('09d5e8ae-64db-481f-ab62-6ecb89192dd2','1320876','a77bc2a5-5c65-4713-a0a3-963eef42239a','2025-03-24 16:56:10',NULL,NULL,'2025-03-24 16:56:10','2025-03-24 16:56:10',NULL);
insert into `pemeriksaan_record` (`id`, `id_pasien`, `id_layanan`, `start`, `end`, `reason`, `create_at`, `update_at`, `delete_at`) values('0caa89e3-1895-47c1-b804-26104a31a1ab','1320876','9e7ba195-66a1-470a-8a22-fdad7b08371a','2025-03-24 16:55:10','2025-03-24 16:55:18','mengakhiri layanan INC','2025-03-24 16:55:10','2025-03-24 16:55:18',NULL);
insert into `pemeriksaan_record` (`id`, `id_pasien`, `id_layanan`, `start`, `end`, `reason`, `create_at`, `update_at`, `delete_at`) values('17f72941-7e8c-484e-8997-1634226e4f7c','1320867','20195190-cf35-4695-b8f5-97855b57b53f','2025-04-21 14:49:57',NULL,NULL,'2025-04-21 14:49:57','2025-04-21 14:49:57',NULL);
insert into `pemeriksaan_record` (`id`, `id_pasien`, `id_layanan`, `start`, `end`, `reason`, `create_at`, `update_at`, `delete_at`) values('2ed7bb3b-b6e7-4d2f-9a50-0e0b93361c0c','1320875','9e7ba195-66a1-470a-8a22-fdad7b08371a','2025-06-03 22:53:30','2025-06-03 23:19:05','mengakhiri layanan INC','2025-06-03 22:53:30','2025-06-03 23:19:05',NULL);
insert into `pemeriksaan_record` (`id`, `id_pasien`, `id_layanan`, `start`, `end`, `reason`, `create_at`, `update_at`, `delete_at`) values('2f1c203d-abe6-4b0d-adbb-6e969d8b7b16','1320862','9e7ba195-66a1-470a-8a22-fdad7b08371a','2025-05-20 01:38:10',NULL,NULL,'2025-05-20 01:38:10','2025-05-20 01:38:10',NULL);
insert into `pemeriksaan_record` (`id`, `id_pasien`, `id_layanan`, `start`, `end`, `reason`, `create_at`, `update_at`, `delete_at`) values('31113b5d-19de-4256-8186-522440783eb2','1320875','a77bc2a5-5c65-4713-a0a3-963eef42239a','2025-06-03 23:19:09',NULL,NULL,'2025-06-03 23:19:09','2025-06-03 23:19:09',NULL);
insert into `pemeriksaan_record` (`id`, `id_pasien`, `id_layanan`, `start`, `end`, `reason`, `create_at`, `update_at`, `delete_at`) values('3b61f369-de88-45e6-adae-cc40c4bd23fe','1320873','9e7ba195-66a1-470a-8a22-fdad7b08371a','2025-04-04 08:44:29',NULL,NULL,'2025-04-04 08:44:29','2025-04-04 08:44:29',NULL);
insert into `pemeriksaan_record` (`id`, `id_pasien`, `id_layanan`, `start`, `end`, `reason`, `create_at`, `update_at`, `delete_at`) values('47ce35f5-7df0-477a-b5df-750b6ca5dcd3','1320861','20195190-cf35-4695-b8f5-97855b57b53f','2025-02-28 13:42:05','2025-06-13 16:14:03','mengakhiri layanan ANC','2025-02-28 13:42:05','2025-06-13 16:14:03',NULL);
insert into `pemeriksaan_record` (`id`, `id_pasien`, `id_layanan`, `start`, `end`, `reason`, `create_at`, `update_at`, `delete_at`) values('5234d410-baa2-499b-be2c-b223cfd6f05c','1320876','20195190-cf35-4695-b8f5-97855b57b53f','2025-03-01 09:38:40','2025-03-12 09:47:12','mengakhiri layanan ANC','2025-03-01 09:38:40','2025-03-12 09:47:12',NULL);
insert into `pemeriksaan_record` (`id`, `id_pasien`, `id_layanan`, `start`, `end`, `reason`, `create_at`, `update_at`, `delete_at`) values('60386441-c11c-47d0-8bfa-3ddbde2a9eaf','1320875','9e7ba195-66a1-470a-8a22-fdad7b08371a','2025-06-03 22:49:12','2025-06-03 22:53:20','mengakhiri layanan INC','2025-06-03 22:49:12','2025-06-03 22:53:20',NULL);
insert into `pemeriksaan_record` (`id`, `id_pasien`, `id_layanan`, `start`, `end`, `reason`, `create_at`, `update_at`, `delete_at`) values('6cbcf84f-9da3-4d4c-bbca-07c19ad747a0','1320860','20195190-cf35-4695-b8f5-97855b57b53f','2025-05-18 19:44:19',NULL,NULL,'2025-05-18 19:44:19','2025-05-18 19:44:19',NULL);
insert into `pemeriksaan_record` (`id`, `id_pasien`, `id_layanan`, `start`, `end`, `reason`, `create_at`, `update_at`, `delete_at`) values('6fbed5f2-3bb6-411d-9cb6-6b88e6d69268','1320877','20195190-cf35-4695-b8f5-97855b57b53f','2025-06-03 21:08:43',NULL,NULL,'2025-06-03 21:08:43','2025-06-03 21:08:43',NULL);
insert into `pemeriksaan_record` (`id`, `id_pasien`, `id_layanan`, `start`, `end`, `reason`, `create_at`, `update_at`, `delete_at`) values('8119ce03-58e1-4492-91f4-b29d83171242','1320876','20195190-cf35-4695-b8f5-97855b57b53f','2025-02-28 10:41:00','2025-03-01 09:35:18','mengakhiri layanan ANC','2025-02-28 10:41:00','2025-03-01 09:35:18',NULL);
insert into `pemeriksaan_record` (`id`, `id_pasien`, `id_layanan`, `start`, `end`, `reason`, `create_at`, `update_at`, `delete_at`) values('989b82f5-57c1-4ef8-874e-543a1a1889e9','1320863','20195190-cf35-4695-b8f5-97855b57b53f','2025-05-28 10:12:24',NULL,NULL,'2025-05-28 10:12:24','2025-05-28 10:12:24',NULL);
insert into `pemeriksaan_record` (`id`, `id_pasien`, `id_layanan`, `start`, `end`, `reason`, `create_at`, `update_at`, `delete_at`) values('9e82f8a2-4c07-416d-8f74-142b795d37ac','1320869','a8c51bca-28d2-427e-9f6c-7310f538fa0e','2025-04-21 12:41:01',NULL,NULL,'2025-04-21 12:41:01','2025-04-21 12:41:01',NULL);
insert into `pemeriksaan_record` (`id`, `id_pasien`, `id_layanan`, `start`, `end`, `reason`, `create_at`, `update_at`, `delete_at`) values('a95ae0d8-4376-4b2c-8b4e-42a3afdb3a37','1320864','3aa56b3e-8618-428b-b909-330311d18729','2025-04-23 14:32:02',NULL,NULL,'2025-04-23 14:32:02','2025-04-23 14:32:02',NULL);
insert into `pemeriksaan_record` (`id`, `id_pasien`, `id_layanan`, `start`, `end`, `reason`, `create_at`, `update_at`, `delete_at`) values('aa5264dd-3d61-470e-9fcf-6961b544a897','1320865','a77bc2a5-5c65-4713-a0a3-963eef42239a','2025-05-20 23:13:16',NULL,NULL,'2025-05-20 23:13:16','2025-05-20 23:13:16',NULL);
insert into `pemeriksaan_record` (`id`, `id_pasien`, `id_layanan`, `start`, `end`, `reason`, `create_at`, `update_at`, `delete_at`) values('add1597c-119d-4bb2-861d-ddf8475d54e5','1320861','2d55a20e-ab78-451e-ad0f-b2209c5c296f','2025-06-13 16:18:46',NULL,NULL,'2025-06-13 16:18:46','2025-06-13 16:18:46',NULL);
insert into `pemeriksaan_record` (`id`, `id_pasien`, `id_layanan`, `start`, `end`, `reason`, `create_at`, `update_at`, `delete_at`) values('c4aeba87-7a00-428d-ba7f-b5ba261dc067','1320876','9e7ba195-66a1-470a-8a22-fdad7b08371a','2025-03-24 15:38:00','2025-03-24 16:44:33','mengakhiri layanan INC','2025-03-24 15:38:00','2025-03-24 16:44:33',NULL);
insert into `pemeriksaan_record` (`id`, `id_pasien`, `id_layanan`, `start`, `end`, `reason`, `create_at`, `update_at`, `delete_at`) values('d4c8b50a-0a34-4b4b-addf-7033307290ea','1320876','9e7ba195-66a1-470a-8a22-fdad7b08371a','2025-03-24 15:36:17','2025-03-24 15:37:42','mengakhiri layanan INC','2025-03-24 15:36:17','2025-03-24 15:37:42',NULL);
insert into `pemeriksaan_record` (`id`, `id_pasien`, `id_layanan`, `start`, `end`, `reason`, `create_at`, `update_at`, `delete_at`) values('d97abe80-bbc5-445a-b4c7-6b4f78673a52','1320874','20195190-cf35-4695-b8f5-97855b57b53f','2025-03-21 14:23:36',NULL,NULL,'2025-03-21 14:23:36','2025-03-21 14:23:36',NULL);
insert into `pemeriksaan_record` (`id`, `id_pasien`, `id_layanan`, `start`, `end`, `reason`, `create_at`, `update_at`, `delete_at`) values('e287397d-4134-4528-80ac-26d5b8bd2364','1320868','a77bc2a5-5c65-4713-a0a3-963eef42239a','2025-04-04 20:06:14',NULL,NULL,'2025-04-04 20:06:14','2025-04-04 20:06:14',NULL);
insert into `pemeriksaan_record` (`id`, `id_pasien`, `id_layanan`, `start`, `end`, `reason`, `create_at`, `update_at`, `delete_at`) values('efc38e84-d89d-4db1-9b3e-76476b458062','1320876','9e7ba195-66a1-470a-8a22-fdad7b08371a','2025-03-12 11:39:14','2025-03-24 15:20:50','mengakhiri layanan INC','2025-03-12 11:39:14','2025-03-24 15:20:50',NULL);
insert into `pemeriksaan_record` (`id`, `id_pasien`, `id_layanan`, `start`, `end`, `reason`, `create_at`, `update_at`, `delete_at`) values('f73a9e50-49a9-4530-941e-fdbbc9229874','1320875','20195190-cf35-4695-b8f5-97855b57b53f','2025-06-03 22:11:54','2025-06-03 22:49:04','mengakhiri layanan ANC','2025-06-03 22:11:54','2025-06-03 22:49:04',NULL);
