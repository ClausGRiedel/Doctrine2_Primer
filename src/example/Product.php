<?php
/**
 * All doctrine 2 example actions for the product.
 */
class Example_Product
{

    /**
     * Inserts a new user into the database.
     */
    public static function create()
    {
        $entityManager = service_Doctrine2Bootstrap::createEntityManager();

        // insert a product into the database
        $newProductName = 'MyProduct ' . time();

        Service_Console::log('Creating a new product with productname [' . $newProductName . '] into the database..');

        $newProduct = new Model_Product();
        $newProduct->setName($newProductName);

        $entityManager->persist($newProduct);
        $entityManager->flush();

        Service_Console::log(
            '<b>Successfully created new product with ID ' . $newProduct->getId() . '.</b>',
            Service_Console::COLOR_GREEN
        );
        Service_Console::log();

        // show main menu
        Service_Action::perform(Service_Action::ACTION_SHOW_MAIN_MENU);
    }

    /**
     * Lists all products.
     */
    public static function showAll()
    {
        $entityManager = service_Doctrine2Bootstrap::createEntityManager();

        Service_Console::log('Listing all products');

        // get all products
        $productRepository = $entityManager->getRepository('Model_Product');

        /** @var Model_Product[] $products */
        $products = $productRepository->findAll();

        Service_Console::log();
        foreach ($products as $product) {
            Service_Console::log('id [' . $product->getId() . '] name [' . $product->getName() . ']');
        }
        Service_Console::log();

        // show main menu
        Service_Action::perform(Service_Action::ACTION_SHOW_MAIN_MENU);
    }

}