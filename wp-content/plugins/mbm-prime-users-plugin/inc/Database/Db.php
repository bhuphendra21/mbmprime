<?php

namespace Inc\Database;

class Db
{
    public function runAllDbMethods()
    {
        // $this->generateCompanyTable();
        // $this->generateUsersExtraTable();
        // $this->generateSocioEconomicCategoriesTable();
        // $this->generateInterestsTable();
        // $this->generateUsersInterestsTable();
    }

    // TODO: remove user_id and add the relation in user wp_meta
    // public function generateCompanyTable()
    // {
    //     global $wpdb;

    //     $table_name = 'mbmprime_company';

    //     $sql = "CREATE TABLE `$table_name` (
    //             `id` int(11) NOT NULL AUTO_INCREMENT,
    //             `user_id` int(11) DEFAULT NULL,
    //             `name` varchar(250) DEFAULT NULL,
    //             `type` int(11) DEFAULT NULL,
    //             `url` varchar(250) DEFAULT NULL,
    //             `address` varchar(250) DEFAULT NULL,
    //             `city` varchar(250) DEFAULT NULL,
    //             `zip` varchar(250) DEFAULT NULL,
    //             `state_province` varchar(250) DEFAULT NULL,
    //             `country` varchar(250) DEFAULT NULL,
    //             `phone` varchar(250) DEFAULT NULL,
    //             `socioeconomic_category` varchar(250) DEFAULT NULL,
    //             `federal_opportunities` boolean DEFAULT NULL,
    //             `description` varchar(250) DEFAULT NULL,
    //             `business_certifications` varchar(250) DEFAULT NULL,
    //             `revenue` int DEFAULT NULL,
    //             `sales` int DEFAULT NULL,
    //             `employees_amount` int DEFAULT NULL,
    //             `logo` varchar(250) DEFAULT NULL,
    //             `brochure` varchar(250) DEFAULT NULL,
    //             PRIMARY KEY(id)
    //             ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
    //     ";
    //     if ($wpdb->get_var("SHOW TABLES LIKE 'mbmprime_company'") != $table_name) {
    //         require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    //         dbDelta($sql);
    //     }
    // }

    // TODO: for the user related data we can use wp_meta api and we should delete this table
    // public function generateUsersExtraTable()
    // {
    //     global $wpdb;

    //     $table_name = 'mbmprime_users_extra';

    //     $sql = "CREATE TABLE `$table_name` (
    //             `id` int(11) NOT NULL AUTO_INCREMENT,
    //             `user_id` int(11) DEFAULT NULL,
    //             `name` varchar(250) DEFAULT NULL,
    //             `last_name` varchar (250) DEFAULT NULL,
    //             `title` varchar(250) DEFAULT NULL,
    //             `profile_picture` varchar(250) DEFAULT NULL,
    //             PRIMARY KEY(id)
    //             ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
    //     ";
    //     if ($wpdb->get_var("SHOW TABLES LIKE 'mbmprime_users_extra'") != $table_name) {
    //         require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    //         dbDelta($sql);
    //     }
    // }

//     public function generateSocioEconomicCategoriesTable()
//     {
//         global $wpdb;

//         $table_name = 'mbmprime_socioeconomic_categories';

//         $sql = "CREATE TABLE `$table_name` (
//                 `id` int(11) NOT NULL AUTO_INCREMENT,
//                 `category` varchar(250) DEFAULT NULL,
//                 PRIMARY KEY(id)
//                 ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
//         ";
//         if ($wpdb->get_var("SHOW TABLES LIKE 'mbmprime_socioeconomic_categories'") != $table_name) {
//             require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
//             dbDelta($sql);
//         }
//     }

//     public function generateInterestsTable()
//     {
//         global $wpdb;

//         $table_name = 'mbmprime_interests';

//         $sql = "CREATE TABLE `$table_name` (
//                 `id` int(11) NOT NULL AUTO_INCREMENT,
//                 `interest` varchar(250) DEFAULT NULL,
//                 PRIMARY KEY(id)
//                 ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
//         ";
//         if ($wpdb->get_var("SHOW TABLES LIKE 'mbmprime_interests'") != $table_name) {
//             require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
//             dbDelta($sql);
//         }
//     }

//     public function generateUsersInterestsTable()
//     {
//         global $wpdb;

//         $table_name = 'mbmprime_users_interests';

//         $sql = "CREATE TABLE `$table_name` (
//                 `id` int(11) NOT NULL AUTO_INCREMENT,
//                 `user_id` int(11) NOT NULL,
//                 `interest` int(11) NOT NULL,
//                 PRIMARY KEY(id)
//                 ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
//         ";
//         if ($wpdb->get_var("SHOW TABLES LIKE 'mbmprime_users_interests'") != $table_name) {
//             require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
//             dbDelta($sql);
//         }
//     }
}
