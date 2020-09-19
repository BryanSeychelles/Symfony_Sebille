<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Articles;
use App\Entity\Commentaire;
use App\Entity\Gites;
use App\Repository\ArticlesRepository;
use App\Form\ArticlesType;
use App\Form\GitesType;
use Doctrine\Common\Persistence\ObjectManager;
use App\Repository\CommentaireRepository;
use App\Repository\GitesRepository;
use App\Entity\Image;
use App\Repository\ImageRepository;
use App\Entity\Animals;
use App\Repository\AnimalsRepository;
use App\Form\AnimalsType;

class AdminPropertyController extends AbstractController
{
        /**
         *  @var ArticlesRepository
         */
        private $repo;

        public function __construct(ArticlesRepository $repo, ObjectManager $em)
        {
            $this->repo = $repo;
            $this->em = $em;
        }

        /**
         *  @var GitesRepository
         */
        private $repose;

        public function __construct_gites(GitesRepository $repo, ObjectManager $em)
        {
            $this->repose = $repose;
            $this->em = $em;
        }

        /**
         *  @var AnimalsRepository
         */
        private $rep;

        public function __construct_Animals( AnimalsRepository $rep, ObjectManager $em)
        {
            $this->rep = $rep;
            $this->em = $em;
        }

    /**
     * @Route("/admin/animals", name="admin_animals")
     */
    public function animals(AnimalsRepository $rep)
    {
        //$properties= $this->repo->findAll();
        $animals = $rep->findAll();

        return $this->render('admin_property/animals.html.twig', [
            'controller_name' => 'AdminPropertyController',
            'animals' => $animals
        ]);
    }

        /**
     * @Route("/admin/animals/create", name="admin_create_animals")
     */
    public function new_animals(Request $request)
    {
        $animal = new Animals();
        $formAnimals= $this->createForm(AnimalsType::class, $animal);
        $formAnimals->handleRequest($request);

        if ($formAnimals->isSubmitted() && $formAnimals->isValid()) {
            $animal->setUpdatedAt(new \DateTime());
            $this->em->persist($animal);
            $this->em->flush();
            $this->addflash('success', 'Créé avec succès');
            return $this->redirectToRoute('admin_animals');
        }

        return $this->render('admin_property/animals_create.html.twig', [
            'animal' => $animal,
            'formAnimals' => $formAnimals->createView()
        ]);
    }

        /**
     * @Route("/admin/animals/{id}", name="admin_edit_animals", methods="GET|POST")
     */
    public function edit_animals(Animals $animal, Request $request){

        $formAnimals= $this->createForm(AnimalsType::class, $animal);
        $formAnimals->handleRequest($request);

        if ($formAnimals->isSubmitted() && $formAnimals->isValid()) {
            $this->em->flush();
            $this->addflash('success', 'Modifié avec succès');
            return $this->redirectToRoute('admin_animals');
        }

        return $this->render('admin_property/edit_animals.html.twig', [
            'animal' => $animal,
            'formAnimals' => $formAnimals->createView()
        ]);    }


    /**
     * @Route("/admin/animals/{id}", name="admin_delete_animals", methods="DELETE")
     */
    public function delete_animals(Animals $animal, Request $request){

        // if ($this->isCsrfTokenValid('delete' . $animal->getId() , $request->get('_token'))) {

        $this->em->remove($animal);
        $this->em->flush();
        $this->addflash('success', 'Supprimé avec succès');
        // }

            return $this->redirectToRoute('admin_animals');

    }

    /**
     * @Route("/admin", name="admin_property")
     */
    public function index(ArticlesRepository $repo)
    {

        //$properties= $this->repo->findAll();
        $articles = $repo->findAll();

        return $this->render('admin_property/index.html.twig', [
            'controller_name' => 'AdminPropertyController',
            'articles' => $articles

        ]);
    }

    /**
     * @Route("/admin/commentaire", name="admin_commentaire")
     */
    public function comments(CommentaireRepository $repo)
    {

        //$properties= $this->repo->findAll();
        $commentaire = $repo->findAll();

        return $this->render('admin_property/commentaire.html.twig', [
            'controller_name' => 'AdminPropertyController',
            'commentaire' => $commentaire,
        ]);
    }

