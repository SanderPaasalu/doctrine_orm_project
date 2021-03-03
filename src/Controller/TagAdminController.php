<?php

namespace App\Controller;

use App\Entity\Tag;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Exception\HttpNotFoundException;

class TagAdminController extends Controller
{
    public function view(Request $request, Response $response)
    {
        $tag = $this->ci->get('db')->getRepository('App\Entity\Tag')->findBy([], ['name' => 'DESC']);

        

        return $this->renderPage($response, 'admin/tag/view.html', [
            'tag' => $tag
        ]);
    }

    public function create(Request $request, Response $response, $args = [])
    {
        $tag = new Tag;


        if($request->isPost()){
            $tag->setName($request->getParam('name'));

            $this->ci->get('db')->persist($tag);
            $this->ci->get('db')->flush();

            return $response->withRedirect('/admin/tag');
        }

        return $this->renderPage($response, 'admin/tag/create.html', [
            'tag' => $tag
        ]);
    }

    public function edit(Request $request, Response $response, $args = [])
    {
        $tag = $this->ci->get('db')->find('App\Entity\Tag', $args['id']);

        if (!$tag) {
            throw new HttpNotFoundException($request);
        }

        if($request->isPost()){
            if($request->getParam('action') == 'delete'){
                $this->ci->get('db')->remove($tag);
                $this->ci->get('db')->flush();

                return $response->withRedirect('/admin/tag');
            }

            $tag->setName($request->getParam('name'));


            $this->ci->get('db')->persist($tag);
            $this->ci->get('db')->flush();
        }

        return $this->renderPage($response, 'admin/tag/edit.html', [
            'tag' => $tag,
        ]);
    }
}