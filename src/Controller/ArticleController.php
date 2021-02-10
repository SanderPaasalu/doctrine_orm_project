<?php

namespace App\Controller;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class ArticleController extends Controller
{
    public function view(Request $request, Response $response)
    {
    	$article = $this->ci->get('db')->find('App\Entity\Article', 1); 
        return $this->renderPage($response, 'article.html', [
        	'article' => $article
        ]);
    }
}
