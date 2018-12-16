<?php
namespace App\Controller;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\Persistence\ObjectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\ADictionary;
use App\Entity\Country;
use App\Entity\Region;
use App\Form\DictionaryEdit;

class DictionaryController extends Controller {

    protected $dictionaryClasses = [
        'country' => Country::class,
        'region'  => Region::class,
    ];
    protected $dictionaryClass;
    protected $dictionaryName;

    /** @var ObjectManager */
    protected $em;

    /** @var ObjectRepository $entityRepo */
    protected $entityRepo;

    /**
     * @Route("/dictionary/{dictionaryName}/", name="dictionaryNew")
     * @param Request $request
     * @param $dictionaryName
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function indexNew(Request $request, $dictionaryName) {
        return $this->index($request, $dictionaryName);
    }

    /**
     * @Route("/dictionary/{dictionaryName}/{id}", name="dictionary")
     * @param Request $request
     * @param $dictionaryName
     * @param string $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function index(Request $request, $dictionaryName, $id = '') {
        //@TODO Refactor it to use with owner and subordinates
        $this->init($dictionaryName);

        $formEdit = $this->createForm(DictionaryEdit::class, $this->getEntity($id));
        $formEdit->handleRequest($request);

        if ($formEdit->isSubmitted() && $formEdit->isValid()) {
            return $this->redirectToRoute('dictionary', [
                'dictionaryName' => $this->dictionaryName,
                'id'             => $this->getNewDictionaryId($formEdit->getData())
            ]);
        }

        return $this->render('dictionary/index.html.twig', [
            'title'     => ($this->dictionaryClass)::ENTITY_NAME,
            'entities'  => $this->getEntities(),
            'fields'    => $this->getFields(),
            'newEntity' => $this->getNewEntityLink(),
            'formEdit'  => $formEdit->createView(),
        ]);
    }

    protected function init($dictionaryName) {
        $this->dictionaryName  = $dictionaryName;
        $this->dictionaryClass = $this->dictionaryClasses[$dictionaryName];
        $this->em              = $this->getDoctrine()->getManager();
        $this->entityRepo      = $this->em->getRepository($this->dictionaryClass);
    }

    /**
     * @param $entity
     * @return string
     */
    protected function getNewDictionaryId($entity) {
        if ($entity instanceof ADictionary) {
            $this->em->persist($entity);
            $this->em->flush();

            return $entity->getId();
        }

        return '';
    }

    /**
     * @return array
     */
    protected function getNewEntityLink() {
        return [
            'id'     => 'addNew',
            'name'   => 'Створити новий запис',
            'enable' => true
        ];
    }

    /**
     * @return array
     */
    protected function getEntities() {
        return $this->entityRepo->findBy([], ['top' => 'DESC', 'name' => 'ASC']);
    }

    /**
     * @param string $id
     * @return mixed
     */
    protected function getEntity(string $id) {
        $entity = $id ? $this->entityRepo->find($id) : null;

        return $entity ?: new $this->dictionaryClass();
    }

    /**
     * @return array
     */
    protected function getFields() {
        return ['name', 'enable', 'top'];//array_keys(get_object_vars($this->getEntities()[0]));
    }
}
