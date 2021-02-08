<?php

namespace App\Service;

use Mustache_Engine;
use Mustache_Loader_FilesystemLoader;
use Psr\Http\Message\ResponseInterface as Response;

class Templating
{
    private $engine;
    private $data = [];

    /**
     * Constructor. Set up template engine.
     */
    public function __construct()
    {
        $this->initialise(__DIR__ . '/../../templates');
    }

    /**
     * Initialise the engine here. Doing it here, rather than the
     * constructor, allows us to override the directory easily
     * in child classes.
     *
     * @param $string $templatePath Path to template files.
     * @return void
     */
    protected function initialise($templatePath)
    {
        $this->engine = new Mustache_Engine([
            'loader' => new Mustache_Loader_FilesystemLoader(
                $templatePath,
                [
                    'extension' => ''
                ]
            )
        ]);

        $this->engine->addHelper('date', function ($value) {
            return ($value) ? $value->format('j F Y') : null;
        });
    }

    /**
     * Render a response.
     *
     * @param Response $response PSR-7 response.
     * @param string   $template Tempate file path.
     * @param array    $data     Variables.
     * @return Response
     */
    public function renderPage(Response $response, $template, $data = [])
    {
        $content = $this->engine->render($template, array_merge($this->data, $data));

        $layout = $this->engine->render(
            'layout.html',
            array_merge($this->data, $data, ['body' => $content])
        );

        $response->getBody()->write($layout);
        return $response;
    }

    /**
     * Set a data field.
     *
     * @param string $key   Key.
     * @param mixed  $value Value.
     * @return void
     */
    public function setData($key, $value)
    {
        $this->data[$key] = $value;
    }
}
