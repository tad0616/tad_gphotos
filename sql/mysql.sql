CREATE TABLE `tad_gphotos` (
  `album_sn` smallint(6) unsigned NOT NULL AUTO_INCREMENT COMMENT '流水號',
  `album_id` varchar(255) NOT NULL DEFAULT '' COMMENT '相簿ID',
  `album_name` varchar(255) NOT NULL DEFAULT '' COMMENT '相簿名稱',
  `album_url` varchar(1000) NOT NULL DEFAULT '' COMMENT '相簿網址',
  `album_sort` smallint(5) unsigned NOT NULL COMMENT '相簿排序',
  `album_counter` mediumint(8) unsigned NOT NULL COMMENT '相簿人氣',
  `uid` mediumint(9) unsigned NOT NULL DEFAULT '0' COMMENT '發布者',
  `create_date` datetime NOT NULL COMMENT '建立日期',
  PRIMARY KEY (`album_sn`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `tad_gphotos_images` (
  `image_sn` mediumint(9) unsigned NOT NULL auto_increment COMMENT '流水號',
  `album_sn` smallint(6) unsigned NOT NULL default '0' COMMENT '相簿編號',
  `image_id` varchar(255) NOT NULL default '' COMMENT '相片ID',
  `image_width` smallint(6) unsigned NOT NULL default '0' COMMENT '相片寬度',
  `image_height` smallint(6) unsigned NOT NULL default '0' COMMENT '相片高度',
  `image_url` varchar(1000) NOT NULL default '' COMMENT '相片網址',
  `image_description` text NOT NULL COMMENT '相片說明',
PRIMARY KEY  (`image_sn`)
) ENGINE=MyISAM;



CREATE TABLE `tad_gphotos_data_center` (
  `mid` mediumint(9) unsigned NOT NULL AUTO_INCREMENT COMMENT '模組編號',
  `col_name` varchar(100) NOT NULL default '' COMMENT '欄位名稱',
  `col_sn` mediumint(9) unsigned NOT NULL default 0 COMMENT '欄位編號',
  `data_name` varchar(100) NOT NULL default '' COMMENT '資料名稱',
  `data_value` text NOT NULL COMMENT '儲存值',
  `data_sort` mediumint(9) unsigned NOT NULL default 0 COMMENT '排序',
  `col_id` varchar(100) NOT NULL COMMENT '辨識字串',
  `update_time` datetime NOT NULL COMMENT '更新時間',
  PRIMARY KEY (`mid`,`col_name`,`col_sn`,`data_name`,`data_sort`)
) ENGINE=MyISAM;
