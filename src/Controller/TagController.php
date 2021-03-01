<?php

namespace App\Controller;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class TagController extends Controller
{
    public function tag(Request $request, Response $response, $args = [])
    {
    	$tag = $this->ci->get('db')->find('App\Entity\Tag', $args['id']);

    	if (!$tag){
    		throw new HttpNotFoundException($request);
    	}

    	return $this->renderPage($response, 'tag.html', [
        	'tag' => $tag,
        	'articles' => $tag->getArticles()
        ]);
    }

    public function view(Request $request, Response $response)
    {
    	$tags = $this->ci->get('db')->getRepository('App\Entity\Tag')->findBy([], []);
        return $this->renderPage($response, 'Tags.html', [
        	'tags' => $tags
        ]);
    }

}