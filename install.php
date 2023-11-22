<?php

defined('BASEPATH') or exit('No direct script access allowed');

$CI = &get_instance();

// Set Up The Contact Book Table
if (!$CI->db->table_exists(db_prefix() . 'calls')) {
    $CI->db->query('CREATE TABLE `' . db_prefix() . 'calls` (
        `id` int(11) NOT NULL,
        `clientid` int(11) NOT NULL,
        `outcome` int(11) NULL DEFAULT NULL,
        `call_date` DATETIME DEFAULT CURRENT_TIMESTAMP,
        `phonenumber` varchar(32) NULL DEFAULT NULL,
        `description` text NULL DEFAULT NULL,
        `addedfrom` int(11) NULL DEFAULT NULL,
        `date_created` DATETIME DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=' . $CI->db->char_set . ';');

    $CI->db->query('ALTER TABLE `' . db_prefix() . 'calls` ADD PRIMARY KEY (`id`);');
    $CI->db->query('ALTER TABLE `' . db_prefix() . 'calls` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;');
}
