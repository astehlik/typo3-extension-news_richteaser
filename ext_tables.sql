#
# Table structure for table 'tx_news_domain_model_news'
#
CREATE TABLE tx_news_domain_model_news (
	teaser_content_elements text
);

#
# Table structure for table 'tx_news_richteaser_domain_model_news_teaser_ttcontent_mm'
#
#
CREATE TABLE tx_news_richteaser_domain_model_news_teaser_ttcontent_mm (
	uid_local int(11) DEFAULT '0' NOT NULL,
	uid_foreign int(11) DEFAULT '0' NOT NULL,
	tablenames varchar(30) DEFAULT '' NOT NULL,
	sorting int(11) DEFAULT '0' NOT NULL,
	KEY uid_local (uid_local),
	KEY uid_foreign (uid_foreign)
);