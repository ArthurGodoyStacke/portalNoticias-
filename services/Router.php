<?php
class Router
{
    private array $routes;
    public function __construct()
    {
        $this->routes = [
            'GET' => [
                '/noticias' => [
                    'controller' => 'NoticiaController',
                    'function' => 'getNoticias',
                ],
                '/autores' => [
                    'controller' => 'AutorController',
                    'function' => 'getAutores'
                ]
            ],
            'POST' => [
                '/criar-noticia' => [
                    'controller' => 'noticiaController',
                    'function' => 'createNoticia'
                ]
            ],
            'PUT' => [
                '/atualizar-noticia' => [
                    'controller' => 'NoticiaController',
                    'function' => 'uptadeNoticia'
                ]
            ],

            'DELETE' => [ 
                '/excluir-noticia' =>[
                    'controller' => 'NoticiaController',
                    'function' => 'deleteNoticia'
                ]
            ]
        ];
    }

    public function handleRequest(string $method, string $route): string
    {
        $routeExists = !empty($this->routes[$method][$route]);

        if (!$routeExists) {
            return json_encode([
                'error' => 'A rota utilizada não existe',
                'result' => null
            ]);
        }

        $routeInfo = $this->routes[$method][$route];

        $controller = $routeInfo['controller'];

        $function = $routeInfo['function'];

        require_once __DIR__ . '/../controllers/' . $controller . '.php';


        return (new $controller)->$function();
    }
}
