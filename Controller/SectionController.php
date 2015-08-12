<?php
namespace Dlin\Bundle\ZendeskBundle\Controller;

use Dlin\Zendesk\Client\SectionClient;
use Dlin\Zendesk\Client\ArticleClient;
use Symfony\Bundle\FrameworkBundle\Controller\Controller as BaseController;

/**
 * Controller managing sections
 *
 * @author Plopleo
 */
class SectionController extends BaseController
{
    public function showAction($idSection)
    {
        $api =  $this->get('dlin.zendesk')->getApi();

        $sectionClient = new SectionClient($api);
        $sectionResult = $sectionClient->getOneById($idSection);

        $articleClient = new ArticleClient($api);
        $articlesResult = $articleClient->getArticlesBySection($sectionResult->getId());
        $articles = $articlesResult->getItems();
        while($articlesResult->getNextResult() != null){
            $articles = array_merge($articles, $articlesResult->getNextResult()->getItems());
            $articlesResult = $articlesResult->getNextResult();
        }

        return $this->render('DlinZendeskBundle:Section:section_show.html.twig', array(
            'section' => $sectionResult,
            'articles' => $articles
        ));
    }
}