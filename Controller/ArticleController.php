<?php
namespace Dlin\Bundle\ZendeskBundle\Controller;

use Dlin\Zendesk\Client\ArticleClient;
use Symfony\Bundle\FrameworkBundle\Controller\Controller as BaseController;
use Symfony\Component\HttpFoundation\Request;

/**
 * Controller managing articles
 *
 * @author Plopleo
 */
class ArticleController extends BaseController
{

    /*
     * Var $request can be used to set cache
     * */
    public function showAction($idArticle, Request $request)
    {
        $api =  $this->get('dlin.zendesk')->getApi();

        $articleClient = new ArticleClient($api);
        $articleResult = $articleClient->getOneById($idArticle);

        $session = $request->getSession();
        $lastRead = $session->get('lastRead', array());
        $lastReadWithoutThis = $lastRead;
        if (!in_array($idArticle, $lastRead)) {
            $lastRead[] = $idArticle;
        }
        if(sizeof($lastRead) > 5){
            array_shift($lastRead);
        }
        $session->set('lastRead', $lastRead);

        $lastArticles = [];
        foreach($lastReadWithoutThis as $idLastRead){
            $lastArticles[] = $articleClient->getOneById($idLastRead);
        }

        return $this->render('DlinZendeskBundle:Article:article_show.html.twig', array(
            'article' => $articleResult,
            'lastRead' => $lastArticles,
        ));
    }
}