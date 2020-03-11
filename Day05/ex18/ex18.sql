SELECT *
FROM `distrib`
WHERE
`name` LIKE '%y%y%'
AND
`id_distrib` IN (42, 62, 63, 64, 65, 66, 67, 68, 69, 71, 88, 89, 90)
LIMIT 5
OFFSET 2;