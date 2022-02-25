<?php

use App\QueryBuilder;

$db = new QueryBuilder();
$posts = $db->getAll('posts');
echo "<pre>";
var_dump($posts);
echo "</pre>";
echo "<pre>";
$db->insert('posts',[
  'posts' => 'from of title queryFactory'
]);
echo "</pre>";

$db->update('posts', [
  'posts' => 'from of update'
], 29);

echo "<pre>";
$db->delete('posts', 26);
echo "</pre>";