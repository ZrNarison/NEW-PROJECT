<?php 
namespace App\Controller;

use App\Entity\Ad;
use App\Form\AdType;
use App\Entity\Image;
use App\Form\ImageType;
use App\Repository\AdRepository;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController{
    /**
     * @Route("/Diosezy_ihosy", name="homepage")
     * @Route("/Diosezy_Ihosy")
     * @Route("/Diosezyihosy")
     * @Route("/Diosezyihosy")
     * @return Response
     */

     public function index(AdRepository $AdAct): Response
     {
        //  return $this->render("home.html.twig");
         $ads = $AdAct->findAll();
        return $this->render('home.html.twig', [
            'ads' => $ads
        ]);
     }
     
    /**
     * @Route("/Eglise", name="app_ad")
     * @Route("/Fiangonana")
     */

    public function affichage_culte(): Response
    {
        // $action = $this->getDoctrine()->getRepository(Ad::class);
        // $ads = $AdAct->findAll();
         return $this->render('culte.html.twig');
            // return $this->render('ad/index.html.twig', [
        //     'ads' => $ads
        // ]);
    }

    /**
     * @Route("/Ecole",name="app_etd")
     */
    public function affichage_ecole():Response
    {
        return $this->render('etd.html.twig');
    }

    /**
     *@Route("/Evenement/ajout",name="ajout_event")
     *@Route("/Evenement/new")
     *@Route("/Evenement/Nouveau")
     *@Route("/Evenement/nouveau")
     */
    public function ajout(Request $rqt)
    {
        $event = new Ad();
        $image = new Image();
        // $image->setphoto("photo image")
        //       ->setcaption("Légende image");
        $form = $this->createForm(AdType::class,$event);
        $form->handleRequest($rqt);
        if($form->isSubmitted()&& $form->isValid()){
            // foreach($event->getImages() as $image)
            // {
            //     $image->setAd($event);
            //     $mng = $this -> getDoctrine()->getManager();
            //     $mng -> persist($image);
            //     $mng -> flush();
            // }
            $mng = $this -> getDoctrine()->getManager();
            $mng -> persist($event);            
            $mng -> flush();
            $this->addFlash
                    (
                        "success",
                        "L'évenement <strong> {$event->gettitle()}</strong> qui se fait à <strong>  {$event->getlieu()} </strong> à été bien enregistré !"
                    );
        // return $this->redirectToRoute('ad_show',[
        //     "slug"=>$event->getslug()
        // ]);
        return $this->redirectToRoute('ajout_event');
        }
         return $this->render('new_event.html.twig',[    
                'form'=> $form->createView()
            ]);
    }
    /**
     * Undocumented function
     *@Route("/Activité/{slug}", name="ad_show")
     * @return Response
     */
    public function show_event( Ad $act)
    {
        return $this->render('index.html.twig',[
            "evm" => $act
        ] );
    }
}