-- Untuk ngambil post-post yang terkait
-- 1 nya bisa diganti variabel

SELECT DISTINCT post.* FROM `post` 
JOIN relationship ON (relationship.idFollowed = post.idUser) 
WHERE post.idUser = 1 OR post.idUser IN 
    (SELECT idFollower FROM relationship WHERE idFollowed = 1)

-- ID Post bisa diembed ke tombol comment

-- Punya karissa

--Nama followers--

SELECT username FROM relationship r
JOIN user u ON (u.idUser = r.idFollower)
WHERE idFollowed = 1;

--Nama followed--

SELECT username FROM relationship r
JOIN user u ON (u.idUser = r.idFollower)
WHERE idFollower = 1;
