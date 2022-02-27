<?php


namespace App\Controller\Api;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MyApiController extends AbstractController
{

    private $em;

    public function __construct(
        EntityManagerInterface $em
    ) {

        $this->em = $em;
    }

    /**
     * @Route("/verify/email", name="VerifyEmail", methods={"POST"})
     * @param Request $request
     * @return JsonResponse
     */
    public function verifyEmail(Request $request)
    {
        $data = $request->toArray();
        if (empty($data['mail'])) {
            return new JsonResponse([
                'message' => 'Veillez renseignez une adddresse email'
            ], 400);
        }

        $user = $this->em->getRepository(User::class)->findOneBy(['mail' => $data['mail']]);

        return new JsonResponse([
            'success' => !$user ? false : true,
            'message' => !$user ? "Ce mail n'est pas utilise" : "Ce mail est utilise"
        ], !$user ? 400 : 200);
    }

    /**
     * @Route("/verify/number", name="VerifyNumber", methods={"POST"})
     * @param Request $request
     * @return JsonResponse
     */
    public function verifyNumber(Request $request)
    {
        $data = $request->toArray();
        if (empty($data['numero'])) {
            return new JsonResponse([
                'message' => 'Veillez renseignez un numero'
            ], 400);
        }

        $user = $this->em->getRepository(User::class)->findOneBy(['numero' => $data['numero']]);

        return new JsonResponse([
            'success' => !$user ? false : true,
            'message' => !$user ? "Ce numero n'est pas utilise" : "Ce numero est utilise"
        ], !$user ? 400 : 200);
    }
    /**
     * @Route("/verify/code", name="VerifyCode", methods={"POST"})
     * @param Request $request
     * @return JsonResponse
     */
    public function verifyCode(Request $request)
    {
        $data = $request->toArray();
        if (empty($data['code'])) {
            return new JsonResponse([
                'message' => 'Veillez renseignez un code'
            ], 400);
        }

        $user = $this->em->getRepository(User::class)->findOneBy(['numero' => $data['numero']]);
        $code = $user->getCode();
        var_dump($user->getStatus());

        var_dump($user->getStatus());
        $reponse = false;
        if ($code == $data['code']) {
            $reponse = true;

            $this->em->persist($user->setStatus(true));
            $this->em->flush();
        } else {
            $reponse = false;
        }


        return new JsonResponse([
            'success'
            => $reponse,

        ]);
    }
}
