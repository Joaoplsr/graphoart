<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        body {
            font-family: Helvetica, sans-serif;
            font-size: 16px;
            line-height: 1.5;
            text-align: justify;
            background-color: #f5f5f5;
            padding: 20px;
        }

        header {
            text-align: center;
            height: 120px;
        }            

        .logo {
            width: 180px;
            height: auto;
            padding-left: 20px;
        }

        .title {
            font-size: 24px;
            font-weight: bold;
            text-align: left;
        }

        footer {
            text-align: left;
            margin-top: 20px;
            position: absolute;
            bottom: 0;
            width: 100%;
            font-size: 14px;
        }

        footer a {
            color: #0055ff;
            text-decoration: underline;
        }
        
    </style>
</head>

<body>
    <header>
        <img class="logo" src="{{ public_path('logo.svg') }}" alt="Logo">
    </header>
    <h1 class="title">{{ $article->title }}</h1>
    <p><strong>Autor:</strong> {{ $article->author }}</p>
    <hr>
    <div>{!! nl2br(e($article->body)) !!}</div>
    <footer>
        <p>Fonte: <a rel="noopener noreferrer" target="_blank" href="https://www.graphoart.com.br/artigos/{{ $article->id }}">https://www.graphoart.com.br/artigo/{{ $article->id }}</a></p>
    </footer>
</body>

</html>
