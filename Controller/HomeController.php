<?php
namespace Dlin\Bundle\ZendeskBundle\Controller;

use Dlin\Zendesk\Client\ArticleClient;
use Dlin\Zendesk\Client\CategoryClient;
use Dlin\Zendesk\Client\SectionClient;
use Symfony\Bundle\FrameworkBundle\Controller\Controller as BaseController;

/**
 * Controller managing the Homepage
 *
 * @author Plopleo
 */
class HomeController extends BaseController
{
    public function homeAction()
    {
        $api =  $this->get('dlin.zendesk')->getApi();

        $categoriesClient = new CategoryClient($api);
        $categoriesResult = $categoriesClient->getAll();

        $sectionsClient = new SectionClient($api);
        $sectionsResult = $sectionsClient->getAll();

        $articleClient = new ArticleClient($api);
        $articleResult = $articleClient->getAll();

        return $this->render('DlinZendeskBundle:Home:home.html.twig', array(
            'categories' => $categoriesResult->getItems(),
            'sections' => $sectionsResult->getItems(),
            'articles' => $articleResult->getItems(),
        ));
    }
}