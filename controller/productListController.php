<?php

/**
 * Class ProductListController
 */
final class ProductListController extends BaseController {

    private $printDAO;
    private $categoryDAO;

    public function __construct() {
        parent::__construct();
        $this->printDAO = new PrintDAO();
        $this->categoryDAO = new CategoriesDAO();
    }

    /**
     * Renders a list of all stored prints
     */
    public function getAllPrints() {
        $pictures = $this->printDAO->getAllPrints();
        $template = $this->templateEngine->loadTemplate('productListing.twig');
        $template->display(array(
            'category' => 'All Prints',
            'pictures' => $pictures
        ));
    }

    /**
     * @param $categoryID
     */
    public function getPrintsForCategory($categoryID) {
        $pictures = $this->printDAO->getPrintsByCategory($categoryID);
        $template = $this->templateEngine->loadTemplate('productListing.twig');
        $template->display(array(
            'category' => $this->categoryDAO->getAllCategories()[$categoryID-1][1],
            'pictures' => $pictures
        ));
    }

    public function selectCategory() {
        $template = $this->templateEngine->loadTemplate('select_category.twig');
        $template->display(array());
    }
}