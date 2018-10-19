<?php

namespace Nam\Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Nam\Bundle\Entity\Product;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\FormType;

class ProductController extends Controller
{
    /**
     * @Route("/nam/product/create", name="nam_bundle_product_create")
     */
    public function CreateAction(Request $request)
    {

        $form = $this->createFormBuilder(new Product())
            ->add('name', TextType::class)
            ->add('price', IntegerType::class)
            ->add('description', TextareaType::class)
            ->add('save', SubmitType::class, array('label' => 'Create Task'))
            ->getForm();

        $form->handleRequest($request);

        if ($request->getMethod() == 'POST') {
            $data = $request->request->get('form');
            $submittedToken = $data['token'];
            if ($this->isCsrfTokenValid('authenticate', $submittedToken)) {
                $data = $form->getData();
                $entityManager = $this->getDoctrine()->getManager();

                // tells Doctrine you want to (eventually) save the Product (no queries yet)
                $entityManager->persist($data);

                // actually executes the queries (i.e. the INSERT query)
                $entityManager->flush();
            }

            return $this->redirectToRoute('nam_bundle_product_index');
        }

        return $this->render('NamBundle:Product:create.html.twig', array());
    }

    /**
     * @Route("/nam/product/update/{id}", name="nam_bundle_product_update")
     */
    public function UpdateAction($id, Request $request)
    {

        $repository = $this->getDoctrine()->getRepository(Product::class);
        $product = $repository->find($id);

        if (!$product) {
            throw $this->createNotFoundException("Can't find product");
        }

        $form = $this->createFormBuilder($product)
            ->add('name', TextType::class)
            ->add('price', IntegerType::class)
            ->add('description', TextareaType::class)
            ->add('save', SubmitType::class, array('label' => 'Create Task'))
            ->getForm();

        $form->handleRequest($request);

        if ($request->getMethod() == 'POST') {
            $data = $request->request->get('form');
            $submittedToken = $data['token'];
            if ($this->isCsrfTokenValid('authenticate', $submittedToken)) {
                $data = $form->getData();
                $entityManager = $this->getDoctrine()->getManager();

                // tells Doctrine you want to (eventually) save the Product (no queries yet)
                $entityManager->persist($data);

                // actually executes the queries (i.e. the INSERT query)
                $entityManager->flush();
            }

            return $this->redirectToRoute('nam_bundle_product_index');
        }

        return $this->render('NamBundle:Product:update.html.twig', array(
            'product' => $product,
        ));

    }

    /**
     * @Route("/nam/product/delete/{id}", name="nam_bundle_product_delete")
     */
    public function DeleteAction($id, Request $request)
    {
        $submittedToken = $request->request->get('token');

        // 'delete-item' is the same value used in the template to generate the token
        if ($this->isCsrfTokenValid('delete_product', $submittedToken)) {
            $repository = $this->getDoctrine()->getRepository(Product::class);
            $product = $repository->find($id);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($product);
            $entityManager->flush();
        }

        return $this->redirectToRoute('nam_bundle_product_index');
    }

    /**
     * @Route("/nam/product/", name="nam_bundle_product_index")
     */
    public function IndexAction()
    {

        $repository = $this->getDoctrine()->getRepository(Product::getClass());
        $products = $repository->findAll();

        return $this->render('NamBundle:Product:index.html.twig', array(
            'products' => $products
        ));
    }
}
