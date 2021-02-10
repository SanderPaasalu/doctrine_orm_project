<?php

namespace App\Controller;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Exeption\HttpNotFoundException;

class ArticleController extends Controller
{
    public function view(Request $request, Response $response, $args = [])
    {
 		$qb = $this->ci->get('db')->createQueryBuilder();

 		$qb->select('a')->from('App\Entity\Article', 'a')->where('a.slug = :slug')->setParameter('slug', $args['slug']);

 		$query = $qb->getQuery();

 		$article =$query->getSingleResult();

        return $this->renderPage($response, 'article.html', [
        	'article' => $article
        ]);
    }

    public function viewPK(Request $request, Response $response) 
    {
    	$article = $this->ci->get('db')->find('App\Entity\Article', 1);
    	return $this->renderPage($response, 'article.html', [
        	'article' => $article
        ]);
    }

        public function viewRepo(Request $request, Response $response, $args = [])
    {
    	$article = $this->ci->get('db')->getRepository('App\Entity\Article')->findOneBy([
    		'slug' => $args['slug']
    	]); 

    	if (!$article){
    		throw new HttpNotFoundException($request);
    	}
    	
        return $this->renderPage($response, 'article.html', [
        	'article' => $article
        ]);
    }
}
