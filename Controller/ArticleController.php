<?php
namespace Dlin\Bundle\ZendeskBundle\Controller;

use Dlin\Zendesk\Client\ArticleClient;
use Symfony\Bundle\FrameworkBundle\Controller\Controller as BaseController;

/**
 * Controller managing articles
 *
 * @author Plopleo
 */
class ArticleController extends BaseController
{
    public function showAction($idArticle)
    {
        $api =  $this->get('dlin.zendesk')->getApi();

        $articleClient = new ArticleClient($api);
        $articleResult = $articleClient->getOneById($idArticle);

        return $this->render('DlinZendeskBundle:Article:article_show.html.twig', array(
            'article' => $articleResult,
        ));
    }
}