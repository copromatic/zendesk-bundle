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

        return $this->render('DlinZendeskBundle:Article:article_show.html.twig', array(
            'article' => $articleResult,
        ));
    }
}