        /**
     * @Route("/admin/gites", name="admin_gites")
     */
    public function gites(GitesRepository $repo)
    {

        //$properties= $this->repo->findAll();
        $gites = $repo->findAll();

        return $this->render('admin_property/gites.html.twig', [
            'controller_name' => 'AdminPropertyController',
            'gites' => $gites,
        ]);
    }

            /**
     * @Route("/admin/gites/create", name="admin_create_gites")
     */
    public function new_gites(Request $request)
    {
        $gite = new Gites();
        $formGites= $this->createForm(GitesType::class, $gite);
        $formGites->handleRequest($request);

        if ($formGites->isSubmitted() && $formGites->isValid()) {
            $gite->setUpdatedAt(new \DateTime());
            $this->em->persist($gite);
            $this->em->flush();
            $this->addflash('success', 'Créé avec succès');
            return $this->redirectToRoute('admin_gites');
        }

        return $this->render('admin_property/gites_create.html.twig', [
            'gite' => $gite,
            'formGites' => $formGites->createView()
        ]);
    }

    /**
     * @Route("/admin/gites/{id}", name="admin_edit_gites", methods="GET|POST")
     */
    public function editGites(Gites $gite, Request $request){

        $formGites= $this->createForm(GitesType::class, $gite);
        $formGites->handleRequest($request);

        if ($formGites->isSubmitted() && $formGites->isValid()) {
            $this->em->flush();
            $this->addflash('success', 'Modifié avec succès');
            return $this->redirectToRoute('admin_property');
        }

        return $this->render('admin_property/gites_edit.html.twig', [
            'formGites' => $formGites->createView()
        ]);    }


        /**
     * @Route("/admin/create/", name="admin_create")
     */
    public function new(Request $request)
    {
        $article = new Articles();
        $form= $this->createForm(ArticlesType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $article->setUpdatedAt(new \DateTime());
            $this->em->persist($article);
            $this->em->flush();
            $this->addflash('success', 'Créé avec succès');
            return $this->redirectToRoute('admin_property');
        }

        return $this->render('admin_property/create.html.twig', [
            'article' => $article,
            'form' => $form->createView()
        ]);
    }



    /**
     * @Route("/admin/{id}", name="admin_edit", methods="GET|POST")
     */
    public function edit(Articles $article, Request $request){

        $form= $this->createForm(ArticlesType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->flush();
            $this->addflash('success', 'Modifié avec succès');
            return $this->redirectToRoute('admin_property');
        }

        return $this->render('admin_property/edit.html.twig', [
            'article' => $article,
            'form' => $form->createView()
        ]);    }


    /**
     * @Route("/admin/{id}", name="admin_delete", methods="DELETE")
     */
    public function delete(Articles $article, Request $request){

        // if ($this->isCsrfTokenValid('delete' . $article->getId() , $request->get('_token'))) {

        $this->em->remove($article);
        $this->em->flush();
        $this->addflash('success', 'Supprimé avec succès');
        // }

            return $this->redirectToRoute('admin_property');

    }

    /**
     * @Route("/admin/commentaire/{id}", name="admin_delete_comments", methods="DELETE")
     */
    public function delete_comments(Commentaire $commentaire, Request $request){

        // if ($this->isCsrfTokenValid('delete' . $article->getId() , $request->get('_token'))) {

        $this->em->remove($commentaire);
        $this->em->flush();
        $this->addflash('success', 'Supprimé avec succès');
        // }

            return $this->redirectToRoute('admin_commentaire');

    }

    /**
     * @Route("/admin/gites/{id}", name="admin_delete_gites", methods="delete")
     * @param GitesRepository $GitesRepository
     * @param int $id
     * @return RedirectResponse
     */
    public function delete_gites(GitesRepository $repose, int $id): RedirectResponse
    {
        $gite = $repose->find($id);
        $em = $this->getDoctrine()->getManager();
        foreach ($gite->getImages() as $image) {
            $gite->removeImage($image);
        }
        $em->remove($gite);
        $em->flush();
        return $this->redirectToRoute('admin_gites');
    }



}
