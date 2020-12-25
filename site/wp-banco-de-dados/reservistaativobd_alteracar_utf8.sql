ALTER DATABASE reservistaativobd_site CHARACTER SET utf8;

show variables like 'sql_mode' ; 

set global sql_mode = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';
SET sql_mode = '';

ALTER TABLE wp_actionscheduler_actions CHARACTER SET utf8;
ALTER TABLE wp_actionscheduler_claims CHARACTER SET utf8;
ALTER TABLE wp_actionscheduler_groups CHARACTER SET utf8;
ALTER TABLE wp_actionscheduler_logs CHARACTER SET utf8;
ALTER TABLE wp_commentmeta CHARACTER SET utf8;
ALTER TABLE wp_comments CHARACTER SET utf8;
ALTER TABLE wp_dailytipdata CHARACTER SET utf8;
ALTER TABLE wp_duplicator_packages CHARACTER SET utf8;
ALTER TABLE wp_hurrytimer_evergreen CHARACTER SET utf8;
ALTER TABLE wp_links CHARACTER SET utf8;
ALTER TABLE wp_options CHARACTER SET utf8;
ALTER TABLE wp_postmeta CHARACTER SET utf8;
ALTER TABLE wp_posts CHARACTER SET utf8;
ALTER TABLE wp_quotescollection CHARACTER SET utf8;
ALTER TABLE wp_smush_dir_images CHARACTER SET utf8;
ALTER TABLE wp_term_relationships CHARACTER SET utf8;
ALTER TABLE wp_term_taxonomy CHARACTER SET utf8;
ALTER TABLE wp_termmeta CHARACTER SET utf8;
ALTER TABLE wp_terms CHARACTER SET utf8;
ALTER TABLE wp_usermeta CHARACTER SET utf8;
ALTER TABLE wp_users CHARACTER SET utf8;
ALTER TABLE wp_wpforms_tasks_meta CHARACTER SET utf8;
ALTER TABLE wp_wpmailsmtp_tasks_meta CHARACTER SET utf8;

