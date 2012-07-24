-- give the document categories id an auto-incrementing value

ALTER TABLE `dpavel_st_mikes`.`document_categories` CHANGE COLUMN `id` `id` INT(11) NOT NULL AUTO_INCREMENT  ;
