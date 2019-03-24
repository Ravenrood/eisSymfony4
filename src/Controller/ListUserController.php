<?php
/**
 * Created by PhpStorm.
 * User: KamilWi
 * Date: 23.03.2019
 * Time: 20:40
 */

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use App\Service\GenerateUserList;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class ListUserController extends AbstractController
{
    /**
     * @var GenerateUserList
     */
    private $generateUserListService;

    public function __construct(GenerateUserList $generateUserListService)
    {
        $this->generateUserListService = $generateUserListService;
    }

    /**
     * Generate HTML View
     * @Route("/")
     * @return Response
     */
    public function displayTable(): Response
    {
     $dataService =  $this->generateUserListService;
     $data = $dataService(200);

     $return = $this->renderView('displayTable.html.twig', array('data' => $data, 'title' => 'DataTable'));
     return new Response($return);
    }
}