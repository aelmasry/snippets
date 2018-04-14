SELECT cat_id, cat_name, rid, recipe_text
FROM
(
   SELECT c.id AS cat_id, c.title AS cat_name, r.id AS rId, r.title AS recipe_text,
      @r:=case when @g=c.id then @r+1 else 1 end r,
      @g:=c.id
   FROM (select @g:=null,@r:=0) n
   CROSS JOIN categories c
   JOIN articles r ON c.id = r.category_id
) X
WHERE r >= 5




SELECT category, id, title FROM (
    SELECT c.title AS category, a.id, a.title, row_number() OVER (PARTITION BY category_id ORDER BY a.id DESC) AS row
    FROM articles a INNER JOIN categories c ON (a.category_id=c.id)
    ORDER BY c.id
) AS articles WHERE row <= 5;