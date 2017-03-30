<?php

namespace App\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;
use App\Model\UsersModel;
use App\Model\NewsModel;
use App\Utils\Pagination;

class DefaultController
{
    public function indexAction(Application $app, $page)
    {
        $modelNews = new NewsModel($app['db']);

        // должна всегда задаваться первой, иначе покажет неверное количество записей в таблице
        $total = $modelNews->countNews();

        $news = $modelNews->getNewsPerPage($page);

        $pagination = new Pagination($total, $page, NewsModel::SHOW_BY_DEFAULT, 'page-');

        return $app['twig']->render('view/index.html.twig', array(
            'all_news' => $news,
            'pagination' => $pagination
        ));
    }

    public function loginAction(Application $app, Request $request)
    {

        $form = $app['form.factory']->createBuilder('form')
            ->add('login', 'text', array(
                'required' => false,
                'constraints' => array(new Assert\NotBlank(), new Assert\Length(array('min' => 5)))
            ))
            ->add('password', 'password', array(
                'required' => false,
                'constraints' => array(new Assert\NotBlank())
            ))
            ->getForm();

        if ('POST' == $request->getMethod()) {

            $form->bind($request);

            if ($form->isValid()) {

                $data = $form->getData();

                $modelUsers = new UsersModel($app['db']);
                $user = $modelUsers->getUser($data['login'], $data['password']);

                if ($data['login'] == $user['login']
                    && md5($data['password']) == $user['password']
                ) {

                    return $app->redirect('/admin/dashboard');

                } else {

                    $app['session']->getFlashBag()->add('info', 'incorrect username or password');
                    return $app->redirect('/login');
                }

            }


        }

        return $app['twig']->render('view/form/login.html.twig', array(
            'form' => $form->createView(),
        ));

    }
}