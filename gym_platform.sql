-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : dim. 01 fév. 2026 à 21:10
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `gym_platform`
--

-- --------------------------------------------------------

--
-- Structure de la table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('gym-platform-cache-mustaphatalha560@gmail.com|127.0.0.1', 'i:1;', 1769893167),
('gym-platform-cache-mustaphatalha560@gmail.com|127.0.0.1:timer', 'i:1769893167;', 1769893167);

-- --------------------------------------------------------

--
-- Structure de la table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `gyms`
--

CREATE TABLE `gyms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `subscription_expires_at` date DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `gyms`
--

INSERT INTO `gyms` (`id`, `name`, `logo`, `subscription_expires_at`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Golden Gym', NULL, '2027-01-30', 1, '2026-01-30 21:24:13', '2026-01-30 21:24:13'),
(2, 'BOB', NULL, '2026-07-30', 1, '2026-01-30 21:45:25', '2026-01-30 21:45:25'),
(3, 'BOB', NULL, '2026-01-31', 0, '2026-01-31 19:56:35', '2026-01-31 20:00:48');

-- --------------------------------------------------------

--
-- Structure de la table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `members`
--

CREATE TABLE `members` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `gym_id` bigint(20) UNSIGNED NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `cin` varchar(255) NOT NULL,
  `gender` enum('male','female') NOT NULL,
  `photo_path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `members`
--

INSERT INTO `members` (`id`, `gym_id`, `full_name`, `phone`, `cin`, `gender`, `photo_path`, `created_at`, `updated_at`) VALUES
(1, 2, 'Mustapha Talha', '0303030303', 'ZG166938', 'male', NULL, '2026-02-01 18:13:58', '2026-02-01 18:13:58'),
(2, 2, 'Member04', '+212 702 850465', 'cf3434', 'male', NULL, '2026-02-01 18:15:39', '2026-02-01 18:15:39');

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_01_01_000000_create_gyms_table', 1),
(5, '2025_12_25_102556_create_members_table', 1),
(6, '2025_12_25_102557_create_training_types_table', 1),
(7, '2025_12_25_102558_create_plans_table', 1),
(8, '2025_12_25_102559_create_subscriptions_table', 1),
(9, '2025_12_25_104439_create_products_table', 1),
(10, '2025_12_25_104440_create_orders_table', 1),
(11, '2025_12_25_104441_create_order_items_table', 1),
(12, '2026_01_30_214223_add_role_and_gym_id_to_users_table', 1);

-- --------------------------------------------------------

--
-- Structure de la table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `gym_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `gym_id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `unit_price` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `plans`
--

CREATE TABLE `plans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `gym_id` bigint(20) UNSIGNED NOT NULL,
  `training_type_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `duration_days` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `plans`
--

INSERT INTO `plans` (`id`, `gym_id`, `training_type_id`, `name`, `duration_days`, `price`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '1 Month', 30, 200.00, 1, '2026-01-30 21:24:13', '2026-01-30 21:24:13'),
(2, 1, 1, '3 Months', 90, 600.00, 1, '2026-01-30 21:24:13', '2026-01-30 21:24:13'),
(3, 1, 1, '6 Months', 180, 1200.00, 1, '2026-01-30 21:24:13', '2026-01-30 21:24:13'),
(4, 1, 1, '1 Year', 365, 2400.00, 1, '2026-01-30 21:24:13', '2026-01-30 21:24:13'),
(5, 1, 2, '1 Month', 30, 150.00, 1, '2026-01-30 21:24:13', '2026-01-30 21:24:13'),
(6, 1, 2, '3 Months', 90, 450.00, 1, '2026-01-30 21:24:13', '2026-01-30 21:24:13'),
(7, 1, 2, '6 Months', 180, 900.00, 1, '2026-01-30 21:24:13', '2026-01-30 21:24:13'),
(8, 1, 2, '1 Year', 365, 1800.00, 1, '2026-01-30 21:24:13', '2026-01-30 21:24:13'),
(9, 2, 3, 'ddf', 30, 200.00, 1, '2026-02-01 18:13:32', '2026-02-01 18:13:32'),
(10, 2, 4, '1 month', 60, 600.00, 1, '2026-02-01 18:15:12', '2026-02-01 18:15:12');

-- --------------------------------------------------------

--
-- Structure de la table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `gym_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `stock` int(11) NOT NULL DEFAULT 0,
  `image_path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('Gx8ujiqvL9tGuIuRbRGvvA3ZkrBKYvr4t0iz3Gnn', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVUdkZ1R3WHVCek84SThKdGw0bndrTFR6MnBVR3pDTlFqZkVuYXVNMiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7Tjt9fQ==', 1769976585);

-- --------------------------------------------------------

--
-- Structure de la table `subscriptions`
--

CREATE TABLE `subscriptions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `gym_id` bigint(20) UNSIGNED NOT NULL,
  `member_id` bigint(20) UNSIGNED NOT NULL,
  `plan_id` bigint(20) UNSIGNED NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `price_snapshot` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `subscriptions`
--

INSERT INTO `subscriptions` (`id`, `gym_id`, `member_id`, `plan_id`, `start_date`, `end_date`, `price_snapshot`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 9, '2026-02-01', '2026-03-01', 200.00, '2026-02-01 18:13:58', '2026-02-01 18:13:58'),
(2, 2, 2, 10, '2026-02-01', '2026-04-02', 600.00, '2026-02-01 18:15:39', '2026-02-01 18:15:39');

-- --------------------------------------------------------

--
-- Structure de la table `training_types`
--

CREATE TABLE `training_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `gym_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `training_types`
--

INSERT INTO `training_types` (`id`, `gym_id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 1, 'Bodybuilding', 'Gym and Musculation access', '2026-01-30 21:24:13', '2026-01-30 21:24:13'),
(2, 1, 'Kickboxing', 'Kickboxing and Boxing classes', '2026-01-30 21:24:13', '2026-01-30 21:24:13'),
(3, 2, 'kick', NULL, '2026-02-01 18:13:00', '2026-02-01 18:13:00'),
(4, 2, 'bodybuilding', NULL, '2026-02-01 18:14:34', '2026-02-01 18:14:34');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'staff',
  `gym_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role`, `gym_id`) VALUES
