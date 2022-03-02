<?php
// api/src/Controller/CreateMediaObjectAction.php

namespace App\Controller;

use App\Entity\UserObject;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

#[AsController]
final class CreateUserObjectAction extends AbstractController
{
    public function __invoke(Request $request): UserObject
    {

        $uploadedFile = $request->files->get('file');
        if (!$uploadedFile) {
            throw new BadRequestHttpException('"file" is required');
        }

// dd($uploadedFile);
        $UserObject = new UserObject();
        $UserObject->file = $uploadedFile;
        // dd($UserObject);
        return $UserObject;
    }
}
