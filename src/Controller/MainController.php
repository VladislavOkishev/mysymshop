<?php


namespace App\Controller;

use App\Entity\Clients;
use App\Entity\Orders;
use App\Entity\OrdersProducts;
use App\Entity\Products;
use App\Form\OrderFormType;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class MainController extends AbstractController
{

    private $requestStack;

    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
    }

    /**
     * @Route("/", name="shop")
     * @param EntityManagerInterface $entityManager
     * @return Response
     */
    public function home(EntityManagerInterface $entityManager)
    {
        $repository = $entityManager->getRepository(Products::class);
        $products = $repository->findAll();



        return $this->render('main/home.html.twig', [
            'products' => $products,
        ]);
    }

    /**
     * @Route("/item/{id<\d+>}", name="shop_item")
     * @param $id
     * @param EntityManagerInterface $entityManager
     * @return Response
     */
    public function item($id, EntityManagerInterface $entityManager)
    {
        $repository = $entityManager->getRepository(Products::class);
        $item = $repository->findOneBy(['id'=>$id]);
        if (!$item) {
            throw $this->createNotFoundException(sprintf('No item found('));
        }

        return $this->render('main/item.html.twig', [
            'item' => $item,
        ]);
    }

    /**
     * @Route("/cart/add/{id<\d+>}", name="shop_cart_add")
     * @param $id
     * @param EntityManagerInterface $entityManager
     * @return Response
     */
    public function addToCart($id, EntityManagerInterface $entityManager)
    {
        $session = $this->requestStack->getSession();

        $repository = $entityManager->getRepository(Products::class);
        $item = $repository->findOneBy(['id'=>$id]);

        $cart = $session->get('cart');
        $cart[$id] = ['count'=>1, 'price'=>$item->getPrice()];
        $session->set('cart', $cart);

        return $this->render('main/item.html.twig', [
            'item' => $item,
        ]);

//        $entityManager->persist($item);
//        $entityManager->flush();
    }

    /**
     * @Route("/cart", name="shop_cart")
     * @param EntityManagerInterface $entityManager
     * @return Response
     */
    public function cart(EntityManagerInterface $entityManager)
    {
        $session = $this->requestStack->getSession();
        $cart = $session->get('cart');

        $repository = $entityManager->getRepository(Products::class);

        $products = [];

        $totalPrice=0;
        if($cart!=null){
            foreach($cart as $id=>$value){
                $item = $repository->find($id);
                $products[]=[
                    'id' => $item->getId(),
                    'title'=>$item->getTitle(),
                    'count'=>$value['count'],
                    'price'=>$item->getPrice(),
                ];
                $totalPrice += $item->getPrice()*$value['count'];
            }
        }
        return $this->render('main/cart.html.twig', [
            'products' => $products,
            'totalPrice' => $totalPrice,
        ]);
    }


    /**
     * @Route("/cart/changeAmount/{id<\d+>}", name="cart_changeAmount", methods="GET|POST")
     */
    public function changeAmount($id)
    {
        $session = $this->requestStack->getSession();
        $cart = $session->get('cart');


        if($_GET['operation']=='plus')
            $cart[$id]['count']++;
        else
            $cart[$id]['count']--;

        $session->set('cart', $cart);
        return new Response(Response::HTTP_OK);
    }

    /**
     * @Route("/shop/order", name="shop_order")
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @return RedirectResponse|Response
     * @throws Exception
     */
    public function createOrder(Request $request, EntityManagerInterface $entityManager)
    {
        $client = new Clients();
        $order = new Orders();

        $repository = $entityManager->getRepository(Products::class);

        $session = $this->requestStack->getSession();
        $form = $this->createForm(OrderFormType::class, $client);
        $form->handleRequest($request);
        $cart = $session->get('cart');

        if ($form->isSubmitted() && $form->isValid()) {
            $client = $form->getData();
            if ($client instanceof Clients) {

                $entityManager = $this->getDoctrine()->getManager();

                $entityManager->persist($client);
                $entityManager->flush();

                $order->setCustomerId($client);
                $order->setDateOrder(new \DateTime());

                $entityManager->persist($order);
                $entityManager->flush();

                foreach($cart as $id=>$value){
                    $order_products = new OrdersProducts();
                    $order_products->setOrderId($order);
                    $order_products->setAmount($value['count']);
                    $item = $repository->find($id);
                    $order_products->setProductId($item);
                    $entityManager->persist($order_products);
                    $entityManager->flush();
                }

                $session->clear();
            }

            return $this->redirectToRoute('shop');
        }


        return $this->render(
            'main/shopOrder.html.twig',
            [
                'form' => $form->createView(),
            ]
        );
    }
}