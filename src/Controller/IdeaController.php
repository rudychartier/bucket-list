<?php

namespace App\Controller;


use App\Entity\Idea;
use App\Form\IdeaType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route ("/bucket_list")
 */
class IdeaController extends AbstractController
{
    /**
     * @Route ("/list",name="list_idea")
     *
     */
    public function List()
    {
        $bucket_listRepo= $this->getDoctrine()->getRepository(Idea::class);
        $bucket_list=$bucket_listRepo->findBy([], ['dateCreated' => 'asc']);
        dump($bucket_list);
        return $this->render("idea/list.html.twig",["bucket_list"=>$bucket_list]);
    }

    /**
     * @Route("/detail/{id}",name="detail_idea",requirements={"id":"\d+"})
     */
    public function Detail($id,Request $request)
    {
        $detailsRepo= $this->getDoctrine()->getRepository(Idea::class);
        $detail=$detailsRepo->find($id);
        return $this->render("idea/detail.html.twig",["detail"=>$detail]);
    }

    /**
     * @Route ("/list/add",name="add_idea")
     */
    public function Add(EntityManagerInterface $em){

    $idea = new Idea();
    $idea->setTitle("Devenir Président de la République !");
    $idea->setAuthor("Kirikou");
    $idea->setDescription("Gagner la confiance du peuple tout en vidant les caisses de l'état !");
    $idea->setIsPublished(1);
    $idea->setDateCreated(new \DateTime());

    $em->persist($idea);
    $em->flush();


        return $this->render("list/add");
    }
    /**
     * @Route ("/ajout_idees",name="ajout_idees_idea")
     *
     */
    public function Ajout_idees(EntityManagerInterface $em,Request $request)
    {
        $currentuser=$this->getUser();
        $username= $currentuser->getUsername();
        $idea =new Idea();
        $idea->setDateCreated(new\DateTime());
        $idea->setIsPublished(1);
        $ideaForm = $this->createForm(IdeaType::class,$idea,array('username'=>$username));


        $ideaForm->handleRequest($request);

        if ($ideaForm->isSubmitted()&& $ideaForm->isValid()){
            $em->persist($idea);
            $em->flush();

            $this->addFlash('success','Votre idée a été prise en compte !');
            return $this->redirectToRoute('detail_idea',['id'=>$idea->getId()]);

        }

        return $this->render("idea/ajout_idees.html.twig",["ideaForm"=>$ideaForm->createView()]);
    }


}