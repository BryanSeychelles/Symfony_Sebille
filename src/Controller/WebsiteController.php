<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Articles;
use App\Entity\Commentaire;
use App\Repository\ArticlesRepository;
use App\Form\CommentaireType;
use App\Repository\CommentaireRepository;
use App\Repository\GitesRepository;
use App\Entity\Gites;
use App\Entity\Booking;
use App\Form\BookingType;
use App\Repository\BookingRepository;
use App\Entity\Animals;
use App\Repository\AnimalsRepository;
use Symfony\Component\HttpFoundation\Response;

class WebsiteController extends AbstractController
{

    /**
     * @Route("/", name="")
     */
    public function index()
    {
        return $this->render('website/index.html.twig', [
            'controller_name' => 'WebsiteController',
        ]);
    }

        /**
     * @Route("/mentions", name="")
     */
    public function mentions()
    {
        return $this->render('website/mentions.html.twig', [
            'controller_name' => 'WebsiteController',
        ]);
    }

    /**
     * @Route("/blog", name="blog")
     */
    public function blog(ArticlesRepository $repo)
    {
        // $repo = $this->getDoctrine()->getRepository(Articles::class); L'argument de la fonction et le use le remplace

        $articles = $repo->findAll();

        return $this->render('website/blog.html.twig', [
            'controller_name' => 'WebsiteController',
            'articles' => $articles
        ]);
    }

            /**
         *  @var CommentaireRepository
         */
        private $repo;

        public function __construct(CommentaireRepository $repo, ObjectManager $em)
        {
            $this->repo = $repo;
            $this->em = $em;
        }

        /**
     * @Route("/blog/{id}", name="blog_show")
            */
    public function show(Articles $article, Request $request, ObjectManager $manager)
    {
                // $repo = $this->getDoctrine()->getRepository(Articles::class);
               // $article = $repo->find($id);
               //L'argument de la fonction et le use le remplace

               $commentaire= new Commentaire();
               $formCom= $this->createForm(CommentaireType::class, $commentaire);
               $formCom->handleRequest($request);

        if ($formCom->isSubmitted() && $formCom->isValid()) {
            $commentaire    ->setCreatedAt(new \DateTime())
                            -> setArticles($article);
            $this->em->persist($commentaire);
            $this->em->flush();
            $this->addflash('success', 'Commentaires émis avec succès');
            return $this->redirectToRoute('blog_show', ['id' => $article->getId()]);
        }

        return $this->render('website/show.html.twig', [
            'article' => $article,
            'formCom' => $formCom->createView(),
            'commentaire'=> $commentaire
        ]);
    }

        /**
     * @Route("/gites", name="gites")
     */
    public function gites(GitesRepository $repo)
    {   
        $gites = $repo->findAll();

        return $this->render('website/gites.html.twig', [
            'controller_name' => 'WebsiteController',
            'gites' => $gites
        ]);
    }

            /**
     * @Route("/gites/{id}", name="gites_show")
            */
    public function show_gites(Gites $gite, Request $request, ObjectManager $manager)
    {
        return $this->render('website/show_gites.html.twig', [
            'gite'=> $gite
        ]);
    }

            /**
     * @Route("/calendar", name="calendar")
     */
    public function home()
    {
        return $this->render('booking/calendar.html.twig');
    }

     /**
     * @Route("/calendar/new", name="booking_new", methods={"GET","POST"})
     */
    public function new_Booking(Request $request): Response
    {
        $booking = new Booking();
        $form = $this->createForm(BookingType::class, $booking);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($booking);
            $entityManager->flush();

            return $this->redirectToRoute('gites');
        }

        return $this->render('booking/new.html.twig', [
            'booking' => $booking,
            'form' => $form->createView(),
        ]);
    }

        /**
     * @Route("/miniferme", name="miniferme")
     */
    public function miniferme(AnimalsRepository $repo)
    {
        // $repo = $this->getDoctrine()->getRepository(Articles::class); L'argument de la fonction et le use le remplace

        $animals = $repo->findAll();

        return $this->render('website/miniferme.html.twig', [
            'controller_name' => 'WebsiteController',
            'animals' => $animals
        ]);
    }

    /**
     * @Route("/activite", name="activite")
     */
    public function activite()
    {
        return $this->render('website/activite.html.twig', [
            'controller_name' => 'WebsiteController',
        ]);
    }

}