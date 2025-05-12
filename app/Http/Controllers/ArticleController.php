<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Services\ResponseService;
use Symfony\Component\HttpFoundation\Response;
class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::all();
        return ResponseService::success('Artigos encontrados com sucesso', Response::HTTP_OK, $articles);
    }

    public function show(Article $article)
    {
        return ResponseService::success('Artigo encontrado com sucesso', Response::HTTP_OK, $article);
    }

    public function store(Request $request)
    {
        Article::create($request->all());
        return ResponseService::success('Artigo criado com sucesso', Response::HTTP_CREATED);
    }

    public function update(Request $request, Article $article)
    {
        $article->update($request->all());
        return ResponseService::success('Artigo atualizado com sucesso', Response::HTTP_OK);
    }

    public function destroy(Article $article)
    {
        $article->delete();
        return ResponseService::success('Artigo deletado com sucesso', Response::HTTP_OK);
    }   
}
