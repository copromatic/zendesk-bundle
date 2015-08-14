<?php
namespace Dlin\Bundle\ZendeskBundle\Controller;

use Dlin\Zendesk\Entity\Ticket;
use Dlin\Zendesk\Entity\TicketComment;
use Dlin\Zendesk\Entity\TicketRequester;
use Symfony\Component\HttpFoundation\Request;
use Dlin\Zendesk\Client\TicketClient;
use Symfony\Bundle\FrameworkBundle\Controller\Controller as BaseController;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\EmailValidator;
use Symfony\Component\Validator\Constraints\NotBlank;

/**
 * Controller managing requests
 *
 * @author Plopleo
 */
class RequestController extends BaseController
{
    public function newAction(Request $request)
    {
        $form = $this->createFormBuilder()
            ->add('mail', 'email',array(
                'constraints' => array(
                    new NotBlank(),
                    new Email(),
                ),
            ))
            ->add('subject', 'text',array(
        'constraints' => array(
            new NotBlank(),
        ),
    ))
            ->add('description', 'textarea',array(
                'constraints' => array(
                    new NotBlank(),
                ),
            ))
            ->add('submit', 'submit')
            ->getForm();

        $form->handleRequest($request);

        if ($form->isValid()) {
            //$api =  $this->get('dlin.zendesk')->getApi();
//
            //$ticketComment = new TicketComment();
            //$ticketComment->setBody($form->get('description')->getData());
//
            //$ticket = new Ticket();
            //$ticket->setSubject($form->get('subject')->getData());
            //$ticket->setComment($ticketComment);
//
            //$ticketRequester = new TicketRequester();
            //$ticketRequester->setEmail($form->get('mail')->getData());
            //$ticketRequester->setName($form->get('mail')->getData());
//
            //$ticketClient = new TicketClient($api);
            //$result = $ticketClient->save($ticket, $ticketRequester);

            $this->addFlash(
                'notice',
                'Votre demande a bien été envoyée !'
            );

            return $this->redirect($this->generateUrl('home'));
        }

        return $this->render('DlinZendeskBundle:Request:request_new.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}