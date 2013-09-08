<?php
$installer = $this;
$installer->startSetup();

$installer->run("

-- DROP TABLE IF EXISTS {$this->getTable('sdrost_responsive_slider')} ;
        
CREATE TABLE IF NOT EXISTS {$this->getTable('sdrost_responsive_slider')} (
  `id` int NOT NULL auto_increment,
  `name` VARCHAR(50),
  `path` VARCHAR(150),
  PRIMARY KEY (`id`)
) ;

INSERT INTO {$this->getTable('sdrost_responsive_slider')} (id, name, path) VALUES (1,'','');
INSERT INTO {$this->getTable('sdrost_responsive_slider')} (id, name, path) VALUES (2,'','');
INSERT INTO {$this->getTable('sdrost_responsive_slider')} (id, name, path) VALUES (3,'','');

");


$installer->endSetup();