(1, 'Test User', 'test@example.com', '2026-01-30 21:24:12', '$2y$12$HMrvJvaG6U8noJh09LQsBecXXcI7fidHGx3UHhblV/L1XTtNofSB2', 'ZbXBBbdo9b', '2026-01-30 21:24:13', '2026-01-30 21:24:13', 'staff', NULL),
(2, 'Gym Manager', 'manager@goldengym.com', NULL, '$2y$12$FJiyOoRbJOxer9P7I6KZRuUABpBOtZpOhjG0n3MFi3jS0XdJwVfQ6', NULL, '2026-01-30 21:24:13', '2026-01-30 21:24:13', 'gym_admin', 1),
(3, 'Super Admin', 'super@admin.com', NULL, '$2y$12$yZ4CVK.GnKM8svNU43/fNea5bWBhCx.GIVLCLr8jZqti4WlIHQBKu', '6lfxcW3N1APusBg6Jm6nFz51eBP9kHGE8kQQBPntMJyJSRRH3ndy9YGuXIZP', '2026-01-30 21:24:13', '2026-01-30 21:24:13', 'super_admin', NULL),
(4, 'Afaf', 'mustaphatal560@gmail.com', NULL, '$2y$12$0LDVX4dVVK5ZmG3dTF1GS.wRuDTCzRXz9lJZ4g0HfZhIUtT4wQyJO', NULL, '2026-01-30 21:45:26', '2026-01-30 21:45:26', 'gym_admin', 2),
(5, 'room', 'admin@pizza.com', NULL, '$2y$12$9ekzd3.PZZF8DBIKFrm6/uaDofxmV9USqObFuSp.9aP4dAIr2D9E6', NULL, '2026-01-31 19:56:35', '2026-01-31 19:56:35', 'gym_admin', 3);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Index pour la table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Index pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Index pour la table `gyms`
--
ALTER TABLE `gyms`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Index pour la table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `members_cin_unique` (`cin`),
  ADD KEY `members_gym_id_foreign` (`gym_id`);

--
-- Index pour la table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_gym_id_foreign` (`gym_id`),
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- Index pour la table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_gym_id_foreign` (`gym_id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`),
  ADD KEY `order_items_product_id_foreign` (`product_id`);

--
-- Index pour la table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Index pour la table `plans`
--
ALTER TABLE `plans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `plans_gym_id_foreign` (`gym_id`),
  ADD KEY `plans_training_type_id_foreign` (`training_type_id`);

--
-- Index pour la table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_gym_id_foreign` (`gym_id`);

--
-- Index pour la table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Index pour la table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subscriptions_gym_id_foreign` (`gym_id`),
  ADD KEY `subscriptions_member_id_foreign` (`member_id`),
  ADD KEY `subscriptions_plan_id_foreign` (`plan_id`);

--
-- Index pour la table `training_types`
--
ALTER TABLE `training_types`
  ADD PRIMARY KEY (`id`),
  ADD KEY `training_types_gym_id_foreign` (`gym_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_gym_id_foreign` (`gym_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `gyms`
--
ALTER TABLE `gyms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `members`
--
ALTER TABLE `members`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `plans`
--
ALTER TABLE `plans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `subscriptions`
--
ALTER TABLE `subscriptions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `training_types`
--
ALTER TABLE `training_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `members`
--
ALTER TABLE `members`
  ADD CONSTRAINT `members_gym_id_foreign` FOREIGN KEY (`gym_id`) REFERENCES `gyms` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_gym_id_foreign` FOREIGN KEY (`gym_id`) REFERENCES `gyms` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Contraintes pour la table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_gym_id_foreign` FOREIGN KEY (`gym_id`) REFERENCES `gyms` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `plans`
--
ALTER TABLE `plans`
  ADD CONSTRAINT `plans_gym_id_foreign` FOREIGN KEY (`gym_id`) REFERENCES `gyms` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `plans_training_type_id_foreign` FOREIGN KEY (`training_type_id`) REFERENCES `training_types` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_gym_id_foreign` FOREIGN KEY (`gym_id`) REFERENCES `gyms` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD CONSTRAINT `subscriptions_gym_id_foreign` FOREIGN KEY (`gym_id`) REFERENCES `gyms` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `subscriptions_member_id_foreign` FOREIGN KEY (`member_id`) REFERENCES `members` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `subscriptions_plan_id_foreign` FOREIGN KEY (`plan_id`) REFERENCES `plans` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `training_types`
--
ALTER TABLE `training_types`
  ADD CONSTRAINT `training_types_gym_id_foreign` FOREIGN KEY (`gym_id`) REFERENCES `gyms` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_gym_id_foreign` FOREIGN KEY (`gym_id`) REFERENCES `gyms` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
