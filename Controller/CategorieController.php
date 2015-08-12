<?php
namespace Dlin\Bundle\ZendeskBundle\Controller;

use Dlin\Zendesk\Client\CategoryClient;
use Dlin\Zendesk\Client\SectionClient;
use Dlin\Zendesk\Client\ArticleClient;
use Symfony\Bundle\FrameworkBundle\Controller\Controller as BaseController;

/**
 * Controller managing categories
 *
 * @author Plopleo
 */
class CategorieController extends BaseController
{
    public function showAction($idCategorie)
    {
        $api =  $this->get('dlin.zendesk')->getApi();

        $categorieClient = new CategoryClient($api);
        $categorieResult = $categorieClient->getOneById($idCategorie);

        $sectionClient = new SectionClient($api);
        $sections = $sectionClient->getSectionsByCategorie($categorieResult->getId())->getItems();

        $articleClient = new ArticleClient($api);
        $articles = [];
        foreach($sections as $section){
            $articles = array_merge($articles, $articleClient->getArticlesBySection($section->getId())->getItems());
        }

        return $this->render('DlinZendeskBundle:Categorie:categorie_show.html.twig', array(
            'categorie' => $categorieResult,
            'sections' => $sections,
            'articles' => $articles
        ));
    }
}