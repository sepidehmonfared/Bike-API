<?php

namespace App;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;

/**
 * Class Core
 * @package App
 *
 * @author Sepideh Monfared <monfared.sepideh@gmail.com>
 */
class Core implements HttpKernelInterface
{

    /** @var RouteCollection */
    protected $routes;

    protected $entityManager;

    /**
     * Core constructor.
     *
     * @author Sepideh Monfared <monfared.sepideh@gmail.com>
     */
    public function __construct()
    {
        $this->routes = new RouteCollection();
    }

    /**
     * @param Request $request
     * @param int $type
     * @param bool $catch
     * @return mixed|Response
     *
     * @author Sepideh Monfared <monfared.sepideh@gmail.com>
     */
    public function handle(Request $request, int $type = HttpKernelInterface::MASTER_REQUEST, bool $catch = true)
    {

        $context = new RequestContext();
        $context->fromRequest($request);

        $matcher = new UrlMatcher($this->routes, $context);

        try {
            $attributes = $matcher->match($request->getPathInfo());
            $controller = $attributes['controller'];
            unset($attributes['controller']);

            $response = call_user_func_array(
                $controller, [
                    'request' => $request,
                    'params'  => $attributes,
                    'em'      => $this->entityManager
                ]
            );

        }  catch (ResourceNotFoundException $exception) {
            $response = new Response('Not Found', 404);
        } catch (Exception $exception) {
            $response = new Response('An error occurred', 500);
        }

        return $response;
    }


    /**
     * @param EntityManager $em
     * @author Sepideh Monfared <monfared.sepideh@gmail.com>
     */
    public function setEntityManager(EntityManager $em) {

        $this->entityManager = $em;
    }

    /**
     * @param $path
     * @param $controller
     * @param $defaults
     * @param $requirements
     *
     * @author Sepideh Monfared <monfared.sepideh@gmail.com>
     */
    public function map($path, $controller, $defaults, $requirements) {

        $default = [
            'controller' => $controller
        ];
        $defaults = array_merge($defaults,$default);

        $this->routes->add($path, new Route(
            $path,
            $defaults,
            $requirements
        ));
    }
}