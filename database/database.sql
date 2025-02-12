-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         8.4.3 - MySQL Community Server - GPL
-- SO del servidor:              Win64
-- HeidiSQL Versión:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para proyecto_gimnasio
CREATE DATABASE IF NOT EXISTS `proyecto_gimnasio` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `proyecto_gimnasio`;

-- Volcando estructura para tabla proyecto_gimnasio.cargos
CREATE TABLE IF NOT EXISTS `cargos` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `cargo` varchar(50) NOT NULL,
  `sueldo` decimal(20,6) NOT NULL,
  `moneda` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla proyecto_gimnasio.cargos: ~0 rows (aproximadamente)

-- Volcando estructura para tabla proyecto_gimnasio.empleados
CREATE TABLE IF NOT EXISTS `empleados` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `personas_id` int unsigned NOT NULL,
  `cargos_id` int unsigned NOT NULL,
  `horarios_id` int unsigned NOT NULL,
  `fecha` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla proyecto_gimnasio.empleados: ~0 rows (aproximadamente)

-- Volcando estructura para tabla proyecto_gimnasio.horarios
CREATE TABLE IF NOT EXISTS `horarios` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `dias` text NOT NULL,
  `horas` text NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla proyecto_gimnasio.horarios: ~0 rows (aproximadamente)

-- Volcando estructura para tabla proyecto_gimnasio.membresias
CREATE TABLE IF NOT EXISTS `membresias` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `duracion` int NOT NULL,
  `precio` decimal(20,6) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla proyecto_gimnasio.membresias: ~0 rows (aproximadamente)

-- Volcando estructura para tabla proyecto_gimnasio.miembros
CREATE TABLE IF NOT EXISTS `miembros` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `personas_id` int unsigned NOT NULL,
  `inscripcion` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla proyecto_gimnasio.miembros: ~0 rows (aproximadamente)

-- Volcando estructura para tabla proyecto_gimnasio.notificaciones
CREATE TABLE IF NOT EXISTS `notificaciones` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `asunto` text NOT NULL,
  `mensaje` text NOT NULL,
  `users_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla proyecto_gimnasio.notificaciones: ~0 rows (aproximadamente)

-- Volcando estructura para tabla proyecto_gimnasio.parametros
CREATE TABLE IF NOT EXISTS `parametros` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tabla_id` bigint DEFAULT NULL,
  `valor` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `rowquid` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla proyecto_gimnasio.parametros: ~0 rows (aproximadamente)

-- Volcando estructura para tabla proyecto_gimnasio.personas
CREATE TABLE IF NOT EXISTS `personas` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `users_id` int unsigned NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `cedula` varchar(50) NOT NULL,
  `telefono` varchar(50) NOT NULL,
  `direccion` text NOT NULL,
  `token` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla proyecto_gimnasio.personas: ~0 rows (aproximadamente)

-- Volcando estructura para tabla proyecto_gimnasio.personas_membresias
CREATE TABLE IF NOT EXISTS `personas_membresias` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `personas_id` int unsigned NOT NULL,
  `membresias_id` int unsigned NOT NULL,
  `fecha` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla proyecto_gimnasio.personas_membresias: ~0 rows (aproximadamente)

-- Volcando estructura para tabla proyecto_gimnasio.sessions
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `users_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `user_client` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `user_os` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `rowquid` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`users_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla proyecto_gimnasio.sessions: ~5 rows (aproximadamente)
INSERT INTO `sessions` (`id`, `users_id`, `ip_address`, `user_agent`, `user_client`, `user_os`, `rowquid`, `created_at`, `updated_at`) VALUES
	(1, 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36 Edg/133.0.0.0', '{"type":"browser","name":"Microsoft Edge","short_name":"PS","version":"133.0","engine":"Blink","engine_version":"133.0.0.0","family":"Internet Explorer"}', '{"name":"Windows","short_name":"WIN","version":"10","platform":"x64","family":"Windows"}', 'NCPdPzOCsh85vr2w', '2025-02-12 20:07:58', '2025-02-12 20:08:25'),
	(2, 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36 Edg/133.0.0.0', '{"type":"browser","name":"Microsoft Edge","short_name":"PS","version":"133.0","engine":"Blink","engine_version":"133.0.0.0","family":"Internet Explorer"}', '{"name":"Windows","short_name":"WIN","version":"10","platform":"x64","family":"Windows"}', 'mBTGDtr2lkpZT4NW', '2025-02-12 20:08:48', '2025-02-12 20:08:55'),
	(3, 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36 Edg/133.0.0.0', '{"type":"browser","name":"Microsoft Edge","short_name":"PS","version":"133.0","engine":"Blink","engine_version":"133.0.0.0","family":"Internet Explorer"}', '{"name":"Windows","short_name":"WIN","version":"10","platform":"x64","family":"Windows"}', 'MjcVvBXUIKx8kVTk', '2025-02-12 20:09:35', '2025-02-12 20:09:43'),
	(4, 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36 Edg/133.0.0.0', '{"type":"browser","name":"Microsoft Edge","short_name":"PS","version":"133.0","engine":"Blink","engine_version":"133.0.0.0","family":"Internet Explorer"}', '{"name":"Windows","short_name":"WIN","version":"10","platform":"x64","family":"Windows"}', 'ozEtGgSnDBmuEBwV', '2025-02-12 20:10:46', '2025-02-12 20:17:51');

-- Volcando estructura para tabla proyecto_gimnasio.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `two_factor_secret` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `two_factor_recovery_codes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_team_id` bigint unsigned DEFAULT NULL,
  `profile_photo_path` varchar(2048) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` int NOT NULL DEFAULT '0',
  `rowquid` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla proyecto_gimnasio.users: ~3 rows (aproximadamente)
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `remember_token`, `current_team_id`, `profile_photo_path`, `role`, `rowquid`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'antonny maluenga', 'gabrielmalu15@gmail.com', '2025-02-12 20:09:49', '$2y$10$w.RmHcokqKdecofe7CK2uOqMeLPDw2hseQJ99AgvSbFeCmigvQWL.', 'RVwcaTVzyTHGWDDayOEdSQiyxQrECZWt', NULL, '2025-02-12 20:07:58', NULL, NULL, NULL, 100, 'h3mcZyXrlIg2fMVi', '2025-02-12 20:07:57', '2025-02-12 20:07:58', NULL),
	(2, 'Yonathan Castillo', 'leothan522@gmail.com', '2025-02-12 20:09:52', '$2y$10$VsONPinbnXgupIlYjYEwSeO03nSEFxrkn8lccREw1H4VDY894/8dS', 'XkvnEeOtEadxopVEpOlfKqDfmqbdrePN', NULL, '2025-02-12 20:08:48', NULL, NULL, NULL, 100, 'sCLssIyTZzCC7gHA', '2025-02-12 20:08:48', '2025-02-12 20:08:48', NULL),
	(3, 'Administrador', 'admin@gym.com', '2025-02-12 20:09:56', '$2y$10$XqiID9zEtMNwMDv5ZSEcJ.Ur6lBOk0.fiM1CQ.FrHU/jcMwyOpSsm', 'KTGLOZNwEtUyecfRcsMFRFewQqYFqgth', NULL, '2025-02-12 20:09:35', NULL, NULL, NULL, 1, '1bNV0w0fsj1K3qyy', '2025-02-12 20:09:35', '2025-02-12 20:09:35', NULL);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
