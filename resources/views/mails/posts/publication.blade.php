<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<style>
    body{
        background-color: lightcyan;
    }
</style>
<body>
    <h1>E stato pubblicato un post</h1>
    <h2>{{$post->title}}</h2>
    <p><strong>data di pubblicazione:</strong>{{$post->getCreatedAt()}}</p>
    <address>{{$post->author->name}}</address>
    <p><strong>Categoria</strong>{{$post->category ? $post->category->label : 'Nessuna'}}</p>
</body>
</html>