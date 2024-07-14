<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

use App\Services\DrawingTool;

class DrawingToolController extends AbstractController
{
    
    #[Route('/', name: 'drawing_tool', methods: ['GET', 'POST'])]
    public function index(Request $request, DrawingTool $drawingTool): Response
    {
        $result = '';

        if ($request->isMethod('POST')) {
            $input = $request->request->get('commands');
            $result = $drawingTool->executeCommands($input);
        }
        return $this->render('drawing_tool/index.html.twig', [
            'controller_name' => 'DrawingToolController',
            'result' => $result
        ]);
    }
}
