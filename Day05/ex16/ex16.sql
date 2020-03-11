SELECT COUNT(*) AS `movies`
FROM (
    SELECT COUNT(`id_film`) AS `movie`
    FROM `member_history`
    WHERE 
    (DATE(`date`)>'2006-10-30' AND DATE(`date`)<'2007-07-27')
    OR DATE(`date`) LIKE '%-12-24'
    GROUP BY `id_film`
) AS NEW_TAB;