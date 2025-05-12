<?php

namespace App\Http\Controllers;

use App\Enum\StatusEnum;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Services\ResponseService;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\ArticleStoreRequest;
use App\Http\Requests\ArticleUpdateRequest;

class ArticleController extends Controller
{

    // Rotas de Listagem de Artigos

    public function index()
    {
        $articles = Article::all();
        return ResponseService::success('Artigos encontrados com sucesso', Response::HTTP_OK, $articles);
    }

    public function indexDraft()
    {
        $articles = Article::where('status_id', StatusEnum::DRAFT)->get();
        return ResponseService::success('Artigos em rascunho encontrados com sucesso', Response::HTTP_OK, $articles);
    }

    public function indexInReview()
    {
        $articles = Article::where('status_id', StatusEnum::IN_REVIEW)->get();
        return ResponseService::success('Artigos em revisão encontrados com sucesso', Response::HTTP_OK, $articles);
    }

    public function indexReviewed()
    {
        $articles = Article::where('status_id', StatusEnum::REVIEWED)->get();
        return ResponseService::success('Artigos revisados encontrados com sucesso', Response::HTTP_OK, $articles);
    }

    public function indexPublic()
    {
        $articles = Article::where('status_id', StatusEnum::PUBLISHED)->get();
        return ResponseService::success('Artigos publicados encontrados com sucesso', Response::HTTP_OK, $articles);
    }

    // Rotas de Atualização de Status dos Artigos

    public function inReview(Article $article)
    {
        $article->status_id = StatusEnum::IN_REVIEW;
        $article->save();
        return ResponseService::success('Artigo enviado para revisão com sucesso', Response::HTTP_OK);
    }

    public function reviewed(Article $article)
    {
        $article->status_id = StatusEnum::REVIEWED;
        $article->save();
        return ResponseService::success('Artigo revisado com sucesso', Response::HTTP_OK);
    }

    public function published(Article $article)
    {
        $article->status_id = StatusEnum::PUBLISHED;
        $article->save();
        return ResponseService::success('Artigo publicado com sucesso', Response::HTTP_OK);
    }
    
    // Rotas de Manipulação de Artigos
    public function show(Article $article)
    {
        return ResponseService::success('Artigo encontrado com sucesso', Response::HTTP_OK, $article);
    }

    public function store(ArticleStoreRequest $request)
    {
        Article::create($request->all());
        return ResponseService::success('Artigo criado com sucesso', Response::HTTP_CREATED);
    }

    public function update(ArticleUpdateRequest $request, Article $article)
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
