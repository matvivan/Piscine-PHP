SELECT UPPER(`last_name`) AS `NAME`, `first_name`, `price`
FROM ((`member`
INNER JOIN `subscription` ON `member`.`id_sub`=`subscription`.`id_sub`)
INNER JOIN `user_card` ON `id_user`=`id_member`)
WHERE `price`>42
ORDER BY `last_name`, `first_name`;